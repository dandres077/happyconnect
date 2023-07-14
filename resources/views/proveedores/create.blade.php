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
                <a href="{{ url ('admin/proveedores')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/proveedores')}}" class="kt-subheader__breadcrumbs-link">
                {{ $titulo }} </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                Crear</a>
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
                    <form method="post" class="form-horizontal" action="{{ url('/admin/proveedores/store')}}" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">                               

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Empresa</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="empresa" name="empresa" value="{{ old('empresa') }}" required="">
                                            </div>
                                        </div>  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">N° documento</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="n_documento" name="n_documento" value="{{ old('n_documento') }}" required="">
                                            </div>
                                        </div>   

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Contacto</label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="contacto" name="contacto" value="{{ old('contacto') }}" required="">
                                            </div>
                                        </div>                                         

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Email</label>
                                            <div class="col-9">
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required="">
                                            </div>
                                        </div>                                         
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Celular</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular') }}" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Dirección</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Ciudad</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad') }}" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Observaciones</label>
                                    <div class="col-9">
                                    <textarea class="form-control" id="observaciones" name="observaciones" rows="4" cols="50">{{ old('observaciones') }}</textarea>
                                    </div>
                                </div>                                     
                            </div>  

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Crear</button>
                                <a href="{{ url ('admin/proveedores')}}" class="btn btn-secondary">Cancelar</a>
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
