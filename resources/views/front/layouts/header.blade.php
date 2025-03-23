<header id="header">
    <!-- menu container -->
    <div class="container">
        <div class="row">
            <!-- logo & slogan -->
            <div class="column column-brand">
                <h1 class="logo">
                    <a href="{{ route("front.index") }}">
                        <img src="{{ asset($general_setting?->logo["path"]) }}" alt="{{ $general_setting?->site_name }}" width="175" height="30" class="light" id="logoImage"/>
                    </a>
                </h1>
                <!-- slogan -->
                <div class="slogan">
                </div>
                <!-- //slogan -->
                <div class="clearfix"></div>
            </div>
            <!-- //logo & slogan -->
            <!-- top menu -->
            <div class="column">
                <div class="topmenu">
                    <ul>
                        {{--                        <li><a href="javascript:;" class="ara" onclick="searchForm();">Ara</a></li>--}}
                        {{--                        <li><a href="canli-tv.html" class="canli-tv">Canlı TV</a></li>--}}
                        <li><a href="javascript:" class="tema dark hint-bottom-middle" data-hint="Gündüz Modunu Aç"
                               onclick="toggleTheme();">Tema</a></li>
                        <li><a href="javascript:" class="tema light hint-bottom-middle" data-hint="Gece Modunu Aç"
                               onclick="toggleTheme();">Tema</a></li>
                        {{--<li id="top-user-menu"><a href="javascript:;" class="hint-bottom-middle user"
                                                  data-hint="Giriş & Kayıt"
                                                  onclick="loginActions.loginModal();">Üyelik</a></li>--}}
                        {{--                        <li><span class="flagtr"></span></li>--}}
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- //top menu -->
        </div>
        <!-- main menu -->
        <div class="row">
            <div class="column relative">
                <div class="mainmenu" id="mainmenu">
                    <ul class="menu">
                        {{--                        <li><a href="son-dakika-haberleri.html" class="hot">SON DAKİKA</a></li>--}}
                        @foreach($home_categories as $home_category)
                            <li><a href="{{ route("front.category.show", ["category_slug" => $home_category?->slug]) }}"
                                   class="mt-2">{{ $home_category?->name }}</a></li>
                        @endforeach
                        <li class="all"><a href="javascript:" class="all menutrigger">MENÜ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- //main menu -->
    </div>
    <!-- menu trigger -->
    <a href="javascript:" class="mobile-menu-trigger menutrigger">
        <span>MENU</span>
    </a>
    <!-- //menu trigger -->
