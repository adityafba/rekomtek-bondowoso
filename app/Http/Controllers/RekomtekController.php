<?php

namespace App\Http\Controllers;

use App\Models\RekomtekApplication;
use App\Models\RekomtekDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use PDF;

class RekomtekController extends Controller
{
    public function index()
    {
        return view('rekomtek.index');
    }

    public function createStep1(Request $request)
    {
        $application = null;
        if ($request->session()->has('application_id')) {
            $application = RekomtekApplication::find($request->session()->get('application_id'));
        }
        return view('rekomtek.step1', compact('application'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'instansi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'jenis_pemohon' => 'required|in:baru,perpanjangan',
        ]);

        if ($request->session()->has('application_id')) {
            $application = RekomtekApplication::find($request->session()->get('application_id'));
            if ($application) {
                $application->update($validated);
            } else {
                $application = RekomtekApplication::create($validated);
            }
        } else {
            $application = RekomtekApplication::create($validated);
        }

        $request->session()->put('application_id', $application->id);
        return redirect()->route('rekomtek.step2', ['id' => $application->id]);
    }

    public function createStep2($id)
    {
        $application = RekomtekApplication::findOrFail($id);
        return view('rekomtek.step2', compact('application'));
    }

    public function storeStep2(Request $request, $id)
    {
        try {
            \Log::info('Step 2 form submission:', $request->all());
            
            $validatedData = $request->validate([
                'jenis_pemohon' => 'required|in:baru,perpanjangan',
                'jenis_izin' => 'required|in:pengusahaan,penggunaan',
                'sub_jenis_izin' => 'required',
                'nama_pekerjaan' => 'required|string|max:255',
                'lokasi_pekerjaan' => 'required|string',
                'provinsi' => 'required|string|max:255',
                'kabupaten' => 'required|string|max:255',
                'alamat' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'tujuan' => 'required|string',
                'cara_pengambilan' => 'required|string',
                'volume_pengambilan' => 'required|numeric',
                'jenis_konstruksi' => 'required|string',
                'jadwal_pelaksanaan' => 'required|integer',
                'rencana_pelaksanaan_mulai' => 'required|date',
                'rencana_pelaksanaan_selesai' => 'required|date|after:rencana_pelaksanaan_mulai',
            ], [
                'required' => ':attribute harus diisi.',
                'in' => ':attribute yang dipilih tidak valid.',
                'max' => ':attribute tidak boleh lebih dari :max karakter.',
                'numeric' => ':attribute harus berupa angka.',
                'date' => ':attribute harus berupa tanggal.',
                'after' => 'Tanggal selesai harus setelah tanggal mulai.',
            ]);

            \Log::info('Validated data:', $validatedData);

            $application = RekomtekApplication::findOrFail($id);
            $application->update($validatedData);

            \Log::info('Application updated successfully:', ['id' => $application->id]);

            return redirect()
                ->route('rekomtek.step3', ['id' => $application->id])
                ->with('success', 'Data berhasil disimpan. Silahkan lanjutkan ke tahap berikutnya.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Application not found:', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()
                ->route('rekomtek.step1')
                ->with('error', 'Data permohonan tidak ditemukan. Silahkan mulai dari awal.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error:', ['id' => $id, 'errors' => $e->errors()]);
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Mohon periksa kembali form anda.');
        } catch (\Exception $e) {
            \Log::error('Error in storeStep2:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan. Silahkan coba lagi. Detail: ' . $e->getMessage());
        }
    }

    public function createStep3($id)
    {
        try {
            $application = RekomtekApplication::findOrFail($id);
            return view('rekomtek.step3', compact('application'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('rekomtek.step1')
                ->with('error', 'Data permohonan tidak ditemukan. Silahkan mulai dari awal.');
        }
    }

    public function storeStep3(Request $request, $id)
    {
        $request->validate([
            'documents.*' => 'required|mimes:pdf,jpg,jpeg,png,doc,docx|max:1280'
        ]);

        $application = RekomtekApplication::findOrFail($id);

        foreach ($request->file('documents') as $type => $file) {
            if ($file) {
                $path = $file->store('documents', 'public');  // Store in public disk
                RekomtekDocument::create([
                    'rekomtek_application_id' => $application->id,
                    'document_type' => $type,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]);
            }
        }

        $application->status = 'pending';
        $application->save();

        // Clear the session after successful submission
        $request->session()->forget('application_id');

        return redirect()->route('rekomtek.success', ['id' => $application->id]);
    }

    public function success($id)
    {
        $application = RekomtekApplication::findOrFail($id);
        return view('rekomtek.success', compact('application'));
    }

    public function generatePDF($id)
    {
        $application = RekomtekApplication::findOrFail($id);
        $pdf = PDF::loadView('rekomtek.pdf', compact('application'));
        return $pdf->download('form-rekomtek.pdf');
    }

    /**
     * Download template file
     */
    public function downloadTemplate($type)
    {
        Log::info('Downloading template: ' . $type);
        
        $templates = [
            'surat_permohonan' => [
                'path' => public_path('templates/template_surat_permohonan.pdf'),
                'name' => 'Template Surat Permohonan.pdf'
            ],
            'spesifikasi' => [
                'path' => public_path('templates/template_spesifikasi_teknis.pdf'),
                'name' => 'Template Spesifikasi Teknis.pdf'
            ]
        ];

        if (!isset($templates[$type])) {
            Log::error('Invalid template type: ' . $type);
            abort(404, 'Invalid template type: ' . $type);
        }

        $template = $templates[$type];
        Log::info('Template path: ' . $template['path']);
        
        if (!file_exists($template['path'])) {
            Log::error('Template file not found at path: ' . $template['path']);
            abort(404, 'Template file not found at path: ' . $template['path']);
        }

        return Response::download($template['path'], $template['name'], [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $template['name'] . '"'
        ]);
    }
}
