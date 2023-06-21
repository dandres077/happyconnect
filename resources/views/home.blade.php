@extends('layouts.app')

@section('content')
<div class="container">
    @if($permiso == 2)
    <div class="row">
		<div class="col-lg-10">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon kt-hidden">
							<i class="la la-gear"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Marcas registradas
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div id="chartdiv"></div>
				</div>
			</div>
		</div>
	</div>
    @endif
</div>
@endsection

@section('scripts')
        <!-- Resources -->
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>


        <script>
            am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.PieChart);


            // Add data
            chart.data = [ 
                @foreach($data as $value)
                {
                    "country": "<?php echo $value->customer?>",
                    "litres":  "<?php echo $value->invoiced?>"
                },
                
                @endforeach
            ];

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "litres";
            pieSeries.dataFields.category = "country";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;

            // This creates initial animation
            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;

            }); // end am4core.ready()
            </script>

@endsection