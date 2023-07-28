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
                <a href="{{ url ('admin/observaciones')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/observaciones')}}" class="kt-subheader__breadcrumbs-link">
                {{ $titulo }}</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                Editar</a>
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
                    <form method="post" class="form-horizontal" action="{{ url('admin/observaciones/'.$data->id.'/edit')}}" autocomplete="off" enctype="multipart/form-data" onsubmit="return validar(this)">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Temporada </label>
                                            <div class="col-9">
                                                <select class="form-control" name="temporada_id" id="temporada_id">
                                                @foreach ($temporadas as $temporada)
                                                    <option value="{{$temporada->id}}" @if($data->temporada_id==$temporada->id) selected @endif> {{ $temporada->nombre, $data->temporada_id }}</option>
                                                @endforeach                                                                                                  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Periodo </label>
                                            <div class="col-9">
                                                <select class="form-control" name="periodo_id" id="periodo_id">
                                                @foreach ($periodos as $periodo)
                                                    <option value="{{$periodo->id}}" @if($data->periodo_id==$periodo->id) selected @endif> {{ $periodo->nombre, $data->periodo_id }}</option>
                                                @endforeach                                               
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Grado </label>
                                            <div class="col-9">
                                                <select class="form-control" name="grado_id" id="grado_id">
                                                @foreach ($grados as $grado)
                                                    <option value="{{$grado->id}}" @if($data->grado_id==$grado->id) selected @endif> {{ $grado->nombre, $data->grado_id }}</option>
                                                @endforeach                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Paralelo </label>
                                            <div class="col-9">
                                                <select class="form-control" name="paralelo_id" id="paralelo_id">
                                                @foreach ($paralelos as $paralelo)
                                                    <option value="{{$paralelo->id}}" @if($data->paralelo_id==$paralelo->id) selected @endif> {{ $paralelo->nombre, $data->paralelo_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Asignatura </label>
                                            <div class="col-9">
                                                <select class="form-control" name="asignatura_id" id="asignatura_id">
                                                @foreach ($asignaturas as $asignatura)
                                                    <option value="{{$asignatura->id}}" @if($data->asignatura_id==$asignatura->id) selected @endif> {{ $asignatura->nombre, $data->asignatura_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Alumno </label>
                                            <div class="col-9">
                                                <select class="form-control" name="alumno_id" id="alumno_id">
                                                @foreach ($alumnos as $alumno)
                                                    <option value="{{$alumno->id}}" @if($data->alumno_id==$alumno->id) selected @endif> {{ $alumno->nombre, $data->alumno_id }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Observación </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="observaciones" name="observaciones" value="{{ old('observaciones', $data->observaciones) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Imagen 
                                            @if ($data->imagen != null) 
                                            <a href="{{$data->imagen}}" target="_blank"><i class="flaticon-eye"></i></a>                 
                                            @endif
                                            </label>
                                            <div class="col-9">
                                            <input type="file" class="form-control-file" name="imagen" id="imagen" required>
                                            </div>
                                        </div>    

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                        <div class="kt-form__actions">
                                            @can('observaciones.store')
                                            <button type="submit" class="btn btn-primary" name="enviar">Crear</button>
                                            @endcan
                                            <a href="{{ url ('admin/observaciones')}}" class="btn btn-secondary">Cancelar</a>
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
@endsection
