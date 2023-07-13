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
                   {{ $titulo }}
                </h3>
            </div>
            @can('comunicados.create')
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ url ('admin/comunicados/create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Crear
                        </a>
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
                    <th>Id</th>
                    <th>Temporada</th> 
                    <th>Categoría</th> 
                    <th>Grados</th> 
                    <th>Nombre</th> 
                    <th>Fecha</th> 
                    <th>Descripción</th> 
                    <th>Archivo 1</th>
                    <th>Archivo 2</th>
                    <th>Archivo 3</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $comunicados)

                    <tr class="gradeX">
                        <td>{{$comunicados->id}}</td>
                        <td>{{$comunicados->nom_temporada}}</td> 
                        <td>{{$comunicados->nom_categoria}}</td>                
                        <td>{{$comunicados->grados}}</td>                
                        <td>{{$comunicados->nombre}}</td>
                        <td>{{$comunicados->created_at}}</td>
                        <td>{{$comunicados->descripcion}}</td>
                        <td>@if ($comunicados->archivo1 != null) <a href="{{$comunicados->archivo1}}" target="_blank"><i class="flaticon-eye"></i></a>@endif</td>
                        <td>@if ($comunicados->archivo2 != null) <a href="{{$comunicados->archivo2}}" target="_blank"><i class="flaticon-eye"></i></a>@endif</td>
                        <td>@if ($comunicados->archivo3 != null) <a href="{{$comunicados->archivo3}}" target="_blank"><i class="flaticon-eye"></i></a>@endif</td>
                        <td>
                            @if($comunicados->estado_elemento == 'Activo')
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
                                @can('comunicados.edit') 
                                <a class="dropdown-item" href="{{ url('admin/comunicados/'.$comunicados->id.'/edit')}}"><i class="la la-edit"></i>Editar</a>
                                @endcan

                                @can('comunicados.destroy')       
                                <form method="post" action="{{ url('admin/comunicados/'.$comunicados->id)}}" class="formulario-eliminar">
                                    {{ csrf_field() }}
                                    <button type="submit" type="button" class="dropdown-item"> <i class="la la-trash"></i>&nbsp;&nbsp;&nbsp;Eliminar</button>
                                </form>  
                                @endcan

                                @if ($comunicados->status == 1)
                                    @can('comunicados.inactive')         
                                    <form method="post" action="{{ url('admin/comunicados/'.$comunicados->id.'/inactive')}}">
                                        {{ csrf_field() }}
                                        <button type="submit" type="button" class="dropdown-item"><i class="la la-info-circle"></i>&nbsp;&nbsp;&nbsp;Inactivar</button>
                                    </form>            
                                    @endcan
                                @else    
                                    @can('comunicados.active')       
                                    <form method="post" action="{{ url('admin/comunicados/'.$comunicados->id.'/active')}}">
                                        {{ csrf_field() }}
                                        <button type="submit" type="button" class="dropdown-item"><i class="la la-info-circle"></i>&nbsp;&nbsp;&nbsp;Activar</button>
                                    </form>
                                    @endcan
                                @endif

                            </div>
                        </div>                    
                        </td>                       
                    </tr>

                    @endforeach 
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Temporada</th> 
                    <th>Categoría</th> 
                    <th>Grados</th> 
                    <th>Nombre</th> 
                    <th>Fecha</th> 
                    <th>Descripción</th> 
                    <th>Archivo 1</th>
                    <th>Archivo 2</th>
                    <th>Archivo 3</th>
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

    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
          title: '¿Esta seguro?',
          text: "¡No podra revertir esta acción!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, estoy seguro',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
              this.submit();
            }          
        })
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
