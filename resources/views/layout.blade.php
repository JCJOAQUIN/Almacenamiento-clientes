<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/all.min.css')}}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
    	<link rel="stylesheet" type="text/css" href="{{ asset('css/validator/theme-default.min.css') }}">
        <title>Clientes @isset($title_app) - {{$title_app}} @endisset</title>
    </head>
    <body class="p-6">
        @include('sweetalert::alert')
        <header>
            @if (isset($title_app) && $title_app == 'Alta')
                <div class="w-full p-6 flex justify-between">
                    <div class="flex">
                        <a class="flex items-center rounded-full justify-center text-gray-500 hover:opacity-80 transition ease-in-out duration-200" href="{{route('clients.search')}}">
                            <i class="text-xl fa-solid fa-arrow-left"></i>
                        </a>
                        <h1 class="ml-4 font-semibold text-2xl text-gray-700">Nuevo cliente</h1>
                    </div>
                </div>
            @else
                <div class="w-full p-6 flex justify-between">
                    <h1 class="font-bold text-2xl">Clientes</h1>
                    <a class="flex items-center w-10 h-10 rounded-full bg-orange-400 justify-center shadow-lg text-white text-2xl hover:opacity-80 transition ease-in-out duration-200" href="{{route('clients.create')}}">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            @endif
        </header>
        <main class="mainContent px-6">
            @yield('content')
        </main>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
	    <script src="{{ asset('js/validator/jquery.form-validator.min.js') }}"></script>
        <script src="{{asset('js/validator/lang/es.js')}}"></script>
        <script src="{{ asset('js/app.js')}}"></script>
		<script src="{{ asset('js/all.min.js') }}"></script>
		<script src="{{ asset('js/select2.full.min.js') }}"></script>
        @yield('scripts')
        <script>
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.formUtils.addValidator(
            {
                name : 'rfc',
                validatorFunction : function(value, $el, config, language, $form)
                {
                    if(value.match(/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3}){0,1}$/i)!=null || value.match(/^XAXX1[0-9]{8}$/i)!=null)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                },
                errorMessage : 'El RFC debe ser válido.',
                errorMessageKey: 'badRfc'
            });
        </script>
    </body>
</html>
