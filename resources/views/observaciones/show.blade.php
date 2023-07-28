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
		<div class="col-xl-12 col-lg-12">
			<!--begin:: Widgets/Sale Reports-->
			<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Anotaciones
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#kt_widget11_tab1_content" role="tab">
									Recientes
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="kt-portlet__body">

					<!--Begin::Tab Content-->
					<div class="tab-content">

						<!--begin::tab 1 content-->
						<div class="tab-pane active" id="kt_widget11_tab1_content">

							<!--begin::Widget 11-->
							<div class="kt-widget11">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<td style="width:60%">Observacion</td>
												<td style="width:15%">Asignatura</td>
												<td style="width:10%">Status</td>
												<td style="width:15%" class="kt-align-right">Fecha</td>
											</tr>
										</thead>
										<tbody>
											@foreach($data as $observaciones)
											<tr>
												<td>
													<span class="kt-widget11__sub">{{ $observaciones->observacion }}</span>
													<a href="#" class="kt-widget11__title">Prof. {{ $observaciones->nom_docente }}</a>	
												</td>
												<td><span class="kt-badge kt-badge--inline kt-badge--success">{{ $observaciones->nom_asignatura }}</span></td>
												<td>
												@if(strtotime($observaciones->created_at) < strtotime('today'))
													<span class="kt-badge kt-badge--inline kt-badge--danger">Vencido</span>
												@else
													<span class="kt-badge kt-badge--inline kt-badge--info">Activo</span>
												@endif
												</td>
												<td class="kt-align-right kt-font-brand kt-font-bold{{ (strtotime($observaciones->created_at) < strtotime('today')) ? ' kt-font-danger' : '' }}">{{ $observaciones->created_at }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

							<!--end::Widget 11-->
						</div>

						<!--end::tab 1 content-->

					</div>

					<!--End::Tab Content-->
				</div>
			</div>
			<!--end:: Widgets/Sale Reports-->
		</div>
	</div>
</div>

<!-- end:: Content -->
                        


@endsection

   
@section('scripts')


@endsection
