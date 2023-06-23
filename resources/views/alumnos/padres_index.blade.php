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

            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ url ('admin/alumnos/padres/'.$alumno->id.'/create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Crear
                        </a>
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
                    <th>Familiar</th> 
                    <th>Nombres</th> 
                    <th>Apellidos</th> 
                    <th>TipoDocumento</th> 
                    <th>N° Documento</th>
                    <th>Dirección</th> 
                    <th>Teléfono</th> 
                    <th>Celular</th> 
                    <th>Email</th> 
                    <th>Profesion</th> 
                    <th>NivelEducativo</th> 
                    <th>Empresa</th> 
                    <th>Ocupación</th> 
                    <th>Dirección</th>
                    <th>Teléfono</th> 
                    <th>Email</th>
                    <th>FechaCreación</th>    
                    <th>Estado</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($padres as $padre)

                    <tr class="gradeX">
                        <td>{{$padre->id}}</td>
                        <td>{{$padre->familiar}}</td> 
                        <td>{{$padre->nombres}}</td>                
                        <td>{{$padre->apellidos}}</td>
                        <td>{{$padre->tipo_documento}}</td>
                        <td>{{$padre->n_documento}}</td>
                        <td>{{$padre->direccion}}</td>
                        <td>{{$padre->telefono}}</td>
                        <td>{{$padre->celular}}</td>
                        <td>{{$padre->email}}</td>
                        <td>{{$padre->profesion}}</td>
                        <td>{{$padre->nivel_educativo}}</td>
                        <td>{{$padre->empr_nombre}}</td>
                        <td>{{$padre->empr_ocupacion}}</td>
                        <td>{{$padre->empr_direccion}}</td>
                        <td>{{$padre->empr_telefono}}</td>
                        <td>{{$padre->empr_email}}</td>




                        <td>{{$padre->created_at}}</td>
                        <td>

                        @if ($padre->status==1)
                            <form method="post" action="{{ url('admin/alumnos/'.$padre->id.'/inactive')}}">
                                {{ csrf_field() }}
                                <button type="submit" type="button" rel="tooltip" title="Cambiar" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm"> Inactivar <i class="fa fa-repeat"></i></button>
                            </form>

                        @else
                            <form method="post" action="{{ url('admin/alumnos/'.$padre->id.'/active')}}">
                                {{ csrf_field() }}
                                <button type="submit" type="button" rel="tooltip" title="Cambiar" class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm"> Activar <i class="fa fa-repeat"></i></button>
                            </form>
                        @endif

                        </td> 
                        <td> 

                        <a href="{{ url('admin/alumnos/'.$padre->id.'/edit')}}" type="button" rel="tooltip" title="Editar" class="btn btn-primary btn-sm btn-icon btn-circle"> <i class="fa fa-pen"></i></a>

                        </td>
                        <td> 
                            <form method="post" action="{{ url('admin/alumnos/'.$padre->id)}}">
                                @method('DELETE')
                                {{ csrf_field() }}


                                <button type="submit" type="button" rel="tooltip" title="Eliminar" class="btn btn-danger btn-sm btn-icon btn-circle"> <i class="fa fa-trash"></i></button>

                            </form>                          
                        </td>
                        
                    </tr>

                    @endforeach 
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Familiar</th> 
                    <th>Nombres</th> 
                    <th>Apellidos</th> 
                    <th>TipoDocumento</th> 
                    <th>N° Documento</th>
                    <th>Dirección</th> 
                    <th>Teléfono</th> 
                    <th>Celular</th> 
                    <th>Email</th> 
                    <th>Profesion</th> 
                    <th>NivelEducativo</th> 
                    <th>Empresa</th> 
                    <th>Ocupación</th> 
                    <th>Dirección</th>
                    <th>Teléfono</th> 
                    <th>Email</th>
                    <th>FechaCreación</th>    
                    <th>Estado</th>
                    <th></th>
                    <th></th>
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
