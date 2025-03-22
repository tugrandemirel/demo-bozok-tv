<!DOCTYPE html>
<html lang="tr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>@yield('title')</title>
    <meta name="description"
          content="Haberler ve güncel gelişmeler, gündemden ekonomiye son dakika haberler Türkiye'nin en çok takip edilen flaş haber sitesi En Son Haber'de.">
    <link rel="canonical" href="{{ route("front.index") }}">
    <link rel="preload" href="{{ asset("assets/fonts/inter/inter-v2-latin-ext_latin-regular.woff2") }}"
          as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset("assets/fonts/inter/inter-v2-latin-ext_latin-300.woff2") }}" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset("assets/fonts/inter/inter-v2-latin-ext_latin-500.woff2") }}" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset("assets/fonts/inter/inter-v2-latin-ext_latin-600.woff2") }}" as="font"
          type="font/woff2" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preload" href="{{ asset("assets/fonts/inter/inter-v2-latin-ext_latin-700.woff2") }}" as="font"
          type="font/woff2" crossorigin="anonymous">


{{--    <link rel="shortcut icon" type="image/x-icon" href="https://s.ensonhaber.com/assets/img/faviconv2/favicon.ico">--}}
{{--    <link rel="apple-touch-icon" sizes="72x72" href="../s.ensonhaber.com/assets/img/faviconv2/apple-icon-72x72.png">--}}
{{--    <link rel="apple-touch-icon" sizes="76x76" href="../s.ensonhaber.com/assets/img/faviconv2/apple-icon-76x76.png">--}}
{{--    <link rel="apple-touch-icon" sizes="114x114" href="../s.ensonhaber.com/assets/img/faviconv2/apple-icon-114x114.png">--}}
{{--    <link rel="apple-touch-icon" sizes="144x144" href="../s.ensonhaber.com/assets/img/faviconv2/apple-icon-144x144.png">--}}
{{--    <link rel="apple-touch-icon" sizes="152x152" href="../s.ensonhaber.com/assets/img/faviconv2/apple-icon-152x152.png">--}}
{{--    <link rel="icon" type="image/png" sizes="192x192"--}}
{{--          href="../s.ensonhaber.com/assets/img/faviconv2/android-icon-192x192.png">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="../s.ensonhaber.com/assets/img/faviconv2/favicon-32x32.png">--}}
{{--    <link rel="icon" type="image/png" sizes="96x96" href="../s.ensonhaber.com/assets/img/faviconv2/favicon-96x96.png">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="../s.ensonhaber.com/assets/img/faviconv2/favicon-16x16.png">--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('css')
    <script type="text/javascript">
        var theme = localStorage.getItem("sitetheme");
        if (theme !== null) {
            document.documentElement.dataset.theme = theme;
        }
    </script>

</head>

<body>


<!-- header -->
@include("front.layouts.header")
<!-- //header -->

<!-- borsa ticker -->
<div id="borsaticker-wrapper"></div>
<!-- //borsa ticker -->

<!-- main -->
<main id="main">
@yield('content')
</main>
<!-- //main -->


<!-- overlay -->
<div id="overlay" class="hidden"></div>
<!-- //overlay -->

@include("front.layouts.footer")
<a href="javascript:;" id="gotop">
    <span class="text">Başa dön</span>
    <i class="icon-expand-less"></i>
</a>

@stack("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset("assets/js/scrollbooster.min.js") }}" defer></script>
<script src="{{ asset("assets/js/home.min.js") }}" defer></script>
<script src="{{ asset("/assets/plugins/global/lazysizes.min.js") }}" defer></script>

</body>

</html>
