@extends('layouts.app')

@section('title',  $titulo  .' | '.config('app.name'))

@section('style')

@endsection

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Dashboard </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                {{ $titulo }}</a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

	<!--Begin::App-->
	<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

		<!--Begin:: App Aside Mobile Toggle-->
		<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
			<i class="la la-close"></i>
		</button>

		<!--End:: App Aside Mobile Toggle-->

		<!--Begin:: App Content-->
		<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
			<div class="row">
				<div class="col-xl-12">

					<!--begin:: Widgets/Tasks -->
					<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">
									{{ $titulo }}
								</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab1_content" role="tab" aria-selected="true">
											Información general
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="tab-content">
								@foreach ($data as $info)
								<div class="tab-pane active" id="kt_widget2_tab1_content">
									<div class="kt-widget2">
										<div class="kt-widget2__item kt-widget2__item--primary">
											<div class="kt-widget2__checkbox">

											</div>
											<div class="kt-widget2__info">
												<a href="#" class="kt-widget2__title">
													{{ $info->nombre }}
												</a>
												<a href="#" class="kt-widget2__username">
													{{ $info->descripcion }}
												</a>
												<a href="#" class="kt-widget2__username">
													{{ $info->created_at }}
												</a>
											</div>
											<div class="kt-widget2__actions">
												<a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
													<i class="flaticon-more-1"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right" style="">
													<ul class="kt-nav">
														@if($info->imagen)
														<li class="kt-nav__item">
															<a href="{{ $info->imagen }}" target="_blank" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon-eye"></i>
																<span class="kt-nav__link-text">Ver {{ \App\Http\Controllers\ComunicadosController::obtenerTipoArchivo($info->imagen) }} </span>
															</a>
														</li>
														@endcan
														@if($info->archivo1)
														<li class="kt-nav__item">
														    <a href="{{ $info->archivo1 }}" target="_blank" class="kt-nav__link">
														        <i class="kt-nav__link-icon flaticon-eye"></i>
														        <span class="kt-nav__link-text">Ver {{ \App\Http\Controllers\ComunicadosController::obtenerTipoArchivo($info->archivo1) }}</span>
														    </a>  
														</li>

														@endcan
														@if($info->archivo2)
														<li class="kt-nav__item">
															<a href="{{ $info->archivo2 }}" target="_blank" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon-eye"></i>
																<span class="kt-nav__link-text">Ver {{ \App\Http\Controllers\ComunicadosController::obtenerTipoArchivo($info->archivo2) }}</span>
															</a>
														</li>
														@endcan
														@if($info->archivo3)
														<li class="kt-nav__item">
															<a href="{{ $info->archivo3 }}" target="_blank" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon-eye"></i>
																<span class="kt-nav__link-text">Ver {{ \App\Http\Controllers\ComunicadosController::obtenerTipoArchivo($info->archivo3) }}</span>
															</a>
														</li>
														@endcan
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>

					<!--end:: Widgets/Tasks -->
				</div>
			</div>
		</div>

		<!--End:: App Content-->
	</div>

	<!--End::App-->
</div>

<!-- end:: Content -->
                        


@endsection

   
@section('scripts')

@endsection
