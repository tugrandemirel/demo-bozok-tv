$(document).ready(function () {
    var swiper = new Swiper("#rs", {
        loop: true, // Sonsuz döngü
        slidesPerView: 1, // Görünen slide sayısı
        spaceBetween: 10, // Slide'lar arasındaki boşluk
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: "#rs-numbers",
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index + 1) + "</span>";
            },
        },
        autoplay: {
            delay: 3000, // 3 saniye sonra otomatik kaydırma
            disableOnInteraction: false, // Kullanıcı müdahale ederse durmaz
        },
    });
});
