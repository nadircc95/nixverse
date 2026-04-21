@extends('admin.layouts.base')

@section('title', "")

@include('admin.layouts.script_logic')

@section('modal_form')
<x-modal.modal-form id="modal_master" ::modal_class="modal-fullscreen " ::title="App Parameter a" ::form="form_app" ::submit="1">
    <x-slot name="input_hidden">
        <input type="hidden" class="form-control d-none" name="parent" value="" readonly>
    </x-slot>
    <div class="row g-3">
        <div class="col-12">
            <nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb" id="menus-nav">
            </nav>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="name" class="form-control" maxlength="30" id="exampleInputName"
                    placeholder="Enter name" required="">
                <div class="invalid-feedback">Please choose a name.</div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputURL">URL</label>
                <input type="text" name="url" class="form-control" maxlength="60" id="exampleInputURL"
                    placeholder="Enter url" required="">
                <div class="invalid-feedback">Please choose a url.</div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputIcon">Icon</label>
                <input type="text" name="icon" class="form-control" maxlength="30" id="exampleInputIcon"
                    placeholder="Enter icon" required="">
                <div class="invalid-feedback">Please choose a icon.</div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputZIndex">Index</label>
                <input type="number" name="index" class="form-control" maxlength="2" id="exampleInputZIndex"
                    placeholder="Enter index" required="">
                <div class="invalid-feedback">Please choose a index.</div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleSelectActive">Active</label>
                <select name="active" class="form-control select2bs5" style="width: 100%;" id="exampleSelectActive" required="">
                    <option selected="selected" value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <div class="invalid-feedback">Please choose a active.</div>
            </div>
        </div>
    </div>
</x-modal.modal-form>
@endsection

@section('content')
<div class="row g-3">
    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="card-header">
                <div class="row flex-between-end">
                  <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor">Datatable</h5>
                  </div>
                  <div class="col-auto ms-auto">
                    <button class="btn btn-outline-warning mb-1" type="button" id="btn_refresh">Refresh</button>
                    <button class="btn btn-outline-primary me-1 mb-1" type="button" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="save" data-ref-btn="parent"><span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add Parent</button>
                  </div>
                </div>
            </div>
            <div class="card-body px-0">
                <div class="falcon-data-table">
                <div class="table-responsive scrollbar">
                <table id="table_master" class="table mb-0 fs--1">
                    <thead class="bg-200 text-900">
                      <tr>
                        <th>#</th>
                        <th>Menu</th>
                        <th>Icon</th>
                        <th>URL</th>
                        <th>Index</th>
                        <th>Active</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script_add')

