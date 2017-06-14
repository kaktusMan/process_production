<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Structura PrP</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body id="app-layout">
        <div class="page-container">
            <div class="sidebar-menu">
                <div class="sidebar-menu-inner">
                    <header class="logo-env"><br>
                        <div class="logo" style="text-align: center; margin-left: 30%;">
                            <a href="{{ url('/') }}" style="transform: scale(2.5);"  title="Proces de productie">
                                <i class="fa fa-gavel" aria-hidden="false"></i> &nbsp;PrP
                            </a>
                        </div>
                    </header> <br>
                    {{-- 1, 2, 4, 5, 6, 8, 16 --}}
                    <ul class="main-menu" id="main-menu">
                        <li <?php echo Route::getCurrentRoute()->getPrefix() == '' ? 'class="active"' : ''; ?>><a href="{{ url('/') }}" ><i class="fa fa-tachometer" aria-hidden="true"></i><span>{{ trans('') }}</span>Panou de bord</a></li>

                        <li class="has-sub">
                            <a href=""><i class="fa fa fa-cubes" aria-hidden="true"></i><span>{{ trans('') }}</span>Nomenclator</a>
                            <ul>
                            <li class="has-sub">
                                <a href=""><i class="fa fa-th-list" aria-hidden="true"></i><span>{{ trans('') }}</span>Actiuni de productie</a>
                                <ul>
                                    <li <?php echo Route::currentRouteName() == 'actiuni::list' ? 'class="active"' : ''; ?>><a href="{{ route('actiuni::list') }}" ><i class="fa fa-th" aria-hidden="true"></i><span>{{ trans('') }}</span>Actiuni de productie</a></li>
                                     <li <?php echo Route::currentRouteName() == 'modalitati::list' ? 'class="active"' : ''; ?>><a href="{{ route('modalitati::list') }}" ><i class="fa fa-gavel" aria-hidden="true"></i><span>{{ trans('') }}</span>Modalitati de realizare</a></li>
                                    <li <?php echo Route::currentRouteName() == 'nivele::list' ? 'class="active"' : ''; ?>><a href="{{ route('nivele::list') }}" ><i class="fa fa-bar-chart" aria-hidden="true"></i><span>{{ trans('') }}</span>Nivele de grupare</a></li>
                                    <li <?php echo Route::currentRouteName() == 'fluxuri::list' ? 'class="active"' : ''; ?>><a href="{{ route('fluxuri::list') }}" ><i class="fa fa-arrows-h" aria-hidden="true"></i><span>{{ trans('') }}</span>Tipuri procese productie</a></li>
                                    <li <?php echo Route::currentRouteName() == 'operatii::list' ? 'class="active"' : ''; ?>><a href="{{ route('operatii::list') }}" ><i class="fa fa-asl-interpreting" aria-hidden="true"></i><span>{{ trans('') }}</span>Tipuri de operatii necesare</a></li>
                                    <li <?php echo Route::currentRouteName() == 'categorii::list' ? 'class="active"' : ''; ?>><a href="{{ route('categorii::list') }}" ><i class="fa fa-cubes" aria-hidden="true"></i><span>{{ trans('') }}</span>Categorii intrumente de lucru</a></li>
                                </ul>
                            </li>
                            {{-- 3, 9, 10,11, 12, 13, 14, 15, 21, 25, 26,32                                 --}}
                            <li class="has-sub" >
                                <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i><span>{{ trans('') }}</span>Instrumente de lucru</a>
                                <ul>
                                    <li <?php echo Route::currentRouteName() == 'tipuri::list' ? 'class="active"' : ''; ?>><a href="{{ route('tipuri::list') }}" ><i class="fa fa-industry" aria-hidden="true"></i><span>{{ trans('') }}</span>Tipuri</a></li>
                                    <li <?php echo Route::currentRouteName() == 'moduri::list' ? 'class="active"' : ''; ?>><a href="{{ route('moduri::list') }}" ><i class="fa fa-tasks" aria-hidden="true"></i><span>{{ trans('') }}</span>Moduri de realizare</a></li>
                                     <li <?php echo Route::currentRouteName() == 'grade::list' ? 'class="active"' : ''; ?>><a href="{{ route('grade::list') }}" ><i class="fa fa-percent" aria-hidden="true"></i><span>{{ trans('') }}</span>Grade de libetate</a></li>
                                    <li <?php echo Route::currentRouteName() == 'nr_grade::list' ? 'class="active"' : ''; ?>><a href="{{ route('nr_grade::list') }}" ><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i><span>{{ trans('') }}</span>Numar grade de libertate</a></li>
                                    <li <?php echo Route::currentRouteName() == 'materiale::list' ? 'class="active"' : ''; ?>><a href="{{ route('materiale::list') }}" ><i class="fa fa-diamond" aria-hidden="true"></i><span>{{ trans('') }}</span>Tipuri materiale</a></li>
                                    <li <?php echo Route::currentRouteName() == 'categorii-complexe::list' ? 'class="active"' : ''; ?>><a href="{{ route('categorii-complexe::list') }}" ><i class="fa fa-align-left" aria-hidden="true"></i><span>{{ trans('') }}</span>Categorii intrumente de lucru complexe</a></li>
                                    <li <?php echo Route::currentRouteName() == 'alimentare::list' ? 'class="active"' : ''; ?>><a href="{{ route('alimentare::list') }}" ><i class="fa fa-cutlery" aria-hidden="true"></i><span>{{ trans('') }}</span>Moduri alimentare il complexe</a></li>
                                    <li <?php echo Route::currentRouteName() == 'evacuare::list' ? 'class="active"' : ''; ?>><a href="{{ route('evacuare::list') }}" ><i class="fa fa-truck" aria-hidden="true"></i><span>{{ trans('') }}</span>Moduri evacuare componente rezultate</a></li>
                                    <li <?php echo Route::currentRouteName() == 'consumabile::list' ? 'class="active"' : ''; ?>><a href="{{ route('consumabile::list') }}" ><i class="fa fa-tint" aria-hidden="true"></i><span>{{ trans('') }}</span>Tipuri consumabile pentru il</a></li>

                                    <li <?php echo Route::currentRouteName() == 'caracteristici::list' ? 'class="active"' : ''; ?>><a href="{{ route('caracteristici::list') }}" ><i class="fa fa-server" aria-hidden="true"></i><span>{{ trans('') }}</span>Caracteristici tehnice relevante</a></li>
                                     <li <?php echo Route::currentRouteName() == 'mod-aplicare::list' ? 'class="active"' : ''; ?>><a href="{{ route('mod-aplicare::list') }}" ><i class="fa fa-sign-language" aria-hidden="true"></i><span>{{ trans('') }}</span>Moduri folosinta I.L.</a></li>
                                </ul>
                            </li>
                            <li <?php echo Route::currentRouteName() == 'componente::list' ? 'class="active"' : ''; ?>><a href="{{ route('componente::list') }}" ><i class="fa fa-cogs" aria-hidden="true"></i><span>{{ trans('') }}</span>Componente rezultate</a></li> 
                            <li <?php echo Route::currentRouteName() == 'zone::list' ? 'class="active"' : ''; ?>><a href="{{ route('zone::list') }}" ><i class="fa fa fa-globe" aria-hidden="true"></i><span>{{ trans('') }}</span>Zone de lucru</a></li>

                            {{-- 18,19,20 --}}
                             <li class="has-sub" >
                                <a href="#"><i class="fa fa-list-ol" aria-hidden="true"></i><span>{{ trans('') }}</span>Materii prime cu care se aliumenteaza il</a>
                                <ul>
                                    <li <?php echo Route::currentRouteName() == 'tipuri_materii::list' ? 'class="active"' : ''; ?>><a href="{{ route('tipuri_materii::list') }}" ><i class="fa fa-align-center" aria-hidden="true"></i><span>{{ trans('') }}</span>Tipuri de materie</a></li>
                                     <li <?php echo Route::currentRouteName() == 'forme_materii::list' ? 'class="active"' : ''; ?>><a href="{{ route('forme_materii::list') }}" ><i class="fa fa-plus-square" aria-hidden="true"></i><span>{{ trans('') }}</span>Forma materiei</a></li>
                                    <li <?php echo Route::currentRouteName() == 'caract_materii::list' ? 'class="active"' : ''; ?>><a href="{{ route('caract_materii::list') }}" ><i class="fa fa-level-up" aria-hidden="true"></i><span>{{ trans('') }}</span>Caracteristici tehnice relevante</a></li>
                                </ul>
                            </li>

                             <li <?php echo Route::currentRouteName() == 'tip-operatori::list' ? 'class="active"' : ''; ?>><a href="{{ route('tip-operatori::list') }}" ><i class="fa fa-group" aria-hidden="true"></i><span>{{ trans('') }}</span>Operatori</a></li>

                           </ul>
                        </li>   
                       
                        {{-- 27 - - 32 --}}
                        <li class="has-sub">
                            <a href="#"><i class="fa fa-th" aria-hidden="true"></i><span>{{ trans('') }}</span>Date generale</a>   
                            <ul>    
                                <li <?php echo Route::currentRouteName() == 'instalatii::list' ? 'class="active"' : ''; ?>><a href="{{ route('instalatii::list') }}" ><i class="fa fa-building-o" aria-hidden="true"></i><span>{{ trans('') }}</span>Centralizatorul fabriciilor de productie</a></li>
                                <li <?php echo Route::currentRouteName() == 'fluxuri-pp::list' ? 'class="active"' : ''; ?>><a href="{{ route('fluxuri-pp::list') }}" ><i class="fa fa-arrows-alt" aria-hidden="true"></i><span>{{ trans('') }}</span>Centralizatorul fluxurilor de lucru</a></li>   
                                <li <?php echo Route::currentRouteName() == 'procese-productie::list' ? 'class="active"' : ''; ?>><a href="{{ route('procese-productie::list') }}" ><i class="fa fa-users" aria-hidden="true"></i><span>{{ trans('') }}</span>Centralizatorul proceselor de productie</a></li>

                                <li <?php echo Route::currentRouteName() == 'operatori-necesari::list' ? 'class="active"' : ''; ?>><a href="{{ route('operatori-necesari::list') }}" ><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i><span>{{ trans('') }}</span>Numar operatori simultan necesari pentru functionare I.L.</a></li>   
                                 <li <?php echo Route::currentRouteName() == 'schimburi-de-lucru::list' ? 'class="active"' : ''; ?>><a href="{{ route('schimburi-de-lucru::list') }}" ><i class="fa fa-retweet" aria-hidden="true"></i><span>{{ trans('') }}</span>Numar de schimburi de lucru pe procesele de productie</a></li> 
                                 <li <?php echo Route::currentRouteName() == 'ore-functionale::list' ? 'class="active"' : ''; ?>><a href="{{ route('ore-functionale::list') }}" ><i class="fa fa-hourglass-start" aria-hidden="true"></i><span>{{ trans('') }}</span>Numar de ore nete functionale pe schimbul de lucru</a></li>
                                 <li <?php echo Route::currentRouteName() == 'grad-incarcare::list' ? 'class="active"' : ''; ?>><a href="{{ route('grad-incarcare::list') }}" ><i class="fa fa-percent" aria-hidden="true"></i><span>{{ trans('') }}</span>Gradul de incarcare orara a operatorilor de pe I.L. cand acesta functioneaza la capacitate maxima</a></li>
                                 <li <?php echo Route::currentRouteName() == 'operatori-actuali::list' ? 'class="active"' : ''; ?>><a href="{{ route('operatori-actuali::list') }}" ><i class="fa fa-mortar-board" aria-hidden="true"></i><span>{{ trans('') }}</span>Centralizatorul tipurilor de operatori actuali</a></li>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i><span>{{ trans('') }}</span>Date particulare</a>   
                            <ul>
                                <li <?php echo Route::currentRouteName() == 'aferente-prp::list' ? 'class="active"' : ''; ?>><a href="{{ route('aferente-prp::list') }}" ><i class="fa fa-dot-circle-o" aria-hidden="true"></i><span>{{ trans('') }}</span>I.L. aferente PrP</a></li>
                                <li <?php echo Route::currentRouteName() == 'optimizari-fl::list' ? 'class="active"' : ''; ?>><a href="{{ route('optimizari-fl::list') }}" ><i class="fa fa-check-square-o" aria-hidden="true"></i><span>{{ trans('') }}</span>I.L. pentru analiza Fl</a></li>       
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="#"><i class="fa fa-align-right" aria-hidden="true"></i><span>{{ trans('') }}</span>Date pentru analiza</a>   
                            <ul>
                                <li <?php echo Route::currentRouteName() == 'il-posibile::list' ? 'class="active"' : ''; ?>><a href="{{ route('il-posibile::list') }}" ><i class="fa fa-sort" aria-hidden="true"></i><span>{{ trans('') }}</span>Centralizatorul tuturor I.L. care sunt in patrimoniu sau custodie</a></li>        
                            </ul>
                        </li>
                    </ul>
                    <button class="btn btn-close visible-xs" id="close-button"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="breadcrumb-container visible-xs">
                <button class="btn btn-menu pull-left" id="open-button"></button>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Pr. Productie</a></li>
                    {{-- <li class="active">Oferte</li> --}}
                </ol>
            </div>

            @yield('content')

        </div>

        <script src="{{ asset('js/app.js?cb=8') }}"></script>
		@yield('script')
    </body>
</html>
