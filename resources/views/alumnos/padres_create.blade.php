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
                        <h3 class="kt-portlet__head-title">Alumno: {{ $alumno->nombre1.' '.$alumno->apellido1}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form method="post" class="form-horizontal" action="{{ url('admin/alumnos/padres/store')}}" autocomplete="off" enctype="multipart/form-data" onsubmit="return validar(this)">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">   

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Familiar </label>
                                            <div class="col-9">
                                                <select class="form-control" name="tipo_familiar" id="tipo_familiar">
                                                @foreach ($tipo_padres as $tipo)
                                                <option value="{{ $tipo->id }}"> {{ $tipo->opcion }}</option>
                                                @endforeach                                         
                                                </select>
                                            </div>
                                        </div>                                     

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nombres </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombres" name="nombres" value="{{ old('nombres') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Apellidos </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required="">
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

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Ciudad de expedición </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="exp_municipio" name="exp_municipio" value="{{ old('exp_municipio') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Dirección</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Teléfono </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Celular </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular') }}" required="">
                                            </div>
                                        </div>

                                        <input type="hidden" name="alumno_id" value="{{ old($alumno->id) }}">
                                                                                                        
                                    </div>
                                </div>    
                            </div>
                            <div class="col-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">      

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Profesión </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="profesion" name="profesion" value="{{ old('profesion') }}" required="">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nivel educativo </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nivel_educativo" name="nivel_educativo" value="{{ old('nivel_educativo') }}" required="">
                                            </div>
                                        </div>                                   

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Empresa </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="empr_nombre" name="empr_nombre" value="{{ old('empr_nombre') }}" required="">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Ocupación </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="empr_ocupacion" name="empr_ocupacion" value="{{ old('empr_ocupacion') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Dirección </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="    empr_direccion" name=" empr_direccion" value="{{ old(' empr_direccion') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Teléfono </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="empr_telefono" name="empr_telefono" value="{{ old('empr_telefono') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Email </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="empr_email" name="empr_email" value="{{ old('empr_email') }}" required="">
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