<script>
    if (window.jQuery) {
    var $ = window.jQuery;
    $(document).ready(async function () {
        $.fn.dataTable.ext.errMode = 'none';

        // let urlActionNow = "{{url('admin/menu')}}";
        let table_name = "#table_master";
        let modal_db = $(`#modal_master`);
        let relatedTargetAction;
        let _title = $(`nav .breadcrumb li.breadcrumb-item.name_menu_active`).html();


        let table_master = await $(`${table_name}`).DataTable({
            retrieve: true,
            responsive: false,
            processing: true,
            serverSide: false,
            searching: true,
            scrollCollapse : true,
            fixedColumns :{
                left:1,
                // right: 1
            },
            // fixedHeader: true,
            // dom: "<'row mx-0'<'col-md-6'l><'col-md-6'f>><'table-responsive scrollbar'tr><'row g-0 align-items-center justify-content-center justify-content-sm-between'<'col-auto mb-2 mb-sm-0 px-3'i><'col-auto px-3'p>>",
            // dom: "<'row mx-1'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive scrollbar'tr><'row no-gutters px-1 pb-3 align-items-center justify-content-center'<'col-auto' p>>",
            ajax: {
                "url": `${urlActionNow}/datatable`,
                "data": function (d) {
                    $(`.card #btn_refresh`).html(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Please Wait...`);
                    $(`.card #btn_refresh`).prop('disabled', true);
                },
                "dataSrc": function (json) {
                    $(`.card #btn_refresh`).html('Refresh');
                    $(`.card #btn_refresh`).prop('disabled', false);
                    if (json.error) {
                        return [];
                    }
                    return json.data;
                }
            },
            lengthMenu: [
                [-1],
                ['All'],
            ],
            // lengthChange: false,
            language: {
                paginate: {
                    // next: '&raquo;',
                    // previous: '&laquo;',
                    next: "<span class=\"fas fa-chevron-right\"></span>",
                    previous: "<span class=\"fas fa-chevron-left\"></span>",
                }
            },
            "initComplete": function (settings, json) {
                $(`${table_name}_filter input`).unbind();
                $(`${table_name}_filter input`).bind('keyup', function (e) {
                    if (e.keyCode == 13) {
                        table_master.search(this.value).draw();
                    }
                });
            },
            columns: [
                {
                    class: "white-space-nowrap",
                    data: 'DT_RowIndex',
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: "name",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row, meta){
                        // console.log(row, meta);
                        let _bold = `font-weight:500 !important;`;
                        let _margin = `margin-left:${row.group * 2.5}rem !important;`;
                        let _data = data;
                        let _last = ``;
                        
                        if(row.group == 0){
                            _bold = `font-weight:900 !important;`;
                            if(!row.last){
                                _last = `#`;
                            }
                            _data = `${_last} ${data}`;
                        }else if(row.group == 1){
                            _bold = `font-weight:700 !important;`;
                            if(!row.last){
                                _last = `*`;
                            }
                            _data = `${_last} ${data}`;
                        }
                        return `<div style="${_margin}${_bold}">${_data}</div>`;
                    }
                },
                {
                    data: 'icon',
                    name: "icon",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row, meta){
                        return `<span class="${data} text-dark fs-1"></span>`;
                    }
                },
                {
                    data: 'url',
                    name: "url",
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'index',
                    name: "index",
                    orderable: true,
                    searchable: true
                },
                {
                    class: "notexport",
                    data: 'active',
                    name: "active",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row, meta){
                        if(data == "1"){
                            return `<div class="dot bg-success"></div>`;
                        }else{
                            return `<div class="dot bg-danger"></div>`;
                        }
                    }
                },
                {
                    class: "notexport",
                    data: null,
                    name: "",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta){
                        let _child = ``;

                        if(data.group <= 1){
                            _child = `
                            <button type="button" class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="save" data-ref-btn="child">
                                Add Child
                            </button>
                            `;
                        }
                        return `
                        <div class="dropdown font-sans-serif btn-reveal-trigger">
                            <button class="btn btn-link text-dark btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-weather-update" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                <span class="fas fa-ellipsis-h fs--2"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-weather-update">
                                ${_child}
                                <button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="update">
                                    Update
                                </button>
                                <div class="dropdown-divider"></div>
                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="delete">
                                    Delete
                                </button>
                            </div>
                        </div>
                        `;
                        return `
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="delete">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="update">
                            <i class="fas fa-edit"></i>
                        </button>
                        `;
                    }
                },
            ],
            "drawCallback": async function( settings ) {
                // is_session_ref_action();
            },
            dom: "<'row mx-2 mb-2'<'col-12'>><'row mx-2 mb-2 g-2'<'col-md-3'l><'col-md-3'B><'col-md-6'f>><'row mx-2'<'col-12'tr>><'row mt-2 g-0 align-items-center justify-content-center justify-content-sm-between'<'col-auto mb-2 mb-sm-0 px-3'i><'col-auto px-3'p>>",
            buttons: _button_export(_title),
            createdRow: function(row, data, dataIndex, cells){
                // if(data.last == false){
                //     $(`td:eq(1)`, row).attr('colspan', 2);
                //     $('td:eq(2)', row).css('display', 'none');
                // }

                if(data.group == 0 && data.last == false){
                    $(`td:eq(1)`, row).addClass('bg-linkedin text-light');
                    $(`td:eq(2)`, row).addClass('bg-linkedin text-light');
                    $(`td:eq(3)`, row).addClass('bg-linkedin text-light');
                    $(`td:eq(4)`, row).addClass('bg-linkedin text-light');
                    $(`td:eq(5)`, row).addClass('bg-linkedin text-light');
                    $(`td:eq(6)`, row).addClass('bg-linkedin text-light');
                }else if(data.group == 1 && data.last == false){
                    $(`td:eq(1)`, row).addClass('bg-info text-light');
                    $(`td:eq(2)`, row).addClass('bg-info text-light');
                    $(`td:eq(3)`, row).addClass('bg-info text-light');
                    $(`td:eq(4)`, row).addClass('bg-info text-light');
                    $(`td:eq(5)`, row).addClass('bg-info text-light');
                    $(`td:eq(6)`, row).addClass('bg-info text-light');
                }
            },
        })
        .on('draw.dt', function(){
            var wrpper = $(`${table_name}`).closest('.dataTables_wrapper');
            wrpper.find('.pagination').addClass('pagination-sm');
        })
        .on('error.dt', function (e, settings, techNote, message) {
            console.log('Error: DataTables: ' + message);
            return true;
        });


        $(`.card #btn_refresh`).on('click', function(){
            table_master.ajax.reload();
        });

        modal_db.on("shown.bs.modal", async function (event) {
            console.clear();

            // let _urlParent = `${urlActionNow}/parent`;
            // let _getParent = await getDatas(_urlParent);

            // if(_getParent.error){
            //     modal_db.modal('hide');
            //     return;
            // }

            $(`form [name="active"].select2bs5`).select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#modal_master"),
                placeholder:"Active",
            });


            // $(`form [name="parent"].select2bs5`).select2({
            //     theme: 'bootstrap-5',
            //     allowClear: true,
            //     dropdownParent: $("#modal_master"),
            //     placeholder:"Parent",
            // });

            // $(`form [name="parent"].select2bs5`).empty().trigger('change');

            // $.each(_getParent.i.data.result, function(index, item){
            //     // console.log(`${index}:${item.name}`);
            //     var newOption = new Option(`${item.name}`, `${item.id}`, true, true);
            //     $(`form [name="parent"].select2bs5`).append(newOption);
            // });
            // let _formSelect = ["parent"];

            modalInit({
                'modal_db':modal_db,
                // '_formSelect':_formSelect

            });

            relatedTargetAction = event.relatedTarget;
            let ref_action = $(event.relatedTarget).data('ref-action');
            let ref_btn = $(event.relatedTarget).data('ref-btn');
            modal_db.find('.modal-body input[name="action"]').val(ref_action);
            modal_db.find('.modal-footer button[type="submit"]').removeClass('btn-success');
            modal_db.find('.modal-footer button[type="submit"]').removeClass('btn-danger');
            modal_db.find('.modal-footer button[type="submit"]').removeClass('btn-primary');

            modal_db.find('#menus-nav').parent().hide();
            modal_db.find('#menus-nav').html(``);

            if (ref_action === 'save') {
                modal_db.find('div.modal-header .modal-title').html(`New ${_title}`);
                modal_db.find('.modal-footer button[type="submit"]').html('Save');
                modal_db.find('.modal-footer button[type="submit"]').addClass('btn-primary');

                if(ref_btn === "child"){
                    let _row_data = getRowDataTable(relatedTargetAction, table_master);
                    if(_row_data != null){
                        modal_db.find('div.modal-header .modal-title').html(`New ${_title} ${_row_data.parent_path}`);
                        modal_db.find('.modal-body input[name="parent"]').val(_row_data.id);

                        // let _html_nav = ``;
                        // _row_data.parent_path.split(" › ").forEach(path => _html_nav += `<li class="breadcrumb-item active" aria-current="page">${path}</li>`);
                        // modal_db.find('#menus-nav').parent().show();
                        // modal_db.find('#menus-nav').html(`
                        // <ol class="breadcrumb">
                        // ${_html_nav}
                        // </ol>
                        // `);
                    }
                }
            }else{

                if(ref_action === 'update'){
                    modal_db.find('div.modal-header .modal-title').html(`Update ${_title}`);
                    modal_db.find('.modal-footer button[type="submit"]').html('Update');
                    modal_db.find('.modal-footer button[type="submit"]').addClass('btn-success');
                }else if(ref_action === 'delete'){
                    modal_db.find('div.modal-header .modal-title').html(`Delete ${_title}`);
                    modal_db.find('.modal-footer button[type="submit"]').html('Delete');
                    modal_db.find('.modal-footer button[type="submit"]').addClass('btn-danger');
                }else{
                    modal_db.modal('hide');
                    return;
                }

                let _row_data = getRowDataTable(relatedTargetAction, table_master);
                if(_row_data != null){
                    modal_db.find('.modal-body input[name="parent"]').val(_row_data.parent);
                    let _html_nav = ``;
                    _row_data.parent_path.split(" › ").forEach(path => _html_nav += `<li class="breadcrumb-item active" aria-current="page">${path}</li>`);
                    modal_db.find('#menus-nav').parent().show();
                    modal_db.find('#menus-nav').html(`
                    <ol class="breadcrumb">
                    ${_html_nav}
                    </ol>
                    `);
                }



                let dataCheck = {
                    'relatedTargetAction':relatedTargetAction,
                    'table_master':table_master,
                    'modal_db':modal_db,
                    'ref_action':ref_action,
                    // 'readonly':['code'],
                }

                modalUpdateDelete(dataCheck);
            }
        });

        $('#form_app').validate({
            // onkeyup: false,
            submitHandler: function (form, event) {
                event.preventDefault();
                let formData = new FormData(form);
                let urlAction = `${urlActionNow}/action`;

                swalWithBootstrapButtons.fire({
                    title: 'Kirim Data Ini?',
                    text: "Klik Tombol Yes Jika Data Sudah Benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then(async (result) => {
                    if (result.isConfirmed) {

                        let button_action = modal_db.find('.modal-footer button[type="submit"]');

                        button_action.prop('disabled', true);

                        let innerBefore = button_action.html();
                        button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

                        let _post = await postData(urlAction, formData);
                        // // console.log(_post);
                        button_action.html(innerBefore);
                        button_action.prop('disabled', false);
                        if(_post.error){
                            errorPost(_post, modal_db);
                            return;
                        }
                        modal_db.modal('hide');
                        table_master.ajax.reload();
                        successPost(_post, modal_db, false);
                    }
                });
            },
            rules: {
                // title: {
                //     required: true,
                //     maxlength: 255
                // },
            },
            messages: {
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        // var forms = document.querySelectorAll('.needs-validation'); // Loop over them and prevent submission

        // Array.prototype.slice.call(forms).forEach(function (form) {
        //     form.addEventListener('submit', function (event) {
        //     if (!form.checkValidity()) {
        //         event.preventDefault();
        //         event.stopPropagation();
        //         // console.log('submit failed');
        //     }else{
        //         event.preventDefault();
        //         let urlAction = `${urlActionNow}/action`;
        //         let formData = new FormData(form);

        //         // console.log('submit success');
        //         // for (var pair of formData.entries()) {
        //         //     console.log(pair[0]+ ', ' + pair[1]);
        //         // }

        //         swalWithBootstrapButtons.fire({
        //             title: 'Kirim Data Ini?',
        //             text: "Klik Tombol Yes Jika Data Sudah Benar",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonText: 'Yes',
        //             cancelButtonText: 'No',
        //             reverseButtons: true
        //         }).then(async (result) => {
        //             if (result.isConfirmed) {

        //                 let button_action = modal_db.find('.modal-footer button[type="submit"]');

        //                 button_action.prop('disabled', true);

        //                 let innerBefore = button_action.html();
        //                 button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

        //                 let _post = await postData(urlAction, formData);
        //                 // console.log(_post);
        //                 button_action.html(innerBefore);
        //                 button_action.prop('disabled', false);
        //                 if(_post.error){
        //                     errorPost(_post, modal_db);
        //                     return;
        //                 }
        //                 modal_db.modal('hide');
        //                 table_master.ajax.reload();
        //                 Toast.fire({
        //                     icon: 'success',
        //                     title: _post.i.data.message
        //                 });
        //             }
        //         });
        //     }

        //     form.classList.add('was-validated');
        //     }, false);
        // });
    });
    }
</script>
@endpush
