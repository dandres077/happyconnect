@extends('layouts.app')

@section('title', $titulo .' | '.config('app.name'))

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets/css/pages/tables/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
@endsection

@section('content')

<?php

    $connection = mysqli_connect('localhost', env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE')) or die(mysqli_error($connection));
   
    if(isset($_POST['action']) or isset($_GET['view']))
    {
        if(isset($_GET['view']))
        {
            $start = mysqli_real_escape_string($connection,$_GET["start"]);
            $end = mysqli_real_escape_string($connection,$_GET["end"]);

            $start = date("Y-m-d",strtotime($start."- 1 week")); // Se ajusta con una semana menos para más detalle
          
            $result = mysqli_query($connection,"SELECT actividades.id as reserva_id,
                                                        actividades.nombre AS title,
                                                        actividades.fecha_inicio as start,
                                                        actividades.fecha_fin as end, 
                                                        actividades.observaciones,
                                                        CONCAT(users.name, ' ', users.last) AS usuario_crea
                                                FROM  actividades 
                                                LEFT JOIN users ON actividades.user_create = users.id 
                                                WHERE actividades.empresa_id = $empresa_id AND actividades.status = 1 AND (date(actividades.fecha_inicio) >= '$start' AND date(actividades.fecha_inicio) <= '$end')");

    
            while($row = mysqli_fetch_assoc($result))
            {
                $events[] = $row; 

            }        
            echo json_encode($events); 
            exit;
        }
    }
?>

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
            @can('actividades.create')
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#createEventModal">Crear</button>
                    </div>
                </div>
            </div>
            @endcan         

        </div>
        <div class="kt-portlet__body">
            <div class="row animated fadeInDown">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <!-- <h5>Calendario de actividades</h5> -->
                        </div>
                        <div class="ibox-content">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Content -->

<!--begin::Modal Crear Reserva-->
<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" action="{{ url('admin/actividades/store')}}" autocomplete="off" name="registro">
                    {{ csrf_field()}}

                     <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Fecha inicio:</label>
                                <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required="">
                            </div>  
                        </div>

                        <div class="col-sm-6">                            
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Fecha fin:</label>
                                <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" required="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Observaciones:</label>
                                <textarea type="text" class="form-control" id="observaciones" name="observaciones" value="{{ old('observaciones') }}" required=""></textarea>
                            </div>
                        </div>
                    </div>                 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--end::Modal-->

    <div class="modal fade" id="UpdatecreateEventModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Actualización reserva</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  </button>
              </div>

                <div class="modal-body">
                  <form method="post" class="form-horizontal" action="{{ url('admin/actividades/update')}}" autocomplete="off" name="actualizacion">
                    {{ csrf_field()}}

                    <input type="hidden" id="id" name="id" />                   

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre_act" name="nombre" value="{{ old('nombre') }}" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Fecha inicio:</label>
                                <input type="text" class="form-control" id="fecha_inicio_act" name="fecha_inicio_act" value="{{ old('fecha_inicio_act') }}" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Fecha fin:</label>
                                <input type="text" class="form-control" id="fecha_fin_act" name="fecha_fin_act" value="{{ old('fecha_fin_act') }}" required="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Observaciones:</label>
                                <textarea type="text" class="form-control" id="observaciones_act" name="observaciones_act" value="{{ old('observaciones_act') }}"></textarea>
                            </div>
                        </div>

                    </div>               


                     <div class="hr-line-dashed"></div>

                      <div class="form-group">                                                                            
                          <button type="submit" class="btn btn-danger btn-block btn-lg" id="deleteButton">Eliminar actividad</button>
                      </div>
                  
                </div>                    
                @can ('actividades.update')
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
                @endcan

         </div>
      </div>
    </div>
    <!--Modal-->

@endsection

   
@section('scripts')

<!-- Full Calendar -->
<script src="{{asset('js/fullcalendar/fullcalendar.min.js')}}"></script>

<script>

  $(document).ready(function()
  {
      var calendar = $('#calendar').fullCalendar(
      {
         
        @if(!empty($fecha_reserva))
            defaultDate: '{!! $fecha_reserva !!}', // Establece la fecha inicial de la semana que deseas mostrar
        @endif

        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],

        buttonText: {
              prev: "Ant",
              next: "Sig",
              today: "Hoy",
              month: "Mes",
              week: "Semana",
              day: "Día",
              list: "Agenda"
          },

        plugins: [ 'dayGrid' ],


        header:{
              left: 'prev,next today',
              center: 'title',
              /*right: 'agendaWeek,agendaDay'*/
              /*right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth,agendaWeek,agendaDay'*/
              right: 'month,agendaWeek,agendaDay'
        },

          minTime: "00:00:00", // Hora inicio de grilla
          maxTime: "23:59:59", // Hora final de la grilla


          businessHours: [{
            dow: [0, 1, 2, 3, 4, 5, 6 ], // Monday - Friday
            //dow: [1],
            start: '00:00',
            end: '23:00',
          }],

          

          selectConstraint: "businessHours",                      // Bloque las celdas que no tienen horario para reservar

          eventStartEditable: true,                              // Permite ajustar el evento pero sole en el dia

          firstHour: 15,
          firstDay: 1,
          defaultView: 'month',
          editable: true,                                        // Permite la edición por dia, es decir, arrastrando la caja
          selectable: true,
          allDaySlot: false,          
          

          events: "{{env('APP_URL')}}/api/actividades/{{$empresa_id}}/empresa/?view=1",            


          eventColor: '#1ab394',                                  //Color de los Events Display


          // Visualiza una modal pequeña con la información del evento
          eventRender: function(eventObj, $el) 
          {                  

            fin = $.fullCalendar.moment(eventObj.end).format('DD/MM/YYYY, HH:mm');
            inicio = $.fullCalendar.moment(eventObj.start).format('DD/MM/YYYY, HH:mm');

            var titulo = eventObj.title;

            $el.popover({
              animation: true,
              title : 'Actividad',
              content : '<p><strong>Nombre: </strong>' + eventObj.nombre + '<p> <strong>Fecha inicio: </strong>' + inicio + '<p> <strong>Fecha fin: </strong>' + fin + '<p> <strong>Observaciones: </strong>' + eventObj.observaciones,
              html : true,
              trigger: 'hover',
              placement: 'top',
              container: 'body',
            });

          },

          // Esta función evita que se sobrepongan eventos al moverlos
          eventOverlap: function(stillEvent, movingEvent) 
          { 
            return stillEvent.allDay && movingEvent.allDay;
            },

 
          //Visualiza la información en la modal de ACTUALIZACION
          eventClick:  function(event, eventObj) 
          {

              fecha_inicio = $.fullCalendar.moment(event.start).format('DD/MM/YYYY, HH:mm');
              fecha_fin = $.fullCalendar.moment(event.end).format('DD/MM/YYYY, HH:mm');

              $('#modalTitle').html(event.title);
              $('#titulo').val(event.title); 
              $('#UpdatecreateEventModal #nombre_act').val(event.nombre);
              $('#UpdatecreateEventModal #fecha_inicio_act').val(fecha_inicio);
              $('#UpdatecreateEventModal #fecha_fin_act').val(fecha_fin);
              $('#UpdatecreateEventModal #id').val(event.id);
              $('#UpdatecreateEventModal #observaciones_act').val(event.observaciones);
              $('#UpdatecreateEventModal').modal('toggle');
           
          },

          
          //Visualiza la información en la ventana modal de CREAR
          select: function(start, end, jsEvent) 
          {

              fecha_inicio = $.fullCalendar.moment(start).format('DD/MM/YYYY, HH:mm');
              fecha_fin = $.fullCalendar.moment(end).format('DD/MM/YYYY, HH:mm');
              
              $('#createEventModal #fecha_inicio').val(fecha_inicio);
              $("#createEventModal #fecha_fin").val(fecha_fin); 
              $('#createEventModal').modal('toggle');
          },





         //Actualiza la reserva con solo desplazar la caja hacia la derecha y izquierda
         eventDrop: function(event, delta)
         {
             $.ajax({
                 url: "{{env('APP_URL')}}/api/actualizarlateral/'+event.id+'/'+moment(event.start).format()+'/'+moment(event.end).format()",
                 //data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id ,
                 type: "GET",
                 success: function(json) {
                 //alert('json');
                 }
             });
         },

         // Actualiza la reserva con solo desplazar la caja hacia abajo
         eventResize: function(event) 
         {
             $.ajax({
                 dataType: 'json',
                 //data:{id: event.id, end:moment(event.end).format() },
                 url: "{{env('APP_URL')}}/api/actualizar/'+event.id+'/'+moment(event.end).format()",
                 //data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id,
                 //data: '/'+event.id+'/'+moment(event.end).format(),
                 type: "GET",
                 success: function(json) {
                     //alert(json);
                 }
             });
         }

         });
             
         $('#submitButton').on('click', function(e)
         {
             // We don't want this to act as a link so cancel the link action
             e.preventDefault();
             doSubmit();
         });
         

         $('#updateButton').on('click', function(e)
         {
             // We don't want this to act as a link so cancel the link action
             e.preventDefault();
             doUpdate();
         });


         $('#deleteButton').on('click', function(e)
         {
             // We don't want this to act as a link so cancel the link action
             e.preventDefault();
             doDelete();
         });


         // Elimina el evento
         function doDelete()
         {
             $("#UpdatecreateEventModal").modal('hide');

             var id = $('#id').val();

             $.ajax({
                 url: "{{env('APP_URL')}}/admin/actividades/"+id+"/inactive",
                 type: "GET",
                 headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                 success: function(json) {

                     if(json == 1)
                     {
                          $("#calendar").fullCalendar('removeEvents',id);
                          location.reload();
                    }
                     else
                          return false;          
                     
                 }
             });
         }


         function doSubmit() // Inserta la reserva
         { 
             $("#createEventModal").modal('hide');
             var title = $('#title').val();
             var startTime = $('#startTime').val();
             var endTime = $('#endTime').val();
           
             /*$.ajax({               
                 type: "POST",
                 url: '#',
                 data: 'action=add&title='+title+'&start='+startTime+'&end='+endTime,
                 success: function(json) {
                     $("#calendar").fullCalendar('renderEvent',
                     {
                         id: json.id,
                         title: title,
                         start: startTime,
                         end: endTime,
                     },
                     true);
                 }
             });*/
             
         }

         function doUpdate()
         {
             $("#calendarModal").modal('hide');
             var eventID = $('#eventID').val();
             var title = $('#titulo').val();
             var startTime = $('#startTime').val();
             var endTime = $('#endTime').val();
             
             /*$.ajax({
                 url: '#',
                 data: 'action=update2&title='+title+'&start='+startTime+'&end='+endTime+'&eventID='+eventID,
                 type: "POST",
                 success: function(json) {
                     $("#calendar").fullCalendar('renderEvent',
                     {
                         id: json.id,
                         title: title,
                         start: startTime,
                         end: endTime,
                     },
                     window.location.reload(),
                     true);
                 }
             });*/
             
         }


  });

</script>  


@endsection