</header>
<div id="fullmenu" class="">
    <!-- menu head -->
    <div class="menu-head">
        <!-- nav -->
        <div class="nav">
            <a href="/son-dakika-haberleri"><i class="icon-alarm"></i> <span class="text">Son Dakika</span></a>
            <a href="https://videonuz.ensonhaber.com/" target="_blank"><i class="icon-play-arrow"></i> <span
                    class="text">Video</span></a>
{{--            <a href="/canli-tv"><i class="icon-smart-display"></i> <span class="text">Canlı TV</span></a>--}}
            <!-- <a href="/mansetler.htm"><i class="icon-layers"></i> <span class="text">Arşiv</span></a> -->
            <a href="javascript:" onclick="toggleTheme();">
                <i class="icon-brightness-moon light"></i>
                <i class="icon-brightness-dark dark"></i>
                <span class="text">Tema</span>
            </a>
{{--            <a href="javascript:" class="btn-search" onclick="toggleMobileSearch();">--}}
{{--                <i class="icon-search"></i>--}}
{{--                <i class="icon-close close-search"></i>--}}
{{--                <span class="text">Arama</span>--}}
{{--            </a>--}}
            <!-- <a href="javascript:;" class="btn-close" onclick="toggleMenu();"><i class="icon-close"></i> <span class="text">Kapat</span></a> -->
        </div>
        <!-- //nav -->
        <!-- logo -->
        <div class="nav-logo">
            <a href="{{ route("front.index") }}" style="background-image: url({{ asset($general_setting?->logo["path"]) }})" alt="{{ $general_setting?->site_name }}" class="logo-bg"><span>Ensonhaber</span></a>
            <a href="javascript;" class="btn-close hint-left-middle hidemenu" data-hint="Menüyü Kapat"><i class="icon-close"></i></a>
        </div>
        <!-- //logo -->
    </div>
    <!-- //menu head -->
    <!-- menu body -->
    <div class="menu-body scroll">
        <!-- stats -->
        {{--        <div id="menustats" class="stats">--}}
        {{--            <!-- date -->--}}
        {{--            <div class="date">--}}
        {{--                <span class="dayname" id="menudayname">Cumartesi</span>--}}
        {{--                <span class="day" id="menuday">22</span>--}}
        {{--                <span class="month" id="menumonth">Mart</span>--}}
        {{--            </div>--}}
        {{--            <!-- //date -->--}}
        {{--            <!-- weather -->--}}
        {{--            <div id="menuweather" class="weather hint-bottom-middle" data-hint="Yer yer bulutlu">--}}
        {{--                <span class="icon">--}}
        {{--                    <img src="/assets/img/svg/weather/set1/fill/36.svg" alt="Yer yer bulutlu">--}}
        {{--                    </span>--}}
        {{--                <select name="city" id="weathercity">--}}
        {{--                    <option value="adana">Adana</option>--}}
        {{--                    <option value="adiyaman">Adıyaman</option>--}}
        {{--                    <option value="afyon">Afyon</option>--}}
        {{--                    <option value="agri">Ağrı</option>--}}
        {{--                    <option value="aksaray">Aksaray</option>--}}
        {{--                    <option value="amasya">Amasya</option>--}}
        {{--                    <option value="ankara">Ankara</option>--}}
        {{--                    <option value="antalya">Antalya</option>--}}
        {{--                    <option value="ardahan">Ardahan</option>--}}
        {{--                    <option value="artvin">Artvin</option>--}}
        {{--                    <option value="aydin">Aydın</option>--}}
        {{--                    <option value="balikesir">Balıkesir</option>--}}
        {{--                    <option value="bartin">Bartın</option>--}}
        {{--                    <option value="batman">Batman</option>--}}
        {{--                    <option value="bayburt">Bayburt</option>--}}
        {{--                    <option value="bilecik">Bilecik</option>--}}
        {{--                    <option value="bingol">Bingöl</option>--}}
        {{--                    <option value="bitlis">Bitlis</option>--}}
        {{--                    <option value="bolu">Bolu</option>--}}
        {{--                    <option value="burdur">Burdur</option>--}}
        {{--                    <option value="bursa">Bursa</option>--}}
        {{--                    <option value="canakkale">Çanakkale</option>--}}
        {{--                    <option value="cankiri">Çankırı</option>--}}
        {{--                    <option value="corum">Çorum</option>--}}
        {{--                    <option value="denizli">Denizli</option>--}}
        {{--                    <option value="diyarbakir">Diyarbakır</option>--}}
        {{--                    <option value="duzce">Düzce</option>--}}
        {{--                    <option value="edirne">Edirne</option>--}}
        {{--                    <option value="elazig">Elazığ</option>--}}
        {{--                    <option value="erzincan">Erzincan</option>--}}
        {{--                    <option value="erzurum">Erzurum</option>--}}
        {{--                    <option value="eskisehir">Eskişehir</option>--}}
        {{--                    <option value="gaziantep">Gaziantep</option>--}}
        {{--                    <option value="giresun">Giresun</option>--}}
        {{--                    <option value="gumushane" selected="">Gümüşhane</option>--}}
        {{--                    <option value="hakkari">Hakkari</option>--}}
        {{--                    <option value="hatay">Hatay</option>--}}
        {{--                    <option value="igdir">Iğdır</option>--}}
        {{--                    <option value="isparta">Isparta</option>--}}
        {{--                    <option value="istanbul">İstanbul</option>--}}
        {{--                    <option value="izmir">İzmir</option>--}}
        {{--                    <option value="kahramanmaras">Kahramanmaraş</option>--}}
        {{--                    <option value="karabuk">Karabük</option>--}}
        {{--                    <option value="karaman">Karaman</option>--}}
        {{--                    <option value="kars">Kars</option>--}}
        {{--                    <option value="kastamonu">Kastamonu</option>--}}
        {{--                    <option value="kayseri">Kayseri</option>--}}
        {{--                    <option value="kirikkale">Kırıkkale</option>--}}
        {{--                    <option value="kirklareli">Kırklareli</option>--}}
        {{--                    <option value="kirsehir">Kırşehir</option>--}}
        {{--                    <option value="kilis">Kilis</option>--}}
        {{--                    <option value="kocaeli">Kocaeli</option>--}}
        {{--                    <option value="konya">Konya</option>--}}
        {{--                    <option value="kutahya">Kütahya</option>--}}
        {{--                    <option value="malatya">Malatya</option>--}}
        {{--                    <option value="manisa">Manisa</option>--}}
        {{--                    <option value="mardin">Mardin</option>--}}
        {{--                    <option value="mersin">Mersin</option>--}}
        {{--                    <option value="mugla">Muğla</option>--}}
        {{--                    <option value="mus">Muş</option>--}}
        {{--                    <option value="nevsehir">Nevşehir</option>--}}
        {{--                    <option value="nigde">Niğde</option>--}}
        {{--                    <option value="ordu">Ordu</option>--}}
        {{--                    <option value="osmaniye">Osmaniye</option>--}}
        {{--                    <option value="rize">Rize</option>--}}
        {{--                    <option value="sakarya">Sakarya</option>--}}
        {{--                    <option value="samsun">Samsun</option>--}}
        {{--                    <option value="siirt">Siirt</option>--}}
        {{--                    <option value="sinop">Sinop</option>--}}
        {{--                    <option value="sivas">Sivas</option>--}}
        {{--                    <option value="sanliurfa">Şanlıurfa</option>--}}
        {{--                    <option value="sirnak">Şırnak</option>--}}
        {{--                    <option value="tekirdag">Tekirdağ</option>--}}
        {{--                    <option value="tokat">Tokat</option>--}}
        {{--                    <option value="trabzon">Trabzon</option>--}}
        {{--                    <option value="tunceli">Tunceli</option>--}}
        {{--                    <option value="usak">Uşak</option>--}}
        {{--                    <option value="van">Van</option>--}}
        {{--                    <option value="yalova">Yalova</option>--}}
        {{--                    <option value="yozgat">Yozgat</option>--}}
        {{--                    <option value="zonguldak">Zonguldak</option>--}}
        {{--                </select>--}}
        {{--                <span class="temperature">-1°</span></div>--}}
        {{--            <!-- weather -->--}}
        {{--            <!-- currencies -->--}}
        {{--            <div id="menucurrency" class="currencies"><span class="name">Dolar</span>--}}
        {{--                <span class="currency">₺37.64</span>--}}
        {{--                <span class="percent green">0.04%</span></div>--}}
        {{--            <!-- //currencies -->--}}
        {{--        </div>--}}
        <!-- //stats -->
        <!-- links -->
        @foreach($home_categories as $home_category)
            <div class="item" role="menuitem">
                <a href="{{ route("front.category.show", ["category_slug" => $home_category?->slug]) }}" class="title">{{ $home_category?->name }}</a>
            </div>
        @endforeach
        {{--        <div class="item link" role="menuitem">--}}
        {{--            <a href="/namaz-vakitleri" class="title">Namaz Vakitleri</a>--}}
        {{--            <a href="/hakkimizda" class="title">Hakkımızda</a>--}}
        {{--            <a href="/kunye" class="title">Künye</a>--}}
        {{--        </div>--}}
        <!-- //links -->
        <!-- stores -->
        {{--        <div class="stores">--}}
        {{--            <a href="https://play.google.com/store/apps/details?id=com.ysb.esh&amp;hl=tr" target="_blank"--}}
        {{--               class="store google"><span>Mobil Uygulama</span> Google Store</a>--}}
        {{--            <a href="https://apps.apple.com/us/app/ensonhaber/id353599677" target="_blank" class="store apple"><span>Mobil Uygulama</span>--}}
        {{--                Apple Store</a>--}}
        {{--            <a href="https://appgallery.huawei.com/app/C101130345" target="_blank" class="store huawei"><span>Mobil Uygulama</span>--}}
        {{--                App Gallery</a>--}}
        {{--            <div class="clearfix"></div>--}}
        {{--        </div>--}}
        <!-- //stores -->
    </div>
    <!-- //menu body -->
</div>

