@extends('admin.layouts.base')

@section('title', "")

@include('admin.layouts.script_logic')

@section('modal_form')
<x-modal.modal-form id="modal_master" ::modal_class="modal-fullscreen " ::title="App Parameter a" ::form="form_app" ::submit="1">
    <div class="row g-3">
        <div class="col-6">
            <div class="form-group">
                <label for="exampleSelectRole">Role</label>
                <select name="role" class="form-control select2bs5" style="width: 100%;" id="exampleSelectRole">
                    @foreach ($roles as $k => $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputEmail">Email</label>
                <input type="email" name="email" class="form-control" maxlength="100" id="exampleInputEmail"
                    placeholder="Enter email" required="">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="name" class="form-control" maxlength="50" id="exampleInputName"
                    placeholder="Enter name" required="">
            </div>
        </div>

        {{-- <div class="col-6">
            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input type="password" name="password" class="form-control" minlength="6" maxlength="20" id="exampleInputPassword"
                    placeholder="Enter password">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputPassword Confirmation">Password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control" minlength="6" maxlength="20" id="exampleInputPassword Confirmation"
                    placeholder="Enter password confirmation">
            </div>
        </div> --}}
        <div class="col-6">
            <div class="form-group">
                <label for="exampleSelectActive">Active</label>
                <select name="active" class="form-control select2bs5" style="width: 100%;" id="exampleSelectActive" required="">
                    <option selected="selected" value="1">Yes</option>
                    <option value="0">No</option>
                </select>
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
                    {{-- <h5 class="mb-0" data-anchor="data-anchor">Default Example</h5> --}}
                  </div>
                  <div class="col-auto ms-auto">
                    <button class="btn btn-outline-warning mb-1" type="button" id="btn_refresh">Refresh</button>
                    <button class="btn btn-outline-success me-1 mb-1" type="button" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="save"><span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Tambah</button>
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
                        <th>Role</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Verified</th>
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

        let _formSelect = ["parent"];


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
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All'],
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
                    data: "role_name",
                    name: "r.name",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row, meta){
                        if(data === null){
                            return '-';
                        }
                        return `
                        ${data}
                        `;
                    }
                },
                {
                    data: 'email',
                    name: "email",
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'name',
                    name: "name",
                    orderable: true,
                    searchable: true
                },
                {
                    class: "notexport",
                    data: 'email_verified_at',
                    name: "email_verified_at",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row, meta){
                        if(data != null){
                            return `<div class="dot bg-success"></div>`;
                        }else{
                            return `<div class="dot bg-danger"></div>`;
                        }
                    }
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
                        let _verified = ``;
                        let _send_reset_password = `
                        <button type="button" class="dropdown-item btn-reset-password" data-ref-id="${data.id}" data-ref-email="${data.email}">
                            Send Reset Password
                        </button>
                        `;

                        if(data.email_verified_at == null){
                            // _verified = `
                            // <button type="button" class="dropdown-item btn-verified" data-ref-id="${data.id}" data-ref-email="${data.email}">
                            //     Verified
                            // </button>
                            // `;
                        }else{

                        }
                        return `
                        <div class="dropdown font-sans-serif btn-reveal-trigger">
                            <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-weather-update" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                <span class="fas fa-ellipsis-h fs--2"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-weather-update">
                                ${_verified}
                                ${_send_reset_password}
                                <button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="update">
                                    Update
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

        // $(`${table_name} tbody`).on('click', 'button.btn-verified', function(){
        //     // let _ids = $(this).data('ids');
        //     let _myButton = $(this);
        //     _row_data = getRowDataTable(this, table_master);
        //     if($(this).data('ref-email') != _row_data.email || $(this).data('ref-id') != _row_data.id){
        //         return;
        //     }
        //     let formData = new FormData();
        //     formData.append('_token', "{{ csrf_token() }}");
        //     formData.append('email', $(this).data('ref-email'));
        //     formData.append('id', $(this).data('ref-id'));

        //     let urlAction = `${urlActionNow}/verified`;
        //     swalWithBootstrapButtons.fire({
        //             title: 'Are you sure to Verified?',
        //             text: "Klik Tombol Yes Jika Data Sudah Benar",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonText: 'Yes',
        //             cancelButtonText: 'No',
        //             reverseButtons: true
        //         }).then(async (result) => {
        //             if (result.isConfirmed) {

        //                 let button_action = _myButton;

        //                 button_action.prop('disabled', true);

        //                 let innerBefore = button_action.html();
        //                 button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

        //                 let _post = await postData(urlAction, formData);
        //                 // // console.log(_post);
        //                 button_action.html(innerBefore);
        //                 button_action.prop('disabled', false);
        //                 if(_post.error){
        //                     errorPost(_post, null);
        //                     return;
        //                 }
        //                 table_master.ajax.reload();
        //                 Toast.fire({
        //                     icon: 'success',
        //                     title: _post.i.data.message
        //                 });
        //             }
        //         });
        // });

        $(`${table_name} tbody`).on('click', 'button.btn-reset-password', function(){
            // let _ids = $(this).data('ids');
            let _myButton = $(this);
            _row_data = getRowDataTable(this, table_master);
            if($(this).data('ref-email') != _row_data.email || $(this).data('ref-id') != _row_data.id){
                return;
            }
            let formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('email', $(this).data('ref-email'));
            formData.append('id', $(this).data('ref-id'));

            let urlAction = `${urlActionNow}/reset-password`;
            swalWithBootstrapButtons.fire({
                    title: 'Are you sure to Verified?',
                    text: "Klik Tombol Yes Jika Data Sudah Benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then(async (result) => {
                    if (result.isConfirmed) {

                        let button_action = _myButton;

                        button_action.prop('disabled', true);

                        let innerBefore = button_action.html();
                        button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

                        let _post = await postData(urlAction, formData);
                        // // console.log(_post);
                        button_action.html(innerBefore);
                        button_action.prop('disabled', false);
                        if(_post.error){
                            errorPost(_post, null);
                            return;
                        }
                        table_master.ajax.reload();
                        Toast.fire({
                            icon: 'success',
                            title: _post.i.data.message
                        });
                    }
                });
        });

        modal_db.on("shown.bs.modal", async function (event) {
            console.clear();

            $(`form [name="active"].select2bs5`).select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#modal_master"),
                placeholder:"Active",
            });


            $(`form [name="role"].select2bs5`).select2({
                theme: 'bootstrap-5',
                allowClear: true,
                dropdownParent: $("#modal_master"),
                placeholder:"Role",
            });

            $(`form [name="parent"].select2bs5`).empty().trigger('change');

            modalInit({
                'modal_db':modal_db,
                '_formSelect':_formSelect
            });

            relatedTargetAction = event.relatedTarget;
            let ref_action = $(event.relatedTarget).data('ref-action');
            modal_db.find('.modal-body input[name="action"]').val(ref_action);
            modal_db.find('.modal-footer button[type="submit"]').removeClass('btn-success');
            modal_db.find('.modal-footer button[type="submit"]').removeClass('btn-danger');
            modal_db.find('.modal-footer button[type="submit"]').removeClass('btn-primary');

            if (ref_action === 'save') {
                modal_db.find('div.modal-header .modal-title').html(`New ${_title}`);
                modal_db.find('.modal-footer button[type="submit"]').html('Save');
                modal_db.find('.modal-footer button[type="submit"]').addClass('btn-primary');

                // modal_db.find('.modal-body input[type="password"]').attr("required", "");
                // modal_db.find('.modal-body input[type="password"]').closest('div.form-group').closest('div.col-6').show();
            }else{
                // modal_db.find('.modal-body input[type="password"]').removeAttr("required");
                // modal_db.find('.modal-body input[type="password"]').closest('div.form-group').closest('div.col-6').hide();
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

        // $.validator.addMethod("requiredSavePassword", function (val, ele, arg) {
        //     let _ch = modal_db.find(`.modal-body input[name="action"]`).val();
        //     console.log(_ch);

        //     if(_ch == 'save'){
        //         let _password = modal_db.find(`.modal-body input[name="password"]`).val();
        //         if(_password.length == 0){
        //             return false;
        //         }
        //     }
        //     return true;
        // }, "This field is required.");

        // $.validator.addMethod("requiredSaveConfirmPassword", function (val, ele, arg) {
        //     let _ch = modal_db.find(`.modal-body input[name="action"]`).val();
        //     console.log(_ch);

        //     if(_ch == 'save'){
        //         let _password_confirmation = modal_db.find(`.modal-body input[name="password_confirmation"]`).val();
        //         if(_password_confirmation.length == 0){
        //             return false;
        //         }
        //     }
        //     return true;
        // }, "This field is required.");

        $.validator.addMethod("checkPassword", function (val, ele, arg) {
            let _ch = modal_db.find(`.modal-body input[name="action"]`).val();
            console.log(_ch);
            if(_ch == 'save'){
                let _password = modal_db.find(`.modal-body input[name="password"]`).val();
                let _password_confirmation = modal_db.find(`.modal-body input[name="password_confirmation"]`).val();
                if(_password !== _password_confirmation){
                    return false;
                }
            }
            return true;
        }, "Please choose a password confirmation.");

        $('#form_app').validate({
            submitHandler: function (form, event) {
                event.preventDefault();
                let urlAction = `${urlActionNow}/action`;
                let formData = new FormData(form);

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
                        // console.log(_post);
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
            ignore: false,
            rules: {
                // password_confirmation: {
                //     checkPassword: true,
                // }
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
    });
    }
</script>
@endpush
