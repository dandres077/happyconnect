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

            <!--<div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ url ('admin/alumnos/create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Crear
                        </a>
                    </div>
                </div>
            </div>-->

        </div>
        <div class="kt-portlet__body">
            <div class="table-responsive">
            <!--begin: Datatable -->
             <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Apellido1</th> 
                    <th>Apellido2</th>
                    <th>Nombre1</th> 
                    <th>Nombre2</th> 
                    <th>Documento</th>
                    <th>FechaCreación</th>    
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $alumnos)

                    <tr class="gradeX">
                        <td>{{$alumnos->id}}</td>
                        <td>{{strtoupper ($alumnos->apellido1)}}</td>
                        <td>{{strtoupper ($alumnos->apellido2)}}</td>
                        <td>{{strtoupper ($alumnos->nombre1)}}</td> 
                        <td>{{strtoupper ($alumnos->nombre2)}}</td>       
                        <td>{{$alumnos->n_documento}}</td>
                        <td>{{$alumnos->created_at}}</td>
                        <td>
                            @if($alumnos->estado_elemento == 'Activo')
                            <span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Activo</span>
                            @else
                                <span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Inactivo</span>
                            @endif
                        </td>
                        <td>
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-brand btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-more-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                @can('alumnos.edit') 
                                <a class="dropdown-item" href="{{ url('admin/alumnos/'.$alumnos->id.'/edit')}}"><i class="la la-edit"></i>Editar</a>
                                @endcan

                                @can('alumnos.destroy')       
                                <form method="post" action="{{ url('admin/alumnos/'.$alumnos->id)}}" class="formulario-eliminar"> 
                                    {{ csrf_field() }}
                                    <button type="submit" type="button" class="dropdown-item"> <i class="la la-trash"></i>&nbsp;&nbsp;&nbsp;Eliminar</button>
                                </form>  
                                @endcan

                                @if ($alumnos->status == 1)
                                    @can('alumnos.inactive')         
                                    <form method="post" action="{{ url('admin/alumnos/'.$alumnos->id.'/inactive')}}">
                                        {{ csrf_field() }}
                                        <button type="submit" type="button" class="dropdown-item"><i class="la la-info-circle"></i>&nbsp;&nbsp;&nbsp;Inactivar</button>
                                    </form>            
                                    @endcan
                                @else    
                                    @can('alumnos.active')       
                                    <form method="post" action="{{ url('admin/alumnos/'.$alumnos->id.'/active')}}">
                                        {{ csrf_field() }}
                                        <button type="submit" type="button" class="dropdown-item"><i class="la la-info-circle"></i>&nbsp;&nbsp;&nbsp;Activar</button>
                                    </form>
                                    @endcan
                                @endif

                            </div>
                        </div>                         
                    </tr>

                    @endforeach 
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Apellido1</th> 
                    <th>Apellido2</th>
                    <th>Nombre1</th> 
                    <th>Nombre2</th> 
                    <th>Documento</th>
                    <th>FechaCreación</th>    
                    <th>Estado</th>
                    <th>Opciones</th>
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
        "order": [[ 1 ,"asc" ]], //or asc 
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
