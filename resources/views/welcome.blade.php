<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/img/Bondowoso.png') }}" type="image/svg+xml">
    <title>E-Rekomtek PUSDA Bondowoso</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .hero-section {
            background-image: linear-gradient(rgba(37, 24, 90, 0.9), rgba(37, 24, 90, 0.9)), url("{{ asset('assets/img/bendungan-bendo.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .nav-link {
            @apply hover:text-primary-30 transition-colors duration-300;
        }
        
        .section-title {
            @apply font-bold text-3xl text-primary-50 mb-2;
        }
        
        .section-divider {
            @apply w-20 h-1 bg-primary-50 mb-8;
        }
        
        .content-wrapper {
            @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-secondary fixed w-full z-50 shadow-lg">
        <div class="content-wrapper">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="text-4xl text-primary-50 font-bold">E-Rekomtek</a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="nav-link">Home</a>
                    <a href="#about" class="nav-link">Tentang</a>
                    <a href="#guide" class="nav-link">Panduan</a>
                    <a href="#registration" class="nav-link">Pendaftaran</a>
                    @auth
                        <a href="/home" class="font-bold text-primary-50 hover:text-primary-30 transition-colors duration-300">
                            Welcome back, {{ Auth::user()->name }}
                        </a>
                    @else
                        <a href="/login" class="px-6 py-2 bg-primary-50 rounded-full text-white hover:bg-primary-30 transition-colors duration-300">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="bg-primary-50 min-h-screen flex items-center pt-16">
        <div class="content-wrapper">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="space-y-6">
                    <h1 class="text-white text-5xl font-bold leading-tight">
                        E-Rekomtek<br>PUSDA Bondowoso
                    </h1>
                    <p class="text-white text-xl">
                        Aplikasi untuk melayani permohonan rekomendasi teknis melalui media elektronik (online).
                    </p>
                    <a href="#registration" class="inline-block bg-secondary px-8 py-3 text-primary-50 font-bold rounded-full hover:bg-opacity-90 transition-colors duration-300">
                        Buat Permohonan
                    </a>
                </div>
                <div class="flex justify-center">
                    <img src="{{ asset('assets/img/Bondowoso.png') }}" alt="Kabupaten Bondowoso" class="w-96 h-96 object-contain">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-slate-100 py-20 scroll-mt-16">
        <div class="content-wrapper">
            <div class="text-center">
                <h2 class="section-title">TENTANG E-REKOMTEK</h2>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="mt-8 space-y-6 text-lg text-gray-700">
                <p>
                    Selamat datang dihalaman aplikasi permohonan rekomendasi teknis PUSDA Bondowoso melalui media
                    elektronik (online). Aplikasi dibuat untuk memudahkan Anda untuk mengirimkan dan memantau
                    permohonan Anda.
                </p>
                <p>
                    Jika Anda baru, Anda bisa memulai dengan mempelajari Panduan yang sudah disiapkan. Kami juga
                    menyiapkan nomor telepon dan email yang bisa dilihat pada bagian Hubungi Kami.
                </p>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="hero-section">
        <div class="content-wrapper text-center text-white">
            <h3 class="text-3xl font-bold mb-8">
                Dinas PU Sumber Daya Air Kabupaten Bondowoso
            </h3>
            <div class="max-w-3xl mx-auto">
                <p class="text-xl mb-6">
                    Pelayanan penerbitan rekomendasi teknis izin pengusahaan dan penggunaan sumber daya air
                    <strong class="block mt-2">"Berkas Lengkap" 23 Hari Kerja</strong>
                </p>
                <div class="text-2xl font-bold text-secondary space-y-2">
                    <p>GRATISSS!!!</p>
                    <p>BEBAS PUNGLI</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Guide Section -->
    <section id="guide" class="bg-slate-200 scroll-mt-16">
        <div class="content-wrapper">
            <div class="text-center">
                <h2 class="section-title">PANDUAN</h2>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="mt-8 space-y-6 text-lg text-gray-700">
                <p>
                    Berikut merupakan beberapa panduan mengenai aplikasi e-rekomtek yang dapat anda unduh
                </p>
            </div>
            <div class="flex justify-center mt-8">
                <button id="panduan" class="bg-primary-50 px-8 py-3 text-white font-bold rounded-full hover:bg-opacity-90 transition-colors duration-300">
                    E-Rekomtek
                </button>
                <button id="peraturan" class="bg-gray-200 px-8 py-3 text-gray-700 font-bold rounded-full hover:bg-gray-300 transition-colors duration-300">
                    Peraturan
                </button>
                <button id="tahapan" class="bg-gray-200 px-8 py-3 text-gray-700 font-bold rounded-full hover:bg-gray-300 transition-colors duration-300">
                    Tahapan & Alur
                </button>
            </div>
            <div id="detail-panduan" class="mt-8 space-y-6 text-lg text-gray-700">
                <h3 class="text-center font-bold text-2xl">
                    Panduan E-Rekomtek
                </h3>
                <p class="text-center">
                    Panduan penggunaan aplikai E-Rekomtek tersedia dalam berkas dengan format pdf.
                </p>
                <a href="" class="inline-block bg-primary-50 px-8 py-3 text-white font-bold rounded-full hover:bg-opacity-90 transition-colors duration-300">
                    Unduh
                </a>
            </div>
            <div id="detail-peraturan" class="hidden mt-8 space-y-6 text-lg text-gray-700">
                <h3 class="text-center font-bold text-2xl">
                    Peraturan
                </h3>
                <h4>Undang Undang</h4>
                <ol>
                    <li>
                        Undang Undang Nomor 17 Tahun 2019 - Sumber Daya Air | <a href="">Unduh</a>
                    </li>
                    <li>
                        Undang Undang Nomor 17 Tahun 2019 - Sumber Daya Air | <a href="">Unduh</a>
                    </li>
                </ol>
                <h4>Peraturan Pemerintah</h4>
                <ol>
                    <li>
                        Undang Undang Nomor 17 Tahun 2019 - Sumber Daya Air | <a href="">Unduh</a>
                    </li>
                    <li>
                        Undang Undang Nomor 17 Tahun 2019 - Sumber Daya Air | <a href="">Unduh</a>
                    </li>
                </ol>
                <h4>Peraturan Metri</h4>
                <ol>
                    <li>
                        Undang Undang Nomor 17 Tahun 2019 - Sumber Daya Air | <a href="">Unduh</a>
                    </li>
                    <li>
                        Undang Undang Nomor 17 Tahun 2019 - Sumber Daya Air | <a href="">Unduh</a>
                    </li>
                </ol>
            </div>
            <div id="detail-tahapan" class="hidden mt-8 space-y-6 text-lg text-gray-700">
                <h3 class="text-center font-bold text-2xl">
                    Tahapan & Alur
                </h3>
                <img src="https://bbwsbengawansolo.id/erekomtek/img/hero-2.png" alt="">
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section id="registration" class="bg-slate-300 scroll-mt-16">
        <div class="content-wrapper">
            <div class="text-center">
                <h2 class="section-title">Pendaftaran E-Rekomtek</h2>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="mt-8 space-y-6 text-lg text-gray-700">
                <p>
                    Sebelum melakukan permohonan, pastikan lokasi permohonan anda berada pada Wilayah Layanan Dinas
                    PU SDA Kabupaten Bondowoso. Anda dapat melakukan pengecekan pada tautan berikut Check Lokasi
                    Permohonan. Setelah lokasi permohonan anda sudah benar pada Wilayah Layanan Dinas PU SDA
                    Kabupaten Bondowoso, silahkan klik tombol dibawah
                </p>
            </div>
            <a href="" class="inline-block bg-primary-50 px-8 py-3 text-white font-bold rounded-full hover:bg-opacity-90 transition-colors duration-300">
                Buat Permohonan
            </a>
        </div>
    </section>

    <!-- Footer Section -->
    <section class="bg-slate-200">
        <div class="content-wrapper">
            <div class="grid grid-cols-3 gap-8 py-12">
                <div class="space-y-4">
                    <h3 class="font-bold text-2xl text-primary-50">
                        PUSDA Bondowoso
                    </h3>
                    <p>
                        Kabupaten Bondowoso
                    </p>
                    <div>
                        <p>
                            <strong>Phone: </strong>(0271) 716071
                        </p>
                        <p>
                            <strong>Email: </strong>bondowoso@pu.go.id
                        </p>
                    </div>
                </div>
                <div></div>
                <div class="space-y-4">
                    <h4 class="font-bold text-md text-primary-50">
                        Our Social Networks
                    </h4>
                    <p>
                        Follow our social media to know the newest information :
                    </p>
                    <div class="flex gap-4">
                        <a href="" target="__blank">
                            <div class="w-10 h-10 flex justify-center items-center rounded-full bg-primary-50">
                                <i class="fa-brands fa-facebook-f"></i>
                            </div>
                        </a>
                        <a href="" target="__blank">
                            <div class="w-10 h-10 flex justify-center items-center rounded-full bg-primary-50">
                                <i class="fa-brands fa-instagram text-xl"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright Section -->
    <section class="bg-primary-90">
        <div class="content-wrapper">
            <div class="flex justify-between py-4 text-sm text-white">
                <p>
                    &copy; Copyright <strong>PUSDA Bondowoso Kabupaten Bondowoso.</strong> All Rights Reserved
                </p>
                <p>
                    Designed by Studiotopo
                </p>
            </div>
        </div>
    </section>

    <script>
        const panduanButton = document.getElementById('panduan');
        const peraturanButton = document.getElementById('peraturan');
        const tahapanButton = document.getElementById('tahapan');
        const panduanDetail = document.getElementById('detail-panduan');
        const peraturanDetail = document.getElementById('detail-peraturan');
        const tahapanDetail = document.getElementById('detail-tahapan');

        panduanButton.addEventListener('click', () => {
            setActiveButton('panduan');
            showDetail('detail-panduan');
        });

        peraturanButton.addEventListener('click', () => {
            setActiveButton('peraturan');
            showDetail('detail-peraturan');
        });

        tahapanButton.addEventListener('click', () => {
            setActiveButton('tahapan');
            showDetail('detail-tahapan');
        });

        function showDetail(activeDetailId) {
            const details = [panduanDetail, peraturanDetail, tahapanDetail];

            details.forEach((detail) => {
                if (detail.id === activeDetailId) {
                    detail.classList.remove('hidden');
                } else {
                    detail.classList.add('hidden');
                }
            });
        }

        function setActiveButton(activeButtonId) {
            const buttons = [panduanButton, peraturanButton, tahapanButton];

            buttons.forEach((button) => {
                if (button.id === activeButtonId) {
                    button.classList.add('bg-primary-50', 'rounded-full', 'text-white');
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                } else {
                    button.classList.remove('bg-primary-50', 'rounded-full', 'text-white');
                    button.classList.add('bg-gray-200', 'text-gray-700');
                }
            });
        }

        window.addEventListener("scroll", () => {
            const header = document.getElementById("nav");
            const scrollPosition = window.scrollY;

            if (scrollPosition > 0) {
                header.classList.replace('bg-opacity-100', 'bg-opacity-80');
                header.classList.replace('bg-slate-500', 'bg-slate-800');
            } else {
                header.classList.replace('bg-opacity-80', 'bg-opacity-100');
                header.classList.replace('bg-slate-800', 'bg-slate-500');
            }
        });
    </script>
</body>

</html>
