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
                            <a href="{{ route('admin.applications.edit', $application->id) }}" 
                               class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Edit
                            </a>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

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
                        <button onclick="openStatusModal('{{ $application->id }}', '{{ $application->status }}')" 
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Update Status
                        </button>
                    </div>
                    @if($application->admin_notes)
                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-700">Catatan Admin:</h4>
                        <p class="mt-1 text-sm text-gray-600">{{ $application->admin_notes }}</p>
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

<!-- Status Update Modal -->
<div id="statusModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Update Status Permohonan
                </h3>
                <div class="mt-4">
                    <div class="mb-4">
                        <label for="statusSelect" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="statusSelect" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="pending">Pending</option>
                            <option value="review">Dalam Review</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="adminNotes" class="block text-sm font-medium text-gray-700">Catatan Admin</label>
                        <textarea id="adminNotes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="updateStatus()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Update
                </button>
                <button type="button" onclick="closeStatusModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openStatusModal(applicationId, currentStatus) {
        document.getElementById('statusSelect').value = currentStatus;
        document.getElementById('adminNotes').value = '{{ $application->admin_notes }}';
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    function updateStatus() {
        const status = document.getElementById('statusSelect').value;
        const adminNotes = document.getElementById('adminNotes').value;

        fetch(`/admin/applications/{{ $application->id }}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status, admin_notes: adminNotes })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the status');
        });
    }
</script>
@endpush
