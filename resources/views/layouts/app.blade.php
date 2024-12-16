<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/Bondowoso.png') }}" type="image/svg+xml">
    
    <title>Form Permohonan Rekomtek</title>
    @vite(['resources/css/app.css'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <style>
        [x-cloak] { display: none !important; }
        
        .form-input {
            @apply mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-50 focus:ring focus:ring-primary-30 focus:ring-opacity-50 transition-colors duration-200;
        }
        
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-1;
        }
        
        .form-error {
            @apply mt-1 text-sm text-red-600;
        }
        
        .btn {
            @apply px-4 py-2 rounded-lg font-semibold transition-colors duration-200 flex items-center justify-center;
        }
        
        .btn-primary {
            @apply bg-primary-50 text-white hover:bg-primary-40 focus:outline-none focus:ring-2 focus:ring-primary-50 focus:ring-opacity-50;
        }
        
        .btn-secondary {
            @apply bg-gray-200 text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50;
        }

        .progress-steps {
            @apply relative flex justify-between mb-12;
        }

        .progress-steps::before {
            content: '';
            @apply absolute top-5 left-0 w-full h-1 bg-gray-200;
            z-index: 0;
        }

        .progress-step {
            @apply relative flex flex-col items-center;
            z-index: 1;
        }

        .step-circle {
            @apply w-10 h-10 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300;
        }

        .step-circle.active {
            @apply bg-primary-50 text-white;
        }

        .step-circle.inactive {
            @apply bg-gray-300 text-white;
        }

        .step-label {
            @apply mt-2 text-sm font-medium;
        }

        .step-label.active {
            @apply text-primary-50;
        }

        .step-label.inactive {
            @apply text-gray-500;
        }
    </style>
    @yield('styles')
</head>
<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <img src="{{ asset('assets/img/Bondowoso.png') }}" alt="Logo" class="h-8 w-auto">
                            <h1 class="ml-3 text-xl font-bold text-primary-50">Form Permohonan Rekomtek</h1>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="rounded-lg bg-green-100 p-4 mb-6" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="rounded-lg bg-red-100 p-4 mb-6" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
