@extends('layouts.app')

@section('title', 'Home'.' | '.config('app.name'))

@section('style')
<!--begin::Page Vendors Styles(used by this page) -->
<!-- <style>
#chartdiv {
  width: 100%;
  height: 500px;
}

</style>-->

<style>
#chartdiv3 {
  width: 100%;
  height: 500px;
}

#chartdiv4 {
  width: 100%;
  height: 500px;
}
</style>


@endsection

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">Dashboard</h3>
			<span class="kt-subheader__separator kt-subheader__separator--v"></span>
			<div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
				<input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
				<span class="kt-input-icon__icon kt-input-icon__icon--right">
					<span><i class="flaticon2-search-1"></i></span>
				</span>
			</div>
		</div>
	</div>
</div>

<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

	<!--Begin::Dashboard 6-->

	<div class="row">
		<div class="col-xl-8 col-lg-8">
			<!--begin:: Widgets/Sale Reports-->
			<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Actividades
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
												<td style="width:60%">Tarea</td>
												<td style="width:15%">Asignatura</td>
												<td style="width:10%">Status</td>
												<td style="width:15%" class="kt-align-right">Fecha de entrega</td>
											</tr>
										</thead>
										<tbody>
											@foreach($consultaTareas as $tareas)
											<tr>
												<td>
													<span class="kt-widget11__sub">{{ $tareas->tarea }}</span>
													<a href="#" class="kt-widget11__title">Prof. {{ $tareas->nom_docente }}</a>	
												</td>
												<td><span class="kt-badge kt-badge--inline kt-badge--success">{{ $tareas->nom_asignatura }}</span></td>
												<td>
												@if(strtotime($tareas->fecha_entrega) < strtotime('today'))
													<span class="kt-badge kt-badge--inline kt-badge--danger">Vencido</span>
												@else
													<span class="kt-badge kt-badge--inline kt-badge--info">Activo</span>
												@endif
												</td>
												<td class="kt-align-right kt-font-brand kt-font-bold{{ (strtotime($tareas->fecha_entrega) < strtotime('today')) ? ' kt-font-danger' : '' }}">{{ $tareas->fecha_entrega }}</td>
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
		<div class="col-xl-4 col-lg-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon kt-hidden">
							<i class="la la-gear"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Últimos comunicados
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="tab-content">
						@foreach ($comunicados as $info)
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
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon kt-hidden">
							<i class="la la-gear"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Facturación 
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div id="chartdiv4"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">		

		<div class="col-lg-6">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon kt-hidden">
							<i class="la la-gear"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Próximas actividades
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="tab-content">
						@foreach ($actividadesGenerales as $info)
						<div class="tab-pane active" id="kt_widget2_tab1_content">
							<div class="kt-widget2">
								<div class="kt-widget2__item kt-widget2__item--success">
									<div class="kt-widget2__checkbox">

									</div>
									<div class="kt-widget2__info">
										<a href="#" class="kt-widget2__title">
											{{ $info->nombre }}
										</a>
										<a href="#" class="kt-widget2__username">
											<strong>Observación: </strong>{{ $info->observaciones }}
										</a>
										<a href="#" class="kt-widget2__username">
											<strong>Inicio: </strong>{{ $info->fecha_inicio }}
										</a>
										<a href="#" class="kt-widget2__username">
											<strong>Fin: </strong>{{ $info->fecha_fin }}
										</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon kt-hidden">
							<i class="la la-gear"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Últimas entradas (Blog)
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="tab-content">
						@foreach ($publicacionesBlog as $info)
						<div class="tab-pane active" id="kt_widget2_tab1_content">
							<div class="kt-widget2">
								<div class="kt-widget2__item kt-widget2__item--danger">
									<div class="kt-widget2__checkbox">

									</div>
									<div class="kt-widget2__info">
										<a href="{{ url('admin/blog/'.$info->id.'/show')}}" class="kt-widget2__title">
											{{ $info->titulo }}
										</a>
										<a href="#" class="kt-widget2__username">
											{{ Str::limit($info->texto, 150) }}
										</a>
										<a href="#" class="kt-widget2__username">
											{{ $info->created_at }}
										</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

	

</div>

<!-- end:: Content -->

@endsection

   
@section('scripts')

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>



<!-- ---------------------------------------------------------------   -->

<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart4 = am4core.create('chartdiv4', am4charts.XYChart)
chart4.colors.step = 2;

chart4.legend = new am4charts.Legend()
chart4.legend.position = 'top'
chart4.legend.paddingBottom = 20
chart4.legend.labels.template.maxWidth = 95

var xAxis = chart4.xAxes.push(new am4charts.CategoryAxis())
xAxis.dataFields.category = 'category'
xAxis.renderer.cellStartLocation = 0.1
xAxis.renderer.cellEndLocation = 0.9
xAxis.renderer.grid.template.location = 0;
xAxis.renderer.minGridDistance = 10; // Aumentamos el valor para evitar que se sobrepongan los nombres
xAxis.renderer.labels.template.rotation = 270; // Rotamos los nombres verticalmente


var yAxis = chart4.yAxes.push(new am4charts.ValueAxis());
yAxis.min = 0;

function createSeries(value, name) {
    var series = chart4.series.push(new am4charts.ColumnSeries())
    series.dataFields.valueY = value
    series.dataFields.categoryX = 'category'
    series.name = name

    series.events.on("hidden", arrangeColumns);
    series.events.on("shown", arrangeColumns);

    var bullet = series.bullets.push(new am4charts.LabelBullet())
    bullet.interactionsEnabled = false
    bullet.dy = 30;
    bullet.label.text = '{valueY}'
    bullet.label.fill = am4core.color('#ffffff')

    // Configuramos el tooltip para mostrar la información completa al pasar el mouse sobre las columnas
    series.columns.template.tooltipText = "{name}: {valueY}";

    var bullet = series.bullets.push(new am4charts.LabelBullet())
    bullet.interactionsEnabled = false
    bullet.dy = 30;
    bullet.label.text = '{valueY}'
    bullet.label.fill = am4core.color('#ffffff')

    return series;
}

chart4.data = [

	<?php foreach ($totalRecaudadoPorMes as $item): ?>
    {
        "category": "<?php echo $item->nom_mes ?>",
        "first": "<?php echo $item->total_recaudado ?>",
        "second": "<?php echo $item->valor_realizado ?>",
        "third": "<?php echo $item->valor_pendiente ?>"
    },
<?php endforeach ?>

]


createSeries('first', 'Total');
createSeries('second', 'Realizado');
createSeries('third', 'Pendiente');

function arrangeColumns() {

    var series = chart4.series.getIndex(0);

    var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
    if (series.dataItems.length > 1) {
        var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
        var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
        var delta = ((x1 - x0) / chart.series.length) * w;
        if (am4core.isNumber(delta)) {
            var middle = chart.series.length / 2;

            var newIndex = 0;
            chart4.series.each(function(series) {
                if (!series.isHidden && !series.isHiding) {
                    series.dummyData = newIndex;
                    newIndex++;
                }
                else {
                    series.dummyData = chart.series.indexOf(series);
                }
            })
            var visibleCount = newIndex;
            var newMiddle = visibleCount / 2;

            chart4.series.each(function(series) {
                var trueIndex = chart.series.indexOf(series);
                var newIndex = series.dummyData;

                var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
            })
        }
    }
}

});
</script>










@endsection
