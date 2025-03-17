@extends('front.layouts.app')
@section('title', $newsletter?->title ?? "Bozok TV" )
@push('css')
    @vite([
        "resources/css/page-detail.css",
    ])
@endpush
@section('content')

    <div id="sticky-ads">
        <div class="esx container">
            <div class="ad left esx-ads-container" id="pageskin_sol"></div>
            <div class="ad right esx-ads-container" id="pageskin_sag"></div>
        </div>
    </div>
{{--    <div data-id="masthead" class="top-adbar eshx hd-280 hm-280" style="height:300px;"></div>--}}

    <div class="container fw-mobile" id="articles">
        <!-- post -->
        <div class="post active">
            <div class="row">
                <div class="column article-res">
                    <div class="row">
                        <div class="column column-10 column-social">
                            <!-- social -->
                            <div class="social" id="social"></div>
                            <!-- //social -->
                        </div>
                        <div class="column column-article">
                            <article>

                                <!-- article info -->
                                <div class="article-info">

                                    <ul class="breadcrumb">
                                        <li><a href="{{ route("front.index") }}">Haberler</a></li>
                                        <li class="sep"></li>
                                        <li><a href="{{ route("front.category.show", ["category_slug" => $category?->slug]) }}">{{ $category?->name }}</a></li>
                                        <li class="sep"></li>
                                        <li>{{ $newsletter?->title }}</li>
                                    </ul>


                                    <div class="clearfix"></div>
                                </div>
                                <!-- //article info -->

                                <!-- article title -->
                                <div class="article-title">

                                    <h1>{{ $newsletter?->title }}</h1>

                                    <h2 class="desc" id="articledesc" data-mode="desktop">
                                        {!! $newsletter?->spot !!}
                                    </h2>

                                </div>
                                <!-- //article title -->

                                <!-- article date -->
                                <div class="article-date">
                                    <time datetime="2025-01-17T15:21:22+03:00">{{ $newsletter->created_at }}</time>
                                    <span>Güncellenme:
                            <time datetime="2025-01-17T15:28:51+03:00">{{ $newsletter->updated_at }}</time></span>
                                </div>
                                <!-- //article date -->

                                <!-- article share -->
                                <div class="article-share" id="articleshare" style="height: 30px;">
                                    <div class="google-news">
                                        <a href="https://news.google.com/u/1/publications/CAAqBwgKMLjcowsw--a7Aw?hl=tr&gl=TR&ceid=TR%3Atr" class="google-news" target="_blank">
                                            <span class="text">Abone Ol</span>
                                            <span class="icon">
                                            <img src="https://s.ensonhaber.com/assets/img/svg/google-news-text.svg" width="88" height="15" alt="Google News" />
                                        </span>
                                        </a>
                                    </div>
                                    <div class="social-links">
                                        <a href="javascript:;" data-share-platform="Whatsapp" class="icon whatsapp hint-left-middle"></a>
                                        <a href="javascript:;" data-share-platform="Facebook" class="icon facebook hint-left-middle"></a>
                                        <a href="javascript:;" data-share-platform="Twitter" class="icon twitter hint-left-middle"></a>
                                    </div>
                                </div>
                                <!-- //article share -->

                                <!-- article body -->
                                <div class="article-body">
                                    <div class="article-source">
                                        <span>
                                            {{ \Illuminate\Support\Str::upper($newsletter?->source?->name) }}
                                        </span>
                                    </div>

                                    <!-- //article source -->


                                    <!-- article content -->
                                    <div class="content-text" property="articleBody">
                                        {!! $newsletter?->content !!}
                                    </div>

                                    <div class="article-author">
                                        <div class="avatar">
                                            <img loading="lazy" src="{{ asset($newsletter?->createdByUser?->profile_image) }}" width="40px" height="40px" alt="bozoktv icon">
                                        </div>

                                        <div class="name">
                                            <strong>{{ $newsletter?->createdByUser?->full_name }}</strong><br>
                                            Editor                </div>
                                    </div>
                                    <!-- author -->
                                    <!-- //author -->
                                </div>
                                <!-- //article body -->
{{--                                <div class="taboola-end" id="taboola-below-article-widget-1"></div>--}}
{{--                                <script type="text/javascript">--}}
{{--                                    window._taboola = window._taboola || [];--}}
{{--                                    _taboola.push({--}}
{{--                                        mode: 'thumbnails-a-mid-1x3',--}}
{{--                                        container: 'taboola-below-article-widget-1',--}}
{{--                                        placement: 'Below Article Widget 1',--}}
{{--                                        target_type: 'mix'--}}
{{--                                    });--}}
{{--                                </script>--}}
                            </article>


                        </div>
                    </div>
                    <hr>
                    <!-- comments -->
{{--                    <div class="comments" data-id="1399332">--}}

