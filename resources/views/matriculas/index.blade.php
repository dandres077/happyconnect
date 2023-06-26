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

            <div class="btn-group">
                <button type="button" class="btn btn-brand btn-elevate btn-icon-sm">
                    Matricular </button>
                <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="kt-nav">
                        <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_1">
                                <i class="kt-nav__link-icon flaticon2-writing"></i>
                                <span class="kt-nav__link-text">Institución</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_5">
                                <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                                <span class="kt-nav__link-text">Padre</span>
                            </a>
                        </li>
                        @can('matriculas.reporte')
                        <li class="kt-nav__item">
                            <a href="{{ url ('admin/matriculas/reporte')}}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                                <span class="kt-nav__link-text">Reporte</span>
                            </a>
                        </li>
                        @endcan
                        @can('matriculas.importar')
                        <li class="kt-nav__item">
                            <a href="" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_6">
                                <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                                <span class="kt-nav__link-text">Importar</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
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
                    <th>Temporada</th>
                    <th>Jornada</th>
                    <th>Grado</th>
                    <th>Paralelo</th>
                    <th>Estudiante</th>
                    <th>TipoDocumento</th>
                    <th>N° Documento</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $matriculas)
                <tr class="gradeX">
                    <td>{{$matriculas->id}}</td>
                    <td>{{$matriculas->nom_temporada}}</td>
                    <td>{{$matriculas->nom_jornada}}</td>
                    <td>{{$matriculas->nom_grado}}</td>
                    <td>{{$matriculas->nom_paralelo}}</td>
                    <td>{{strtoupper($matriculas->nom_alumno)}}</td>
                    <td>{{$matriculas->tipodoc}}</td>
                    <td>{{$matriculas->n_documento}}</td>
                    <td>
                        @if($matriculas->estado_elemento == 'Activo')
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
                                @can('matriculas.edit') 
                                <a class="dropdown-item" href="{{ url('admin/matriculas/'.$matriculas->id.'/edit')}}"><i class="la la-edit"></i>Editar</a>
                                @endcan

                                @can('matriculas.delete')       
                                <form method="post" action="{{ url('admin/matriculas/'.$matriculas->id.'/delete')}}">
                                    {{ csrf_field() }}
                                    <button type="submit" type="button" class="dropdown-item"> <i class="la la-trash"></i>&nbsp;&nbsp;&nbsp;Eliminar</button>
                                </form>  
                                @endcan

                                @if ($matriculas->status == 5)
                                    @can('matriculas.inactive')         
                                    <form method="post" action="{{ url('admin/matriculas/'.$matriculas->id.'/inactive')}}">
                                        {{ csrf_field() }}
                                        <button type="submit" type="button" class="dropdown-item"><i class="la la-info-circle"></i>&nbsp;&nbsp;&nbsp;Inactivar</button>
                                    </form>            
                                    @endcan
                                @else    
                                    @can('matriculas.active')       
                                    <form method="post" action="{{ url('admin/matriculas/'.$matriculas->id.'/active')}}">
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
                    <th>Jornada</th>
                    <th>Grado</th>
                    <th>Paralelo</th>
                    <th>Estudiante</th>
                    <th>TipoDocumento</th>
                    <th>N° Documento</th>
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

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Matricula - Padre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('admin/matriculas/store3')}}"  autocomplete="off">
                    {{ csrf_field()}}
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">N° Documento alumno:</label>
                        <input type="number" class="form-control" name="n_documento" min="1" max="9999999999" required="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Temporada:</label>
                        <select class="form-control" name="temporada_id" id="temporada_id" required="">
                        @foreach ($temporadas as $temporada)
                        <option value="{{ $temporada->id }}"> {{ $temporada->nombre }}</option>
                        @endforeach                                         
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Grado:</label>
                        <select class="form-control" name="grado_id" id="grado_id" required="">
                        @foreach ($grados as $grado)
                        <option value="{{ $grado->id }}"> {{ $grado->nombre }}</option>
                        @endforeach                                         
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Email Padre:</label>
                        <input type="email" class="form-control" name="email" required="">
                    </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                @can('matriculas.store3')
                <button type="submit" class="btn btn-primary">Matricular y notificar</button>
                @endcan
            </div>
            </form>
        </div>
    </div>
</div>

<!--end::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione <a href="https://www.central.gidesco.com/img/CargueExcel_Plantilla.xlsx" target="_blank">(Plantilla)</a></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" action="{{ url('admin/matriculas/masivo')}}" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Importar:</label>
                        <input type="file" name="archivo_excel">
                    </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Importar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--end::Modal--> 


<!--begin::Modal-->
<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Matricula Institucional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('admin/matriculas/validar')}}"  autocomplete="off">
                    {{ csrf_field()}}
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">N° Documento alumno:</label>
                        <input type="number" class="form-control" name="n_documento" min="1" max="9999999999" required="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Periodo:</label>
                        <select class="form-control" name="temporada_id" id="temporada_id" required="">
                        @foreach ($temporadas as $temporada)
                        <option value="{{ $temporada->id }}"> {{ $temporada->nombre }}</option>
                        @endforeach                                         
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Grado:</label>
                        <select class="form-control" name="grado_id" id="grado_id" required="">
                        @foreach ($grados as $grado)
                        <option value="{{ $grado->id }}"> {{ $grado->nombre }}</option>
                        @endforeach                                         
                        </select>
                    </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                @can('matriculas.validar')
                <button type="submit" class="btn btn-primary">Validar</button>
                @endcan
            </div>
            </form>
        </div>
    </div>
</div>

<!--end::Modal-->

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
            {extend: 'excel', title: 'AlumnosMatriculados'},
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
