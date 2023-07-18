@extends('layouts.app')

@section('title', 'Roles'.' | '.config('app.name'))

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
                <a href="{{ url ('admin/roles')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ url ('admin/roles')}}" class="kt-subheader__breadcrumbs-link">
                Roles</a>
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
                        <h3 class="kt-portlet__head-title">Roles</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form method="post" class="form-horizontal" action="{{ url('admin/roles/'.$roles->id.'/edit')}}" autocomplete="off">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-1"></div>
                            <div class="col-xl-10">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">  
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Nombre</label>
                                            <div class="col-10">
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $roles->name) }}">
                                            </div>
                                        </div>

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Permisos</label>
                                            <div class="col-10">
                                                @php $columnCount = 0; @endphp
                                                <div class="row">
                                                    @foreach ($permisos as $permiso)
                                                        <div class="col-md-4">
                                                            @if ($contador == 0)
                                                                <label><input type="checkbox" value="{{$permiso->id}}" name="permisos[]" id="permisos[]"> {{ $permiso->name }}</label><br>
                                                            @else
                                                                @foreach ($rol_permisos as $rolp)
                                                                    @if ($permiso->id == $rolp->permission_id)
                                                                        <label><input type="checkbox" value="{{$permiso->id}}" name="permisos[]" id="permisos[]" checked="checked"> {{ $permiso->name }}</label><br>
                                                                        @php $columnCount++; @endphp
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                                @if ($permiso->id != $rolp->permission_id)
                                                                    <label><input type="checkbox" value="{{$permiso->id}}" name="permisos[]" id="permisos[]"> {{ $permiso->name }}</label><br>
                                                                    @php $columnCount++; @endphp
                                                                @endif
                                                            @endif
                                                        </div>
                                                        @if ($columnCount % 3 === 0 && $columnCount > 0)
                                                            </div><div class="row">
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                        <div class="kt-form__actions">
                                            @can('roles.edit')
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                            @endcan
                                            <a href="{{ url ('admin/roles')}}" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xl-1"></div>
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
