@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <div class="mt-[164px] flex flex-col gap-[6px] text-center items-center">
        <h1 class="font-bold text-4xl leading-[54px]">Browse Man Made</h1>
        <div class="flex items-center gap-[6px]">
            <img src="{{ asset('assets/images/icons/building-3.svg') }}" class="size-6 flex shrink-0" alt="icon" />
            <p class="font-semibold">Available 3 Property</p>
        </div>
    </div>
    <main class="grid grid-cols-3 w-full max-w-[1280px] px-[75px] gap-[30px] mx-auto my-[50px]">
        @foreach ($categories as $category)
            <a href="{{ route('category.show', $category['id']) }}" class="card">
                <div
                    class="flex flex-col rounded-[30px] ring-1 ring-tedja-border p-[10px] pb-5 gap-3 bg-white hover:ring-2 hover:ring-tedja-blue transition-all duration-300">
                    <div class="thumbnail-container relative w-full h-[240px] rounded-[30px] overflow-hidden">
                        <img src="{{ $category['image'] }}" class="w-full h-full object-cover" alt="thumbnail" />
                        <button class="absolute top-5 right-5">
                            <img src="{{ asset('assets/images/icons/heart-white-fill.svg') }}" class="size-[50px] flex shrink-0"
                                alt="icon whishlist" />
                        </button>
                    </div>
                    <div class="flex flex-col gap-[18px] px-[10px]">
                        <div class="flex flex-col gap-[6px]">
                            <h3 class="font-bold text-lg">
                                {{ $category['name'] }}
                            </h3>
                            <div class="flex items-center gap-[6px]">
                                <img src="{{ asset('assets/images/icons/location.svg') }}" class="size-5 flex shrink-0" alt="icon" />
                                <p class="font-semibold text-sm">{{ $category['location'] }}</p>
                            </div>
                        </div>
                        <hr class="border-tedja-border" />
                        <div class="grid grid-cols-2 gap-y-[18px] gap-x-3">
                            @if ($category['bedroom'] != null)
                                <div class="flex items-center rounded-[14px] border border-tedja-border p-[10px] gap-[6px]">
                                    <img src="{{ asset('assets/images/icons/slider-vertical.svg') }}" class="size-5 flex shrink-0"
                                        alt="icon" />
                                    <p class="font-semibold text-sm">2 Bedroom</p>
                                </div>
                            @endif
                            @if ($category['bathroom'] != null)
                                <div class="flex items-center rounded-[14px] border border-tedja-border p-[10px] gap-[6px]">
                                    <img src="{{ asset('assets/images/icons/slider-horizontal.svg') }}" class="size-5 flex shrink-0"
                                        alt="icon" />
                                    <p class="font-semibold text-sm">{{ $category['bathroom'] }} Bathroom</p>
                                </div>
                            @endif
                            @if ($category['certificate'] != null)
                                <div class="flex items-center rounded-[14px] border border-tedja-border p-[10px] gap-[6px]">
                                    <img src="{{ asset('assets/images/icons/note-favorite.svg') }}" class="size-5 flex shrink-0"
                                        alt="icon" />
                                    <p class="font-semibold text-sm">{{ $category['certificate'] }}</p>
                                </div>
                            @endif
                            @if ($category['landarea'] != null)
                                <div class="flex items-center rounded-[14px] border border-tedja-border p-[10px] gap-[6px]">
                                    <img src="{{ asset('assets/images/icons/maximize-3.svg') }}" class="size-5 flex shrink-0"
                                        alt="icon" />
                                    <p class="font-semibold text-sm">{{ $category['landarea'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </main>
@endsection
