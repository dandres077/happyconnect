<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="es">

	<!-- begin::Head -->
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		<title>Horizontal APP | Recuperar contraseña</title>
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
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{asset('assets/media/bg/bg-3.jpg')}});">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="{{asset('assets/media/logos/logo-5.png')}}">
								</a>
							</div>
							<div class="kt-login__signup">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Actualización</h3>
									<div class="kt-login__desc">Ingresa tu nueva contraseña:</div>
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
								<form onsubmit="return validar()" class="kt-form" action="{{ url('/usuarios/nueva_pwd')}}" autocomplete="off" method="post">
								{{ csrf_field()}}
                                        <input type="hidden" name="token" value="{{ $token }}" required>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" id="password" name="password" value="{{ old('password') }}" required>
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Confirm Password" id="confirmPassword" name="password_confirmation" id="password_confirmation" required>
									</div>									
									<div class="kt-login__actions">
										<button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Cambiar</button>&nbsp;&nbsp;
										<a href="{{ url ('login')}}" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancelar</a>
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
		
		<script>
			function validar() 
			{
			    var password = document.getElementById("password").value;
			    var confirmPassword = document.getElementById("confirmPassword").value;

			    if (password != confirmPassword) {
			        alert("Las contraseñas no coinciden");
			        return false;
			    }
			    return true;
			}

		</script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>