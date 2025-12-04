@extends('layouts.public.app')

@section('content')
    {{-- hero start --}}
    <section id="beranda" class="relative w-full h-screen bg-cover bg-center" id="Hero"
        style="background-image: url('{{ asset('assets/images/bg-heroonboarding.png') }}');">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center text-white px-4 gap-[70px]">
            <h1 class="text-[45px] sm:text-[75px] md:text-[120px] font-bold leading-tight uppercase drop-shadow-lg">
                Wonderful<br>Jember
            </h1>

            <p class="max-w-5xl text-sm sm:text-lg md:text-xl  drop-shadow-md">
                Temukan keindahan alam yang memukau, mulai dari pantai eksotis, sejuknya perkebunan, hingga pesona
                pegunungan. Nikmati juga dinamika kota yang modern dan kaya akan budaya. Panduan lengkap
                untuk petualangan Anda!
            </p>

            @auth
                @if (Auth::user()->hasRole('user'))
                    <a href="{{ route('destinasi.showmore') }}">
                        <button
                            class="bg-indigo-300 hover:bg-indigo-400 transition text-neutral-900 text sm:text-xl md:text-2xl font-bold py-4 px-10 rounded-xl ">
                            Mulai Perjalananmu
                        </button>
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}">
                    <button
                        class="bg-indigo-300 hover:bg-indigo-400 transition text-neutral-900 text sm:text-xl md:text-2xl font-bold py-4 px-10 rounded-xl ">
                        Mulai Perjalananmu
                    </button>
                </a>
            @endauth

        </div>
    </section>

    {{-- hero end --}}

    {{-- About Start --}}
    <section class="pt-[50px] w-full px-16 pb-10" id="tentang">
        <div class="mt-[100px]" data-aos="fade-up" data-aos-anchor-placement="top-center" data-aos-duration="1000"
            data-aos-once="true">
            <div class="flex flex-col items-center gap-2 mb-20">
                <h2 class="text-[24px] sm:text-[35px] lg:text-[50px] font-bold text-nowrap text-center">Tentang J-Voyage
                </h2>
                <div class="bg-indigo-500 w-[150px] h-1">
                </div>
            </div>
            <div class="flex flex-col lg:flex-row gap-16 items-center justify-center">
                <img src="{{ asset('/assets/images/about.png') }}" alt="" class="w-[450px] xl:w-[650px] h-full">
                <div class="max-w-[600px]">
                    <h5 class="font-semibold text-xl lg:text-3xl mb-8 text-center">Misi Kami</h5>
                    <p class="mb-5 text-center max-w-[300px] md:max-w-full mx-auto">J-Voyage adalah platform booking wisata
                        terpercaya yang berdedikasi untuk menghadirkan pengalaman perjalanan terbaik di Jember. Kami percaya
                        bahwa setiap perjalanan adalah cerita yang menunggu untuk ditulis.</p>
                    <p class="mb-20 text-center max-w-[300px] md:max-w-full mx-auto">Dengan tim profesional dan
                        berpengalaman, kami memastikan setiap detail perjalanan Anda direncanakan dengan sempurna, dari
                        akomodasi hingga destinasi wisata yang menakjubkan.</p>
                    <div class="flex gap-16 justify-center flex-wrap">
                        <div class="flex flex-col items-center">
                            <p class="text-2xl font-bold text-indigo-500 ">500+</p>
                            <p>Happy Travelers</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="text-2xl font-bold text-indigo-500 ">50+</p>
                            <p>Destinations</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="text-2xl font-bold text-indigo-500 ">5★</p>
                            <p>Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex  justify-center items-center gap-2 lg:gap-16 mt-10 flex-wrap ">
            <div class="bg-indigo-50 flex-none shadow-sm hover:bg-indigo-100 transition hover:-translate-y-2 hover:shadow-lg lg:w-[400px] py-10 px-8 rounded-lg w-[300px]"
                data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000" data-aos-once="true">
                <img src="{{ asset('/assets/images/bintang.png') }}" alt=""
                    class="w-[65px] lg:w-[80px] h-auto mx-auto lg:mx-0">
                <h5 class="font-bold lg:text-xl text-md mt-5 lg:text-start text-center">Kualitas Terbaik</h5>
                <p class="text-center lg:text-justify opacity-80 text-sm md:text-[17px] ">Kami berkomitmen memberikan
                    layanan berkualitas tinggi dengan harga terjangkau untuk semua kalangan.</p>
            </div>
            <div class="bg-indigo-50 flex-none shadow-sm hover:bg-indigo-100 transition hover:-translate-y-2 hover:shadow-lg lg:w-[400px] py-10 px-8 rounded-lg w-[300px]"
                data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000" data-aos-once="true">
                <img src="{{ asset('/assets/images/loc-cont.png') }}" alt=""
                    class="w-[65px] lg:w-[80px] h-auto mx-auto lg:mx-0">
                <h5 class="font-bold lg:text-xl text-md mt-5 lg:text-start text-center">Destinasi Eksklusif</h5>
                <p class="text-center lg:text-justify opacity-80 text-sm md:text-[17px] ">Jelajahi tempat-tempat tersembunyi
                    dan destinasi eksklusif yang jarang dikunjungi wisatawan.</p>
            </div>
            <div class="bg-indigo-50 flex-none shadow-sm hover:bg-indigo-100 transition hover:-translate-y-2 hover:shadow-lg lg:w-[400px] py-10 px-8 rounded-lg w-[300px]"
                data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000" data-aos-once="true">
                <img src="{{ asset('/assets/images/time.png') }}" alt=""
                    class="w-[65px] lg:w-[80px] h-auto mx-auto lg:mx-0">
                <h5 class="font-bold lg:text-xl text-md mt-5 lg:text-start text-center">Tepat Waktu</h5>
                <p class="text-center lg:text-justify opacity-80 text-sm md:text-[17px] ">Jadwal yang teorganisir dengan
                    baik memastikan Anda tidak kehilangan momen berharga dalam perjalanan.</p>
            </div>


        </div>
    </section>
    {{-- About End --}}


    {{-- Destinasi Start --}}
    <section class="mt-[100px]" data-aos="fade-up" id="wisata" data-aos-anchor-placement="top-center"
        data-aos-duration="1000" data-aos-once="true">
        <div class="flex flex-col items-center gap-2 mb-16">
            <h2 class="text-[24px] sm:text-[35px] lg:text-[50px] font-bold text-center">Destinasi Wisata Populer</h2>
            <div class="bg-indigo-500 w-[150px] h-1">
            </div>
        </div>
        <p class="text-center max-w-[500px] mx-auto">Jelajahi keindahan Jember dengan paket wisata pilihan yang telah kami
            kurasi khusus untuk Anda</p>
        <div class="container mx-auto px-4 mt-16">

            <div class="flex overflow-x-auto space-x-6 pb-8 snap-x snap-mandatory no-scrollbar">

                @foreach ($destinasi as $item)
                    <div
                        class="flex-none w-80 h-96 bg-white rounded-2xl shadow-lg overflow-hidden snap-center border border-gray-100 transition hover:shadow-lg hover:shadow-indigo-500 hover:-translate-y-1 ">

                        <div class="relative h-48">
                            @if ($item->foto_wisata)
                                <img src="{{ Storage::url($item->foto_wisata) }}" alt="{{ $item->nama_wisata }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute top-4 right-4 bg-indigo-500/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="p-5 flex flex-col h-[calc(100%-12rem)]">
                            {{-- Lokasi --}}
                            <div class="flex items-center text-indigo-500 mb-2 text-xs font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $item->kecamatan->nama }}
                            </div>

                            {{-- Judul --}}
                            <h3 class="text-lg font-bold text-gray-900 mb-2 font-poppins leading-tight">
                                {{ $item->nama_wisata }}
                            </h3>

                            {{-- Deskripsi --}}
                            <p class="text-gray-500 text-xs leading-relaxed mb-6 line-clamp-3">
                                {{ $item->deskripsi_wisata }}
                            </p>

                            {{-- Tombol (mt-auto agar selalu di bawah) --}}
                            <div class="mt-auto">
                                <a href="{{ route('destinasi.show', $item->id) }}"
                                    class="block w-full text-center bg-indigo-400 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl text-sm transition duration-300 uppercase tracking-wide">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @auth
                    @if (Auth::user()->hasRole('user'))
                        <a href="{{ route('destinasi.showmore') }}" class="">
                            <div
                                class="flex-none w-80 h-96 bg-white rounded-2xl shadow-lg overflow-hidden snap-center border border-gray-100 transition  hover:shadow-lg hover:shadow-indigo-500  hover:-translate-y-1">
                                <div class="flex flex-col items-center justify-center h-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-circle-chevron-right-icon lucide-circle-chevron-right">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="m10 8 4 4-4 4" />
                                    </svg>
                                    <p class="font-semibold">Lihat Selengkapnya</p>
                                </div>
                            </div>
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="">
                        <div
                            class="flex-none w-80 h-96 bg-white rounded-2xl shadow-lg overflow-hidden snap-center border border-gray-100 transition  hover:shadow-lg hover:shadow-indigo-500  hover:-translate-y-1">
                            <div class="flex flex-col items-center justify-center h-full gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-circle-chevron-right-icon lucide-circle-chevron-right">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m10 8 4 4-4 4" />
                                </svg>
                                <p class="font-semibold">Lihat Selengkapnya</p>
                            </div>
                        </div>
                    </a>
                @endauth

            </div>
        </div>
    </section>
    {{-- Destinasi End --}}

    {{-- FAQ Start --}}


    <div class="mt-[100px]" data-aos="fade-up" id="faq" data-aos-anchor-placement="top-center"
        data-aos-duration="1000" data-aos-once="true">

        <div class="flex flex-col items-center gap-2 mb-10">
            <h2 class="text-[24px] sm:text-[35px] lg:text-[50px] font-bold text-center">JAWABAN ATAS PERTANYAAN ANDA</h2>
            <div class="bg-indigo-500 w-[150px] h-1"></div>
        </div>
        <p class="text-center max-w-[500px] mx-auto">Temukan jawaban untuk pertanyaan umum seputar layanan J-Voyage</p>

        <div class="max-w-6xl mx-auto mt-10">
            <div class="hs-accordion-group">

                <div class="hs-accordion group bg-white mb-5 hover:border-2 hover:border-indigo-300 transition rounded-xl p-6"
                    id="faq-heading-one">
                    <button
                        class="hs-accordion-toggle w-full flex items-center justify-between gap-x-3 md:text-lg font-semibold text-start text-gray-800 rounded-lg transition focus:outline-none"
                        aria-controls="faq-collapse-one">
                        Bagaimana cara melakukan booking?

                        <svg class="group-[.active]:rotate-180 transition-transform duration-300 block shrink-0 size-6 text-gray-600 group-hover:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div id="faq-collapse-one"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                        aria-labelledby="faq-heading-one">
                        <p class="text-gray-800 pt-4 leading-relaxed">
                            Anda dapat melakukan booking dengan memilih destinasi wisata yang diinginkan, klik tombol "Pesan
                            Tiket", isi form data diri dan tanggal kunjungan, lalu lakukan pembayaran sesuai metode yang
                            dipilih.
                        </p>
                    </div>
                </div>

                <div class="hs-accordion group bg-white mb-5 hover:border-2 hover:border-indigo-300 transition rounded-xl p-6"
                    id="faq-heading-two">
                    <button
                        class="hs-accordion-toggle w-full flex items-center justify-between gap-x-3 md:text-lg font-semibold text-start text-gray-800 rounded-lg transition focus:outline-none"
                        aria-controls="faq-collapse-two">
                        Apakah harga sudah termasuk akomodasi?

                        <svg class="group-[.active]:rotate-180 transition-transform duration-300 block shrink-0 size-6 text-gray-600 group-hover:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div id="faq-collapse-two"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                        aria-labelledby="faq-heading-two">
                        <p class="text-gray-800 pt-4 leading-relaxed">
                            Harga tiket masuk biasanya hanya mencakup akses ke lokasi wisata dan fasilitas umum. Untuk
                            penginapan atau akomodasi khusus, biaya dikenakan terpisah kecuali tertera pada paket bundling.
                        </p>
                    </div>
                </div>

                <div class="hs-accordion group bg-white mb-5 hover:border-2 hover:border-indigo-300 transition rounded-xl p-6"
                    id="faq-heading-three">
                    <button
                        class="hs-accordion-toggle w-full flex items-center justify-between gap-x-3 md:text-lg font-semibold text-start text-gray-800 rounded-lg transition focus:outline-none"
                        aria-controls="faq-collapse-three">
                        Apakah bisa reschedule atau refund?

                        <svg class="group-[.active]:rotate-180 transition-transform duration-300 block shrink-0 size-6 text-gray-600 group-hover:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div id="faq-collapse-three"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                        aria-labelledby="faq-heading-three">
                        <p class="text-gray-800 pt-4 leading-relaxed">
                            Reschedule dapat dilakukan maksimal H-3 sebelum kunjungan. Refund (pengembalian dana) hanya
                            dapat diajukan jika pembatalan dilakukan oleh pihak pengelola wisata atau force majeure.
                        </p>
                    </div>
                </div>

                <div class="hs-accordion group bg-white mb-5 hover:border-2 hover:border-indigo-300 transition rounded-xl p-6"
                    id="faq-heading-four">
                    <button
                        class="hs-accordion-toggle w-full flex items-center justify-between gap-x-3 md:text-lg font-semibold text-start text-gray-800 rounded-lg transition focus:outline-none"
                        aria-controls="faq-collapse-four">
                        Apakah tersedia guide berbahasa asing?

                        <svg class="group-[.active]:rotate-180 transition-transform duration-300 block shrink-0 size-6 text-gray-600 group-hover:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div id="faq-collapse-four"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                        aria-labelledby="faq-heading-four">
                        <p class="text-gray-800 pt-4 leading-relaxed">
                            Beberapa destinasi wisata populer di Jember menyediakan pemandu berbahasa Inggris. Harap hubungi
                            kontak yang tertera pada detail wisata untuk konfirmasi ketersediaan.
                        </p>
                    </div>
                </div>

                <div class="hs-accordion group bg-white mb-5 hover:border-2 hover:border-indigo-300 transition rounded-xl p-6"
                    id="faq-heading-five">
                    <button
                        class="hs-accordion-toggle w-full flex items-center justify-between gap-x-3 md:text-lg font-semibold text-start text-gray-800 rounded-lg transition focus:outline-none"
                        aria-controls="faq-collapse-five">
                        Apa saja yang perlu dibawa?

                        <svg class="group-[.active]:rotate-180 transition-transform duration-300 block shrink-0 size-6 text-gray-600 group-hover:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div id="faq-collapse-five"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                        aria-labelledby="faq-heading-five">
                        <p class="text-gray-800 pt-4 leading-relaxed">
                            Disarankan membawa e-tiket (bukti booking), pakaian ganti yang nyaman, tabir surya, dan uang
                            tunai secukupnya karena tidak semua lokasi memiliki ATM terdekat.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- FAQ End --}}
@endsection
