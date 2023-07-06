@extends('layouts.app')

@section('title', $titulo .' | '.config('app.name'))

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
                {{ $titulo }} </a>

                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
                   {{ $titulo }}
                </h3>
            </div>
            @can('cobros.create')
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#kt_modal_1">
                            <i class="la la-plus"></i>
                            Crear
                        </button>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        <div class="kt-portlet__body">
            <div class="table-responsive">
            <!--begin: Datatable -->
               
               <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            @foreach ($meses as $mes)
                                <th>{{ $mes->nombre }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $alumno)
                            <tr>
                                <td>{{ $alumno->nom_alumno }}</td>
                                @foreach ($meses as $mes)
                                    <td>
                                        @foreach ($cobros as $cobro)
                                            @if ($cobro->alumno_id == $alumno->alumno_id && $cobro->mes_id == $mes->id)
                                                
                                                <div class="btn-group">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        $ {{number_format($cobro->valor,'0', ',','.')}}
                                                    </button>
                                                    <div class="dropdown-menu" style="">
                                                        <a class="dropdown-item" href="{{ url('admin/cobros/'.$cobro->id.'/edit')}}"><i class="la la-edit"></i>Editar</a>
                                                        <a class="dropdown-item formulario-eliminar" href="{{ url('admin/cobros/'.$cobro->id.'/delete')}}" data-cobro-id="{{ $cobro->id }}"><i class="la la-trash"></i>Eliminar</a>

                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item"><span class="kt-font-success">Concepto</span>: {{ $cobro->nombre }}</a>
                                                        <a class="dropdown-item"><span class="kt-font-success">Observación</span>: {{ $cobro->observacion }}</a>
                                                    </div>
                                                </div>
                                                <br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->
                        
<!--begin::Modal-->
    <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-horizontal" action="{{ url('admin/cobros/store')}}" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field()}}

                        <input type="hidden" name="paralelo_id" value="{{ $paralelo_id }}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Alumno</label>
                                    <div class="col-9">
                                        <select class="form-control" name="alumno_id" id="alumno_id">
                                            @foreach ($alumnos as $alumno)
                                            <option value="{{ $alumno->id }}"> {{ $alumno->nom_alumno }}</option>
                                            @endforeach                                                   
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Concepto</label>
                                    <div class="col-9">
                                        <select class="form-control" name="concepto_id" id="concepto_id">
                                            @foreach ($conceptos as $concepto)
                                            <option value="{{ $concepto->id }}"> {{ $concepto->nombre }}</option>
                                            @endforeach                                                   
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Mes</label>
                                    <div class="col-9">
                                        <select class="form-control" name="mes_id" id="mes_id">
                                            @foreach ($meses as $mes)
                                            <option value="{{ $mes->id }}"> {{ $mes->nombre }}</option>
                                            @endforeach                                                   
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group row">
                                            <label class="col-3 col-form-label">Banco</label>
                                        <div class="col-9">
                                            <select class="form-control" name="banco_id" id="banco_id">
                                                @foreach ($bancos as $banco)
                                                <option value="{{ $banco->id }}"> {{ $banco->nombre }}</option>
                                                @endforeach                                                   
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Fecha</label>
                                        <div class="col-9">
                                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required="">
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Valor</label>
                                        <div class="col-9">
                                        <input type="number" class="form-control" id="valor" name="valor" value="{{ old('valor') }}" required="">
                                        </div>
                                    </div>   
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <label class="col-3 col-form-label">Observación</label>
                                </div>

                                <div class="col-sm-9">
                                    <textarea name="observacion" rows="3" cols="120" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>                    
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!--end::Modal-->


@endsection

   
@section('scripts')

<script src="{{ asset('plugins/dataTables/datatables.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if(session('eliminar')=='ok')
<script>
    Swal.fire(
      '¡Eliminado!',
      'Registro eliminado exitosamente.',
      'success'
    )
</script>

@endif

<script>
$('.formulario-eliminar').on('click', function(e) {
    e.preventDefault();
    var cobroId = $(this).data('cobro-id');
    var url = "{{ url('admin/cobros') }}" + "/" + cobroId + "/delete";
    
    Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrá revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, estoy seguro',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            window.location.href = url;
        }
    });
});


    
</script>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        "order": [[ 0 ,"asc" ]], //or asc 
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
