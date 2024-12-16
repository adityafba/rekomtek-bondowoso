@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        /* Map Section Styles */
        .map-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        @media (min-width: 1024px) {
            .map-section {
                grid-template-columns: 3fr 2fr;
                align-items: start;
            }
        }

        .map-wrapper {
            position: relative;
            height: 400px;
            background: #f8fafc;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        
        .map-container {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        #mapid {
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .map-overlay {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
            background: white;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            font-size: 0.875rem;
            border: 1px solid #e5e7eb;
        }

        .map-instructions {
            color: #4b5563;
            font-size: 0.875rem;
            line-height: 1.4;
        }

        /* Coordinates Display */
        .coordinates-display {
            background: #f8fafc;
            padding: 1.25rem;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            margin-top: 1rem;
        }

        .coordinates-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            color: #1f2937;
            font-weight: 500;
        }

        .coordinates-inputs {
            display: grid;
            gap: 1rem;
        }

        .coordinate-group {
            position: relative;
        }

        .coordinate-group input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .coordinate-group input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .coordinate-group i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 1rem;
        }

        /* Address Form */
        .address-form {
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        .address-form textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* Leaflet Controls */
        .leaflet-control-container {
            position: absolute;
            z-index: 1000;
        }

        .leaflet-control {
            margin: 0.75rem !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
            border-radius: 0.375rem !important;
            overflow: hidden;
        }

        .leaflet-control-zoom {
            border: none !important;
            background: white !important;
        }

        .leaflet-control-zoom a {
            width: 32px !important;
            height: 32px !important;
            line-height: 32px !important;
            color: #4b5563 !important;
            font-size: 16px !important;
            transition: all 0.2s ease;
        }

        .leaflet-control-zoom a:hover {
            background-color: #f3f4f6 !important;
            color: #1f2937 !important;
        }

        .leaflet-control-geocoder {
            background: white !important;
        }

        .leaflet-control-geocoder-form input {
            width: 240px !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 0.375rem !important;
            outline: none !important;
        }

        .leaflet-control-geocoder-form input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1) !important;
        }

        .leaflet-control-geocoder-alternatives {
            background: white !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 0.375rem !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
            margin-top: 0.25rem !important;
        }

        .leaflet-control-geocoder-alternatives li {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            color: #4b5563 !important;
            cursor: pointer !important;
            transition: background-color 0.2s;
        }

        .leaflet-control-geocoder-alternatives li:hover {
            background-color: #f3f4f6 !important;
            color: #1f2937 !important;
        }

        /* Custom Marker */
        .custom-marker-icon {
            color: #3b82f6;
            font-size: 2rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .custom-marker-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

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
                    <div class="w-10 h-10 mx-auto bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white">2</span>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-900">Data Lokasi</p>
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
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Detail Permohonan</h2>
            <p class="text-gray-600 mb-8">Langkah 2 dari 3 - Informasi Permohonan</p>

            <form action="{{ route('rekomtek.store.step2', $application->id) }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-8">
                    <!-- Jenis Pemohon Section -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Jenis Pemohon</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <input type="radio" id="baru" name="jenis_pemohon" value="baru" class="hidden peer" required {{ old('jenis_pemohon', $application->jenis_pemohon) == 'baru' ? 'checked' : '' }}>
                                <label for="baru" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    <div class="font-semibold">Pengajuan Rekomtek untuk Izin Baru</div>
                                    <p class="text-gray-500 mt-1">Untuk pengajuan izin baru</p>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="perpanjangan" name="jenis_pemohon" value="perpanjangan" class="hidden peer" {{ old('jenis_pemohon', $application->jenis_pemohon) == 'perpanjangan' ? 'checked' : '' }}>
                                <label for="perpanjangan" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    <div class="font-semibold">Pengajuan Rekomtek untuk Izin Perpanjangan</div>
                                    <p class="text-gray-500 mt-1">Untuk perpanjangan izin yang sudah ada</p>
                                </label>
                            </div>
                        </div>
                        @error('jenis_pemohon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Izin Section -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Jenis Izin</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <input type="radio" id="pengusahaan" name="jenis_izin" value="pengusahaan" class="hidden peer" required {{ old('jenis_izin', $application->jenis_izin) == 'pengusahaan' ? 'checked' : '' }}>
                                <label for="pengusahaan" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Pengusahaan
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="penggunaan" name="jenis_izin" value="penggunaan" class="hidden peer" {{ old('jenis_izin', $application->jenis_izin) == 'penggunaan' ? 'checked' : '' }}>
                                <label for="penggunaan" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Penggunaan
                                </label>
                            </div>
                        </div>
                        @error('jenis_izin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Sub Jenis Izin - Penggunaan -->
                        <div id="penggunaan_options" class="mt-4 grid grid-cols-1 gap-3 {{ old('jenis_izin', $application->jenis_izin) == 'penggunaan' ? '' : 'hidden' }}">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sub Jenis Izin - Penggunaan</label>
                            <div>
                                <input type="radio" id="penggunaan_1" name="sub_jenis_izin" value="Penggunaan Sumber Daya Air sebagai Media" class="hidden peer" {{ old('sub_jenis_izin', $application->sub_jenis_izin) == 'Penggunaan Sumber Daya Air sebagai Media' ? 'checked' : '' }}>
                                <label for="penggunaan_1" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Penggunaan Sumber Daya Air sebagai Media
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="penggunaan_2" name="sub_jenis_izin" value="Penggunaan Air dan Daya Air sebagai Materi" class="hidden peer" {{ old('sub_jenis_izin', $application->sub_jenis_izin) == 'Penggunaan Air dan Daya Air sebagai Materi' ? 'checked' : '' }}>
                                <label for="penggunaan_2" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Penggunaan Air dan Daya Air sebagai Materi
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="penggunaan_3" name="sub_jenis_izin" value="Penggunaan Sumber Air sebagai Media" class="hidden peer" {{ old('sub_jenis_izin', $application->sub_jenis_izin) == 'Penggunaan Sumber Air sebagai Media' ? 'checked' : '' }}>
                                <label for="penggunaan_3" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Penggunaan Sumber Air sebagai Media
                                </label>
                            </div>
                        </div>

                        <!-- Sub Jenis Izin - Pengusahaan -->
                        <div id="pengusahaan_options" class="mt-4 grid grid-cols-1 gap-3 {{ old('jenis_izin', $application->jenis_izin) == 'pengusahaan' ? '' : 'hidden' }}">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sub Jenis Izin - Pengusahaan</label>
                            <div>
                                <input type="radio" id="pengusahaan_1" name="sub_jenis_izin" value="Pengusahaan Sumber Daya Air sebagai Media" class="hidden peer" {{ old('sub_jenis_izin', $application->sub_jenis_izin) == 'Pengusahaan Sumber Daya Air sebagai Media' ? 'checked' : '' }}>
                                <label for="pengusahaan_1" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Pengusahaan Sumber Daya Air sebagai Media
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="pengusahaan_2" name="sub_jenis_izin" value="Pengusahaan Sumber Daya Air sebagai Materi" class="hidden peer" {{ old('sub_jenis_izin', $application->sub_jenis_izin) == 'Pengusahaan Sumber Daya Air sebagai Materi' ? 'checked' : '' }}>
                                <label for="pengusahaan_2" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Pengusahaan Sumber Daya Air sebagai Materi
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="pengusahaan_3" name="sub_jenis_izin" value="Pengusahaan Sumber air sebagai media" class="hidden peer" {{ old('sub_jenis_izin', $application->sub_jenis_izin) == 'Pengusahaan Sumber air sebagai media' ? 'checked' : '' }}>
                                <label for="pengusahaan_3" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Pengusahaan Sumber air sebagai media
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="pengusahaan_4" name="sub_jenis_izin" value="Pengusahaan Air, Sumber Air, dan/atau Daya Air" class="hidden peer" {{ old('sub_jenis_izin', $application->sub_jenis_izin) == 'Pengusahaan Air, Sumber Air, dan/atau Daya Air' ? 'checked' : '' }}>
                                <label for="pengusahaan_4" class="block w-full p-4 text-sm border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-50">
                                    Pengusahaan Air, Sumber Air, dan/atau Daya Air
                                </label>
                            </div>
                        </div>
                        @error('sub_jenis_izin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Lokasi dan Alamat</h3>
                        
                        <div class="map-section">
                            <div>
                                <div class="map-wrapper">
                                    <div class="map-container">
                                        <div id="mapid"></div>
                                    </div>
                                    <div class="map-overlay">
                                        <div class="map-instructions">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            Klik pada peta atau geser pin untuk memilih lokasi
                                        </div>
                                    </div>
                                </div>

                                <div class="coordinates-display mt-4">
                                    <div class="coordinates-header">
                                        <i class="fas fa-map-marker-alt text-blue-500"></i>
                                        <span>Koordinat Lokasi</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                                            <input type="text" 
                                                   id="latitude" 
                                                   name="latitude" 
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                   value="{{ old('latitude', $application->latitude ?? '') }}" 
                                                   required
                                                   readonly>
                                            @error('latitude')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                                            <input type="text" 
                                                   id="longitude" 
                                                   name="longitude" 
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                   value="{{ old('longitude', $application->longitude ?? '') }}" 
                                                   required
                                                   readonly>
                                            @error('longitude')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                    <textarea id="alamat" 
                                              name="alamat" 
                                              rows="3" 
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                              required
                                              placeholder="Masukkan alamat lengkap">{{ old('alamat', $application->alamat) }}</textarea>
                                    @error('alamat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                                    <input type="text" 
                                           id="provinsi" 
                                           name="provinsi" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                           value="{{ old('provinsi', $application->provinsi) }}" 
                                           required
                                           placeholder="Masukkan provinsi">
                                    @error('provinsi')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                    <input type="text" 
                                           id="kabupaten" 
                                           name="kabupaten" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                           value="{{ old('kabupaten', $application->kabupaten) }}" 
                                           required
                                           placeholder="Masukkan kabupaten/kota">
                                    @error('kabupaten')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="nama_pekerjaan" class="block text-sm font-medium text-gray-700">Nama Pekerjaan</label>
                            <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('nama_pekerjaan', $application->nama_pekerjaan) }}">
                            @error('nama_pekerjaan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="lokasi_pekerjaan" class="block text-sm font-medium text-gray-700">Lokasi Pekerjaan</label>
                            <textarea name="lokasi_pekerjaan" id="lokasi_pekerjaan" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('lokasi_pekerjaan', $application->lokasi_pekerjaan) }}</textarea>
                            @error('lokasi_pekerjaan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Form Berkaitan Air/Daya air</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="tujuan" class="block text-sm font-medium text-gray-700">Tujuan</label>
                                    <textarea name="tujuan" id="tujuan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('tujuan', $application->tujuan) }}</textarea>
                                    @error('tujuan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="cara_pengambilan" class="block text-sm font-medium text-gray-700">Cara Pengambilan</label>
                                    <input type="text" name="cara_pengambilan" id="cara_pengambilan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('cara_pengambilan', $application->cara_pengambilan) }}">
                                    @error('cara_pengambilan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="volume_pengambilan" class="block text-sm font-medium text-gray-700">Volume Pengambilan (m³)</label>
                                    <input type="number" step="0.01" name="volume_pengambilan" id="volume_pengambilan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('volume_pengambilan', $application->volume_pengambilan) }}">
                                    @error('volume_pengambilan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jenis_konstruksi" class="block text-sm font-medium text-gray-700">Jenis Konstruksi</label>
                                    <input type="text" name="jenis_konstruksi" id="jenis_konstruksi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('jenis_konstruksi', $application->jenis_konstruksi) }}">
                                    @error('jenis_konstruksi')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jadwal_pelaksanaan" class="block text-sm font-medium text-gray-700">Jadwal Pelaksanaan (Bulan)</label>
                                    <input type="number" name="jadwal_pelaksanaan" id="jadwal_pelaksanaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('jadwal_pelaksanaan', $application->jadwal_pelaksanaan) }}">
                                    @error('jadwal_pelaksanaan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="rencana_pelaksanaan_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai Pelaksanaan</label>
                                    <input type="date" name="rencana_pelaksanaan_mulai" id="rencana_pelaksanaan_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('rencana_pelaksanaan_mulai', $application->rencana_pelaksanaan_mulai?->format('Y-m-d')) }}">
                                    @error('rencana_pelaksanaan_mulai')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="rencana_pelaksanaan_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai Pelaksanaan</label>
                                    <input type="date" name="rencana_pelaksanaan_selesai" id="rencana_pelaksanaan_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('rencana_pelaksanaan_selesai', $application->rencana_pelaksanaan_selesai?->format('Y-m-d')) }}">
                                    @error('rencana_pelaksanaan_selesai')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6">
                        <a href="{{ route('rekomtek.step1') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                            Lanjut
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle radio button changes for jenis izin
            const pengusahaanRadio = document.getElementById('pengusahaan');
            const penggunaanRadio = document.getElementById('penggunaan');
            const pengusahaanOptions = document.getElementById('pengusahaan_options');
            const penggunaanOptions = document.getElementById('penggunaan_options');

            function toggleOptions() {
                if (pengusahaanRadio.checked) {
                    pengusahaanOptions.classList.remove('hidden');
                    penggunaanOptions.classList.add('hidden');
                } else if (penggunaanRadio.checked) {
                    penggunaanOptions.classList.remove('hidden');
                    pengusahaanOptions.classList.add('hidden');
                }
            }

            pengusahaanRadio.addEventListener('change', toggleOptions);
            penggunaanRadio.addEventListener('change', toggleOptions);

            // Initialize map
            const defaultLat = {{ old('latitude', $application->latitude ?? -7.983908) }};
            const defaultLng = {{ old('longitude', $application->longitude ?? 112.621391) }};
            
            const map = L.map('mapid').setView([defaultLat, defaultLng], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: ' OpenStreetMap contributors'
            }).addTo(map);

            // Add geocoder control
            const geocoder = L.Control.Geocoder.nominatim();
            L.Control.geocoder({
                geocoder: geocoder,
                defaultMarkGeocode: false
            })
            .on('markgeocode', function(e) {
                const latlng = e.geocode.center;
                marker.setLatLng(latlng);
                map.setView(latlng, 16);
                updateCoordinates(latlng);
                
                // Update address fields
                const address = e.geocode.properties;
                document.getElementById('alamat').value = [
                    address.street,
                    address.city,
                    address.state
                ].filter(Boolean).join(', ');
                
                if (address.state) {
                    document.getElementById('provinsi').value = address.state;
                }
                if (address.city) {
                    document.getElementById('kabupaten').value = address.city;
                }
            })
            .addTo(map);

            // Initialize marker with custom icon
            const markerIcon = L.divIcon({
                html: '<i class="fas fa-map-marker-alt text-blue-500 text-3xl"></i>',
                className: 'custom-marker-icon',
                iconSize: [25, 41],
                iconAnchor: [12, 41]
            });

            let marker = L.marker([defaultLat, defaultLng], {
                draggable: true,
                icon: markerIcon
            }).addTo(map);

            // Update coordinates on marker drag
            marker.on('dragend', function(e) {
                updateCoordinates(e.target.getLatLng());
            });

            // Handle map clicks
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateCoordinates(e.latlng);
            });

            function updateCoordinates(latlng) {
                const latInput = document.getElementById('latitude');
                const lngInput = document.getElementById('longitude');
                
                if (!latInput || !lngInput) return;
                
                latInput.value = latlng.lat.toFixed(6);
                lngInput.value = latlng.lng.toFixed(6);
                
                // Trigger input events
                latInput.dispatchEvent(new Event('input'));
                lngInput.dispatchEvent(new Event('input'));

                // Update marker popup
                marker.bindPopup(`
                    <div class="text-center p-2">
                        <strong class="block text-gray-700 mb-1">Lokasi yang dipilih</strong>
                        <span class="text-sm text-gray-600">${latlng.lat.toFixed(6)}, ${latlng.lng.toFixed(6)}</span>
                    </div>
                `).openPopup();
            }

            // Initialize coordinates if they exist
            if (defaultLat && defaultLng) {
                updateCoordinates({ lat: defaultLat, lng: defaultLng });
            }

            // Handle form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const jenisIzin = document.querySelector('input[name="jenis_izin"]:checked');
                const subJenisIzin = document.querySelector('input[name="sub_jenis_izin"]:checked');
                
                if (!jenisIzin) {
                    e.preventDefault();
                    alert('Silakan pilih jenis izin');
                    return;
                }
                
                if (!subJenisIzin) {
                    e.preventDefault();
                    alert('Silakan pilih sub jenis izin');
                    return;
                }
            });
        });
    </script>
@endsection

@push('scripts')
    @yield('scripts')
@endpush
