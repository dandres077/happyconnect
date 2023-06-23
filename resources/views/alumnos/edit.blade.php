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
                    <form method="post" class="form-horizontal" action="{{ url('admin/alumnos/'.$data->id.'/edit')}}" autocomplete="off" enctype="multipart/form-data" onsubmit="return validar(this)">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">                                         

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Primer nombre </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre1" name="nombre1" value="{{ old('nombre1', $data->nombre1) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Segundo nombre </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre2" name="nombre2" value="{{ old('nombre2', $data->nombre2) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Primer apellido </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="apellido1" name="apellido1" value="{{ old('apellido1', $data->apellido1) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Segundo apellido </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{ old('apellido2', $data->apellido2) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Tipo documento </label>
                                            <div class="col-9">
                                                <select class="form-control" name="tipo_id" id="tipo_id">
                                               @foreach ($documentos as $documento)
                                                <option value="{{$documento->id}}" @if($data->tipo_id==$documento->id) selected @endif> {{ $documento->nombre, $data->tipo_id }}</option>
                                                @endforeach                                            
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">N° Documento </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="n_documento" name="n_documento" value="{{ old('n_documento', $data->n_documento) }}" required="">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">País expedición</label>
                                            <div class="col-9">
                                                <select class="form-control" name="pais_exp" id="pais_exp">
                                                @foreach ($paises as $pais)
                                                    <option value="{{$pais->id}}" @if($data->pais_exp==$pais->id) selected @endif> {{ $pais->nombre, $data->pais_exp }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Departamento expedición</label>
                                            <div class="col-9">
                                                <select class="form-control" name="departamento_exp" id="departamento_exp">
                                                @foreach ($dptos as $dpto)
                                                <option value="{{$dpto->id}}" @if($data->departamento_exp==$dpto->id) selected @endif> {{ $dpto->nombre, $data->departamento_exp }}</option>
                                                @endforeach                                                 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Ciudad expedición </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="ciudad_exp" name="ciudad_exp" value="{{ old('ciudad_exp', $data->ciudad_exp) }}" required="">
                                            </div>
                                        </div>                                                                 
                                    </div>
                                </div>    
                            </div>
                            <div class="col-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">                                        

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Fecha expedición </label>
                                            <div class="col-9">
                                            <input type="date" class="form-control" id="exp_fecha" name="exp_fecha" value="{{ old('exp_fecha', $data->exp_fecha) }}" required="">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">País origen</label>
                                            <div class="col-9">
                                                <select class="form-control" name="pais_origen" id="pais_origen">
                                                @foreach ($paises as $pais)
                                                    <option value="{{$pais->id}}" @if($data->pais_origen==$pais->id) selected @endif> {{ $pais->nombre, $data->pais_origen }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Departamento origen</label>
                                            <div class="col-9">
                                                <select class="form-control" name="departamento_origen" id="departamento_origen">
                                                @foreach ($dptos as $dpto)
                                                <option value="{{$dpto->id}}" @if($data->departamento_origen==$dpto->id) selected @endif> {{ $dpto->nombre, $data->departamento_origen }}</option>
                                                @endforeach                                                 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Ciudad origen </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="ciudad_origen" name="ciudad_origen" value="{{ old('ciudad_origen', $data->ciudad_origen) }}" required="">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Tipo de Sangre </label>
                                            <div class="col-9">
                                                <select class="form-control" name="sangre_id" id="sangre_id">
                                               @foreach ($sangres as $sangre)
                                                <option value="{{$sangre->id}}" @if($data->sangre_id==$sangre->id) selected @endif> {{ $sangre->nombre, $data->sangre_id }}</option>
                                                @endforeach                                            
                                                </select>
                                            </div>
                                        </div>                                     

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                        <div class="kt-form__actions">

                                            <button type="submit" class="btn btn-primary" name="enviar">Actualizar</button>
                                           
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
