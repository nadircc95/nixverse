<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->

@if (Auth::user())
<script src="{{url('falcon')}}/vendors/jquery/jquery.min.js"> </script>
<script src="{{url('moment')}}/moment.min.js"> </script>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}
<script>
    if (window.jQuery) {
    var $ = window.jQuery;
    $(async function(){
        let _url_all = new URL(location.href);
        let _url_href = new URL(location.href).href;
        await $('nav ul li.nav-item').find('a.nav-link.dropdown-toggle').removeClass('active');

        $('nav ul li.nav-item').find(`a[href="${_url_href}"]`).removeClass('text-700');
        $('nav ul li.nav-item').find(`a[href="${_url_href}"]`).removeClass('link-600');

        $('nav ul li.nav-item').find(`a[href="${_url_href}"]`).addClass('text-primary');

        let gos_1 = $('nav ul li.nav-item').find(`a[href="${_url_href}"].dropdown-item`);
        let breadcrump = [];
        breadcrump[1] = "";
        breadcrump[2] = "";
        breadcrump[3] = "";
        // console.log(gos_1.length, 'nadir');
        
        if(gos_1.length > 0){
            let prnt = gos_1.closest('li.nav-item.dropdown').find('a.nav-link.dropdown-toggle');

            breadcrump[1] = `${gos_1.html()}`;

            // console.log(breadcrump[1]);
            
            // breadcrump[1] = breadcrump[1].replace(/^.*<\/span>/, '').trim();
            breadcrump[1] = breadcrump[1].replace(/^[\s\S]*<\/span>\s*/, '').trim();
            breadcrump[1] = `<li class="breadcrumb-item name_menu_active" aria-current="page">${breadcrump[1]}</li>`;

            breadcrump[2] = `${prnt.html()}`;
            if(prnt.html() === undefined){
                breadcrump[2] = `Config`;
            }
            breadcrump[2] = `<li class="breadcrumb-item active" aria-current="page">${breadcrump[2]}</li>`;

            prnt.addClass('active');
            // gos_1.addClass('fw-bold');
        }else{
            let gos_2 = $('nav ul li.nav-item').find(`a[href="${_url_href}"].nav-link`);
            // console.log('gos_2', gos_2);
            if(gos_2.length > 0){
                let childs = gos_2.closest('.nav.flex-column').find(`p[data-id="${gos_2.data('parent')}"]`);
                // console.log('childs', childs);
                let prnt = gos_2.closest('li.nav-item.dropdown').find('a.nav-link.dropdown-toggle');

                if(childs.length > 0){
                    breadcrump[2] = `${childs.html()}`;
                    breadcrump[2] = `<li class="breadcrumb-item active" aria-current="page">${breadcrump[2]}</li>`;

                    breadcrump[3] = `${prnt.html()}`;
                    breadcrump[3] = `<li class="breadcrumb-item active" aria-current="page">${breadcrump[3]}</li>`;
                }else{

                    breadcrump[2] = `${prnt.html()}`;
                    breadcrump[2] = `<li class="breadcrumb-item active" aria-current="page">${breadcrump[2]}</li>`;
                }

                breadcrump[1] = `${gos_2.html()}`;
                breadcrump[1] = `<li class="breadcrumb-item name_menu_active" aria-current="page">${breadcrump[1]}</li>`;

                prnt.addClass('active');
                // gos_2.addClass('fw-bold');

            }

        }

        let ch_title = $('#header_menu .card .card-header .title_ams');
        if(ch_title.length > 0){
            ch_title.html(`
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                ${breadcrump[3]}
                ${breadcrump[2]}
                ${breadcrump[1]}
            </ol>
            </nav>
            `);
        }
    });

    // $(function() {
    //     let _url_all = new URL(location.href);
    //     let _url_href = new URL(location.href).href;

    //     $('nav li.nav-item').find('a.nav-link').removeClass('active');
    //     $('nav li.nav-item').find('ul.nav.collapse').removeClass('show');
    //     $('nav li.nav-item').find('a.nav-link.dropdown-indicator').attr('aria-expanded', 'false');
    //     let gos = $('nav li.nav-item').find(`a[href="${_url_href}"].nav-link`);

    //     if(gos.length > 0){
    //         $.each(gos, function(index, value){
    //             let breadcrump = [];
    //             breadcrump[1] = "";
    //             breadcrump[2] = "";
    //             breadcrump[3] = "";


    //             var _get_text = $(value).find('.nav-link-text').html();
    //             breadcrump[1] = `<li class="breadcrumb-item active" aria-current="page">${_get_text}</li>`;

    //             $(value).addClass('active');
    //             let _parent = $(value).closest('ul.nav.collapse').closest('li.nav-item');
    //             if(_parent.length > 0){

    //                 var _get_text = _parent.find('.nav-link-text').html();
    //                 breadcrump[2] = `<li class="breadcrumb-item active" aria-current="page">${_get_text}</li>`;


    //                 _parent.find('a.nav-link.dropdown-indicator').attr('aria-expanded', 'true');
    //                 _parent.find('ul.nav.collapse').addClass('show');

    //                 let _parent2 = _parent.closest('ul.nav.collapse').closest('li.nav-item');
    //                 if(_parent2.length > 0){
    //                     var _get_text = _parent2.find('.nav-link-text').html();
    //                     breadcrump[3] = `<li class="breadcrumb-item active" aria-current="page">${_get_text}</li>`;

    //                     _parent2.find('a.nav-link.dropdown-indicator').attr('aria-expanded', 'true');
    //                     _parent2.find('ul.nav.collapse').addClass('show');
    //                 }
    //             }

    //             let ch_title = $('.card .card-header h4.title_ams');
    //             if(ch_title.length > 0){
    //                 ch_title.html(`
    //                 <nav aria-label="breadcrumb">
    //                 <ol class="breadcrumb">
    //                     ${breadcrump[3]}
    //                     ${breadcrump[2]}
    //                     ${breadcrump[1]}
    //                 </ol>
    //                 </nav>
    //                 `);
    //             }
    //         });
    //     }

    // });
    }
