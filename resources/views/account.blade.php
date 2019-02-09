@extends('layouts.app')

@section('title') Home @endsection

@section('site') CodeMaster @endsection

@section('template')

<style>
    .form-control:focus,
    .form-control:hover {
        border-bottom-width: 2px;
    }

    form .form-group:last-of-type {
        margin-bottom: 0;
    }

    .alert>p {
        margin-bottom: 0;
    }

    .card {
        margin-bottom: 20vh;
        overflow: hidden;
        display: block;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        border-radius: 4px;
        transition: .2s ease-out .0s;
        color: #7a8e97;
        background: #fff;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.15);
    }

    .card .card-header {
        padding: 0;
    }

    .card .card-header>ul {
        margin: 0;
    }

    .card .card-header>ul .nav-link {
        padding: 1rem;
        border: none!important;
    }

    .card .card-header .nav-tabs .nav-link.active {
        color: #ff4081;
    }

    .nav-tabs-material .nav-tabs-indicator {
        background-color: #ff4081;
        bottom: -1px;
        display: block;
        width: 50%;
        height: .15rem;
        position: absolute;
        transition: .2s ease-out .0s;
    }

    #accountTab {
        position: relative;
    }

    .card-footer {
        border: none;
    }

    .checkbox {
        margin-top: 1rem;
    }

    form {
        margin-bottom: 0;
    }

    input {
        box-shadow: none!important;
    }

    .was-validated input[type="checkbox"].form-control:invalid+span+span {
        color: #f44336!important;
    }

    label[for="agreement"] {
        display: inline-block;
    }

    canvas#atsast-background-canvas {
        position: fixed;
        z-index: -1;
        top: 0;
    }
</style>
<!-- <canvas id="atsast-background-canvas"></canvas> -->
<div class="container mundb-standard-container">
    <div class="row justify-content-sm-center">
        <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="text-center" style="margin-top:10vh;margin-bottom:20px;">
                <h1 style="padding:20px;display:inline-block;">CodeMaster</h1>
                <p>CodeMaster's yet another Virtual Judge</p>
                <div class="alert alert-primary text-left" role="alert">
                    CodeMaster is still under alpha version, you can create new issues <a href="https://github.com/ZsgsDesign/CodeMaster/issues">here</a>.
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs nav-justified nav-tabs-material" id="accountTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">register</a>
                        </li>
                        <div class="nav-tabs-indicator" id="nav-tabs-indicator" style="left: 0px;"></div>
                    </ul>
                </div>
                <div class="tab-content" id="accountTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form class="needs-validation" action="?action=login" method="post" id="login_form" novalidate>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email" class="bmd-label-floating">Email</label>
                                    <input type="email" name="email" class="form-control" id="login_email" required>
                                    <div class="invalid-feedback">Please fill in your email</div>
                                    <span class="bmd-help">Only available for NJUPT email system only</span>
                                    <span class="bmd-help">e.g. Q17010217@njupt.edu.cn</span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="bmd-label-floating">Password</label>
                                    <input type="password" name="password" class="form-control" id="login_password" required>
                                    <div class="invalid-feedback">Please fill in your password</div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="https://mundb.xyz/account/retrieve"><button type="button" class="btn btn-secondary">Forget your password?</button></a>
                                <button type="submit" class="btn btn-danger">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade " id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form class="needs-validation" action="?action=register" method="post" id="register_form" novalidate>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email" class="bmd-label-floating">Your email</label>
                                    <input type="email" name="email" class="form-control" id="register_email" required>
                                    <div class="invalid-feedback">Please fill in your email</div>
                                    <span class="bmd-help">Only available for NJUPT email system only</span>
                                    <span class="bmd-help">e.g. Q17010217@njupt.edu.cn</span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="bmd-label-floating">Set your password</label>
                                    <input type="password" name="password" class="form-control" id="register_password" required>
                                    <div class="invalid-feedback">Please fill in your password</div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="agreement"><input class="form-control" type="checkbox" name="agreement" id="agreement" required><span>I agree with the terms</span></label>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-danger">register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://cdn.mundb.xyz/js/atsast.canvas.background.js"></script> -->
<script>
    window.addEventListener("load",function() {
        $('#login-tab').on('click', function (e) {
            e.preventDefault();
            $('#nav-tabs-indicator').css("left", "0px");
        })
        $('#register-tab').on('click', function (e) {
            e.preventDefault();
            $('#nav-tabs-indicator').css("left", "50%");
        })

        $('input:-webkit-autofill').each(function(){
            if ($(this).val().length !== "") {
                console.log($(this).siblings('label'));
                $(this).siblings('label').addClass('active');
                $(this).parent().addClass('is-filled');
            }
        });

        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

        }, false);

    }, false);

</script>

@endsection