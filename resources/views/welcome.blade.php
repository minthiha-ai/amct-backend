<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('app.companyInfo.logo')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>{{ config('app.companyInfo.name') }}</title>
    <style>
            @import url("https://fonts.googleapis.com/css?family=Luckiest+Guy");
            /* BODY */
            body {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                height: 100%;
                background-color: #405188;
                background-image: -webkit-linear-gradient(90deg, #00a8f1 0%, #405188 100%);
                background-attachment: fixed;
                background-size: 100% 100%;
                overflow: hidden;
                font-family: "Poppins", cursive;
                -webkit-font-smoothing: antialiased;
            }

            ::selection {
            background: transparent;
            }
            /* CLOUDS */
            body:before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                width: 0;
                height: 0;
                margin: auto;
                border-radius: 100%;
                background: transparent;
                display: block;
                box-shadow: 0 0 150px 100px rgba(255, 255, 255, 0.6),
                    200px 0 200px 150px rgba(255, 255, 255, 0.6),
                    -250px 0 300px 150px rgba(255, 255, 255, 0.6),
                    550px 0 300px 200px rgba(255, 255, 255, 0.6),
                    -550px 0 300px 200px rgba(255, 255, 255, 0.6);
            }
            /* JUMP */
            h1 {
                cursor: default;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                height: 100px;
                margin: auto;
                display: block;
                text-align: center;
            }

            h1 span {
                position: relative;
                top: 20px;
                display: inline-block;
                -webkit-animation: bounce 0.5s ease infinite alternate;
                font-size: 80px;
                color: #fff;
                text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc,
                    0 5px 0 #ccc, 0 6px 0 transparent, 0 7px 0 transparent, 0 8px 0 transparent,
                    0 9px 0 transparent, 0 10px 10px rgba(0, 0, 0, 0.4);
            }

            h1 span:nth-child(2) {
            -webkit-animation-delay: 0.1s;
            }

            h1 span:nth-child(3) {
            -webkit-animation-delay: 0.2s;
            }

            h1 span:nth-child(4) {
            -webkit-animation-delay: 0.3s;
            }

            h1 span:nth-child(5) {
            -webkit-animation-delay: 0.4s;
            }

            h1 span:nth-child(6) {
            -webkit-animation-delay: 0.5s;
            }

            h1 span:nth-child(7) {
            -webkit-animation-delay: 0.6s;
            }


            /* ANIMATION */
            @-webkit-keyframes bounce {
            100% {
                top: -20px;
                text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc,
                0 5px 0 #ccc, 0 6px 0 #ccc, 0 7px 0 #ccc, 0 8px 0 #ccc, 0 9px 0 #ccc,
                0 50px 25px rgba(0, 0, 0, 0.2);
            }
            }

            .privacy-link{
                position: fixed; bottom: 5%; text-align:center; left: 5%;
                letter-spacing: 1.5px;
                word-spacing: 3px;
                color: #000;
                font-weight: bold;
                text-decoration: none;
                text-underline: none;
                padding: 5px 20px;
                background-color: #fff;
                border-radius: 10px;
                cursor: pointer !important;
                transition: .3 linear;
            }
            .privacy-link:hover {
                box-shadow: 1px 3px 20px #fff;
                color: #405188;
                transition: .3 linear;

            }

    </style>
</head>
<body>

    <h1>
        <span>A</span>
        <span>M</span>
        <span>C</span>
        <span>T</span>
      </h1>
      <div class="">
        <a href="{{ route('privacyPolicy') }}" class="privacy-link" >Privacy Policy</a>
    </div>
</body>
</html>
