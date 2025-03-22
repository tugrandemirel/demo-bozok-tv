$(document).ready(function () {
    let category_slug = $("#articles").data("category")
    let newsletter_uuid = $("#articles").data("newsletter")
    let url = "/" + category_slug + "/comment/fetch"

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    $.ajax({
        url : url,
        data : {
            newsletter_uuid: newsletter_uuid
        },
        type : 'POST',
        dataType : 'json',
        success : function(response){
            let { data } = response.data
            let comment_count = data.length
            $(".comment-count").html(comment_count + ` <span class="text">yorum</span>`)

            if (comment_count === 0) {
                let comments = $(".comments")
                let comment_button_container = comments.find(".comment-button-container")
                if (!comment_button_container.hasClass("centered")) {
                    comment_button_container.addClass("centered")
                }
                let no_comment = comments.find(".comments-list")
                no_comment.append(noComment())
            } else {
                data.map(function (comment) {
                    $(".comments-list").append(createComment("TUGRAN", comment.content))
                })
            }
        }
    });
})


const noComment =  () => {
    return `
    <div class="nocomment">
        <strong>Yorum Yok</strong> Henüz bu içeriğe yorum yapılmamış.
        <br>İlk yorum yapan olmak ister misiniz?
    </div>
    `
}
$("#go_to_comment").on("click", function(e) {
    e.preventDefault(); // Varsayılan tıklamayı engelle

    $("html, body").animate({
        scrollTop: $(".comments").offset().top
    }, 800); // 800ms sürede kaydır
});

$(document).on("click", "#comment-button", function() {
    const button = $(this)
    let add_comment = $("#writecontainer")
    if (add_comment.css("display", "none")) {
        add_comment.css("display", "block")
        button.hide()
    }
})

$(document).on("input", "#comment", function() {
    let comment = $(this)
    let comment_value = $(this).val()
    let comment_length = comment_value.length
    if (comment_length > 500) {
        return;
    }

    let comment_character_count = comment.closest(".richtext").find("#comment_character")
    const count = 500 - comment_length
    comment_character_count.text(count + " Karakter")
})

$(document).on("input", "#user_name", function() {
    let user_name = $(this)
    let user_name_value = $(this).val()
    let user_name_length = user_name_value.length
    if (user_name_length > 250) {
       return;
    }
})

$(document).on("click", "#create_comment", function() {
    const button = $(this)
    let comment_container = button.closest("#writecontainer")
    let user_name = comment_container.find("#user_name")
    let comment = comment_container.find("#comment")
    let accept = comment_container.find("#accept")

    let category_slug = $("#articles").data("category")
    let newsletter_uuid = $("#articles").data("newsletter")

    let form_data = new FormData()
    form_data.append("user_name", user_name.val())
    form_data.append("content", comment.val())
    form_data.append("newsletter_uuid", newsletter_uuid)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    $.ajax({
        url :"/" + category_slug + "/comment",
        data : form_data,
        type : 'POST',
        dataType: 'json',
        processData: false, // FormData ile gönderirken bunu false olmalı
        contentType: false, // jQuery'nin otomatik olarak contentType belirlenmesi engellenmeli
        success : function(response){
            $(".comments-list").prepend(createComment(user_name.val(), comment.val()))
            let add_comment = $("#writecontainer")
            let create_comment_button = $("#comment-button")

            if (add_comment.css("display", "block")) {
                add_comment.css("display", "none")
                create_comment_button.closest(".comment-button-container").removeClass("centered")
                create_comment_button.show()
            }
            comment.val(null).trigger("change")
            let comment_character_count = comment.closest(".richtext").find("#comment_character")
            const count = 500
            comment_character_count.text(count + " Karakter")
            user_name.val("Ziyaretçi").trigger("change")
        }
    });
})

const createComment = (user_name, comment) => {
    let first_character = user_name.charAt(0)
    return `
        <div class="item">
            <div class="comment">
                <div class="avatar"><img src="/assets/img/unknown.jpg" width="46" height="46" alt="">${first_character}</div>
                <div class="text">
                    <div class="info">
                        ${user_name}
                        <span class="date"><i class="icon-timer"></i>2 ay önce</span>
                         <a href="" class="report"><i class="icon-info-circle"></i></a>
                     </div>
                    <p>${comment}</p>
                    <div class="actions">
                        <a href="javascript:;" class="like">Beğen <span class="count">0</span></a>
                        <a href="javascript:;" class="dislike">Beğenme <span class="count">0</span></a>
                    </div>
                </div>
            </div>
        </div>
    `
}