</script>
<script src="{{url('axios')}}/axios.min.js"></script>

<!-- SweetAlert2 -->
<script src="{{url('swal')}}/sweetalert2/sweetalert2.min.js"></script>

<script src="{{url('toast')}}/jquery.toast.min.js"></script>


<script>

    let urlActionNow = new URL(location.href).href;
    urlActionNow = urlActionNow.replace(new URL(location.href).search,"");
    urlActionNow = urlActionNow.replace(new URL(location.href).hash,"");

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    @if (in_array("validation", $css_js))
    const initMasks = (context) => {
        $(context).find('.mask-qty').inputmask({
            alias: 'numeric', groupSeparator: '.', radixPoint: ",", autoGroup: true, digits: 2, rightAlign: true, min: 0, max: 9999, allowMinus: false, step: 1, placeholder: "0", unmaskAsNumber: true
            , onisblur: function (e) {
                // Opsional: jika kosong saat ditinggalkan, set ke 0
                if (this.value === "") {
                    this.value = "0";
                }
            }
        });

        $(context).find('.mask-total').inputmask({
            alias: 'numeric', groupSeparator: '.', radixPoint: ",", autoGroup: true, digits: 2, rightAlign: true, min: 0, max: 99999, allowMinus: false, step: 1, placeholder: "0", unmaskAsNumber: true
            , onisblur: function (e) {
                // Opsional: jika kosong saat ditinggalkan, set ke 0
                if (this.value === "") {
                    this.value = "0";
                }
            }
        });

        $(context).find('.mask-sacks').inputmask({
            alias: 'numeric', min: 0, max: 999, step: 1, digits: 0, rightAlign: true, allowMinus: false, step: 1, placeholder: "0"
            , onisblur: function (e) {
                // Opsional: jika kosong saat ditinggalkan, set ke 0
                if (this.value === "") {
                    this.value = "0";
                }
            }
        });

        $(context).find('.mask-batch').inputmask({
            alias: 'numeric', min: 0, max: 99, step: 1, digits: 0, rightAlign: true, allowMinus: false, step: 1, placeholder: "0"
            , onisblur: function (e) {
                // Opsional: jika kosong saat ditinggalkan, set ke 0
                if (this.value === "") {
                    this.value = "0";
                }
            }
        });

        $(context).find('.mask-purchase').inputmask({
            mask: "9999.9.999", placeholder: "9999.9.999", clearMaskOnLostFocus: true
        });

        $(context).find('.mask-sell').inputmask({
            mask: "9999.9.999", placeholder: "9999.9.999", clearMaskOnLostFocus: true
        });

        $(context).find('.mask-delivery').inputmask({
            mask: "9999.9.999", placeholder: "9999.9.999", clearMaskOnLostFocus: true
        });

        
    };
    @endif

    @if (in_array("select2", $css_js))
    const initSelect2 = (context) => {
        $(context).find('.select2-dynamic').each(function() {
            let placeholder = $(this).prev('label').text() || "Select";
            $(this).select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#modal_master"),
                placeholder: placeholder,
                allowClear: true
            });
        });

        // $(context).find('select[name*="nextProgressId"]').on('select2:select select2:clear', function() {
        //     const $productSelect = $(this).closest('.group-item').find('.select2-product-dynamic');
            
        //     // Panggil fungsi populate (pastikan fungsi ini sudah async jika ada fetch API)
        //     populateProductSelect($productSelect);
        // });
    };
    @endif

    @if (in_array("flatpickr", $css_js))
    const createDatePicker = (selector, customConfig = {}) => {
        const defaultConfig = {
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            allowInput: true,
        };

        // Menggabungkan config default dengan custom (jika ada)
        const finalConfig = { ...defaultConfig, ...customConfig };
        
        return $(selector).flatpickr(finalConfig);
    };

    const createMonthYearPicker = (selector, customConfig = {}) => {
        const defaultConfig = {
            disableMobile: "true",
            plugins: [
                new monthSelectPlugin({
                    shorthand: true, // "Apr" bukan "April"
                    dateFormat: "m-Y", // Nilai asli yang masuk ke input (04-2026)
                    altFormat: "F Y",  // Tampilan yang dilihat user (April 2026)
                    theme: "light"
                })
            ],
            // Aktifkan altInput agar user melihat teks, tapi value tetap 04-2026
            altInput: true,
        };

        // Menggabungkan config default dengan custom (jika ada)
        const finalConfig = { ...defaultConfig, ...customConfig };
        
        return $(selector).flatpickr(finalConfig);
    };
    @endif

    let _button_export = function _button_export(_title){
        return [
            {
                extend: 'csv',
                className: 'btn btn-outline-info',
                title: `${_title} ${moment().format("YYYY-MM-DD")}`,
                exportOptions: {
                    columns: ':not(.notexport)',
                    orthogonal: 'export'
                },
                init: function(api, node, config) {
                    $(node).removeClass('dt-button')
                }
            },
            {
                extend: 'excelHtml5',
                className: 'btn btn-outline-info',
                title: `${_title} ${moment().format("YYYY-MM-DD")}`,
                exportOptions: {
                    columns: ':not(.notexport)',
                    orthogonal: 'export'
                },
                init: function(api, node, config) {
                    $(node).removeClass('dt-button')
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-outline-info',
                title: `${_title} ${moment().format("YYYY-MM-DD")}`,
                exportOptions: {
                    columns: ':not(.notexport)'
                },
                init: function(api, node, config) {
                    $(node).removeClass('dt-button')
                },
                orientation: 'landscape',

                // messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
            }
        ];
    }

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success m-2',
            cancelButton: 'btn btn-danger m-2'
        },
        buttonsStyling: false
    });

    // function updateCustomPagination(api, tableName) {
    //     // console.log(api);
        
    //     // Ambil data JSON asli dari response server terakhir
    //     let json = api.ajax.json();
    //     if (!json) return;

    //     // console.log(json);

    //     let nextUrl = json.next_page_url;
    //     let prevUrl = json.prev_page_url;
    //     let currentPage = json.current_page;
    //     let lastPage = json.last_page;
    //     let total = json.total;
    //     let from = json.from;
    //     let to = json.to;

    //     // 1. Update Info: "Showing 1 to 10 of 50 entries"
    //     let infoSelector = $(api.table().container()).find('.dataTables_info');
    //     if (total > 0) {
    //         infoSelector.html(`Showing ${from} to ${to} of ${total} entries`);
    //     } else {
    //         infoSelector.html(`Showing 0 to 0 of 0 entries`);
    //     }

    //     // 2. Update Pagination Buttons
    //     let paginateContainer = $(api.table().container()).find('.dataTables_paginate .pagination');
    //     paginateContainer.empty();

    //     // Tombol Previous
    //     paginateContainer.append(`
    //         <li class="paginate_button page-item previous ${prevUrl ? '' : 'disabled'}" id="table_master_previous">
    //             <a href="javascript:void(0)" onclick="loadNewPage('${prevUrl}', '${tableName}')" class="page-link">
    //                 <span class="fas fa-chevron-left"></span>
    //             </a>
    //         </li>
    //     `);

    //     // Logic Nomor Halaman (Simple Version: Current Page Only)
    //     // Anda bisa menambahkan loop di sini jika ingin angka 1, 2, 3...
    //     paginateContainer.append(`
    //         <li class="paginate_button page-item active">
    //             <a href="javascript:void(0)" class="page-link">${currentPage}</a>
    //         </li>
    //     `);

    //     // Tombol Next
    //     paginateContainer.append(`
    //         <li class="paginate_button page-item next ${nextUrl ? '' : 'disabled'}" id="table_master_next">
    //             <a href="javascript:void(0)" onclick="loadNewPage('${nextUrl}', '${tableName}')" class="page-link">
    //                 <span class="fas fa-chevron-right"></span>
    //             </a>
    //         </li>
    //     `);
    //
    // }

    function updateCustomPagination(settings, tableName) {
        // Gunakan objek API dari settings
        let api = new $.fn.dataTable.Api(settings);
        let json = api.ajax.json();
        
        if (!json || json.error) return;

        let { next_page_url, prev_page_url, current_page, last_page, total, from, to } = json;

        // 1. Update Info: "Showing 1 to 10 of 50 entries"
        let infoSelector = $(api.table().container()).find('.dataTables_info');
        if (total > 0) {
            infoSelector.html(`Showing ${from} to ${to} of ${total} entries`);
        } else {
            infoSelector.html(`Showing 0 to 0 of 0 entries`);
        }

        // 2. Update Pagination Buttons
        let paginateContainer = $(api.table().container()).find('.dataTables_paginate .pagination');
        paginateContainer.empty();

        // Tombol Previous
        paginateContainer.append(`
            <li class="paginate_button page-item previous ${prev_page_url ? '' : 'disabled'}">
                <a href="javascript:void(0)" class="page-link" 
                ${prev_page_url ? `onclick="loadNewPage('${prev_page_url}', '${tableName}')"` : ''}>
                    <span class="fas fa-chevron-left"></span>
                </a>
            </li>
        `);

        // Logic Nomor Halaman (Tampil halaman 1 sampai terakhir)
        // Jika data sangat banyak, Anda bisa membatasi loop ini (misal current +/- 2)
        for (let i = 1; i <= last_page; i++) {
            // Kita asumsikan URL pagination laravel polanya sama, tinggal ganti ?page=i
            let baseUrl = next_page_url || prev_page_url || api.ajax.url();
            let pageUrl = new URL(baseUrl, window.location.origin);
            pageUrl.searchParams.set('page', i);

            paginateContainer.append(`
                <li class="paginate_button page-item ${i === current_page ? 'active' : ''}">
                    <a href="javascript:void(0)" onclick="loadNewPage('${pageUrl.href}', '${tableName}')" class="page-link">${i}</a>
                </li>
            `);
        }

        // Tombol Next
        paginateContainer.append(`
            <li class="paginate_button page-item next ${next_page_url ? '' : 'disabled'}">
                <a href="javascript:void(0)" class="page-link"
                ${next_page_url ? `onclick="loadNewPage('${next_page_url}', '${tableName}')"` : ''}>
                    <span class="fas fa-chevron-right"></span>
                </a>
            </li>
        `);
    }

    window.loadNewPage = function(url, tableName) {
        // if (!url || url === 'null' || url === 'undefined') return;
        
        // let table = $(`${tableName}`).DataTable();
        // // Ubah URL ajax ke link pagination Laravel dan panggil load()
        // table.ajax.url(url).load();

        if (!url || url === 'null' || url === 'undefined') return;
    
        let table = $(tableName).DataTable();
        
        // 1. Ambil length dan search saat ini agar tidak hilang saat pindah halaman
        let currentLength = table.page.len();
        let currentSearch = $(`${tableName}_filter input`).val();

        let finalUrl = new URL(url);
        finalUrl.searchParams.set('length', currentLength);
        if(currentSearch) finalUrl.searchParams.set('search', currentSearch);

        // 2. Load data baru
        table.ajax.url(finalUrl.toString()).load(null, false);
    };

    function renderRowToModal(data) {
        let html = '<div class="row g-3">'; 

        $.each(data, function(key, value) {
            if (key === 'actions' || key === 'DT_RowIndex') return;

            // 1. Jika VALUE adalah ARRAY (Contoh: groups)
            if (Array.isArray(value)) {
                html += `
                    <div class="col-12 mt-4">
                        <h5 class="text-primary text-uppercase fs--1 fw-bold mb-1">List ${key}</h5>
                        <hr class="mt-0 mb-3 border-primary opacity-25"> ${value.map((item, index) => `
                            <div class="p-3 mb-3 border rounded bg-light shadow-sm">
                                <div class="d-flex justify-content-between border-bottom border-200 mb-3 pb-2">
                                    <span class="badge bg-secondary">Item #${index + 1}</span>
                                    <small class="text-600 fw-bold">ENTRY DATA</small>
                                </div>
                                ${renderRowToModal(item)}
                            </div>
                        
                        `).join('')}
                        <hr class="mt-3 mb-1 border-primary opacity-25">
                    </div>`;
            } 
            // 2. Jika VALUE adalah OBJECT (Contoh: detail)
            else if (typeof value === 'object' && value !== null) {
                html += `
                    <div class="col-12 mt-4">
                        <h5 class="text-info text-uppercase fs--1 fw-bold mb-1">Section ${key}</h5>
                        <hr class="mt-0 mb-3 border-info opacity-25"> 
                        <div class="p-3 mb-2 border rounded bg-light">
                            ${renderRowToModal(value)}
                        </div>
                        <hr class="mt-3 mb-1 border-info opacity-25"> 
                    </div>`;
            } 
            // 3. Jika VALUE adalah DATA BIASA
            else {
                let label = key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
                
                html += `
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="form-group pb-2 border-bottom border-200">
                            <label class="form-label small fw-semi-bold text-600 mb-1">${label}</label>
                            <input class="form-control form-control-sm bg-200 border-0" 
                                type="text" 
                                value="${value !== null && value !== "" ? value : '-'}" 
                                readonly>
                        </div>
                    </div>`;
            }
        });

        html += '</div>';
        return html;
    }

    function parseJsonIfString(val) {
        if (typeof val !== 'string') return val;

        try {
            // decode HTML entities (&quot;)
            const decoded = $('<textarea/>').html(val).text();

            return JSON.parse(decoded);

        } catch (e) {
            console.warn("Invalid JSON:", val);
            return val;
        }
    }

    // function renderRowToModal(data) {
    //     let html = '<div class="row g-3">'; 

    //     $.each(data, function(key, value) {
    //         if (key === 'actions' || key === 'DT_RowIndex') return;

    //         // 1. Jika VALUE adalah ARRAY (Contoh: groups)
    //         if (Array.isArray(value)) {
    //             html += `
    //                 <div class="col-12 mt-4">
    //                     <h5 class="border-bottom border-2 pb-2 text-primary text-uppercase fs--1 fw-bold">List ${key}</h5>
    //                     ${value.map((item, index) => `
    //                         <div class="p-3 mb-3 border rounded bg-light shadow-sm border-bottom-3">
    //                             <div class="d-flex justify-content-between border-bottom mb-3 pb-2">
    //                                 <span class="badge bg-secondary">Item #${index + 1}</span>
    //                                 <span class="small text-600 fw-bold">${key.toUpperCase()} UNIT</span>
    //                             </div>
    //                             ${renderRowToModal(item)}
    //                         </div>
    //                     `).join('')}
    //                 </div>`;
    //         } 
    //         // 2. Jika VALUE adalah OBJECT (Contoh: detail)
    //         else if (typeof value === 'object' && value !== null) {
    //             html += `
    //                 <div class="col-12 mt-4">
    //                     <h5 class="border-bottom border-2 pb-2 text-info text-uppercase fs--1 fw-bold">Section ${key}</h5>
    //                     <div class="p-3 mb-2 border rounded bg-light border-bottom-3">
    //                         ${renderRowToModal(value)}
    //                     </div>
    //                 </div>`;
    //         } 
    //         // 3. Jika VALUE adalah DATA BIASA
    //         else {
    //             let label = key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
                
    //             // Tambahkan wrapper dengan border-bottom tipis untuk setiap item data
    //             html += `
    //                 <div class="col-12 col-md-6 col-xl-3">
    //                     <div class="form-group pb-2 border-bottom border-200">
    //                         <label class="form-label small fw-semi-bold text-600 mb-1">${label}</label>
    //                         <input class="form-control form-control-sm bg-200 border-0" 
    //                             type="text" 
    //                             value="${value !== null && value !== "" ? value : '-'}" 
    //                             readonly>
    //                     </div>
    //                 </div>`;
    //         }
    //     });

    //     html += '</div>';
    //     return html;
    // }

    // function renderRowToModal(data, isNested = false) {
    //     let html = '';
        
    //     // Inisialisasi baris (row) untuk menampung kolom-kolom
    //     html += '<div class="row g-3">'; 

    //     $.each(data, function(key, value) {
    //         // Skip metadata
    //         if (key === 'actions' || key === 'DT_RowIndex') return;

    //         // 1. Jika VALUE adalah ARRAY (Contoh: groups)
    //         if (Array.isArray(value)) {
    //             html += `
    //                 <div class="col-12 mt-4">
    //                     <h5 class="border-bottom pb-2 border-top pt-3 text-primary text-uppercase fs--1 fw-bold">List ${key}</h5>
    //                     ${value.map((item, index) => `
    //                         <div class="p-3 mb-3 border rounded bg-light shadow-sm">
    //                             <div class="badge bg-secondary mb-3">Item #${index + 1}</div>
    //                             ${renderRowToModal(item, true)}
    //                         </div>
    //                     `).join('')}
    //                 </div>`;
    //         } 
    //         // 2. Jika VALUE adalah OBJECT (Contoh: detail)
    //         else if (typeof value === 'object' && value !== null) {
    //             html += `
    //                 <div class="col-12 mt-4">
    //                     <h5 class="border-bottom pb-2 border-top pt-3 text-info text-uppercase fs--1 fw-bold">Section ${key}</h5>
    //                     <div class="p-3 mb-2 border rounded bg-light">
    //                         ${renderRowToModal(value, true)}
    //                     </div>
    //                 </div>`;
    //         } 
    //         // 3. Jika VALUE adalah DATA BIASA
    //         else {
    //             let label = key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
                
    //             // Konfigurasi Grid: col-12 (Mobile), col-md-6 (Medium), col-xl-3 (Layar Full/Large)
    //             html += `
    //                 <div class="col-12 col-md-6 col-xl-3">
    //                     <div class="form-group">
    //                         <label class="form-label small fw-semi-bold text-600 mb-1">${label}</label>
    //                         <input class="form-control form-control-sm bg-200" 
    //                             type="text" 
    //                             value="${value !== null && value !== "" ? value : '-'}" 
    //                             readonly>
    //                     </div>
    //                 </div>`;
    //         }
    //     });

    //     html += '</div>'; // Tutup row
    //     return html;
    // }

    function is_session_ref_action(){
        let is_create = "{{Session('is_create',0)}}";
        let is_update = "{{Session('is_update',0)}}";
        let is_delete = "{{Session('is_delete',0)}}";
        console.log(is_create, is_update, is_delete);

        if($(`.lazy`).length > 0){
            $('.lazy').Lazy({
                // your configuration goes here
                scrollDirection: 'vertical',
                effect: 'fadeIn',
                visibleOnly: true,
                onFinishedAll: function() {
                if( !this.config("autoDestroy") ){
                    this.destroy();
                }
                },
                beforeLoad: function(element) {
                    // console.log(element,'beforeLoad', 'lazy');
                    element.addClass("bg-secondary bg-gradient bg-opacity-25");
                },
                afterLoad: function(element) {
                    // console.log(element,'afterLoad', 'lazy');
                    element.removeClass("lazy");
                    element.removeClass("bg-secondary");
                    element.removeClass("bg-gradient");
                    element.removeClass("bg-opacity-25");
                },
                onError: function(element) {
                    // console.log(element,'onError', 'lazy');
                }
            });
        }

        if($(`button[data-ref-action]`).length > 0){
            // console.log(`is_create : ${is_create}`);
            if(is_create == 1){
                $(`button[data-ref-action="save"]`).show();
            }else{
                $(`button[data-ref-action="save"]`).remove();
            }

            // console.log(`is_update : ${is_update}`);
            if(is_update == 1){
                $(`button[data-ref-action="update"]`).show();
            }else{
                $(`button[data-ref-action="update"]`).remove();
            }

            // console.log(`is_delete : ${is_delete}`);
            if(is_delete == 1){
                $(`button[data-ref-action="delete"]`).show();
            }else{
                $(`button[data-ref-action="delete"]`).remove();
            }
        }

        if($(`#upload_data`).length > 0){
            if(is_create == 1){
                $(`button[data-ref-action="upload"]`).show();
                $(`#upload_data`).show();
            }else{
                $(`button[data-ref-action="upload"]`).hide();
                $(`#upload_data`).hide();
            }
        }

        // if($(`#unlock_neraca_saldo`).length > 0 && $(`#lock_neraca_saldo`).length > 0){
        //     if(is_create === "1"){
        //         $(`#unlock_neraca_saldo`).show();
        //         $(`#lock_neraca_saldo`).show();
        //     }else{
        //         $(`#unlock_neraca_saldo`).hide();
        //         $(`#lock_neraca_saldo`).hide();
        //     }
        // }


    }

    async function postData(urlAction, formData){
        try {
            const response = await axios.post(`${urlAction}`, formData, {
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            return {
                error: false,
                i: response
            }
        } catch (error) {
            return {
                error: true,
                i: error
            }
        }
    }

    async function postDataNoJson(urlAction, formData){
        try {
            const response = await axios.post(`${urlAction}`, formData, {
            });
            return {
                error: false,
                i: response
            }
        } catch (error) {
            return {
                error: true,
                i: error
            }
        }
    }

    async function getDatas(urlAction, params = {}) {
        try {
            const response = await axios.get(urlAction, {
                params: params, // Ini untuk query string (?warehouseId=W01)
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest' // Penting untuk Laravel agar tahu ini request AJAX
                }
            });

            return {
                error: false,
                data: response.data // Ambil datanya saja
            };
        } catch (error) {
            // Axios menyimpan response error di error.response
            let errorMsg = "Terjadi kesalahan pada server";
        
            if (error.response && error.response.data) {
                // Jika Laravel mengirim ValidationException
                const res = error.response.data;
                
                // Ambil pesan pertama dari object validation jika ada
                if (res.validation) {
                    const firstKey = Object.keys(res.validation)[0];
                    errorMsg = res.validation[firstKey][0]; 
                } else {
                    errorMsg = res.message || errorMsg;
                }
            }

            return {
                error: true,
                message: errorMsg
            };
        }
    }

    // async function getDatas(urlAction){
    //     try {
    //         // return 'nadir';
    //         const response = await axios.get(`${urlAction}`, {
    //             headers: {
    //                 'Content-Type': 'application/json',
    //             }
    //         });
    //         return {
    //             error: false,
    //             i: response
    //         }
    //     } catch (error) {
    //         return {
    //             error: true,
    //             i: error
    //         }
    //     }
    // }

    // async function ajaxGet(url, data = {}) {
    //     try {
    //         const response = await $.ajax({
    //             url: url,
    //             type: 'GET',
    //             data: data,
    //             dataType: 'json'
    //         });

    //         // Ini yang akan masuk ke variabel resBatches
    //         return {
    //             error: false,
    //             data: response
    //         };
    //     } catch (e) {
    //         return {
    //             error: true,
    //             message: e.responseText || e.statusText
    //         };
    //     }
    // }

    function modalInit(dataCheck = {}){
        // console.log('modalInit');

        if(!dataCheck.hasOwnProperty('modal_db')){
            return;
        }
        let modal_db = dataCheck.modal_db;
        modal_db.find('.alert.alert-success').remove();
        modal_db.find('.alert.alert-danger').remove();

        modal_db.find('.modal-body form input').each(function(index, item){
            // console.log(index, item);
            // console.log($(this).attr('name'));

            $(this).val("");
            const _attrs = ["id", "action","_token"];
            if(!_attrs.includes($(this).attr('name'))){
                $(this).removeAttr('readonly');
            }else{
                $(this).attr('readonly',true);
            }

            if($(this).attr('data-tvar') === "int"){
                $(this).val("0");
            }
        });

        modal_db.find('.modal-body form textarea').each(function(index, item){
            $(this).val("");
            $(this).removeAttr('readonly');
        });

        modal_db.find('.modal-body form select').each(function(index, item){
            // let _val_select = $(this).find("option")[0].value;
            // if($(this).hasClass('select2bs5')){
            //     $(this).val(_val_select).trigger('change.select2');
            // }else if($(this).hasClass('select2')){
            //     $(this).val(_val_select).trigger('change.select2');
            // }

            if($(this).hasClass('select2bs5')){

            }

            if($(this).find("option").length > 0){

                if(!dataCheck.hasOwnProperty('_formSelect')){
                    let _val_select = $(this).find("option")[0].value;
                    if($(this).hasClass('select2bs5')){
                        $(this).val(_val_select).trigger('change.select2');
                    }else if($(this).hasClass('select2')){
                        $(this).val(_val_select).trigger('change.select2');
                    }
                }else{
                    let objIndexSelect = dataCheck._formSelect.findIndex(x => x === $(this).attr("name"));
                    if(objIndexSelect >= 0){
                        $(this).val(null).trigger('change.select2');
                    }
                }
            }
        });

        if(dataCheck.hasOwnProperty('quill')){
            dataCheck.quill.root.innerHTML = null;
        }

        if(dataCheck.hasOwnProperty('choice')){
            if(Array.isArray(dataCheck.choice)){
                dataCheck.choice.forEach(element => {
                    element.clearStore();
                });
            }else{
                dataCheck.choice.clearStore();
            }
        }
    }

    function successPost(_post, modal_db = null, alert = false, clear = true){
        if(modal_db != null){
            modal_db.find('.alert.alert-danger').remove();
            if(alert){
                let _alert = modal_db.find('.alert.alert-success');
                if(_alert.length > 0){
                    _alert.find('p').html(`${_post.i.data.message}!`);
                }else{
                    $(`
                    <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                    <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
                    <p class="mb-0 flex-1">${_post.i.data.message}!</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `).insertBefore(modal_db.find('form'));
                }
            }else{
                Toast.fire({
                    icon: 'success',
                    title: _post.i.data.message
                });
            }

            if(clear){
                modal_db.find(`form input`).each(function(index, item){
                    $(this).val("");
                });

                modal_db.find(`form textarea`).each(function(index, item){
                    $(this).val("");
                });

                modal_db.find(`form select`).each(function(index, item){
                    if($(this).find("option").length > 0){
                        $(this).val(null).trigger('change.select2');
                    }
                });
            }

        }
    }

    function errorPost(_post, modal_db = null, alert = true){
        if(_post.i.response.data.message === 'validasi'){
            let message_x = '';
            let valid_x = _post.i.response.data.validation;
            Object.keys(valid_x).forEach(function(item, index){
                message_x += `${item} : `;
                valid_x[item].forEach(function(i,x){
                    message_x += `${i}<br>`;
                });
                // message_x += `<br>`;
            });

            modal_db.find('.alert.alert-success').remove();
            if(alert){
                if(modal_db != null){
                    let _alert = modal_db.find('.alert.alert-danger');
                    if(_alert.length > 0){
                        _alert.find('p').html(`Error Validasi!`);
                    }else{
                        $(`
                        <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                        <div class="bg-danger me-3 icon-item"><span class="fas fa-times-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1">Error Validasi!</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        `).insertBefore(modal_db.find('form'));
                    }
                }
            }else{
                Toast.fire({
                    icon: 'error',
                    title: "Error Validasi"
                });
            }

        }else{
            modal_db.find('.alert.alert-success').remove();
            if(alert){
                let _alert = modal_db.find('.alert.alert-danger');
                if(_alert.length > 0){
                    _alert.find('p').html(`${_post.i.response.data.message}!`);
                }else{
                    $(`
                    <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                    <div class="bg-danger me-3 icon-item"><span class="fas fa-times-circle text-white fs-3"></span></div>
                    <p class="mb-0 flex-1">${_post.i.response.data.message}!</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `).insertBefore(modal_db.find('form'));
                }
            }else{
                Toast.fire({
                    icon: 'error',
                    title: _post.i.response.data.message
                });
            }
        }
        if(_post.i.response.status == 422){
            $.each(_post.i.response.data.validation, function(key, value){
                // if(key === 'image'){

                // }else{
                // }

                if(modal_db!==null){
                    let err_item = modal_db.find(`form [name="${key}"]`);
                    err_item.addClass('is-invalid');

                    let err_form = err_item.parent();
                    if(err_form.length > 0){
                        err_form.append(`<span id="${err_item.attr('id')}-error" class="error invalid-feedback" style="">${value}</span>`);
                    }
                }
            });
        }
    }

    let ConvertStringToHTML = function (str) {
        let parser = new DOMParser();
        let doc = parser.parseFromString(str, 'text/html');
        return doc.body;
    };

    function getRowDataTable(relatedTargetAction, table_master){
        var _tr_table = null;
        var _ch_child = $(relatedTargetAction).closest('tr').hasClass('child');
        if( _ch_child){
            _tr_table = $(relatedTargetAction).closest('tr').prev();
        }else{
            _tr_table = $(relatedTargetAction).closest('tr');
        }
        var _row_data = table_master.row(_tr_table);

        return _row_data.data();
    }

    let decodeHTML = function (html) {
        let txt = document.createElement('textarea');
        txt.innerHTML = html;
        return txt.value;
    };

    let modalUpdateDeleteForm = async function modalUpdateDeleteForm(modal_db, dataCheck, ref_action, key, value){
        let _form_type = modal_db.find(`form [name="${key}"]`);
        if(_form_type.length > 0){
            // console.log(_form_type.get(0));
            let _element = _form_type.get(0).localName;

            if(_element === 'input'){
                // modal_db.find(`div.modal-body ${_element}[name="${key}"]`).val(value);
                let _input_form = modal_db.find(`div.modal-body ${_element}[name="${key}"]`);
                _input_form.val(value);

                if(_form_type.get(0).hasAttribute('data-type')){
                    if(_form_type.get(0).getAttribute('data-type') === "currency"){
                        // console.log(_form_type.get(0));
                        _input_form.trigger('blur');
                    }else if(_form_type.get(0).getAttribute('data-type') === "number"){
                        // console.log(_form_type.get(0));
                        _input_form.trigger('blur');
                    }
                }

                if(ref_action === 'delete'){
                    _input_form.attr('readonly', true);
                }

                if(dataCheck.hasOwnProperty('readonly')){
                    if(dataCheck.readonly.includes(_input_form.attr('name'))){
                        _input_form.attr('readonly', true);
                    }
                }

                if(dataCheck.hasOwnProperty('choice')){
                    if(dataCheck.hasOwnProperty('choice_name')){
                        if(dataCheck.choice_name.includes(_input_form.attr('name'))){
                            if(Array.isArray(dataCheck.choice)){
                                let _indC = dataCheck.choice_name.indexOf(_input_form.attr('name'));
                                dataCheck.choice[_indC].setValue(value.split('~@~'));
                            }else{
                                dataCheck.choice.setValue(value.split('~@~'));
                            }
                        }
                    }
                }

                // if(_input_form.attr('name') == 'name'){
                //     _input_form.attr('readonly', true);
                // }
            }else if(_element === 'textarea'){
                let _textarea_form = modal_db.find(`div.modal-body ${_element}[name="${key}"]`);
                if (_textarea_form.length > 0) {
                    value = decodeHTML(value);
                    // console.log(decoded);
                    _textarea_form.val(`${value}`);
                    if(ref_action === 'delete'){
                        _textarea_form.attr('readonly', true);
                    }
                }
            }else if(_element === 'select'){

                console.log(_element, key, value);
                let _select_x = $(_form_type.get(0));
                if (typeof value === 'object'){
                    value = value.value;
                }else if(value === true){
                    value = 1;
                }else if(value === false){
                    value = 0;
                }else if(value === null){
                    value = 0;
                }
                if(_select_x.hasClass('select2bs5')){
                    modal_db.find(`div.modal-body ${_element}[name="${key}"].select2bs5`).val(value).trigger('change.select2');
                    modal_db.find(`div.modal-body ${_element}[name="${key}"].select2bs5`).val(value).trigger('change');
                }else if(_select_x.hasClass('select2')){
                    modal_db.find(`div.modal-body ${_element}[name="${key}"].select2`).val(value).trigger('change.select2');
                    modal_db.find(`div.modal-body ${_element}[name="${key}"].select2`).val(value).trigger('change');
                }
                // _form_type.get(0).value = value;
            }



        }else if(dataCheck.hasOwnProperty('quill') && dataCheck.hasOwnProperty('content')){
            if(key === dataCheck.content){
                // dataCheck.quill.root.innerHTML = value;
                let initialContent = dataCheck.quill.clipboard.convert(value);
                await dataCheck.quill.setContents(initialContent, 'silent');
            }
        }
    }

    function modalUpdateDelete(dataCheck = {}){

        if(!dataCheck.hasOwnProperty('relatedTargetAction')){
            return;
        }
        let relatedTargetAction = dataCheck.relatedTargetAction;

        if(!dataCheck.hasOwnProperty('table_master')){
            return;
        }
        let table_master = dataCheck.table_master;

        if(!dataCheck.hasOwnProperty('modal_db')){
            return;
        }
        let modal_db = dataCheck.modal_db;

        if(!dataCheck.hasOwnProperty('ref_action')){
            return;
        }
        let ref_action = dataCheck.ref_action;

        var _tr_table = null;
        var _ch_child = $(relatedTargetAction).closest('tr').hasClass('child');
        if( _ch_child){
            _tr_table = $(relatedTargetAction).closest('tr').prev();
        }else{
            _tr_table = $(relatedTargetAction).closest('tr');
        }

        var _row_data = table_master.row(_tr_table);
        relatedTargetAction = _tr_table;
        // console.log(_row_data.data());

        $.each(_row_data.data(), function(key, value){
            // console.log(`${key} => ${value}`);

            let _key = "";
            let _value = "";
            let _lang = modal_db.find(`form [name="lang"]`);
            if(key === "translations"){
                let _translations = _row_data.data().translations;
                // console.log(_translations);
                if(_lang.length > 0){
                    if(_translations.hasOwnProperty(`${_lang.val()}`)){
                        $.each(_translations[`${_lang.val()}`], function(kT, vT){
                            modalUpdateDeleteForm(modal_db, dataCheck, ref_action, kT, vT);

                        });
                    }else{
                        $.each(_translations[`id`], function(kT, vT){
                            modalUpdateDeleteForm(modal_db, dataCheck, ref_action, kT, vT);
                        });
                    }
                }else{
                    $.each(_translations, function(kT, vT){
                        // console.log(`${kT} => ${vT}`);

                        $.each(_translations[kT], function(kT2, vT2){
                            // console.log(`${kT2} => ${vT2}`);
                            _key = `t_${kT}_${kT2}`;
                            _value = `${vT2}`;
                            modalUpdateDeleteForm(modal_db, dataCheck, ref_action, _key, _value);

                        });

                    });
                }
            }else{
                if(_lang.length == 0){
                    modalUpdateDeleteForm(modal_db, dataCheck, ref_action, key, value);
                }
            }
        });

        modal_db.find('div.modal-body input[name="id"]').val(_row_data.data().id);


        // load image dropzone
        {
            if(dataCheck.hasOwnProperty('myDropzoneImage')){
                let myDropzoneImage = dataCheck.myDropzoneImage;
                if(_row_data.data().image == null){
                    return;
                }
                var mockFile = {
                    name: _row_data.data().image.filename_original,
                    size: _row_data.data().image.filesize,
                };

                let callback = null; // Optional callback when it's done
                let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
                let resizeThumbnail = true; // Tells Dropzone whether it should resize the image first

                myDropzoneImage.displayExistingFile(mockFile, `${_row_data.data().image_id}`, callback, crossOrigin, resizeThumbnail);
                myDropzoneImage.files.push(mockFile);
                myDropzoneImage.emit("success", mockFile, {
                    success: true,
                    error: false,
                    id_image: _row_data.data().image.id,
                    filename_new: _row_data.data().image.filename_new,
                    url: _row_data.data().image_id,
                });
                myDropzoneImage.emit("complete", mockFile);
            }
        }
        // end image dropzone

        return _row_data.data();
    }
</script>
@endif
<script src="{{url('falcon')}}/vendors/popper/popper.min.js"></script>
<script src="{{url('falcon')}}/vendors/bootstrap/bootstrap.min.js"></script>
@stack('script_bottom')

@stack('script_add')

<script src="{{url('falcon')}}/vendors/anchorjs/anchor.min.js"></script>
<script src="{{url('falcon')}}/vendors/is/is.min.js"></script>
<script src="{{url('falcon')}}/vendors/lottie/lottie.min.js"></script>

<script src="{{url('falcon')}}/vendors/prism/prism.js"></script>
<script src="{{url('falcon')}}/vendors/fontawesome/all.min.js"></script>
<script src="{{url('falcon')}}/vendors/lodash/lodash.min.js"></script>
{{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script> --}}
<script src="{{url('falcon')}}/vendors/list.js/list.min.js"></script>
<script src="{{url('falcon')}}/assets/js/theme.js"></script>

<script src="{{url('assets')}}/jquery-lazy/jquery.lazy.min.js"></script>
<script>
    if (window.jQuery) {
      var $ = window.jQuery;

      $(document).ready(async function () {

        // console.log('ready');

        $('.lazy').Lazy({
            // your configuration goes here
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
            onFinishedAll: function() {
              if( !this.config("autoDestroy") ){
                this.destroy();
              }
            },
            beforeLoad: function(element) {
                // console.log(element,'beforeLoad', 'lazy');
                element.addClass("bg-secondary bg-gradient bg-opacity-25");
            },
            afterLoad: function(element) {
                // console.log(element,'afterLoad', 'lazy');
                element.removeClass("lazy");
                element.removeClass("bg-secondary");
                element.removeClass("bg-gradient");
                element.removeClass("bg-opacity-25");
            },
            onError: function(element) {
                // console.log(element,'onError', 'lazy');
            }
        });

      });
    }else{
      console.log("no jquery");
    }
</script>
@stack('script_quill')
