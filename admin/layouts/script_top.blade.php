<!-- ===============================================-->
<!--    Favicons-->
<!-- ===============================================-->
<link rel="apple-touch-icon" sizes="199x116" href="{{url('falcon')}}/assets/img/favicons/logo-asinusa.png">
<link rel="icon" type="image/png" sizes="199x116" href="{{url('falcon')}}/assets/img/favicons/logo-asinusa.png">
<link rel="shortcut icon" type="image/x-icon" href="{{url('falcon')}}/assets/img/favicons/logo-asinusa.ico">
<link rel="manifest" href="{{url('falcon')}}/assets/img/favicons/manifest-asinusa.json">
<meta name="msapplication-TileImage" content="{{url('falcon')}}/assets/img/favicons/logo-asinusa.png">
<meta name="theme-color" content="#ffffff">
<script src="{{url('falcon')}}/assets/js/config.js"></script>
<script src="{{url('falcon')}}/vendors/simplebar/simplebar.min.js"></script>


<!-- ===============================================-->
<!--    Stylesheets-->
<!-- ===============================================-->
@if (Auth::user())
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{url('swal')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endif

@stack('script_top')
<link href="{{url('falcon')}}/vendors/prism/prism-okaidia.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
<link href="{{url('falcon')}}/vendors/simplebar/simplebar.min.css" rel="stylesheet">
<link href="{{url('falcon')}}/assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
<link href="{{url('falcon')}}/assets/css/theme.min.css" rel="stylesheet" id="style-default">
<link href="{{url('falcon')}}/assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
<link href="{{url('falcon')}}/assets/css/user.min.css" rel="stylesheet" id="user-style-default">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" />
{{-- <link rel="stylesheet" href="{{url('icons')}}/bootstrap-icons.css" /> --}}
<script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
    var linkDefault = document.getElementById('style-default');
    var userLinkDefault = document.getElementById('user-style-default');
    linkDefault.setAttribute('disabled', true);
    userLinkDefault.setAttribute('disabled', true);
    document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
    var linkRTL = document.getElementById('style-rtl');
    var userLinkRTL = document.getElementById('user-style-rtl');
    linkRTL.setAttribute('disabled', true);
    userLinkRTL.setAttribute('disabled', true);
    }
</script>

<style>

    .preloader-custom {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        opacity: .7;
        z-index: 9999;
        background-color: #454d55 !important;
        color: #fff;

        align-items: center;
        justify-content: center;
        display: flex;
    }

    .preloader-custom img {
        width: 60px;
        height: 60px;
    }
    .square {
        width: 100%;
        /* padding-bottom: 100%; */
        aspect-ratio: 1/1;
        background-size: cover;
        background-position: center;
    }

    .square-table-img {
        /* width: 100%; */
        /* padding-bottom: 100%; */
        aspect-ratio: 1/1;
        background-size: cover;
        background-position: center;
        object-fit: cover;
        /* max-height: 100px; */
        max-width: 72px;
        border-radius: 0.5rem;
    }

    .square-table-img-75p {
        /* width: 100%; */
        /* padding-bottom: 100%; */
        aspect-ratio: 3/4;
        background-size: cover;
        background-position: center;
        object-fit: cover;
        /* max-height: 100px; */
        max-width: 72px;
        border-radius: 0.5rem;
    }

    .square-table-img-56p {
        /* width: 100%; */
        /* padding-bottom: 100%; */
        aspect-ratio: 16/9;
        background-size: cover;
        background-position: center;
        object-fit: cover;
        /* max-height: 100px; */
        max-width: 72px;
        border-radius: 0.5rem;
    }

    .square-table-img-banner {
        /* width: 100%; */
        /* padding-bottom: 100%; */
        aspect-ratio: 20/4;
        background-size: cover;
        background-position: center;
        object-fit: cover;
        /* max-height: 100px; */
        max-width: 250px;
        min-width: 250px;
        border-radius: 5px;
    }

    .hide-act-upload {
        display: none;
    }

    .single-line {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .square-upload {
        width: 100%;
        /* aspect-ratio: 1/1; */
        background-size: cover;
        background-position: center;
        border: 2px dashed #BFC9D9;
        border-radius:.5rem;
    }

    .square-upload-img {
        width: 100%;
        aspect-ratio: 1/1;
        background-size: cover;
        background-position: center;
        object-fit: cover;
        padding: .5px;
        border-radius:.5rem;
    }

    .square-upload-img-75p {
        width: 100%;
        aspect-ratio: 3/4;
        background-size: cover;
        background-position: center;
        object-fit: cover;
        padding: .5px;
        border-radius:.5rem;
    }

    .square-upload-img-56p {
        width: 100%;
        aspect-ratio: 16/9;
        background-size: cover;
        background-position: center;
        object-fit: cover;
        padding: .5px;
        border-radius:.5rem;
    }

    .d-flex-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .square-upload:hover .hide-act-upload {
        display: block;
    }

    .square-upload:focus .hide-act-upload {
        display: block;
    }

    .square-upload-text {
        font-size: x-small;
        width: 100%;
        background-size: cover;
        background-position: center;
        border: 1px solid #BFC9D9;
        border-radius:.5rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
