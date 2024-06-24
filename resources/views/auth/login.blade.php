<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Dance Connect - Login</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-picker.css">
    <!-- Plugins css Ends-->
    <!-- Css Files -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="login-card">
            <div>
                <div>
                    <center>
                        <img src="../assets/images/logo-login.png" alt="loginpage" width="377.22" height="111.52"
                            style="pointer-events: none;">
                    </center>
                </div>
                <div class="login-main mt-4">
                    <form class="theme-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h4 class="login-page">Login Admin</h4>
                        <div class="input-group mb-3 mt-4">
                            <input name="email" type="email" class="form-control" required=""
                                placeholder="example@mail.com" />
                        </div>
                        <div class="form-group">
                            <div class="col input-group sm-10">
                                <input name="password" type="password" id="inputPassword" class="form-control "
                                    required="" placeholder="********">
                            </div>
                            <div class="mt-4">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                            </div>
                            <div class="text-end mt-4">
                                <button class="btn btn-primary btn-block login-page-btn w-100" style="font-size:20px;"
                                    type="submit" href="/dashboard">Login</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div style="margin-top: -80px;">
            <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">©2024 Dance Connect. All rights reserved.</p>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="../assets/js/jquery-3.5.1.min.js"></script>
        <!-- Bootstrap js-->
        <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
        <!-- feather icon js-->
        <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="../assets/js/config.js"></script>
        <!-- Plugins JS start-->
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="../assets/js/script.js"></script>
        <!-- login js-->
        <!-- Plugin used-->
    </div>
</body>

</html>
