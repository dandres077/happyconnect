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
@if (session('danger'))
    <div class="alert alert-danger fade show" role="alert">
        <div class="alert-text">{{ session('danger') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
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

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                   {{ $titulo }} para el mes de {{ $nombre_mes }} del {{ $ano }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="btn-group" role="group">
						<button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Opciones
						</button>
						<div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
							<a class="dropdown-item" href="{{ url('admin/disponibilidad/'.$mes_siguiente.'/'.$ano_menu_siguiente.'')}}">Siguiente</a>
							<a class="dropdown-item" href="{{ url('admin/disponibilidad/'.$mes_anterior.'/'.$ano_menu_anterior.'')}}">Anterior</a>
						</div>
					</div>
                </div>
            </div>

        </div>
        <div class="kt-portlet__body">
            <div class="table-responsive">
            <!--begin: Datatable -->
             <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Hab/Día</th>
                    @for ($i = 1; $i <= $dias; $i++) 
                    <th>{{ $i }}</th>
                    @endfor 
                </tr>
                </thead>

                <tbody>           	
                	@foreach ($habitaciones as $habitacion)
	                <tr class="gradeX">
	                    <td>{{ $habitacion->id }}</td>
	                    <td><a href="{{ url('admin/reservas/'.$habitacion->id.'/habitacion')}}" target="_blank" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="Adultos: {{ $habitacion->adultos }} | Niños: {{ $habitacion->ninos }} | Mascotas: {{ $habitacion->mascotas }}">{{ $habitacion->nombre }}</a></td>

	                    @for ($i = $dia_inicio; $i <= $dia_final; $i+=86400) 

	                    	@php $dato = date("Y-m-d", $i);  $color = 0; @endphp <!-- Variable para el día -->

	                    	@foreach ($reservas as $reserva)

	                    		@if ($dato >= $reserva->fecha_inicio && $habitacion->id == $reserva->habitacion_id && $dato <= $reserva->fecha_fin )

	                    		@php $color = 1; @endphp

	                    		@endif

		                    @endforeach

		                    @if($color == 1) <!-- Para reservas dentro del mismo mes ROJO-->

		                    <td style="background-color: rgb(225, 90, 90);"> 

		                    @else

		                    <td style="background-color: rgb(255, 255, 255);"> 

		                    @endif
                            
                        @endfor      
	                </tr>
	                @endforeach                             
                </tbody>

                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Hab/Día</th>
                    @for ($i = 1; $i <= $dias; $i++) 
                    <th>{{ $i }}</th>
                    @endfor                     
                </tr>
                </tfoot>
                </table>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->
                        


@endsection

   
@section('scripts')

<script src="{{ asset('plugins/dataTables/datatables.min.js')}}"></script>


<!-- Page-Level Scripts -->
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        //"order": [[ 0 ,"asc" ]], //or asc 
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            //{ extend: 'copy'},
            //{extend: 'csv'},
            //{extend: 'excel', title: 'ExampleFile'},
            //{extend: 'pdf', title: 'ExampleFile'},

            /*{extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }*/
        ],
        "language":{
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate":{
                "next": "Siguiente",
                "previous": "Anterior",
            },
            "lengthMenu": 'Ver <select>'+
                        '<option value="10">10</option>'+
                        '<option value="30">30</option>'+
                        '<option value="-1">Todo</option>'+
                        '</select> registros | ',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "infoEmpty": "",
            "infoFiltered": ""
        }

    });

});

</script>
@endsection
