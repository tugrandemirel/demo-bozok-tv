$(document).on('change', '#five_cuff', function() {
    let checkbox = $(this)
    let five_cuff_image = $('#five_cuff_image')
    if(checkbox.is(':checked')) {
        if (five_cuff_image.hasClass('hidden')) {
            five_cuff_image.removeClass('hidden')
        }
    } else {
        five_cuff_image.addClass('hidden')
    }
})
$(document).on('input', '#meta_description', function() {
    let description = $(this);
    let character_count = description.next().find('.character_count'); // Bir sonraki sibling olan p içindeki karakter sayısını al
    character_count.text('Kalan karakter sayısı: ' + (150 - description.val().length)); // Kalan karakter sayısını güncelle
    if (description.val().length > 150) {
        description.addClass('is-invalid');
        character_count.addClass('text-danger');
    } else {
        description.removeClass('is-invalid');
        character_count.removeClass('text-danger');
    }
});



$(document).on('input', '#meta_title', function() {
    let title = $(this);
    let character_count = title.next().find('.character_count'); // Bir sonraki sibling olan p içindeki karakter sayısını al
    character_count.text('Kalan karakter sayısı: ' + (60 - title.val().length)); // Kalan karakter sayısını güncelle
    if (title.val().length > 60) {
        title.addClass('is-invalid');
        character_count.addClass('text-danger');
    } else {
        title.removeClass('is-invalid');
        character_count.removeClass('text-danger');
    }
});

$(document).on('input', '#meta_tag', function() {
    let tag = $(this);
    let character_count = tag.next().find('.character_count'); // Bir sonraki sibling olan p içindeki karakter sayısını al
    character_count.text('Kalan karakter sayısı: ' + (110 - tag.val().length)); // Kalan karakter sayısını güncelle
    if (tag.val().length > 110) {
        tag.addClass('is-invalid');
        character_count.addClass('text-danger');
    } else {
        tag.removeClass('is-invalid');
        character_count.removeClass('text-danger');
    }
});
$(document).ready(function () {
    if ($('#is_seo').is(':checked')) {
        $('#meta_title').prop('disabled', true);
        $('#meta_tag').prop('disabled', true);
        $('#meta_description').prop('disabled', true);
    }
})
$(document).on('change', '#is_seo', function () {
    let input = $(this);
    if (input.is(':checked')) {
        $('#meta_title').prop('disabled', true);
        $('#meta_tag').prop('disabled', true);
        $('#meta_description').prop('disabled', true);
    } else {
        $('#meta_title').prop('disabled', false);
        $('#meta_tag').prop('disabled', false);
        $('#meta_description').prop('disabled', false);
    }
})
