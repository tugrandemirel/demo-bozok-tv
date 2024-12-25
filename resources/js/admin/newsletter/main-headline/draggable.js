"use strict";
var KTCardDraggable = {
    init: function () {
        var a = document.querySelectorAll(".draggable-zone");
        if (0 === a.length) return !1;
        let draggable = new Sortable.default(a, {
            draggable: ".draggable",
            handle: ".draggable .draggable-handle",
            mirror: {
                appendTo: "body", // Aynayı gövdeye ekle
                constrainDimensions: true // Aynayı sınırla
            },
            onEnd: function (event) {
                console.log(event)
            }
        })
        draggable.on('drag:stop', (event) => {
            const container = event.source.parentNode;
            const sortedUUIDs = Array.from(container.children)
                .filter(item => !item.classList.contains('draggable--mirror')) // Ayna elemanını filtrele
                .map(item => item.dataset.uuid);
            axios.post('/admin/dashboard/newsletters/main-headlines/update', {  uuids: sortedUUIDs, })
                .then(function (response) {
                    console.log("Sıralama başarıyla güncellendi:", response.data);
                })
                .catch(function (error) {
                    console.error("Hata oluştu:", error);
                });
        })
    }
};
jQuery(document).ready((function () {
    KTCardDraggable.init()
}));
