@extends('front.layouts.app')
@section('title', "Bozok TV Son Dakika Haberler, Güncel Haberler")
@push('css')
    <link rel="stylesheet" href="{{ asset("/assets/plugins/global/swiper/swiper-bundle.min.css") }}">
    @vite([
    'resources/css/home.css',
    ])
@endpush
@section('content')


    <!-- esxmasthead-->
{{--    <div id="top-adbar" class="esx hd-280 hm-250 sticky-stop"></div>--}}
    <!-- //esxmasthead-->

    <div class="container fw-mobile">
        <section class="headline">
            <!-- left slider -->
            <div id="leftslider">
                <div class="swiper-container" id="ls">
                    <div class="swiper-wrapper">
                        @foreach($main_headlines as $main_headline)
                        <a class="swiper-slide item" href="/"
                           title="{{ $main_headline?->headlineable?->title }}" data-order="2" target="_blank">
                            <div class="img">
                                <img loading="lazy"
                                     data-src="{{ $main_headline?->headlineable?->main_headline?->path ?? $main_headline?->headlineable?->image?->path }}"
                                     width="788" height="450" alt="{{ $main_headline?->headlineable?->title }}" decoding="async">
                            </div>
                            <div class="title">{{ $main_headline?->headlineable?->title }}</div>
                        </a>
                        @endforeach
                    </div>
                    <!-- navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="slider-numbers"></div>
                </div>
            </div>
            <!-- //left slider -->

            <!-- right slider -->
            <div id="rightslider">
                <div class="swiper-container" id="rs">
                    <div class="swiper-wrapper">
                        @foreach($newsletter_today_headlines as $newsletter_today_headline)
                            <a class="swiper-slide item" target="_blank"
                               href=""
                               title="{{ $newsletter_today_headline?->title }}" data-order="{{ $newsletter_today_headline?->order }}">
                                <div class="img">
                                    <img src="{{ asset($newsletter_today_headline?->path) }}"
                                         width="382" height="450"
                                         alt="{{ $newsletter_today_headline?->title }}">
                                </div>
                                <div class="title">{{ $newsletter_today_headline?->title }}</div>
                            </a>
                        @endforeach
                    </div>
                    <!-- navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div id="rswrapper">
                        <div class="slider-numbers nospace" id="rs-numbers">
                        </div>
                    </div>
                </div>
            </div>
            <!-- //right slider -->
        </section>
        <!-- //headline -->
    </div>
    <div class="container fw-mobile">
        <!-- grid slider -->
        <section class="gridslider">
            @foreach($newsletter_five_cuffs as $newsletter_five_cuff)
                <a class="item" href="/"
               target="_blank">
                <figure>
                    <img class="lazyload"
                         data-src="{{ asset($newsletter_five_cuff?->path) }}"
                         width="233" height="260" alt="{{ $newsletter_five_cuff?->title }}"/>

                    <figcaption class="title">
                        <span class="text">{{ $newsletter_five_cuff?->title }}</span>
                    </figcaption>
                </figure>
            </a>
            @endforeach
        </section>
        <!-- //grid slider -->
    </div>

{{--    <div class="esx ad-slot hd-280 hm-280 text-center" id="/9170022/ESH_DESKTOP_ANASAYFA/mansetalti_1"></div>--}}

    <div class="container">

        <!-- grid news: 12 -->
        <section class="mb-30">
            <div class="grid grid-4">
                <!-- item -->
                @foreach($last_newsletters as $last_newsletter)
                <div class="item">
                    <a href="dunya/trumpin-resmi-portresi-gundem-oldu.html" target="_blank"
                       title="{{ $last_newsletter?->title }}">
                        <picture>
                            <img loading="lazy" class="thumb" width="320" height="180"
                                 src="{{ $last_newsletter?->path }}"
                                 alt={{ $last_newsletter?->title }}>
                        </picture>
                    </a>
                    <a href="/" target="_blank"
                       title="{{ $last_newsletter?->title }}">
                        <span class="text">{{ $last_newsletter?->title }}</span>
                    </a>
                </div>
                @endforeach
                <!-- //item -->
            </div>
        </section>

        <!-- grid news: 12 -->

    </div>

