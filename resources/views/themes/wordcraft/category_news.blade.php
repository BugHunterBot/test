<x-web-layout :breadcrumbInfo="$category">
    <!-- Pagination -->
    <section class="container pt-2">
        <div class="bg-white dark:text-white dark:bg-neutral-800 flex items-center p-2 gap-3">
            <ul class="flex gap-1 items-center">
                <li>
                    <a class="text-neutral-600 dark:text-white transition_3 whitespace-nowrap"
                        href="{{ __url('/') }}">{{ localize('home') }}</a>
                </li>
                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 15" stroke="oklch(70.8% 0 0)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <li class="text-brand-primary line-clamp-1">{{ $category->category_name }}</li>
            </ul>
        </div>
    </section>

    <!-- Category details Start -->
    @php
        $firstSixNews = $categoryNews->slice(0, 6);
        $secondSixNews = $categoryNews->slice(6, 6);
        $remainingNews = $categoryNews->slice(12);
    @endphp

    <section class="container mt-2 pb-8 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">

        <!-- Left section news -->
        <section class="md:col-span-2 xl:col-span-3 gap-6">
            <!-- Section Title -->
            <div
                class="flex items-center justify-between mb-4 pb-1 border-b-2 border-neutral-300 dark:border-neutral-700 relative before:absolute before:left-0 before:h-1 before:bg-brand-primary before:z-10 before:-bottom-[3px] before:w-24">
                {{-- Title --}}
                <h1 class="text-brand-primary text-lg font-semibold uppercase">
                    {{ $category->category_name }}
                </h1>
                {{-- Tab Button --}}
                <div class="flex items-center gap-2">
                    <button type="button" data-tab="card_view" class="p-1.5 btn_card_view active">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M0 72C0 49.9 17.9 32 40 32l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40L0 72zM0 232c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM128 392l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM160 72c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM288 232l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM160 392c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM448 72l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40zM320 232c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48zM448 392l0 48c0 22.1-17.9 40-40 40l-48 0c-22.1 0-40-17.9-40-40l0-48c0-22.1 17.9-40 40-40l48 0c22.1 0 40 17.9 40 40z"
                                class=""></path>
                        </svg>
                    </button>
                    <button type="button" data-tab="list_view" class="p-1.5 btn_list_view">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                                class=""></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Card View -->
            <div class="block">
                <div data-content="card_view" class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- cart -->
                    @if ($firstSixNews->isNotEmpty())
                        @foreach ($firstSixNews as $news)
                            <div class="border dark:border-neutral-700 hover:border-sky-600 transition_3 hover:-translate-y-2 group">
                                <a href="{{ __url($news->encode_title) }}">
                                    <figure class="w-full h-[180px] overflow-hidden">
                                        <img class="w-full h-full object-cover"
                                            src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}" 
                                            alt="{{ $news->image_alt }}">
                                    </figure>
                                </a>
                                <div class="p-3 bg-white dark:bg-neutral-800 space-y-3">
                                    <a href="{{ __url($news->encode_title) }}" class="text-xl font-bold line-clamp-2 h-14 dark:text-neutral-50 text-neutral-800 group-hover:text-sky-600 transition_3">
                                        {{ $news->title }}
                                    </a>
                                    <p class="text-neutral-600 line-clamp-2 h-12 dark:text-neutral-50">
                                        {{ clean_news_content($news->news) }}
                                    </p>
                                    <div class="flex gap-1.5 items-center h-10">
                                        <div>
                                            <figure class="w-8 h-8 rounded-full overflow-hidden">
                                                <img class="w-full h-full object-cover"
                                                    src="{{ isset($news->postByUser->profile_image) ? asset('storage/' . $news->postByUser->profile_image) : asset('/assets/profile.png') }}"
                                                    alt="{{ $news->postByUser->full_name ?? localize('unknown') }}">
                                            </figure>
                                        </div>
                                        <p class="space-x-2 text-sm flex items-center text-neutral-800 dark:text-neutral-50">
                                            <span class="inline-block">{{ $news->postByUser->full_name ?? localize('unknown') }}</span>,
                                            <span class="flex items-center gap-1"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="currentColor" d="M320 216C368.6 216 408 176.6 408 128C408 79.4 368.6 40 320 40C271.4 40 232 79.4 232 128C232 176.6 271.4 216 320 216zM320 514.7L320 365.4C336.3 358.6 352.9 351.7 369.7 344.7C408.7 328.5 450.5 320.1 492.8 320.1L512 320.1L512 480.1L492.8 480.1C433.7 480.1 375.1 491.8 320.5 514.6L320 514.8zM320 296L294.9 285.5C248.1 266 197.9 256 147.2 256L112 256C85.5 256 64 277.5 64 304L64 496C64 522.5 85.5 544 112 544L147.2 544C197.9 544 248.1 554 294.9 573.5L307.7 578.8C315.6 582.1 324.4 582.1 332.3 578.8L345.1 573.5C391.9 554 442.1 544 492.8 544L528 544C554.5 544 576 522.5 576 496L576 304C576 277.5 554.5 256 528 256L492.8 256C442.1 256 391.9 266 345.1 285.5L320 296z"/></svg> {{ $news->reader_hit ?? 0 }} {{ localize('read') }}</span>,
                                            <span class="inline-block">{{ news_publish_date_format($news->publish_date) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- List View --}}
            <div data-content="list_view" class="space-y-6 hidden">
                <!-- cart -->
                @if ($firstSixNews->isNotEmpty())
                    @foreach ($firstSixNews as $news)
                        <div class="grid items-center grid-cols-4 gap-4 bg-white dark:bg-neutral-800">
                            <a href="{{ __url($news->encode_title) }}"
                                class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                    src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                                    alt="{{ $news->image_alt }}" />
                            </a>
                            <div class="col-span-3 space-y-2 pr-2">
                                <a href="{{ __url($news->encode_title) }}" class="text-xl font-bold line-clamp-2 dark:text-neutral-50 text-neutral-800 hover:text-sky-600 dark:hover:text-sky-600 transition_3">
                                    {{ $news->title }}
                                </a>
                                <p class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-50">
                                    {{ clean_news_content($news->news) }}
                                </p>
                                <div class="flex gap-1.5 items-center pb-1">
                                    <div>
                                        <figure class="w-8 h-8 rounded-full overflow-hidden">
                                            <img class="w-full h-full object-cover"
                                                src="{{ isset($news->postByUser->profile_image) ? asset('storage/' . $news->postByUser->profile_image) : asset('/assets/profile.png') }}"
                                                alt="{{ $news->postByUser->full_name ?? localize('unknown') }}">
                                        </figure>
                                    </div>
                                    <p class="space-x-2 text-sm flex items-center text-neutral-800 dark:text-neutral-50">
                                        <span class="inline-block">{{ $news->postByUser->full_name ?? localize('unknown') }}</span>,
                                        <span class="flex items-center gap-1"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="currentColor" d="M320 216C368.6 216 408 176.6 408 128C408 79.4 368.6 40 320 40C271.4 40 232 79.4 232 128C232 176.6 271.4 216 320 216zM320 514.7L320 365.4C336.3 358.6 352.9 351.7 369.7 344.7C408.7 328.5 450.5 320.1 492.8 320.1L512 320.1L512 480.1L492.8 480.1C433.7 480.1 375.1 491.8 320.5 514.6L320 514.8zM320 296L294.9 285.5C248.1 266 197.9 256 147.2 256L112 256C85.5 256 64 277.5 64 304L64 496C64 522.5 85.5 544 112 544L147.2 544C197.9 544 248.1 554 294.9 573.5L307.7 578.8C315.6 582.1 324.4 582.1 332.3 578.8L345.1 573.5C391.9 554 442.1 544 492.8 544L528 544C554.5 544 576 522.5 576 496L576 304C576 277.5 554.5 256 528 256L492.8 256C442.1 256 391.9 266 345.1 285.5L320 296z"/></svg> {{ $news->reader_hit ?? 0 }} {{ localize('read') }}</span>,
                                        <span class="inline-block">{{ news_publish_date_format($news->publish_date) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- add section -->
            <figure class="mt-6 mb-6">
                @php $ad = get_advertisements(2, 2); @endphp

                @if ($ad && $ad->status == 1)
                    {!! $ad->embed_code !!}
                @elseif(!$ad)
                    <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
                @endif
            </figure>

            <!-- secondSixNews Card View -->
            @if ($secondSixNews->isNotEmpty())
                <div data-content="card_view" class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">
                    <!-- cart -->
                    @foreach ($secondSixNews as $news)
                        <div class="border dark:border-neutral-700 hover:border-sky-600 transition_3 hover:-translate-y-2 group">
                            <a href="{{ __url($news->encode_title) }}">
                                <figure class="w-full h-[180px] overflow-hidden">
                                    <img class="w-full h-full object-cover"
                                        src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}" 
                                        alt="{{ $news->image_alt }}">
                                </figure>
                            </a>
                            <div class="p-3 bg-white dark:bg-neutral-800 space-y-3">
                                <a href="{{ __url($news->encode_title) }}" class="text-xl font-bold line-clamp-2 h-14 dark:text-neutral-50 text-neutral-800 group-hover:text-sky-600 transition_3">
                                    {{ $news->title }}
                                </a>
                                <p class="text-neutral-600 line-clamp-2 h-12 dark:text-neutral-50">
                                    {{ clean_news_content($news->news) }}
                                </p>
                                <div class="flex gap-1.5 items-center h-10">
                                    <div>
                                        <figure class="w-8 h-8 rounded-full overflow-hidden">
                                            <img class="w-full h-full object-cover"
                                                src="{{ isset($news->postByUser->profile_image) ? asset('storage/' . $news->postByUser->profile_image) : asset('/assets/profile.png') }}"
                                                alt="{{ $news->postByUser->full_name ?? localize('unknown') }}">
                                        </figure>
                                    </div>
                                    <p class="space-x-2 text-sm flex items-center text-neutral-800 dark:text-neutral-50">
                                        <span class="inline-block">{{ $news->postByUser->full_name ?? localize('unknown') }}</span>,
                                        <span class="flex items-center gap-1"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="currentColor" d="M320 216C368.6 216 408 176.6 408 128C408 79.4 368.6 40 320 40C271.4 40 232 79.4 232 128C232 176.6 271.4 216 320 216zM320 514.7L320 365.4C336.3 358.6 352.9 351.7 369.7 344.7C408.7 328.5 450.5 320.1 492.8 320.1L512 320.1L512 480.1L492.8 480.1C433.7 480.1 375.1 491.8 320.5 514.6L320 514.8zM320 296L294.9 285.5C248.1 266 197.9 256 147.2 256L112 256C85.5 256 64 277.5 64 304L64 496C64 522.5 85.5 544 112 544L147.2 544C197.9 544 248.1 554 294.9 573.5L307.7 578.8C315.6 582.1 324.4 582.1 332.3 578.8L345.1 573.5C391.9 554 442.1 544 492.8 544L528 544C554.5 544 576 522.5 576 496L576 304C576 277.5 554.5 256 528 256L492.8 256C442.1 256 391.9 266 345.1 285.5L320 296z"/></svg> {{ $news->reader_hit ?? 0 }} {{ localize('read') }}</span>,
                                        <span class="inline-block">{{ news_publish_date_format($news->publish_date) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- List View --}}
                <div data-content="list_view" class="space-y-6 hidden">
                    <!-- cart -->
                    @foreach ($secondSixNews as $news)
                        <div class="grid items-center grid-cols-4 gap-4 bg-white dark:bg-neutral-800">
                            <a href="{{ __url($news->encode_title) }}"
                                class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                    src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                                    alt="{{ $news->image_alt }}" />
                            </a>
                            <div class="col-span-3 space-y-2 pr-2">
                                <a href="{{ __url($news->encode_title) }}" class="text-xl font-bold line-clamp-2 dark:text-neutral-50 text-neutral-800 hover:text-sky-600 dark:hover:text-sky-600 transition_3">
                                    {{ $news->title }}
                                </a>
                                <p class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-50">
                                    {{ clean_news_content($news->news) }}
                                </p>
                                <div class="flex gap-1.5 items-center pb-1">
                                    <div>
                                        <figure class="w-8 h-8 rounded-full overflow-hidden">
                                            <img class="w-full h-full object-cover"
                                                src="{{ isset($news->postByUser->profile_image) ? asset('storage/' . $news->postByUser->profile_image) : asset('/assets/profile.png') }}"
                                                alt="{{ $news->postByUser->full_name ?? localize('unknown') }}">
                                        </figure>
                                    </div>
                                    <p class="space-x-2 text-sm flex items-center text-neutral-800 dark:text-neutral-50">
                                        <span class="inline-block">{{ $news->postByUser->full_name ?? localize('unknown') }}</span>,
                                        <span class="flex items-center gap-1"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="currentColor" d="M320 216C368.6 216 408 176.6 408 128C408 79.4 368.6 40 320 40C271.4 40 232 79.4 232 128C232 176.6 271.4 216 320 216zM320 514.7L320 365.4C336.3 358.6 352.9 351.7 369.7 344.7C408.7 328.5 450.5 320.1 492.8 320.1L512 320.1L512 480.1L492.8 480.1C433.7 480.1 375.1 491.8 320.5 514.6L320 514.8zM320 296L294.9 285.5C248.1 266 197.9 256 147.2 256L112 256C85.5 256 64 277.5 64 304L64 496C64 522.5 85.5 544 112 544L147.2 544C197.9 544 248.1 554 294.9 573.5L307.7 578.8C315.6 582.1 324.4 582.1 332.3 578.8L345.1 573.5C391.9 554 442.1 544 492.8 544L528 544C554.5 544 576 522.5 576 496L576 304C576 277.5 554.5 256 528 256L492.8 256C442.1 256 391.9 266 345.1 285.5L320 296z"/></svg> {{ $news->reader_hit ?? 0 }} {{ localize('read') }}</span>,
                                        <span class="inline-block">{{ news_publish_date_format($news->publish_date) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- add section -->
                <figure class="mt-6 mb-6">
                    @php $ad = get_advertisements(2, 3); @endphp

                    @if ($ad && $ad->status == 1)
                        {!! $ad->embed_code !!}
                    @elseif(!$ad)
                        <img class="w-full h-full object-cover" src="{{ asset('assets/banner-large.png') }}" alt="" />
                    @endif
                </figure>
            @endif

            @if ($remainingNews->isNotEmpty())
                <section class="my-6">
                    <!-- Card section -->
                    <div data-content="card_view" id="news-grid"
                        class="relative isolate grid md:grid-cols-2 xl:grid-cols-3 gap-6 before:w-full /*before:h-1/2*/ before:bg-gradient-to-t from-white dark:from-black before:absolute before:bottom-0 before:left-0 before:z-10">
                        <!-- cart -->
                        @foreach ($remainingNews as $news)
                            <div class="border dark:border-neutral-700 hover:border-sky-600 transition_3 hover:-translate-y-2 group">
                                <a href="{{ __url($news->encode_title) }}">
                                    <figure class="w-full h-[180px] overflow-hidden">
                                        <img class="w-full h-full object-cover"
                                            src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}" 
                                            alt="{{ $news->image_alt }}">
                                    </figure>
                                </a>
                                <div class="p-3 bg-white dark:bg-neutral-800 space-y-3">
                                    <a href="{{ __url($news->encode_title) }}" class="text-xl font-bold line-clamp-2 h-14 dark:text-neutral-50 text-neutral-800 group-hover:text-sky-600 transition_3">
                                        {{ $news->title }}
                                    </a>
                                    <p class="text-neutral-600 line-clamp-2 h-12 dark:text-neutral-50">
                                        {{ clean_news_content($news->news) }}
                                    </p>
                                    <div class="flex gap-1.5 items-center h-10">
                                        <div>
                                            <figure class="w-8 h-8 rounded-full overflow-hidden">
                                                <img class="w-full h-full object-cover"
                                                    src="{{ isset($news->postByUser->profile_image) ? asset('storage/' . $news->postByUser->profile_image) : asset('/assets/profile.png') }}"
                                                    alt="{{ $news->postByUser->full_name ?? localize('unknown') }}">
                                            </figure>
                                        </div>
                                        <p class="space-x-2 text-sm flex items-center text-neutral-800 dark:text-neutral-50">
                                            <span class="inline-block">{{ $news->postByUser->full_name ?? localize('unknown') }}</span>,
                                            <span class="flex items-center gap-1"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="currentColor" d="M320 216C368.6 216 408 176.6 408 128C408 79.4 368.6 40 320 40C271.4 40 232 79.4 232 128C232 176.6 271.4 216 320 216zM320 514.7L320 365.4C336.3 358.6 352.9 351.7 369.7 344.7C408.7 328.5 450.5 320.1 492.8 320.1L512 320.1L512 480.1L492.8 480.1C433.7 480.1 375.1 491.8 320.5 514.6L320 514.8zM320 296L294.9 285.5C248.1 266 197.9 256 147.2 256L112 256C85.5 256 64 277.5 64 304L64 496C64 522.5 85.5 544 112 544L147.2 544C197.9 544 248.1 554 294.9 573.5L307.7 578.8C315.6 582.1 324.4 582.1 332.3 578.8L345.1 573.5C391.9 554 442.1 544 492.8 544L528 544C554.5 544 576 522.5 576 496L576 304C576 277.5 554.5 256 528 256L492.8 256C442.1 256 391.9 266 345.1 285.5L320 296z"/></svg> {{ $news->reader_hit ?? 0 }} {{ localize('read') }}</span>,
                                            <span class="inline-block">{{ news_publish_date_format($news->publish_date) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- List View --}}
                    <div data-content="list_view" id="news-list" class="space-y-6 hidden">
                        <!-- cart -->
                        @foreach ($remainingNews as $news)
                            <div class="grid items-center grid-cols-4 gap-4 bg-white dark:bg-neutral-800">
                                <a href="{{ __url($news->encode_title) }}"
                                    class="block w-full h-20 xl:h-28 2xl:h-36 group overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition_5"
                                        src="{{ isset($news->photoLibrary->image_base_url) ? $news->photoLibrary->image_base_url : asset('/assets/news-card-view.png') }}"
                                        alt="{{ $news->image_alt }}" />
                                </a>
                                <div class="col-span-3 space-y-2 pr-2">
                                    <a href="{{ __url($news->encode_title) }}" class="text-xl font-bold line-clamp-2 dark:text-neutral-50 text-neutral-800 hover:text-sky-600 dark:hover:text-sky-600 transition_3">
                                        {{ $news->title }}
                                    </a>
                                    <p class="text-sm line-clamp-1 xl:line-clamp-2 text-neutral-600 dark:text-neutral-50">
                                        {{ clean_news_content($news->news) }}
                                    </p>
                                    <div class="flex gap-1.5 items-center pb-1">
                                        <div>
                                            <figure class="w-8 h-8 rounded-full overflow-hidden">
                                                <img class="w-full h-full object-cover"
                                                    src="{{ isset($news->postByUser->profile_image) ? asset('storage/' . $news->postByUser->profile_image) : asset('/assets/profile.png') }}"
                                                    alt="{{ $news->postByUser->full_name ?? localize('unknown') }}">
                                            </figure>
                                        </div>
                                        <p class="space-x-2 text-sm flex items-center text-neutral-800 dark:text-neutral-50">
                                            <span class="inline-block">{{ $news->postByUser->full_name ?? localize('unknown') }}</span>,
                                            <span class="flex items-center gap-1"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="currentColor" d="M320 216C368.6 216 408 176.6 408 128C408 79.4 368.6 40 320 40C271.4 40 232 79.4 232 128C232 176.6 271.4 216 320 216zM320 514.7L320 365.4C336.3 358.6 352.9 351.7 369.7 344.7C408.7 328.5 450.5 320.1 492.8 320.1L512 320.1L512 480.1L492.8 480.1C433.7 480.1 375.1 491.8 320.5 514.6L320 514.8zM320 296L294.9 285.5C248.1 266 197.9 256 147.2 256L112 256C85.5 256 64 277.5 64 304L64 496C64 522.5 85.5 544 112 544L147.2 544C197.9 544 248.1 554 294.9 573.5L307.7 578.8C315.6 582.1 324.4 582.1 332.3 578.8L345.1 573.5C391.9 554 442.1 544 492.8 544L528 544C554.5 544 576 522.5 576 496L576 304C576 277.5 554.5 256 528 256L492.8 256C442.1 256 391.9 266 345.1 285.5L320 296z"/></svg> {{ $news->reader_hit ?? 0 }} {{ localize('read') }}</span>,
                                            <span class="inline-block">{{ news_publish_date_format($news->publish_date) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-center items-center mt-8">
                        <button type="button" id="load-more-btn" data-offset="21"
                            data-category-id="{{ $category->id }}" data-view-style="card"
                            class="px-6 py-3 text-center rounded-md bg-neutral-200 dark:bg-neutral-700 dark:border-neutral-800 dark:text-white dark:hover:text-brand-primary dark:hover:bg-transparent dark:hover:border-brand-primary hover:bg-neutral-100 border hover:border-brand-primary hover:text-brand-primary transition_3">
                            {{ localize('load_more') }}
                        </button>
                    </div>

                </section>
            @endif

            <div id="no-more-news-message" class="hidden text-center text-sm text-gray-500">
                {{ localize('no_more_news_available') }}
            </div>

        </section>

        <!-- Right section news -->
        <section>
            <div class="space-y-6 sticky top-16">
                <!-- Popular post -->
                @include('themes.wordcraft.components.common.popular-post')

                <!-- Ads section -->
                <figure class="">
                    @php $ad = get_advertisements(2, 1); @endphp

                    @if ($ad && $ad->status == 1)
                        {!! $ad->embed_code !!}
                    @elseif(!$ad)
                        <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic.png') }}" alt="" />
                    @endif
                </figure>

                <!-- Top Week -->
                @include('themes.wordcraft.components.common.recommended-top-week-post')

                <!-- Voting poll -->
                @if ($votingPoll)
                    @include('themes.wordcraft.components.common.voting-poll')
                @endif

                <!-- Ads section -->
                <figure class="">
                    @php $ad = get_advertisements(2, 4); @endphp

                    @if ($ad && $ad->status == 1)
                        {!! $ad->embed_code !!}
                    @elseif(!$ad)
                        <img class="w-full h-full object-cover" src="{{ asset('assets/ads-electronic-large.png') }}" alt="" />
                    @endif
                </figure>

            </div>
        </section>


    </section>

    @push('custom-js')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const tabButtons = document.querySelectorAll("[data-tab]");
                const tabContents = document.querySelectorAll("[data-content]");

                tabButtons.forEach(button => {
                    button.addEventListener("click", () => {
                        const targetTab = button.getAttribute("data-tab");

                        // Update active styles
                        tabButtons.forEach(btn => {
                            btn.classList.remove("active");
                        });
                        button.classList.add("active");

                        // toggle content
                        tabContents.forEach(content => {
                            if (content.getAttribute("data-content") === targetTab) {
                                content.classList.remove("hidden");
                                content.classList.add("block");
                            } else {
                                content.classList.remove("block");
                                content.classList.add("hidden");
                            }
                        });
                    });
                });
            });
        </script>
    @endpush

</x-web-layout>
