@extends('layouts.app')

@section('title', $titulo .' | '.config('app.name'))

@section('style')
<link href="https://gestor.virtual.uniandes.edu.co/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
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
                <a href="{{ url ('admin/periodos')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/periodos')}}" class="kt-subheader__breadcrumbs-link">
                {{ $titulo }}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                Editar </a>
            </div>
        </div>
    </div>
</div>

<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">{{ $titulo }}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form method="post" class="form-horizontal" action="{{ url('admin/periodos/'.$data->id.'/edit')}}" autocomplete="off">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">  
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Temporada</label>
                                            <div class="col-9">
                                                <select class="form-control" name="temporada_id" id="temporada_id">
                                                @foreach ($temporadas as $temporada)
                                                    <option value="{{$temporada->id}}" @if($data->temporada_id==$temporada->id) selected @endif> {{ $temporada->nombre, $data->temporada_id }}</option>
                                                @endforeach                                               
                                                </select>
                                            </div>
                                        </div>  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Fecha Inicio </label>
                                            <div class="col-9">                            
                                            <input class="form-control" type="date" value="{{ old('nombre', $data->fecha_inicio) }}" id="fecha_inicio" name="fecha_inicio" required="">       
                                            </div>
                                        </div>  
                                        
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">T. Final </label>
                                            <div class="col-9">
                                                <select class="form-control" name="final" id="final">
                                                    @if($data->final == 'Si')
                                                    <option value="Si" selected>Si</option>
                                                    <option value="No">No</option>
                                                    @else
                                                    <option value="Si">Si</option>
                                                    <option value="No" selected>No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>                                
                            </div>

                            <div class="col-sm-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nombre </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $data->nombre) }}" required="">
                                            </div>
                                        </div>                              

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Fecha Fin </label>
                                            <div class="col-9">                            
                                            <input class="form-control" type="date" value="{{ old('nombre', $data->fecha_fin) }}" id="fecha_fin" name="fecha_fin" required="">       
                                            </div>
                                        </div>                               
                                    </div>
                                </div>                                
                            </div>
                        </div>

                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                        <div class="kt-form__actions">
                            @can('periodos.update')
                            <button type="submit" class="btn btn-primary" name="enviar">Actualizar</button>
                            @endcan
                            <a href="{{ url ('admin/periodos')}}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
</div>

<!-- end:: Content -->

@endsection
    
@section('scripts')


@endsection
