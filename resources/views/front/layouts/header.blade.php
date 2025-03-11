<header id="header">

    <!-- menu container -->
    <div class="container">
        <div class="row">

            <!-- logo & slogan -->
            <div class="column column-brand">
                <h1 class="logo">
                    <a href="{{ route("front.index") }}">
                        <img src="{{ asset($general_setting?->logo["path"]) }}" alt="Ensonhaber" width="175" height="30" class="light"
                             id="logoImage"/>
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
                        <li><a href="javascript:;" class="tema dark hint-bottom-middle" data-hint="Gündüz Modunu Aç"
                               onclick="toggleTheme();">Tema</a></li>
                        <li><a href="javascript:;" class="tema light hint-bottom-middle" data-hint="Gece Modunu Aç"
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
                            <li><a href="{{ route("front.category.show", ["category_slug" => $home_category?->slug]) }}" class="mt-2">{{ $home_category?->name }}</a></li>
                        @endforeach
                        <li class="all"><a href="javascript:;" class="all menutrigger">MENÜ</a></li>
                    </ul>


                </div>
            </div>
        </div>
        <!-- //main menu -->
    </div>
    <!-- menu trigger -->
    <a href="javascript:;" class="mobile-menu-trigger menutrigger">
        <span>MENU</span>
    </a>
    <!-- //menu trigger -->
</header>
