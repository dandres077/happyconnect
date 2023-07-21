<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ url ('/home/')}}">
                <img alt="Logo" src="{{asset('assets/media/logos/logo-light.png')}}" />
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                        </g>
                    </svg></span>
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                        </g>
                    </svg></span>
            </button>
        </div>
    </div>
    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                @if (auth()->user())
                <li class="kt-menu__item {{ request()->is('admin/home*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/home/')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Inicio</span></a>
                </li> 
                
                @can('horarios_paralelos.show')
                <li class="kt-menu__item {{ request()->is('admin/horarios_paralelos*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/horarios_paralelos')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Horario</span></a>
                </li> 
                @endcan


                @can('tareas.show')
                <li class="kt-menu__item {{ request()->is('admin/tareas*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/tareas/show')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"/>
                            <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Tareas</span></a>
                </li> 
                @endcan

                @can('actividades.show')
                <li class="kt-menu__item {{ request()->is('admin/actividades*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/actividades/')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Actividades</span></a>
                </li>        
                @endcan

                @can('comunicados.show')
                <li class="kt-menu__item {{ request()->is('admin/comunicados*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/comunicados/show')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12.8434797,16 L11.1565203,16 L10.9852159,16.6393167 C10.3352654,19.064965 7.84199997,20.5044524 5.41635172,19.8545019 C2.99070348,19.2045514 1.55121603,16.711286 2.20116652,14.2856378 L3.92086709,7.86762789 C4.57081758,5.44197964 7.06408298,4.00249219 9.48973122,4.65244268 C10.5421727,4.93444352 11.4089671,5.56345262 12,6.38338695 C12.5910329,5.56345262 13.4578273,4.93444352 14.5102688,4.65244268 C16.935917,4.00249219 19.4291824,5.44197964 20.0791329,7.86762789 L21.7988335,14.2856378 C22.448784,16.711286 21.0092965,19.2045514 18.5836483,19.8545019 C16.158,20.5044524 13.6647346,19.064965 13.0147841,16.6393167 L12.8434797,16 Z M17.4563502,18.1051865 C18.9630797,18.1051865 20.1845253,16.8377967 20.1845253,15.2743923 C20.1845253,13.7109878 18.9630797,12.4435981 17.4563502,12.4435981 C15.9496207,12.4435981 14.7281751,13.7109878 14.7281751,15.2743923 C14.7281751,16.8377967 15.9496207,18.1051865 17.4563502,18.1051865 Z M6.54364977,18.1051865 C8.05037928,18.1051865 9.27182488,16.8377967 9.27182488,15.2743923 C9.27182488,13.7109878 8.05037928,12.4435981 6.54364977,12.4435981 C5.03692026,12.4435981 3.81547465,13.7109878 3.81547465,15.2743923 C3.81547465,16.8377967 5.03692026,18.1051865 6.54364977,18.1051865 Z" fill="#000000"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Comunicados</span></a>
                </li>        
                @endcan

                @can('cobros.show')
                <li class="kt-menu__item {{ request()->is('admin/cobros*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/cobros/show')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" opacity="0.3" x="11.5" y="2" width="2" height="4" rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="11.5" y="16" width="2" height="5" rx="1"/>
                            <path d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z" fill="#000000"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Cobros</span></a>
                </li>        
                @endcan

                @can('rutas.show')
                <li class="kt-menu__item {{ request()->is('admin/rutas*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/rutas/show')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M6,7 C7.1045695,7 8,6.1045695 8,5 C8,3.8954305 7.1045695,3 6,3 C4.8954305,3 4,3.8954305 4,5 C4,6.1045695 4.8954305,7 6,7 Z M6,9 C3.790861,9 2,7.209139 2,5 C2,2.790861 3.790861,1 6,1 C8.209139,1 10,2.790861 10,5 C10,7.209139 8.209139,9 6,9 Z" fill="#000000" fill-rule="nonzero"/>
                            <path d="M7,11.4648712 L7,17 C7,18.1045695 7.8954305,19 9,19 L15,19 L15,21 L9,21 C6.790861,21 5,19.209139 5,17 L5,8 L5,7 L7,7 L7,8 C7,9.1045695 7.8954305,10 9,10 L15,10 L15,12 L9,12 C8.27142571,12 7.58834673,11.8052114 7,11.4648712 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M18,22 C19.1045695,22 20,21.1045695 20,20 C20,18.8954305 19.1045695,18 18,18 C16.8954305,18 16,18.8954305 16,20 C16,21.1045695 16.8954305,22 18,22 Z M18,24 C15.790861,24 14,22.209139 14,20 C14,17.790861 15.790861,16 18,16 C20.209139,16 22,17.790861 22,20 C22,22.209139 20.209139,24 18,24 Z" fill="#000000" fill-rule="nonzero"/>
                            <path d="M18,13 C19.1045695,13 20,12.1045695 20,11 C20,9.8954305 19.1045695,9 18,9 C16.8954305,9 16,9.8954305 16,11 C16,12.1045695 16.8954305,13 18,13 Z M18,15 C15.790861,15 14,13.209139 14,11 C14,8.790861 15.790861,7 18,7 C20.209139,7 22,8.790861 22,11 C22,13.209139 20.209139,15 18,15 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Rutas</span></a>
                </li> 
                @endcan                

                @can('faq.show')
                <li class="kt-menu__item {{ request()->is('admin/faq*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/faq/0/show')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">FAQ</span></a>
                </li>        
                @endcan


                @can('profesionales.show')
                <li class="kt-menu__item {{ request()->is('admin/profesionales*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/profesionales/show')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M14,13.381038 L14,3.47213595 L7.99460483,15.4829263 L14,13.381038 Z M4.88230018,17.2353996 L13.2844582,0.431083506 C13.4820496,0.0359007077 13.9625881,-0.12427877 14.3577709,0.0733126292 C14.5125928,0.15072359 14.6381308,0.276261584 14.7155418,0.431083506 L23.1176998,17.2353996 C23.3152912,17.6305824 23.1551117,18.1111209 22.7599289,18.3087123 C22.5664522,18.4054506 22.3420471,18.4197165 22.1378777,18.3482572 L14,15.5 L5.86212227,18.3482572 C5.44509941,18.4942152 4.98871325,18.2744737 4.84275525,17.8574509 C4.77129597,17.6532815 4.78556182,17.4288764 4.88230018,17.2353996 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.000087, 9.191034) rotate(-315.000000) translate(-14.000087, -9.191034) "/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Profesionales</span></a>
                </li>        
                @endcan

                @can('blog.index')
                <li class="kt-menu__item {{ request()->is('admin/blog*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/blog/show')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M10.5,8 L6,19 C6.0352633,19.1332661 6.06268417,19.2312688 6.08226261,19.2940083 C6.43717645,20.4313361 8.07642225,21 9,21 C10.5,21 11,19 12.5,19 C14,19 14.5917308,20.9843119 16,21 C16.9388462,21.0104588 17.9388462,20.3437921 19,19 L14.5,8 L10.5,8 Z" fill="#000000"/>
                            <path d="M11.3,6 L12.5,3 L13.7,6 L11.3,6 Z M14.5,8 L10.5,8 L14.5,8 Z" fill="#000000"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Blog</span></a>
                </li>        
                @endcan

                @can('matriculas.index')
                <li class="kt-menu__item {{ request()->is('admin/matriculas*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/matriculas/')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <polygon fill="#000000" opacity="0.3" points="6 3 18 3 20 6.5 4 6.5"/>
                            <path d="M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,19 C20,20.1045695 19.1045695,21 18,21 L6,21 C4.8954305,21 4,20.1045695 4,19 L4,7 C4,5.8954305 4.8954305,5 6,5 Z M9,9 C8.44771525,9 8,9.44771525 8,10 C8,10.5522847 8.44771525,11 9,11 L15,11 C15.5522847,11 16,10.5522847 16,10 C16,9.44771525 15.5522847,9 15,9 L9,9 Z" fill="#000000"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Matriculas</span></a>
                </li>        
                @endcan

                @can('alumnos.index')
                <li class="kt-menu__item {{ request()->is('admin/alumnos*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/alumnos/')}}" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg></span><span class="kt-menu__link-text">Alumnos</span></a>
                </li>        
                @endcan                

                @can('administracion.index')
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Administraci&oacute;n</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>                     

                <li class="kt-menu__item  kt-menu__item--submenu {{ request()->is('admin/paises*', 'admin/departamentos*', 'admin/ciudades*','admin/roles*','admin/permisos*', 'admin/usuarios*', 'admin/catalogos*', 'admin/comunicados*', 'admin/proveedores*') ? 'kt-menu__item kt-menu__item--active kt-menu__item--open kt-menu__item--here' : ''}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{ url ('/admin/paises/')}}" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000) " />
                                    <path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg></span><span class="kt-menu__link-text">Sistema</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">

                            @can('comunicados.index')
                            <li class="kt-menu__item {{ request()->is('admin/comunicados*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/comunicados/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Comunicados</span></a></li>            
                            @endcan

                            @can('cobros.index')
                            <li class="kt-menu__item {{ request()->is('admin/cobros*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/cobros/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Cobros</span></a></li>            
                            @endcan

                            @can('blog.index')
                            <li class="kt-menu__item {{ request()->is('admin/blog*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/blog/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Blog</span></a></li>            
                            @endcan 

                            @can('profesionales.index')
                            <li class="kt-menu__item {{ request()->is('admin/profesionales*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/profesionales/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Profesionales</span></a></li>            
                            @endcan                            

                            @can('proveedores.index')
                            <li class="kt-menu__item {{ request()->is('admin/proveedores*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/proveedores/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Proveedores</span></a></li>            
                            @endcan

                            @can('faq.index')
                            <li class="kt-menu__item {{ request()->is('admin/faq*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/faq/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">FAQ</span></a></li>            
                            @endcan                                                       

                            @can('areas.index')
                            <li class="kt-menu__item {{ request()->is('admin/areas*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/areas/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Áreas</span></a></li>            
                            @endcan

                            @can('asignaturas.index')
                            <li class="kt-menu__item {{ request()->is('admin/asignaturas*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/asignaturas/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Asignaturas</span></a></li>            
                            @endcan

                            @can('grados.index')
                            <li class="kt-menu__item {{ request()->is('admin/grados*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/grados/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Grados</span></a></li>            
                            @endcan

                            @can('niveles.index')
                            <li class="kt-menu__item {{ request()->is('admin/niveles*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/niveles/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Niveles</span></a></li>            
                            @endcan

                            @can('temporadas.index')
                            <li class="kt-menu__item {{ request()->is('admin/temporadas*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/temporadas/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Temporadas</span></a></li>            
                            @endcan

                            @can('periodos.index')
                            <li class="kt-menu__item {{ request()->is('admin/periodos*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/periodos/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Periodos</span></a></li>            
                            @endcan                            

                            @can('paralelos.index')
                            <li class="kt-menu__item {{ request()->is('admin/paralelos*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/paralelos/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Paralelos</span></a></li>            
                            @endcan

                            @can('roles.index')
                            <li class="kt-menu__item {{ request()->is('admin/roles*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/roles/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Roles</span></a></li>
                            @endcan

                            @can('permisos.index')
                            <li class="kt-menu__item {{ request()->is('admin/permisos*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/permisos/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Permisos</span></a></li>       
                            @endcan

                            @can('usuarios.index')
                            <li class="kt-menu__item {{ request()->is('admin/usuarios*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/usuarios/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Usuarios</span></a></li>            
                            @endcan

                            @can('matriculas.index')
                            <li class="kt-menu__item {{ request()->is('admin/matriculas*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/matriculas/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Matriculas</span></a></li>            
                            @endcan

                            @can('alumnos.index')
                            <li class="kt-menu__item {{ request()->is('admin/alumnos*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/alumnos/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Alumnos</span></a></li>            
                            @endcan

                            @can('paises.index')
                            <li class="kt-menu__item {{ request()->is('admin/paises*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/paises/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Países</span></a></li>            
                            @endcan

                            @can('departamentos.index')
                            <li class="kt-menu__item {{ request()->is('admin/departamentos*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/departamentos/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Departamentos</span></a></li>            
                            @endcan

                            @can('ciudades.index')
                            <li class="kt-menu__item {{ request()->is('admin/ciudades*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/ciudades/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Ciudades</span></a></li>            
                            @endcan

                            @can('empresas.index')
                            <li class="kt-menu__item {{ request()->is('admin/empresas*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/empresas/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Empresas</span></a></li>            
                            @endcan

                            @can('sedes.index')
                            <li class="kt-menu__item {{ request()->is('admin/sedes*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/sedes/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Sedes</span></a></li>            
                            @endcan

                            @can('generalidades.index')
                            <li class="kt-menu__item {{ request()->is('admin/generalidades*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/generalidades/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Generalidades</span></a></li>            
                            @endcan

                            @can('catalogos.index')
                            <li class="kt-menu__item {{ request()->is('admin/catalogos*') ? 'kt-menu__item kt-menu__item--active' : ''}}" aria-haspopup="true"><a href="{{ url ('admin/catalogos/')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Catálogos</span></a></li>            
                            @endcan
                        </ul>
                    </div>
                </li> 
                @endcan  

                <!--<li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Vistas</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>-->


                @endif                 
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>
