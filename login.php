<?php
include 'libs/load.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login">
    <meta name="author" content="Selfmade Ninja Academy">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.0/css/hover-min.css"
        integrity="sha512-glciccPoOqr5mfDGmlJ3bpbvomZmFK+5dRARpt62nZnlKwaYZSfFpFIgUoD8ujqBw4TmPa/F3TX28OctJzoLfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .logo {
        height: 50px;
        margin-left: 4em;
        /* position: relative; */
        /* z-index: 2; */
    }

    .border-boxer {
        width: 380px;
        height: 380px;
        padding: 20px;
        position: relative;
        border-radius: 0.6rem;
        background: rgba(255, 255, 255, 0.2);
        /* border: 1px solid rgba(255, 255, 255, 0.4); */
        /* box-shadow: 20px 20px 50px rgba(0, 0, 0, 0.4); */
        /* border-top: 1px solid rgba(255, 255, 255, 0.5); */
        /* border-left: 1px solid rgba(255, 255, 255, 0.5); */
        backdrop-filter: blur(7px);
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -5px;
        border-radius: 5px;
        background-color: #E3E3E3;
    }

    .form-signin input[type="password"] {
        padding: 20px;
        margin-bottom: 10px;
        border-radius: 5px;
        background-color: #E3E3E3;
    }

    a {
        text-decoration: none;
    }

    body {
        display: flex;
        min-height: 90vh;
        width: 100%;
        max-width: 205vh;
        justify-content: center;
        align-items: center;
        /* background: linear-gradient(to right, #f6d364 5%, #fda085 100%); */
        /* background: linear-gradient(to right, #fda085 0%, #f6d364 100%); */
        /* background: url("assets/brand/labs-war.jpg");
        background-size: cover; */
        background: linear-gradient(to right, #ef629f 0%, #2c3e50 100%);
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background: linear-gradient(to right, #f00, #D65DB1);
        clip-path: circle(40% at right 80%);
    }

    body::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background: linear-gradient(to right, #845EC2, #D65DB1);
        clip-path: circle(30% at 10% 10%);
    }
    </style>
</head>

<body>
    <main>
        <?
        load_template('_login');
        ?>
    </main>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>