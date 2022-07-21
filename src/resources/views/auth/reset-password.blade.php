<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Sign Up Form')}}</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <style>
        *,
        *:before,
        *:after {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            color: #384047;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            min-width: 500px;
            margin: 10px auto;
            padding: 10px 20px;
            background: #f4f7f8;
            border-radius: 8px;
        }

        h1 {
            margin: 0 0 30px 0;
            text-align: center;
        }

        input[type="password"],
        input[type="email"] {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            font-size: 16px;
            height: auto;
            margin: 0;
            outline: 0;
            padding: 15px;
            width: 100%;
            background-color: #e8eeef;
            color: #8a97a0;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
        }

        button {
            padding: 19px 39px 18px 39px;
            color: #FFF;
            background-color: #4bc970;
            font-size: 18px;
            text-align: center;
            font-style: normal;
            border-radius: 5px;
            width: 100%;
            border: 1px solid #3ac162;
            border-width: 1px 1px 3px;
            box-shadow: 0 -1px 0 rgba(255, 255, 255, 0.1) inset;
            margin-bottom: 10px;
            cursor: pointer;
        }

        fieldset {
            margin-bottom: 30px;
            border: none;
        }

        legend {
            font-size: 1.4em;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            margin-top: 30px;
        }

        label.light {
            font-weight: 300;
            display: inline;
        }

        @media screen and (min-width: 480px) {

            form {
                max-width: 480px;
            }

        }

        .error-group > *{
            color: red;
            font-size: 14px;
            margin: 0;
        }

    </style>
</head>

<body>
    <form action="" method="POST">

        <h1>{{__('Reset password')}}</h1>
        <p style="text-align: center; color: red; font-size: 16px;">@if($errors->any()){{$errors->first('email')}}@endif</p>

        <fieldset>
            <label for="mail">{{__('Email')}}:</label>
            <input type="email" id="mail" name="email">
            <div class="error-group">
                <x-display-error name-input="email"/>
            </div>

            <label for="password">{{__('Password')}}:</label>
            <input type="password" id="password" name="password">
            <div class="error-group">
                <x-display-error name-input="password"/>
            </div>

            <label for="password_confirmation ">{{__('Confirm Password')}}:</label>
            <input type="password" id="password_confirmation " name="password_confirmation">
            <div class="error-group">
                <x-display-error name-input="password_confirmation"/>
            </div>

            <input type="hidden" name="token" @if(isset($token))value={{$token}}@endif>
            @csrf
        </fieldset>

        <button type="submit">{{__('Reset')}}</button>
    </form>

</body>

</html>
