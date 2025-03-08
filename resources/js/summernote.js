$(document).ready(function () {
    $('.summernote').summernote({
        lang: 'tr-TR', // Türkçe dil desteği
        minHeight: 200,
        toolbar: [
            ['style', ['style']], // Stil menüsü
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']], // "justifyCenter" ekledik
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr', 'codeview', 'video']], // Kod bloğu ve resim ekleme
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']], // Font boyutu seçici
            ['view', ['fullscreen', 'help']] // Tam ekran ve yardım
        ],
        styleTags: [
            'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', // Başlık etiketleri
            'pre', 'blockquote' // Kod bloğu ve alıntı bloğu
        ],
        codemirror: {
            lineNumbers: true,
            theme: 'monokai'
        },
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia', 'Impact', 'Lucida Sans', 'Tahoma', 'Times New Roman', 'Verdana'],
        fontSizeUnits: ['px', 'pt', 'em', '%'], // Font boyut birimleri
        tableClassName: 'table table-bordered table-striped',
        callbacks: {
            onPaste: function(e) {
                var clipboardData = e.originalEvent.clipboardData;
                var items = clipboardData.items;
                for (var i = 0; i < items.length; i++) {
                    var item = items[i];
                    if (item.type.indexOf("image") === 0) {
                        var blob = item.getAsFile();
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            var image = new Image();
                            image.src = event.target.result;
                            image.onload = function() {
                                // Burada resmin boyutunu ayarlayabilirsiniz
                                image.width = Math.min(image.width, 800);  // Maksimum genişlik 800px
                                image.height = 'auto';  // Yüksekliğini otomatik olarak ayarlıyoruz
                                // Resmi Summernote editörüne ekleyin
                                var imageNode = $('<img>').attr('src', image.src);
                                $('.summernote').summernote('insertNode', imageNode[0]);
                            };
                        };
                        reader.readAsDataURL(blob);
                        e.preventDefault();  // Varsayılan yapıştırma işlemini engelliyoruz
                    }
                }
            },
            onChange: function(contents) {
                centerVideos(); // İçerik değiştiğinde iframe'leri draggable yap
            }
        }
    });

    // Kullanıcı iframe yapıştırdığında, draggable özellik ekleme
    function centerVideos() {
        $('#summernote').next('.note-editable').find('iframe').each(function () {
            // Eğer iframe bir div ile sarılmamışsa sar
            if (!$(this).parent().hasClass('video-wrapper')) {
                $(this).wrap('<div class="video-wrapper" style="text-align: center;"></div>');
            }
        });
    }

    // İlk çağrı
    centerVideos();
});
