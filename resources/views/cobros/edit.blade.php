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
                <a href="{{ url ('admin/cobros')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/cobros')}}" class="kt-subheader__breadcrumbs-link">
                $titulo </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Editar </a>

                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
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
                    <form method="post" class="form-horizontal" action="{{ url('admin/cobros/'.$data->id.'/edit')}}" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">                                          

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Alumno</label>
                                            <div class="col-9">
                                                <select class="form-control" name="alumno_id" id="alumno_id">
                                                    @foreach ($alumnos as $alumno)
                                                    <option value="{{$alumno->id}}" @if($data->alumno_id==$alumno->id) selected @endif> {{ $alumno->nom_alumno, $data->alumno_id }}</option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Concepto</label>
                                            <div class="col-9">
                                                <select class="form-control" name="concepto_id" id="concepto_id">
                                                    @foreach ($conceptos as $concepto)
                                                    <option value="{{$concepto->id}}" @if($data->concepto_id==$concepto->id) selected @endif> {{ $concepto->nombre, $data->concepto_id }}</option>
                                                    @endforeach                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Mes</label>
                                            <div class="col-9">
                                                <select class="form-control" name="mes_id" id="mes_id">
                                                    @foreach ($meses as $mes)
                                                    <option value="{{$mes->id}}" @if($data->mes_id==$mes->id) selected @endif> {{ $mes->nombre, $data->mes_id }}</option>
                                                    @endforeach                                                 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Banco</label>
                                            <div class="col-9">
                                                <select class="form-control" name="banco_id" id="banco_id">
                                                    @foreach ($bancos as $banco)
                                                    <option value="{{$banco->id}}" @if($data->banco_id==$banco->id) selected @endif> {{ $banco->nombre, $data->banco_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Fecha</label>
                                            <div class="col-9">
                                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $data->fecha) }}" required="">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Valor</label>
                                            <div class="col-9">
                                            <input type="number" class="form-control" id="valor" name="valor" value="{{ old('valor', $data->valor) }}" required="">
                                            </div>
                                        </div>                                        

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Observación</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="observacion" name="observacion" value="{{ old('observacion', $data->observacion) }}" required="">
                                            </div>
                                        </div>

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                            <a href="{{ url ('admin/cobros')}}" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xl-3"></div>
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