{{--    <div class="esx ad-slot hd-280 hm-280 text-center" id="/9170022/ESH_DESKTOP_ANASAYFA/mansetalti_2"></div>--}}

    <!-- spor -->
    <section class="spor mt-0">
        <div class="container">

            <div class="row">
                <div class="column">


                    <div class="head-v3 green mb-20">
                        <a href="kralspor.html">Siyaset Haberleri</a>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="sporslider v2">
                        <div class="swiper-container" id="sporslider">

                            <div class="swiper-wrapper mb-30">
                                @foreach($politic_newsletters_main_headlines as $politic_newsletters_main_headline)
                                <div class="swiper-slide">
                                    <a href="/" target="_blank" title="{{ $politic_newsletters_main_headline?->headlineable?->title }}">
                                        <img loading="lazy" class="lazyload" data-src="{{ $politic_newsletters_main_headline?->headlineable?->image?->path }}" width="700" height="400" alt="{{ $politic_newsletters_main_headline?->headlineable?->title }}">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <!-- navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-pagination"></div>

                        </div>
                    </div>
                    <div class="grid grid-2 grid-mobile-2">
                        @foreach($politic_newsletter_outstandings as $politic_newsletter_outstanding)
                        <div class="item">
                            <a href=""
                               target="_blank">
                                <img class="lazyload"
                                     data-src="{{ $politic_newsletter_outstanding?->path }}"
                                     width="229" height="129"
                                     alt="{{ $politic_newsletter_outstanding?->title }}"/>
                                <span class="text">
                                        <span>{{ $politic_newsletter_outstanding?->title }}</span>
                                    </span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="grid grid-4">
                        <!-- item -->
                        @foreach($politic_newsletters_today_headlines as $politic_newsletters_today_headline)
                        <div class="item">
                            <a href="" target="_blank">
                                <span class="thumb">
                                    <img class="lazyload" width="286" height="161"
                                         data-src="{{ $politic_newsletters_today_headline?->path }}"
                                         alt="{{ $politic_newsletters_today_headline?->title }}"/>
                                </span>
                                <span class="text">
                                    <span>{{ $politic_newsletters_today_headline?->title }}</span>
                                </span>
                            </a>
                        </div>
                        @endforeach
                        <!-- //item -->
                    </div>
                </div>
            </div>

        </div>
    </section>
{{--    <div class="esx ad-slot hd-280 hm-280 text-center" id="/9170022/ESH_DESKTOP_ANASAYFA/mansetalti_3"></div>--}}
    <section class="mosaic-news">
        <div class="container">


            <div class="parts">

                <div class="part-1">
                    <!-- column -->

                    <!-- //column -->
                    <!-- column -->
                    <div class="sutun">

                        <!-- 2 item -->
                        <!-- //1 item tower -->

                        <!-- list item -->
                        <div class="list list-mb">
                            <ul>
                                @foreach($newsletter_outstandings as $newsletter_outstanding)
                                <li>
                                    <a href=""
                                       target="_blank">
                                        <figure>
                                            <span class="img">
                                                <img class="lazyload"
                                                     data-src="{{ $newsletter_outstanding?->path }}"
                                                     width="150" height="84"
                                                     alt="{{ $newsletter_outstanding?->title }}"/>
                                            </span>
                                            <span class="text">
                                                {{ $newsletter_outstanding?->title }}
                                            </span>
                                        </figure>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- //1 item -->


                    </div>
                    <div class="sutun">

                        <!-- 2 item -->
                        <!-- //1 item tower -->

                        <!-- list item -->
                        <div class="list list-mb">
                            <ul>
                                @foreach($last_minutes as $last_minute)
                                    <li>
                                        <a href=""
                                           target="_blank">
                                            <figure>
                                            <span class="img">
                                                <img class="lazyload"
                                                     data-src="{{ $last_minute?->path }}"
                                                     width="150" height="84"
                                                     alt="{{ $last_minute?->title }}"/>
                                            </span>
                                                <span class="text">
                                                {{ $last_minute?->title }}
                                            </span>
                                            </figure>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- //1 item -->


                    </div>
                    <!-- //column -->


                </div>

                <div class="part-2">
                    <!-- column -->
                    <div class="sutun">
                        @if($photo_galleries->count() > 0)
                        <!-- 1 item -->
                        <div class="grid grid-1 grid-slider">

                            <div class="swiper" id="swiper-mosaic">
                                <div class="swiper-wrapper">
                                    @foreach($photo_galleries as $photo_gallery)
                                    <div class="swiper-slide">
                                        <a href="/"
                                           target="_blank">
                                            <figure>
                                                <span class="thumb">
                                                    <img class="lazyload"
                                                         data-src="{{ $photo_gallery?->path }}"
                                                         width="340" height="191"
                                                         alt="{{ $photo_gallery?->title }}"/>
                                                </span>
                                                <figcaption>
                                                    {{ $photo_gallery?->title }}
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>

                            </div>

                        </div>
                        <!-- //1 item -->
                        @endif

                    </div>
                    <!-- //column -->
                </div>


            </div>


        </div>
    </section>
    @if($sport_outstandings && count($sport_outstandings) >= 5)
        <div class="magazin">
            <section class="genel">
                <div class="container">
                    <div class="row">
                        <div class="column">
                            <div class="head-v3 green mb-20">
                                <a href="/">Spor Haberleri</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            {{-- İlk öğeyi al ve SectionHero içinde göster --}}
                            @php $firstItem = $sport_outstandings[0]; @endphp
                            <div class="sectionhero v2">
                                <a href="/" target="_blank">
                                    <img class="lazyload"
                                         data-src="{{ $firstItem->path }}"
                                         width="703" height="395"
                                         alt="{{ $firstItem->title }}">
                                </a>
                                <a href="/">
                                    <span class="title">{{ $firstItem->title }}</span>
                                    <span class="summary">{{ $firstItem->summary }}</span>
                                </a>
                            </div>

                            <div class="grid grid-2 grid-mobile-2">
                                {{-- Kalan 4 öğeyi listele --}}
                                @foreach($sport_outstandings->skip(1)->take(4) as $item)
                                    <div class="item">
                                        <a href="/" target="_blank">
                                            <img class="lazyload"
                                                 data-src="{{ $item->path }}"
                                                 width="229" height="129"
                                                 alt="{{ $item->title }}"/>
                                            <span class="text">
                                            <span>{{ $item->title }}</span>
                                        </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif

