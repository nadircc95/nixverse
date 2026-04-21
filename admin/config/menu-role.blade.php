@extends('admin.layouts.base')

@section('title', "")

@include('admin.layouts.script_logic')



@section('content')

    <form id="submit" class="form needs-validation" novalidate="" method="POST" action="#">
    @csrf
    <input type="text" class="form-control d-none" maxlength="10" name="action" value="save" readonly>
    <div class="row g-3 mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <select name="role_code" class="form-control select2bs5" style="width: 100%;" id="exampleSelectRole" required="">
                        @foreach ($roles as $k => $v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please choose a role.</div>

                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        @foreach ($menus as $parent)

        @php
            $id_ref = "role_{$parent['name']}_{$parent['id']}";
            $id_ref = strtolower(preg_replace('/\s+/', '_', $id_ref));
        @endphp

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light d-flex flex-between-center py-2">
                    <h6 class="mb-0">{{ $parent['name'] }}</h6>
                    <div class="d-flex">
                        <div class="form-check mx-1">
                            <input class="parent-check"
                                id="{{ $parent['id'] }}"
                                name="menu[{{ $parent['id'] }}]"
                                type="checkbox"/>
                        </div>
                        <div class="btn-reveal-trigger">
                            <a class="btn btn-link btn-sm dropdown-indicator"
                            data-bs-toggle="collapse"
                            href="#{{ $id_ref }}">
                            </a>
                        </div>
                    </div>
                </div>

                @if (!empty($parent['children']))
                <div class="collapse" id="{{ $id_ref }}">
                    <div class="card-body">
                        <table class="table table-hover table-borderless table-sm">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th class="text-center">A</th>
                                    <th class="text-center">C</th>
                                    <th class="text-center">R</th>
                                    <th class="text-center">U</th>
                                    <th class="text-center">D</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('admin.config.menu-tree', [
                                    'menus' => $parent['children'],
                                    'level' => 1
                                ])
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @endforeach
    </div>

    <div class="d-grid gap-2">
    <button type="submit" class="btn btn-primary" form="submit">Save</button>
    </div>

    </form>
@endsection

@push('script_add')
<script>
    if (window.jQuery) {
    var $ = window.jQuery;
    function uncheckAllCheckbox(formSelector = 'form') {
        $(formSelector)
            .find('input[type="checkbox"]')
            .prop('checked', false)
            .trigger('change');
    }
    $(document).ready(async function () {

        // let urlActionNow = "{{url('admin/user-role')}}";
        let _formSelect = ["role_code",'site'];

        let select_role = $(`select[name="role_code"].select2bs5`);

        select_role.select2({
            theme: 'bootstrap-5',
            placeholder:"ROLE",
            allowClear: true,
        });

        select_role.val(null).trigger('change.select2');

        $('.sub-check').change(function(){
            let id = $(this).data('id');
            let parentId = $(this).data('parent');
            let selected = $(this).prop('checked');
            // let inputParent = $(`#${parentId}`);
            let inputParent = $(`.sub-check[data-id=${parentId}][name="menu[${parentId}][r]"]`);
            let eachCheckBox = $(`.sub-check[data-id=${id}]`);
            let currentCheckAll = $(`.check-all[data-id=${id}]`);
            let eachCheckBoxParent = $(`.sub-check[data-parent=${parentId}]`);

            let checkedCount = 0;
            eachCheckBox.map((v, i) => {
                let isSelected = $(i).prop('checked');

                if(isSelected)
                    checkedCount += 1;

                if(checkedCount == 4){
                    currentCheckAll.prop('checked', true);
                }
                else{
                    currentCheckAll.prop('checked', false);
                }
            });

            let checkedCount2 = 0;
            eachCheckBoxParent.map((v, i) => {
                let isSelected = $(i).prop('checked');

                if(isSelected)
                    checkedCount2 += 1;

                if(checkedCount2 > 0)
                    inputParent.prop('checked', true).change();
                else
                    inputParent.prop('checked', false).change();
            })

            // inputParent.prop('checked', true);
            parentMenu(this);
            // parentMenu(this);

        });




        $('.check-all').change(function(){
            let id = $(this).data('id');
            let parentId = $(this).data('parent');
            let selected = $(this).prop('checked');
            // let inputParent = $(`#${parentId}`);
            let inputParent = $(`.sub-check[data-id=${parentId}][name="menu[${parentId}][r]"]`);
            let eachCheckBox = $(`.sub-check[data-id=${id}]`);
            let currentCheckAll = $(`.check-all[data-id=${id}]`);

            if(selected)
                eachCheckBox.prop('checked', true).change();
            else
                eachCheckBox.prop('checked', false).change();

            let eachCheckBoxParent = $(`.sub-check[data-parent=${parentId}]`);

            // let checkedCount2 = 0;
            // eachCheckBoxParent.map((v, i) => {
            //     // console.log(v,i);
            //     let isSelected = $(i).prop('checked');

            //     if(isSelected)
            //         checkedCount2 += 1;

            //     if(checkedCount2 > 0)
            //         inputParent.prop('checked', true).change();
            //     else
            //         inputParent.prop('checked', false).change();
            // });

        });

        let parentMenu = function parentMenu(me){
            console.clear();
            // console.log($(me));
            let _tot = 0;
            $(me).closest('.card').find('.card-body input[type="checkbox"].sub-check').map((k,v)=>{
                if($(v).prop('checked')){
                    _tot += 1;
                }
            });
            console.log($(me), _tot);

            if(_tot > 0){
                $(me).closest('.card').find('.card-header input[type="checkbox"]').prop('checked', true);
            }else{
                $(me).closest('.card').find('.card-header input[type="checkbox"]').prop('checked', false);
            }
        }

        // $(`.parent-check`).change(function(){
        //     let id = $(this).data('id');
        //     let selected = $(this).prop('checked');
        //     console.clear();
        //     if(selected){
        //         $(this).closest('.card').find('.card-body input[type="checkbox"].sub-check').map((v,i)=>{
        //             console.log(v,i);
        //         });
        //     }else{

        //     }
        // });

        $('select[name="role_code"]').change(async function(e){
            let th_val = $(this).val();
            // console.log();

            uncheckAllCheckbox('form');

            let _urlMenus = `${urlActionNow}/list`;
            var formData = new FormData();
            formData.append('role_code', th_val);
            let _getMenus = await postDataNoJson(_urlMenus, formData);

            if(_getMenus.error){
                return;
            }

            $.each(_getMenus.i.data.result, function(index, item){
                $(`#${item.menu_id}`).prop('checked', true);
                $(`.sub-check#c-${item.menu_id}`).prop('checked', (item.c == '1') ? true : false).trigger('change');
                $(`.sub-check#r-${item.menu_id}`).prop('checked', (item.r == '1') ? true : false).trigger('change');
                $(`.sub-check#u-${item.menu_id}`).prop('checked', (item.u == '1') ? true : false).trigger('change');
                $(`.sub-check#d-${item.menu_id}`).prop('checked', (item.d == '1') ? true : false).trigger('change');
            });
        });

        // $('#submit').submit(function(e){
        //     e.preventDefault();
        //     let that = $(this);
        //     let formData = new FormData(this);
        //     let urlAction = `${urlActionNow}/action`;


        // });

        var forms = document.querySelectorAll('.needs-validation'); // Loop over them and prevent submission

        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }else{
                    event.preventDefault();
                    event.stopPropagation();
                    let urlAction = `${urlActionNow}/action`;
                    let formData = new FormData(this);


                    // console.clear();

                    // for (var pair of formData.entries()) {
                    //     console.log(pair[0]+ ', ' + pair[1]);
                    // }
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

                            let button_action = $('#submit button[type="submit"]');

                            button_action.prop('disabled', true);

                            let innerBefore = button_action.html();
                            button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

                            let _post = await postDataNoJson(urlAction, formData);
                            button_action.html(innerBefore);
                            button_action.prop('disabled', false);
                            if(_post.error){
                                errorPost(_post, $("body"));
                                return;
                            }
                            $('input[type=checkbox]').prop('checked', false);
                            $('select[name="role_code"]').val(null).trigger('change');
                            Toast.fire({
                                icon: 'success',
                                title: _post.i.data.message
                            });
                            return;
                        }
                    });
                }
                form.classList.add('was-validated');
            }, false);
        });

    });
    }
</script>
@endpush
