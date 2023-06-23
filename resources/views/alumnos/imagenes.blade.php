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
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-primary" data-toggle="modal" data-target="#kt_modal_5">
                    Cargar &nbsp;

                    <!--<i class="flaticon2-calendar-1"></i>-->
                </a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->


<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="row">
        @foreach ($data as $imagenes)
        <div class="col-md-4">
            <!--Begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid-">
                <div class="kt-portlet__body">

                    <!--begin::Widget -->
                    <div class="kt-widget kt-widget--user-profile-4">
                        <div class="kt-widget__head">
                            <div class="kt-widget__media">
                                <img class="kt-widget" src="{{ $imagenes->imagen}}" alt="image">
                            </div>
                        </div>
                        <div class="kt-widget__body">
                            <form method="post" action="{{ url('admin/productos/imagenes/'.$imagenes->id)}}">
                                    @method('DELETE')
                                    {{ csrf_field() }}

                                    @can('productos.destroy')
                                    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-label-danger btn-lg btn-upper"> Eliminar</button>
                                    @endcan

                                    @can('productos.destacado')
                                    @if($imagenes->destacado == 'Si')
                                    <a href="{{ url('admin/productos/'.$producto_id.'/imagen/'.$imagenes->id.'/destacado')}}" type="button" rel="tooltip" title="Destacado" class="btn btn-success btn-lg btn-upper--active"> Destacado</a>
                                    @else
                                    <a href="{{ url('admin/productos/'.$producto_id.'/imagen/'.$imagenes->id.'/destacado')}}" type="button" rel="tooltip" title="Destacado" class="btn btn-label-success btn-lg btn-upper--active"> Destacado</a>
                                    @endif
                                    @endcan
                            </form>
                        </div>
                    </div>

                    <!--end::Widget -->
                </div>
            </div>
            <!--End::Portlet--> 
        </div>
        @endforeach
    </div>
</div>
<!-- end:: Content -->
                        
<div class="modal fade" id="kt_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cargar imágen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form method="post" class="form-horizontal" action="{{ url('admin/productos/'.$producto_id.'/imagenes')}}" autocomplete="off" enctype="multipart/form-data" onsubmit="return validar(this)">
            {{ csrf_field()}}
            <div class="modal-body">
                <input type="hidden" class="form-control-file" id="producto_id" name="producto_id" value="{{$producto_id}}">
                <div class="form-group">                    
                    <input type="file" class="form-control-file" id="imagen" name="imagen">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Cargar</button>
            </div>
            </form>
        </div>
    </div>
</div>


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
