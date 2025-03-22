$(document).ready(function () {
    // resizeText fonksiyonunu global olarak tanımlıyoruz.
    window.resizeText = function (direction) {
        $(".post.active").each(function () {
            var $post = $(this);
            // Varsayılan değer 3
            var fontValue = 3;
            if ($post.attr("data-font-size") !== undefined) {
                fontValue = parseFloat($post.attr("data-font-size"));
            }
            // Artırma, azaltma veya sıfırlama işlemi
            switch (direction) {
                case "up":
                    fontValue += 1;
                    if (fontValue > 8) {

                        return false;
                    }
                    break;
                case "down":
                    fontValue -= 1;
                    if (fontValue < 0) {

                        return false;
                    }
                    break;
                case "reset":
                    fontValue = 3;
                    break;
            }
            // data-font-size attribute'unu güncelle
            $post.attr("data-font-size", fontValue);

            // Hesaplama: Varsayılan 3 → %100, her bir artış 10% artış olarak ayarlanıyor
            var newFontSize = (100 + (fontValue - 3) * 10) + '%';

            // Bu post içerisindeki spot yazı ve içerik yazısını güncelle
            $post.find("#articledesc").css("font-size", newFontSize);
            $post.find(".content-text").css("font-size", newFontSize);
        });
    }
});
