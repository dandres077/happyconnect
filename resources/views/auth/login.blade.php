<!DOCTYPE html>

<html lang="es">

    <!-- begin::Head -->
    <head>
        <base href="../../../">
        <meta charset="utf-8" />
        <title>Login - TConecta.co</title>
        <meta name="description" content="Sistema para la administraci&oacute;n de propiedad horizontal">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Etiquetas Open Graph -->
        <meta property="og:title" content="TConecta.co">
        <meta property="og:description" content="TConecta.co: Tu puente hacia el éxito académico y la comunicación efectiva. Una innovadora plataforma que acerca a padres y colegios, permitiendo una gestión integral de las actividades de los hijos.">
        <meta property="og:image" content="{{asset('img/icons/icon-192x192.png')}}">
        <meta property="og:url" content="https://tconecta.idaves.com/">
        <meta property="og:type" content="website">

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
        <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.png')}}" />

        <link rel="manifest" href="{{asset('manifest.json')}}">

        <!-- ANDROID-->
        <meta name="theme-color" content="#FE192F">

        <!-- IOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_14_Pro_Max_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_14_Pro_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_11_Pro_Max__iPhone_XS_Max_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_11__iPhone_XR_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/4__iPhone_SE__iPod_touch_5th_generation_and_later_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/12.9__iPad_Pro_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/11__iPad_Pro__10.5__iPad_Pro_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/10.9__iPad_Air_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/10.5__iPad_Air_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/10.2__iPad_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="{{asset('img/icons-ios/8.3__iPad_Mini_landscape.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_14_Pro_Max_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_14_Pro_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_11_Pro_Max__iPhone_XS_Max_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_11__iPhone_XR_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/4__iPhone_SE__iPod_touch_5th_generation_and_later_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/12.9__iPad_Pro_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/11__iPad_Pro__10.5__iPad_Pro_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/10.9__iPad_Air_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/10.5__iPad_Air_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/10.2__iPad_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_portrait.png')}}">
        <link rel="apple-touch-startup-image" media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="{{asset('img/icons-ios/8.3__iPad_Mini_portrait.png')}}">

        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <meta name="apple-mobile-web-app-title" content="TConecta">
        
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

        <script>
          if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
              navigator.serviceWorker.register('sw.js')
                .then(registration => {
                  console.log('Service Worker registrado con éxito:', registration);
                })
                .catch(error => {
                  console.error('Error al registrar el Service Worker:', error);
                });
            });
          }
        </script>

    </body>

    <!-- end::Body -->
</html>