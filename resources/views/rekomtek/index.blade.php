<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/img/Bondowoso.png') }}" type="image/svg+xml">
    <title>Dashboard</title>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            10: '#F3F1F9',
                            20: '#DED8EF',
                            30: '#C9BEE5',
                            40: '#B4A4DB',
                            50: '#25185A',
                            60: '#1F144D',
                            70: '#191040',
                            80: '#140C33',
                            90: '#0F0826',
                        },
                        secondary: '#FAD605',
                    }
                }
            }
        }
    </script>
</head>

<body>
    <section id="nav"
        class="bg-secondary bg-opacity-100 transition-color ease-in-out delay-150 duration-700 fixed top-0 left-0 w-full z-50">
        <div class="flex flex-col items-center">
            <div class="lg:w-[1170px] p-3 text-primary flex justify-between items-center">
                <a href="">
                    <h1 class="text-4xl text-primary-50 font-bold">
                        E-Rekomtek
                    </h1>
                </a>
                <nav>
                    <ul class="flex gap-10 font-medium">
                        <li>
                            <a href="#home" class="hover:text-slate-500 transition ease-in-out duration-300">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#about" class="hover:text-slate-500 transition ease-in-out duration-300">
                                Tentang
                            </a>
                        </li>
                        <li>
                            <a href="#guide" class="hover:text-slate-500 transition ease-in-out duration-300">
                                Panduan
                            </a>
                        </li>
                        <li>
                            <a href="#registration" class="hover:text-slate-500 transition ease-in-out duration-300">
                                Pendaftaran
                            </a>
                        </li>
                        <li>
                            @auth
                            <a href="/admin/dashboard" class="font-bold text-primary-50 hover:text-slate-500 transition ease-in-out duration-300">
                                Welcome back, {{ Auth::user()->name }}
                            </a>
                            @else
                                <a href="{{ url('/admin/login') }}"
                                    class="p-3 px-6 bg-primary-50 rounded-full text-white hover:bg-primary-30 hover:text-primary-50">
                                    Login
                                </a>
                            @endauth
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <section id="home" class="bg-primary-50">
        <div class="flex flex-col items-center">
            <div class="grid grid-cols-2 items-center lg:w-[1170px] h-[700px]">
                <div class="flex flex-col p-3 gap-3">
                    <h1 class="text-white text-4xl font-bold">
                        E-Rekomtek<br>PUSDA Bondowoso
                    </h1>
                    <p class="text-white text-xl font-bold">
                        Aplikasi untuk melayani permohonan rekomendasi teknis melalui media elektronik (online).
                    </p>
                    <a href="#registration"
                        class="mt-16 bg-secondary w-fit px-4 py-2 text-primary font-bold rounded-full">
                        Buat Permohonan
                    </a>
                </div>
                <div class="p-3">
                    <img src="{{ asset('assets/img/Bondowoso.png') }}" alt="Kabupaten Bondowoso" height="400px"
                        width="400px">
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="bg-slate-200 scroll-mt-16">
        <div class="flex flex-col items-center">
            <div class="lg:w-[1170px] px-3 my-10 flex flex-col items-center">
                <div class="mt-10 flex flex-col items-center">
                    <h2 class="font-bold text-3xl text-primary-50">
                        TENTANG E-REKOMTEK
                    </h2>
                    <div class="w-20 h-1 bg-primary-50 my-3"></div>
                </div>
                <div class="flex flex-col gap-3 text-justify text-xl my-10">
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
        </div>
    </section>
    <div class="bg-[url('{{ asset('assets/img/bendungan-bendo.jpeg') }}')] bg-no-repeat bg-cover bg-fixed">
        <section class="bg-primary-90 bg-opacity-80">
            <div class="flex flex-col items-center">
                <div class="lg:w-[1170px] px-3 my-40 flex flex-col items-center">
                    <div class="text-white text-center">
                        <h3 class="font-bold text-2xl">
                            Dinas PU Sumber Daya Air Kabupaten Bondowoso
                        </h3>
                        <div class="text-lg mt-10">
                            <p>Pelayanan penerbitan rekomendasi teknis izin pengusahaan dan penggunaan sumber daya air
                                <strong>"Berkas Lengkap" 23 Hari Kerja</strong>
                            </p>
                            <div class="font-bold mt-2 text-xl text-secondary">
                                <p>GRATISSS!!!</p>
                                <p>BEBAS PUNGLI</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section id="guide" class="bg-slate-200 scroll-mt-16">
        <div class="flex flex-col items-center">
            <div class="lg:w-[1170px] px-3 my-20 flex flex-col items-center">
                <div class=" flex flex-col items-center">
                    <h2 class="font-bold text-3xl text-primary-50">
                        PANDUAN
                    </h2>
                    <div class="w-20 h-1 bg-primary-50 my-3"></div>
                </div>
                <div class="flex flex-col gap-3 text-center text-lg">
                    <p>
                        Berikut merupakan beberapa panduan mengenai aplikasi e-rekomtek yang dapat anda unduh
                    </p>
                </div>
                <div class="my-10 flex gap-10 items-center justify-center font-medium">
                    <button id="panduan"
                        class="transition-all duration-500 ease-in-out py-3 px-4 bg-primary-50 rounded-full text-white">
                        E-Rekomtek
                    </button>
                    <button id="peraturan" class="transition-all duration-500 ease-in-out py-3 px-4 text-black">
                        Peraturan
                    </button>
                    <button id="tahapan" class="transition-all duration-500 ease-in-out py-3 px-4 text-black">
                        Tahapan & Alur
                    </button>
                </div>
                <div id="detail-panduan" class="flex flex-col items-center">
                    <h3 class="text-center font-medium text-3xl">
                        Panduan E-Rekomtek
                    </h3>
                    <p class="text-center text-lg my-10">
                        Panduan penggunaan aplikai E-Rekomtek tersedia dalam berkas dengan format pdf.
                    </p>
                    <a href="" class="bg-primary-50 font-medium py-4 px-10 rounded-full text-white">
                        Unduh
                    </a>
                </div>
                <div id="detail-peraturan" class="flex flex-col hidden">
                    <h3 class="text-center font-medium text-3xl">
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
                <div id="detail-tahapan" class="flex flex-col items-center hidden">
                    <h3 class="text-center font-medium text-3xl">
                        Tahapan & Alur
                    </h3>
                    <img src="https://bbwsbengawansolo.id/erekomtek/img/hero-2.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="registration" class="bg-slate-300 scroll-mt-16">
        <div class="flex flex-col items-center">
            <div class="lg:w-[1170px] px-3 my-20 flex flex-col items-center">
                <div class=" flex flex-col items-center">
                    <h2 class="font-bold text-3xl text-primary-50">
                        Pendaftaran E-Rekomtek
                    </h2>
                    <div class="w-20 h-1 bg-primary-50 my-3"></div>
                </div>
                <div class="flex flex-col gap-3 text-center text-lg">
                    <p>
                        Sebelum melakukan permohonan, pastikan lokasi permohonan anda berada pada Wilayah Layanan Dinas
                        PU SDA Kabupaten Bondowoso. Anda dapat melakukan pengecekan pada tautan berikut Check Lokasi
                        Permohonan. Setelah lokasi permohonan anda sudah benar pada Wilayah Layanan Dinas PU SDA
                        Kabupaten Bondowoso, silahkan klik tombol dibawah
                    </p>
                </div>
                <a href="{{ route('rekomtek.step1') }}" class="bg-primary-50 font-medium py-4 px-10 rounded-full text-white mt-5">
                    Buat Permohonan
                </a>
            </div>
        </div>
    </section>
    <section class="bg-slate-200">
        <div class="flex flex-col items-center">
            <div class="lg:w-[1170px] px-3 my-10 grid grid-cols-3">
                <div class="flex flex-col gap-4">
                    <h3 class="font-bold text-3xl text-primary-50">
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
                <div>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="font-bold text-md text-primary-50">
                        Our Social Networks
                    </h4>
                    <p>
                        Follow our social media to know the newest information :
                    </p>
                    <div class="flex gap-3 text-white">
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
    <section class="bg-primary-90">
        <div class="flex flex-col items-center">
            <div class="lg:w-[1170px] text-white text-sm flex justify-between px-3 py-5">
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
                    button.classList.remove('text-black');
                } else {
                    button.classList.remove('bg-primary-50', 'rounded-full', 'text-white');
                    button.classList.add('text-black');
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
