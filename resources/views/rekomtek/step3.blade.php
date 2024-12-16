@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div class="w-1/3 text-center">
                    <div class="w-10 h-10 mx-auto bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white">1</span>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-900">Data Pemohon</p>
                </div>
                <div class="w-1/3 text-center">
                    <div class="w-10 h-10 mx-auto bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white">2</span>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-900">Data Lokasi</p>
                </div>
                <div class="w-1/3 text-center">
                    <div class="w-10 h-10 mx-auto bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white">3</span>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-900">Upload Dokumen</p>
                </div>
            </div>
            <div class="relative mt-4">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Upload Dokumen Pendukung</h2>
            <p class="text-sm text-gray-500 rounded-lg border mb-8">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX dengan ukuran maksimal 1.28MB per file.</p>

            <!-- Download Section -->

            <form action="{{ route('rekomtek.store.step3', $application->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-semibold text-gray-900">Template Dokumen</h2>
                                <a href="{{ route('rekomtek.pdf', $application->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    <i class="fas fa-download mr-2"></i>
                                    Download Template Form
                                </a>
                            </div>

                            <!-- Document Upload Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Required Documents -->
                                <div class="space-y-6 bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Dokumen Wajib</h3>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Gambar Lokasi/Peta Situasi</label>
                                        <input type="file" name="documents[peta_situasi]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100" required>
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB)</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Detail Gambar Konstruksi</label>
                                        <input type="file" name="documents[detail_konstruksi]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100" required>
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB)</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Perhitungan Struktur</label>
                                        <input type="file" name="documents[perhitungan_struktur]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100" required>
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB)</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Spesifikasi Teknis</label>
                                        <input type="file" name="documents[spesifikasi_teknis]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100" required>
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB)</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Rencana Operasi dan Pemeliharaan</label>
                                        <input type="file" name="documents[rencana_operasi]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100" required>
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB)</p>
                                    </div>
                                </div>

                                <!-- Optional Documents -->
                                <div class="space-y-6 bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Dokumen Tambahan</h3>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Perhitungan Geologi Teknik</label>
                                        <input type="file" name="documents[perhitungan_geologi]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100">
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB) - Jika diperlukan</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Perhitungan Hidrologi/Hidrolika</label>
                                        <input type="file" name="documents[perhitungan_hidrologi]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100">
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB) - Jika diperlukan</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Laporan Uji Model Fisik</label>
                                        <input type="file" name="documents[uji_model]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100">
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB) - Jika diperlukan</p>
                                    </div>

                                    @if($application->jenis_pemohon === 'perpanjangan')
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Salinan Izin yang Akan Diperpanjang</label>
                                        <input type="file" name="documents[salinan_izin]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                            class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100" required>
                                        <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB)</p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Surat Permohonan Section -->
                            <div class="mt-8 bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">Surat Permohonan</h3>
                                        <p class="text-sm text-gray-500 rounded-lg border">Surat permohonan ditujukan kepada PU SDA Bondowoso</p>
                                    </div>
                                </div>
                                <input type="file" name="documents[surat_permohonan]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                                    class="mt-1 block w-full text-sm text-gray-500 rounded-lg border
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100" required>
                                <p class="mt-1 text-xs text-gray-500">Format file: PDF, JPG, JPEG, PNG, DOC, atau DOCX (Maks. 1.28MB)</p>
                            </div>

                            @error('documents.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6">
                        <a href="{{ route('rekomtek.step2', $application->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Submit
                            <i class="fas fa-check ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
