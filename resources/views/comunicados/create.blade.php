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
                <a href="{{ url ('admin/comunicados')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/comunicados')}}" class="kt-subheader__breadcrumbs-link">
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
                    <form method="post" class="form-horizontal" action="{{ url('admin/comunicados/store')}}" autocomplete="off" enctype="multipart/form-data" onsubmit="return validar(this)">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Temporada </label>
                                            <div class="col-9">
                                                <select class="form-control" name="temporada_id" id="temporada_id">
                                                @foreach ($temporadas as $temporada)
                                                <option value="{{ $temporada->id }}"> {{ $temporada->nombre }}</option>
                                                @endforeach                                         
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nombre </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Archivo 1</label>
                                            <div class="col-9">
                                            <input type="file" class="form-control-file" name="archivo1" id="archivo1">
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Archivo 3</label>
                                            <div class="col-9">
                                            <input type="file" class="form-control-file" name="archivo3" id="archivo3">
                                            </div>
                                        </div>                                          

                                    </div>
                                </div>    
                            </div>
                            <div class="col-6">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">   

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Categoría </label>
                                            <div class="col-9">
                                                <select class="form-control" name="categoria_id" id="categoria_id">
                                                @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}"> {{ $categoria->nombre }}</option>
                                                @endforeach                                         
                                                </select>
                                            </div>
                                        </div>  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Descripción </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" required="">
                                            </div>
                                        </div>       

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Archivo 2</label>
                                            <div class="col-9">
                                            <input type="file" class="form-control-file" name="archivo2" id="archivo2">
                                            </div>
                                        </div>                                                                    
                                    </div>
                                </div>                                
                            </div>                            
                        </div>

                        <h2 class="kt-font-success">Seleccione los grados</h2> <br>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="kt-checkbox-list">
                                            <div class="row">
                                                @php $count = 0; @endphp
                                                @foreach ($paralelos as $paralelo)
                                                    @if ($count % 3 === 0 && $count > 0)
                                                        </div>
                                                        <div class="row">
                                                    @endif
                                                    <div class="col-md-4">
                                                        <label class="kt-checkbox">
                                                            <input type="checkbox" name="paralelos[]" value="{{ $paralelo->id }}"> {{ $paralelo->nom_paralelo }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    @php $count++; @endphp
                                                @endforeach
                                            </div>
                                            <label class="kt-checkbox">
                                                <input type="checkbox" id="check-all"> Marcar todos
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                        <div class="hr-line-dashed"></div>

                        <div class="kt-form__actions">
                            @can('comunicados.store') 
                            <button type="submit" class="btn btn-primary" name="enviar">Crear</button>
                            @endcan
                            <a href="{{ url ('admin/comunicados')}}" class="btn btn-secondary">Cancelar</a>
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

<script>
    $(document).ready(function() {
        $('#check-all').click(function() {
            $('.kt-checkbox-list input[type="checkbox"]').prop('checked', this.checked);
        });
    });
</script>
@endsection
