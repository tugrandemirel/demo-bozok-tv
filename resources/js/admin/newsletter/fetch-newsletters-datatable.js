"use strict"
let NewslettersDatatablesDataSourceAjaxServer = function () {

    let initTable1 = function () {
        let newsletters_datatable = $('#newsletters_datatable');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });


        // begin first table
        newsletters_datatable.DataTable({
            "fixedHeader": {
                "header":true
            },
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            searching: true,
            dom: `<'row'<'col-sm-12'tr>>
          <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            "language": {
                "emptyTable": "Boş Tablo",
                "processing": `<button type="button" class="btn btn-lg btn-light-success spinner bg-primary spinner-white spinner-left mr-3 text-white">Yükleniyor</button>`,
                "sDecimal": ",",
                "sInfo": "_TOTAL_ kayıttan _START_ - _END_ veri göster",
                "sInfoFiltered": "(_MAX_ veri bulundu)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Sayfa _MENU_ veri göster",
                "sLoadingRecords": "Yükleniyor",
                "sSearch": "Arama",
                "sZeroRecords": "Veri bulunamadı",
                "oPaginate": {
                    "sFirst": "İlk",
                    "sLast": "Son",
                    "sNext": "Sonraki",
                    "sPrevious": "Önceki"
                },
                "oAria": {
                    "sSortAscending": "Artan sıra",
                    "sSortDescending": "Azalan sıra"
                },
                "select": {
                    "rows": {
                        "_": "%d kayıt seçildi",
                        "0": "",
                        "1": "1 kayıt seçildi"
                    }
                }
            },
            order: [[1, 'desc']],
            "ordering": true,
            ajax: {
                url: '/admin/dashboard/newsletters',
                type: 'POST',
                data: {
                    columnsDef: [
                        "title", "category_name", "tag_name", "status_name", "publish_date"
                    ],

                },
            },
            "columnDefs": [
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        var index = KTUtil.getRandomInt(1, 7);

                        return data + '<span class="ms-2 badge badge-light-' + status[index]['state'] + ' fw-semibold">' + status[index]['title'] + '</span>';
                    },
                    "targets": 1
                }
            ],
            columns: [
                {
                    data: "title",
                    class: "min-w-150px",
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex flex-column flex-grow-1">
                           <span class="text-dark-75 mb-1 font-size-lg"><i class="fa fa-fill-drip text-primary"></i> ${row.title}</span>
                        </div>
                        `
                    },
                    searchable: false,

                },
                {
                    data: "category_name",
                    class: "min-w-150px",
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex flex-column flex-grow-1">
                           <span class="text-dark-75 mb-1 font-size-lg"><i class="fa fa-fill-drip text-primary"></i> ${row.category_name}</span>
                        </div>
                        `
                    },
                    searchable: false,

                },
                {
                    data: "tag_name",
                    class: "min-w-150px",
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex flex-column flex-grow-1">
                           <span class="text-dark-75 mb-1 font-size-lg"><i class="fa fa-fill-drip text-primary"></i> ${row.tag_name}</span>
                        </div>
                        `
                    },
                    searchable: false,

                },
                {
                    data: "status_name",
                    class: "min-w-100px text-center",
                    render: function (data, type, row) {
                        let html;
                        if (row.status_code === 'on-the-air') {
                            html = `<a href="#" class="btn btn-icon btn-light-success pulse pulse-success mr-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Yayında">
                                <i class="flaticon2-protected"></i>
                                <span class="pulse-ring"></span>
                            </a>`
                        } else if (row.status_code === 'draft') {
                            html = `
                                <a href="#" class="btn btn-icon btn-light-danger pulse pulse-danger mr-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Taslak">
                                    <i class="flaticon2-information"></i>
                                    <span class="pulse-ring"></span>
                                </a>
                            `
                        } else if (row.status_code === 'archive') {
                            html = `
                                <a href="#" class="btn btn-icon btn-light-warning pulse pulse-warning mr-5" data-bs-toggle="tooltip" data-bs-placement="right" title="Arşiv">
                                    <i class="flaticon2-gear"></i>
                                    <span class="pulse-ring"></span>
                                </a>
                            `
                        } else {
                            html = '-'
                        }
                        return html
                    },
                    searchable: false,

                },
                {
                    data: "publish_date",
                    class: "min-w-100px text-center",
                    render: function (data, type, row) {

                        let publish_date = row.publish_date;

                        moment.locale("tr");

                        let publish_date_format = moment(publish_date);
                        publish_date = publish_date_format.format("Do MMM YYYY");

                        return `
                        <div class="d-flex flex-column flex-grow-1">
                           <span class="text-dark-75 mb-1 font-size-lg">${publish_date ?? '-'}</span>
                        </div>
                        `
                    },
                    searchable: false,

                },
                {
                    data: null,
                    class: "min-w-100px",
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex justify-content-center">
                          <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary font-weight-bold btn_fuel_receipt_detail" data-value="${row.uuid}"><i class="fas fa-search-plus icon-md"></i>Detayları Göster</a>
                        </div>
                          `;
                    },
                    searchable: false,
                    orderable: false,
                },
            ],
        });
    };

    return {

        //main function to initiate the module
        init: function () {
            initTable1();
        },
    };
}();


$(document).ready(function () {

    NewslettersDatatablesDataSourceAjaxServer.init();
});


/*
function datatableFilterInputData() {

    let search_keyword = $("#search_newsletters_datatable").val();

    if (search_keyword.length > 256) {
        Swal.fire({
            text: trans("you_can_search_for_values_up_to_256_characters_long"),
            icon: "warning",
            buttonsStyling: false,
            confirmButtonText: trans("ok"),
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
        return;
    }

    let station_fuel_outlet_filter_fuel_tank = $("#station_fuel_outlet_filter_fuel_tank").val();
    let station_fuel_outlet_filter_start_month = $("#station_fuel_outlet_filter_start_month").val();
    let station_fuel_outlet_filter_start_year = $("#station_fuel_outlet_filter_start_year").val();
    let station_fuel_outlet_filter_fuel_type = $("#station_fuel_outlet_filter_fuel_type").val();
    let station_fuel_outlet_filter_fuel_outlet_target = $("#station_fuel_outlet_filter_fuel_outlet_target").val();
    let station_fuel_outlet_filter_fuel_outlet_purpose = $("#station_fuel_outlet_filter_fuel_outlet_purpose").val();

    let newsletters_datatable = $('#newsletters_datatable').dataTable();

    let post_data = {
        "fuel_tank": station_fuel_outlet_filter_fuel_tank,
        "start_month": station_fuel_outlet_filter_start_month,
        "start_year": station_fuel_outlet_filter_start_year,
        "fuel_type": station_fuel_outlet_filter_fuel_type,
        "fuel_outlet_target": station_fuel_outlet_filter_fuel_outlet_target,
        "fuel_outlet_purpose": station_fuel_outlet_filter_fuel_outlet_purpose,
        "search_keyword": search_keyword,
        "capital_case_sensitive": global_capital_case_sensitive_newsletters_datatable,
    };

    newsletters_datatable.fnFilter(JSON.stringify(post_data))
}*/
/*

$(document).on("keyup", "#search_newsletters_datatable", _.debounce(function (e) {
    datatableFilterInputData();
}, 2000));

$(document).on("click", "#btn_filter_newsletters_datatable", function () {
    datatableFilterInputData();
});

$(document).on("click", "#btn_clear_filter_newsletters_datatable", function () {

    $("#station_fuel_outlet_filter_fuel_tank").val(null).trigger("change");
    $("#station_fuel_outlet_filter_start_month").val(null).trigger("change");
    $("#station_fuel_outlet_filter_start_year").val(null).trigger("change");
    $("#station_fuel_outlet_filter_fuel_type").val(null).trigger("change");
    $("#station_fuel_outlet_filter_fuel_outlet_target").val(null).trigger("change");
    $("#station_fuel_outlet_filter_fuel_outlet_purpose").val(null).trigger("change");

    datatableFilterInputData();
});

$(document).on("click", "#global_capital_case_sensitive_newsletters_datatable", function () {
    global_capital_case_sensitive_newsletters_datatable = !global_capital_case_sensitive_newsletters_datatable;
    datatableFilterInputData();
});

$(document).on("click", ".dropdown-menu, .flatpickr-calendar", function (e) {
    e.stopPropagation();
});
 */
