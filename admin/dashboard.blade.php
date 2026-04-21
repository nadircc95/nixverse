@extends('admin.layouts.base')

@section('title', "")

@include('admin.layouts.script_logic')

@section('content')
<div class="row g-3 mb-3">


    @if ($grafik != null)
        @if ($grafik->type === "this_year")
        <div class="col-12 mb-0">
            <div class="card">
            <div class="card-header bg-light py-2">
                <div class="row flex-between-center g-0">
                <div class="col-auto">
                    <h5 class="mb-0">Filter Data</h5>
                </div>
                <div class="col-auto d-flex">
                    <div class="ms-2" style="min-width: 100px;max-width: 100px;">
                        <select class="form-select select2bs5" style="width: 100%;" id="filter_all_tahun">
                        @foreach ($grafik->years as $item)
                        <option value="{{$item}}" data-url="{{route('year',['year'=>$item])}}">{{$item}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        @endif
    <div class="col-12 col-lg-6 mb-0">
        <div class="card h-100">
          <div class="card-header bg-light py-2">
            <div class="row flex-between-center g-0">
              <div class="col-auto">
                <h5 class="mb-0">Vessel & GT</h5>
              </div>
              <div class="col-auto">
                <h5 class="mb-0 g_vessel_gt_date"></h5>
              </div>
            </div>
          </div>
          <div class="card-body py-3">
            <div class="echart-bar-line-chart-vessel-gt" style="min-height: 400px;" data-echart-responsive="true"></div>
            <p class="text-center py-3 g_vessel_gt_info"></p>
          </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-0">
        <div class="card h-100">
          <div class="card-header bg-light py-2">
            <div class="row flex-between-center g-0">
              <div class="col-auto">
                <h5 class="mb-0">STS & WO Activities</h5>
              </div>
              <div class="col-auto">
                <h5 class="mb-0 g_sts_wo_activity_date"></h5>
              </div>
            </div>
          </div>
          <div class="card-body py-3">
            <div class="echart-bar-line-chart-sts-wo" style="min-height: 400px;" data-echart-responsive="true"></div>
            <p class="text-center py-3 g_sts_wo_activity_info"></p>
          </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-0">
        <div class="card h-100">
          <div class="card-header bg-light py-2">
            <div class="row flex-between-center g-0">
              <div class="col-auto">
                <h5 class="mb-0">Total Vessel Based on GT Class</h5>
              </div>
              <div class="col-auto">
                <h5 class="mb-0 g_vessel_based_on_gt_date"></h5>
              </div>
            </div>
          </div>
          <div class="card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="echart-horizontal-bar-chart-vessel-on-gt my-2" style="min-height: 300px;" data-echart-responsive="true"></div>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-0">
        <div class="card h-100">
          <div class="card-header bg-light py-2">
            <div class="row flex-between-center g-0">
              <div class="col-auto">
                <h5 class="mb-0">Total Oil & Gas Vessel</h5>
              </div>
              <div class="col-auto">
                <h5 class="mb-0 g_oil_gas_wo_date"></h5>
              </div>
            </div>
          </div>
          <div class="card-body py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                  <div class="position-relative">
                    <!-- Find the JS file for the following chart at: src/js/charts/echarts/most-leads.js-->
                    <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
                    <div class="echart-pie-chart-oil-gas my-2" style="min-height: 300px;" data-echart-responsive="true"></div>
                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                      <p class="mb-0 text-400 font-sans-serif fw-medium g_oil_gas_wo_info"></p>
                      <!-- <p class="fs-3 mb-0 font-sans-serif fw-medium mt-n2">15.6k</p> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="d-flex flex-between-center border-bottom py-3 pt-md-0 pt-xxl-3">
                    <div class="d-flex">
                      <h6 class="text-700 mb-0">Oil Vessels</h6>
                    </div>
                    <h6 class="text-700 mb-0 g_oil_gas_wo_oil">0</h6>
                  </div>
                  <div class="d-flex flex-between-center border-bottom py-3">
                    <div class="d-flex">
                      <h6 class="text-700 mb-0">Gas Vessels</h6>
                    </div>
                    <h6 class="text-700 mb-0 g_oil_gas_wo_gas">0</h6>
                  </div>
                  <div class="d-flex flex-between-center border-bottom py-3">
                    <div class="d-flex">
                      <h6 class="text-700 mb-0">WO Vessels</h6>
                    </div>
                    <h6 class="text-700 mb-0 g_oil_gas_wo_wo">0</h6>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('script_add')
<script src="{{url('sandbox')}}/assets/lodash/lodash.min.js"></script>
<script src="{{url('sandbox')}}/assets/echarts/echarts.min.js"></script>
<script src="{{url('sandbox')}}/assets/dayjs/dayjs.min.js"></script>
@include('support.detail-grafik')
<script>
    if (window.jQuery) {
        var $ = window.jQuery;
        $(async function(){

        $(`#filter_all_tahun.select2bs5`).select2({
            theme: 'bootstrap-5',
            placeholder:"Year",
        });

        $(`#filter_all_tahun.select2bs5`).val(data_grafik.year).trigger('change.select2');

        $(`#filter_all_tahun.select2bs5`).on('select2:select', function (e) {
            var data = e.params.data;
            window.location.href = `${$(data.element).data('url')}`;
        });
        $(`#header_menu`).find(".title_ams").addClass("text-primary").html("Welcome {{Auth::user()->name}}");
        // .hide();
        });
    }
</script>
<script src="{{url('grafik')}}/echarts-example.js"></script>
@endpush

