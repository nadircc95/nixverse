@extends('admin.layouts.base')

@section('title', "")

@include('admin.layouts.script_logic')

@section('modal_form')
<x-modal.modal-form id="modal_master" ::modal_class="modal-fullscreen " ::title="PMS" ::form="form_app" ::submit="1" ::body_class="py-0">
    <x-slot name="input_hidden">
        <input type="hidden" class="form-control d-none" maxlength="2" name="asset" value="id" readonly>
    </x-slot>
    <div class="row g-3 sticky-top bg-white">
        <div class="col-6 col-md-3">
            <div class="form-group">
                <label for="exampleInputDateUpload">Tanggal Pemeriksaan</label>
                <input id="exampleInputDateUpload" name="date_upload" type="text" class="form-control" placeholder="Date Upload" required>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="form-group">
                <label for="exampleSelectPemeriksa">Pemeriksa</label>
                <select name="pemeriksa" class="form-control select2bs5" style="width: 100%;" id="exampleSelectPemeriksa">

                </select>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="form-group">
                <label for="exampleSelectPeriode">Periode Waktu</label>
                <select name="periode" class="form-control select2bs5" style="width: 100%;" id="exampleSelectPeriode">

                </select>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="form-group">
                <label for="exampleInputDateGetLaporan">Ambil Laporan Tanggal</label>
                <input id="exampleInputDateGetLaporan" name="date_laporan" type="text" class="form-control" placeholder="Date Upload" required>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-outline-warning mb-1" type="button" id="btn_reload">Reload Data</button>
            <button class="btn btn-outline-warning mb-1" type="button" id="btn_reload_dari_tanggal">Reload Data Tanggal </button>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="exampleTextareaInformation">Keterangan</label>
                <textarea class="form-control" name="information" rows="3" maxlength="500" placeholder="Enter information" id="exampleTextareaInformation"></textarea>
            </div>
        </div>

    </div>
    <div class="row g-3 mt-4">
        <div class="col-12">
            <label class="text-danger">*Tunggu Upload Document/Photo hingga tanda checklist hijau</label>
        </div>
        <div class="col-12 t_alert"></div>
        <div class="col-md-6 col-12">
            {{-- start image list --}}
            <div class="form-group">
                <label for="action_images_list_square">Image List</label>
                <div id="action_images_list_square" class="row w-100" name="image_list">
                </div>
            </div>
            {{-- end image list --}}
        </div>
        <div class="col-md-6 col-12">
            {{-- start image list --}}
            <div class="form-group">
                <label for="action_files_one_square">File Document</label>
                <div id="action_files_one_square" class="row w-100" name="files">
                </div>
            </div>
            {{-- end image list --}}
        </div>
        <div class="col-12">
            <div class="falcon-data-table">
            <div class="table-responsive scrollbar">
            <table id="table_master" class="table mb-0 fs--1" width="100%" height="100%">
                <thead class="bg-200 text-900">
                    <tr>
                    <th>#</th>
                    <th>Aset</th>
                    <th class="text-center">Maintain</th>
                    <th class="text-center">Baik</th>
                    <th class="text-center">Tidak Ada</th>
                    <th class="text-center">Rusak</th>
                    <th class="text-center">Remark</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            </div>
            </div>
        </div>
        <div class="col-12"></div>
    </div>
</x-modal.modal-form>

<x-modal.modal-form id="modal_master_incident" ::modal_class="modal-fullscreen " ::title="PMS" ::form="form_app_incident" ::submit="1" ::body_class="py-0">
    <x-slot name="input_hidden">
        <input type="hidden" class="form-control d-none" maxlength="2" name="asset" value="id" readonly>
    </x-slot>
    <div class="row g-3 sticky-top bg-white">
        <div class="col-6 col-md-4">
            <div class="form-group">
                <label for="exampleInputDateUploadIncident">Tanggal Insiden</label>
                <input id="exampleInputDateUploadIncident" name="date_incident" type="text" class="form-control" placeholder="Date Incident" required>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="form-group">
                <label for="exampleSelectPemeriksa">Pemeriksa</label>
                <select name="pemeriksa_incident" class="form-control select2bs5" style="width: 100%;" id="exampleSelectPemeriksa">

                </select>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="form-group">
                <label for="exampleInputPJLIncident">Penanggung Jawab Lapangan</label>
                <input id="exampleInputPJLIncident" name="name_pjl" type="text" class="form-control" placeholder="Penanggung Jawab" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="exampleTextareaInformationIncident">Keterangan</label>
                <textarea class="form-control" name="information" rows="8" maxlength="1200" placeholder="Enter information" id="exampleTextareaInformationIncident" required></textarea>
            </div>
        </div>

    </div>
    <div class="row g-3 mt-4">
        <div class="col-12">
            <label class="text-danger">*Tunggu Upload Document/Photo hingga tanda checklist hijau</label>
        </div>
        <div class="col-12 t_alert"></div>
        <div class="col-md-6 col-12">
            {{-- start image list --}}
            <div class="form-group">
                <label for="action_images_list_square_incident">Image List</label>
                <div id="action_images_list_square_incident" class="row w-100" name="image_list_incident">
                </div>
            </div>
            {{-- end image list --}}
        </div>
    </div>
</x-modal.modal-form>

<x-modal.modal-blank ::id="modal_master_img_doc" ::modal_class="modal-fullscreen " ::title="Image or Files">

</x-modal.modal-blank>
@endsection

@section('content')

{{-- <div class="row g-3 mb-3">
    <div class="col-12 mb-0">
        <div class="card">
          <div class="card-header bg-light py-2">
              <div class="row flex-between-center g-0">
              <div class="col-auto">
                  <h5 class="mb-0">LIST ASET</h5>
              </div>
              <div class="col-auto d-flex">
              </div>
              </div>
          </div>
          <div class="card-body py-3">
              <div class="d-flex flex-column">
                @foreach ($assets as $k => $v)
                    <button class="btn btn-outline-primary btn-lg me-1 mb-1" type="button" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="save" data-ref-id="{{$v->id}}" data-ref-name="{{$v->name}}">
                    <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>{{$v->name}}
                    </button>
                @endforeach
              </div>
          </div>
        </div>
    </div>
</div> --}}

<div class="row g-3">
    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="card-header">
                <div class="row flex-between-end">
                  <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor">LIST ASSET</h5>
                  </div>
                  <div class="col-auto ms-auto">
                    {{-- <button class="btn btn-outline-warning mb-1" type="button" id="btn_refresh">Refresh</button> --}}
                    {{-- <button class="btn btn-outline-success me-1 mb-1" type="button" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="save"><span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Tambah</button> --}}
                  </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    {{-- <div class="col-6 col-md-4">
                        <div class="form-group">
                            <label for="exampleInputDateSearch">Bulan Tahun Search</label>
                            <input id="exampleInputDateSearch" name="date_search" type="text" class="form-control" placeholder="MM-YYYY">
                        </div>
                    </div> --}}

                    <div class="col-12 col-md-12">
                        {{-- <div class="form-group"> --}}
                            <div class="d-flex mb-3 flex-wrap">
                                <label >Bulan Tahun</label>
                            {{-- <div class="btn-group" role="group" aria-label="Basic example" > --}}
                                <select id="exampleSelectBulan" name="bulan" class="form-control select2bs5 rounded-0" style="max-width: 200px;">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <select id="exampleSelectTahun" name="tahun" class="form-control select2bs5 rounded-0">
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                </select>
                                <button class="btn btn-outline-primary data-table-search rounded-0" type="button" >Search</button>
                            {{-- </div> --}}
                            </div>

                        {{-- </div> --}}
                    </div>
                    <div class="col-12">
                        <div class="d-flex mb-3 flex-wrap">
                        {{-- <div class="btn-group" role="group" aria-label="Basic example"> --}}
                            @foreach ($assets as $k => $v)
                            <button class="btn btn-outline-primary data-table-view rounded-0" type="button" data-ref-id="{{$v->id}}" data-ref-name="{{$v->name}}">{{$v->name}}</button>
                            @endforeach
                        {{-- </div> --}}
                        </div>
                        <div class="d-flex mb-3 flex-wrap">
                            {{-- <div class="btn-group" role="group" aria-label="Basic example"> --}}
                                <button class="btn btn-outline-info data-table-view-add rounded-0" type="button" data-bs-toggle="modal" data-bs-target="#modal_master" data-ref-action="save"><span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add Maintain</button>
                                <button class="btn btn-outline-success data-table-view-export rounded-0" type="button">Export<span class="fas fa-file-export ms-1" data-fa-transform="shrink-3"></span></button>
                                {{-- <button class="btn btn-outline-danger data-table-view-incident rounded-0 ms-2" type="button" data-bs-toggle="modal" data-bs-target="#modal_master_incident" data-ref-action="save"><span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Report Incident</button> --}}

                            {{-- </div> --}}
                        </div>

                        <div class="d-flex mb-3 flex-wrap x-btn-periode"></div>
                    </div>
                    {{-- <div class="col-12">
                        <div class="btn-group x-btn-periode" role="group" aria-label="Basic example"></div>
                    </div> --}}
                    <div class="col-12 mt-0">
                        <div id="table-data-check">
                        </div>

                        <div id="table-data-check-equipment">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script_top')
