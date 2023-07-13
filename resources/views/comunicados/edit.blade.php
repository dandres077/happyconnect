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
                Editar </a>
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
                    <form method="post" class="form-horizontal" action="{{ url('admin/comunicados/'.$data->id.'/edit')}}" autocomplete="off" enctype="multipart/form-data" onsubmit="return validar(this)">
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
                                                    <option value="{{$temporada->id}}" @if($data->temporada_id==$temporada->id) selected @endif> {{ $temporada->nombre, $data->temporada_id }}</option>
                                                @endforeach                                            
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nombre </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $data->nombre) }}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Archivo 1 
                                            @if ($data->archivo1 != null) 
                                            <a href="{{$data->archivo1}}" target="_blank"><i class="flaticon-eye"></i></a>                 
                                            @can('comunicados.destroy_documento')
                                            <a href="{{ url('admin/comunicados/'.$data->id.'/destroy/a1')}}" target="_blank"><i class="fa fa-trash"></i></a>
                                            @endcan
                                            @endif
                                            </label>
                                            <div class="col-9">
                                            <input type="file" class="form-control-file" name="archivo1" id="archivo1" required>
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Archivo 3
                                            @if ($data->archivo3 != null) 
                                            <a href="{{$data->archivo3}}" target="_blank"><i class="flaticon-eye"></i></a>
                                            @can('comunicados.destroy_documento')
                                            <a href="{{ url('admin/comunicados/'.$data->id.'/destroy/a3')}}" target="_blank"><i class="fa fa-trash"></i></a>
                                            @endcan
                                            @endif
                                            </label>
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
                                                    <option value="{{$categoria->id}}" @if($data->categoria_id==$categoria->id) selected @endif> {{ $categoria->nombre, $data->categoria_id }}</option>
                                                @endforeach  
                                                </select>
                                            </div>
                                        </div>  

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Descripción </label>
                                            <div class="col-9">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion', $data->descripcion) }}">
                                            </div>
                                        </div>       

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Archivo 2
                                            @if ($data->archivo2 != null) 
                                            <a href="{{$data->archivo2}}" target="_blank"><i class="flaticon-eye"></i></a>
                                            @can('comunicados.destroy_documento')
                                            <a href="{{ url('admin/comunicados/'.$data->id.'/destroy/a2')}}" target="_blank"><i class="fa fa-trash"></i></a>
                                            @endcan
                                            @endif
                                            </label>
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
                                                    @php
                                                        $checked = $seleccionados->contains('paralelo_id', $paralelo->id) ? 'checked' : '';
                                                    @endphp
                                                    @if ($count % 3 === 0 && $count > 0)
                                                        </div>
                                                        <div class="row">
                                                    @endif
                                                    <div class="col-md-4">
                                                        <label class="kt-checkbox">
                                                            <input type="checkbox" name="paralelos[]" value="{{ $paralelo->id }}" {{ $checked }}>
                                                            {{ $paralelo->nom_paralelo }}
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
                            <button type="submit" class="btn btn-primary" name="enviar">Actualizar</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('#check-all').click(function() {
            $('.kt-checkbox-list input[type="checkbox"]').prop('checked', this.checked);
        });
    });
</script>

@if(session('eliminar')=='ok')
<script>
    Swal.fire(
      '¡Eliminado!',
      'Registro eliminado exitosamente.',
      'success'
    )
</script>

@endif

<script>

    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
          title: '¿Esta seguro?',
          text: "¡No podra revertir esta acción!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, estoy seguro',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
              this.submit();
            }          
        })
    });
    
</script>

@endsection
