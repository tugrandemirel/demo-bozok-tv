$(document).ready(function () {
    var swiper = new Swiper("#ls", {
        slidesPerView: 1,  // Aynı anda kaç slide gözükecek
        spaceBetween: 10,  // Slide'lar arası boşluk
        loop: true,  // Sonsuz döngü
        autoplay: {
            delay: 3000,  // 3 saniyede bir geçiş
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
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
});
