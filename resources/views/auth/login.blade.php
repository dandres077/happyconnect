<!DOCTYPE html>

<html lang="es">

    <!-- begin::Head -->
    <head>
        <base href="../../../">
        <meta charset="utf-8" />
        <title>@yield('title', 'Login')</title>
        <meta name="description" content="Sistema para la administraci&oacute;n de propiedad horizontal">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="Sistema para la administraci&oacute;n de propiedad horizontal" />
        <meta name="twitter:description" content="Sistema para la administraci&oacute;n de propiedad horizontal" />
        <meta name="twitter:image" content="https://horizontal.idaves.com/assets/media/logos/logo-5.png" />
        <meta name="twitter:image:alt" content="Sistema para la administraci&oacute;n de propiedad horizontal" />

        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">

        <!--end::Fonts -->

        <!--begin::Page Custom Styles(used by this page) -->
        <link href="{{asset('assets/css/pages/login/login-3.css')}}" rel="stylesheet" type="text/css" />

        <!--end::Page Custom Styles -->

        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

        <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->

        <!--end::Layout Skins -->
        <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
        
    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

        <!-- begin:: Page -->
        <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{asset('assets/media/bg/bg-3.jpg')}});">
                    <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                        <div class="kt-login__container">
                            <div class="kt-login__logo">
                                <a href="#">
                                    <img src="{{asset('assets/media/logos/logo-5.png')}}">
                                </a>
                            </div>
                            <div class="kt-login__signin">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Autenticarse</h3>
                                </div>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="alert alert-success fade show" role="alert">
                                            <div class="alert-icon"><i class="flaticon-like"></i></div>
                                            <div class="alert-text">{{ session('success') }}</div>
                                            <div class="alert-close">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    @if (session('danger'))
                                        <div class="alert alert-success fade show" role="alert">
                                            <div class="alert-icon"><i class="flaticon-like"></i></div>
                                            <div class="alert-text">{{ session('danger') }}</div>
                                            <div class="alert-close">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    <form method="POST" class="kt-form" action="{{ route('login') }}" autocomplete="off">
                                    @csrf
                                    @if ($errors->has('login'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                                    @endif
                                    <div class="input-group">
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="Email" id="email" name="email" autocomplete="off" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <div class="input-group">
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Password" name="password" id="password" required>
                                    </div>
                                    <div class="row kt-login__extra">
                                        <div class="col kt-align-right">
                                            <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">¿Olvidaste tu contrase&ntilde;a?</a>
                                        </div>
                                    </div>
                                    <div class="kt-login__actions">
                                        <button class="btn btn-brand btn-elevate kt-login__btn-primary" type="submit">Ingresar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="kt-login__forgot">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">¿Olvidaste tu contrase&ntilde;a?</h3>
                                    <div class="kt-login__desc">Ingresa tu correo electrónico para recuperarla:</div>
                                </div>
                                <form class="kt-form" action="{{ url ('usuarios/recuperar_pwd')}}" method="post">
                                    {{ csrf_field()}}
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                                    </div>
                                    <div class="kt-login__actions">
                                        <button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Enviar</button>&nbsp;&nbsp;
                                        <button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="kt-login__account">
                                <span class="kt-login__account-msg">
                                    ¿Eres un comercio y no tienes una cuenta?
                                </span>
                                &nbsp;&nbsp;
                                <a href="{{ url ('comercios/registro')}}" class="kt-login__account-link">¡Créala, es gratis!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Page -->

        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#5d78ff",
                        "light": "#ffffff",
                        "dark": "#282a3c",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };
        </script>

        <!-- end::Global Config -->

        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>

        <!--end::Global Theme Bundle -->

        <!--begin::Page Scripts(used by this page) -->
        <script src="{{asset('assets/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>

        <!--end::Page Scripts -->
    </body>

    <!-- end::Body -->
</html>