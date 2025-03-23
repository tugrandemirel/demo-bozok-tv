$(document).ready(function () {
    const $menuTrigger = $(".menutrigger");
    const $fullMenu = $("#fullmenu");
    const $overlay = $("#overlay");
    const $header = $("#header");
    const $body = $("body");
    const stickyClass = "sticky";
    const scrollThreshold = 50; // 50px aşağı kayınca sticky olacak
    const bodyPadding = "0px 0px 140px";
    const zIndexMenu = 9999; // Fullmenu için z-index
    const zIndexOverlay = 9998; // Overlay için z-index

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > scrollThreshold) {
            $header.addClass(stickyClass);
            $body.css("padding", bodyPadding);
        } else {
            $header.removeClass(stickyClass);
            $body.css("padding", "");
        }
    });

    if ($menuTrigger.length && $fullMenu.length) {
        $menuTrigger.on("click", function () {
            $fullMenu.toggleClass("active");

            // Ekran genişliği 667px veya daha küçük mü?
            if ($(window).width() <= 667) { // Mobil ekran boyutu kontrolü
                $overlay.addClass("hidden"); // Mobilde overlay'i gizle
            } else {
                if ($fullMenu.hasClass("active")) {
                    $fullMenu.css("z-index", zIndexMenu); // Menü açıldığında z-index ekle
                    $overlay.css("z-index", zIndexOverlay).removeClass("hidden"); // Overlay'i göster
                } else {
                    $fullMenu.css("z-index", ""); // Menü kapandığında z-index'i sıfırla
                    $overlay.css("z-index", "").addClass("hidden"); // Overlay'i gizle
                }
            }
        });
    }

    // Menü dışına tıklayınca kapatma
    $(document).on("click", function (event) {
        if (!$fullMenu.is(event.target) && !$menuTrigger.is(event.target) && $fullMenu.has(event.target).length === 0) {
            $fullMenu.removeClass("active");
            $overlay.addClass("hidden");

            // Z-index sıfırlama
            $fullMenu.css("z-index", "");
            $overlay.css("z-index", "");
        }
    });

    // Menü kapanma butonu
    $(document).on("click", ".hidemenu", function () {
        $fullMenu.removeClass("active");
        $overlay.addClass("hidden");

        // Z-index sıfırlama
        $fullMenu.css("z-index", "");
        $overlay.css("z-index", "");
    });
});
