@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-semibold text-gray-800">Detail Permohonan</h2>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Status Section -->
                <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Status Permohonan</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($application->status === 'review') bg-blue-100 text-blue-800
                                    @elseif($application->status === 'approved') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button" 
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Update Status
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                <div class="py-1" role="menu" aria-orientation="vertical">
                                    @if($application->status !== 'review')
                                        <form action="{{ route('admin.applications.update.status', $application->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="review">
                                            <div class="px-4 py-2">
                                                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                                                <textarea name="catatan" rows="2"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                                    placeholder="Tambahkan catatan..."></textarea>
                                            </div>
                                            <button type="submit" 
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Set to Review
                                            </button>
                                        </form>
                                    @endif

                                    @if($application->status === 'review')
                                        <form action="{{ route('admin.applications.update.status', $application->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <div class="px-4 py-2">
                                                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                                                <textarea name="catatan" rows="2"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                                    placeholder="Tambahkan catatan..."></textarea>
                                            </div>
                                            <button type="submit" 
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Set to Approved
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.applications.update.status', $application->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <div class="px-4 py-2">
                                                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                                                <textarea name="catatan" rows="2"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                                    placeholder="Tambahkan catatan..."></textarea>
                                            </div>
                                            <button type="submit" 
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Set to Rejected
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($application->catatan)
                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-700">Catatan:</h4>
                        <p class="mt-1 text-sm text-gray-600">{{ $application->catatan }}</p>
                    </div>
                    @endif
                </div>

                <!-- Applicant Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pemohon</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama Pemohon</p>
                            <p class="mt-1">{{ $application->nama }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="mt-1">{{ $application->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jenis Permohonan</p>
                            <p class="mt-1">{{ ucfirst($application->jenis_pemohon) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Pengajuan</p>
                            <p class="mt-1">{{ $application->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">No. HP</p>
                            <p class="mt-1">{{ $application->no_hp }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">NIK</p>
                            <p class="mt-1">{{ $application->nik }}</p>
                        </div>
                    </div>
                </div>

                <!-- Application Details -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Permohonan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jenis Izin</p>
                            <p class="mt-1">{{ ucfirst($application->jenis_izin) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Sub Jenis Izin</p>
                            <p class="mt-1">{{ ucfirst($application->sub_jenis_izin) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama Pekerjaan</p>
                            <p class="mt-1">{{ $application->nama_pekerjaan }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lokasi Pekerjaan</p>
                            <p class="mt-1">{{ $application->lokasi_pekerjaan }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Provinsi</p>
                            <p class="mt-1">{{ $application->provinsi }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Kabupaten</p>
                            <p class="mt-1">{{ $application->kabupaten }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Koordinat</p>
                            <p class="mt-1">{{ $application->latitude }}, {{ $application->longitude }}</p>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen Pendukung</h3>
                    <div class="grid grid-cols-1 gap-4">
                        @forelse($application->documents as $document)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-150">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ ucwords(str_replace('_', ' ', $document->document_type)) }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $document->original_name ?? 'Document' }} 
                                        ({{ number_format($document->file_size / 1024, 2) }} KB)
                                    </p>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.documents.view', $document->id) }}" 
                                       target="_blank"
                                       class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('admin.documents.download', $document->id) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-500">Tidak ada dokumen yang diunggah</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection
