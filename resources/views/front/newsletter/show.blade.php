@php use Illuminate\Support\Str; @endphp
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
    <div class="container fw-mobile" id="articles" data-newsletter="{{ $newsletter?->uuid }}" data-category="{{ $category?->slug }}">
        <div class="post active">
            <div class="row">
                <div class="column article-res">
                    <div class="row">
                        <div class="column column-10 column-social">
                            <div class="social" id="social">
                                <div class="social" id="social">
                                    <ul>
                                        <li><a href="javascript:" class="fontsize hint-bottom-middle" data-hint="Yazı Boyutunu Büyüt" onclick="resizeText('up');">A+</a></li>
                                        <li><a href="javascript:" class="fontsize hint-top-middle" data-hint="Yazı Boyutunu Küçült" onclick="resizeText('down');">A-</a></li>
                                        <li class="comment-shortcut hint-top-middle" id="go_to_comment" data-hint="Yorumlara Git">
                                            <div class="title">Yorum</div>
                                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 4h12v5H9v4H5.5L2 15.5V4zm8 6h12v11.5L18.5 19H10v-9zm2 2h8v1h-8v-1zm8 2h-8v1h8v-1zm-8 2h8v1h-8v-1z" fill="#ED0D0D"></path>
                                            </svg>
                                            <div class="comment-count">0 <span class="text">yorum</span></div>
                                        </li>
                                        <li>
                                            <div class="title">Paylaş</div>
                                            <a href="javascript:" data-share-platform="Whatsapp"
                                               class="icon whatsapp hint-top-middle"><span>WhatsApp</span>
                                            </a>
                                            <a href="javascript:" data-share-platform="Facebook"
                                               class="icon facebook hint-top-middle"><span>Facebook</span>
                                            </a>
                                            <a href="javascript:" data-share-platform="Twitter"
                                               class="icon twitter hint-top-middle"><span>Twitter</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="column column-article">
                            <article>
                                <div class="article-info">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route("front.index") }}">Haberler</a></li>
                                        <li class="sep"></li>
                                        <li>
                                            <a href="{{ route("front.category.show", ["category_slug" => $category?->slug]) }}">{{ $category?->name }}</a>
                                        </li>
                                        <li class="sep"></li>
                                        <li>{{ $newsletter?->title }}</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="article-title">
                                    <h1>{{ $newsletter?->title }}</h1>
                                    <h2 class="desc" id="articledesc" data-mode="desktop">
                                        {!! $newsletter?->spot !!}
                                    </h2>
                                </div>
                                <div class="article-date">
                                    <time datetime="2025-01-17T15:21:22+03:00">{{ $newsletter->created_at }}</time>
                                    <span>Güncellenme:<time datetime="2025-01-17T15:28:51+03:00">{{ $newsletter->updated_at }}</time></span>
                                </div>
                                <div class="article-share" id="articleshare" style="height: 30px;">
                                    <div class="google-news">
                                        <a href="https://news.google.com/u/1/publications/CAAqBwgKMLjcowsw--a7Aw?hl=tr&gl=TR&ceid=TR%3Atr"
                                           class="google-news" target="_blank">
                                            <span class="text">Abone Ol</span>
                                            <span class="icon">
                                            <img src="{{ asset("assets/media/svg/social-icons/google-news-text.svg") }}" width="88" height="15" alt="Google News"/>
                                        </span>
                                        </a>
                                    </div>
                                    <div class="social-links">
                                        <a href="javascript:" data-share-platform="Whatsapp"
                                           class="icon whatsapp hint-left-middle"></a>
                                        <a href="javascript:" data-share-platform="Facebook"
                                           class="icon facebook hint-left-middle"></a>
                                        <a href="javascript:" data-share-platform="Twitter"
                                           class="icon twitter hint-left-middle"></a>
                                    </div>
                                </div>
                                <div class="article-body">
                                    <div class="article-source">
                                        <span>
                                            {{ Str::upper($newsletter?->source?->name) }}
                                        </span>
                                    </div>
                                    <div class="content-text" property="articleBody">
                                        {!! $newsletter?->content !!}
                                    </div>
                                    <div class="article-author">
                                        <div class="avatar">
                                            <img loading="lazy" src="{{ asset($newsletter?->createdByUser?->profile_image) }}" width="40px" height="40px" alt="bozoktv icon">
                                        </div>
                                        <div class="name">
                                            <strong>{{ $newsletter?->createdByUser?->full_name }}</strong><br>
                                            Editor
                                        </div>
                                    </div>
                                </div>
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
                    <div class="comments">
                        <div class="head">
                            <i class="icon-question-answer"></i>
                            Yorumlar (<span class="comment-count" >0 <span class="text">yorum</span></span>)
                        </div>
                        <div id="writecontainer">
                            <div class="row row-write">
                                <div class="column">
                                    <div class="row">
                                        <div class="column">
                                            <div class="name"><label><strong>Adınız</strong></label>
                                                <input type="text" name="user_name" id="user_name" class="comment-username mb-0" value="Ziyaretçi" placeholder="Adınız">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row writecomment ">
                                        <div class="column">
                                            <div class="comment-row">
                                                <div class="richtext">
                                                    <label for=""><strong>Yorumunuz</strong> (<span id="comment_character">500 Karakter</span>)</label>
                                                    <textarea name="comment" id="comment" class="scroll" maxlength="500" placeholder="Herkese açık bir yorum ekleyin..."></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-10 align-items-center">
{{--                                                <div class="column">--}}
{{--                                                    <label class="mb-0">--}}
{{--                                                        <input type="checkbox" name="accept" id="accept" >--}}
{{--                                                        <strong>--}}
{{--                                                            <a href="javascript:">Yorum yazma kurallarını</a>--}}
{{--                                                        </strong>--}}
{{--                                                        okudum ve kabul ediyorum.--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
                                                <div class="column column-33 text-left">
                                                    <a href="javascript:" class="btn red" id="create_comment">Yorum Yaz</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <div class="comment-button-container">
                                    <a href="javascript:" class="btn red" id="comment-button"><i class="icon-chat"></i>Yorum Yapmak İçin Tıklayın</a>
                                </div>
                                <div class="comments-list" style="margin-top: 50px">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="related mb-50"></div>
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
@push('js')
    @vite([
    "resources/js/front/newsletter/show/resize.js",
    "resources/js/front/newsletter/show/comments.js",

])
@endpush
