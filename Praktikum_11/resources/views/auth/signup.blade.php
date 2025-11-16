@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
    <main class="flex min-h-screen">
        <form action="/signin" class="flex items-center flex-1 pl-[calc(((100%-1280px)/2)+75px)]">
            <div
                class="flex flex-col w-[500px] h-[658px] shrink-0 overflow-y-scroll rounded-[20px] border border-tedja-border p-[30px] gap-5 mt-[114px] bg-white hide-scrollbar">
                <h1 class="font-bold text-[28px] leading-[42px]">Sign Up</h1>
                <div class="relative flex items-center gap-5">
                    <div class="flex size-[100px] rounded-full overflow-hidden">
                        <img id="photo-container" src="{{ asset('assets/images/icons/default-avatar.svg') }}"
                            class="w-full h-full object-cover" alt="photo">
                    </div>
                    <input id="file-input" type="file" class="absolute opacity-0">
                    <div class="flex flex-col gap-2">
                        <p class="font-semibold">Add your photo</p>
                        <button type="button" id="remove-photo"
                            class="hidden rounded-[50px] w-fit py-[6px] px-3 bg-tedja-red font-semibold text-sm text-white">Remove</button>
                        <button type="button" id="add-photo"
                            class="rounded-[50px] w-fit py-[6px] px-3 bg-tedja-green font-semibold text-sm">Add</button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="font-semibold">Complete Name</p>
                    <label class="relative">
                        <img src="{{ asset('assets/images/icons/profile.svg') }}"
                            class="absolute size-6 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        <input type="text"
                            class="appearance-none outline-none w-full rounded-full ring-1 ring-tedja-border py-[14px] pl-[54px] px-5 font-semibold placeholder:font-normal focus:ring-1 focus:ring-tedja-blue transition-all duration-300"
                            placeholder="Type your complete name">
                    </label>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="font-semibold">Email Address</p>
                    <label class="relative">
                        <img src="{{ asset('assets/images/icons/sms.svg') }}"
                            class="absolute size-6 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        <input type="email"
                            class="appearance-none outline-none w-full rounded-full ring-1 ring-tedja-border py-[14px] pl-[54px] px-5 font-semibold placeholder:font-normal focus:ring-1 focus:ring-tedja-blue transition-all duration-300"
                            placeholder="Type your email address">
                    </label>
                    <span class="text-sm text-tedja-red">Format email salah silahkan coba lagi</span>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="font-semibold">WhatsApp Number</p>
                    <label class="relative">
                        <img src="{{ asset('assets/images/icons/messages.svg') }}"
                            class="absolute size-6 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        <input type="tel"
                            class="appearance-none outline-none w-full rounded-full ring-1 ring-tedja-border py-[14px] pl-[54px] px-5 font-semibold placeholder:font-normal focus:ring-1 focus:ring-tedja-blue transition-all duration-300"
                            placeholder="Type your number">
                    </label>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="font-semibold">Password</p>
                    <label class="relative">
                        <img src="{{ asset('assets/images/icons/lock.svg') }}"
                            class="absolute size-6 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        <input type="password"
                            class="appearance-none outline-none w-full rounded-full ring-1 ring-tedja-border py-[14px] pl-[54px] px-5 font-semibold placeholder:font-normal focus:ring-1 focus:ring-tedja-blue transition-all duration-300"
                            placeholder="Type your password">
                    </label>
                </div>
                <hr class="border-[#F2F2F4]">
                <div class="flex items-center justify-center gap-[6px]">
                    <img src="{{ asset('assets/images/icons/security-safe-blue-fill.svg') }}" class="size-6 flex shrink-0" alt="icon">
                    <p class="font-semibold">All your privacy data secured with our system</p>
                </div>
                <hr class="border-[#F2F2F4]">
                <button type="submit"
                    class="rounded-full py-[14px] px-5 bg-tedja-green w-full text-center font-semibold">Sign up & Get Best
                    Property</button>
            </div>
        </form>
        <div class="relative flex w-full max-w-[640px]">
            <div class="fixed top-0 h-screen w-full max-w-[640px] overflow-hidden">
                <img src="{{ asset('assets/images/backgrounds/login-banner.png') }}" class="w-full h-full object-cover" alt="banner">
                <div class="absolute bottom-0 w-full px-[30px] pb-[30px]">
                    <div class="flex flex-col rounded-[30px] border border-tedja-border p-4 gap-[14px] bg-white">
                        <div class="flex">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0" alt="star">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0" alt="star">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0" alt="star">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0" alt="star">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0" alt="star">
                        </div>
                        <p class="font-semibold leading-[28px]">findHomeMakassar membantu kami mendapatkan property idaman
                            dengan interest yang rendah, gaji UMR juga bisa hidup bahagia!</p>
                        <div class="flex items-center gap-[14px]">
                            <div class="flex size-[60px] rounded-full overflow-hidden">
                                <img src="{{ asset('assets/images/photos/profile.png') }}" class="w-full h-full object-cover"
                                    alt="photo profile">
                            </div>
                            <div>
                                <p class="font-semibold">Sarina Dwi</p>
                                <p class="text-sm text-tedja-secondary">Property Designer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/photo-upload.js') }}"></script>
@endsection
