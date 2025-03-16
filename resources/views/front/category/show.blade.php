@extends('front.layouts.app')
@section('title', "Bozok TV - " . $category?->name)
@push('css')
    @vite([
        "resources/css/page.css",
    ])
    <style>@media (min-width: 900px) {  .leftbox {padding: 0 15px 0 10px;}  }</style>
@endpush
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="column">
                    <ul>
                        <li><a href="{{ route("front.index") }}">Haberler</a></li>
                        <li class="active"><strong>{{ $category?->name }}</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- //breadcrumb -->

{{--    <div id="top-adbar" class="esx hd-280 hm-260"></div>--}}

    <!-- page body -->
    <div class="container mt-30">
        <h1>{{ $category?->name }}</h1>
        <div class="cat-headline mb-30">
            <div class="row">
                <div class="column">
                    <div class="swiper-container mb-20" id="article-slider">
                        <div class="swiper-wrapper">
                            @foreach($main_headlines as $main_headline)
                            <div class="swiper-slide">
                                <a href="{{ route("front.category.newsletter.show", ["category_slug" =>$main_headline?->headlineable?->category?->slug, "newsletter_slug" => $main_headline?->headlineable?->slug ]) }}" title="{{ $main_headline?->headlineable?->title }}">
                                    <img src="{{ $main_headline?->headlineable?->image?->path }}" width="785" height="442" alt="{{ $main_headline?->headlineable?->title }}">

                                    <span class="title">{{ $main_headline?->headlineable?->title }}</span>
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
                <script src="https://s.ensonhaber.com/assets/js/swiper-bundle.min.js"></script>
                <div class="column column-33">
                    <div class="grid leftbox">
                        <div class="item">
                            <a href="https://www.ensonhaber.com/otomobil/dunyanin-en-cok-otomobil-satan-markasi-belli-oldu">
                                <picture class="thumb">
                                    <img src="https://icdn.ensonhaber.com/crop/400x225/resimler/diger/kok/2025/01/17/6789f4fc42715257.jpg" srcset="https://icdn.ensonhaber.com/crop/800x450/resimler/diger/kok/2025/01/17/6789f4fc42715257.jpg 2x" width="400" height="225" alt="Dünyanın en çok otomobil satan markası belli oldu" loading="lazy" />
                                </picture>
                                <span class="title-text">Dünyanın en çok otomobil satan markası belli oldu</span>
                            </a>


                        </div>
                        <div class="item">
                            <a href="https://www.ensonhaber.com/otomobil/cin-almanyadaki-volkswagen-fabrikalarina-goz-dikti">
                                <picture class="thumb">
                                    <img src="https://icdn.ensonhaber.com/crop/400x225/resimler/diger/kok/2025/01/17/6789f5b0dca6d206.jpg" srcset="https://icdn.ensonhaber.com/crop/800x450/resimler/diger/kok/2025/01/17/6789f5b0dca6d206.jpg 2x" width="400" height="225" alt="Çin, Almanya&#039;daki Volkswagen fabrikalarına göz dikti" loading="lazy" />
                                </picture>
                                <span class="title-text">Çin, Almanya'daki Volkswagen fabrikalarına göz dikti</span>
                            </a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //category headline -->
        <div class="row">
            <div class="column">
                <section class="mb-30">
                    <div class="grid grid-2">
                        <!-- item -->
                        @foreach($newsletters as $newsletter)
                        <div class="item">
                            <a href="{{ route("front.category.newsletter.show", ["category_slug" =>$newsletter->category_slug, "newsletter_slug" => $newsletter->slug ]) }}" title="{{ $newsletter?->title }}">
                                <picture class="thumb">
                                    <img src="{{ $newsletter?->path }}" srcset="{{ $newsletter?->path }} 2x" width="400" height="225" alt="{{ $newsletter?->title }}" loading="lazy" />
                                </picture>
                                <span class="title-text">{{ $newsletter?->title }}</span>
                            </a>
                        </div>
                        @endforeach
                        <!-- //item -->
                    </div>
                </section>
                <div class="pagination mb-10">
                    <ul>
                        <li class="active"><a href="javascript:;">1</a></li><li><a href="https://www.ensonhaber.com/otomobil/2">2</a></li><li><a href="https://www.ensonhaber.com/otomobil/3">3</a></li><li class="next"><a href="https://www.ensonhaber.com/otomobil/2" class="next"><span>Sonraki</span> &rarr;</a></li>                    </ul>
                </div>
            </div>
            <div class="column column-33 sidebar">
                <div class="top-60 sticky">
                    <!-- banner -->
                    <div class="esx ad-slot banner hd-250 hm-280 mb-40 " id="/9170022/ESHv2/kategori-sidebar"></div>
                </div>
                <!-- //sticky content -->
            </div>
        </div>
    </div>
    <!-- //page body -->

@endsection
@push('js')
    @vite([
    "resources/js/front/swiper/page.js",
])
@endpush
