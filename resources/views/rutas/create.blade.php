@extends('layouts.app')

@section('title', $titulo .' | '.config('app.name'))

@section('style')
    
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
                Crear</a>
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
                        <h3 class="kt-portlet__head-title">Ingresa la información <small>** obligatorio</small></h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form method="post" class="form-horizontal" action="{{ url('/admin/rutas/store')}}" autocomplete="off" enctype="multipart/form-data">
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
                                                    <option value="{{ $temporada->id }}"> {{ $temporada->nombre }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>    

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Proveedor </label>
                                            <div class="col-9">
                                                <select class="form-control" name="proveedor_id" id="proveedor_id">
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}"> {{ $proveedor->empresa }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>                         

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nombre Ruta</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required="">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Marca</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca') }}" required="">
                                            </div>
                                        </div>  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Modelo</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}" required="">
                                            </div>
                                        </div>   

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Placa</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="placa" name="placa" value="{{ old('placa') }}" required="">
                                            </div>
                                        </div>                                                                                                                   
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xl-6">

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Conductor(es)</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="conductor" name="conductor" value="{{ old('conductor') }}" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono conductor(es)</label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">N°</span></div>
                                            <input type="text" class="form-control" id="tel_conductor" name="tel_conductor" value="{{ old('tel_conductor') }}" required="">
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Monitor(es)</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="monitor" name="monitor" value="{{ old('monitor') }}" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Teléfono monitor(es)</label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">N°</span></div>
                                            <input type="text" class="form-control" id="tel_monitor" name="tel_monitor" value="{{ old('tel_monitor') }}" required="">
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Imágen</label>
                                    <div class="col-9">
                                    <input type="file" class="form-control-file" name="imagen" id="imagen">
                                    </div>
                                </div>   

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Observaciones</label>
                                    <div class="col-9">
                                    <textarea class="form-control" id="observaciones" name="observaciones" rows="4" cols="50">{{ old('observaciones') }}</textarea>
                                    </div>
                                </div>                                     
                            </div>  

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Crear</button>
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

<!-- end:: Content -->

@endsection
    
@section('scripts')


@endsection