<style>

    .table_master_check_equipment {
    /* width: 100%; */
    /* text-align: center; */
    border-collapse: collapse;
    }

    .table_master_check_equipment tr th,
    .table_master_check_equipment tr td {
    border: 1px solid #000000;
    padding: 10px;
    }

    .table_master_check_equipment tr td {
    font-weight: 600;
    }

    .table_master_check_equipment thead tr th{
        background-color: #27c2fe;
        vertical-align: middle;
        text-align: center;
        font-size: large;
        font-weight: bold;
        color: white;
    }

    .table_master_check_equipment tbody tr td{
        background-color: #ffffff;
    }

    #table-data-check {
    width: 100%;
    height: 1200px;
    overflow: auto;
    }

    .table_master_check {
    width: 100%;
    /* text-align: center; */
    border-collapse: collapse;
    }

    .table_master_check tr th,
    .table_master_check tr td {
    border: 1px solid;
    }

    .table_master_check thead {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
    }

    .table_master_check tfoot {
        position: -webkit-sticky;
        position: sticky;
        bottom: 0;
    }

    .table_master_check thead tr th{
        background-color: #edecec;
        vertical-align: middle;
        text-align: center;
    }

    .table_master_check tfoot tr th{
        background-color: #edecec;
        vertical-align: middle;
        text-align: center;
    }

    .table_master_check tbody tr td{
        background-color: #ffffff;
    }


    /* here is the trick */

    .table_master_check tbody:nth-of-type(1) tr:nth-of-type(1) td {
    border-top: none !important;
    }

    .table_master_check tbody:nth-of-type(1) tr:nth-of-type(2) td {
    border-top: none !important;
    }

    .table_master_check thead th {
    border-top: none !important;
    border-bottom: none !important;
    box-shadow: inset 0 1px 0 #000000, inset 0 -1px 0 #000000;
    /* padding: 1px 0; */
    }

    .table_master_check tfoot th {
    border-top: none !important;
    border-bottom: none !important;
    box-shadow: inset 0 1px 0 #000000, inset 0 -1px 0 #000000;
    /* padding: 1px 0; */
    }


    /* and one small fix for weird FF behavior, described in https://stackoverflow.com/questions/7517127/ */

    .table_master_check thead th {
    background-clip: padding-box
    }

    .table_master_check tfoot th {
    background-clip: padding-box
    }
    /* .table_master_check .stick_left {
        position: sticky;
        left: 0;
        border: 1px solid;
    } */

    /* .table_master_check .stick_left {
        position: sticky;
        left: 0;
        border-top-width: 1px;
        margin-top: -1px;
    }

    .stick_left:before {

    } */

     .table tfoot>tr>th:first-child, .table thead>tr>th:first-child, .table tr th:first-child, .table tr td:first-child {
        padding-left: 0;
    }

    .custom-popover {
    --bs-popover-max-width: 200px;
    --bs-popover-border-color: var(--bs-primary);
    --bs-popover-header-bg: var(--bs-primary);
    --bs-popover-header-color: var(--bs-white);
    --bs-popover-body-padding-x: 1rem;
    --bs-popover-body-padding-y: .5rem;
    }
</style>

<link href="{{url('toast')}}/jquery.toast.min.css" rel="stylesheet">

@endpush

@push('script_add')

