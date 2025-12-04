<footer class=" text-white pt-16">
    <div class="flex flex-col gap-16 md:flex-row text-justify px-20 justify-around pl-10 bg-neutral-900 py-16">
        <div class="max-w-[400px] flex flex-col gap-5 ">
            <span class="flex items-center gap-3 ">
                <Img class="w-10 h-auto text-bolder " src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                </Img>
                <h5 class=" text-xl font-extrabold">
                    J-Voyage
                </h5>
            </span>

            <p class="opacity-75">
                Platform booking wisata terpercaya yang menghadirkan pengalaman perjalanan terbaik di Jember. Wujudkan
                impian petualangan Anda bersama kami.
            </p>

            <div class="flex gap-3">
                <img src="{{ asset('assets/images/insta.png') }}" alt="">
                <img src="{{ asset('assets/images/Facebook.png') }}" alt="">
            </div>
        </div>
        <div>
            <h5 class="font-extrabold text-xl">
                Link Cepat
            </h5>
            <ul class="flex flex-col gap-2 mt-5 ">
                <a href="/#beranda" class="opacity-75 hover:opacity-100">Beranda</a>
                <a href="/#tentang" class=" opacity-75 hover:opacity-100">Tentang Kami</a>
                <a href="/#wisata" class=" opacity-75 hover:opacity-100">Wisata</a>
                <a href="/#faq" class="opacity-75 hover:opacity-100">FAQ</a>
            </ul>
        </div>
        <div>
            <h5 class="font-extrabold text-xl">
                Kontak
            </h5>

            <div class="gap-2 flex flex-col mt-5">
                <div class="flex gap-2">
                    <img src="{{ asset('assets/images/telp.png') }}" alt="" class="w-[22px] h-[22px]">
                    <p class="opacity-75">+62 821-452-954-436</p>
                </div>
                <div class="flex gap-2">
                    <img src="{{ asset('assets/images/mail.png') }}" alt="" class="w-[22px] h-[22px]">
                    <p class="opacity-75">info@jvoyage.com</p>
                </div>
                <div class="flex gap-2">
                    <img src="{{ asset('assets/images/loc.png') }}" alt="" class="w-[22px] h-[22px]">
                    <p class="opacity-75 max-w-[175px]">Jl. Raya Wisata No. 123 Jember, Jawa Timur</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-neutral-800 py-3 text-center">
        © 2025 J-Voyage. All rights reserved.
    </div>
</footer>
