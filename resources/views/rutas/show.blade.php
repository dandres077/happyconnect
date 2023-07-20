@extends('layouts.app')

@section('title',  $titulo  .' | '.config('app.name'))

@section('style')
<link href="{{ asset('assets/css/pages/tables/style.css')}}" rel="stylesheet" type="text/css" />
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
	<div class="row">	
		<div class="col-xl-4">
			<!--begin:: Widgets/Blog-->
			<div class="kt-portlet kt-portlet--height-fluid kt-widget19">
				<div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
					<div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{ $data->imagen }})">
						<h3 class="kt-widget19__title kt-font-light">
							{{ $data->nombre }}
						</h3>
						<div class="kt-widget19__shadow"></div>
						<div class="kt-widget19__labels">
							<a href="#" class="btn btn-label-light-o2 btn-bold ">Ruta</a>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget19__wrapper">
						<div class="kt-widget19__content">
							<div class="kt-widget19__userpic">
								<img src="{{ $data->img_usuario }}" alt="">
							</div>
							<div class="kt-widget19__info">
								<span class="kt-widget19__time">Publicado por:</span>
								<a href="#" class="kt-widget19__username">
									{{ $data->nom_usuario }}
								</a>								
							</div>
						</div>
						<div class="kt-widget19__text">
							{{ $data->observaciones }}
							<br><br>
							<div class="kt-widget__item">
								<div class="kt-widget__contact">
									<span class="kt-widget__label">Empresa:</span>
									<a href="#" class="kt-widget__data">{{ $data->nom_proveedor }}</a>
								</div>
								<div class="kt-widget__contact">
									<span class="kt-widget__label">Marca:</span>
									<a href="#" class="kt-widget__data">{{ $data->marca }}</a>
								</div>
								<div class="kt-widget__contact">
									<span class="kt-widget__label">Modelo:</span>
									<a href="#" class="kt-widget__data">{{ $data->modelo }}</a>
								</div>
								<div class="kt-widget__contact">
									<span class="kt-widget__label">Placa:</span>
									<a href="#" class="kt-widget__data">{{ $data->placa }}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end:: Widgets/Blog-->
		</div>
		<div class="col-xl-8">

			<!--begin:: Widgets/Company Summary-->
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Información de contacto
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget13">
						<div class="kt-widget13__item">
							<span class="kt-widget13__desc">
								Conductor(es)
							</span>
							<span class="kt-widget13__text kt-widget13__text--bold">
								{{ $data->conductor }}
							</span>
						</div>
						<div class="kt-widget13__item">
							<span class="kt-widget13__desc kt-align-right">
								Teléfono conductor(es):
							</span>
							<span class="kt-widget13__text  kt-font-brand kt-widget13__text--bold">
								{{ $data->tel_conductor }}
							</span>
						</div>
						<div class="kt-widget13__item">
							<span class="kt-widget13__desc">
								Monitor(es):
							</span>
							<span class="kt-widget13__text">
								{{ $data->monitor }}
							</span>
						</div>
						<div class="kt-widget13__item">
							<span class="kt-widget13__desc">
								Teléfono monitores:
							</span>
							<span class="kt-widget13__text  kt-font-brand kt-widget13__text--bold">
								{{ $data->tel_monitor }}
							</span>
						</div>
						<div class="kt-widget13__item">
							<span class="kt-widget13__desc">
								Total de alumnos:
							</span>
							<span class="kt-widget13__text">
								{{ $total_alumnos }}
							</span>
						</div>
					</div>
				</div>
			</div>

			<!--end:: Widgets/Company Summary-->
		</div>
	</div>
</div>

<!-- end:: Content -->
                        


@endsection

   
@section('scripts')


@endsection
