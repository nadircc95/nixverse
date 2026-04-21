@extends('admin.layouts.base')

@section('title', "")

@include('admin.layouts.script_logic')

@section('modal_form')

@endsection

@section('filter')

<div class="row mb-3">
    <div class="col">
        <div class="card bg-100 shadow-none border">
        <div class="row gx-0 flex-between-center">
            <div class="col-sm-auto d-flex align-items-center"><img class="ms-n2" src="{{url('falcon')}}/assets/img/illustrations/crm-bar-chart.png" alt="" width="90" />
            <div>
                <h6 class="text-primary fs--1 mb-0"><b>{{Auth::user()->name}}</b> Welcome to </h6>
                <h4 class="text-primary fw-bold mb-0">Inventory <span class="text-info fw-medium">CRM</span>
                    
                </h4>
            </div>
            <img class="ms-n4 d-md-none d-lg-block" src="{{url('falcon')}}/assets/img/illustrations/crm-line-chart.png" alt="" width="150" />
            </div>
            <div class="col-md-auto p-3">
            <div class="row align-items-center g-3">
                <div class="col-auto">
                    <h6 class="text-700 mb-0">Showing Data For: </h6>
                </div>
                <div class="col-auto ms-auto me-2 tr-spinner">
                    <div class="spinner-grow" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="col-md-auto position-relative">
                    <input class="form-control form-control ps-4" id="period" type="text" />
                    <span class="fas fa-calendar-alt text-primary position-absolute top-50 translate-middle-y ms-2"> </span>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>



@endsection

@section('content')
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-8">
        <div class="card g-3 h-100">
            <div class="card-header pb-0 d-flex flex-between-center bg-light">
                <h6 class="text-800" id="storage-header-info">
                    Loading storage data...
                </h6>
                <div id="storage-alerts"></div>
            </div>
            <div class="card-body d-flex flex-column gap-3">
                
                <div class="w-100">
                    <p class="mb-1 fs--1 fw-bold text-700">Storage by Product</p>
                    <div id="storage-product-bar" class="progress mb-2 rounded-3" style="height: 6px;">
                        <div class="progress-bar bg-200" role="progressbar" style="width: 100%"></div>
                    </div>
                    
                    <div id="storage-product-legend" class="row fs--1 fw-semi-bold text-500 g-0 mb-0"></div>
                </div>

                <hr class="my-0 border-200 opacity-50" />

                <div class="w-100">
                    <p class="mb-1 fs--1 fw-bold text-700">Storage by Progress</p>
                    <div id="storage-progress-bar" class="progress mb-2 rounded-3" style="height: 6px;">
                        <div class="progress-bar bg-200" role="progressbar" style="width: 100%"></div>
                    </div>
                    
                    <div id="storage-progress-legend" class="row fs--1 fw-semi-bold text-500 g-0 mb-0"></div>
                </div>

                <hr class="my-0 border-200 opacity-50" />

                <div class="w-100">
                    <p class="mb-1 fs--1 fw-bold text-700">Daily Current Stock</p>
                    <div class="echart-bar-transaction-monthly w-100" style="height: 84px;"></div>

                </div>

            </div>
            <span class="badge rounded-circle bg-danger m-0 p-0 d-inline-flex flex-center position-absolute top-0 start-100 translate-middle" 
                    id="total-all-pending" 
                    data-bs-toggle="tooltip" 
                    data-bs-custom-class="custom-tooltip-bg-danger"
                    data-bs-html="true" 
                    title="Count Transaction Pending"
                    style="width: 30px; height: 30px; font-size: 12px; vertical-align: middle;">
                0
            </span>
            
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="d-flex flex-column h-100 gap-3"> 
            
            <div class="card flex-fill">
                <div class="card-body d-flex align-items-center">
                    <div class="row w-100 justify-content-between g-0 align-items-center">
                        <div class="col-6 col-sm-8 col-xxl pe-2">
                            <h6 class="mt-1">Transaction Metrics</h6>
                            <div class="fs--2 mt-3" id="legend-transaction-metrics"></div>
                        </div>
                        <div class="col-auto position-relative" style="min-width: 110px; min-height: 110px;">
                            <div class="echart-transaction-metrics position-absolute top-50 start-50 translate-middle" style="height: 110px; width: 110px;"></div>
                            <div class="position-absolute top-50 start-50 translate-middle text-center" style="pointer-events: none; z-index: 10;">
                                <div id="echart-transaction-metrics-total" class="d-flex flex-column align-items-center justify-content-center lh-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card flex-fill">
                <div class="card-body d-flex align-items-center">
                    <div class="row w-100 justify-content-between g-0 align-items-center">
                        <div class="col-6 col-sm-8 col-xxl pe-2">
                            <h6 class="mt-1">Transaction Status</h6>
                            <div class="fs--2 mt-3" id="legend-transaction-status"></div>
                        </div>
                        <div class="col-auto position-relative" style="min-width: 110px; min-height: 110px;">
                            <div class="echart-transaction-status position-absolute top-50 start-50 translate-middle" style="height: 110px; width: 110px;"></div>
                            <div class="position-absolute top-50 start-50 translate-middle text-center" style="pointer-events: none; z-index: 10;">
                                <div id="echart-transaction-status-total" class="d-flex flex-column align-items-center justify-content-center lh-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-12 col-lg-8">
        
        <div class="card mb-3">
            <div class="card-header bg-light d-flex flex-between-center py-2">
                <div>
                    <h6 class="mb-0">Purchase & Sell Activity</h6>
                    <small class="text-500" id="label-periode-activity">Loading...</small>
                </div>
                <div class="d-flex fs--1">
                    <div class="me-3 pe-3 border-end text-end">
                        <span class="text-500">Total In:</span>
                        <strong class="text-primary d-block fw-bold" id="total-inbound-val">0 kg</strong>
                    </div>
                    <div class="text-end">
                        <span class="text-500">Total Out:</span>
                        <strong class="text-danger d-block fw-bold" id="total-outbound-val">0 kg</strong>
                    </div>
                </div>
            </div>
            <div class="card-body py-2">
                <div class="echart-bar-transaction-inbound-outbound" style="min-height: 180px; width: 100%;"></div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex flex-between-center border-bottom border-200 py-2">
                        <h6 class="mb-0">Transaction Supplier</h6>
                        <span class="badge badge-soft-danger">Close</span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="echart-transaction-supplier" style="min-height: 350px;" data-echart-responsive="true"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex flex-between-center border-bottom border-200 py-2">
                        <h6 class="mb-0">Transaction Supplier Batch</h6>
                        <span class="badge badge-soft-success">Open</span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="echart-transaction-supplier-batch" style="min-height: 350px;" data-echart-responsive="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-light d-flex flex-between-center py-2">
                <h6 class="mb-0">Transaction Progress</h6>
                <span class="badge badge-soft-primary" id="total_transaction_product_all">0 Trans</span>
            </div>
            <div class="card-body p-0 overflow-auto" id="progress-product-container" style="max-height: 850px;">
                </div>
        </div>
    </div>
