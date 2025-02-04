$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

"use strict"
let NewslettersFiveCuffDatatablesDataSourceAjaxServer = function () {

    let initTable1 = function () {
        let newsletters_datatable = $('#newsletters_five_cuffs_datatable');

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
                "processing": `<button type="button" class="btn btn-lg spinner spinner-primary spinner-left mr-3 text-black">Yükleniyor</button>`,
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
                url: '/admin/dashboard/newsletters/five-cuffs',
                type: 'POST',
            },
            columns: [
                {
                    data: null,
                    class: "min-w-150px",
                    render: function (data, type, row) {
                        return `
                        <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                                        <i class="ki ki-menu "></i>
                                    </a>
                                    <a href="#" class=" font-weight-bolder font-size-sm">${row?.order}</a>
                        `
                    },
                    searchable: false,

                },
                {
                    data: "title",
                    class: "min-w-150px",
                    render: function (data, type, row) {
                        let image = ``
                        if (!row?.image) {
                            image = `<div class="symbol symbol-50 flex-shrink-0">
                                        <a class="nav nav-pills nav-danger nav-link active" data-toggle="pill" href="#tab_forms_widget_4">
                                            <span class="nav-icon py-2 w-auto text-danger" >
                                                <span class="svg-icon svg-icon-3x"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                            </g>
                        </svg><!--end::Svg Icon--></span>                    </span>
                                            <span class="nav-text font-size-lg py-2 font-weight-bolder text-center">
                                            </span>
                                        </a>
                                    </div>`

                        } else {
                            image = `<div class="symbol symbol-50 flex-shrink-0">
                                        <img src="/${row?.image ?? ''}" alt="photo">
                                    </div>`
                        }
                        return `
                                <div class="d-flex align-items-center">
                                    ${image}
                                    <div class="ml-3">
                                        <span class="text-dark-75 font-weight-bold  text-hover-primary line-height-sm d-block pb-2">${row?.title}</span>
                                    </div>
                                </div
                        `
                    },
                    searchable: false,
                },
                {
                    data: "category",
                    class: "min-w-150px",
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex flex-column flex-grow-1">
                           <span class="text-dark-75 mb-1 font-size-lg">${row.category}</span>
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
                            html = `
                                <span style="width: 120px;"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">${row?.status_name}</span></span>`
                        } else if (row.status_code === 'draft') {
                            html = `
                                <span style="width: 120px;">
                                    <span class="label label-warning label-dot mr-2"></span>
                                    <span class="font-weight-bold text-warning">${row?.status_name}</span>
                                </span>
                            `
                        } else if (row.status_code === 'archive') {
                            html = `

                                <span style="width: 120px;"><span class="label label-info label-dot mr-2"></span><span class="font-weight-bold text-info">${row?.status_name}</span></span>

                            `
                        } else if (row.status_code === 'removed'){
                            html = `
                                <span style="width: 120px;"><span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">${row?.status_name}</span></span>
                            `
                        }
                        return html
                    },
                    searchable: false,

                },
                {
                    data: "created_at",
                    class: "min-w-100px text-center",
                    render: function (data, type, row) {

                        let publish_date = row.created_at;

                        moment.locale("tr");
                        if (publish_date) {
                            let publish_date_format = moment(publish_date);
                            publish_date = publish_date_format.format("Do MMM YYYY");
                        }

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
                    class: "min-w-100px gap-5",
                    render: function (data, type, row) {
                        return `
                            <a href="/admin/dashboard/newsletters/show/${row.uuid}" class="btn btn-icon btn-light btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"></rect>
                                            <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "></path>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </a>

                             <a href="/admin/dashboard/newsletters/edit/${row.uuid}" class="btn btn-icon btn-light btn-sm" data-toggle="tooltip" title="Düzenle" data-placement="left" data-original-title="Düzenle">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <defs></defs>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                    <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                        </span>

                             </a>

                          `;
                    },
                    searchable: false,
                    orderable: false,
                },
            ],
            "fnCreatedRow":function (nRow, aData, iDataIndex){
                $(nRow).attr('id','draggable-'+aData.id);
                $(nRow).attr('order', aData.order);
            }
        });
    };

    return {
        init: function () {
            initTable1();
        },
    };
}();

$(document).ready(function () {
    NewslettersFiveCuffDatatablesDataSourceAjaxServer.init();
});

