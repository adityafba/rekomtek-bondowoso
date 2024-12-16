@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div class="w-1/3 text-center">
                    <div class="w-10 h-10 mx-auto bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white">1</span>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-900">Data Pemohon</p>
                </div>
                <div class="w-1/3 text-center">
                    <div class="w-10 h-10 mx-auto bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-white">2</span>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Data Lokasi</p>
                </div>
                <div class="w-1/3 text-center">
                    <div class="w-10 h-10 mx-auto bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-white">3</span>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Upload Dokumen</p>
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
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Identitas Pemohon</h2>
            
            <form action="{{ route('rekomtek.store.step1') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('nama', $application->nama ?? '') }}">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                        <input type="text" name="instansi" id="instansi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('instansi', $application->instansi ?? '') }}">
                        @error('instansi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('jabatan', $application->jabatan ?? '') }}">
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" name="nik" id="nik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required maxlength="16" value="{{ old('nik', $application->nik ?? '') }}">
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                        <input type="tel" name="no_hp" id="no_hp" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('no_hp', $application->no_hp ?? '') }}">
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('email', $application->email ?? '') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('alamat', $application->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pemohon</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <input type="radio" id="baru" name="jenis_pemohon" value="baru" class="hidden peer" required {{ old('jenis_pemohon', $application->jenis_pemohon ?? '') == 'baru' ? 'checked' : '' }}>
                                <label for="baru" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Pengajuan Rekomtek untuk Izin Baru
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="perpanjangan" name="jenis_pemohon" value="perpanjangan" class="hidden peer" {{ old('jenis_pemohon', $application->jenis_pemohon ?? '') == 'perpanjangan' ? 'checked' : '' }}>
                                <label for="perpanjangan" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Pengajuan Rekomtek untuk Izin Perpanjangan
                                </label>
                            </div>
                        </div>
                        @error('jenis_pemohon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between pt-6">
                    <a href="{{ route('rekomtek.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg">
                        Kembali
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Lanjut
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
