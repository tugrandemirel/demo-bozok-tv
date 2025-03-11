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
        },
        breakpoints: {
            768: {
                slidesPerView: 2, // Tabletlerde 2 slayt göster
            },
            1024: {
                slidesPerView: 3, // Büyük ekranlarda 3 slayt göster
            }
        }
    });
});