</div>
@endsection

@push('script_top')
<link rel="stylesheet" href="{{url('falcon')}}/assets/css/dashboard-inventory.css">


<link href="{{url('toast')}}/jquery.toast.min.css" rel="stylesheet">

@endpush

@push('script_add')
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script src="{{url('falcon')}}/assets/js/dashboard-inventory.js"></script>
<script>
    if (window.jQuery) {
        var $ = window.jQuery;

        var $capacityStorage = 0;

        const PUSHER_KEY = "{{ env('PUSHER_APP_KEY') }}";
        const PUSHER_CLUSTER = "{{ env('PUSHER_APP_CLUSTER') }}";

        @if(app()->environment('local'))
            Pusher.logToConsole = true;
        @endif

        var pusher = new Pusher(PUSHER_KEY, {
            cluster: PUSHER_CLUSTER
        });

        var channel = pusher.subscribe('archive-updates');
        let refreshTimeout = null;

        channel.bind('archive.refreshed', function(data) {
            // console.log('Real-time update received for:', data.id);
            
            // 1. Bersihkan timeout sebelumnya jika ada (debounce)
            // Ini mencegah refresh berkali-kali jika ada banyak broadcast dalam waktu singkat
            if (refreshTimeout) {
                clearTimeout(refreshTimeout);
            }

            // 2. Set jeda 5 detik
            refreshTimeout = setTimeout(function() {
                if (typeof callTransactions === "function") {
                    // console.log('Refreshing dashboard data...');
                    callTransactions();
                }
            }, 5000); // 5000 milidetik = 5 detik
        });

        $(async function(){
            $(`#header_menu`).hide();
            let $period = createMonthYearPicker("#period", {
                onClose: function(selectedDates, dateStr, instance) {
                    callTransactions();
                }
            });
            $period.setDate(`${moment().format("MM-YYYY")}`);

            callTransactions();

        });

        async function callTransactions() {
            const spinner = $(`.tr-spinner`);
            spinner.show();
            await apiTransactionStorage();
            await apiTransactionProgress();
            await apiTransactionMetrics();
            await apiTransactionStatus();
            await apiTransactionSupplier();
            await apiTransactionMonthly();
            // await apiTransactionMonthlyMove();
            await apiTransactionInboundOutbound();
            await apiTransactionSupplierBatch();
            spinner.hide();
        }

        async function apiTransactionStatus() {

            let periodVal = $('#period').val();
            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-status') }}", { 
                period: periodVal
            });
            
            if(!resTransaction.error){
                try {
                    setTimeout(() => {
                        const fn = window.transactionStatus || transactionStatus; 
                        if (typeof fn === 'function') {
                            fn(resTransaction.data);
                        } else {
                            console.error('Fungsi transactionStatus TIDAK DITEMUKAN');
                        }
                    }, 10);
                } catch (err) {
                    console.error("Terjadi error ", err);
                }
            }
        }

        async function apiTransactionMonthly() {

            let periodVal = $('#period').val();
            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-monthly') }}", { 
                period: periodVal
            });
            
            if(!resTransaction.error){
                try {
                    setTimeout(() => {
                        const fn = window.transactionMonthly || transactionMonthly; 
                        if (typeof fn === 'function') {
                            fn(resTransaction.data, $capacityStorage);
                        } else {
                            console.error('Fungsi transactionMonthly TIDAK DITEMUKAN');
                        }
                    }, 10);
                } catch (err) {
                    console.error("Terjadi error ", err);
                }
            }
        }

        async function apiTransactionMonthlyMove() {

            let periodVal = $('#period').val();
            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-monthly-move') }}", { 
                period: periodVal
            });
            if(!resTransaction.error){
                try {
                    setTimeout(() => {
                        const fn = window.transactionMonthlyMove || transactionMonthlyMove; 
                        if (typeof fn === 'function') {
                            fn(resTransaction.data);
                        } else {
                            console.error('Fungsi transactionMonthlyMove TIDAK DITEMUKAN');
                        }
                    }, 10);
                } catch (err) {
                    console.error("Terjadi error ", err);
                }
            }
        }

        async function apiTransactionInboundOutbound() {

            let periodVal = $('#period').val();
            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-inbound-outbound') }}", { 
                period: periodVal
            });
            if(!resTransaction.error){
                try {
                    setTimeout(() => {
                        const fn = window.transactionInboundOutbound || transactionInboundOutbound; 
                        if (typeof fn === 'function') {
                            fn(resTransaction.data);
                        } else {
                            console.error('Fungsi transactionInboundOutbound TIDAK DITEMUKAN');
                        }
                    }, 10);
                } catch (err) {
                    console.error("Terjadi error ", err);
                }
            }
        }

        async function apiTransactionMetrics() {
            let periodVal = $('#period').val();
            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-metrics') }}", { 
                period: periodVal
            });
            
            if(!resTransaction.error){
                try {
                    setTimeout(() => {
                        const fn = window.transactionMetrics || transactionMetrics; 
                        if (typeof fn === 'function') {
                            fn(resTransaction.data);
                        } else {
                            console.error('Fungsi transactionMetrics TIDAK DITEMUKAN');
                        }
                    }, 10);
                } catch (err) {
                    console.error("Terjadi error ", err);
                }
            }
        }

        async function apiTransactionSupplier() {
            let periodVal = $('#period').val();

            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-supplier') }}", { 
                period: periodVal
            });
            // let resTransaction = await getDatas("{{ route('web.warehouse.transaction-supplier') }}");
            
            if(!resTransaction.error){
                try {
                    setTimeout(() => {
                        const fn = window.transactionSupplier || transactionSupplier; 
                        if (typeof fn === 'function') {
                            fn(resTransaction.data);
                        } else {
                            console.error('Fungsi transactionSupplier TIDAK DITEMUKAN');
                        }
                    }, 10);
                } catch (err) {
                    console.error("Terjadi error ", err);
                }
            }
        }

        async function apiTransactionSupplierBatch() {
            let periodVal = $('#period').val();

            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-supplier-batch') }}", { 
                period: periodVal
            });
            
            if(!resTransaction.error){
                try {
                    setTimeout(() => {
                        const fn = window.transactionSupplierBatch || transactionSupplierBatch; 
                        if (typeof fn === 'function') {
                            fn(resTransaction.data);
                        } else {
                            console.error('Fungsi transactionSupplierBatch TIDAK DITEMUKAN');
                        }
                    }, 10);
                } catch (err) {
                    console.error("Terjadi error ", err);
                }
            }
        }

        async function apiTransactionProgress() {
            const container = $('#progress-container');
            const productContainer = $('#progress-product-container');
            let periodVal = $('#period').val();
            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-progress') }}", { 
                period: periodVal
            });
            if (!resTransaction.error) {
                // const data = resTransaction.data.data;
                container.empty(); // Kosongkan container sebelum render

                let grandTotalTransaction = 0;
                let grandTotalWeight = 0;

                // data.forEach((item, index) => {
                //     grandTotalTransaction += item.totalTransaction;
                //     grandTotalWeight += item.totalAllWeight;

                //     const total = item.totalAllWeight > 0 ? item.totalAllWeight : 1; // Hindari pembagian dengan nol

                //     // Hitung persentase masing-masing bagian
                //     const pctNet    = ((item.netWeight / total) * 100);
                //     const pctResidu = ((item.breakdown.residuWeight / total) * 100);
                //     const pctReturn = ((item.breakdown.returnWeight / total) * 100);

                //     const colors = ['primary', 'success', 'info', 'warning', 'danger', 'dark', 'secondary'];
                //     const color = colors[index % colors.length];

                //     const html = `
                //         <div class="row g-0 align-items-center py-2 position-relative ${index !== data.length - 1 ? 'border-bottom border-200' : ''}"
                //             data-bs-toggle="tooltip" 
                //             data-bs-custom-class="custom-tooltip-bg-${color}"
                //             data-bs-html="true" 
                //             title="Net: ${formatterNumberID(item.netWeight)} kg (${formatterNumberID(pctNet)}%)<br/>Residu: ${formatterNumberID(item.breakdown.residuWeight)} kg (${formatterNumberID(pctResidu)}%)<br/>Return: ${formatterNumberID(item.breakdown.returnWeight)} kg (${formatterNumberID(pctReturn)}%)"
                //             >
                //             <div class="col ps-card py-1 position-static">
                //                 <div class="d-flex align-items-center">
                //                     <div class="avatar avatar-xl me-3">
                //                         <div class="avatar-name rounded-circle bg-soft-${color} text-${color} d-flex align-items-center justify-content-center">
                //                             <b style="
                //                                 font-size: 10px;
                //                                 line-height: 1;
                //                                 font-weight: bolder;
                //                             ">${item.code}</b>
                //                         </div>
                //                     </div>
                //                     <div class="flex-1">
                //                         <h6 class="mb-0 d-flex align-items-center">
                //                             <span class="text-${color} fw-semi-bold">${item.progress}</span>
                //                             <span class="badge rounded-pill ms-2 bg-soft-${color} text-${color}">${item.totalTransaction} Trans</span>
                //                         </h6>
                //                     </div>
                //                 </div>
                //             </div>
                //             <div class="col py-1">
                //                 <div class="row flex-end-center g-0">
                //                     <div class="col-auto pe-2">
                //                         <div class="fs--1 fw-semi-bold">${formatterNumberID(item.totalAllWeight)} kg</div>
                //                     </div>
                //                     <div class="col-5 pe-card ps-2">
                //                         <div class="progress bg-200 me-2" style="height: 6px;" >
                //                             <div class="progress-bar bg-${color}" role="progressbar" style="width: ${pctNet}%" aria-valuenow="${pctNet}" aria-valuemin="0" aria-valuemax="100"></div>
                //                             <div class="progress-bar bg-600" role="progressbar" style="width: ${pctResidu}%" aria-valuenow="${pctResidu}" aria-valuemin="0" aria-valuemax="100"></div>
                //                             <div class="progress-bar bg-1000" role="progressbar" style="width: ${pctReturn}%" aria-valuenow="${pctReturn}" aria-valuemin="0" aria-valuemax="100"></div>
                //                         </div>
                //                     </div>
                //                 </div>
                //             </div>
                //         </div>
                //     `;
                //     container.append(html);
                // });

                // $('#total_transaction_all').text(`${formatterNumberID(grandTotalTransaction)} Trans (${formatterNumberID(grandTotalWeight)} kg)`);

                if(!productContainer){
                    return;
                }
                const reportData = resTransaction.data.report;
                productContainer.empty();

                grandTotalTransaction = 0;
                grandTotalWeight = 0;

                // Loop menggunakan reportData agar kita bisa akses .details untuk tooltip
                reportData.forEach((item, index) => {
                    grandTotalTransaction += item.total_transaction;
                    grandTotalWeight += item.total_in;

                    // --- KALKULASI PERSENTASE BERSIH (NON-RESIDU) ---
                    let totalResiduWeight = 0;
                    if (item.details && item.details.length > 0) {
                        // Jumlahkan semua yang statusnya residu
                        totalResiduWeight = item.details
                            .filter(prod => prod.status && prod.status.toLowerCase() === 'residu')
                            .reduce((sum, prod) => sum + parseFloat(prod.win), 0);
                    }

                    // Persentase = ((Total In - Residu) / Total In) * 100
                    // Gunakan Math.max(0, ...) untuk menghindari angka negatif jika data anomali
                    let cleanWeight = item.total_in - totalResiduWeight;
                    let yieldPercentage = item.total_in > 0 ? (cleanWeight / item.total_in) * 100 : 0;
                    
                    // Batasi minimal 0 dan maksimal 100
                    yieldPercentage = Math.min(100, Math.max(0, yieldPercentage));

                    const colors = ['primary', 'success', 'info', 'warning', 'danger', 'dark', 'secondary'];
                    const color = colors[index % colors.length];

                    // --- LOGIKA TOOLTIP PRODUK (Tetap Seperti Kode Anda) ---
                    let productTooltip = `<b class='text-white'>${item.code}: ${item.name}</b><br/>`;

                    if (item.details && item.details.length > 0) {
                        productTooltip += `<span class='text-white'>Yield: <b>${yieldPercentage.toFixed(1)}%</b></span>`;
                        productTooltip += `<hr style='margin: 1px 0; padding: 1px 0; border-top: 1px dashed #fff; opacity: 0.5;'/>`;
                        item.details.forEach(prod => {
                            // Cek apakah statusnya residu
                            const isResidu = prod.status && prod.status.toLowerCase() === 'residu';
                            
                            // Gunakan warna merah jika residu, jika tidak gunakan warna default (biasanya putih/abu di tooltip)
                            const textColor = isResidu ? 'color: #ff6b6b; font-weight: bold;' : 'color: #fff;';
                            const labelStatus = isResidu ? ' (Residu)' : '';

                            productTooltip += `<span style='${textColor}'>• ${prod.product_name}${labelStatus}: ${formatterNumberID(prod.win)} kg</span><br/>`;
                        });
                    } else {
                        productTooltip += `Tidak ada data produk`;
                    }
                    const html = `
                        <div class="row g-0 align-items-center py-2 position-relative ${index !== reportData.length - 1 ? 'border-bottom border-200' : ''}"
                            data-bs-toggle="tooltip" 
                            data-bs-html="true" 
                            data-bs-custom-class="custom-tooltip-bg-${color}"
                            title="${productTooltip}">
                            <div class="col ps-card py-1">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl me-3">
                                        <div class="avatar-name rounded-circle bg-soft-${color} text-${color} d-flex align-items-center justify-content-center">
                                            <b style="font-size: 10px;">${item.code}</b>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-0 d-flex align-items-center">
                                            <span class="text-${color} opacity-100 fw-semi-bold">${item.name}</span>
                                            <span class="badge rounded-pill ms-2 bg-soft-${color} text-${color}">${item.total_transaction} Trans</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col py-1">
                                <div class="row flex-end-center g-0">
                                    <div class="col-auto pe-2">
                                        <div class="fs--1 fw-semi-bold">${formatterNumberID(item.total_in)} kg</div>
                                    </div>
                                    <div class="col-5 pe-card ps-2">
                                        <div class="progress bg-200 me-2" style="height: 6px;" title="Yield: ${yieldPercentage.toFixed(1)}%">
                                            <div class="progress-bar bg-${color} opacity-75" style="width: ${yieldPercentage}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    
                    productContainer.append(html);
                });

                // Update Total Badge di Header Card
                $('#total_transaction_product_all').text(`${formatterNumberID(grandTotalTransaction)} Trans`);
                
                // Re-inisialisasi tooltip agar render HTML berfungsi
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            }
        }

        async function apiTransactionStorage() {
            const headerEl = document.getElementById('storage-header-info');
            const barContainer = document.getElementById('storage-product-bar');
            const legendContainer = document.getElementById('storage-product-legend');

            const progressBarContainer = document.getElementById('storage-progress-bar');
            const progressLegendContainer = document.getElementById('storage-progress-legend');

            const alertContainer = document.getElementById('storage-alerts');
            const $totalPending = $('#total-all-pending');

            $totalPending.addClass('d-none');

            if (headerEl) {
                headerEl.innerHTML = `Loading storage data...`;
            }

            let resTransaction = await getDatas("{{ route('web.warehouse.transaction-storage') }}");

            if (!resTransaction.error) {
                const data = resTransaction.data;
                const warehouse = data.warehouse;
                const topProducts = data.topProducts;
                const lowStocks = data.lowStocks; // Bisa digunakan untuk alert jika perlu
                const progressData = data.progress;

                if(data.countPending > 0){
                    $totalPending.text(data.countPending);
                    $totalPending.removeClass('d-none');
                }

                $capacityStorage = warehouse.capacityKg;
                // 1. Update Header Info
                // const headerEl = document.getElementById('storage-header-info');
                if (headerEl) {
                    headerEl.innerHTML = `Using Storage <strong class="text-dark">${formatterNumberID(warehouse.capacityInfo.totalWeight)} kg</strong> of ${formatterNumberID(warehouse.capacityKg)} kg <strong class="text-dark"> ( ${formatterNumberID(warehouse.capacityInfo.filledPercent)}% )</strong>`;
                }

                // 2. Render Progress Bar Segments
                
                // start storage by product
                let barHtml = '';
                let legendHtml = '';

                // Palette warna Falcon untuk tiap produk
                const palette = ['bg-primary', 'bg-info', 'bg-success', 'bg-400', 'bg-600', 'bg-800', 'bg-1000', 'bg-dark'];

                topProducts.forEach((item, index) => {
                    // Hitung persentase terhadap kapasitas TOTAL gudang
                    const percentage = ((item.value / warehouse.capacityKg) * 100);
                    const colorClass = palette[index % palette.length];

                    const tooltipContent = `${item.name} - ${formatterNumberID(item.value)} kg (${formatterNumberID(percentage)}%)`;

                    // Build Segmen Bar
                    barHtml += `
                        <div class="progress-bar ${colorClass} opacity-75 border-end border-white border-1" 
                            role="progressbar" 
                            style="width: ${percentage}%;" 
                            data-bs-toggle="tooltip" 
                            data-bs-custom-class="custom-tooltip-${colorClass}"
                            data-bs-placement="top" 
                            title="${tooltipContent}"
                            aria-valuenow="${percentage}" aria-valuemin="0" aria-valuemax="100">
                        </div>`;

                    // Build Legend
                    legendHtml += `
                        <div class="col-auto d-flex align-items-center pe-3" 
                            data-bs-toggle="tooltip" 
                            data-bs-custom-class="custom-tooltip-${colorClass}"
                            data-bs-placement="top" 
                            title="${tooltipContent}">
                            <span class="dot ${colorClass} opacity-75"></span>
                            <span>${item.name}</span>
                            <span class="d-none d-md-inline-block ms-1 text-500">(${formatterNumberID(item.value)}kg)</span>
                        </div>`;
                });

                // 3. Tambahkan Sisa Ruang (Free Space) ke Bar
                const freeWeight = warehouse.capacityInfo.remainingKg;
                const freePCent = warehouse.capacityInfo.emptyPercent;
                
                barHtml += `
                    <div class="progress-bar bg-100" role="progressbar" 
                        style="width: ${freePCent}%;"
                        data-bs-toggle="tooltip" 
                        data-bs-custom-class="custom-tooltip-bg-100"
                        data-bs-placement="top" 
                        title="Free Space: ${formatterNumberID(freeWeight)} kg (${formatterNumberID(freePCent)}%)">
                    </div>`;
                
                legendHtml += `
                    <div class="col-auto d-flex align-items-center"
                        data-bs-toggle="tooltip" 
                        data-bs-custom-class="custom-tooltip-bg-100"
                        data-bs-placement="top" 
                        title="Free Space: ${formatterNumberID(freeWeight)} kg (${formatterNumberID(freePCent)}%)">
                        <span class="dot bg-100"></span>
                        <span>Free</span>
                        <span class="d-none d-md-inline-block ms-1 text-500">(${formatterNumberID(warehouse.capacityInfo.remainingKg)}kg)</span>
                    </div>`;

                

                // Injeksi ke DOM
                if (barContainer) barContainer.innerHTML = barHtml;
                if (legendContainer) legendContainer.innerHTML = legendHtml;

                // end storage by product


                // start storage by progress
                const paletteProgress = ['primary', 'success', 'info', 'warning', 'danger', 'dark', 'secondary'];

                let progressBarHtml = '';
                let progressLegendHtml = '';

                // Filter progress yang punya stok saja (>0)
                const activeProgress = progressData.filter(p => p.totalWeight > 0);

                activeProgress.forEach((prog) => {
                    const percentage = (prog.totalWeight / $capacityStorage) * 100;
                    
                    // CARA TERBAIK: Cari indeks asli dari progressData utama agar warna tidak berubah-ubah
                    const originalIndex = progressData.findIndex(p => p.code === prog.code);
                    const colorClass = paletteProgress[originalIndex % paletteProgress.length];
                    
                    // --- Tooltip Logic ---
                    let detailList = `<b>${prog.name} (${prog.code})</b><br/>`;
                    prog.details.forEach(d => {
                        detailList += `• ${d.productName}: ${formatterNumberID(d.weight)} kg<br/>`;
                    });
                    detailList += `<br/> Total: ${formatterNumberID(prog.totalWeight)} kg`;

                    // --- Progress Bar ---
                    progressBarHtml += `
                        <div class="progress-bar bg-${colorClass} opacity-75 border-end border-white border-1" 
                            role="progressbar" 
                            style="width: ${percentage}%;" 
                            data-bs-toggle="tooltip" 
                            data-bs-custom-class="custom-tooltip-bg-${colorClass}"
                            data-bs-html="true"
                            title="${detailList}">
                        </div>`;

                    // --- Legend ---
                    progressLegendHtml += `
                        <div class="col-auto d-flex align-items-center pe-3" 
                            data-bs-toggle="tooltip" 
                            data-bs-custom-class="custom-tooltip-bg-${colorClass}"
                            data-bs-html="true" title="${detailList}">
                            <span class="dot bg-${colorClass} opacity-75"></span>
                            <span class="fw-semi-bold">${prog.code}</span>
                            <span class="d-none d-md-inline-block ms-1 text-500">(${formatterNumberID(prog.totalWeight)}kg)</span>
                        </div>`;
                });

                // Add Free Space to Progress Bar (Samakan dengan bar atas)
                progressBarHtml += `<div class="progress-bar bg-100" role="progressbar" style="width: ${warehouse.capacityInfo.emptyPercent}%;" data-bs-toggle="tooltip" title="Free Space: ${formatterNumberID(warehouse.capacityInfo.remainingKg)} kg"></div>`;

                if (progressBarContainer) progressBarContainer.innerHTML = progressBarHtml;
                if (progressLegendContainer) progressLegendContainer.innerHTML = progressLegendHtml;

                // end storage by progress

                // tooltip

                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new window.bootstrap.Tooltip(tooltipTriggerEl, {
                        trigger: 'hover'
                    });
                });

                // Di dalam function apiTransactionStorage()

                if (alertContainer) {
                    let alertHtml = ``;
                    alertHtml += `<div class="row g-0 fs--1 fw-semi-bold">`;


                    const createTableTooltip = (title, items) => {
                        // 1. Logika Filter: 
                        // Jika ini adalah Low Stock, kita filter hanya yang > 0.
                        // Jika ini adalah Stock Kosong (Null Stock), kita tampilkan semua (termasuk yang 0).
                        const isNullStock = title.toLowerCase().includes('out') || title.toLowerCase().includes('kosong');
                        const filteredItems = isNullStock ? items : items.filter(item => item.value > 0);
                        
                        if (filteredItems.length === 0) {
                            return `<div class='p-3 text-center'><span class='fs--1'>Tidak ada detail item.</span></div>`;
                        }

                        // 2. Tentukan Layout Dinamis (Step 3 jika data > 20)
                        const useStep3 = filteredItems.length > 20;
                        const step = useStep3 ? 3 : 2;
                        const minWidth = useStep3 ? '750px' : '480px';
                        const nameWidth = useStep3 ? '23%' : '35%';
                        const valWidth = useStep3 ? '10%' : '15%';

                        let html = `<div class='p-3' style='min-width: ${minWidth};'>`;
                        html += `<h6 class='text-white border-bottom pb-2 mb-2 fs--1 text-uppercase fw-bold'>${title} (${filteredItems.length})</h6>`;
                        html += `<table class='table table-sm table-borderless mb-0 text-white' style='font-size: 10px; table-layout: fixed;'><tbody>`;

                        // 3. Loop Baris
                        for (let i = 0; i < filteredItems.length; i += step) {
                            html += `<tr>`;
                            for (let j = 0; j < step; j++) {
                                const item = filteredItems[i + j];
                                if (item) {
                                    // Logika: Jika value 0, tampilkan td kosong. Jika > 0, tampilkan angkanya.
                                    const displayValue = item.value > 0 ? `${formatterNumberID(item.value)} kg` : '';
                                    
                                    html += `
                                        <td class='ps-0 text-truncate' style='width: ${nameWidth}; border-bottom: 1px solid rgba(255,255,255,0.15)'>
                                            ${item.name}
                                        </td>
                                        <td class='pe-3 text-end fw-bold' style='width: ${valWidth}; border-bottom: 1px solid rgba(255,255,255,0.15)'>
                                            ${displayValue}
                                        </td>
                                    `;
                                } else {
                                    // Spacer untuk baris terakhir yang tidak penuh
                                    html += `<td></td><td></td>`;
                                }
                            }
                            html += `</tr>`;
                        }

                        html += `</tbody></table></div>`;
                        return html;
                    };

                    // Low Stock (Dot Merah)
                    if (data.lowStocks && data.lowStocks.length > 0) {
                        let _pe = '';
                        if (data.nullStocks && data.nullStocks.length > 0) _pe = 'pe-3'; 
                        const tooltipLow = createTableTooltip('Low Stock Items', data.lowStocks);
                        alertHtml += `
                            <div class="col-auto d-flex align-items-center ${_pe} mb-1 storage-tooltip-trigger" 
                                data-bs-html="true" 
                                data-bs-custom-class="custom-tooltip-bg-danger"
                                data-bs-title="${tooltipLow}">
                                <span class="dot bg-danger"></span>
                                <span class="text-danger cursor-pointer">Low Stock</span>
                                <span class="ms-1 badge badge-soft-danger rounded-pill">${data.lowStocks.length}</span>
                            </div>`;
                    }

                    // Stock Kosong (Dot Kuning)
                    if (data.nullStocks && data.nullStocks.length > 0) {
                        const tooltipNull = createTableTooltip('Out of Stock Items', data.nullStocks);
                        alertHtml += `
                            <div class="col-auto d-flex align-items-center mb-1 storage-tooltip-trigger" 
                                data-bs-html="true"  
                                data-bs-custom-class="custom-tooltip-bg-warning"
                                data-bs-title="${tooltipNull}">
                                <span class="dot bg-warning"></span>
                                <span class="text-warning cursor-pointer">Out of Stock</span>
                                <span class="ms-1 badge badge-soft-warning rounded-pill">${data.nullStocks.length}</span>
                            </div>`;
                    }

                    alertHtml += `</div>`;
                    alertContainer.innerHTML = alertHtml;

                    const oldTooltips = document.querySelectorAll('.storage-tooltip-trigger');
                    oldTooltips.forEach(el => {
                        const instance = bootstrap.Tooltip.getInstance(el);
                        if (instance) instance.dispose();
                    });

                    const tooltipTriggers = document.querySelectorAll('.storage-tooltip-trigger');

                    tooltipTriggers.forEach(el => {
                        const customClassName = el.getAttribute('data-bs-custom-class');
                        new bootstrap.Tooltip(el, {
                            html: true,
                            container: 'body',
                            customClass: `${customClassName} shadow-md`,
                            // Konfigurasi allowList agar tabel tidak di-strip oleh Bootstrap
                            allowList: {
                                ...bootstrap.Tooltip.Default.allowList,
                                table: [],
                                thead: [],
                                tbody: [],
                                tr: [],
                                td: [],
                                div: ['class', 'style'],
                                span: ['class', 'style'],
                                h6: ['class']
                            },
                            // popperConfig: {
                            //     modifiers: [
                            //         {
                            //             name: 'preventOverflow',
                            //             options: {
                            //                 boundary: 'viewport',
                            //             },
                            //         },
                            //     ],
                            // },
                            boundary: 'viewport',
                            placement: 'top',
                            trigger: 'hover'
                        });
                    });
                }
            }
        }

    }
</script>
@endpush

