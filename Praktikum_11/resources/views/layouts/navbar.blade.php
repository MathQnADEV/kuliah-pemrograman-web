<nav class="relative w-full flex items-center justify-center px-[75px]">
    <div
        class="fixed top-0 flex items-center justify-between w-full max-w-[1130px] rounded-3xl p-4 bg-white mt-[30px] z-30">
        <a href="/" class="flex shrink-0 w-[150px]">
            <img src="{{ asset('assets/images/logos/logo-black.png') }}" alt="logo">
        </a>
        <ul class="flex items-center gap-[30px]">
            <li class="group active">
                <a href="/" class="hover:font-bold group-[.active]:font-bold transition-all duration-300">Home</a>
            </li>
            <li class="group">
                <a href="/category"
                    class="hover:font-bold group-[.active]:font-bold transition-all duration-300">Browse</a>
            </li>
            <li class="group">
                <a href="#"
                    class="hover:font-bold group-[.active]:font-bold transition-all duration-300">Rewards</a>
            </li>
            <li class="group">
                <a href="#"
                    class="hover:font-bold group-[.active]:font-bold transition-all duration-300">Stories</a>
            </li>
        </ul>
        <div class="flex items-center gap-3">
            <a href="/signin"
                class="group rounded-full border border-tedja-black py-[14px] px-5 hover:bg-tedja-black flex items-center transition-all duration-300">
                <span class="font-semibold group-hover:text-white transition-all duration-300">Sign In</span>
            </a>
            <a href="/signup" class="group rounded-full border py-[14px] px-5 flex items-center bg-tedja-green">
                <span class="font-semibold">Sign Up</span>
            </a>
        </div>
    </div>
</nav>
