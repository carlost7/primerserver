<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
      <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>@section('title')
                  Primer Server
                  @show
            </title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="{{asset("/img/logo-primerserver.png")}}" />

            {{ HTML::style('css/bootstrap.min.css') }}
            {{HTML::style("css/bootstrap-theme.min.css")}}
            {{HTML::style("css/main.css")}}
            @if(Route::currentRouteName()=="index")
            {{HTML::style("css/backgrounds.css")}}
            @endif
            <script>
                  var base_url = '{{ URL::to("/") }}';
            </script>
            {{HTML::script("js/vendor/modernizr-2.6.2-respond-1.1.0.min.js")}}
      </head>
      <body>
            <!--[if lt IE 7]>
                <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                  <div class="container">
                        <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                              </button>
                              @if(Auth::check())
                              @if(Auth::user()->type == 'Admin')
                              <a href="{{ route('admin.users.index') }} " class="navbar-brand"> {{ HTML::image('img/logotipo.png', $alt="primer server", $attributes = array()) }} </a>
                              
                              @else
                              <a href="{{ route('user.show',array(Auth::user()->id)) }} " class="navbar-brand"> {{ HTML::image('img/logotipo.png', $alt="primer server", $attributes = array()) }} </a>
                              
                              @endif
                              @else
                              
                              <a href="{{ route('index') }} " class="navbar-brand"> {{ HTML::image('img/logotipo.png', $alt="primer server", $attributes = array()) }} </a>
                              
                              @endif

                        </div>
                        @if(Auth::check())
                        <ul class="nav navbar-nav navbar-right">
                              <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->email}} <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                          @if(Auth::user()->type == "Admin")
                                          <li>
                                                {{ HTML::LinkRoute('admin.account.show',trans('frontend.link.account'),array(Auth::user()->id)) }}
                                          </li>
                                          @else
                                          <li>
                                                {{ HTML::LinkRoute('user.show',trans('frontend.link.account'),array(Auth::user()->id)) }}
                                          </li>
                                          @endif
                                          <li>{{HTML::LinkRoute('session.destroy',trans('frontend.link.logout'))}}</li>

                                    </ul>
                              </li>
                        </ul>
                        
                        @endif

                  </div>
            </div>
            <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  este texto es un dummy
            </div>
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ Session::get('message') }}
                  {{ Session::forget('message'); }}
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ Session::get('error') }}
                  {{ Session::forget('error'); }}
            </div>
            @endif
               
            @if(Route::currentRouteName()!="index")
                <div class="fullContainer bgColorAnimation"></div>
            @endif
            
            @yield('contenido')

            <!-- /container -->        
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.js"><\/script>')</script>
            {{HTML::script("js/vendor/bootstrap.min.js")}}
            {{HTML::script('js/vendor/bootbox.min.js')}}
            {{HTML::script("js/main.js")}}

            @section('scripts')@show
      </body>
</html>
