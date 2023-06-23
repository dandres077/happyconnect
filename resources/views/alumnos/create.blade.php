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
                <a href="{{ url ('admin/alumnos')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/alumnos')}}" class="kt-subheader__breadcrumbs-link">
                {{ $titulo }}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                Crear </a>
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
                    <form method="post" class="form-horizontal" action="{{ url('admin/alumnos/store')}}" autocomplete="off" enctype="multipart/form-data" onsubmit="return validar(this)">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">                                        

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Primer nombre </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre1" name="nombre1" value="{{ old('nombre1') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Segundo nombre </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre2" name="nombre2" value="{{ old('nombre2') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Primer apellido </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="apellido1" name="apellido1" value="{{ old('apellido1') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Segundo apellido </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{ old('apellido2') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Tipo documento </label>
                                            <div class="col-9">
                                                <select class="form-control" name="tipo_id" id="tipo_id">
                                                @foreach ($documentos as $documento)
                                                <option value="{{ $documento->id }}"> {{ $documento->opcion }}</option>
                                                @endforeach                                         
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">N° Documento </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="n_documento" name="n_documento" value="{{ old('n_documento') }}" required="">
                                            </div>
                                        </div>                                                                 
                                    </div>
                                </div>    
                            </div>
                            <div class="col-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body"> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Ciudad de expedición </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="exp_municipio" name="exp_municipio" value="{{ old('exp_municipio') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Dpto de expedición </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="exp_depto" name="exp_depto" value="{{ old('exp_depto') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Fecha expedición </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="exp_fecha" name="exp_fecha" value="{{ old('exp_fecha') }}" required="">
                                            </div>
                                        </div>  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">País de origen</label>
                                            <div class="col-9">
                                                <select class="form-control" name="pais_id" id="pais_id">
                                                @foreach ($paises as $paises)
                                                    <option value="{{ $paises->id }}"> {{ $paises->nombre }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Departamento </label>
                                            <div class="col-9">
                                                <select class="form-control" name="departamento_id" id="departamento_id">
                                                @foreach ($dptos as $dpto)
                                                <option value="{{ $dpto->id }}"> {{ $dpto->nombre }}</option>
                                                @endforeach                                                 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Ciudad </label>
                                            <div class="col-9">
                                                <select class="form-control" name="ciudad_id" id="ciudad_id">
                                                @foreach ($ciudades as $ciudad)
                                                <option value="{{ $ciudad->id }}"> {{ $ciudad->nombre }}</option>
                                                @endforeach                                         
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Tipo de Sangre </label>
                                            <div class="col-9">
                                                <select class="form-control" name="sangre_id" id="sangre_id">
                                                @foreach ($sangres as $sangre)
                                                <option value="{{ $sangre->id }}"> {{ $sangre->opcion }}</option>
                                                @endforeach                                         
                                                </select>
                                            </div>
                                        </div>                                       

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                        <div class="kt-form__actions">

                                            <button type="submit" class="btn btn-primary" name="enviar">Crear</button>
                                           
                                            <a href="{{ url ('admin/alumnos')}}" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>                                
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
