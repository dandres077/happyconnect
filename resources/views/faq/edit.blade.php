@extends('layouts.app')

@section('title', $titulo .' | '.config('app.name'))

@section('style')
<link href="{{asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
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
                <a href="{{ url ('admin/faq')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/faq')}}" class="kt-subheader__breadcrumbs-link">
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
                    <form method="post" class="form-horizontal" action="{{ url('admin/faq/'.$data->id.'/edit')}}" autocomplete="off">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">   

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Categoría</label>
                                            <div class="col-9">
                                                <select class="form-control" name="categoria_id" id="categoria_id">
                                                @foreach ($categorias as $categoria)
                                                <option value="{{$categoria->id}}" @if($data->categoria_id==$categoria->id) selected @endif> {{ $categoria->nombre, $data->categoria_id }}</option>
                                                @endforeach                                                  
                                                </select>
                                            </div>
                                        </div>                                    

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nombre</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $data->nombre) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Texto</label>
                                            <div class="col-9">
                                              <textarea class="summernote" rows="5" id="descripcion" name="descripcion">{{ old('descripcion', $data->descripcion) }}</textarea>
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Documento @if ($data->archivo != null) <a href="{{$data->archivo}}" target="_blank">(Ver)</a> @endif</label>
                                            <div class="col-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="archivo" id="archivo">
                                                    <label class="custom-file-label selected" for="customFile"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                        <div class="kt-form__actions">
                                            @can('faq.update')
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                            @endcan
                                            <a href="{{ url ('admin/faq')}}" class="btn btn-secondary">Cancelar</a>
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

<!-- SUMMERNOTE -->
<script src="{{asset('assets/js/plugins/summernote.min.js')}}"></script>

@endsection
