@extends('layouts.app')

@section('title', $titulo .' | '.config('app.name'))

@section('style')
<!--begin::Page Custom Styles(used by this page) -->
<link href="{{ asset('assets/css/pages/wizard/wizard-2.css')}}" rel="stylesheet" type="text/css" />
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
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-wizard-v2__aside">

                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v2__nav">                        
                        <div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">
                            <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                <div class="kt-wizard-v2__nav-body">
                                    <div class="kt-wizard-v2__nav-icon">
                                        <i class="flaticon-globe"></i>
                                    </div>
                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Datos personales
                                        </div>
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            Alumno
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v2__nav-body">
                                    <div class="kt-wizard-v2__nav-icon">
                                        <i class="flaticon-bus-stop"></i>
                                    </div>
                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Datos ubicación
                                        </div>
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            Hogar
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                <div class="kt-wizard-v2__nav-body">
                                    <div class="kt-wizard-v2__nav-icon">
                                        <i class="flaticon-network"></i>
                                    </div>
                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Datos familiares
                                        </div>
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            Familia
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v2__nav-body">
                                    <div class="kt-wizard-v2__nav-icon">
                                        <i class="flaticon-book"></i>
                                    </div>
                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Otros datos
                                        </div>
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            Generales
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                <div class="kt-wizard-v2__nav-body">
                                    <div class="kt-wizard-v2__nav-icon">
                                        <i class="flaticon-book"></i>
                                    </div>
                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Facturación
                                        </div>
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            General
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="kt-wizard-v2__nav-item">
                                <div class="kt-wizard-v2__nav-body">
                                    <div class="kt-wizard-v2__nav-icon">
                                        <i class="flaticon-clipboard"></i>
                                    </div>
                                    <div class="kt-wizard-v2__nav-label">
                                        <div class="kt-wizard-v2__nav-label-title">
                                            Documentos
                                        </div>
                                        @foreach ($documentos as $documento)
                                        <div class="kt-wizard-v2__nav-label-desc">
                                            <a href="{{ $documento->archivo }}" target="_blank">{{ $documento->nombre }}</a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

                    <!--begin: Form Wizard Form-->
                    <form class="kt-form" id="kt_form" method="post" action="{{ url('/admin/matriculas/'.$matricula->id.'/edit')}}"  autocomplete="off" onsubmit="return validar(this)">

                        {{ csrf_field()}}
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-heading kt-heading--md">Ingrese por favor la información solicitada  @can('matriculas.ampliar')<a href="{{ url('/admin/matriculas/'.$matricula->id.'/ampliar')}}">[Ampliar tiempo documento]</a>@endcan</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Sede</label>
                                                <select class="form-control" name="sede_id" id="sede_id">
                                                @foreach ($sedes as $sede)
                                                    <option value="{{$sede->id}}" @if($matricula->sede_id==$sede->id) selected @endif> {{ $sede->nombre, $matricula->sede_id }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Temporada</label>
                                                <select class="form-control" name="temporada_id" id="temporada_id">
                                                @foreach ($temporadas as $temporada)
                                                    <option value="{{$temporada->id}}" @if($matricula->temporada_id==$temporada->id) selected @endif> {{ $temporada->nombre, $matricula->temporada_id }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Grado</label>
                                                <select class="form-control" name="grado_id" id="grado_id">
                                                @foreach ($grados as $grado)
                                                    <option value="{{$grado->id}}" @if($matricula->grado_id==$grado->id) selected @endif> {{ $grado->nombre, $matricula->grado_id }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Paralelo</label>
                                                <select class="form-control" name="paralelo_id" id="paralelo_id">
                                                @foreach ($paralelos as $paralelo)
                                                    <option value="{{$paralelo->id}}" @if($matricula->paralelo_id==$paralelo->id) selected @endif> {{ $paralelo->nombre, $matricula->paralelo_id }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Primer nombre</label>
                                                <input type="text" class="form-control" name="nombre1" value="{{ old('nombre', $alumno->nombre1) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Segundo nombre</label>
                                                <input type="text" class="form-control" name="nombre2" value="{{ old('nombre', $alumno->nombre2) }}">
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Primer apellido</label>
                                                <input type="text" class="form-control" name="apellido1" value="{{ old('nombre', $alumno->apellido1) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Segundo apellido</label>
                                                <input type="text" class="form-control" name="apellido2" value="{{ old('nombre', $alumno->apellido2) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de documento</label>
                                                <select class="form-control" name="tipo_id" id="tipo_id">
                                                @foreach ($tipo_docs as $tipo_doc)
                                                    <option value="{{$tipo_doc->id}}" @if($alumno->tipo_id==$tipo_doc->id) selected @endif> {{ $tipo_doc->nombre, $alumno->tipo_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="number" class="form-control" name="n_documento" value="{{ old('nombre', $alumno->n_documento) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>País expedición</label>
                                                <select class="form-control" name="pais_exp" id="pais_exp">
                                                @foreach ($paises as $pais)
                                                    <option value="{{$pais->id}}" @if($alumno->pais_exp==$pais->id) selected @endif> {{ $pais->nombre, $alumno->pais_exp }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Departamemto expedición</label>
                                                <select class="form-control" name="departamento_exp" id="departamento_exp">
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{$departamento->id}}" @if($alumno->departamento_exp==$departamento->id) selected @endif> {{ $departamento->nombre, $alumno->departamento_exp }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>                                                                                                    
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ciudad de expedición</label>
                                                <input type="text" class="form-control" name="ciudad_exp" value="{{ old('nombre', $alumno->ciudad_exp) }}">
                                            </div>
                                        </div> 
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Fecha de expedición</label>
                                                <input class="form-control" type="date" name="exp_fecha" value="{{ old('nombre', $alumno->exp_fecha) }}">   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Genero</label>
                                                <select class="form-control" name="genero_id" id="genero_id">
                                                @foreach ($generos as $genero)
                                                    <option value="{{$genero->id}}" @if($alumno->genero_id==$genero->id) selected @endif> {{ $genero->nombre, $alumno->genero_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>                                                                                                    
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Edad</label>
                                                <input type="number" class="form-control" name="edad" id="edad" value="{{ old('edad', $alumno->edad) }}">
                                            </div>
                                        </div> 
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Fecha de nacimiento</label>
                                                <input class="form-control" type="date" name="fecha_nacimiento" value="{{ old('nombre', $alumno->fecha_nacimiento) }}">   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>País de origen</label>
                                                <select class="form-control" name="pais_origen" id="pais_origen">
                                                @foreach ($paises as $pais)
                                                    <option value="{{$pais->id}}" @if($alumno->pais_origen==$pais->id) selected @endif> {{ $pais->nombre, $alumno->pais_origen }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>                                                                                                   
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Departamento de origen</label>
                                                <select class="form-control" name="departamento_origen" id="departamento_origen">
                                                @foreach ($departamentos as $depto)
                                                    <option value="{{$depto->id}}" @if($alumno->departamento_origen==$depto->id) selected @endif> {{ $depto->nombre, $alumno->departamento_origen }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ciudad de origen</label>
                                                <input type="text" class="form-control" name="ciudad_origen" value="{{ old('nombre', $alumno->ciudad_origen) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Grupo sanguíneo</label>
                                                <select class="form-control" name="sangre_id" id="sangre_id">
                                                @foreach ($grupos as $grupo)
                                                    <option value="{{$grupo->id}}" @if($alumno->sangre_id==$grupo->id) selected @endif> {{ $grupo->nombre, $alumno->sangre_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 1-->

                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Datos de ubicación</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Departamento</label>
                                                <select class="form-control" name="departamento_id" id="departamento_id">
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{$departamento->id}}" @if($matricula->departamento_id==$departamento->id) selected @endif> {{ $departamento->nombre, $matricula->departamento_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ciudad</label>
                                                <input type="text" class="form-control" name="municipio_r" value="{{ old('nombres_p', $matricula->municipio_r) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Comuna</label>
                                                <input type="text" class="form-control" name="comuna_r" value="{{ old('nombres_p', $matricula->comuna_r) }}">
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Barrio</label>
                                                <input type="text" class="form-control" name="barrio_r" value="{{ old('nombres_p', $matricula->barrio_r) }}">
                                            </div>
                                        </div>                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" name="direccion_r" value="{{ old('nombres_p', $matricula->direccion_r) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Zona</label>
                                                <select class="form-control" name="zona_id" id="zona_id">
                                                @foreach ($zonas as $zona)
                                                    <option value="{{$zona->id}}" @if($matricula->zona_id==$zona->id) selected @endif> {{ $zona->nombre, $matricula->zona_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>                                        
                                                                                
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estrato:</label>
                                                <select class="form-control" name="estrato_id" id="estrato_id">
                                                @foreach ($estratos as $estrato)
                                                    <option value="{{$estrato->id}}" @if($matricula->estrato_id==$estrato->id) selected @endif> {{ $estrato->nombre, $matricula->estrato_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo:</label>
                                                <select class="form-control" name="tipo_vivienda_id" id="tipo_vivienda_id">
                                                @foreach ($tipo_casas as $casas)
                                                    <option value="{{$casas->id}}" @if($matricula-> tipo_vivienda_id==$casas->id) selected @endif> {{ $casas->nombre, $matricula-> tipo_vivienda_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>  
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_est" value="{{ old('nombres_p', $matricula->celular_est) }}">
                                            </div>
                                        </div>                                      
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Email alumno</label>
                                                <input type="email" class="form-control" name="email_est" value="{{ old('nombres_p', $matricula->email_est) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 2-->

                        <!--begin: Form Wizard Step 3-->
                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Datos familiares</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">
                                    <div class="kt-wizard-v2__review-title">
                                        <h3>Datos del padre</h3>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="tipo_familiar_p" value="1">

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input type="text" class="form-control" name="nombres_p" value="{{ old('nombres_p', $padre->nombres) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos_p" value="{{ old('nombres_p', $padre->apellidos) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de documento</label>
                                                <select class="form-control" name="tipo_doc_p" id="tipo_doc_p">
                                                @foreach ($tipo_docs as $documento)
                                                    <option value="{{$documento->id}}" @if($padre-> tipo_doc_id==$documento->id) selected @endif> {{ $documento->nombre, $padre-> tipo_doc_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="number" class="form-control" name="n_documento_p" value="{{ old('nombres_p', $padre->n_documento) }}">
                                            </div>
                                        </div>
                                      
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Lugar de expedición</label>
                                                <input type="text" class="form-control" name="exp_municipio_p" value="{{ old('nombres_p', $padre->exp_municipio) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="name" class="form-control" name="direccion_p" value="{{ old('nombres_p', $padre->direccion) }}">
                                            </div>
                                        </div>                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_p" value="{{ old('nombres_p', $padre->telefono) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_p" value="{{ old('nombres_p', $padre->celular) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Profesión</label>
                                                <input type="text" class="form-control" name="profesion_p" value="{{ old('nombres_p', $padre->email) }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nivel educativo</label>
                                                <input type="text" class="form-control" name="nivel_edu_p" value="{{ old('nombres_p', $padre->nivel_educativo) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <input type="text" class="form-control" name="empresa_p" value="{{ old('nombres_p', $padre->empr_nombre) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ocupación</label>
                                                <input type="text" class="form-control" name="ocupacion_p" value="{{ old('nombres_p', $padre->empr_ocupacion) }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" name="direccion_p" value="{{ old('nombres_p', $padre->empr_direccion) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_p" value="{{ old('nombres_p', $padre->empr_telefono) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email_p" value="{{ old('nombres_p', $padre->empr_email) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="kt-wizard-v2__review-title">
                                        <h3>Datos de la madre</h3>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="tipo_familiar_m" value="2">

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input type="text" class="form-control" name="nombres_m" value="{{ old('nombres_p', $madre->nombres) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos_m" value="{{ old('nombres_p', $madre->apellidos) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de documento</label>
                                                <select class="form-control" name="tipo_doc_m" id="tipo_doc_m">
                                                @foreach ($tipo_docs as $documento)
                                                    <option value="{{$documento->id}}" @if($madre-> tipo_doc_id==$documento->id) selected @endif> {{ $documento->nombre, $madre-> tipo_doc_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="number" class="form-control" name="n_documento_m" value="{{ old('nombres_p', $madre->n_documento) }}">
                                            </div>
                                        </div>
                                      
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Lugar de expedición</label>
                                                <input type="text" class="form-control" name="exp_municipio_m" value="{{ old('nombres_p', $madre->exp_municipio) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="name" class="form-control" name="direccion_m" value="{{ old('nombres_p', $madre->direccion) }}">
                                            </div>
                                        </div>                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_m" value="{{ old('nombres_p', $madre->telefono) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_m" value="{{ old('nombres_p', $madre->celular) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Profesión</label>
                                                <input type="text" class="form-control" name="profesion_m" value="{{ old('nombres_p', $madre->profesion) }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nivel educativo</label>
                                                <input type="text" class="form-control" name="nivel_edu_m" value="{{ old('nombres_p', $madre->nivel_educativo) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <input type="text" class="form-control" name="empresa_m" value="{{ old('nombres_p', $madre->empr_nombre) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ocupación</label>
                                                <input type="text" class="form-control" name="ocupacion_m" value="{{ old('nombres_p', $madre->empr_ocupacion) }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" name="direccion_m" value="{{ old('nombres_p', $madre->empr_direccion) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_m" value="{{ old('nombres_p', $madre->empr_telefono) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email_m" value="{{ old('nombres_p', $madre->empr_email) }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="kt-wizard-v2__review-title">
                                        <h3>Otros datos </h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Vive con</label>
                                                <input type="text" class="form-control" name="vive_con" value="{{ old('nombres_p', $matricula->vive_con) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° personas en el hogar</label>
                                                <input type="number" class="form-control" name="n_personas_hogar" value="{{ old('nombres_p', $matricula->n_personas_hogar) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° hermanos</label>
                                                <input type="number" class="form-control" name="n_hermanos" value="{{ old('nombres_p', $matricula->n_hermanos) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° hermanos en el colegio</label>
                                                <input type="number" class="form-control" name="n_hermanos_col" value="{{ old('nombres_p', $matricula->n_hermanos_col) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono familiar</label>
                                                <input type="text" class="form-control" name="telefono_f" value="{{ old('nombres_p', $matricula->telefono_f) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>ICBF</label>
                                                <select class="form-control" name="icbf" id="icbf">
                                                    @if($matricula->telefono_f == 'Si')
                                                    <option value="Si" selected=""> Si</option>
                                                    <option value="No"> No</option>
                                                    @else
                                                    <option value="Si"> Si</option>
                                                    <option value="No" selected=""> No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Familias en acción</label>
                                                <select class="form-control" name="f_accion" id="f_accion">
                                                    @if($matricula->f_accion == 'Si')
                                                    <option value="Si" selected=""> Si</option>
                                                    <option value="No"> No</option>
                                                    @else
                                                    <option value="Si"> Si</option>
                                                    <option value="No" selected=""> No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Barrera de aprendizaje</label>
                                                <select class="form-control" name="nee_id" id="nee_id">
                                                @foreach ($nee as $ne)
                                                    <option value="{{$ne->id}}" @if($matricula->nee_id==$ne->id) selected @endif> {{ $ne->nombre, $matricula->nee_id }}</option>
                                                @endforeach
                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de barrera</label>
                                                <input type="text" class="form-control" name="nee_texto" value="{{ old('nombres_p', $matricula->nee_texto) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nuevo / Antiguo</label>
                                                <select class="form-control" name="nuevo_antiguo" id="nuevo_antiguo">
                                                    @if($matricula->f_accion == 'Nuevo')
                                                    <option value="Nuevo" selected="">Nuevo</option>
                                                    <option value="Antiguo"> Antiguo</option>
                                                    @else
                                                    <option value="Nuevo"> Nuevo</option>
                                                    <option value="Antiguo" selected="">Antiguo</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Colegio procede</label>
                                                <input type="text" class="form-control" name="  col_procede" value="{{ old('nombres_p', $matricula->col_procede) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ciudad procede</label>
                                                <input type="text" class="form-control" name="ciudad_procede" value="{{ old('nombres_p', $matricula->ciudad_procede) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dpto procede</label>
                                                <select class="form-control" name="dpto_id" id="dpto_id">
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{$departamento->id}}" @if($matricula->dpto_id==$departamento->id) selected @endif> {{ $departamento->nombre, $matricula->dpto_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Jornada</label>
                                                <select class="form-control" name="jornada_id" id="jornada_id">
                                                @foreach ($jornadas as $jornada)
                                                    <option value="{{$jornada->id}}" @if($matricula->jornada_id==$jornada->id) selected @endif> {{ $jornada->nombre, $matricula-> jornada_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Repitente</label>
                                                <select class="form-control" name="repitente" id="repitente">
                                                    @if($matricula->repitente == 'Si')
                                                    <option value="Si" selected="">Si</option>
                                                    <option value="No"> No</option>
                                                    @else
                                                    <option value="Si">Si</option>
                                                    <option value="No" selected="">No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estatura</label>
                                                <input type="text" class="form-control" name="estatura" value="{{ old('nombres_p', $matricula->estatura) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Peso</label>
                                                <input type="text" class="form-control" name="peso" value="{{ old('nombres_p', $matricula->peso) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hijo heroe</label>
                                                <select class="form-control" name="hijo_heroe" id="hijo_heroe">
                                                    @if($matricula->hijo_heroe == 'Si')
                                                    <option value="Si" selected="">Si</option>
                                                    <option value="No"> No</option>
                                                    @else
                                                    <option value="Si">Si</option>
                                                    <option value="No" selected="">No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Desvinculado</label>
                                                <select class="form-control" name="desvinculado" id="desvinculado">
                                                    @if($matricula->desvinculado == 'Si')
                                                    <option value="Si" selected="">Si</option>
                                                    <option value="No"> No</option>
                                                    @else
                                                    <option value="Si">Si</option>
                                                    <option value="No" selected="">No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Desmovilizado</label>
                                                <select class="form-control" name="desmovilizado" id="desmovilizado">
                                                    @if($matricula->desmovilizado == 'Si')
                                                    <option value="Si" selected="">Si</option>
                                                    <option value="No"> No</option>
                                                    @else
                                                    <option value="Si">Si</option>
                                                    <option value="No" selected="">No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 3-->

                        <!--begin: Form Wizard Step 4-->
                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Otros datos</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">
                                    <div class="kt-wizard-v2__review-title">
                                        <h3>Acudiente </h3>
                                    </div>
        
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input type="text" class="form-control" name="nombres_acu" value="{{ old('nombres_p', $matricula->nombres_acu) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos_acu" value="{{ old('nombres_p', $matricula->apellidos_acu) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo documento</label>
                                                <select class="form-control" name="tipo_doc_acu_id" id="tipo_doc_acu_id">
                                                @foreach ($tipo_docs as $documento)
                                                    <option value="{{$documento->id}}" @if($matricula->tipo_doc_id==$documento->id) selected @endif> {{ $documento->nombre, $matricula-> tipo_doc_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° documento</label>
                                                <input type="number" class="form-control" name="n_documento_acu" value="{{ old('nombres_p', $matricula->n_documento_acu) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Expedida en</label>
                                                <input type="text" class="form-control" name="expedida_acu" value="{{ old('nombres_p', $matricula->expedida_acu) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" name="direccion_acu" value="{{ old('nombres_p', $matricula->direccion_acu) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_acu" value="{{ old('nombres_p', $matricula->telefono_acu) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_acu" value="{{ old('nombres_p', $matricula->celular_acu) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email_acu" value="{{ old('nombres_p', $matricula->email_acu) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <input type="text" class="form-control" name="empresa_acu" value="{{ old('nombres_p', $matricula->empresa_acu) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Profesión</label>
                                                <input type="text" class="form-control" name="profesion_acu" value="{{ old('nombres_p', $matricula->profesion_acu) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Parentesco</label>
                                                <input type="text" class="form-control" name="parentesco_acu" value="{{ old('nombres_p', $matricula->parentesco_acu) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="kt-wizard-v2__review-title">
                                        <h3>Referencias personales </h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>De:</label>
                                                <input type="text" class="form-control" name="nom_eps" placeholder="Padre o Madre">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nombre: (Personal)</label>
                                                <input type="text" class="form-control" name="nom_eps">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono:</label>
                                                <input type="text" class="form-control" name="nom_eps">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nombre: (Familiar)</label>
                                                <input type="text" class="form-control" name="nom_eps">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono:</label>
                                                <input type="text" class="form-control" name="nom_eps">
                                            </div>
                                        </div>
                                    </div>-->

                                    <div class="kt-wizard-v2__review-title">
                                        <h3>Sistema de Salud del estudiante</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nombre EPS</label>
                                                <input type="text" class="form-control" name="nombre_eps" value="{{ old('nombres_p', $matricula->nombre_eps) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Beneficiario Sisben</label>
                                                <select class="form-control" name="beneficiario_sisben" required="">
                                                    @if($matricula->beneficiario_sisben == 'Si')
                                                    <option value="Si" selected="">Si</option>
                                                    <option value="No"> No</option>
                                                    @else
                                                    <option value="Si">Si</option>
                                                    <option value="No" selected="">No</option>
                                                    @endif                                    
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Alergias o Enfermedades</label>
                                                <input type="text" class="form-control" name="alergias" value="{{ old('nombres_p', $matricula->alergias) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Medicamentos</label>
                                                <input type="text" class="form-control" name="medicamentos" required="" value="{{ old('nombres_p', $matricula->medicamentos) }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="kt-wizard-v2__review-title">
                                        <h3>Información para Ministerio de Educación y Protección Social</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Discapacidad</label>
                                                <input type="text" class="form-control" name="discapacidad" required="" value="{{ old('nombres_p', $matricula->discapacidad) }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Etnia</label>
                                                <input type="text" class="form-control" name="etnia" required="" value="{{ old('nombres_p', $matricula->etnia) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Resguardo</label>
                                                <input type="text" class="form-control" name="resguardo" required="" value="{{ old('nombres_p', $matricula->resguardo) }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Población Victima de Conflicto/Observación</label>
                                                <input type="text" class="form-control" name="conflicto" required="" value="{{ old('nombres_p', $matricula->conflicto) }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 4-->

                        <!--begin: Form Wizard Step 5-->
                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Facturación</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">
                                    <div class="kt-wizard-v2__review-title">
                                        <h3>General </h3>
                                    </div>
        
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nombre completo</label>
                                                <input type="text" class="form-control" name="nombres_fac" value="{{ old('nombres_fac', $matricula->nombres_fac) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo documento</label>
                                                <select class="form-control" name="tipo_doc_fac_id" id="tipo_doc_fac_id">
                                                @foreach ($tipo_docs as $documento)
                                                    <option value="{{ $documento->id }}"> {{ $documento->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° documento</label>
                                                <input type="number" class="form-control" name="n_documento_fac" value="{{ old('n_documento_fac', $matricula->n_documento_fac) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" name="direccion_fac" value="{{ old('direccion_fac', $matricula->direccion_fac) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label> 
                                                <input type="email" class="form-control" name="email_fac" value="{{ old('email_fac', $matricula->email_fac) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_fac" value="{{ old('celular_fac', $matricula->celular_fac) }}">
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 5-->

                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                Anterior
                            </button>
                            @can('matriculas.update')
                            <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                Enviar
                            </button>
                            @endcan
                            <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                Siguiente
                            </button>
                        </div>

                        <!--end: Form Actions -->
                    </form>

                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Content -->

@endsection
    
@section('scripts')
<script src="{{ asset('assets/js/pages/custom/wizard/wizard-2.js')}}"></script>

<script type="text/javascript">
  $('#grado_id').on('change', function(e){
    //console.log(e);
    var grado_id = e.target.value;
    var temporada_id = $("#temporada_id").val();
    var empresa_id = {!! $empresa !!}

    $.get("{{env('APP_URL')}}/api/paralelos/" + empresa_id + "/" + temporada_id+ "/" + grado_id, function(data) {
      console.log(data);

      $('#paralelo_id').empty();

      $.each(data, function(index, regenciesObj){
        $('#paralelo_id').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.nombre +'</option>');
      })
    });
  });

</script>

<script type="text/javascript">
  $('#pais_exp').on('change', function(e){
    var pais_id = e.target.value;

    $.get("{{env('APP_URL')}}/api/departamentos/" + pais_id, function(data) {
      //console.log(data);

      $('#departamento_exp').empty();

      $.each(data, function(index, regenciesObj){
        $('#departamento_exp').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.nombre +'</option>');
      })
    });
  });
</script>

<script type="text/javascript">
  $('#pais_origen').on('change', function(e){
    var pais_id = e.target.value;

    $.get("{{env('APP_URL')}}/api/departamentos/" + pais_id, function(data) {
      //console.log(data);

      $('#departamento_origen').empty();

      $.each(data, function(index, regenciesObj){
        $('#departamento_origen').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.nombre +'</option>');
      })
    });
  });
</script>

@endsection
