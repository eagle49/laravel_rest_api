<!DOCTYPE html>
<style>
    a.btn {
        background-color: #039be5;
        border-radius: 4px;
        padding: 8px 20px;
        box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
        color: white;
        font-size: 20px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        margin-bottom: 25px;
        display: inline-block;
    }
</style>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body style="background-color: #EEE;">
        <h2>Verify Your Email Address</h2>
        <div class="maincontent" style="background-color: #FFF; margin: auto; padding: 20px; width: 450px; border-top: 2px solid #27ae60;">
            <div class="text-center">
                <h3>Hi {{ $name }}.</h3>
                <p>Thanks for creating an account with Taskdone.</p>
                <p>Please follow the below link to verify your email address</p>
                <a class="btn btn-success btn-lg" href="{{ $url }}"><i class="fa fa-check">Confirm Email Address</a><br/>
                If you need help or have any question, please visit https://taskdone.ca<br>
                Thanks<br>
                Taskdone Support
            </div>
        </div>
    </body>
</html>