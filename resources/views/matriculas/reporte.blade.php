@extends('layouts.app')

@section('title',  $titulo  .' | '.config('app.name'))

@section('style')
<link href="{{ asset('assets/css/pages/tables/style.css')}}" rel="stylesheet" type="text/css" />
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
                {{ $titulo }}</a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
@if (session('danger'))
    <div class="alert alert-danger fade show" role="alert">
        <div class="alert-text">{{ session('danger') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-like"></i></div>
        <div class="alert-text">{{ session('success') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                   {{ $titulo }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="table-responsive">
            <!--begin: Datatable -->
             <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                <tr>
                    <th>Colegio</th>
                    <th>Sede</th>
                    <th>Periodo</th>
                    <th>Grado</th>
                    <th>Paralelo</th>
                    <th>Nombre1(A)</th>
                    <th>Nombre2(A)</th>
                    <th>Apellido1(A)</th>
                    <th>Apellido2(A)</th>
                    <th>TipoDoc(A)</th>
                    <th>Número(A)</th>
                    <th>Municipio exp(A)</th>
                    <th>Depto exp(A)</th>
                    <th>Fecha exp(A)</th>
                    <th>Depto nacimiento(A)</th>
                    <th>Ciudad nacimiento(A)</th>
                    <th>Tipo Sangre(A)</th>
                    <th>Genero(A)</th>
                    <th>Edad(A)</th>
                    <th>Fecha nacimiento(A)</th>
                    <th>Dpto vive (A)</th>
                    <th>Ciudad vive(A)</th>
                    <th>Comuna vive(A)</th>
                    <th>Barrio vive(A)</th>
                    <th>Dirección vive(A)</th>
                    <th>Zona vive(A)</th>
                    <th>Estrato vive(A)</th>
                    <th>Tipo vive(A)</th>
                    <th>Celular(A)</th>
                    <th>Email(A)</th>
                    <th>Nombres(P)</th>
                    <th>Apellidos(P)</th>
                    <th>TipoDoc(P)</th>
                    <th>Número(P)</th>
                    <th>Lugar expedición(P)</th>
                    <th>Dirección(P)</th>
                    <th>Teléfono(P)</th>
                    <th>Celular(P)</th>
                    <th>Email(P)</th>
                    <th>Profesión</th>
                    <th>Nivel educativo(P)</th>
                    <th>Empresa(P)</th>
                    <th>Ocupación(P)</th>
                    <th>Dirección(P)</th>
                    <th>Teléfono(P)</th>
                    <th>Email(P)</th>
                    <th>Nombres(M)</th>
                    <th>Apellidos(M)</th>
                    <th>TipoDoc(M)</th>
                    <th>Número(M)</th>
                    <th>Lugar expedición(M)</th>
                    <th>Dirección(M)</th>
                    <th>Teléfono(M)</th>
                    <th>Celular(M)</th>
                    <th>Email(M)</th>
                    <th>Profesión</th>
                    <th>Nivel educativo(M)</th>
                    <th>Empresa(M)</th>
                    <th>Ocupación(M)</th>
                    <th>Dirección(M)</th>
                    <th>Teléfono(M)</th>
                    <th>Email(M)</th>
                    <th>Nombres(Ac)</th>
                    <th>Apellidos(Ac)</th>
                    <th>TipoDoc(Ac)</th>
                    <th>Número(Ac)</th>
                    <th>Lugar expedición(Ac)</th>
                    <th>Dirección(Ac)</th>
                    <th>Teléfono(Ac)</th>
                    <th>Celular(Ac)</th>
                    <th>Email(Ac)</th>
                    <th>Empresa(Ac)</th>
                    <th>Profesión(Ac)</th>
                    <th>Parentesco(Ac)</th>
                    <th>Vive con</th>
                    <th>N° personas hogar</th>
                    <th>N° hermanos</th>
                    <th>N° hermanos colegio</th>
                    <th>Teléfono familiar</th>
                    <th>ICBF</th>
                    <th>Familas en acción</th>
                    <th>Barrera de aprendizaje</th>
                    <th>Nuevo/Antiguo</th>
                    <th>Colegio procede</th>
                    <th>Ciudad procede</th>
                    <th>Depto procede</th>
                    <th>Jornada</th>
                    <th>Repitente</th>
                    <th>Estatura</th>
                    <th>Peso</th>
                    <th>Hijo heroe</th>
                    <th>Desvinculado</th>
                    <th>Desmovilizado</th>
                    <th>EPS</th>
                    <th>Beneficiario Sisben</th>
                    <th>Alergias/Enfermedades</th>
                    <th>Medicamentos</th>
                    <th>Discapacidad</th>
                    <th>Etnia</th>
                    <th>Resguardo</th>
                    <th>Poblacion victima conflicto</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $matriculas)
                <tr class="gradeX">
                    <td>{{$matriculas->nomcolegio}}</td>
                    <td>{{$matriculas->nomsede}}</td>
                    <td>{{$matriculas->nomperiodo}}</td>
                    <td>{{$matriculas->nomgrado}}</td>
                    <td>{{$matriculas->nom_paralelo}}</td>
                    <td>{{$matriculas->nombre1}}</td>
                    <td>{{$matriculas->nombre2}}</td>
                    <td>{{$matriculas->apellido1}}</td>
                    <td>{{$matriculas->apellido2}}</td>
                    <td>{{$matriculas->tipo_doc_alumno}}</td>
                    <td>{{$matriculas->n_documento}}</td>
                    <td>{{$matriculas->exp_municipio}}</td>
                    <td>{{$matriculas->exp_dpto}}</td>
                    <td>{{$matriculas->exp_fecha}}</td>
                    <td>{{$matriculas->dpto_nac}}</td>
                    <td>{{$matriculas->ciudad_id}}</td>
                    <td>{{$matriculas->tipo_sangre}}</td>
                    <td>{{$matriculas->tipo_genero}}</td>
                    <td>{{$matriculas->edad}}</td>
                    <td>{{$matriculas->fecha_nacimiento}}</td>
                    <td>{{$matriculas->r_dpto}}</td>
                    <td>{{$matriculas->municipio_r}}</td>
                    <td>{{$matriculas->comuna_r}}</td>
                    <td>{{$matriculas->barrio_r}}</td>
                    <td>{{$matriculas->direccion_r}}</td>
                    <td>{{$matriculas->nom_zona}}</td>
                    <td>{{$matriculas->nom_estrato}}</td>
                    <td>{{$matriculas->nom_tipo_vivienda}}</td>
                    <td>{{$matriculas->celular_est}}</td>
                    <td>{{$matriculas->email_est}}</td>
                    <td>{{$matriculas->nom_padre}}</td>
                    <td>{{$matriculas->ape_padre}}</td>
                    <td>{{$matriculas->tipo_doc_padre}}</td>
                    <td>{{$matriculas->doc_padre}}</td>
                    <td>{{$matriculas->exp_padre}}</td>
                    <td>{{$matriculas->dir_padre}}</td>
                    <td>{{$matriculas->tel_padre}}</td>
                    <td>{{$matriculas->cel_padre}}</td>
                    <td>{{$matriculas->email_padre}}</td>
                    <td>{{$matriculas->prof_padre}}</td>
                    <td>{{$matriculas->nive_padre}}</td>
                    <td>{{$matriculas->empr_padre}}</td>
                    <td>{{$matriculas->ocu_padre}}</td>
                    <td>{{$matriculas->dir_emp_padre}}</td>
                    <td>{{$matriculas->tel_emp_padre}}</td>
                    <td>{{$matriculas->email_emp_padre}}</td>
                    <td>{{$matriculas->nom_madre}}</td>
                    <td>{{$matriculas->ape_madre}}</td>
                    <td>{{$matriculas->tipo_doc_madre}}</td>
                    <td>{{$matriculas->doc_madre}}</td>
                    <td>{{$matriculas->exp_madre}}</td>
                    <td>{{$matriculas->dir_madre}}</td>
                    <td>{{$matriculas->tel_madre}}</td>
                    <td>{{$matriculas->cel_madre}}</td>
                    <td>{{$matriculas->email_madre}}</td>
                    <td>{{$matriculas->prof_madre}}</td>
                    <td>{{$matriculas->nive_madre}}</td>
                    <td>{{$matriculas->empr_madre}}</td>
                    <td>{{$matriculas->ocu_madre}}</td>
                    <td>{{$matriculas->dir_emp_madre}}</td>
                    <td>{{$matriculas->tel_emp_madre}}</td>
                    <td>{{$matriculas->email_emp_madre}}</td>
                    <td>{{$matriculas->nombres_acu}}</td>
                    <td>{{$matriculas->apellidos_acu}}</td>
                    <td>{{$matriculas->tipo_doc_acu}}</td>
                    <td>{{$matriculas->n_documento_acu}}</td>
                    <td>{{$matriculas->expedida_acu}}</td>
                    <td>{{$matriculas->direccion_acu}}</td>
                    <td>{{$matriculas->telefono_acu}}</td>
                    <td>{{$matriculas->celular_acu}}</td>
                    <td>{{$matriculas->email_acu}}</td>
                    <td>{{$matriculas->empresa_acu}}</td>
                    <td>{{$matriculas->profesion_acu}}</td>
                    <td>{{$matriculas->parentesco_acu}}</td>
                    <td>{{$matriculas->vive_con}}</td>
                    <td>{{$matriculas->n_personas_hogar}}</td>
                    <td>{{$matriculas->n_hermanos}}</td>
                    <td>{{$matriculas->n_hermanos_col}}</td>
                    <td>{{$matriculas->telefono_f}}</td>
                    <td>{{$matriculas->icbf}}</td>
                    <td>{{$matriculas->f_accion}}</td>
                    <td>{{$matriculas->nee_texto}}</td>
                    <td>{{$matriculas->nuevo_antiguo}}</td>
                    <td>{{$matriculas->col_procede}}</td>
                    <td>{{$matriculas->ciudad_procede}}</td>
                    <td>{{$matriculas->dpto_procede}}</td>
                    <td>{{$matriculas->nom_jornada}}</td>
                    <td>{{$matriculas->repitente}}</td>
                    <td>{{$matriculas->estatura}}</td>
                    <td>{{$matriculas->peso}}</td>
                    <td>{{$matriculas->hijo_heroe}}</td>
                    <td>{{$matriculas->desvinculado}}</td>
                    <td>{{$matriculas->desmovilizado}}</td>
                    <td>{{$matriculas->nombre_eps}}</td>
                    <td>{{$matriculas->beneficiario_sisben}}</td>
                    <td>{{$matriculas->alergias}}</td>
                    <td>{{$matriculas->medicamentos}}</td>
                    <td>{{$matriculas->discapacidad}}</td>
                    <td>{{$matriculas->etnia}}</td>
                    <td>{{$matriculas->resguardo}}</td>
                    <td>{{$matriculas->conflicto}}</td>
                </tr>
                @endforeach 
                </tbody>
                <tfoot>
                <tr>
                    <th>Colegio</th>
                    <th>Sede</th>
                    <th>Periodo</th>
                    <th>Grado</th>
                    <th>Paralelo</th>
                    <th>Nombre1(A)</th>
                    <th>Nombre2(A)</th>
                    <th>Apellido1(A)</th>
                    <th>Apellido2(A)</th>
                    <th>TipoDoc(A)</th>
                    <th>Número(A)</th>
                    <th>Municipio exp(A)</th>
                    <th>Depto exp(A)</th>
                    <th>Fecha exp(A)</th>
                    <th>Depto nacimiento(A)</th>
                    <th>Ciudad nacimiento(A)</th>
                    <th>Tipo Sangre(A)</th>
                    <th>Genero(A)</th>
                    <th>Edad(A)</th>
                    <th>Fecha nacimiento(A)</th>
                    <th>Dpto vive (A)</th>
                    <th>Ciudad vive(A)</th>
                    <th>Comuna vive(A)</th>
                    <th>Barrio vive(A)</th>
                    <th>Dirección vive(A)</th>
                    <th>Zona vive(A)</th>
                    <th>Estrato vive(A)</th>
                    <th>Tipo vive(A)</th>
                    <th>Celular(A)</th>
                    <th>Email(A)</th>
                    <th>Nombres(P)</th>
                    <th>Apellidos(P)</th>
                    <th>TipoDoc(P)</th>
                    <th>Número(P)</th>
                    <th>Lugar expedición(P)</th>
                    <th>Dirección(P)</th>
                    <th>Teléfono(P)</th>
                    <th>Celular(P)</th>
                    <th>Email(P)</th>
                    <th>Profesión</th>
                    <th>Nivel educativo(P)</th>
                    <th>Empresa(P)</th>
                    <th>Ocupación(P)</th>
                    <th>Dirección(P)</th>
                    <th>Teléfono(P)</th>
                    <th>Email(P)</th>
                    <th>Nombres(M)</th>
                    <th>Apellidos(M)</th>
                    <th>TipoDoc(M)</th>
                    <th>Número(M)</th>
                    <th>Lugar expedición(M)</th>
                    <th>Dirección(M)</th>
                    <th>Teléfono(M)</th>
                    <th>Celular(M)</th>
                    <th>Email(M)</th>
                    <th>Profesión</th>
                    <th>Nivel educativo(M)</th>
                    <th>Empresa(M)</th>
                    <th>Ocupación(M)</th>
                    <th>Dirección(M)</th>
                    <th>Teléfono(M)</th>
                    <th>Email(M)</th>
                    <th>Nombres(Ac)</th>
                    <th>Apellidos(Ac)</th>
                    <th>TipoDoc(Ac)</th>
                    <th>Número(Ac)</th>
                    <th>Lugar expedición(Ac)</th>
                    <th>Dirección(Ac)</th>
                    <th>Teléfono(Ac)</th>
                    <th>Celular(Ac)</th>
                    <th>Email(Ac)</th>
                    <th>Empresa(Ac)</th>
                    <th>Profesión(Ac)</th>
                    <th>Parentesco(Ac)</th>
                    <th>Vive con</th>
                    <th>N° personas hogar</th>
                    <th>N° hermanos</th>
                    <th>N° hermanos colegio</th>
                    <th>Teléfono familiar</th>
                    <th>ICBF</th>
                    <th>Familas en acción</th>
                    <th>Barrera de aprendizaje</th>
                    <th>Nuevo/Antiguo</th>
                    <th>Colegio procede</th>
                    <th>Ciudad procede</th>
                    <th>Depto procede</th>
                    <th>Jornada</th>
                    <th>Repitente</th>
                    <th>Estatura</th>
                    <th>Peso</th>
                    <th>Hijo heroe</th>
                    <th>Desvinculado</th>
                    <th>Desmovilizado</th>
                    <th>EPS</th>
                    <th>Beneficiario Sisben</th>
                    <th>Alergias/Enfermedades</th>
                    <th>Medicamentos</th>
                    <th>Discapacidad</th>
                    <th>Etnia</th>
                    <th>Resguardo</th>
                    <th>Poblacion victima conflicto</th>
                </tr>
                </tfoot>
                </table>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->                      


@endsection

   
@section('scripts')

<script src="{{ asset('plugins/dataTables/datatables.min.js')}}"></script>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        "order": [[ 0 ,"asc" ]], //or asc 
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            //{ extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Reporte'},
            //{extend: 'pdf', title: 'ExampleFile'},

            /*{extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }*/
        ],
        "language":{
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate":{
                "next": "Siguiente",
                "previous": "Anterior",
            },
            "lengthMenu": 'Ver <select>'+
                        '<option value="10">10</option>'+
                        '<option value="30">30</option>'+
                        '<option value="-1">Todo</option>'+
                        '</select> registros | ',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "infoEmpty": "",
            "infoFiltered": ""
        }

    });

});

</script>
@endsection
