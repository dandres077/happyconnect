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
		@foreach ($data as $entradas)
		<div class="col-xl-4">

			<!--begin:: Widgets/Blog-->
			<div class="kt-portlet kt-portlet--height-fluid kt-widget19">
				<div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
					<div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{ $entradas->imagen }})">
						<h3 class="kt-widget19__title kt-font-light">
							{{ $entradas->titulo }}
						</h3>
						<div class="kt-widget19__shadow"></div>
						<div class="kt-widget19__labels">
							<a href="#" class="btn btn-label-light-o2 btn-bold ">{{ $entradas->nom_categoria }}</a>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget19__wrapper">
						<div class="kt-widget19__content">
							<div class="kt-widget19__userpic">
								<img src="{{ $entradas->img_usuario }}" alt="">
							</div>
							<div class="kt-widget19__info">
								<a href="#" class="kt-widget19__username">
									{{ $entradas->nom_usuario }}
								</a>
							</div>
							<span class="kt-widget19__time">{{ $entradas->created_at }}</span>
						</div>
						<div class="kt-widget19__text">
							{{ Str::limit($entradas->texto, 150) }}
						</div>
					</div>
					<div class="kt-widget19__action">
						<a href="{{ url('admin/blog/'.$entradas->id.'/show')}}" class="btn btn-sm btn-label-brand btn-bold">Leer más</a>
					</div>
				</div>
			</div>

			<!--end:: Widgets/Blog-->
		</div>
		@endforeach
	</div>
</div>
<!-- end:: Content -->
@endsection

   
@section('scripts')

@endsection
