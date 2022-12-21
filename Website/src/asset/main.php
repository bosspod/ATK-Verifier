<?php
$html5 = '
<!DOCTYPE html>
<html lang="en">
';

$head = '
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta property="og:url" content="https://titec.kmutt.ac.th/" />
<meta property="og:site_name" content="CPE | KMUTT" />
<meta property="og:type" content="website" />
<meta property="og:title" content="ATK Certificate | D1 CPE101" />
<meta property="og:description" content="Final Project of CPE101 Subject" />
<meta property="og:image" content="https://titec.kmutt.ac.th/project/src/thumbnail.png" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="627" />
<meta name="twitter:card" content="summary_large_image" />

<title>ATK Verifier System</title>

<link rel="shortcut icon" href="/project/src/img/Logo.png" type="image/png">

<link rel="stylesheet" href="/project/src/css/bootstrap.min.css">

<link rel="stylesheet" href="/project/src/css/popup.css">

<link rel="stylesheet" href="/project/src/css/default.css">

<link rel="stylesheet" href="/project/src/css/style.css">

<link rel="stylesheet" href="/project/src/css/LineIcons.css">

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>';
if (isset($level) == "admin") {
    $header = '
    <header class="header-area">
    <div class="navigation fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="/project/">
                            <img src="/project/src/img/logo_blue.png" width=" 50px" alt="Logo">
                        </a>
                        <h4>ATK Verifier System</h4>
                        <div class="collapse navbar-collapse"></div>
                        <a class="btn btn-danger" href="/project/login/logout.php"><i class="lni-arrow-left"></i> Logout</a>   
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </header>
    ';
} else {
    $header = '
    <header class="header-area">
    <div class="navigation fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="/project/">
                            <img src="/project/src/img/logo_blue.png" width=" 50px" alt="Logo">
                        </a>
                        <h4>ATK Verifier System</h4>
                        <div class="collapse navbar-collapse"></div>
                        <a class="btn btn-primary" href="/project/login/"><i class="lni-arrow-right"></i> Login</a>   
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </header>
    ';
}

$footer = '
<footer id="footer" class="footer-area">
<div class="footer-widget pt-60 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="footer-content text-center">
                    <a href="/project/">
                        <img src="/project/src/img/logo_white.png" width="75px" alt="Logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-copyright pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright-text text-center pt-20">
                    <p>Copyright © 2022. Podsawee Wanatham & D1 CPE101</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</footer>
';
