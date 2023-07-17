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
                <a href="{{ url ('admin/rutas')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/rutas')}}" class="kt-subheader__breadcrumbs-link">
                {{ $titulo }} </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                Editar</a>
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
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Ingresa la información</h3>
                    </div>
                    @can('rutas.alumnos_store')
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#kt_modal_1">
                                    <i class="la la-plus"></i>
                                    Alumnos
                                </button>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="kt-portlet__body">
                    <form method="post" class="form-horizontal" action="{{ url('admin/rutas/'.$data->id.'/edit')}}" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">                                    

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Temporada </label>
                                            <div class="col-9">
                                                <select class="form-control" name="temporada_id" id="temporada_id">
                                                @foreach ($temporadas as $temporada)
                                                    <option value="{{$temporada->id}}" @if($data->temporada_id==$temporada->id) selected @endif> {{ $temporada->nombre, $data->temporada_id }}</option>
                                                @endforeach                                                     
                                                </select>
                                            </div>
                                        </div>    

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Proveedor </label>
                                            <div class="col-9">
                                                <select class="form-control" name="proveedor_id" id="proveedor_id">
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{$proveedor->id}}" @if($data->proveedor_id==$proveedor->id) selected @endif> {{ $proveedor->empresa, $data->proveedor_id }}</option>
                                                @endforeach                                                     
                                                </select>
                                            </div>
                                        </div>                         

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nombre Ruta</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $data->nombre) }}" required="">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Marca</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $data->marca) }}" required="">
                                            </div>
                                        </div>  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Modelo</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $data->modelo) }}" required="">
                                            </div>
                                        </div>   

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Placa</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="placa" name="placa" value="{{ old('placa', $data->placa) }}" required="">
                                            </div>
                                        </div>                                                                          
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Conductor(es)</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="conductor" name="conductor" value="{{ old('conductor', $data->conductor) }}" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono Conductor(es)</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="tel_conductor" name="tel_conductor" value="{{ old('tel_conductor', $data->tel_conductor) }}" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Monitor(es)</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="monitor" name="monitor" value="{{ old('monitor', $data->monitor) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono Monitor(es)</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="tel_monitor" name="tel_monitor" value="{{ old('tel_monitor', $data->tel_monitor) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Imagen 
                                    @if ($data->imagen != null) 
                                    <a href="{{$data->imagen}}" target="_blank"><i class="flaticon-eye"></i></a>                 
                                    @endif
                                    </label>
                                    <div class="col-9">
                                    <input type="file" class="form-control-file" name="imagen" id="imagen" required>
                                    </div>
                                </div>    

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Observaciones</label>
                                    <div class="col-9">
                                    <textarea class="form-control" id="observaciones" name="observaciones" rows="4" cols="50">{{ old('observaciones', $data->observaciones) }}</textarea>
                                    </div>
                                </div>                                 
                            </div>  

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ url ('admin/rutas')}}" class="btn btn-secondary">Cancelar</a>
                            </div>                       
                        </div>
                    </form>
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
</div>


<br>

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                   Alumnos registrados en la Ruta
                </h3>
            </div>
        </div>
        <!-- Lista de alumnos asociados a la ruta -->
        <div class="kt-portlet__body">
            <div class="table-responsive">
            <!--begin: Datatable -->
             <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Alumno</th>
                    <th>Grado</th>
                    <th>Paralelo</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($inscritos as $alumno)
                <tr class="gradeX">
                    <td>{{$alumno->id}}</td>
                    <td>{{$alumno->nom_alumno}}</td>
                    <td>{{$alumno->nom_grado}}</td>
                    <td>{{$alumno->nom_paralelo}}</td>
                </tr>
                @endforeach 
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Alumno</th>
                    <th>Grado</th>
                    <th>Paralelo</th>
                </tr>
                </tfoot>
                </table>
            </div>
            <!--end: Datatable -->
        </div>
        <!-- end:: Content -->
    </div>
</div>

<!-- end:: Content -->

<!--begin::Modal-->
    <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar alumnos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="form-horizontal" action="{{ url('admin/rutas/alumnos/store')}}" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field()}}

                    <input type="hidden" name="ruta_id" value="{{ $data->id }}">

                    <div class="kt-portlet__body">
                        <div class="table-responsive">
                        <!--begin: Datatable -->
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Alumno</th>
                                        <th>Documento</th>
                                        <th>Grado</th>
                                        <th>Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumnos as $rutas)
                                    <tr class="gradeX">
                                        <td>{{$rutas->nom_alumno}}</td>
                                        <td>{{$rutas->n_documento}}</td>
                                        <td>{{$rutas->nom_grado.' '.$rutas->nom_paralelo}}</td>
                                        <td>
                                            <input type="checkbox" name="paralelos[]" value="{{ $rutas->alumno_id.'|'.$rutas->grado_id.'|'.$rutas->paralelo_id }}" 
                                                @if ($alumnos_rutas->contains('alumno_id', $rutas->alumno_id))
                                                    checked
                                                @endif                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Alumno</th>
                                        <th>Documento</th>
                                        <th>Grado</th>
                                        <th>Seleccionar</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!--end: Datatable -->
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    @can('rutas.alumnos_store')
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    @endcan
                </div>
                </form>
            </div>
        </div>
    </div>
<!--end::Modal-->

@endsection
    
@section('scripts')
<script src="{{ asset('plugins/dataTables/datatables.min.js')}}"></script>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        "order": [[ 0 ,"asc" ]], //or asc 
        pageLength: 600,
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
