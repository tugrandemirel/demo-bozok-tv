$(document).ready(function () {
    var swiper = new Swiper("#sporslider", {
        loop: true, // Sonsuz döngü
        autoplay: {
            delay: 3000, // 3 saniyede bir geçiş yap
            disableOnInteraction: false, // Kullanıcı kaydırma yapınca durmasın
        },
        slidesPerView: 1,
        spaceBetween: 20, // Slide arası boşluk
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            1024: { slidesPerView: 3, spaceBetween: 20 }, // Büyük ekran
            768: { slidesPerView: 2, spaceBetween: 15 }, // Tablet
            480: { slidesPerView: 1, spaceBetween: 10 }, // Mobil
        }
    });
});
