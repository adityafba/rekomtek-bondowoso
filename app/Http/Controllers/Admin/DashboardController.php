<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekomtekApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = RekomtekApplication::with('user', 'documents')
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%")
                  ->orWhere('jenis_izin', 'like', "%{$search}%")
                  ->orWhere('lokasi_pekerjaan', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(10)->withQueryString();

        return view('admin.dashboard', compact('applications'));
    }

    public function show($id)
    {
        $application = RekomtekApplication::with(['user', 'documents'])->findOrFail($id);
        return view('admin.applications.show', compact('application'));
    }

    public function edit($id)
    {
        $application = RekomtekApplication::findOrFail($id);
        return view('admin.applications.edit', compact('application'));
    }

    /**
     * Update the application status.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            // Validate both status and catatan fields
            $validated = $request->validate([
                'status' => 'required|in:pending,review,approved,rejected',
                'catatan' => 'nullable|string'
            ]);

            $application = RekomtekApplication::findOrFail($id);

            // Define valid status transitions
            $validTransitions = [
                'pending' => ['review'],
                'review' => ['approved', 'rejected'],
                'approved' => ['review'],
                'rejected' => ['review']
            ];

            // Check if the current status has any valid transitions
            if (!isset($validTransitions[$application->status])) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Status saat ini tidak valid untuk diubah');
            }

            // Check if the requested transition is valid
            if (!in_array($validated['status'], $validTransitions[$application->status])) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Perubahan status yang diminta tidak valid');
            }

            // Update both status and catatan fields
            $application->update([
                'status' => $validated['status'],
                'catatan' => $validated['catatan'] ?? null
            ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Status dan catatan berhasil diperbarui');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error in status update: ' . json_encode($e->errors()));
            return redirect()->route('admin.dashboard')
                ->with('error', 'Data yang dimasukkan tidak valid');

        } catch (\Exception $e) {
            \Log::error('Status update error: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'Terjadi kesalahan saat memperbarui status');
        }
    }

    /**
     * Update the application details.
     */
    public function update(Request $request, $id)
    {
        try {
            $application = RekomtekApplication::findOrFail($id);
            
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'instansi' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'nik' => 'required|string|max:20',
                'no_hp' => 'required|string|max:20',
                'jenis_pemohon' => 'required|string',
                'jenis_izin' => 'required|string',
                'sub_jenis_izin' => 'required|string',
                'nama_pekerjaan' => 'required|string',
                'lokasi_pekerjaan' => 'required|string',
                'provinsi' => 'required|string',
                'kabupaten' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'tujuan' => 'required|string',
                'cara_pengambilan' => 'required|string',
                'volume_pengambilan' => 'required|numeric',
                'jenis_konstruksi' => 'required|string',
                'jadwal_pelaksanaan' => 'required|string',
                'rencana_pelaksanaan_mulai' => 'required|date',
                'rencana_pelaksanaan_selesai' => 'required|date|after:rencana_pelaksanaan_mulai'
            ]);

            $application->update($validated);

            return redirect()->route('admin.applications.show', $id)
                ->with('success', 'Application updated successfully');
        } catch (\Exception $e) {
            \Log::error('Application update error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }
    }
}