{{--    <div class="esx ad-slot hd-280 hm-280 text-center" id="/9170022/ESH_DESKTOP_ANASAYFA/footer_1"></div>--}}
    <section class="mb-30">
        <div class="grid grid-4">
        </div>
    </section>        <!-- youtube -->
    <div class="esx ad-slot hd-280 hm-280 text-center" id="/9170022/ESH_DESKTOP_ANASAYFA/footer_2"></div>
    <!-- //esxmasthead-->

    <div class="container">
        <section class="columnnews">
            <div class="grid">
                <!-- item -->
                <div class="item">
                    <div class="item-title blue">
                        <a href="">Dünya Haberleri</a>
                    </div>
                    <ul>
                        @foreach($world_outstandings as $world_outstanding)
                        @if($loop->first)
                            <li>
                            <a href="/" target="_blank">
                                <figure>
                                    <img class="lazyload" loading="lazy"
                                         data-src="{{ $world_outstanding?->path }}"
                                         width="400" height="225"
                                         alt="SpaceX'in Starship roketi test uçuşunda patladı"/>
                                    <figcaption>{{ $world_outstanding?->title }}</figcaption>
                                </figure>
                            </a>
                        </li>
                            @else
                        <li>
                            <a href="/" target="_blank">
                                {{ $world_outstanding?->title }}</a>
                        </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <!-- //item -->
                <!-- item -->
                <div class="item">

                    <div class="item-title blue">
                        Gündem Haberleri
                    </div>
                    <ul>
                        @foreach($agenda_outstandings as $agenda_outstanding)
                            @if($loop->first)
                                <li>
                                    <a href="/" target="_blank">
                                        <figure>
                                            <img class="lazyload" loading="lazy"
                                                 data-src="{{ $agenda_outstanding?->path }}"
                                                 width="400" height="225"
                                                 alt="{{ $agenda_outstanding?->title }}"/>
                                            <figcaption>{{ $agenda_outstanding?->title }}</figcaption>
                                        </figure>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="/" target="_blank">
                                        {{ $agenda_outstanding?->title }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <!-- //item -->

                <!-- item -->
                <div class="item">

                    <div class="item-title red">
                        <a href="">Ekonomi Haberleri</a>
                    </div>

                    <ul>
                        @foreach($economi_outstandings as $economi_outstanding)
                            @if($loop->first)
                                <li>
                                    <a href="/" target="_blank">
                                        <figure>
                                            <img class="lazyload" loading="lazy"
                                                 data-src="{{ $economi_outstanding?->path }}"
                                                 width="400" height="225"
                                                 alt="{{ $economi_outstanding?->title }}"/>
                                            <figcaption>{{ $economi_outstanding?->title }}</figcaption>
                                        </figure>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="/" target="_blank">
                                        {{ $economi_outstanding?->title }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <!-- item -->


            </div>

        </section>

    </div>


@endsection
@push('js')
    <script src="{{ asset("assets/plugins/global/swiper/swiper-bundle.min.js") }}"></script>
    @vite([
    "resources/js/front/swiper/five-cuff.js",
    "resources/js/front/swiper/main-headline.js",
    "resources/js/front/swiper/politic.js",
    "resources/js/front/swiper/photo-gallery.js",
])
@endpush
