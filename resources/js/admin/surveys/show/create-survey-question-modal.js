$(document).on('click', '#addAnswer', function () {
    let newAnswerGroup = $(`
        <div class="form-group repeater">
            <label for="answer">Soru Seçeneği</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="answer_text[]">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-icon btn-circle btn-transparent-danger remove-answer"><i class="flaticon2-trash"></i></button>
                </div>
            </div>
        </div>
    `);
    // Yeni form grubunu form içine ekle
    $(this).closest('form').append(newAnswerGroup);
});

// Cevapları silmek için
$(document).on('click', '.remove-answer', function (e) {
    e.preventDefault();
    $(this).closest('.form-group').remove(); // İlgili form grubunu sil
});

