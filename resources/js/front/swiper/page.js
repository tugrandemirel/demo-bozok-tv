$(document).ready(function () {
    var swiper = new Swiper("#article-slider", {
        slidesPerView: 1,  // Aynı anda kaç slide gözükecek
        spaceBetween: 10,  // Slide'lar arası boşluk
        loop: true,  // Sonsuz döngü
        autoplay: {
            delay: 3000,  // 3 saniyede bir geçiş
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: { // Mobilde farklı ayarlar kullanabiliriz
                pagination: {
                    dynamicBullets: false, // Mobilde bullet'lar normal şekilde görünsün
                    clickable: true
                }
            }
        },
        on: {
            slideChange: function () {
                $(".lazyload").each(function () {
                    if (!$(this).attr("src")) {
                        $(this).attr("src", $(this).attr("data-src"));
                    }
                });
            }
        }
    });
    $(".slider-numbers").append('<a class="all" href="" target="_blank"><strong>T</strong></a>');
});
