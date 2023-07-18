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
                <a href="{{ url ('admin/blog')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/blog')}}" class="kt-subheader__breadcrumbs-link">
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
                    <form method="post" class="form-horizontal" action="{{ url('admin/blog/'.$data->id.'/edit')}}" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body"> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Categoría</label>
                                            <div class="col-9">
                                                <select class="form-control" name="categoria_id" id="categoria_id">
                                                @foreach ($categorias as $datos)
                                                    <option value="{{$datos->id}}" @if($data->categoria_id==$datos->id) selected @endif> {{ $datos->nombre, $data->categoria_id }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>                                    

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Titulo</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $data->titulo) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Slug</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $data->slug) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Texto </label>
                                            <div class="col-9">
                                                <textarea class="summernote" rows="5" id="texto" name="texto">{{ old('texto', $data->texto) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Imágen </label>
                                            <div class="col-9">
                                            <input type="file" class="form-control-file" id="imagen" name="imagen">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                        <label class="col-3 col-form-label">Imágen actual</label>
                                        <div class="col-9">@if ($data->imagen != null) <img src="{{$data->imagen}}" width="400px" height="400px"> @else No se ha cargado una imágen @endif </div>
                                        </div>

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Keywords</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="keywords" name="keywords" value="{{ old('keywords', $data->keywords) }}" required="">
                                            </div>
                                        </div>

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                        <div class="kt-form__actions">
                                            @can ('blog.update')
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                            @endcan
                                            <a href="{{ url ('admin/blog')}}" class="btn btn-secondary">Cancelar</a>
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
<!-- SUMMERNOTE -->
<script src="{{asset('plugins/summernote/summernote.min.js')}}"></script>

<script>
$(document).ready(function(){
    $('.summernote').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']]
        ],
         height:150
    });
});
</script>

<script>
    $(document).ready(function(){

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
        });
    });       

</script>

<script>

    $(document).ready(function(){
             $("#titulo").keyup(function(){
                    var cadena = $(this).val();
                    string_to_slug(cadena);
                });
    });


    function string_to_slug (str) {
             str = str.replace(/^\s+|\s+$/g, '');
             str = str.toLowerCase(); 
            
              //quita acentos, cambia la ñ por n, etc
              var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
              var to   = "aaaaeeeeiiiioooouuuunc------";
              
              for (var i=0, l=from.length ; i<l ; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
               }

               str = str.replace(/[^a-z0-9 -]/g, '') // quita caracteres invalidos
                     .replace(/\s+/g, '-') // reemplaza los espacios por -
                     .replace(/-+/g, '-'); // quita las plecas

               return $("#slug").val(str);
    }
</script>

@endsection
