$(document).ready(function () {
    var swiper = new Swiper("#swiper-mosaic", {
        loop: true,  // Sonsuz döngü
        slidesPerView: 1, // Mobilde tek slayt gözüksün
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        }
    });
});
