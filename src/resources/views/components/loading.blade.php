<style>
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    body {
        padding: 0;
        background: #f5f5f5;
    }

    @-webkit-keyframes initial-loading {
        0%,
        100% {
            transform: translate(-34px, 0);
        }

        50% {
            transform: translate(96px, 0);
        }
    }

    @keyframes initial-loading {

        0%,
        100% {
            transform: translate(-34px, 0);
        }

        50% {
            transform: translate(96px, 0);
        }
    }

    .initial-load-animation {
        width: 200px;
        margin: 0 auto;
        transform: scale(1);
        transition: transform 0.5s ease;
    }

    .initial-load-animation .loading-bar {
        width: 130px;
        height: 2px;
        margin: 0 auto;
        border-radius: 2px;
        background-color: #cfcfcf;
        position: relative;
        overflow: hidden;
        z-index: 1;
        transform: rotateY(0);
        transition: transform 0.3s ease-in;
    }

    .initial-load-animation .loading-bar .blue-bar {
        height: 100%;
        width: 68px;
        position: absolute;
        transform: translate(-34px, 0);
        background-color: #0073b1;
        border-radius: 2px;
        -webkit-animation: initial-loading 1.5s infinite ease;
        animation: initial-loading 1.5s infinite ease;
    }

    .loader {
        display: none;
    }
    .loader.active {
        display: block;
    }

</style>
<div class="loader initial-load-animation"> 
    <div class="loading-bar">
        <div class="blue-bar"></div>
    </div>
</div>