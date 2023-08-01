@extends('layouts.app')

@section('title', $titulo .' | '.config('app.name'))

@section('style')
<link href="{{ asset('assets/css/pages/inbox/inbox.css')}}" rel="stylesheet" type="text/css" />

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
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                {{ $titulo }} </a>

                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--Begin::Inbox-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver-desktop  kt-inbox" id="kt_inbox">

        <!--Begin::Aside Mobile Toggle-->
        <button class="kt-inbox__aside-close" id="kt_inbox_aside_close">
            <i class="la la-close"></i>
        </button>

        <!--End:: Aside Mobile Toggle-->

        <!--Begin:: Inbox Aside-->
        @include('mensajes.columna_lateral')

        <!--End::Aside-->

        <!--Begin:: Inbox List-->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Redactar</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form method="post" class="form-horizontal" action="{{ url('admin/mensajes/store')}}" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body"> 

                                        @if($permiso == 2 || $permiso == 1)
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Grado</label>
                                            <div class="col-9">
                                                <select class="form-control" name="grado_id" id="grado_id">
                                                    @foreach ($grados as $grado)
                                                    <option value="{{ $grado->id }}"> {{ $grado->nombre }}</option>
                                                    @endforeach                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Paralelos</label>
                                            <div class="col-9">
                                                <select class="form-control" name="paralelo_id" id="paralelo_id">
                                                    @foreach ($paralelos as $paralelo)
                                                    <option value="{{ $paralelo->id }}"> {{ $paralelo->nombre }}</option>
                                                    @endforeach                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Alumno</label>
                                            <div class="col-9">
                                                <select class="form-control" name="usuario_recibe" id="usuario_recibe">
                                              
                                                </select>
                                            </div>
                                        </div>
                                        @else

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Funcionario</label>
                                            <div class="col-9">
                                                <select class="form-control" name="usuario_recibe" id="usuario_recibe">
                                                    @foreach ($funcionarios as $funcinario)
                                                    <option value="{{ $funcinario->id }}"> {{ $funcinario->nombre }}</option>
                                                    @endforeach                                                   
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Asunto</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="asunto" name="asunto" value="{{ old('asunto') }}" required="">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Adjunto</label>
                                            <div class="col-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="adjunto" id="adjunto">
                                                    <label class="custom-file-label selected" for="customFile"></label>
                                                </div>
                                            </div>
                                        </div>                                         

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <textarea id="kt-tinymce-1" name="mensaje" class="tox-target" >
                                                    
                                                </textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" name="temporada_id" value="{{ $temporada_id }}">

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
                                            <a href="{{ url ('admin/mensajes')}}" class="btn btn-secondary">Cancelar</a>
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

        <!--End:: Inbox View-->
    </div>

    <!--End::Inbox-->

    
</div>

<!-- end:: Content -->


@endsection

   
@section('scripts')
    

<!--begin::Page Vendors(used by this page) -->
<script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{asset('assets/js/pages/crud/forms/editors/tinymce.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->

<script type="text/javascript">
  $('#grado_id').on('change', function(e){
    //console.log(e);
    var grado_id = e.target.value;
    var temporada_id = {!! $temporada_id !!};
    var empresa_id = {!! $empresa !!};

    $.get("{{env('APP_URL')}}/api/paralelos/" + empresa_id + "/" + temporada_id+ "/" + grado_id, function(data) {
      console.log(data);

      $('#paralelo_id').empty();
      $('#usuario_recibe').empty();

      $.each(data, function(index, regenciesObj){
        $('#paralelo_id').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.nombre +'</option>');
      })
    });
  });

</script>

<script type="text/javascript">
  $('#paralelo_id').on('change', function(e){
    //console.log(e);
    var paralelo_id = e.target.value;

    $.get("{{env('APP_URL')}}/api/alumnos/" + paralelo_id, function(data) {
      console.log(data);

      $('#usuario_recibe').empty();

      $.each(data, function(index, regenciesObj){
        $('#usuario_recibe').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.nombre +'</option>');
      })
    });
  });

</script>

<script type="text/javascript">
  $('#paralelo_id').on('change', function(e){
    //console.log(e);
    var paralelo_id = e.target.value;

    $.get("{{env('APP_URL')}}/api/alumnos/" + paralelo_id, function(data) {
      console.log(data);

      $('#alumno_id').empty();

      $.each(data, function(index, regenciesObj){
        $('#alumno_id').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.nombre +'</option>');
      })
    });
  });

</script>
@endsection
