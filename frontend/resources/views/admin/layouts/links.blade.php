<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('/')}}admin/assets/images/favicon.ico">

<!-- Bootstrap Css -->
<link href="{{asset('/')}}admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{asset('/')}}admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{asset('/')}}admin/assets/css/app.min.css"  rel="stylesheet" type="text/css" />
<!-- App js -->
<script src="{{asset('/')}}admin/assets/js/plugin.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    /* Customize toastr success */
    .toast-success {
        background-color: #556ee6 !important; /* Bootstrap green */
        font-size: 15px;
    }

    /* Customize toastr error */
    .toast-error {
        background-color: #dc3545 !important; /* Bootstrap red */
        font-size: 15px;
    }

    /* Add some border radius and shadow */
    .toast {
        border-radius: 6px !important;
        border: 0 !important;
    }
</style>

@stack('links')

