@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Edit Application</h2>
                    <a href="{{ route('admin.applications.show', $application->id) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Back to Details
                    </a>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong>Please fix the following errors:</strong>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.applications.update', $application->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                            
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $application->nama) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $application->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="instansi" class="block text-sm font-medium text-gray-700">Institution</label>
                                <input type="text" name="instansi" id="instansi" value="{{ old('instansi', $application->instansi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="jabatan" class="block text-sm font-medium text-gray-700">Position</label>
                                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $application->jabatan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                                <input type="text" name="nik" id="nik" value="{{ old('nik', $application->nik) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $application->no_hp) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <!-- Application Details -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Application Details</h3>
                            
                            <div>
                                <label for="jenis_pemohon" class="block text-sm font-medium text-gray-700">Applicant Type</label>
                                <select name="jenis_pemohon" id="jenis_pemohon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="perorangan" {{ old('jenis_pemohon', $application->jenis_pemohon) === 'perorangan' ? 'selected' : '' }}>Individual</option>
                                    <option value="perusahaan" {{ old('jenis_pemohon', $application->jenis_pemohon) === 'perusahaan' ? 'selected' : '' }}>Company</option>
                                </select>
                            </div>

                            <div>
                                <label for="jenis_izin" class="block text-sm font-medium text-gray-700">Permit Type</label>
                                <input type="text" name="jenis_izin" id="jenis_izin" value="{{ old('jenis_izin', $application->jenis_izin) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="sub_jenis_izin" class="block text-sm font-medium text-gray-700">Permit Sub-type</label>
                                <input type="text" name="sub_jenis_izin" id="sub_jenis_izin" value="{{ old('sub_jenis_izin', $application->sub_jenis_izin) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="nama_pekerjaan" class="block text-sm font-medium text-gray-700">Work Name</label>
                                <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" value="{{ old('nama_pekerjaan', $application->nama_pekerjaan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="lokasi_pekerjaan" class="block text-sm font-medium text-gray-700">Work Location</label>
                                <input type="text" name="lokasi_pekerjaan" id="lokasi_pekerjaan" value="{{ old('lokasi_pekerjaan', $application->lokasi_pekerjaan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="provinsi" class="block text-sm font-medium text-gray-700">Province</label>
                                    <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', $application->provinsi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label for="kabupaten" class="block text-sm font-medium text-gray-700">City/Regency</label>
                                    <input type="text" name="kabupaten" id="kabupaten" value="{{ old('kabupaten', $application->kabupaten) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                                    <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude', $application->latitude) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                                    <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude', $application->longitude) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="space-y-4 mt-6">
                        <h3 class="text-lg font-medium text-gray-900">Additional Details</h3>

                        <div>
                            <label for="tujuan" class="block text-sm font-medium text-gray-700">Purpose</label>
                            <textarea name="tujuan" id="tujuan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('tujuan', $application->tujuan) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="cara_pengambilan" class="block text-sm font-medium text-gray-700">Collection Method</label>
                                <input type="text" name="cara_pengambilan" id="cara_pengambilan" value="{{ old('cara_pengambilan', $application->cara_pengambilan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="volume_pengambilan" class="block text-sm font-medium text-gray-700">Collection Volume</label>
                                <input type="number" step="0.01" name="volume_pengambilan" id="volume_pengambilan" value="{{ old('volume_pengambilan', $application->volume_pengambilan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div>
                            <label for="jenis_konstruksi" class="block text-sm font-medium text-gray-700">Construction Type</label>
                            <input type="text" name="jenis_konstruksi" id="jenis_konstruksi" value="{{ old('jenis_konstruksi', $application->jenis_konstruksi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div>
                            <label for="jadwal_pelaksanaan" class="block text-sm font-medium text-gray-700">Implementation Schedule</label>
                            <input type="text" name="jadwal_pelaksanaan" id="jadwal_pelaksanaan" value="{{ old('jadwal_pelaksanaan', $application->jadwal_pelaksanaan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="rencana_pelaksanaan_mulai" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="rencana_pelaksanaan_mulai" id="rencana_pelaksanaan_mulai" value="{{ old('rencana_pelaksanaan_mulai', $application->rencana_pelaksanaan_mulai->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="rencana_pelaksanaan_selesai" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="rencana_pelaksanaan_selesai" id="rencana_pelaksanaan_selesai" value="{{ old('rencana_pelaksanaan_selesai', $application->rencana_pelaksanaan_selesai->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.applications.show', $application->id) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
