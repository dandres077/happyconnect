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


		<!--Begin:: Inbox View-->
		<div class="kt-grid__item kt-grid__item--fluid    kt-portlet    kt-inbox__view kt-inbox__view--shown" id="kt_inbox_view">
			<!--<div class="kt-portlet__head">
				<div class="kt-inbox__toolbar">
					<div class="kt-inbox__actions">
						<a href="#" class="kt-inbox__icon kt-inbox__icon--back">
							<i class="flaticon2-left-arrow-1"></i>
						</a>						
						<a href="{{ url('/mensajes/'.$data[0]->id.'/delete')}}" class="kt-inbox__icon" data-toggle="kt-tooltip" title="Delete">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
									<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
								</g>
							</svg> </a>						
					</div>
					<div class="kt-inbox__controls">
						<span class="kt-inbox__pages" data-toggle="kt-tooltip" title="Records per page">
							<span class="kt-inbox__perpage" data-toggle="dropdown">3 of 230 pages</span>
						</span>
						<button class="kt-inbox__icon" data-toggle="kt-tooltip" title="Previose message">
							<i class="flaticon2-left-arrow"></i>
						</button>
						<button class="kt-inbox__icon" data-toggle="kt-tooltip" title="Next message">
							<i class="flaticon2-right-arrow"></i>
						</button>
					</div>
				</div>
			</div>-->
			<div class="kt-portlet__body kt-portlet__body--fit-x">
				<div class="kt-inbox__subject">
					<div class="kt-inbox__title">
						<h3 class="kt-inbox__text">{{ $data[0]->asunto }}</h3>
						<span class="kt-inbox__label kt-badge kt-badge--unified-brand kt-badge--bold kt-badge--inline">
							inbox
						</span>
					</div>
				</div>
				<div class="kt-inbox__messages">
					<div class="kt-inbox__message kt-inbox__message--expanded">
						<div class="kt-inbox__head">
							<span class="kt-media" data-toggle="expand" style="background-image: url('{{env("APP_URL")}}/img/users/user_default.png')">
								<span></span>
							</span>
							<div class="kt-inbox__info">
								<div class="kt-inbox__author" data-toggle="expand">
									<a href="#" class="kt-inbox__name">{{ $data[0]->usuario_env }}</a>
									<div class="kt-inbox__status">
										<span class="kt-badge kt-badge--success kt-badge--dot"></span> 
									</div>
								</div>
								<div class="kt-inbox__details">
									<div class="kt-inbox__tome">
										<span class="kt-inbox__label" data-toggle="dropdown">
											para mi <i class="flaticon2-down"></i>
										</span>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-left">
											<table class="kt-inbox__details">
												<tr>
													<td>De:</td>
													<td>{{ $data[0]->usuario_env }}</td>
												</tr>
												<tr>
													<td>Fecha:</td>
													<td>{{ $data[0]->created_at }}</td>
												</tr>
												<tr>
													<td>Para:</td>
													<td>{{ $data[0]->usuario_rec }}</td>
												</tr>
												<tr>
													<td>Asunto:</td>
													<td>{{ $data[0]->asunto }}</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="kt-inbox__desc" data-toggle="expand">
										{!! substr(strip_tags( $data[0]->mensaje), 0, 120) !!}
									</div>
								</div>
							</div>
							<div class="kt-inbox__actions">
								<div class="kt-inbox__datetime" data-toggle="expand">
									{{ $data[0]->created_at }}
								</div>
								<div class="kt-inbox__group">
									@if($data[0]->adjunto)
									<span class="kt-inbox__icon kt-inbox__icon--label kt-inbox__icon--light" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Adjunto">
										<a href="{{ $data[0]->adjunto }}" target="_blank"><i class="flaticon-attachment"></i></a>
									</span>
									@endif
								</div>
							</div>
						</div>
						<div class="kt-inbox__body">
							<div class="kt-inbox__text">
								{!! $data[0]->mensaje !!}
							</div>
						</div>
					</div>
					@foreach ($historial as $mensaje)
					<div class="kt-inbox__message">
						<div class="kt-inbox__head">
							<span class="kt-media" data-toggle="expand" style="background-image: url('{{env("APP_URL")}}img/users/user_default.png')">
								<span></span>
							</span>
							<div class="kt-inbox__info">
								<div class="kt-inbox__author" data-toggle="expand">
									<a href="#" class="kt-inbox__name">{{ $mensaje->usuario_env }}</a>
									<div class="kt-inbox__status">
										<span class="kt-badge kt-badge--success kt-badge--dot"></span>
									</div>
								</div>
								<div class="kt-inbox__details">
									<div class="kt-inbox__tome">
										<span class="kt-inbox__label" data-toggle="dropdown">
											para mi <i class="flaticon2-down"></i>
										</span>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-left">
											<table class="kt-inbox__details">
												<tr>
													<td>De:</td>
													<td>{{ $mensaje->usuario_env }}</td>
												</tr>
												<tr>
													<td>Fecha:</td>
													<td>{{ $mensaje->created_at }}</td>
												</tr>
												<tr>
													<td>Para:</td>
													<td>{{ $mensaje->usuario_rec }}</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="kt-inbox__desc" data-toggle="expand">
										{!! substr(strip_tags($mensaje->mensaje), 0, 120) !!}
									</div>
								</div>

							</div>
							<div class="kt-inbox__actions">
								<div class="kt-inbox__datetime" data-toggle="expand">
									{{ $mensaje->created_at }}
								</div>
								<div class="kt-inbox__group">									
									@if($mensaje->adjunto)
									<span class="kt-inbox__icon kt-inbox__icon--label kt-inbox__icon--light" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Adjunto">
										<a href="{{ $mensaje->adjunto }}" target="_blank"><i class="flaticon-attachment"></i></a>
									</span>
									@endif
								</div>
							</div>
						</div>
						<div class="kt-inbox__body">
							{!! $mensaje->mensaje !!}
						</div>
					</div>
					@endforeach											
				</div>

				<div class="kt-portlet__body">
                    <form method="post" class="form-horizontal" action="{{ url('admin/mensajes/store_response')}}" autocomplete="off">
                    {{ csrf_field()}}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body"> 

                                    	<input type="hidden" name="mensaje_id" value="{{ $data[0]->id }}">                                    
                                    	<input type="hidden" name="asunto" value="{{ $data[0]->asunto }}">                                                                                                
                                    	<input type="hidden" name="usuario_recibe" value="{{ $data[0]->usuario_envia }}">                                    

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <textarea id="kt-tinymce-1" name="mensaje" class="tox-target" >
                                                    
                                                </textarea>
                                            </div>
                                        </div>

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

<!--begin::Page Scripts(used by this page) -->
<script src="{{asset('assets/js/pages/custom/inbox/inbox.js')}}" type="text/javascript"></script>

@endsection