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
    <div class="row">
    	@foreach($data as $profesionales)
		<div class="col-xl-3">

			<!--Begin::Portlet-->
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head kt-portlet__head--noborder">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">

					<!--begin::Widget -->
					<div class="kt-widget kt-widget--user-profile-2">
						<div class="kt-widget__head">
							<div class="kt-widget__media">
								<img class="kt-widget__img kt-hidden-" src="{{ $profesionales->imagen }}" alt="image">
								<div class="kt-widget__pic kt-widget__pic--success kt-font-success kt-font-boldest kt-hidden">
									ChS
								</div>
							</div>
							<div class="kt-widget__info">
								<a href="#" class="kt-widget__username">
									{{ $profesionales->nom_usuario }}
								</a>
							</div>
						</div>
						<div class="kt-widget__body">
							<div class="kt-widget__section">
								<div align="justify">
								<strong>Estudios: </strong>{{ $profesionales->estudios }} <br><br> 
								<strong>Perfil: </strong>{{ $profesionales->perfil }}
								</div>
							</div>
						</div>
						<!-- <div class="kt-widget__footer">
							<button type="button" class="btn btn-label-warning btn-lg btn-upper">write message</button>
						</div> -->
					</div>

					<!--end::Widget -->
				</div>
			</div>

			<!--End::Portlet-->
		</div>
		@endforeach
	</div>
</div>

<!-- end:: Content -->
                        


@endsection

   
@section('scripts')


@endsection
