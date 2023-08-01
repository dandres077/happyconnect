@extends('layouts.app')

@section('title', $titulo .' | '.config('app.name'))

@section('style')
<link href="{{ asset('assets/css/pages/inbox/inbox.css')}}" rel="stylesheet" type="text/css" />

<style></style>

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
        <div class="kt-grid__item kt-grid__item--fluid    kt-portlet    kt-inbox__list kt-inbox__list--shown" id="kt_inbox_list">
            <div class="kt-portlet__head">
                <div class="kt-inbox__toolbar kt-inbox__toolbar--extended">
                    <div class="kt-inbox__actions kt-inbox__actions--expanded">
                        <div class="kt-inbox__check">
                            <a href="{{ url ('admin/mensajes')}}">
                            <button type="button" class="kt-inbox__icon kt-inbox__icon--light" data-toggle="kt-tooltip" title="Recargar">
                                <i class="flaticon2-refresh-arrow"></i>
                            </button>
                            </a>
                        </div>
                    </div>
                    <!--<div class="kt-inbox__search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg> </span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-inbox__controls">
                        <div class="kt-inbox__pages" data-toggle="kt-tooltip" title="Records per page">
                            <span class="kt-inbox__perpage" data-toggle="dropdown">1 - 50 of 235</span>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-xs">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <span class="kt-nav__link-text">20 per page</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item kt-nav__item--active">
                                        <a href="#" class="kt-nav__link">
                                            <span class="kt-nav__link-text">50 par page</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <span class="kt-nav__link-text">100 per page</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <button class="kt-inbox__icon" data-toggle="kt-tooltip" title="Previose page">
                            <i class="flaticon2-left-arrow"></i>
                        </button>
                        <button class="kt-inbox__icon" data-toggle="kt-tooltip" title="Next page">
                            <i class="flaticon2-right-arrow"></i>
                        </button>
                    </div> -->
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit-x">
                <div class="kt-inbox__items" data-type="inbox">
                    @foreach ($data as $mensajes)
                    <div class="kt-inbox__item kt-inbox__item--unread" data-type="inbox">
                        <div class="kt-inbox__info">
                            <div class="kt-inbox__sender" data-toggle="view">
                                @if($mensajes->adjunto)
                                <span class="kt-inbox__icon kt-inbox__icon--light" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Mark as important">
                                    <i class="flaticon-attachment"></i>
                                </span> 
                                @endif
                                <a href="{{ url('admin/mensajes/'.$mensajes->id.'/view')}}" class="kt-inbox__author">{{ $mensajes->nom_envia }}</a>
                            </div>
                        </div>
                        <div class="kt-inbox__details" data-toggle="view">
                            <a href="{{ url('admin/mensajes/'.$mensajes->id.'/view')}}">
                            <div class="kt-inbox__message">
                                <span class="kt-inbox__subject">{{ $mensajes->asunto}}</span>
                                <span class="kt-inbox__summary">{!! substr(strip_tags($mensajes->mensaje), 0, 60) !!}</span>
                            </div>
                            <div class="kt-inbox__labels">
                                <span class="kt-inbox__label kt-badge kt-badge--unified-brand kt-badge--bold kt-badge--inline">inbox</span>
                            </div>
                            </a>
                        </div>
                        <a href="{{ url('admin/mensajes/'.$mensajes->id.'/view')}}">
                        <div class="kt-inbox__datetime" data-toggle="view">
                            {{ \App\Http\Controllers\MensajesController::fechaCastellano($mensajes->created_at, 0) }}
                        </div>
                        </a>
                    </div>
                </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!--End:: Inbox List-->

    </div>

    <!--End::Inbox-->

    
</div>

<!-- end:: Content -->




<div class="modal fade- modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Recipient:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="form-control-label">Message:</label>
                    <textarea id="kt-tinymce-1" name="mensaje" class="tox-target"> 
                                                    
                    </textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
        </div>
    </div>
</div>
</div>   


@endsection

   
@section('scripts')
    

        <!--begin::Page Vendors(used by this page) -->
        <script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>

        <!--end::Page Vendors -->

        <!--begin::Page Scripts(used by this page) -->
        <script src="{{asset('assets/js/pages/crud/forms/editors/tinymce.js')}}" type="text/javascript"></script>

        <!--end::Page Scripts -->



@endsection