<script src="{{url('falcon')}}/vendors/anchorjs/anchor.min.js"></script>
<script src="{{url('falcon')}}/vendors/is/is.min.js"></script>
<script src="{{url('falcon')}}/vendors/lottie/lottie.min.js"></script>
{{-- <script src="{{url('falcon')}}/vendors/validator/validator.min.js"></script> --}}
<script>
    if (window.jQuery) {
    var $ = window.jQuery;
    $(async function(){
        $.fn.dataTable.ext.errMode = 'none';

        let modal_db = $(`#modal_master`);
        let modal_db_check = $(`#modal_master_check`);
        let modal_db_incident = $(`#modal_master_incident`);
        let table_name = "#table_master";
        let _title = $(`nav .breadcrumb li.breadcrumb-item.name_menu_active`).html();
        let relatedTargetAction;
        let relatedTargetAsset = 0;
        let relatedTargetImgDoc = [];

        $(`#header_menu`).find(".title_ams").addClass("text-primary").html("Welcome {{Auth::user()->name}}");

        // start image list
        let _customDropZoneImageList = null;
        let add_image_list = async function add_image_list(id){

            let _cr_x = modal_db.find(`#action_images_list_square.row div[data-imgx-${id}-pr="id"]`);

            if(_cr_x.length == 0){
                modal_db.find('#action_images_list_square.row').append(`
                <div data-imgx-${id}-pr="id" class="m-2 position-relative d-flex flex-row" style="gap: 0.5rem;">
                    <div data-imgx-${id}-pr="container" class=" d-flex flex-wrap" style="gap: 0.5rem;">

                        <div data-imgx-${id}-pr="template" class="d-flex flex-column">
                            <div class="square-upload position-relative" style="width:100px;">
                                <div class="template-images-${id}-pr">
                                    <span class="preview"><img class="square-upload-img" src="data:," alt="" data-dz-thumbnail /></span>
                                </div>
                                <input type="text" value="" class="d-none" name="image_list[]">
                                <div class="hide-act-upload position-absolute w-100" style="bottom:0%!important;opacity: .92;">
                                    <div class="p-1 d-flex flex-row  justify-content-between bg-light w-100" style="border-bottom-left-radius: .5rem;border-bottom-right-radius: .5rem;" >
                                        <div style="font-size: x-small;" class="text-center d-flex flex-column">
                                            <div class="single-line">
                                                <span class="lead d-none" data-dz-name></span>
                                            </div>
                                            <div class="single-line">
                                                (<span data-dz-size></span>)
                                            </div>
                                            <div class="single-line">
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" data-dz-remove class="btn btn-outline-danger btn-sm delete" style="padding: 0.15rem 0.35rem;font-size: .8rem;">
                                            <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="position-absolute x-status-upload" style="top: 0%!important;left: 100%!important;transform: translate(-50%, -50%);"></div>
                            </div>
                        </div>
                    </div>
                </div>
                `);

                let _showTemplate = `
                <div data-imgx-${id}-pr="click">
                    <div class="d-flex flex-column">
                        <div class="square-upload c-upload-imgx-${id}-pr" style="width:100px;">
                            <span class="square-upload-img d-flex-center"><img src="{{url('assets/img/ic/camera-x36.png')}}"/></span>
                        </div>
                    </div>
                </div>
                `;

                _customDropZoneImageList = await customDropZoneImageOne({
                    'id' : `div[data-imgx-${id}-pr="id"]`,
                    'path_image': `img/aset/list`,
                    'idTemplate': `data-imgx-${id}-template-square`,
                    'showTemplate': _showTemplate,
                    'maxFiles': 10,
                    // 'attributeTemplate': `data-img-${id}`,
                    'previewTemplate': `div[data-imgx-${id}-pr="template"]`,
                    'previewsContainer': `div[data-imgx-${id}-pr="container"]`,
                    'previewsClick': `div[data-imgx-${id}-pr="click"]`,
                    // 'clickable': `div[data-imgx-${id}-pr="container"] .c-upload-imgx-${id}-pr`,
                    'clickable': `div[data-imgx-${id}-pr="click"] .c-upload-imgx-${id}-pr`,
                    'input': `[name="image_list[]"]`,
                });
            }

        }
        add_image_list('xnx');
        // end image list

        // start image list
        let _customDropZoneImageListIncident = null;
        let add_image_list_incident = async function add_image_list_incident(id){

            let _cr_x = modal_db_incident.find(`#action_images_list_square_incident.row div[data-imgx-${id}-pr="id"]`);

            if(_cr_x.length == 0){
                modal_db_incident.find('#action_images_list_square_incident.row').append(`
                <div data-imgx-${id}-pr="id" class="m-2 position-relative d-flex flex-row" style="gap: 0.5rem;">
                    <div data-imgx-${id}-pr="container" class=" d-flex flex-wrap" style="gap: 0.5rem;">

                        <div data-imgx-${id}-pr="template" class="d-flex flex-column">
                            <div class="square-upload position-relative" style="width:100px;">
                                <div class="template-images-${id}-pr">
                                    <span class="preview"><img class="square-upload-img" src="data:," alt="" data-dz-thumbnail /></span>
                                </div>
                                <input type="text" value="" class="d-none" name="image_list_incident[]">
                                <div class="hide-act-upload position-absolute w-100" style="bottom:0%!important;opacity: .92;">
                                    <div class="p-1 d-flex flex-row  justify-content-between bg-light w-100" style="border-bottom-left-radius: .5rem;border-bottom-right-radius: .5rem;" >
                                        <div style="font-size: x-small;" class="text-center d-flex flex-column">
                                            <div class="single-line">
                                                <span class="lead d-none" data-dz-name></span>
                                            </div>
                                            <div class="single-line">
                                                (<span data-dz-size></span>)
                                            </div>
                                            <div class="single-line">
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" data-dz-remove class="btn btn-outline-danger btn-sm delete" style="padding: 0.15rem 0.35rem;font-size: .8rem;">
                                            <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="position-absolute x-status-upload" style="top: 0%!important;left: 100%!important;transform: translate(-50%, -50%);"></div>
                            </div>
                        </div>
                    </div>
                </div>
                `);

                let _showTemplate = `
                <div data-imgx-${id}-pr="click">
                    <div class="d-flex flex-column">
                        <div class="square-upload c-upload-imgx-${id}-pr" style="width:100px;">
                            <span class="square-upload-img d-flex-center"><img src="{{url('assets/img/ic/camera-x36.png')}}"/></span>
                        </div>
                    </div>
                </div>
                `;

                _customDropZoneImageListIncident = await customDropZoneImageOne({
                    'id' : `div[data-imgx-${id}-pr="id"]`,
                    'path_image': `img/incident`,
                    'idTemplate': `data-imgx-${id}-template-square`,
                    'showTemplate': _showTemplate,
                    'maxFiles': 10,
                    // 'attributeTemplate': `data-img-${id}`,
                    'previewTemplate': `div[data-imgx-${id}-pr="template"]`,
                    'previewsContainer': `div[data-imgx-${id}-pr="container"]`,
                    'previewsClick': `div[data-imgx-${id}-pr="click"]`,
                    // 'clickable': `div[data-imgx-${id}-pr="container"] .c-upload-imgx-${id}-pr`,
                    'clickable': `div[data-imgx-${id}-pr="click"] .c-upload-imgx-${id}-pr`,
                    'input': `[name="image_list_incident[]"]`,
                });
            }

        }
        add_image_list_incident('bgh');
        // end image list

        let _customDropZoneFileList = null;
        let add_file_list = async function add_file_list(id){

            let _cr_x = modal_db.find(`#action_files_one_square.row div[data-imgx-${id}-pr="id"]`);

            if(_cr_x.length == 0){
                modal_db.find('#action_files_one_square.row').append(`
                <div data-imgx-${id}-pr="id" class="m-2  position-relative d-flex flex-row" style="gap: 0.5rem;">
                    <div data-imgx-${id}-pr="container" class=" d-flex flex-wrap" style="gap: 0.5rem;">

                        <div data-imgx-${id}-pr="template" class="d-flex flex-column">
                            <div class="square-upload position-relative" style="width:100px;">
                                <div class="template-images-${id}-pr">
                                    <span class="preview dz-image"><img class="square-upload-img" src="data:," alt="" /></span>
                                </div>
                                <input type="text" value="" class="d-none" name="files[]">
                                <div class="hide-act-upload position-absolute w-100" style="bottom:0%!important;opacity: .92;">
                                    <div class="p-1 d-flex flex-row  justify-content-between bg-light w-100" style="border-bottom-left-radius: .5rem;border-bottom-right-radius: .5rem;" >
                                        <div style="font-size: x-small;" class="text-center d-flex flex-column">
                                            <div class="">
                                                <span class="lead w-100" style="font-size:.65rem" data-dz-name></span>
                                            </div>
                                            <div class="single-line">
                                                (<span data-dz-size></span>)
                                            </div>
                                            <div class="single-line">
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" data-dz-remove class="btn btn-outline-danger btn-sm delete" style="padding: 0.15rem 0.35rem;font-size: .8rem;">
                                            <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="position-absolute x-status-upload" style="top: 0%!important;left: 100%!important;transform: translate(-50%, -50%);"></div>
                            </div>
                        </div>
                    </div>
                </div>
                `);

                let _showTemplate = `
                <div data-imgx-${id}-pr="click">
                    <div class="d-flex flex-column">
                        <div class="square-upload c-upload-imgx-${id}-pr" style="width:100px;">
                            <span class="square-upload-img d-flex-center"><img src="{{url('ic-png/my-pdf.png')}}" width="36px"/></span>
                        </div>
                    </div>
                </div>
                `;

                _customDropZoneFileList = await customDropZoneImageOne({
                    'id' : `div[data-imgx-${id}-pr="id"]`,
                    'path_image': `aset`,
                    'idTemplate': `data-imgx-${id}-template-square`,
                    'showTemplate': _showTemplate,
                    'maxFiles': 5,
                    // 'attributeTemplate': `data-img-${id}`,
                    'previewTemplate': `div[data-imgx-${id}-pr="template"]`,
                    'previewsContainer': `div[data-imgx-${id}-pr="container"]`,
                    'previewsClick': `div[data-imgx-${id}-pr="click"]`,
                    'clickable': `div[data-imgx-${id}-pr="click"] .c-upload-imgx-${id}-pr`,
                    // 'input': `[name="files"]`,
                    'input': `[name="files[]"]`,
                    'imageOrDocument': 'pdf',
                    'id_image': 'id_file'
                });
            }

        }
        add_file_list('xyx');

        let table_master = new DataTable(`${table_name}`);
        // await $(`${table_name}`).DataTable();

        let date_upload = $(`#exampleInputDateUpload`).flatpickr({
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            minDate: "2022-01",
        });

        let date_laporan = $(`#exampleInputDateGetLaporan`).flatpickr({
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            minDate: "2022-01",
        });

        let date_incident = $(`#exampleInputDateUploadIncident`).flatpickr({
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            minDate: "2022-01",
        });
        // let date_search = $(`#exampleInputDateSearch`).flatpickr({
        //     plugins: [
        //         new monthSelectPlugin({
        //             shorthand: true, //defaults to false
        //             dateFormat: "m-Y", //defaults to "F Y"
        //             altFormat: "m-Y", //defaults to "F Y"
        //             theme: "light" // defaults to "light"
        //         })
        //     ],
        // });

        // date_search.setDate(`${moment().format("MM-YYYY")}`, false);



        $(`[name="bulan"].select2bs5`).select2({
            width: 'resolve',
            theme: 'bootstrap-5',
            placeholder:"Bulan",
        });

        $(`[name="tahun"].select2bs5`).select2({
            width: 'resolve',
            theme: 'bootstrap-5',
            placeholder:"Tahun",
        });

        $(`[name="bulan"].select2bs5`).val(`${moment().format("MM")}`).trigger('change.select2');
        $(`[name="bulan"].select2bs5`).val(`${moment().format("MM")}`).trigger('change');


        $(`[name="tahun"].select2bs5`).val(`${moment().format("YYYY")}`).trigger('change.select2');
        $(`[name="tahun"].select2bs5`).val(`${moment().format("YYYY")}`).trigger('change');

        $(`button.data-table-search`).click();

        date_laporan.config.onClose.push(function(){
            let ref_tgl = $(`input[name="date_laporan"]`).val();

            $(`#btn_reload_dari_tanggal`).html(`Reload Data Tanggal ${ref_tgl}`);
        });

        function clear_modal_change(){
            table_master = new DataTable(`${table_name}`);
            $(`.falcon-data-table`).hide();
            $(`#action_images_list_square`).parent().parent().hide();
            $(`#action_files_one_square`).parent().parent().hide();

            // // start image list
            // if(_customDropZoneImageList != null){
            //     _customDropZoneImageList.files.forEach(function(item){
            //         item.previewElement.setAttribute('data-hidden', "true");
            //         _customDropZoneImageList.removeFile(item);
            //     });
            // }
            // // end image list

            // // start file list
            // if(_customDropZoneFileList != null){
            //     _customDropZoneFileList.files.forEach(function(item){
            //         item.previewElement.setAttribute('data-hidden', "true");
            //         _customDropZoneFileList.removeFile(item);
            //     });
            // }
            // // end file list

            // start image list
            if(_customDropZoneImageList != null){
                _customDropZoneImageList.files.forEach(function(item){
                    _customDropZoneImageList.softRemoveFile(item);
                });
            }
            // end image list

            // start file list
            if(_customDropZoneFileList != null){
                _customDropZoneFileList.files.forEach(function(item){
                    _customDropZoneFileList.softRemoveFile(item);
                });
            }
            // end file list

            modal_db.find('.modal-footer button[type="submit"]').hide();
        }

        date_upload.config.onClose.push(function(){
            clear_modal_change();
        });

        showReportBy = async (_ref_date = $(`input[name="date_upload"]`).val(), _reload = true) => {
            $(`.falcon-data-table`).show();
            $(`#action_images_list_square`).parent().parent().show();
            $(`#action_files_one_square`).parent().parent().show();

            // start image list
            if(_customDropZoneImageList != null){
                _customDropZoneImageList.files.forEach(function(item){
                    _customDropZoneImageList.softRemoveFile(item);
                });
            }
            // end image list

            // start file list
            if(_customDropZoneFileList != null){
                _customDropZoneFileList.files.forEach(function(item){
                    _customDropZoneFileList.softRemoveFile(item);
                });
            }
            // end file list

            // // start image list
            // if(_customDropZoneImageList != null){
            //     _customDropZoneImageList.files.forEach(function(item){
            //         item.previewElement.setAttribute('data-hidden', "true");
            //         _customDropZoneImageList.removeFile(item);
            //     });
            // }
            // // end image list

            // // start file list
            // if(_customDropZoneFileList != null){
            //     _customDropZoneFileList.files.forEach(function(item){
            //         item.previewElement.setAttribute('data-hidden', "true");
            //         _customDropZoneFileList.removeFile(item);
            //     });
            // }
            // // end file list
            // table_master = await new DataTable(`${table_name}`);
            table_master.destroy();
            // $(`${table_name}`).empty();



            table_master = await $(`${table_name}`).DataTable({
                retrieve: true,
                responsive: true,
                processing: false,
                serverSide: false,
                searching: true,
                scrollCollapse : true,
                paginate: false,
                scrollY: "100%",
                scrollX: true,
                fixedHeader: true,
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
                        d.id = relatedTargetAsset;
                        d.date = _ref_date;
                        d.date_asli = $(`input[name="date_upload"]`).val();
                        d.user = $(`select[name="pemeriksa"]`).val();
                        d.period = $(`select[name="periode"]`).val();
                        $(`.card #btn_refresh`).html(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Please Wait...`);
                        $(`.card #btn_refresh`).prop('disabled', true);

                        modal_db.find('.modal-body input[name="id"]').val('');

                    },
                    "dataSrc": function (json) {
                        $(`.card #btn_refresh`).html('Refresh');
                        $(`.card #btn_refresh`).prop('disabled', false);
                        if (json.error) {
                            return [];
                        }

                        // if(json.data_asli == true){
                        //     _reload = true;
                        // }

                        modal_db.find('.modal-footer button[type="submit"]').show();


                        let _textarea_form = modal_db.find(`div.modal-body textarea[name="information"]`);
                        if (_textarea_form.length > 0) {
                            json.information = decodeHTML(json.information);
                            _textarea_form.val(`${json.information}`);
                        }

                        if(json.find == true){
                            if(_reload == true || json.data_asli == true){
                                modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-success');
                                modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-danger');
                                modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-primary');
                                modal_db.find('.modal-body input[name="id"]').val(`${json.find_id}`);

                                modal_db.find('.modal-body input[name="action"]').val('update');

                                modal_db.find('.modal-footer button[type="submit"]').html('Update');
                                modal_db.find('.modal-footer button[type="submit"]').addClass('bg-success');
                            }else{
                                modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-success');
                                modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-danger');
                                modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-primary');

                                modal_db.find('.modal-body input[name="id"]').val(``);

                                modal_db.find('.modal-body input[name="action"]').val('save');

                                modal_db.find('.modal-footer button[type="submit"]').html('Save');
                                modal_db.find('.modal-footer button[type="submit"]').addClass('bg-primary');
                            }

                            if(_reload == true){
                                if(json.images.length > 0 && _customDropZoneImageList != null){
                                    json.images.forEach((item, index) => {
                                        let _mockAdd = {
                                            success: true,
                                            error: false,
                                            active:true,
                                            id_image: item.id,
                                            filename_new: item.filename_new,
                                            url: item.url,

                                            name: item.filename_original,
                                            size: item.filesize,
                                        };

                                        let _mockFile = {
                                            name: _mockAdd.name,
                                            size: _mockAdd.size,
                                            status: Dropzone.ADDED,
                                            accepted: true,
                                        };

                                        _customDropZoneImageList.displayExistingFile(_mockFile, `${_mockAdd.url}`,null,null,true);
                                        _customDropZoneImageList.files.push(_mockFile);
                                        _customDropZoneImageList.emit("success", _mockFile, {
                                            success:  _mockAdd.success,
                                            error:  _mockAdd.error,
                                            id_image:  _mockAdd.id_image,
                                            filename_new:  _mockAdd.filename_new,
                                            url:  _mockAdd.url,
                                            active:  _mockAdd.active,
                                        });
                                        _customDropZoneImageList.emit("complete", _mockFile);

                                    });

                                }

                                if(json.files.length > 0 && _customDropZoneFileList != null){
                            }
                                json.files.forEach((item, index) => {
                                    item.url = '';
                                    let _mockAdd = {
                                        success: true,
                                        error: false,
                                        active:true,
                                        id_file: item.id,
                                        filename_new: item.filename_new,
                                        url: item.url,

                                        name: item.filename_original,
                                        size: item.filesize,
                                    };

                                    let _mockFile = {
                                        name: _mockAdd.name,
                                        size: _mockAdd.size,
                                        status: Dropzone.ADDED,
                                        accepted: true,
                                    };

                                    _customDropZoneFileList.displayExistingFile(_mockFile, `${_mockAdd.url}`,null,null,true);
                                    _customDropZoneFileList.files.push(_mockFile);
                                    _customDropZoneFileList.emit("success", _mockFile, {
                                        success:  _mockAdd.success,
                                        error:  _mockAdd.error,
                                        id_file:  _mockAdd.id_file,
                                        filename_new:  _mockAdd.filename_new,
                                        url:  _mockAdd.url,
                                        active:  _mockAdd.active,
                                    });
                                    _customDropZoneFileList.emit("complete", _mockFile);

                                });

                            }

                        }else{
                            modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-success');
                            modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-danger');
                            modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-primary');

                            modal_db.find('.modal-body input[name="id"]').val(``);

                            modal_db.find('.modal-body input[name="action"]').val('save');

                            modal_db.find('.modal-footer button[type="submit"]').html('Save');
                            modal_db.find('.modal-footer button[type="submit"]').addClass('bg-primary');
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
                        width: "24px",
                        data: 'DT_RowIndex',
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        width: "60%",
                        data: 'name',
                        name: "name",
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row, meta){
                            // console.log(row, meta);
                            let _bold = `font-weight:500 !important;`;
                            let _margin = `margin-left:${row.group * 2}rem !important;`;
                            let _data = data;
                            if(row.group == 0){
                                _bold = `font-weight:900 !important;`;
                                _data = `# ${data}`;
                            }else if(row.group == 1){
                                _bold = `font-weight:700 !important;`;
                                _data = `* ${data}`;
                            }
                            return `<div style="${_margin}${_bold}">${_data}</div>`;
                        }
                    },
                    {
                        class: "notexport",
                        data: null,
                        width: "80px",
                        name: "",
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row, meta){
                            let _checked = `checked=""`;
                            let _xlabel = "Check";
                            if(row.maintain != null){
                                if(row.maintain.timetable == 'CHECK'){
                                    _checked = `checked=""`;
                                    _xlabel = "Check";
                                }else{
                                    _checked = ``;
                                    _xlabel = "UnCheck";
                                }
                            }
                            let _html = `
                            <div class="form-check form-switch">
                                <input class="form-check-input flexCheckDefault_S" type="checkbox" id="flexCheckDefault1-${row.id}" name="flexCheckDefault_S['${row.id}']" value="CHECK" ${_checked}/>
                                <label class="form-check-label" for="flexCheckDefault1-${row.id}" >${_xlabel}</label>
                            </div>
                            `;
                            if(row.last == false){
                                _html = ``;
                            }

                            return `${_html}`;
                        }
                    },
                    {
                        class: "notexport",
                        data: null,
                        width: "80px",
                        name: "",
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row, meta){
                            let _checked = `checked=""`;
                            if(row.maintain != null){
                                if(row.maintain.status == 'Baik'){
                                    _checked = `checked=""`;
                                }
                            }
                            let _html = `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="flexRadioDefault1-${row.id}" name="flexRadioDefault_S['${row.id}']" value="Baik" ${_checked}/>
                                <label class="form-check-label" for="flexRadioDefault1-${row.id}" >Baik</label>
                            </div>
                            `;
                            if(row.last == false){
                                _html = ``;
                            }

                            return `${_html}`;
                        }
                    },
                    {
                        class: "notexport",
                        data: null,
                        width: "80px",
                        name: "",
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row, meta){
                            let _checked = ``;
                            if(row.maintain != null){
                                if(row.maintain.status == 'Tidak Ada'){
                                    _checked = `checked=""`;
                                }
                            }
                            let _html = `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="flexRadioDefault2-${row.id}" name="flexRadioDefault_S['${row.id}']" value="Tidak Ada" ${_checked}/>
                                <label class="form-check-label" for="flexRadioDefault2-${row.id}" >Tidak Ada</label>
                            </div>
                            `;
                            if(row.last == false){
                                _html = ``;
                            }

                            return `${_html}`;
                        }
                    },
                    {
                        class: "notexport",
                        data: null,
                        width: "80px",
                        name: "",
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row, meta){
                            let _checked = ``;
                            if(row.maintain != null){
                                if(row.maintain.status == 'Rusak'){
                                    _checked = `checked=""`;
                                }
                            }
                            let _html = `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="flexRadioDefault3-${row.id}" name="flexRadioDefault_S['${row.id}']"  value="Rusak" ${_checked}/>
                                <label class="form-check-label" for="flexRadioDefault3-${row.id}" >Rusak</label>
                            </div>
                            `;
                            if(row.last == false){
                                _html = ``;
                            }

                            return `${_html}`;
                        }
                    },
                    {
                        class: "notexport",
                        data: null,
                        width: "300px",
                        name: "",
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row, meta){
                            let _remark = ``;
                            if(row.maintain != null){
                                if(row.maintain.info != null){
                                _remark = row.maintain.info;
                                }
                            }
                            let _html = `
                            <div class="form-check">
                                <textarea class="form-control" name="remark_S['${row.id}']" rows="3" maxlength="500" placeholder="Remark" id="exampleTextareaName-${row.id}">${_remark}</textarea>
                            </div>
                            `;
                            if(row.last == false){
                                _html = ``;
                            }

                            return `${_html}`;
                        }
                    },
                ],
                "drawCallback": async function( settings ) {
                    // is_session_ref_action();
                },
                dom: "<'row mx-2'<'col-12'tr>>",
                // dom: "<'row mx-2 mb-2'<'col-12'>><'row mx-2 mb-2 g-2'<'col-md-3'l><'col-md-3'><'col-md-6'f>><'row mx-2'<'col-12'tr>><'row mt-2 g-0 align-items-center justify-content-center justify-content-sm-between'<'col-auto mb-2 mb-sm-0 px-3'i><'col-auto px-3'>>",
                buttons: _button_export(_title),
                createdRow: function(row, data, dataIndex){

                    if(data.last == false){
                        $(`td:eq(1)`, row).attr('colspan', 6);

                        $('td:eq(2)', row).css('display', 'none');
                        $('td:eq(3)', row).css('display', 'none');
                        $('td:eq(4)', row).css('display', 'none');
                        $('td:eq(5)', row).css('display', 'none');
                        $('td:eq(6)', row).css('display', 'none');

                        // this.api().cell($('td:eq(1)', row)).data(`${data.name}`);
                    }

                    if(data.group == 0){
                        $(`td:eq(1)`, row).addClass('bg-info text-light');
                    }else if(data.group == 1){
                        $(`td:eq(1)`, row).addClass('bg-secondary text-light');
                    }
                    // console.log(row, data, dataIndex, 'nadir');

                }
            })
            .on('draw.dt', function(){
                var wrpper = $(`${table_name}`).closest('.dataTables_wrapper');
                wrpper.find('.pagination').addClass('pagination-sm');
            })
            .on('error.dt', function (e, settings, techNote, message) {
                console.log('Error: DataTables: ' + message);
                return true;
            });

            // await table_master.ajax.reload();
        };

        $(`#modal_master`).find(`#btn_reload_dari_tanggal`).on('click', async function(){
            let _ref_date = $(`input[name="date_laporan"]`).val();
            let _reload = false;
            showReportBy(_ref_date, _reload);
        });

        $(`#modal_master`).find(`#btn_reload`).on('click', async function(){

            showReportBy();

            // table_master.ajax.reload();

            // $(`.falcon-data-table`).show();
            // $(`#action_images_list_square`).parent().parent().show();
            // $(`#action_files_one_square`).parent().parent().show();

            // // start image list
            // if(_customDropZoneImageList != null){
            //     _customDropZoneImageList.files.forEach(function(item){
            //         item.previewElement.setAttribute('data-hidden', "true");
            //         _customDropZoneImageList.removeFile(item);
            //     });
            // }
            // // end image list

            // // start file list
            // if(_customDropZoneFileList != null){
            //     _customDropZoneFileList.files.forEach(function(item){
            //         item.previewElement.setAttribute('data-hidden', "true");
            //         _customDropZoneFileList.removeFile(item);
            //     });
            // }
            // // end file list
            // // table_master = await new DataTable(`${table_name}`);
            // table_master.destroy();
            // // $(`${table_name}`).empty();



            // table_master = await $(`${table_name}`).DataTable({
            //     retrieve: true,
            //     responsive: true,
            //     processing: false,
            //     serverSide: false,
            //     searching: true,
            //     scrollCollapse : true,
            //     paginate: false,
            //     scrollY: "100%",
            //     scrollX: true,
            //     fixedHeader: true,
            //     fixedColumns :{
            //         left:1,
            //         // right: 1
            //     },

            //     // fixedHeader: true,
            //     // dom: "<'row mx-0'<'col-md-6'l><'col-md-6'f>><'table-responsive scrollbar'tr><'row g-0 align-items-center justify-content-center justify-content-sm-between'<'col-auto mb-2 mb-sm-0 px-3'i><'col-auto px-3'p>>",
            //     // dom: "<'row mx-1'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive scrollbar'tr><'row no-gutters px-1 pb-3 align-items-center justify-content-center'<'col-auto' p>>",
            //     ajax: {
            //         "url": `${urlActionNow}/datatable`,
            //         "data": function (d) {
            //             d.id = relatedTargetAsset;
            //             d.date = $(`input[name="date_upload"]`).val();
            //             d.user = $(`select[name="pemeriksa"]`).val();
            //             d.period = $(`select[name="periode"]`).val();
            //             $(`.card #btn_refresh`).html(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Please Wait...`);
            //             $(`.card #btn_refresh`).prop('disabled', true);

            //             modal_db.find('.modal-body input[name="id"]').val('');

            //         },
            //         "dataSrc": function (json) {
            //             $(`.card #btn_refresh`).html('Refresh');
            //             $(`.card #btn_refresh`).prop('disabled', false);
            //             if (json.error) {
            //                 return [];
            //             }

            //             if(json.find == true){
            //                 modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-success');
            //                 modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-danger');
            //                 modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-primary');

            //                 modal_db.find('.modal-body input[name="id"]').val(`${json.find_id}`);

            //                 modal_db.find('.modal-body input[name="action"]').val('update');

            //                 modal_db.find('.modal-footer button[type="submit"]').html('Update');
            //                 modal_db.find('.modal-footer button[type="submit"]').addClass('bg-success');

            //                 if(json.images.length > 0 && _customDropZoneImageList != null){
            //                     json.images.forEach((item, index) => {
            //                         let _mockAdd = {
            //                             success: true,
            //                             error: false,
            //                             active:true,
            //                             id_image: item.id,
            //                             filename_new: item.filename_new,
            //                             url: item.url,

            //                             name: item.filename_original,
            //                             size: item.filesize,
            //                         };

            //                         let _mockFile = {
            //                             name: _mockAdd.name,
            //                             size: _mockAdd.size,
            //                             status: Dropzone.ADDED,
            //                             accepted: true,
            //                         };

            //                         _customDropZoneImageList.displayExistingFile(_mockFile, `${_mockAdd.url}`,null,null,true);
            //                         _customDropZoneImageList.files.push(_mockFile);
            //                         _customDropZoneImageList.emit("success", _mockFile, {
            //                             success:  _mockAdd.success,
            //                             error:  _mockAdd.error,
            //                             id_image:  _mockAdd.id_image,
            //                             filename_new:  _mockAdd.filename_new,
            //                             url:  _mockAdd.url,
            //                             active:  _mockAdd.active,
            //                         });
            //                         _customDropZoneImageList.emit("complete", _mockFile);

            //                     });

            //                 }

            //                 if(json.files.length > 0 && _customDropZoneFileList != null){
            //                     json.files.forEach((item, index) => {
            //                         item.url = '';
            //                         let _mockAdd = {
            //                             success: true,
            //                             error: false,
            //                             active:true,
            //                             id_file: item.id,
            //                             filename_new: item.filename_new,
            //                             url: item.url,

            //                             name: item.filename_original,
            //                             size: item.filesize,
            //                         };

            //                         let _mockFile = {
            //                             name: _mockAdd.name,
            //                             size: _mockAdd.size,
            //                             status: Dropzone.ADDED,
            //                             accepted: true,
            //                         };

            //                         _customDropZoneFileList.displayExistingFile(_mockFile, `${_mockAdd.url}`,null,null,true);
            //                         _customDropZoneFileList.files.push(_mockFile);
            //                         _customDropZoneFileList.emit("success", _mockFile, {
            //                             success:  _mockAdd.success,
            //                             error:  _mockAdd.error,
            //                             id_file:  _mockAdd.id_file,
            //                             filename_new:  _mockAdd.filename_new,
            //                             url:  _mockAdd.url,
            //                             active:  _mockAdd.active,
            //                         });
            //                         _customDropZoneFileList.emit("complete", _mockFile);

            //                     });

            //                 }

            //             }else{
            //                 modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-success');
            //                 modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-danger');
            //                 modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-primary');

            //                 modal_db.find('.modal-body input[name="id"]').val(``);

            //                 modal_db.find('.modal-body input[name="action"]').val('save');

            //                 modal_db.find('.modal-footer button[type="submit"]').html('Save');
            //                 modal_db.find('.modal-footer button[type="submit"]').addClass('bg-primary');
            //             }


            //             return json.data;
            //         }
            //     },
            //     lengthMenu: [
            //         [10, 25, 50, 100, -1],
            //         [10, 25, 50, 100, 'All'],
            //     ],
            //     // lengthChange: false,
            //     language: {
            //         paginate: {
            //             // next: '&raquo;',
            //             // previous: '&laquo;',
            //             next: "<span class=\"fas fa-chevron-right\"></span>",
            //             previous: "<span class=\"fas fa-chevron-left\"></span>",
            //         }
            //     },
            //     "initComplete": function (settings, json) {
            //         $(`${table_name}_filter input`).unbind();
            //         $(`${table_name}_filter input`).bind('keyup', function (e) {
            //             if (e.keyCode == 13) {
            //                 table_master.search(this.value).draw();
            //             }
            //         });
            //     },
            //     columns: [
            //         {
            //             class: "white-space-nowrap",
            //             width: "24px",
            //             data: 'DT_RowIndex',
            //             name: "DT_RowIndex",
            //             orderable: false,
            //             searchable: false
            //         },
            //         {
            //             width: "60%",
            //             data: 'name',
            //             name: "name",
            //             orderable: false,
            //             searchable: true,
            //             render: function(data, type, row, meta){
            //                 // console.log(row, meta);
            //                 let _bold = `font-weight:500 !important;`;
            //                 let _margin = `margin-left:${row.group * 2}rem !important;`;
            //                 let _data = data;
            //                 if(row.group == 0){
            //                     _bold = `font-weight:900 !important;`;
            //                     _data = `# ${data}`;
            //                 }else if(row.group == 1){
            //                     _bold = `font-weight:700 !important;`;
            //                     _data = `* ${data}`;
            //                 }
            //                 return `<div style="${_margin}${_bold}">${_data}</div>`;
            //             }
            //         },
            //         {
            //             class: "notexport",
            //             data: null,
            //             width: "80px",
            //             name: "",
            //             orderable: false,
            //             searchable: true,
            //             render: function(data, type, row, meta){
            //                 let _checked = `checked=""`;
            //                 if(row.maintain != null){
            //                     if(row.maintain.status == 'Baik'){
            //                         _checked = `checked=""`;
            //                     }
            //                 }
            //                 let _html = `
            //                 <div class="form-check">
            //                     <input class="form-check-input" type="radio" id="flexRadioDefault1-${row.id}" name="flexRadioDefault_S['${row.id}']" value="Baik" ${_checked}/>
            //                     <label class="form-check-label" for="flexRadioDefault1-${row.id}" >Baik</label>
            //                 </div>
            //                 `;
            //                 if(row.last == false){
            //                     _html = ``;
            //                 }

            //                 return `${_html}`;
            //             }
            //         },
            //         {
            //             class: "notexport",
            //             data: null,
            //             width: "80px",
            //             name: "",
            //             orderable: false,
            //             searchable: true,
            //             render: function(data, type, row, meta){
            //                 let _checked = ``;
            //                 if(row.maintain != null){
            //                     if(row.maintain.status == 'Tidak Ada'){
            //                         _checked = `checked=""`;
            //                     }
            //                 }
            //                 let _html = `
            //                 <div class="form-check">
            //                     <input class="form-check-input" type="radio" id="flexRadioDefault2-${row.id}" name="flexRadioDefault_S['${row.id}']" value="Tidak Ada" ${_checked}/>
            //                     <label class="form-check-label" for="flexRadioDefault2-${row.id}" >Tidak Ada</label>
            //                 </div>
            //                 `;
            //                 if(row.last == false){
            //                     _html = ``;
            //                 }

            //                 return `${_html}`;
            //             }
            //         },
            //         {
            //             class: "notexport",
            //             data: null,
            //             width: "80px",
            //             name: "",
            //             orderable: false,
            //             searchable: true,
            //             render: function(data, type, row, meta){
            //                 let _checked = ``;
            //                 if(row.maintain != null){
            //                     if(row.maintain.status == 'Rusak'){
            //                         _checked = `checked=""`;
            //                     }
            //                 }
            //                 let _html = `
            //                 <div class="form-check">
            //                     <input class="form-check-input" type="radio" id="flexRadioDefault3-${row.id}" name="flexRadioDefault_S['${row.id}']"  value="Rusak" ${_checked}/>
            //                     <label class="form-check-label" for="flexRadioDefault3-${row.id}" >Rusak</label>
            //                 </div>
            //                 `;
            //                 if(row.last == false){
            //                     _html = ``;
            //                 }

            //                 return `${_html}`;
            //             }
            //         },
            //         {
            //             class: "notexport",
            //             data: null,
            //             width: "300px",
            //             name: "",
            //             orderable: false,
            //             searchable: true,
            //             render: function(data, type, row, meta){
            //                 let _remark = ``;
            //                 if(row.maintain != null){
            //                     if(row.maintain.info != null){
            //                     _remark = row.maintain.info;
            //                     }
            //                 }
            //                 let _html = `
            //                 <div class="form-check">
            //                     <textarea class="form-control" name="remark_S['${row.id}']" rows="3" maxlength="500" placeholder="Remark" id="exampleTextareaName-${row.id}">${_remark}</textarea>
            //                 </div>
            //                 `;
            //                 if(row.last == false){
            //                     _html = ``;
            //                 }

            //                 return `${_html}`;
            //             }
            //         },
            //     ],
            //     "drawCallback": async function( settings ) {
            //         // is_session_ref_action();
            //     },
            //     dom: "<'row mx-2'<'col-12'tr>>",
            //     // dom: "<'row mx-2 mb-2'<'col-12'>><'row mx-2 mb-2 g-2'<'col-md-3'l><'col-md-3'><'col-md-6'f>><'row mx-2'<'col-12'tr>><'row mt-2 g-0 align-items-center justify-content-center justify-content-sm-between'<'col-auto mb-2 mb-sm-0 px-3'i><'col-auto px-3'>>",
            //     buttons: _button_export(_title),
            //     createdRow: function(row, data, dataIndex){

            //         if(data.last == false){
            //             $(`td:eq(1)`, row).attr('colspan', 5);

            //             $('td:eq(2)', row).css('display', 'none');
            //             $('td:eq(3)', row).css('display', 'none');
            //             $('td:eq(4)', row).css('display', 'none');
            //             $('td:eq(5)', row).css('display', 'none');

            //             // this.api().cell($('td:eq(1)', row)).data(`${data.name}`);
            //         }

            //         if(data.group == 0){
            //             $(`td:eq(1)`, row).addClass('bg-info text-light');
            //         }else if(data.group == 1){
            //             $(`td:eq(1)`, row).addClass('bg-secondary text-light');
            //         }
            //         // console.log(row, data, dataIndex, 'nadir');

            //     }
            // })
            // .on('draw.dt', function(){
            //     var wrpper = $(`${table_name}`).closest('.dataTables_wrapper');
            //     wrpper.find('.pagination').addClass('pagination-sm');
            // })
            // .on('error.dt', function (e, settings, techNote, message) {
            //     console.log('Error: DataTables: ' + message);
            //     return true;
            // });

            // // await table_master.ajax.reload();
        });

        modal_db.on("shown.bs.modal", async function (event) {
            console.clear();
            event.preventDefault();

            clear_modal_change();

            // $(`.falcon-data-table`).hide();
            // $(`#action_images_list_square`).parent().parent().hide();
            // $(`#action_files_one_square`).parent().parent().hide();

            // // start image list
            // if(_customDropZoneImageList != null){
            //     _customDropZoneImageList.files.forEach(function(item){
            //         _customDropZoneImageList.softRemoveFile(item);
            //     });
            // }
            // // end image list

            // // start file list
            // if(_customDropZoneFileList != null){
            //     _customDropZoneFileList.files.forEach(function(item){
            //         _customDropZoneFileList.softRemoveFile(item);
            //     });
            // }
            // // end file list

            modalInit({
                'modal_db':modal_db,
            });

            relatedTargetAction = event.relatedTarget;
            let ref_action = $(event.relatedTarget).data('ref-action');
            // let ref_id = $(event.relatedTarget).data('ref-id');
            // let ref_name = $(event.relatedTarget).data('ref-name');

            let ref_date = $(`[name="bulan"].select2bs5`).val()+'-'+$(`[name="tahun"].select2bs5`).val();
            // let ref_date = await $(`#exampleInputDateSearch`).val();
            let ref_id = $(`button.data-table-view.btn-primary`).data('ref-id');
            let ref_name = $(`button.data-table-view.btn-primary`).data('ref-name');

            modal_db.find('.modal-body input[name="action"]').val(ref_action);

            modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-success');
            modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-danger');
            modal_db.find('.modal-footer button[type="submit"]').removeClass('bg-primary');

            relatedTargetAsset = ref_id;

            modal_db.find('.modal-body input[name="asset"]').val(ref_id);


            // console.log(relatedTargetAsset);


            let _urlChecker = `${urlActionNow}/checker/${ref_id}`;
            let _getChecker = await getDatas(_urlChecker);
            if(_getChecker.error){
                modal_db.modal('hide');
                return;
            }
            $(`form [name="pemeriksa"].select2bs5`).select2({
                theme: 'bootstrap-5',
                allowClear: true,
                dropdownParent: $("#modal_master"),
                placeholder:"Pemeriksa",
            });
            $(`form [name="pemeriksa"].select2bs5`).empty().trigger('change');
            $.each(_getChecker.i.data.result, function(index, item){
                // console.log(`${index}:${item.name}`);
                var newOption = new Option(`${item.name}`, `${item.id}`, false, false);
                if(index == 0){
                    $(`form [name="pemeriksa"].select2bs5`).append(newOption).trigger('change');
                }else{
                    $(`form [name="pemeriksa"].select2bs5`).append(newOption);
                }
            });

            let _urlPeriod = `${urlActionNow}/period/${ref_id}`;
            let _getPeriod = await getDatas(_urlPeriod);
            if(_getPeriod.error){
                modal_db.modal('hide');
                return;
            }
            $(`form [name="periode"].select2bs5`).select2({
                theme: 'bootstrap-5',
                allowClear: true,
                dropdownParent: $("#modal_master"),
                placeholder:"Periode Waktu",
            });


            $(`form [name="periode"].select2bs5`).empty().trigger('change');
            $.each(_getPeriod.i.data.result, function(index, item){
                // console.log(`${index}:${item.name}`);
                var newOption = new Option(`${item.name}`, `${item.id}`, false, false);
                if(index == 0){
                    $(`form [name="periode"].select2bs5`).append(newOption).trigger('change');
                }else{
                    $(`form [name="periode"].select2bs5`).append(newOption);
                }
                // $(`form [name="periode"].select2bs5`).append(newOption);
            });

            $(`form [name="periode"].select2bs5`).on('select2:select', function (e) {
            clear_modal_change();
            });

            $(`form [name="pemeriksa"].select2bs5`).on('select2:select', function (e) {
            clear_modal_change();
            });

            let _kos_date = ref_date.split("-");

            // console.log(ref_date, _kos_date);
            let _moment_date = moment();
            _moment_date.set('year', parseInt(_kos_date[1]));
            _moment_date.set('month', parseInt(_kos_date[0]) - 1);
            _moment_date.set('date', 1);

            let _moment_date_s = moment();
            _moment_date_s.set('year', parseInt(_kos_date[1]));
            _moment_date_s.set('month', parseInt(_kos_date[0]) - 1);

            let _maxDate = _moment_date_s.endOf('month').format('DD');
            let _minDate = _moment_date_s.startOf('month').format('DD');

            if(moment().month() == _moment_date.month()){
               _moment_date.set('date', moment().date());
            }
            date_upload.set('minDate', `${_kos_date[1]}-${_kos_date[0]}-${_minDate}`);
            date_upload.set('maxDate', `${_kos_date[1]}-${_kos_date[0]}-${_maxDate}`);
            await date_upload.setDate(`${_moment_date.format("YYYY-MM-DD")}`);
            date_upload.close();


            await date_laporan.setDate(`${_moment_date.format("YYYY-MM-DD")}`);
            date_laporan.close();
            // console.log(date_upload.get('date'));



            if (ref_action === 'save') {
                modal_db.find('div.modal-header .modal-title').html(`Aset ${ref_name}`);
                modal_db.find('.modal-footer button[type="submit"]').html('Save');
                modal_db.find('.modal-footer button[type="submit"]').addClass('bg-primary');
            }
        });

        modal_db.on("hidden.bs.modal", function (event) {
            console.clear();
            event.preventDefault();

            relatedTargetAsset = 0;

            // table_master.destroy();

            // start image list
            if(_customDropZoneImageList != null){
                _customDropZoneImageList.files.forEach(function(item){
                    item.previewElement.setAttribute('data-hidden', "true");
                    _customDropZoneImageList.removeFile(item);
                });
            }
            // end image list

            // start file list
            if(_customDropZoneFileList != null){
                _customDropZoneFileList.files.forEach(function(item){
                    item.previewElement.setAttribute('data-hidden', "true");
                    _customDropZoneFileList.removeFile(item);
                });
            }
            // end file list
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

                        // formData.forEach((value, key) => {
                        // console.log(`${key}: ${value}`);
                        // });

                        // return;

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
                        if(_customDropZoneImageList != null){
                            await _customDropZoneImageList.files.forEach(function(item){
                                item.previewElement.setAttribute('data-active', 'true');
                            });
                        }

                        if(_customDropZoneFileList != null){
                            await _customDropZoneFileList.files.forEach(function(item){
                                item.previewElement.setAttribute('data-active', 'true');
                            });
                        }

                        start_modal_image = 2;
                        modal_db.modal('hide');
                        // table_master.ajax.reload();
                        successPost(_post, modal_db, false);
                        $(`button.data-table-view.btn-primary`).click();


                    }
                });
            },
            rules: {
                // title: {
                //     required: true,
                //     maxlength: 255
                // },
                // seo: {
                //     required: true,
                //     minlength: 10,
                //     maxlength: 255,
                // },
                // sinopsis: {
                //     required: true,
                //     minlength: 10,
                // },
                // tags: {
                //     required: true,
                // },
            },
            messages: {
                // title: {
                //     required: "Please enter a title",
                //     maxlength: "Your title up to 255 characters long"
                // },
                // seo: {
                //     required: "Please enter a seo",
                //     minlength: "Your seo min 10 characters long",
                //     maxlength: "Your seo up to 255 characters long"
                // },
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

        // modal_db_check.on("shown.bs.modal", function (event) {
        //     console.clear();
        // });
        let relatedTargetActionIncident;

        modal_db_incident.on("shown.bs.modal", async function (event) {
            console.clear();
            event.preventDefault();

            // start image list
            if(_customDropZoneImageListIncident != null){
                _customDropZoneImageListIncident.files.forEach(function(item){
                    _customDropZoneImageListIncident.softRemoveFile(item);
                });
            }
            // end image list

            modalInit({
                'modal_db':modal_db_incident,
            });

            relatedTargetActionIncident = event.relatedTarget;
            let ref_action = $(event.relatedTarget).data('ref-action');
            let ref_id = $(`button.data-table-view.btn-primary`).data('ref-id');
            let ref_name = $(`button.data-table-view.btn-primary`).data('ref-name');
            modal_db_incident.find('.modal-body input[name="action"]').val(ref_action);

            modal_db_incident.find('.modal-footer button[type="submit"]').removeClass('bg-success');
            modal_db_incident.find('.modal-footer button[type="submit"]').removeClass('bg-danger');
            modal_db_incident.find('.modal-footer button[type="submit"]').removeClass('bg-primary');

            relatedTargetAsset = ref_id;

            modal_db_incident.find('.modal-body input[name="asset"]').val(ref_id);

            let _urlChecker = `${urlActionNow}/checker/${ref_id}`;
            let _getChecker = await getDatas(_urlChecker);
            if(_getChecker.error){
                modal_db_incident.modal('hide');
                return;
            }
            $(`form [name="pemeriksa_incident"].select2bs5`).select2({
                theme: 'bootstrap-5',
                allowClear: true,
                dropdownParent: $("#modal_master_incident"),
                placeholder:"Pemeriksa",
            });
            $(`form [name="pemeriksa_incident"].select2bs5`).empty().trigger('change');
            $.each(_getChecker.i.data.result, function(index, item){
                // console.log(`${index}:${item.name}`);
                var newOption = new Option(`${item.name}`, `${item.id}`, false, false);
                if(index == 0){
                    $(`form [name="pemeriksa_incident"].select2bs5`).append(newOption).trigger('change');
                }else{
                    $(`form [name="pemeriksa_incident"].select2bs5`).append(newOption);
                }
            });

            let _moment_date = moment();
            await date_incident.setDate(`${_moment_date.format("YYYY-MM-DD")}`);


            if (ref_action === 'save') {
                modal_db_incident.find('div.modal-header .modal-title').html(`Aset ${ref_name} (Incident Report)`);
                modal_db_incident.find('.modal-footer button[type="submit"]').html('Save');
                modal_db_incident.find('.modal-footer button[type="submit"]').addClass('bg-primary');
            }

        });

        modal_db_incident.on("hidden.bs.modal", function (event) {
            console.clear();
            event.preventDefault();

            relatedTargetAsset = 0;

            // start image list
            if(_customDropZoneImageListIncident != null){
                _customDropZoneImageListIncident.files.forEach(function(item){
                    item.previewElement.setAttribute('data-hidden', "true");
                    _customDropZoneImageListIncident.removeFile(item);
                });
            }
            // end image list
        });

        $('#form_app_incident').validate({
            // onkeyup: false,
            submitHandler: function (form, event) {
                event.preventDefault();
                let formData = new FormData(form);

                let urlAction = `${urlActionNow}/incident/action`;

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
                        let button_action = modal_db_incident.find('.modal-footer button[type="submit"]');

                        button_action.prop('disabled', true);

                        let innerBefore = button_action.html();
                        button_action.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`);

                        let _post = await postData(urlAction, formData);
                        button_action.html(innerBefore);
                        button_action.prop('disabled', false);
                        if(_post.error){
                            errorPost(_post, modal_db_incident);
                            return;
                        }
                        if(_customDropZoneImageListIncident != null){
                            await _customDropZoneImageListIncident.files.forEach(function(item){
                                item.previewElement.setAttribute('data-active', 'true');
                            });
                        }

                        // start_modal_image = 2;
                        modal_db_incident.modal('hide');
                        successPost(_post, modal_db_incident, false);
                    }
                });
            },
            rules: {
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


        $(`.data-table-view-export`).hide();

        $(`button.data-table-search`).on('click', async function(){
            $(`#table-data-check`).html('');

            $(`.data-table-view-export`).hide();

            $(`button.data-table-view.btn-primary`).click();

            // $(`button.data-table-view`).removeClass('btn-outline-primary');
            // $(`button.data-table-view`).removeClass('btn-primary');
            // $(`button.data-table-view`).each(function(index) {
            //     if(index == 0){
            //         $(this).click();
            //     }else{
            //         $(this).addClass('btn-outline-primary');
            //     }
            // });
        })


        // date_search.config.onClose.push(function(){
        //     $(`#table-data-check`).html('');

        //     $(`.data-table-view-export`).hide();

        //     $(`button.data-table-view`).removeClass('btn-outline-primary');
        //     $(`button.data-table-view`).removeClass('btn-primary');
        //     $(`button.data-table-view`).each(function(index) {
        //         if(index == 0){
        //             $(this).click();
        //         }else{
        //             $(this).addClass('btn-outline-primary');
        //         }
        //     });
        // });

        function isNumericString(str) {
        return !Number.isNaN(+str) && typeof str === 'string';
        }

        function sts_equipment(data_equipment = [], asset = ""){
            $(`#table-data-check-equipment`).html(``);

            let _html_head = `
            <tr>
                <th colspan="4">${asset}</th>
            </tr>
            <tr>
                <th style="min-width:60px;">No</th>
                <th style="min-width:380px;">Equipment</th>
                <th style="min-width:100px;">Status</th>
                <th style="min-width:200px;">Last Report Date</th>
            </tr>
            `;

            let _html_body = ``;
            data_equipment.forEach((item, index) => {
                let _html_td = ``;
                // if(index == 0){
                // _html_td += `<td rowspan="${data_equipment.length}" style="font-weight:bold;text-align: center;">${asset}</td>`;
                // }
                _html_td += `<td style="text-align:center;">${index+1}</td>`;
                _html_td += `<td>${item.name}</td>`;
                _html_td += `<td>${item.status}</td>`;
                _html_td += `<td>${item.date_upload}</td>`;
                _html_body += `<tr>${_html_td}</tr>`;
            });


            $(`#table-data-check-equipment`).html(`
            <table id="table_master_check_equipment" class="table_master_check_equipment">
                <thead>
                ${_html_head}
                </thead>
                <tbody>
                ${_html_body}
                </tbody>
            </table>
            `);

        }

        $(`button.data-table-view`).on('click', async function(){
            $(`.data-table-view-export`).hide();
            relatedTargetImgDoc = [];

            let ref_id = $(this).data('ref-id');
            let ref_name = $(this).data('ref-name');
            $(`button.data-table-view`).removeClass('btn-outline-primary');
            $(`button.data-table-view`).removeClass('btn-primary');
            $(`button.data-table-view`).each(function(index) {
                if(ref_id == $(this).data('ref-id')){
                    $(this).addClass('btn-primary');
                    $(`.data-table-view-export`).show();
                }else{
                    $(this).addClass('btn-outline-primary');
                }


            });

            let _name_button = $(this).html();

            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${_name_button}`);

            $(`button.data-table-search`).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Search`);
            $(`button.data-table-search`).attr('disabled','disabled');

            let ref_date = $(`[name="bulan"].select2bs5`).val()+'-'+$(`[name="tahun"].select2bs5`).val();

            // let ref_date = $(`#exampleInputDateSearch`).val();

            $(`#table-data-check`).html(``);
            $('div.x-btn-periode').html(``);

            $(`button.data-table-view`).each(function(index) {
                $(this).attr('disabled','disabled');
            });

            let _urlExportData = `${urlActionNow}/export/datatable?id=${ref_id}&date=${ref_date}`;
            let _getExportData = await getDatas(_urlExportData);

            $(this).html(`${_name_button}`);

            $(`button.data-table-search`).html(`Search`);
            $(`button.data-table-search`).removeAttr('disabled');

            $(`button.data-table-view`).each(function(index) {
                $(this).removeAttr('disabled');
            });

            if(_getExportData.error){
                // modal_db.modal('hide');
                return;
            }

            _getExportData = _getExportData.i.data;

            let _getLastUpdate = _getExportData.last_update_no_child;

            // console.log(_getExportData);

            $(`#table-data-check`).html('');


            let _html_th = '';
            for(let a = 1; a <= _getExportData.end_date; a++){
                _html_th += `<th class="tgl_${a}"><b>${a}</b></th>`
            }
            let _html_head = `
            <tr>
                <th class="stick_left" rowspan="2" >No</th>
                <th class="stick_left" rowspan="2" >Asset</th>
                <th rowspan="2" style="max-width:120px;">Last Update</th>
                <th rowspan="2" >Periode</th>
                <th colspan="${_getExportData.end_date}" class="text-center">${ref_date}</th>
            </tr>
            <tr>
            ${_html_th}
            </tr>
            `;

            let _html_body = ``;
            let _data_periods = ["Semua Periode"];

            let _tgl_index_null = [];
            let _tgl_index_not_null = [];

            _getExportData.data.forEach((item, index) => {
                let _html_td = ``;
                let _bold = `font-weight:500 !important;`;
                let _margin = `margin-left:${item.group * 2}rem !important;`;
                let _add_border = ``;
                let _class = `stick_left`;
                let _colspan = ``;
                let _data = item.name;

                let _tr_class_header = ``;
                let _td_span = ``;

                if(!isNumericString(item.period)){
                    if(_data_periods.indexOf(item.period) < 0){
                        _data_periods.push(item.period);
                    }
                }

                if(item.group == 0 && item.last == false){
                    _add_border = `border: 1px solid black;`;
                    _bold = `font-weight:900 !important;`;
                    _data = `# ${_data}`;
                    _class = `bg-info text-light stick_left`;
                    _tr_class_header = `header stop-2`;
                    _td_span = `<span class="me-2">-</span>`;
                }else if(item.group == 1 && item.last == false){
                    _add_border = `border: 1px solid black;`;
                    _bold = `font-weight:700 !important;`;
                    _data = `* ${_data}`;
                    _class = `bg-secondary text-light stick_left`;
                    _tr_class_header = `headers-2 stop-2`;
                    _td_span = `<span class="me-2">-</span>`;
                }

                if(item.last == false){
                    _colspan = `colspan="${_getExportData.end_date+1+1+1}"`;
                }
                _html_td += `<td style="${_add_border}" class="${_class}">${item.urutan}</td>`;
                _html_td += `<td ${_colspan} style="${_add_border}" class="${_class}"><div style="${_margin}${_bold}min-width:280px;">${_td_span}${_data}</div></td>`;
                if(item.detail.length > 0){

                    let x_last_update = _getLastUpdate.find(cek => cek.id === item.id);
                    if(x_last_update.check.length > 0){
                        let _html_last_update = ``;
                        x_last_update.check.forEach((checks, index_c) => {
                            let _popovers = ``;

                            if(checks.info == null){
                                checks.info = '';
                            }
                            _popovers = `
                            tabindex="0"
                            data-bs-toggle="popover"
                            data-bs-placement="right"
                            data-bs-trigger="hover focus"
                            data-bs-custom-class="custom-popover"
                            data-bs-container="body"
                            data-bs-title="Remark"
                            data-bs-html="true"
                            data-bs-content="Catatan : ${checks.info}"
                            `;

                            let _status = `<span class="far fa-check-circle text-info fs-3"></span>`;
                            if(checks.status == 'Tidak Ada'){
                                _status = `<span class="far fa-times-circle text-danger fs-3"></span>`;
                            }else if(checks.status == 'Rusak'){
                                _status = `<span class="far fab fa-tripadvisor text-warning fs-3"></span>`;
                            }

                            let _bor = `border-400`;
                            _html_last_update += `
                            <div class="p-1 bg-300 border border-1 ${_bor} rounded" ${_popovers}>
                                <div class="d-flex flex-row" style="min-width: max-content;">
                                    ${_status} &nbsp
                                    ${checks.date_upload}
                                </div>
                            </div>
                            `;

                        });
                        _html_td += `
                        <td >
                            ${_html_last_update}
                        </td>`;
                        // _html_td += `<td class="">${x_last_update.check.status} <br> ${x_last_update.check.date_upload}</td>`;
                    }else{
                        _html_td += `<td style="background-color: red;"></td>`;
                    }

                    _html_td += `<td class="x-data-periode">${item.period}</td>`;

                    item.detail.forEach((item_d, index_d) => {

                        if(item_d.check.length > 0){
                            let _c_html = ``;
                            item_d.check.forEach((item_c, index_c) => {
                                let _popovers = ``;
                                // let _indicator = ``;
                                // if(item_c.info != null){
                                //     _indicator = `notification-indicator notification-indicator-dark`;

                                // }

                                if(item_c.info == null){
                                    item_c.info = '';
                                }
                                _popovers = `
                                tabindex="0"
                                data-bs-toggle="popover"
                                data-bs-placement="right"
                                data-bs-trigger="hover focus"
                                data-bs-custom-class="custom-popover"
                                data-bs-container="body"
                                data-bs-title="Remark"
                                data-bs-html="true"
                                data-bs-content="Pemeriksa : ${item_c.checker} <br> Catatan : ${item_c.info}"
                                `;

                                let _status = `<span class="far fa-check-circle text-info fs-3"></span>`;
                                if(item_c.status == 'Tidak Ada'){
                                    _status = `<span class="far fa-times-circle text-danger fs-3"></span>`;
                                }else if(item_c.status == 'Rusak'){
                                    _status = `<span class="far fab fa-tripadvisor text-warning fs-3"></span>`;
                                }


                                // if(item_c.info != null){
                                //     _status = `<div class="d-inline-block notification-indicator notification-indicator-dark fa-icon-wait">${_status}</div>`;
                                // }
                                // _status = `
                                // <button class="btn btn-falcon-default btn-sm" type="button" ${_popovers}>${_status}</button>
                                // `;

                                let _bor = `border-400`;
                                // if(item_c.info != null){
                                //     _bor = `border-warning`;
                                // }

                                // _c_html +=
                                if(item_c.timetable == "CHECK"){
                                    _c_html += `<div class="p-1 bg-300 border border-1 ${_bor} rounded" ${_popovers}>${item_c.checker} ${_status}</div>`;
                                }else{
                                    _c_html += '';
                                }


                            });

                            _html_td += `
                            <td>
                                <div class="d-flex flex-column">
                                ${_c_html}
                                </div>
                            </td>`;
                            if(!_tgl_index_not_null.includes(`tgl_${index_d+1}`)){
                                _tgl_index_not_null.push(`tgl_${index_d+1}`)
                            }
                        }else{
                            if(!_tgl_index_null.includes(`tgl_${index_d+1}`)){
                                _tgl_index_null.push(`tgl_${index_d+1}`)
                            }
                            _html_td += `<td></td>`;
                        }
                    });
                }
                _html_body += `<tr class="${_tr_class_header}">${_html_td}</tr>`;
            });

            let _html_foot = ``;
            _getExportData.img_doc.forEach((item, index) => {
                _html_foot +=
                `<th class="tgl_${index+1}">
                    <div class="text-center">
                        <button class="btn btn-outline-secondary btn-sm p-2" type="button" data-bs-toggle="modal" data-bs-target="#modal_master_img_doc" data-ref-index="${index}" data-ref-name="${_getExportData.asset} : ${item.date}"><b>${index+1} </b> <span class="far fa-eye" data-fa-transform="shrink-2"></span></button>
                    </div>
                </th>`;

                // if(item.files.length > 0 || item.images.length > 0){
                //     _html_foot += `<th><button class="btn btn-outline-secondary btn-sm p-2" type="button" data-bs-toggle="modal" data-bs-target="#modal_master_img_doc" data-ref-index="${index}" data-ref-name="${_getExportData.asset} : ${item.date}"><span class="far fa-eye me-1" data-fa-transform="shrink-2"></span></button></th>`;
                // }else{
                //     _html_foot += `<th></th>`;
                // }
            });

            $(`#table-data-check`).html(`
            <table id="table_master_check" class="table_master_check table">
                <thead class="bg-200 text-900">
                ${_html_head}
                </thead>
                <tbody>
                ${_html_body}
                </tbody>
                <tfoot>
                    <tr>
                    <th colspan="4">Image / File / Keterangan</th>
                    ${_html_foot}
                    </tr>
                </tfoot>
            </table>
            `);
            relatedTargetImgDoc = _getExportData.img_doc;

            _tgl_index_not_null.forEach((item, index) => {
                _tgl_index_null = _tgl_index_null.filter(tgl => tgl !== item);
            });

            _tgl_index_null.forEach((item, index) => {
                $(`th.${item}`).css("background-color", "red");
                $(`th.${item}`).css("color", "white");
            });

            // console.log(_tgl_index_not_null);
            // console.log(_tgl_index_null);


            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popoverTriggerList.map(function (popoverTriggerEl) {
                return new window.bootstrap.Popover(popoverTriggerEl);
            });

            $('div.x-btn-periode').html(``);
            // console.log(_data_periods);
            let _html_btn_periode = '';
            _data_periods.forEach((item, index) => {
                let _i_outline = "-outline";
                // if(index == 0){
                //     _i_outline = "";
                // }
                _html_btn_periode += `<button class="btn btn${_i_outline}-dark x-btn-periode-act rounded-0" type="button" data-ref-id="${item}">${item}</button>`;
            });

            _html_btn_periode += `<button class="btn btn-outline-success x-btn-periode-act-equipment rounded-0 ms-2" type="button" >Status Equipment</button>`;


            await $('div.x-btn-periode').html(_html_btn_periode);
            await sts_equipment(_getExportData.last_update_equipment, _getExportData.asset);


            $(`button.x-btn-periode-act`).each(function(index) {
                if(index == 0){
                    $(this).click();
                }
            });

        });




        $(`button.data-table-view`).each(function(index) {
            if(index == 0){
                $(this).click();
            }
        });

        $(`button.data-table-view-export`).on('click', async function(){

            let ref_date = $(`[name="bulan"].select2bs5`).val()+'-'+$(`[name="tahun"].select2bs5`).val();

            // let ref_date = $(`#exampleInputDateSearch`).val();
            let ref_id = $(`button.data-table-view.btn-primary`).data('ref-id');

            window.open(`${urlActionNow}/export/datatable?id=${ref_id}&date=${ref_date}&export=excel`, "_blank");
        });

        let modal_db_img_doc = $(`#modal_master_img_doc`);

        modal_db_img_doc.on("shown.bs.modal", async function (event) {
            console.clear();
            event.preventDefault();

            let ref_index = $(event.relatedTarget).data('ref-index');
            let ref_name = $(event.relatedTarget).data('ref-name');

            modal_db_img_doc.find('div.modal-header .modal-title').html(`${ref_name} (Image / File / Keterangan)`);


            let _imgs = relatedTargetImgDoc[ref_index];
            let _html_imgs = ``;
            _imgs.images.forEach((data, index) => {
                _html_imgs += `
                <a href="${data.url}" data-title="Pemeriksa : ${data.checker}" data-description="(${data.filename_original})" data-type="image" data-gallery="gallery-1">
                    <img src="${data.url}" class="square-table-img-75p lazy" alt="${data.filename_original}"/>
                </a>
                `;
            });

            if(_html_imgs.length > 0){
                _html_imgs = `
                <div class="col-12">
                    <div class="form-group">
                        <label>Image List</label>
                        <div class="d-flex flex-wrap align-content-stretch mb-2 gap-3">
                        ${_html_imgs}
                        </div>
                    </div>
                </div>
                `;
            }




            let _files = relatedTargetImgDoc[ref_index];
            let _html_files = ``;
            _files.files.forEach((data, index) => {
                _html_files += `
                <div class="btn-link">
                    <button type="button" class="btn btn-info btn-sm me-1 mb-1 copy-link" data-link="${data.url}">
                        Link
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm mb-1" onclick="window.open('${data.url}','_blank')">
                    (${data.checker}) ${data.filename_original}
                    </button>
                    <input type="hidden" value="${data.url}" class="form-input"/>
                </div>
                `;
            });

            if(_html_files.length > 0){
                _html_files = `
                <div class="col-12">
                    <div class="form-group">
                        <label>Document List</label>
                        <div class="d-flex flex-column align-content-stretch mb-2 gap-3">
                        ${_html_files}
                        </div>
                    </div>
                </div>
                `;
            }

            let _html_infos = ``;
            relatedTargetImgDoc[ref_index].information.forEach((data, index) => {
                _html_infos += `
                <div class="col-12">
                    <div class="form-group">
                        <label for="exampleTextareaInformationImgDoc">Keterangan ${data.checker}</label>
                        <textarea class="form-control" rows="5" maxlength="500" placeholder="No information" id="exampleTextareaInformationImgDoc" readonly>${decodeHTML(data.information)}</textarea>
                    </div>
                </div>
                `;
            });


            modal_db_img_doc.find('.modal-body').html(`
            <div class="row">
                ${_html_imgs}
                ${_html_files}
                ${_html_infos}
            </div>
            `);

            if (window.GLightbox) {
                window.GLightbox({
                selector: '[data-gallery]'
                });
            }

        });

        modal_db_img_doc.on("hidden.bs.modal", function (event) {
            modal_db_img_doc.find('.modal-body').html('');
        });


    });

    $(document).on('click', 'tr.header', function(e){
        $(this).find('span').text(function(_, value) {
        return value == '-' ? '+' : '-'
        });

        $(this).nextUntil('tr.header').slideToggle(100, function() {});
    });

    $(document).on('click', 'input.flexCheckDefault_S', function(e){
        let x_label = $(this).closest('div.form-check').find('label');
        if(this.checked){
            x_label.html('Check');
        }else{
            x_label.html('UnCheck');

        }
    });

    $(document).on('click', 'button.x-btn-periode-act', function(){
        let ref_id = $(this).data('ref-id');
        $(`button.x-btn-periode-act-equipment`).removeClass('btn-outline-success');
        $(`button.x-btn-periode-act-equipment`).removeClass('btn-success');
        $(`button.x-btn-periode-act-equipment`).addClass('btn-outline-success');

        $(`#table-data-check`).show();
        $(`#table-data-check-equipment`).hide();



        $(`button.x-btn-periode-act`).removeClass('btn-outline-dark');
        $(`button.x-btn-periode-act`).removeClass('btn-dark');
        $(`button.x-btn-periode-act`).each(function(index) {
            if(ref_id == $(this).data('ref-id')){
                $(this).addClass('btn-dark');
            }else{
                $(this).addClass('btn-outline-dark');
            }
        });
        $('table.table_master_check').find('td.x-data-periode').closest('tr').show();
        if(ref_id != "Semua Periode"){
            $('table.table_master_check').find('td.x-data-periode').each(function(index, item){
                if($(item).html() != ref_id){
                    $(item).closest('tr').hide();
                }

            });
        }
    });

    $(document).on('click', 'button.x-btn-periode-act-equipment', function(){
        $(`button.x-btn-periode-act-equipment`).removeClass('btn-outline-success');
        $(`button.x-btn-periode-act-equipment`).removeClass('btn-success');
        $(`button.x-btn-periode-act-equipment`).addClass('btn-success');

        $(`#table-data-check`).hide();
        $(`#table-data-check-equipment`).show();

        $(`button.x-btn-periode-act`).removeClass('btn-outline-dark');
        $(`button.x-btn-periode-act`).removeClass('btn-dark');
        $(`button.x-btn-periode-act`).addClass('btn-outline-dark');

    });

    // $(document).on('click', 'tr.headers-2', function(e){
    //     $(this).find('span').text(function(_, value) {
    //     return value == '-' ? '+' : '-'
    //     });

    //     $(this).nextUntil('tr.stop-2').slideToggle(100, function() {});
    // });

    $(document).on('click', 'button.copy-link', function(e){
        let x_input = $(this).closest('div.btn-link').find('input');
        x_input.attr("type", "text");
        console.log(x_input.val());
        x_input.select();
        document.execCommand("copy");
        x_input.attr("type", "hidden");
    });

    // $(document).on('select2:select', 'form [name="periode"].select2bs5', function(e){
    //     clear_modal_change();

    // });

    // $(document).on('select2:select', 'form [name="pemeriksa"].select2bs5', function(e){
    //     clear_modal_change();

    // });

    }
</script>
@endpush