{{--                        <div class="head">--}}
{{--                            <i class="icon-question-answer"></i> Yorumlar (<span class="comment-count" data-news-id="1399332">0 Yorum</span>)    </div>--}}



{{--                        <!-- write comment -->--}}
{{--                        <div id="writecontainer" data-id="1399332"></div>--}}
{{--                        <!-- //write comment -->--}}

{{--                        <!-- comments -->--}}
{{--                        <div class="row">--}}
{{--                            <div class="column">--}}

{{--                                <div class="comment-button-container">--}}
{{--                                    <a href="javascript:;" class="btn red" id="comment-button"><i class="icon-chat"></i> Yorum Yapmak İçin Tıklayın</a>--}}
{{--                                </div>--}}

{{--                                <!-- sort -->--}}
{{--                                <div class="title sort-comments" data-id="1399332">--}}
{{--                                    Yorum Sıralaması:--}}
{{--                                    <div class="dropdown">--}}
{{--                                        <span class="selected">En Popüler</span>--}}
{{--                                        <span class="arrow"></span>--}}
{{--                                        <ul>--}}
{{--                                            <li><a href="javascript:;" onclick="sortComments('1399332','newest');">Yeniden Eskiye</a></li>--}}
{{--                                            <li><a href="javascript:;" onclick="sortComments('1399332','oldest');">Eskiden Yeniye</a></li>--}}
{{--                                            <li><a href="javascript:;" onclick="sortComments('1399332','popular');">En Popüler</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- //sort -->--}}

{{--                                <!-- comments list -->--}}
{{--                                <div class="comments-list comments-ready working" data-id="1399332" data-page="0" data-sort="popular"></div>--}}
{{--                                <!-- //comments list -->--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- //comments -->--}}

{{--                        <!-- show all -->--}}
{{--                        <div class="row row-show-more-comments">--}}
{{--                            <div class="column">--}}
{{--                                <a href="javascript:;" class="show-more-comments" data-target="1399332">--}}
{{--                                    <i class="icon-question-answer"></i> <br>--}}
{{--                                    Daha Fazla Yorum Yükle<br>--}}
{{--                                    <span class="counter">--}}
{{--                <span class="comment-count" data-news-id="1399332">0 Yorum Yapılmış</span>--}}
{{--            </span>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- show all -->--}}
{{--                    </div>--}}
{{--                    <hr class="mt-0">--}}
                    <!-- //comments -->
                    <!-- related -->
                    <div class="related mb-50"></div>
                    <!-- //related -->
                </div>
{{--                <div class="column column-29 sidebar">
                    <div class="eshx banner hd-280 hm-250 mb-40" data-id="sidebar"></div>

                    <div class="shotnews mb-30">

                        <div class="shotsItem item">
                            <a href="israil-basini-israil-hukumeti-ateskesi-onayladi.html">
                                <img loading="lazy" src="https://icdn.ensonhaber.com/crop/400x225/resimler/diger/kok/2025/01/17/678ac06bb9335874.jpg" alt="İsrail hükümeti ateşkesi onayladı" height="225" width="400"/>
                            </a>
                            <a href="israil-basini-israil-hukumeti-ateskesi-onayladi.html">
                                <span class="text">İsrail hükümeti ateşkesi onayladı</span>
                            </a>
                        </div>


                        <div class="shotsItem item">
                            <a href="antalyada-teleferik-davasinda-tutuklu-sanik-kalmadi.html">
                                <img loading="lazy" src="https://icdn.ensonhaber.com/crop/400x225/resimler/diger/kok/2025/01/17/678ab4c46f476152.jpg" alt="Teleferik davasında tutuklu sanık kalmadı" height="225" width="400"/>
                            </a>
                            <a href="antalyada-teleferik-davasinda-tutuklu-sanik-kalmadi.html">
                                <span class="text">Teleferik davasında tutuklu sanık kalmadı</span>
                            </a>
                        </div>







                    </div>

                    <div class="sticky top-60">
                        <div class="eshx banner  mb-40" data-id="sidebar2"></div>
                    </div>
                </div>--}}
            </div>

        </div>
        <!-- //post -->

    </div>
@endsection
@push('js') @endpush
