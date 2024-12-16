@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Daftar Permohonan Rekomendasi Teknis</h2>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Logout
                        </button>
                    </form>
                </div>

                <!-- Search and Filter -->
                <div class="flex justify-between items-center mb-6">
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex gap-4">
                        <select name="status" id="status-filter" class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="review" {{ request('status') === 'review' ? 'selected' : '' }}>Dalam Review</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <div class="flex gap-2">
                            <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}" 
                                class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search
                            </button>
                        </div>
                    </form>
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

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pengajuan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Izin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($applications as $application)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $application->getTrackingId() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $application->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $application->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $application->instansi }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ ucfirst($application->jenis_izin) }} - {{ ucfirst($application->sub_jenis_izin) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($application->status === 'review') bg-blue-100 text-blue-800
                                        @elseif($application->status === 'approved') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                    @if($application->catatan)
                                        <div class="text-xs text-gray-500 mt-1">
                                            Catatan: {{ $application->catatan }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center space-x-2">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.applications.show', $application->id) }}" 
                                            class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white rounded-md">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            View
                                        </a>

                                        <!-- Status Dropdown -->
                                        <div class="relative inline-block text-left" x-data="{ open: false }">
                                            <button @click="open = !open" type="button" 
                                                class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-700 text-white rounded-md focus:outline-none">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                                Status
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
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection
