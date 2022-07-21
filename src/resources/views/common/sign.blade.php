@extends('common.main')

@section('style')
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&amp;display=swap" rel="stylesheet">
    <style>
        *,
        *::after,
        *::before {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            user-select: none;
        }

        /* Generic */
        .overlay-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Montserrat", sans-serif;
            font-size: 12px;
            background-color: #ecf0f3;
            color: #a0a5a8;
            background: url('/template/images/sign-banner.jpg') top center / cover no-repeat;
        }

        /**/
        .main {
            position: relative;
            width: 1000px;
            min-width: 1000px;
            height: 90vh;
            padding: 25px;
            border-radius: 12px;
            overflow: hidden;
        }

        @media (max-width: 1200px) {
            .main {
                transform: scale(0.7);
            }
        }

        @media (max-width: 1000px) {
            .main {
                transform: scale(0.6);
            }
        }

        @media (max-width: 800px) {
            .main {
                transform: scale(0.5);
            }
        }

        @media (max-width: 600px) {
            .main {
                transform: scale(0.4);
            }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            width: 600px;
            height: 100%;
            padding: 25px;
            background-color: #ecf0f3;
            transition: 1.25s;
        }

        .form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            height: 100%;
        }

        .form-sign-up,
        .form-sign-in {
            height: auto !important;
        }

        .form__icon {
            object-fit: contain;
            width: 30px;
            margin: 0 5px;
            opacity: 0.5;
            transition: 0.15s;
        }

        .form__icon:hover {
            opacity: 1;
            transition: 0.15s;
            cursor: pointer;
        }

        .form__input {
            width: 350px;
            height: 40px;
            margin: 4px 0;
            padding-left: 25px;
            font-size: 13px;
            letter-spacing: 0.15px;
            border: none;
            outline: none;
            font-family: "Montserrat", sans-serif;
            background-color: #ecf0f3;
            transition: 0.25s ease;
            border-radius: 8px;
            box-shadow: inset 2px 2px 4px #d1d9e6, inset -2px -2px 4px #f9f9f9;
        }

        .form__input:focus {
            box-shadow: inset 4px 4px 4px #d1d9e6, inset -4px -4px 4px #f9f9f9;
        }

        .form__span {
            margin-top: 30px;
            margin-bottom: 12px;
        }

        .form__link {
            color: #181818;
            font-size: 15px;
            margin-top: 25px;
            border-bottom: 1px solid #a0a5a8;
            line-height: 2;
        }

        .title {
            font-size: 34px;
            font-weight: 700;
            line-height: 2;
        }

        .description {
            font-size: 14px;
            letter-spacing: 0.25px;
            text-align: center;
            line-height: 1.6;
        }

        .title,
        .form__span,
        .form__link, 
        .description,
        .form-check-label,
        .forgot-pass-displayer {
            color: #717fe0;
            text-shadow: 1px 1px #e0d2fe;
        }

        ::placeholder {
            color: #717fe0!important;
            opacity: 1;
        }

        .button {
            width: 180px;
            height: 50px;
            border-radius: 25px;
            margin-top: 50px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1.15px;
            background-color: #4b70e2;
            color: #f9f9f9;
            box-shadow: 0px 2px 10px #d1d9e6, 0px 2px 10px #f9f9f9;
            border: none;
            outline: none;
        }

        /**/
        .a-container {
            z-index: 100;
            left: calc(100% - 600px);
            overflow-y: auto;
            background: url('/template/images/sign-in-banner.jpg') top right 30% / cover no-repeat;
        }

        .b-container {
            left: calc(100% - 600px);
            z-index: 0;
            overflow-y: auto;
            background: url('/template/images/sign-up-banner.jpg') top left 10% / cover no-repeat;
        }

        .a-container::-webkit-scrollbar,
        .b-container::-webkit-scrollbar {
            display: none;
        }

        .switch {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 400px;
            padding: 50px;
            z-index: 200;
            transition: 1.25s;
            overflow: hidden;
            box-shadow: 4px 4px 10px #d1d9e6, -4px -4px 10px #f9f9f9;
        }

        .switch__circle {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background-color: #ecf0f3;
            box-shadow: inset 8px 8px 12px #d1d9e6, inset -8px -8px 12px #f9f9f9;
            bottom: -60%;
            left: -60%;
            transition: 1.25s;
            display: none;
        }

        .switch__circle--t {
            top: -30%;
            left: 60%;
            width: 300px;
            height: 300px;
        }

        .switch__container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: absolute;
            width: 400px;
            padding: 50px 55px;
            transition: 1.25s;
        }

        .switch__button {
            cursor: pointer;
        }

        .switch__button:hover {
            box-shadow: -1px 6px 10px rgb(113, 127, 224, 0.8), -1px 10px 10px #f9f9f9;
            transform: scale(0.985);
            transition: 0.25s;
        }

        .switch__button:active,
        .switch__button:focus {
            transform: scale(0.97);
            transition: 0.25s;
        }

        /**/
        .is-txr {
            left: calc(100% - 400px);
            transition: 1.25s;
            transform-origin: left;
        }

        .is-txl {
            left: 0;
            transition: 1.25s;
            transform-origin: right;
        }

        .is-z200 {
            z-index: 200;
            transition: 1.25s;
        }

        .is-hidden {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            transition: 1.25s;
        }

        .is-gx {
            animation: is-gx 1.25s;
        }

        .error-in,
        .error-up-common,
        .notice-up-common {
            max-width: 70%;
            text-align: center;
        }

        span[class*="error-"] {
            text-shadow: 1px 1px #fed9d2;
        }

        @keyframes is-gx {
            0%,
            10%,
            100% {
                width: 400px;
            }

            30%,
            50% {
                width: 500px;
            }
        }

        /* Dropdown section */ 
        .dropdown-container > ul {
        list-style: none;
        padding: 0;
        }

        .dropdown {
        position: relative;
        }
        .dropdown a {
        text-decoration: none;
        }
        .dropdown [data-toggle="dropdown"]:before {
        position: absolute;
        display: block;
        content: '\25BC';
        font-size: 0.7em;
        color: #fff;
        top: 13px;
        right: 10px;
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
        -moz-transition: -moz-transform 0.6s;
        -o-transition: -o-transform 0.6s;
        -webkit-transition: -webkit-transform 0.6s;
        transition: transform 0.6s;
        }
        .dropdown > .dropdown-menu {
        max-height: 0;
        overflow: hidden;
        list-style: none;
        padding: 0;
        margin: 0;
        -moz-transform: scaleY(0);
        -ms-transform: scaleY(0);
        -webkit-transform: scaleY(0);
        transform: scaleY(0);
        -moz-transform-origin: 50% 0%;
        -ms-transform-origin: 50% 0%;
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
        -moz-transition: max-height 0.6s ease-out;
        -o-transition: max-height 0.6s ease-out;
        -webkit-transition: max-height 0.6s ease-out;
        transition: max-height 0.6s ease-out;
        animation: hideAnimation 0.4s ease-out;
        -moz-animation: hideAnimation 0.4s ease-out;
        -webkit-animation: hideAnimation 0.4s ease-out;
        }
        .dropdown > .dropdown-menu li {
        padding: 0;
        }
        .dropdown > .dropdown-menu li a {
        display: block;
        color: #6f6f6f;
        background: #EEE;
        -moz-box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
        -webkit-box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
        box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
        text-shadow: 0 -1px 0 rgba(255, 255, 255, 0.3);
        padding: 5px 10px;
        }
        .dropdown > .dropdown-menu li a:hover {
        background: #f6f6f6;
        }
        .dropdown > input[type="checkbox"] {
        opacity: 0;
        display: block;
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        }
        .dropdown > input[type="checkbox"]:checked ~ .dropdown-menu {
        max-height: 9999px;
        display: block;
        -moz-transform: scaleY(1);
        -ms-transform: scaleY(1);
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
        animation: showAnimation 0.5s ease-in-out;
        -moz-animation: showAnimation 0.5s ease-in-out;
        -webkit-animation: showAnimation 0.5s ease-in-out;
        -moz-transition: max-height 2s ease-in-out;
        -o-transition: max-height 2s ease-in-out;
        -webkit-transition: max-height 2s ease-in-out;
        transition: max-height 2s ease-in-out;
        }
        .dropdown > input[type="checkbox"]:checked + a[data-toggle="dropdown"]:before {
        -moz-transform: rotate(-180deg);
        -ms-transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
        transform: rotate(-180deg);
        -moz-transition: -moz-transform 0.6s;
        -o-transition: -o-transform 0.6s;
        -webkit-transition: -webkit-transform 0.6s;
        transition: transform 0.6s;
        }

        @keyframes showAnimation {
        0% {
            -moz-transform: scaleY(0.1);
            -ms-transform: scaleY(0.1);
            -webkit-transform: scaleY(0.1);
            transform: scaleY(0.1);
        }
        40% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
        }
        60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
        }
        100% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
        }
        100% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
        }
        }
        @-moz-keyframes showAnimation {
        0% {
            -moz-transform: scaleY(0.1);
            -ms-transform: scaleY(0.1);
            -webkit-transform: scaleY(0.1);
            transform: scaleY(0.1);
        }
        40% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
        }
        60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
        }
        100% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
        }
        100% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
        }
        }
        @-webkit-keyframes showAnimation {
        0% {
            -moz-transform: scaleY(0.1);
            -ms-transform: scaleY(0.1);
            -webkit-transform: scaleY(0.1);
            transform: scaleY(0.1);
        }
        40% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
        }
        60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.04);
            -ms-transform: scaleY(1.04);
            -webkit-transform: scaleY(1.04);
            transform: scaleY(1.04);
        }
        100% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
        }
        100% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
        }
        }
        @keyframes hideAnimation {
        0% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
        }
        60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
        }
        100% {
            -moz-transform: scaleY(0);
            -ms-transform: scaleY(0);
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
        }
        }
        @-moz-keyframes hideAnimation {
        0% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
        }
        60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
        }
        100% {
            -moz-transform: scaleY(0);
            -ms-transform: scaleY(0);
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
        }
        }
        @-webkit-keyframes hideAnimation {
        0% {
            -moz-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -webkit-transform: scaleY(1);
            transform: scaleY(1);
        }
        60% {
            -moz-transform: scaleY(0.98);
            -ms-transform: scaleY(0.98);
            -webkit-transform: scaleY(0.98);
            transform: scaleY(0.98);
        }
        80% {
            -moz-transform: scaleY(1.02);
            -ms-transform: scaleY(1.02);
            -webkit-transform: scaleY(1.02);
            transform: scaleY(1.02);
        }
        100% {
            -moz-transform: scaleY(0);
            -ms-transform: scaleY(0);
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
        }
        }
    </style>
