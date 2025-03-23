$(document).ready(function () {
    var swiper = new Swiper("#sporslider", {
        loop: true, // Sonsuz döngü
        slidesPerView: 1, // Görünen slide sayısı
        spaceBetween: 10, // Slide'lar arasındaki boşluk
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: "#sporslider .swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 3000, // 3 saniye sonra otomatik kaydırma
            disableOnInteraction: false, // Kullanıcı müdahale ederse durmaz
        },
    });
});
