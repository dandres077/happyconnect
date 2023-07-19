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
		<div class="col-xl-12">

			<!--begin:: Widgets/Personal Income-->
			<div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--height-fluid">
				<div class="kt-portlet__head kt-portlet__space-x">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-light">
							{{ $data[0]->nom_alumno }}
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget27">
						<div class="kt-widget27__visual">
							<img src="{{ asset('assets/media/bg/bg-4.jpg')}}" alt="">
							<h3 class="kt-widget27__title">
								@php
									$total = 0;
								@endphp

								@foreach($cobros as $cobro)

								@php
									$total = $total + $cobro->valor;

								@endphp

								@endforeach
								<span>$ {{number_format($total,'0', ',','.')}}</span>
							</h3>
							<div class="kt-widget27__btn">
								<a href="#" class="btn btn-pill btn-light btn-elevate btn-bold">Pagos</a>
							</div>
						</div>
						<div class="kt-widget27__container kt-portlet__space-x">
							<ul class="nav nav-pills nav-fill" role="tablist">
							@foreach($meses as $index => $mes)
							    <li class="nav-item">
							        <a class="nav-link{{ ($index === 0) ? ' active' : '' }}" data-toggle="pill" href="#kt_personal_income_quater_{{ $mes->id }}">{{ $mes->nombre }}</a>
							    </li>
							@endforeach

							</ul>
							<div class="tab-content">
								@foreach($meses as $index => $mes)
    							<div id="kt_personal_income_quater_{{ $mes->id }}" class="tab-pane{{ ($index === 0) ? ' active' : '' }}">
									<div class="kt-widget11">
										<div class="table-responsive">
											<!--begin::Table-->
											<table class="table">
												<!--begin::Thead-->
												<thead>
													<tr>
														<td>Concepto</td>
														<td>Fecha</td>
														<td class="kt-align-right">Valor</td>
													</tr>
												</thead>

												<!--end::Thead-->

												<!--begin::Tbody-->
												<tbody>
													@foreach($cobros as $cobro)
													@if($mes->id == $cobro->mes_id)
													<tr>
														<td>
															<a href="#" class="kt-widget11__title">{{ $cobro->nombre }}</a>
															<span class="kt-widget11__sub">{{ $cobro->observacion }}</span>
														</td>
														<td><span class="kt-badge kt-badge--success kt-badge--inline">{{ $cobro->fecha }}</span></td>
														<td class="kt-align-right kt-font-brand kt-font-bold">$ {{number_format($cobro->valor,'0', ',','.')}}</td>
													</tr>
													@endif
													@endforeach
												</tbody>
												<!--end::Tbody-->
											</table>
											<!--end::Table-->
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--end:: Widgets/Personal Income-->
		</div>
	</div>
</div>

<!-- end:: Content -->



@endsection

   
@section('scripts')

@endsection
