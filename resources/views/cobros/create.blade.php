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
                    Crear </a>

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
                    <form method="post" class="form-horizontal" action="{{ url('admin/cobros/store')}}" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">                                          

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Temporada</label>
                                            <div class="col-9">
                                                <select class="form-control" name="temporada_id" id="temporada_id">
                                                    @foreach ($temporadas as $temporada)
                                                    <option value="{{ $temporada->id }}"> {{ $temporada->nombre }}</option>
                                                    @endforeach                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Concepto</label>
                                            <div class="col-9">
                                                <select class="form-control" name="concepto_id" id="concepto_id">
                                                    @foreach ($conceptos as $concepto)
                                                    <option value="{{ $concepto->id }}"> {{ $concepto->nombre }}</option>
                                                    @endforeach                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Mes</label>
                                            <div class="col-9">
                                                <select class="form-control" name="mes_id" id="mes_id">
                                                    @foreach ($meses as $mes)
                                                    <option value="{{ $mes->id }}"> {{ $mes->nombre }}</option>
                                                    @endforeach                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Banco</label>
                                            <div class="col-9">
                                                <select class="form-control" name="banco_id" id="banco_id">
                                                    @foreach ($bancos as $banco)
                                                    <option value="{{ $banco->id }}"> {{ $banco->nombre }}</option>
                                                    @endforeach                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Fecha</label>
                                            <div class="col-9">
                                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required="">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Valor</label>
                                            <div class="col-9">
                                            <input type="number" class="form-control" id="valor" name="valor" value="{{ old('valor') }}" required="">
                                            </div>
                                        </div>                                        

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Observación</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="observacion" name="observacion" value="{{ old('observacion') }}" required="">
                                            </div>
                                        </div>

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary">Crear</button>
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

<script type="text/javascript">
  $('#conjunto_id').on('change', function(e){
    //console.log(e);
    var province_id = e.target.value;

    $.get('{{env('APP_URL')}}/api/torre/' + province_id,function(data) {
      console.log(data);

      $('#torre_id').empty();
      $('#bien_id').empty();

      $.each(data, function(index, regenciesObj){
        $('#torre_id').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.nombre +'</option>');
      })
    });
  });

</script>

<script type="text/javascript">
  $('#torre_id').on('change', function(e){
    //console.log(e);
    var province_id = e.target.value;

    $.get('{{env('APP_URL')}}/api/bienes/' + province_id,function(data) {
      console.log(data);

      //$('#torre_id').empty();
      $('#bien_id').empty();

      $.each(data, function(index, regenciesObj){
        $('#bien_id').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.nombre +'</option>');
      })
    });
  });

</script>

@endsection
