@extends('layouts.app')

@section('content')
<div class="bg-white shadow-sm rounded-lg p-6 text-center">
    <div class="mb-6">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h2 class="text-2xl font-semibold text-gray-900">Permohonan Berhasil Diajukan!</h2>
        <p class="mt-2 text-sm text-gray-600">
            Nomor Permohonan Anda: <span class="font-medium">{{ sprintf('GNA%05d-%d', $application->id, date('Y')) }}</span>
        </p>
    </div>

    <div class="prose mx-auto">
        <p class="text-gray-600">
            Permohonan Anda telah berhasil diajukan dan akan segera diproses. Silakan simpan nomor permohonan Anda untuk keperluan tracking status permohonan.
        </p>
    </div>

    <div class="mt-6 flex justify-center space-x-4">
        {{-- <a href="{{ route('rekomtek.pdf', $application->id) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Cetak Form Permohonan
        </a> --}}
        <a href="{{ route('rekomtek.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