@endsection

@section('content')
    <div class="overlay-container">
        <div class="main">
            {{-- Sign in form --}}
            <div class="container a-container" id="a-container">
                <form class="form form-sign-in form-reset-pass" id="form-sign-reset-pass">
                    <h2 id="signin-form-title" class="form_title title">{{ __('Sign in to Website') }}</h2>
                    <div class="form__icons">
                        <a href="/auth/redirect/facebook">
                            <img class="form__icon"
                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSI1MHB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MCA1MCIgd2lkdGg9IjUwcHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZWZzLz48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIj48ZyBmaWxsPSIjMDAwMDAwIiBpZD0iRmFjZWJvb2siPjxwYXRoIGQ9Ik0yNSw1MCBDMzguODA3MTE5NCw1MCA1MCwzOC44MDcxMTk0IDUwLDI1IEM1MCwxMS4xOTI4ODA2IDM4LjgwNzExOTQsMCAyNSwwIEMxMS4xOTI4ODA2LDAgMCwxMS4xOTI4ODA2IDAsMjUgQzAsMzguODA3MTE5NCAxMS4xOTI4ODA2LDUwIDI1LDUwIFogTTI1LDQ3IEMzNy4xNTAyNjUxLDQ3IDQ3LDM3LjE1MDI2NTEgNDcsMjUgQzQ3LDEyLjg0OTczNDkgMzcuMTUwMjY1MSwzIDI1LDMgQzEyLjg0OTczNDksMyAzLDEyLjg0OTczNDkgMywyNSBDMywzNy4xNTAyNjUxIDEyLjg0OTczNDksNDcgMjUsNDcgWiBNMjYuODE0NTE5NywzNiBMMjYuODE0NTE5NywyNC45OTg3MTIgTDMwLjA2ODc0NDksMjQuOTk4NzEyIEwzMC41LDIxLjIwNzYwNzIgTDI2LjgxNDUxOTcsMjEuMjA3NjA3MiBMMjYuODIwMDQ4NiwxOS4zMTAxMjI3IEMyNi44MjAwNDg2LDE4LjMyMTM0NDIgMjYuOTIwNzIwOSwxNy43OTE1MzQxIDI4LjQ0MjU1MzgsMTcuNzkxNTM0MSBMMzAuNDc2OTYyOSwxNy43OTE1MzQxIEwzMC40NzY5NjI5LDE0IEwyNy4yMjIyNzY5LDE0IEMyMy4zMTI4NzU3LDE0IDIxLjkzNjg2NzgsMTUuODM5MDkzNyAyMS45MzY4Njc4LDE4LjkzMTg3MDkgTDIxLjkzNjg2NzgsMjEuMjA4MDM2NiBMMTkuNSwyMS4yMDgwMzY2IEwxOS41LDI0Ljk5OTE0MTMgTDIxLjkzNjg2NzgsMjQuOTk5MTQxMyBMMjEuOTM2ODY3OCwzNiBMMjYuODE0NTE5NywzNiBaIE0yNi44MTQ1MTk3LDM2IiBpZD0iT3ZhbC0xIi8+PC9nPjwvZz48L3N2Zz4="
                            alt="">
                        </a>
                        <img class="form__icon"
                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSI1MHB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MCA1MCIgd2lkdGg9IjUwcHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZWZzLz48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIj48ZyBmaWxsPSIjMDAwMDAwIiBpZD0iTGlua2VkSW4iPjxwYXRoIGQ9Ik0yNSw1MCBDMzguODA3MTE5NCw1MCA1MCwzOC44MDcxMTk0IDUwLDI1IEM1MCwxMS4xOTI4ODA2IDM4LjgwNzExOTQsMCAyNSwwIEMxMS4xOTI4ODA2LDAgMCwxMS4xOTI4ODA2IDAsMjUgQzAsMzguODA3MTE5NCAxMS4xOTI4ODA2LDUwIDI1LDUwIFogTTI1LDQ3IEMzNy4xNTAyNjUxLDQ3IDQ3LDM3LjE1MDI2NTEgNDcsMjUgQzQ3LDEyLjg0OTczNDkgMzcuMTUwMjY1MSwzIDI1LDMgQzEyLjg0OTczNDksMyAzLDEyLjg0OTczNDkgMywyNSBDMywzNy4xNTAyNjUxIDEyLjg0OTczNDksNDcgMjUsNDcgWiBNMTQsMjAuMTE4MDQ3OSBMMTQsMzQuNjU4MTgzNCBMMTguNzEwMDg1MSwzNC42NTgxODM0IEwxOC43MTAwODUxLDIwLjExODA0NzkgTDE0LDIwLjExODA0NzkgWiBNMTYuNjY0Njk2MiwxMyBDMTUuMDUzNDA1OCwxMyAxNCwxNC4wODU4NjExIDE0LDE1LjUxMTUxMjIgQzE0LDE2LjkwNzYzMzEgMTUuMDIyMjcxMSwxOC4wMjQ3NjE0IDE2LjYwMzU1NTYsMTguMDI0NzYxNCBMMTYuNjMzNjU1NiwxOC4wMjQ3NjE0IEMxOC4yNzU5ODY3LDE4LjAyNDc2MTQgMTkuMjk4ODIyMiwxNi45MDc2MzMxIDE5LjI5ODgyMjIsMTUuNTExNTEyMiBDMTkuMjY4MjUxOSwxNC4wODU4NjExIDE4LjI3NTk4NjcsMTMgMTYuNjY0Njk2MiwxMyBaIE0zMC41NzY5MjEzLDIwLjExODA0NzkgQzI4LjA3NjE3NiwyMC4xMTgwNDc5IDI2Ljk1NjU1MDEsMjEuNTI5MzE5OSAyNi4zMzE0MTA4LDIyLjUxOTM1MjcgTDI2LjMzMTQxMDgsMjAuNDU5ODY0NCBMMjEuNjIwNzYxNCwyMC40NTk4NjQ0IEMyMS42ODI4NDI3LDIxLjgyNDIzNTYgMjEuNjIwNzYxNCwzNSAyMS42MjA3NjE0LDM1IEwyNi4zMzE0MTA4LDM1IEwyNi4zMzE0MTA4LDI2Ljg3OTU4ODcgQzI2LjMzMTQxMDgsMjYuNDQ1MDMyIDI2LjM2MTk4MTIsMjYuMDExNTM2OCAyNi40ODY1MTk5LDI1LjcwMDQwODQgQzI2LjgyNjkzMiwyNC44MzIyNiAyNy42MDIwMDY5LDIzLjkzMzQyMzMgMjguOTAzMjY3NCwyMy45MzM0MjMzIEMzMC42MDgzMzgxLDIzLjkzMzQyMzMgMzEuMjg5OTE0OSwyNS4yNjY3MjAyIDMxLjI4OTkxNDksMjcuMjIwNjMzMyBMMzEuMjg5OTE0OSwzNC45OTk2MTQgTDM1Ljk5OTgxMTksMzQuOTk5NjE0IEwzNiwyNi42NjI3NDQ2IEMzNiwyMi4xOTY2NDM5IDMzLjY3NjM3NDMsMjAuMTE4MDQ3OSAzMC41NzY5MjEzLDIwLjExODA0NzkgWiBNMzAuNTc2OTIxMywyMC4xMTgwNDc5IiBpZD0iT3ZhbC0xIi8+PC9nPjwvZz48L3N2Zz4=">
                        <img
                            class="form__icon"
                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSI1MHB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MCA1MCIgd2lkdGg9IjUwcHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZWZzLz48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIj48ZyBmaWxsPSIjMDAwMDAwIiBpZD0iVHdpdHRlciI+PHBhdGggZD0iTTI1LDUwIEMzOC44MDcxMTk0LDUwIDUwLDM4LjgwNzExOTQgNTAsMjUgQzUwLDExLjE5Mjg4MDYgMzguODA3MTE5NCwwIDI1LDAgQzExLjE5Mjg4MDYsMCAwLDExLjE5Mjg4MDYgMCwyNSBDMCwzOC44MDcxMTk0IDExLjE5Mjg4MDYsNTAgMjUsNTAgWiBNMjUsNDcgQzM3LjE1MDI2NTEsNDcgNDcsMzcuMTUwMjY1MSA0NywyNSBDNDcsMTIuODQ5NzM0OSAzNy4xNTAyNjUxLDMgMjUsMyBDMTIuODQ5NzM0OSwzIDMsMTIuODQ5NzM0OSAzLDI1IEMzLDM3LjE1MDI2NTEgMTIuODQ5NzM0OSw0NyAyNSw0NyBaIE0yNC42ODIyNTU0LDIwLjU1NDI5NzUgTDI0LjcyOTk0NCwyMS4zNzYxMDExIEwyMy45MzUxMzMzLDIxLjI3NTQ3MjEgQzIxLjA0MjAyMjUsMjAuODg5NzI3NSAxOC41MTQ1MjQ2LDE5LjU4MTU1MDQgMTYuMzY4NTM1OCwxNy4zODQ0ODM3IEwxNS4zMTkzODU3LDE2LjI5NDMzNjEgTDE1LjA0OTE1MDEsMTcuMDk5MzY4MSBDMTQuNDc2ODg2NCwxOC44OTM5MTg4IDE0Ljg0MjQ5OTMsMjAuNzg5MDk4NSAxNi4wMzQ3MTUzLDIyLjA2MzczMjYgQzE2LjY3MDU2MzgsMjIuNzY4MTM1NyAxNi41Mjc0OTc5LDIyLjg2ODc2NDcgMTUuNDMwNjU5MiwyMi40NDk0NzcyIEMxNS4wNDkxNTAxLDIyLjMxNTMwNTEgMTQuNzE1MzI5NiwyMi4yMTQ2NzYxIDE0LjY4MzUzNzEsMjIuMjY0OTkwNyBDMTQuNTcyMjYzNywyMi4zODIzOTEyIDE0Ljk1Mzc3MjgsMjMuOTA4NTk3OCAxNS4yNTU4MDA4LDI0LjUxMjM3MTkgQzE1LjY2OTEwMjQsMjUuMzUwOTQ3IDE2LjUxMTYwMTcsMjYuMTcyNzUwNSAxNy40MzM1ODIsMjYuNjU5MTI0MSBMMTguMjEyNDk2NSwyNy4wNDQ4Njg2IEwxNy4yOTA1MTYxLDI3LjA2MTY0MDEgQzE2LjQwMDMyODIsMjcuMDYxNjQwMSAxNi4zNjg1MzU4LDI3LjA3ODQxMTYgMTYuNDYzOTEzMSwyNy40MzA2MTMxIEMxNi43ODE4Mzc0LDI4LjUyMDc2MDggMTguMDM3NjM4MiwyOS42Nzc5OTQ0IDE5LjQzNjUwNSwzMC4xODExMzk0IEwyMC40MjIwNzAxLDMwLjUzMzM0MSBMMTkuNTYzNjc0NiwzMS4wNzAwMjkgQzE4LjI5MTk3NzYsMzEuODQxNTE4MSAxNi43OTc3MzM1LDMyLjI3NzU3NzIgMTUuMzAzNDg5NSwzMi4zMTExMjAyIEMxNC41ODgxNTk5LDMyLjMyNzg5MTYgMTQsMzIuMzk0OTc3NiAxNCwzMi40NDUyOTIyIEMxNCwzMi42MTMwMDcxIDE1LjkzOTMzOCwzMy41NTIyMTEzIDE3LjA2Nzk2OTIsMzMuOTIxMTg0MyBDMjAuNDUzODYyNiwzNS4wMTEzMzE5IDI0LjQ3NTYwNDYsMzQuNTQxNzI5OCAyNy40OTU4ODUxLDMyLjY4MDA5MzIgQzI5LjY0MTg3MzksMzEuMzU1MTQ0NSAzMS43ODc4NjI4LDI4LjcyMjAxODggMzIuNzg5MzI0MiwyNi4xNzI3NTA1IEMzMy4zMjk3OTU0LDI0LjgxNDI1ODkgMzMuODcwMjY2NywyMi4zMzIwNzY3IDMzLjg3MDI2NjcsMjEuMTQxMyBDMzMuODcwMjY2NywyMC4zNjk4MTEgMzMuOTE3OTU1MywyMC4yNjkxODIgMzQuODA4MTQzMiwxOS4zNDY3NDk0IEMzNS4zMzI3MTgzLDE4LjgxMDA2MTMgMzUuODI1NTAwOSwxOC4yMjMwNTg4IDM1LjkyMDg3ODIsMTguMDU1MzQzNyBDMzYuMDc5ODQwMywxNy43MzY2ODUyIDM2LjA2Mzk0NDIsMTcuNzM2Njg1MiAzNS4yNTMyMzczLDE4LjAyMTgwMDcgQzMzLjkwMjA1OTEsMTguNTI0OTQ1OCAzMy43MTEzMDQ1LDE4LjQ1Nzg1OTggMzQuMzc4OTQ1NSwxNy43MDMxNDIyIEMzNC44NzE3MjgxLDE3LjE2NjQ1NDEgMzUuNDU5ODg4LDE2LjE5MzcwNzEgMzUuNDU5ODg4LDE1LjkwODU5MTUgQzM1LjQ1OTg4OCwxNS44NTgyNzcgMzUuMjIxNDQ0OCwxNS45NDIxMzQ2IDM0Ljk1MTIwOTIsMTYuMDkzMDc4IEMzNC42NjUwNzczLDE2LjI2MDc5MzEgMzQuMDI5MjI4OCwxNi41MTIzNjU2IDMzLjU1MjM0MjQsMTYuNjYzMzA5MSBMMzIuNjkzOTQ2OSwxNi45NDg0MjQ2IEwzMS45MTUwMzI0LDE2LjM5NDk2NSBDMzEuNDg1ODM0NiwxNi4wOTMwNzggMzAuODgxNzc4NiwxNS43NTc2NDggMzAuNTYzODU0MywxNS42NTcwMTkgQzI5Ljc1MzE0NzQsMTUuNDIyMjE4IDI4LjUxMzI0MjgsMTUuNDU1NzYxIDI3Ljc4MjAxNjksMTUuNzI0MTA1IEMyNS43OTQ5OTAzLDE2LjQ3ODgyMjYgMjQuNTM5MTg5NCwxOC40MjQzMTY4IDI0LjY4MjI1NTQsMjAuNTU0Mjk3NSBDMjQuNjgyMjU1NCwyMC41NTQyOTc1IDI0LjUzOTE4OTQsMTguNDI0MzE2OCAyNC42ODIyNTU0LDIwLjU1NDI5NzUgWiBNMjQuNjgyMjU1NCwyMC41NTQyOTc1IiBpZD0iT3ZhbC0xIi8+PC9nPjwvZz48L3N2Zz4=">
                    </div><span class="form__span">{{ __('or use your email account') }}</span>
                    <span class="error-in text-danger text-bold" style="font-size: 14px;">
                        @if (session('error'))
                            {!! session('message') !!}
                        @endif
                    </span>
                    <span class="success-notice text-success text-bold" style="font-size: 14px;"></span>
                    {{-- Loading displayer --}}
                    <x-loading />
                    <div class="form-control d-inline-flex justify-content-center align-items-start flex-column"
                        style="width: auto; background-color: unset; border: none;">
                        <input id="email-in" name="email" class="form__input" type="text" placeholder="Email">
                        <span class="error-in-email text-danger" style="font-size: 14px;"></span>
                        <input id="pass-in" name="password" class="form__input" type="password" placeholder="Password">
                        <span class="error-in-password text-danger" style="font-size: 14px;"></span>
                        <div class="form-group mt-2 mb-0 remember-group">
                            <div class="form-check">
                                <input name="remember-in" class="form-check-input" style="margin-left: 0;" type="checkbox"
                                    id="remember-in">
                                <label class="form-check-label" for="remember-in" style="font-size: 14px; cursor: pointer;">
                                    {{__('Remember me')}}
                                </label>
                            </div>
                        </div>
                    </div>
        
                    {{-- Forgot password --}}
                    <div class="dropdown-container">
                        <ul>
                          <li class="dropdown">
                            <input id="control-dropdown" type="checkbox" />
                            <a href="#" class="form__link forgot-pass-displayer">{{ __('Forgot your password?') }}</a>
                            <ul class="dropdown-menu">
                              <li><a id="control-reset-pass" class="form__link mt-0" href="#">{{__('Get with password level 2')}}</a></li>
                              <li><a id="control-reset-pass-with-email" class="form__link mt-0" href="#">{{__('Use email to reset password')}}</a></li>
                            </ul>
                          </li>
                        </ul>
                      </div>
                    <a href="/" class="form__link" style="margin-top: 10px">{{ __('Back home') }}</a>
                    @csrf()
                    <button id="sign-in-btn" name="sign-in" class="form__button button submit" type="submit">{{ __('SIGN IN') }}</button>
                </form>
            </div>
            {{-- Sign up form --}}
            <div class="container b-container" id="b-container">
                <form class="form form-sign-up" id="a-form">
                    <h2 class="form_title title">{{ __('Create Account') }}</h2>
                    <div class="form__icons">
                        <a href="/auth/redirect/facebook">
                            <img class="form__icon"
                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSI1MHB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MCA1MCIgd2lkdGg9IjUwcHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZWZzLz48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIj48ZyBmaWxsPSIjMDAwMDAwIiBpZD0iRmFjZWJvb2siPjxwYXRoIGQ9Ik0yNSw1MCBDMzguODA3MTE5NCw1MCA1MCwzOC44MDcxMTk0IDUwLDI1IEM1MCwxMS4xOTI4ODA2IDM4LjgwNzExOTQsMCAyNSwwIEMxMS4xOTI4ODA2LDAgMCwxMS4xOTI4ODA2IDAsMjUgQzAsMzguODA3MTE5NCAxMS4xOTI4ODA2LDUwIDI1LDUwIFogTTI1LDQ3IEMzNy4xNTAyNjUxLDQ3IDQ3LDM3LjE1MDI2NTEgNDcsMjUgQzQ3LDEyLjg0OTczNDkgMzcuMTUwMjY1MSwzIDI1LDMgQzEyLjg0OTczNDksMyAzLDEyLjg0OTczNDkgMywyNSBDMywzNy4xNTAyNjUxIDEyLjg0OTczNDksNDcgMjUsNDcgWiBNMjYuODE0NTE5NywzNiBMMjYuODE0NTE5NywyNC45OTg3MTIgTDMwLjA2ODc0NDksMjQuOTk4NzEyIEwzMC41LDIxLjIwNzYwNzIgTDI2LjgxNDUxOTcsMjEuMjA3NjA3MiBMMjYuODIwMDQ4NiwxOS4zMTAxMjI3IEMyNi44MjAwNDg2LDE4LjMyMTM0NDIgMjYuOTIwNzIwOSwxNy43OTE1MzQxIDI4LjQ0MjU1MzgsMTcuNzkxNTM0MSBMMzAuNDc2OTYyOSwxNy43OTE1MzQxIEwzMC40NzY5NjI5LDE0IEwyNy4yMjIyNzY5LDE0IEMyMy4zMTI4NzU3LDE0IDIxLjkzNjg2NzgsMTUuODM5MDkzNyAyMS45MzY4Njc4LDE4LjkzMTg3MDkgTDIxLjkzNjg2NzgsMjEuMjA4MDM2NiBMMTkuNSwyMS4yMDgwMzY2IEwxOS41LDI0Ljk5OTE0MTMgTDIxLjkzNjg2NzgsMjQuOTk5MTQxMyBMMjEuOTM2ODY3OCwzNiBMMjYuODE0NTE5NywzNiBaIE0yNi44MTQ1MTk3LDM2IiBpZD0iT3ZhbC0xIi8+PC9nPjwvZz48L3N2Zz4="
                            alt="">
                        </a>
                        <img class="form__icon"
                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSI1MHB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MCA1MCIgd2lkdGg9IjUwcHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZWZzLz48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIj48ZyBmaWxsPSIjMDAwMDAwIiBpZD0iTGlua2VkSW4iPjxwYXRoIGQ9Ik0yNSw1MCBDMzguODA3MTE5NCw1MCA1MCwzOC44MDcxMTk0IDUwLDI1IEM1MCwxMS4xOTI4ODA2IDM4LjgwNzExOTQsMCAyNSwwIEMxMS4xOTI4ODA2LDAgMCwxMS4xOTI4ODA2IDAsMjUgQzAsMzguODA3MTE5NCAxMS4xOTI4ODA2LDUwIDI1LDUwIFogTTI1LDQ3IEMzNy4xNTAyNjUxLDQ3IDQ3LDM3LjE1MDI2NTEgNDcsMjUgQzQ3LDEyLjg0OTczNDkgMzcuMTUwMjY1MSwzIDI1LDMgQzEyLjg0OTczNDksMyAzLDEyLjg0OTczNDkgMywyNSBDMywzNy4xNTAyNjUxIDEyLjg0OTczNDksNDcgMjUsNDcgWiBNMTQsMjAuMTE4MDQ3OSBMMTQsMzQuNjU4MTgzNCBMMTguNzEwMDg1MSwzNC42NTgxODM0IEwxOC43MTAwODUxLDIwLjExODA0NzkgTDE0LDIwLjExODA0NzkgWiBNMTYuNjY0Njk2MiwxMyBDMTUuMDUzNDA1OCwxMyAxNCwxNC4wODU4NjExIDE0LDE1LjUxMTUxMjIgQzE0LDE2LjkwNzYzMzEgMTUuMDIyMjcxMSwxOC4wMjQ3NjE0IDE2LjYwMzU1NTYsMTguMDI0NzYxNCBMMTYuNjMzNjU1NiwxOC4wMjQ3NjE0IEMxOC4yNzU5ODY3LDE4LjAyNDc2MTQgMTkuMjk4ODIyMiwxNi45MDc2MzMxIDE5LjI5ODgyMjIsMTUuNTExNTEyMiBDMTkuMjY4MjUxOSwxNC4wODU4NjExIDE4LjI3NTk4NjcsMTMgMTYuNjY0Njk2MiwxMyBaIE0zMC41NzY5MjEzLDIwLjExODA0NzkgQzI4LjA3NjE3NiwyMC4xMTgwNDc5IDI2Ljk1NjU1MDEsMjEuNTI5MzE5OSAyNi4zMzE0MTA4LDIyLjUxOTM1MjcgTDI2LjMzMTQxMDgsMjAuNDU5ODY0NCBMMjEuNjIwNzYxNCwyMC40NTk4NjQ0IEMyMS42ODI4NDI3LDIxLjgyNDIzNTYgMjEuNjIwNzYxNCwzNSAyMS42MjA3NjE0LDM1IEwyNi4zMzE0MTA4LDM1IEwyNi4zMzE0MTA4LDI2Ljg3OTU4ODcgQzI2LjMzMTQxMDgsMjYuNDQ1MDMyIDI2LjM2MTk4MTIsMjYuMDExNTM2OCAyNi40ODY1MTk5LDI1LjcwMDQwODQgQzI2LjgyNjkzMiwyNC44MzIyNiAyNy42MDIwMDY5LDIzLjkzMzQyMzMgMjguOTAzMjY3NCwyMy45MzM0MjMzIEMzMC42MDgzMzgxLDIzLjkzMzQyMzMgMzEuMjg5OTE0OSwyNS4yNjY3MjAyIDMxLjI4OTkxNDksMjcuMjIwNjMzMyBMMzEuMjg5OTE0OSwzNC45OTk2MTQgTDM1Ljk5OTgxMTksMzQuOTk5NjE0IEwzNiwyNi42NjI3NDQ2IEMzNiwyMi4xOTY2NDM5IDMzLjY3NjM3NDMsMjAuMTE4MDQ3OSAzMC41NzY5MjEzLDIwLjExODA0NzkgWiBNMzAuNTc2OTIxMywyMC4xMTgwNDc5IiBpZD0iT3ZhbC0xIi8+PC9nPjwvZz48L3N2Zz4=">
                        <img
                            class="form__icon"
                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSI1MHB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA1MCA1MCIgd2lkdGg9IjUwcHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZWZzLz48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIj48ZyBmaWxsPSIjMDAwMDAwIiBpZD0iVHdpdHRlciI+PHBhdGggZD0iTTI1LDUwIEMzOC44MDcxMTk0LDUwIDUwLDM4LjgwNzExOTQgNTAsMjUgQzUwLDExLjE5Mjg4MDYgMzguODA3MTE5NCwwIDI1LDAgQzExLjE5Mjg4MDYsMCAwLDExLjE5Mjg4MDYgMCwyNSBDMCwzOC44MDcxMTk0IDExLjE5Mjg4MDYsNTAgMjUsNTAgWiBNMjUsNDcgQzM3LjE1MDI2NTEsNDcgNDcsMzcuMTUwMjY1MSA0NywyNSBDNDcsMTIuODQ5NzM0OSAzNy4xNTAyNjUxLDMgMjUsMyBDMTIuODQ5NzM0OSwzIDMsMTIuODQ5NzM0OSAzLDI1IEMzLDM3LjE1MDI2NTEgMTIuODQ5NzM0OSw0NyAyNSw0NyBaIE0yNC42ODIyNTU0LDIwLjU1NDI5NzUgTDI0LjcyOTk0NCwyMS4zNzYxMDExIEwyMy45MzUxMzMzLDIxLjI3NTQ3MjEgQzIxLjA0MjAyMjUsMjAuODg5NzI3NSAxOC41MTQ1MjQ2LDE5LjU4MTU1MDQgMTYuMzY4NTM1OCwxNy4zODQ0ODM3IEwxNS4zMTkzODU3LDE2LjI5NDMzNjEgTDE1LjA0OTE1MDEsMTcuMDk5MzY4MSBDMTQuNDc2ODg2NCwxOC44OTM5MTg4IDE0Ljg0MjQ5OTMsMjAuNzg5MDk4NSAxNi4wMzQ3MTUzLDIyLjA2MzczMjYgQzE2LjY3MDU2MzgsMjIuNzY4MTM1NyAxNi41Mjc0OTc5LDIyLjg2ODc2NDcgMTUuNDMwNjU5MiwyMi40NDk0NzcyIEMxNS4wNDkxNTAxLDIyLjMxNTMwNTEgMTQuNzE1MzI5NiwyMi4yMTQ2NzYxIDE0LjY4MzUzNzEsMjIuMjY0OTkwNyBDMTQuNTcyMjYzNywyMi4zODIzOTEyIDE0Ljk1Mzc3MjgsMjMuOTA4NTk3OCAxNS4yNTU4MDA4LDI0LjUxMjM3MTkgQzE1LjY2OTEwMjQsMjUuMzUwOTQ3IDE2LjUxMTYwMTcsMjYuMTcyNzUwNSAxNy40MzM1ODIsMjYuNjU5MTI0MSBMMTguMjEyNDk2NSwyNy4wNDQ4Njg2IEwxNy4yOTA1MTYxLDI3LjA2MTY0MDEgQzE2LjQwMDMyODIsMjcuMDYxNjQwMSAxNi4zNjg1MzU4LDI3LjA3ODQxMTYgMTYuNDYzOTEzMSwyNy40MzA2MTMxIEMxNi43ODE4Mzc0LDI4LjUyMDc2MDggMTguMDM3NjM4MiwyOS42Nzc5OTQ0IDE5LjQzNjUwNSwzMC4xODExMzk0IEwyMC40MjIwNzAxLDMwLjUzMzM0MSBMMTkuNTYzNjc0NiwzMS4wNzAwMjkgQzE4LjI5MTk3NzYsMzEuODQxNTE4MSAxNi43OTc3MzM1LDMyLjI3NzU3NzIgMTUuMzAzNDg5NSwzMi4zMTExMjAyIEMxNC41ODgxNTk5LDMyLjMyNzg5MTYgMTQsMzIuMzk0OTc3NiAxNCwzMi40NDUyOTIyIEMxNCwzMi42MTMwMDcxIDE1LjkzOTMzOCwzMy41NTIyMTEzIDE3LjA2Nzk2OTIsMzMuOTIxMTg0MyBDMjAuNDUzODYyNiwzNS4wMTEzMzE5IDI0LjQ3NTYwNDYsMzQuNTQxNzI5OCAyNy40OTU4ODUxLDMyLjY4MDA5MzIgQzI5LjY0MTg3MzksMzEuMzU1MTQ0NSAzMS43ODc4NjI4LDI4LjcyMjAxODggMzIuNzg5MzI0MiwyNi4xNzI3NTA1IEMzMy4zMjk3OTU0LDI0LjgxNDI1ODkgMzMuODcwMjY2NywyMi4zMzIwNzY3IDMzLjg3MDI2NjcsMjEuMTQxMyBDMzMuODcwMjY2NywyMC4zNjk4MTEgMzMuOTE3OTU1MywyMC4yNjkxODIgMzQuODA4MTQzMiwxOS4zNDY3NDk0IEMzNS4zMzI3MTgzLDE4LjgxMDA2MTMgMzUuODI1NTAwOSwxOC4yMjMwNTg4IDM1LjkyMDg3ODIsMTguMDU1MzQzNyBDMzYuMDc5ODQwMywxNy43MzY2ODUyIDM2LjA2Mzk0NDIsMTcuNzM2Njg1MiAzNS4yNTMyMzczLDE4LjAyMTgwMDcgQzMzLjkwMjA1OTEsMTguNTI0OTQ1OCAzMy43MTEzMDQ1LDE4LjQ1Nzg1OTggMzQuMzc4OTQ1NSwxNy43MDMxNDIyIEMzNC44NzE3MjgxLDE3LjE2NjQ1NDEgMzUuNDU5ODg4LDE2LjE5MzcwNzEgMzUuNDU5ODg4LDE1LjkwODU5MTUgQzM1LjQ1OTg4OCwxNS44NTgyNzcgMzUuMjIxNDQ0OCwxNS45NDIxMzQ2IDM0Ljk1MTIwOTIsMTYuMDkzMDc4IEMzNC42NjUwNzczLDE2LjI2MDc5MzEgMzQuMDI5MjI4OCwxNi41MTIzNjU2IDMzLjU1MjM0MjQsMTYuNjYzMzA5MSBMMzIuNjkzOTQ2OSwxNi45NDg0MjQ2IEwzMS45MTUwMzI0LDE2LjM5NDk2NSBDMzEuNDg1ODM0NiwxNi4wOTMwNzggMzAuODgxNzc4NiwxNS43NTc2NDggMzAuNTYzODU0MywxNS42NTcwMTkgQzI5Ljc1MzE0NzQsMTUuNDIyMjE4IDI4LjUxMzI0MjgsMTUuNDU1NzYxIDI3Ljc4MjAxNjksMTUuNzI0MTA1IEMyNS43OTQ5OTAzLDE2LjQ3ODgyMjYgMjQuNTM5MTg5NCwxOC40MjQzMTY4IDI0LjY4MjI1NTQsMjAuNTU0Mjk3NSBDMjQuNjgyMjU1NCwyMC41NTQyOTc1IDI0LjUzOTE4OTQsMTguNDI0MzE2OCAyNC42ODIyNTU0LDIwLjU1NDI5NzUgWiBNMjQuNjgyMjU1NCwyMC41NTQyOTc1IiBpZD0iT3ZhbC0xIi8+PC9nPjwvZz48L3N2Zz4=">
                    </div>
                            <span class="form__span">{{__('or use email for registration')}}</span>
                            {{-- Error displayer --}}
                            <span class="error-up-common text-danger text-bold" style="font-size: 14px;"></span>
                            {{-- Notice displayer --}}
                            <span class="notice-up-common text-success text-bold" style="font-size: 14px;"></span>
                            {{-- Loading displayer --}}
                            <x-loading />
                            <div class="form-control d-inline-flex justify-content-center align-items-start flex-column"
                                style="width: auto; background-color: unset; border: none;">
                                <input id="name-up" name="name" class="form__input" type="text" placeholder="Name">
                                <span class="error-up-name text-danger" style="font-size: 14px;"></span>
                                <input id="email-up" name="email" class="form__input" type="text" placeholder="Email">
                                <span class="error-up-email text-danger" style="font-size: 14px;"></span>
                                <input id="phone-up" name="phone" class="form__input" type="text" placeholder="Phone">
                                <span class="error-up-phone text-danger" style="font-size: 14px;"></span>
                                <input id="pass-up" name="password" class="form__input" type="password" placeholder="Password">
                                <span class="error-up-password text-danger" style="font-size: 14px;"></span>
                                <input id="repass-up" name="repeat-password" class="form__input" type="password"
                                    placeholder="Repeat password">
                                <span class="error-up-repeat-password text-danger" style="font-size: 14px;"></span>
                                <div class="form-group mt-2">
                                    <div class="form-check">
                                        <input name="remember-up" class="form-check-input" style="margin-left: 0;" type="checkbox"
                                            id="remember-up">
                                        <label class="form-check-label" for="remember-up" style="font-size: 14px; cursor: pointer;">
                                            {{__('Remember me')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @csrf()
                            <button name="sign-up" class="form__button button submit">{{ __('SIGN UP') }}</button>
                </form>
            </div>
            {{-- Switch --}}
            <div class="switch" id="switch-cnt">
                <div class="switch__circle"></div>
                <div class="switch__circle switch__circle--t"></div>
                <div class="switch__container is-hidden" id="switch-c2">
                    <h2 class="switch__title title">{{ __('Hello Friend !') }}</h2>
                    <p class="switch__description description">{{ __('Enter your personal details and start journey with us') }}
                    </p>
                    <button class="switch__button button switch-btn">{{ __('SIGN IN') }}</button>
                </div>
                <div class="switch__container" id="switch-c1">
                    <h2 class="switch__title title">{{ __('Welcome Back !') }}</h2>
                    <p class="switch__description description">
                        {{ __('To keep connected with us please login with your personal info') }}</p>
                    <button class="switch__button button switch-btn">{{ __('SIGN UP') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        function resetPassDisplayer() {
            $('#signin-form-title').text('Reset password');
            $('#sign-in-btn').attr('name', 'reset-password-btn');
            $('#sign-in-btn').text('RESET PASSWORD');
            $('#control-dropdown').prop('checked', false);

            $('.forgot-pass-displayer').text('Login');
            $('.forgot-pass-displayer').attr('href', '/sign');
            $('#control-dropdown').css('display', 'none');
            $('.remember-group').css('display', 'none');
        }

        function displayHandler() {
            let switchCtn = document.querySelector("#switch-cnt");
            let switchC1 = document.querySelector("#switch-c1");
            let switchC2 = document.querySelector("#switch-c2");
            let switchCircle = document.querySelectorAll(".switch__circle");
            let switchBtn = document.querySelectorAll(".switch-btn");
            let aContainer = document.querySelector("#a-container");
            let bContainer = document.querySelector("#b-container");
            let allButtons = document.querySelectorAll(".submit");

            let getButtons = (e) => e.preventDefault()
            let changeForm = (e) => {

                switchCtn.classList.add("is-gx");
                setTimeout(function() {
                    switchCtn.classList.remove("is-gx");
                }, 1500)

                switchCtn.classList.toggle("is-txr");
                switchCircle[0].classList.toggle("is-txr");
                switchCircle[1].classList.toggle("is-txr");

                switchC1.classList.toggle("is-hidden");
                switchC2.classList.toggle("is-hidden");
                aContainer.classList.toggle("is-txl");
                bContainer.classList.toggle("is-txl");
                bContainer.classList.toggle("is-z200");
            }

            for (var i = 0; i < switchBtn.length; i++) {
                switchBtn[i].addEventListener("click", changeForm);
            }

            $('#control-reset-pass').click(resetPassDisplayer);
            $('#control-reset-pass-with-email').click(function () {
                $('#pass-in').css('display', 'none');
                resetPassDisplayer();
                $('#sign-in-btn').attr('name', 'reset-password-with-email-btn');
            });
        }
        
        function loginHandler() {
            $('.loader').addClass('active');
            $.ajax({
                type: "POST",
                url: "/sign/sign-in",
                data: {
                    email: $('#email-in').val(),
                    password: $('#pass-in').val(),
                    remember: $('#remember-in').val(),
                },
                success: function(result) {
                    if (result.email) {
                        location.href = '/email/verification-notification';
                        
                    } else if (result.error) {
                        $('.error-in').text(result.message);
                        $('.loader').removeClass('active');
                        
                    } else {
                            location.href = "/";
                        }
                },
                error: function(err) {
                    if (err.status == 422) {
                        const errors = err.responseJSON.errors;
                        $('.error-in').text('Please check your information again!');
                        $('.error-in-email').text(errors.email);
                        $('.error-in-password').text(errors.password);
                        $('.loader').removeClass('active');
                    }
                }
            });
        }
            
        function resetPassHandler() {
            $('.loader').addClass('active');
            $.ajax({
                type: "POST",
                url: "/password/reset",
                data: {
                    email: $('#email-in').val(),
                    password: $('#pass-in').val(),
                },
                success: function(result) {
                    if (!result.error) {
                        location.href = '/profile/change-password.html';
                    } else {
                        $('.error-in').text('Email or password level 2 is incorrect!');
                        $('.loader').removeClass('active');
                    } 
                },
                error: function(err) {
                    if (err.status == 422) {
                        const errors = err.responseJSON.errors;
                        $('.error-in').text('Please check your information again!');
                        $('.error-in-email').text(errors.email);
                        $('.error-in-password').text(errors.password);
                        $('.loader').removeClass('active');
                    }
                }
            });             
        }

        function loginAndResetPassHandler() {
            const controlButton = $('#form-sign-reset-pass button[type="submit"]');
            controlButton.click(function(e) {
                e.preventDefault();
                if(controlButton.attr('name') == 'sign-in') {
                    loginHandler();
                } else if(controlButton.attr('name') == 'reset-password-btn'){
                    resetPassHandler();
                } else {
                    resetPassWithEmail();
                }
            });
        }

        function signupHandler() {
            $('.form-sign-up').on('submit', function(e) {
                e.preventDefault();
                $('.loader').addClass('active');
                $.ajax({
                    type: "POST",
                    url: "/sign/sign-up",
                    data: {
                        name: $('#name-up').val(),
                        email: $('#email-up').val(),
                        phone: $('#phone-up').val(),
                        address: $('#address-up').val(),
                        password: $('#pass-up').val(),
                        'repeat-password': $('#repass-up').val(),
                        remember: $('#remember-up').val(),
                    },
                    success: function(result) {
                        if (result.error) {
                            $('.error-up-common').text('Please check your informations again!');
                            $('.notice-up-common').text('');
                        } else {
                            $('.error-up-common').text('');
                            $('span[class*="error-up-"]').text('');
                            $('.notice-up-common').html(
                                'Create new account successfully. Please confirm <b>' + $(
                                    '#email-up').val() + '</b> to access your account!');
                            $('.loader').removeClass('active');
                        }
                    },
                    error: function(err) {
                        $('.notice-up-common').text('');
                        if (err.status == 422) {
                            $('.error-up-common').text('Please check your informations again!');
                            const errors = err.responseJSON.errors;
                            for (const key in errors) {
                                const errorMessage = errors[key][0];
                                $('span.error-up-' + key).text(errorMessage);
                            }
                            $('.loader').removeClass('active');
                        }
                    }
                });
            })
        }

        function resetPassWithEmail() {
            $('.loader').addClass('active');
            $('.success-notice').text("");
            $('.error-in').text("");
            $.ajax({
                type: "POST",
                url: "password/forgot",
                data: {
                    email: $('#email-in').val()
                },
                success: function(result) {
                    if (result.status) {
                        $('.success-notice').text(result.status);
                    } else {
                        $('.error-in').text("Email is error, Please try again!");
                    } 
                    $('.loader').removeClass('active');
                },
                error: function(err) {
                    if (err.status == 422) {
                        const errors = err.responseJSON.errors;
                        $('.error-in').text('Please check your information again!');
                        $('.error-in-email').text(errors.email);
                        $('.loader').removeClass('active');
                    }
                }
            });   
        }

        $(document).ready(function() {
            displayHandler();
            loginAndResetPassHandler();
            signupHandler();
        });
    </script>
@endsection
