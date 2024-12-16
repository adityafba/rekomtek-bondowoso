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

    public function update(Request $request, $id)
    {
        $request->validate([
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

        $application = RekomtekApplication::findOrFail($id);
        $application->update($request->all());

        return redirect()
            ->route('admin.applications.show', $id)
            ->with('success', 'Application updated successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,review,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $application = RekomtekApplication::findOrFail($id);
        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'status' => ucfirst($request->status)
        ]);
    }
}
