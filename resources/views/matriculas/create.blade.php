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
                <a href="{{ url ('admin/matriculas')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/matriculas')}}" class="kt-subheader__breadcrumbs-link">
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
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

                    <!--begin: Form Wizard Form-->
                    <form class="kt-form" id="kt_form" method="post" action="{{ url('admin/matriculas/store')}}"  autocomplete="off" onsubmit="return validar(this)">
                        {{ csrf_field()}}
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-heading kt-heading--md">Ingrese por favor la información solicitada </div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__form">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Sede</label>
                                                <select class="form-control" name="sede_id" id="sede_id">
                                                @foreach ($sedes as $sede)
                                                    <option value="{{ $sede->id }}"> {{ $sede->nombre }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Temporadas</label>
                                                <select class="form-control" name="temporada_id" id="temporada_id">
                                                @foreach ($temporadas as $temporada)
                                                    <option value="{{ $temporada->id }}"> {{ $temporada->nombre }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Grado</label>
                                                <select class="form-control" name="grado_id" id="grado_id">
                                                @foreach ($grados as $grado)
                                                    <option value="{{ $grado->id }}"> {{ $grado->nombre }}</option>
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
                                                    <option value="{{ $paralelo->id }}"> {{ $paralelo->nombre }}</option>
                                                @endforeach   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Primer nombre</label>
                                                <input type="text" class="form-control" name="nombre1" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Segundo nombre</label>
                                                <input type="text" class="form-control" name="nombre2">
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Primer apellido</label>
                                                <input type="text" class="form-control" name="apellido1" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Segundo apellido</label>
                                                <input type="text" class="form-control" name="apellido2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de documento</label>
                                                <select class="form-control" name="tipo_id" id="tipo_id">
                                                @foreach ($tipo_docs as $documento)
                                                    <option value="{{ $documento->id }}"> {{ $documento->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="number" class="form-control" name="n_documento" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>País expedición</label>
                                                <select class="form-control" name="pais_exp" id="pais_exp">
                                                @foreach ($paises as $pais)
                                                    <option value="{{ $pais->id }}"> {{ $pais->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Departamemto expedición</label>
                                                <select class="form-control" name="departamento_exp" id="departamento_exp">
                                                @foreach ($departamentos as $dpto)
                                                    <option value="{{ $dpto->id }}"> {{ $dpto->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>                                                                                                       
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ciudad de expedición</label>
                                                <input type="text" class="form-control" name="ciudad_exp" id="ciudad_exp" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Fecha de expedición</label>
                                                <input class="form-control" type="date" value="2010-01-01" name="exp_fecha" required="">   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Genero</label>
                                                <select class="form-control" name="genero_id" id="genero_id">
                                                @foreach ($generos as $genero)
                                                    <option value="{{ $genero->id }}"> {{ $genero->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>                                                                                                     
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Edad</label>
                                                <input type="number" class="form-control" name="edad" id="edad" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Fecha de nacimiento</label>
                                                <input class="form-control" type="date" value="2000-01-01" name="fecha_nacimiento" required="">   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>País de origen</label>
                                                <select class="form-control" name="pais_origen" id="pais_origen">
                                                @foreach ($paises as $pais)
                                                    <option value="{{ $pais->id }}"> {{ $pais->nombre }}</option>
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
                                                    <option value="{{ $depto->id }}"> {{ $depto->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ciudad de origen</label>
                                                <input type="text" class="form-control" name="ciudad_origen">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Grupo sanguíneo</label>
                                                <select class="form-control" name="sangre_id" id="sangre_id">
                                                @foreach ($grupos as $grupo)
                                                    <option value="{{ $grupo->id }}"> {{ $grupo->nombre }}</option>
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
                                                    <option value="{{ $departamento->id }}"> {{ $departamento->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ciudad</label>
                                                <input type="text" class="form-control" name="municipio_r" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Comuna o localidad</label>
                                                <input type="text" class="form-control" name="comuna_r">
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Barrio</label>
                                                <input type="text" class="form-control" name="barrio_r" required="">
                                            </div>
                                        </div>                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" name="direccion_r" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Zona</label>
                                                <select class="form-control" name="zona_id" id="zona_id">
                                                @foreach ($zonas as $zona)
                                                    <option value="{{ $zona->id }}"> {{ $zona->nombre }}</option>
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
                                                    <option value="{{ $estrato->id }}"> {{ $estrato->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo:</label>
                                                <select class="form-control" name="tipo_vivienda_id" id="tipo_vivienda_id">
                                                @foreach ($tipo_casas as $casas)
                                                    <option value="{{ $casas->id }}"> {{ $casas->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>  
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_est">
                                            </div>
                                        </div>                                      
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Email alumno</label>
                                                <input type="email" class="form-control" name="email_est" required="">
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
                                                <input type="text" class="form-control" name="nombres_p" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos_p" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de documento</label>
                                                <select class="form-control" name="tipo_doc_p" id="tipo_doc_p">
                                                @foreach ($tipo_docs as $documento)
                                                    <option value="{{ $documento->id }}"> {{ $documento->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="number" class="form-control" name="n_documento_p">
                                            </div>
                                        </div>
                                      
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Lugar de expedición</label>
                                                <input type="text" class="form-control" name="exp_municipio_p">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="name" class="form-control" name="direccion_p">
                                            </div>
                                        </div>                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_p">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_p">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Profesión</label>
                                                <input type="text" class="form-control" name="profesion_p">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nivel educativo</label>
                                                <input type="text" class="form-control" name="nivel_edu_p">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <input type="text" class="form-control" name="empresa_p">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ocupación</label>
                                                <input type="text" class="form-control" name="ocupacion_p">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección empresa</label>
                                                <input type="text" class="form-control" name="direccion_p">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono empresa</label>
                                                <input type="text" class="form-control" name="telefono_p">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email_p">
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
                                                <input type="text" class="form-control" name="nombres_m" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos_m" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de documento</label>
                                                <select class="form-control" name="tipo_doc_m" id="tipo_doc_m">
                                                @foreach ($tipo_docs as $documento)
                                                    <option value="{{ $documento->id }}"> {{ $documento->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="number" class="form-control" name="n_documento_m">
                                            </div>
                                        </div>
                                      
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Lugar de expedición</label>
                                                <input type="text" class="form-control" name="exp_municipio_m">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="name" class="form-control" name="direccion_m">
                                            </div>
                                        </div>                                        
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_m">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_m">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Profesión</label>
                                                <input type="text" class="form-control" name="profesion_m">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nivel educativo</label>
                                                <input type="text" class="form-control" name="nivel_edu_m">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <input type="text" class="form-control" name="empresa_m">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ocupación</label>
                                                <input type="text" class="form-control" name="ocupacion_m">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección empresa</label>
                                                <input type="text" class="form-control" name="direccion_m">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono empresa</label>
                                                <input type="text" class="form-control" name="telefono_m">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email_m">
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
                                                <input type="text" class="form-control" name="vive_con" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° personas en el hogar</label>
                                                <input type="number" class="form-control" name="n_personas_hogar">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° hermanos</label>
                                                <input type="number" class="form-control" name="n_hermanos">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° hermanos en el colegio</label>
                                                <input type="number" class="form-control" name="n_hermanos_col">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono familiar</label>
                                                <input type="text" class="form-control" name="telefono_f" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>ICBF</label>
                                                <select class="form-control" name="icbf" id="icbf">
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Familias en acción</label>
                                                <select class="form-control" name="f_accion" id="f_accion">
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Barrera de aprendizaje</label>
                                                <select class="form-control" name="nee_id" id="nee_id">
                                                @foreach ($nee as $nee)
                                                    <option value="{{ $nee->id }}"> {{ $nee->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de barrera</label>
                                                <input type="text" class="form-control" name="nee_texto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nuevo / Antiguo</label>
                                                <select class="form-control" name="nuevo_antiguo" id="nuevo_antiguo">
                                                    <option value="Nuevo"> Nuevo</option>
                                                    <option value="Antiguo"> Antiguo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Colegio procede</label>
                                                <input type="text" class="form-control" name="  col_procede">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ciudad procede</label>
                                                <input type="text" class="form-control" name="ciudad_procede">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dpto procede</label>
                                                <select class="form-control" name="dpto_id" id="dpto_id">
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->id }}"> {{ $departamento->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Jornada</label>
                                                <select class="form-control" name="jornada_id" id="jornada_id">
                                                @foreach ($jornadas as $jornada)
                                                    <option value="{{ $jornada->id }}"> {{ $jornada->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Repitente</label>
                                                <select class="form-control" name="repitente" id="repitente">
                                                    <option value="Si"> Si</option>
                                                    <option value="Si"> No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estatura</label>
                                                <input type="text" class="form-control" name="estatura">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Peso</label>
                                                <input type="text" class="form-control" name="peso">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Hijo heroe</label>
                                                <select class="form-control" name="hijo_heroe" id="hijo_heroe">
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Desvinculado</label>
                                                <select class="form-control" name="desvinculado" id="desvinculado">
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Desmovilizado</label>
                                                <select class="form-control" name="desmovilizado" id="desmovilizado">
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
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
                                                <input type="text" class="form-control" name="nombres_acu" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" name="apellidos_acu" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo documento</label>
                                                <select class="form-control" name="tipo_doc_acu_id" id="tipo_doc_acu_id">
                                                @foreach ($tipo_docs as $documento)
                                                    <option value="{{ $documento->id }}"> {{ $documento->nombre }}</option>
                                                @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>N° documento</label>
                                                <input type="number" class="form-control" name="n_documento_acu" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Expedida en</label>
                                                <input type="text" class="form-control" name="expedida_acu">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label> 
                                                <input type="text" class="form-control" name="direccion_acu" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_acu">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_acu" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email_acu" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Empresa</label>
                                                <input type="text" class="form-control" name="empresa_acu">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Profesión</label>
                                                <input type="text" class="form-control" name="profesion_acu">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Parentesco</label>
                                                <input type="text" class="form-control" name="parentesco_acu" required="">
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
                                                <input type="text" class="form-control" name="nombre_eps" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Beneficiario Sisben</label>
                                                <select class="form-control" name="beneficiario_sisben" required="">
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>                                      
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Alergias o Enfermedades</label>
                                                <input type="text" class="form-control" name="alergias" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Medicamentos</label>
                                                <input type="text" class="form-control" name="medicamentos" required="">
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
                                                <input type="text" class="form-control" name="discapacidad" required="" >
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Etnia</label>
                                                <input type="text" class="form-control" name="etnia" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Resguardo</label>
                                                <input type="text" class="form-control" name="resguardo" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Población Victima de Conflicto/Observación</label>
                                                <input type="text" class="form-control" name="conflicto" required="">
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
                                                <input type="text" class="form-control" name="nombres_fac" required="">
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
                                                <input type="number" class="form-control" name="n_documento_fac" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" name="direccion_fac">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label> 
                                                <input type="email" class="form-control" name="email_fac" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Celular</label>
                                                <input type="text" class="form-control" name="celular_fac" required="">
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
                            @can('matriculas.store')
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
<!--begin::Page Scripts(used by this page) -->
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
