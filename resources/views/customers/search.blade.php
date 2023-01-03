@extends('layout')
@php
     if (isset($request))
    {
        $title_app  =   "Edición";
    }
    else
    {
        $title_app  =   "Búsqueda";
    }
@endphp
@section('content')
    <div class="">
        <form action="{{route('clients.search')}}">
            @csrf
            {{-- busqueda de cliente --}}
            <div class="flex w-full justify-between">
                    <div class="w-11/12 border-b-2 border-gray-400">
                        <i class="text-xl fa-solid fa-search"></i>
                        <input class="w-11/12 py-2 px-4 text-gray-700 font-medium" name="client" type="text" placeholder="Buscar por: nombre, apellido paterno, apellido materno, razon social, nombre comercial, rfc" value="{{isset($client) ? $client : ''}}">
                    </div>
                <div class="">
                    <button type="submit" class="bg-gray-500 px-2 py-1 rounded text-white hover:opacity-80 transition ease-in-out duration-200">Buscar</button>
                </div>
            </div>
            {{-- tabla de clientes --}}
            <div class="grid grid-cols-12 pt-2 divide-y-2 divide-gray-300 border-b-2 border-gray-300 text-sm">
                <div class="col-span-12 grid grid-cols-12 text-gray-700 pb-2 sm:px-10 font-bold">
                    <div class="col-span-3">Nombre</div>
                    <div class="col-span-2">Nombre comercial</div>
                    <div class="col-span-2">RFC</div>
                    <div class="col-span-2">E-mail</div>
                    <div class="col-span-2">Teléfono movil</div>
                    <div class="col-span-1 text-center">Acciones</div>
                </div>
                @if (isset($clients))
                    @foreach ($clients as $client)
                        <div class="col-span-12 grid grid-cols-12 font-semibold text-gray-700 sm:px-10 py-2">
                            @php
                                if (isset($client) && $client->kind==1)
                                {
                                    $name= $client->fullName();
                                }
                                else if(isset($client) && $client->kind==2)
                                {
                                    $name= $client->name_moral;
                                }
                            @endphp
                            <div class="col-span-3">{{ $name!="" ? $name : '---'}}</div>
                            <div class="col-span-2">{{isset($client->business_name) ? $client->business_name : '---'}}</div>
                            <div class="col-span-2">{{isset($client->rfc) ? $client->rfc : '---'}}</div>
                            <div class="col-span-2">{{isset($client->email) ? $client->email : '---'}}</div>
                            <div class="col-span-2">{{isset($client->celphone) ? $client->celphone : '---'}}</div>
                            <div class="col-span-1 grid grid-cols-2 gap-1">
                                <a href="{{route('clients.edit',$client->id)}}">
                                    <i class="text-xl fa-solid fa-pencil"></i>
                                </a>
                                <a href="{{route('clients.suspend',$client->id)}}">
                                    <i class="text-xl fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </form>
        @if (isset($clients))
            {{ $clients->links() }}
        @endif
    </div>
@endsection
@section('scripts')
    @if (!session('alert'))
        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
        <script>
            swal.fire({
                imageUrl: '{{ asset(getenv('LOADING_IMG')) }}',
                showConfirmButton: false,
                timer: 600,
            });
        </script>
    @endif
@endsection
