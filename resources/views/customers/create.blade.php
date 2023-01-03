@extends('layout')
@php
    $title_app  =   "Alta";
@endphp
@section('content')
    <div>
        @if (isset($requests))
            <form action="{{route('clients.update',$requests->id)}}" method="POST" id="clientForm">
            @method('PUT')
        @else
            <form action="{{route('clients.store')}}" method="POST" id="clientForm">
        @endif
            @csrf
            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-x-8">
                @php
                    $id                 =   $requests->id ?? "";
                    $kind               =   $requests->kind ?? "";
                    $rfc                =   $requests->rfc ?? "";
                    $name_physical      =   $requests->name_physical ?? "";
                    $last_name          =   $requests->last_name ?? "";
                    $second_last_name   =   $requests->second_last_name ?? "";
                    $name_moral         =   $requests->name_moral ?? "";
                    $business_name      =   $requests->business_name ?? "";
                    $using_cfdi_id      =   $requests->using_cfdi_id ?? "";
                    $status             =   $requests->status ?? "";
                    $contact_name       =   $requests->contact_name ?? "";
                    $phone              =   $requests->phone ?? "";
                    $celphone           =   $requests->celphone ?? "";
                    $email_address      =   $requests->email_address ?? "";
                    $comments           =   $requests->comments ?? "";
                    $country_id         =   $requests->country_id ?? "";
                    $state              =   $requests->state ?? "";
                    $district           =   $requests->district ?? "";
                    $city               =   $requests->city ?? "";
                    $zip_code           =   $requests->zip_code ?? "";
                    $suburb             =   $requests->suburb ?? "";
                    $street             =   $requests->street ?? "";
                    $external_number    =   $requests->external_number ?? "";
                    $inside_number      =   $requests->inside_number ?? "";
                @endphp
                <div class="md:col-span-2 col-span-1 font-semibold text-xl pb-2">Datos Generales</div>
                <input type="hidden" name="kind" id="kind" value="{{$kind}}">
                <input type="hidden" name="idClient" id="idClient" value="{{$id}}">
                @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "* RFC:",  "attributeInput" => "name=\"rfc\" type=\"text\" placeholder=\"Ingrese el RFC\" id=\"rfc\" data-validation=\"required rfc\" value=\"".$rfc."\""]) @endcomponent
                @component('components.inputs.inputCombo', ["classCombo" => "col-span-1 physical hidden", "classLabel" => "text-gray-500", "label" => "* Nombre:",  "attributeInput" => "name=\"namePhysical\" type=\"text\" placeholder=\"Ingrese el Nombre\" id=\"namePhysical\" data-validation=\"required\" value=\"".$name_physical."\""]) @endcomponent
                @component('components.inputs.inputCombo', ["classCombo" => "col-span-1 physical hidden", "classLabel" => "text-gray-500", "label" => "Apellido paterno:",  "attributeInput" => "name=\"lastName\" type=\"text\" placeholder=\"Ingrese el Apellido paterno\" id=\"lastName\" value=\"".$last_name."\""]) @endcomponent
                @component('components.inputs.inputCombo', ["classCombo" => "col-span-1 physical hidden", "classLabel" => "text-gray-500", "label" => "Apellido materno:",  "attributeInput" => "name=\"secondLastName\" type=\"text\" placeholder=\"Ingrese el Apellido materno\" id=\"secondLastName\" value=\"".$second_last_name."\""]) @endcomponent
                @component('components.inputs.inputCombo', ["classCombo" => "col-span-1 moral hidden", "classLabel" => "text-gray-500", "label" => "* Razon social",  "attributeInput" => "name=\"nameMoral\" type=\"text\" placeholder=\"Ingrese la Razón social\" id=\"nameMoral\" data-validation=\"required\" value=\"".$name_moral."\""]) @endcomponent
                @component('components.inputs.inputCombo', ["classCombo" => "col-span-1 moral hidden", "classLabel" => "text-gray-500", "label" => "Nombre comercial",  "attributeInput" => "name=\"businessName\" type=\"text\" placeholder=\"Ingrese el Nombre comercial\" id=\"businessName\" value=\"".$business_name."\""]) @endcomponent
                @php
                    $options = collect();
                    $cfdiData  =   App\Models\Cfdis::get();
                    foreach ($cfdiData as $cfdi)
                    {
                        if ($using_cfdi_id!="" && $cfdi->id == $using_cfdi_id)
                        {
                            $options = $options->concat([["value"  =>  $cfdi->id, "content" => $cfdi->clabe.' - '.$cfdi->using_description, "selected" => "selected"]]);
                        }
                        else
                        {
                            $options = $options->concat([["value"  =>  $cfdi->id, "content" => $cfdi->clabe.' - '.$cfdi->using_description]]);
                        }
                    }
                @endphp
                @component('components.inputs.select', ["label" => "Uso CFDI:", "options" => $options, "attributeSelect" => "disabled name=\"cfdiUsing\" multiple=\"multiple\" id=\"cfdiUsing\""]) @endcomponent
                @php
                    $options = collect();
                    $clientsData  = ['a'=>'Activo','b'=>'Inactivo','c'=>'Baja'];
                    foreach ($clientsData as $key=>$client)
                    {
                        if ($status !="" && $status == $key)
                        {
                            $options = $options->concat([["value"  =>  $key, "content" => $client, "selected" => "selected"]]);
                        }
                        else
                        {
                            $options = $options->concat([["value"  =>  $key, "content" => $client]]);
                        }
                    }
                @endphp
                @component('components.inputs.select', ["label" => "Estatus:", "classSelect" => "font-semibold text-xl p-2 ", "options" => $options, "attributeSelect" => "disabled name=\"status\" multiple=\"multiple\" id=\"status\""]) @endcomponent
            </div>
            <div class="grid md:grid-cols-2 col-span-1 md:gap-x-8">
                <div class="col-span-1">
                    <div class="col-span-1 font-semibold text-xl pb-2 mt-4">Dirección</div>
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Código postal:",  "attributeInput" => "name=\"zipCode\" type=\"text\" placeholder=\"Ingrese el Código postal\" id=\"zipCode\" value=\"".$zip_code."\""]) @endcomponent
                    @php
                        $options = collect();
                        $countriesData  =   App\Models\Countries::get();
                        foreach ($countriesData as $key=>$countries)
                        {
                            if ($country_id !="" && ($country_id+1) == $key)
                            {
                                $options = $options->concat([["value"  =>  $countries->id, "content" => $countries->name, "selected" => "selected"]]);
                            } else
                            {
                                $options = $options->concat([["value"  =>  $countries->id, "content" => $countries->name]]);
                            }
                        }
                    @endphp
                    @component('components.inputs.select',     ["label" => "País", "options" => $options, "attributeSelect" => "name=\"country\" multiple=\"multiple\" id=\"country\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Estado:",  "attributeInput" => "name=\"state\" type=\"text\" placeholder=\"Ingrese el Estado\" id=\"state\" value=\"".$state."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Municipio:",  "attributeInput" => "name=\"district\" type=\"text\" placeholder=\"Ingrese el Municipio\" id=\"district\" value=\"".$district."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Ciudad:",  "attributeInput" => "name=\"city\" type=\"text\" placeholder=\"Ingrese la Ciudad\" id=\"city\" value=\"".$city."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Colonia:",  "attributeInput" => "name=\"suburb\" type=\"text\" placeholder=\"Ingrese la Colonia\" id=\"suburb\" value=\"".$suburb."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Calle:",  "attributeInput" => "name=\"street\" type=\"text\" placeholder=\"Ingrese la Calle\" id=\"street\" value=\"".$street."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Numero exterior:",  "attributeInput" => "name=\"externalNumber\" type=\"text\" placeholder=\"Ingrese el Número exterior\" id=\"externalNumber\" value=\"".$external_number."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Numero interior:",  "attributeInput" => "name=\"insideNumber\" type=\"text\" placeholder=\"Ingrese el Número interior\" id=\"insideNumber\" value=\"".$inside_number."\""]) @endcomponent
                </div>
                <div class="col-span-1">
                    <div class="col-span-1 font-semibold text-xl pb-2 mt-4">Datos de contacto</div>
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Nombre:",  "attributeInput" => "name=\"nameContact\" type=\"text\" placeholder=\"Ingrese el Nombre del contacto\" id=\"nameContact\" value=\"".$contact_name."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Teléfono:",  "attributeInput" => "name=\"phone\" type=\"text\" placeholder=\"Ingrese el Teléfono\" id=\"phone\" value=\"".$phone."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "Telefono móvil:",  "attributeInput" => "name=\"cellPhone\" type=\"text\" placeholder=\"Ingrese el Teléfono móvil\" id=\"cellPhone\" value=\"".$celphone."\""]) @endcomponent
                    @component('components.inputs.inputCombo', ["classCombo" => "col-span-1", "classLabel" => "text-gray-500", "label" => "E-mail:",  "attributeInput" => "name=\"email\" type=\"text\" placeholder=\"Ingrese el E-mail\" id=\"email\" value=\"".$email_address."\""]) @endcomponent
                    <div class="md:col-span-3 sm:col-span-2 col-span-1">
                        <label class="text-darkSoft font-semibold">Observaciones:</label>
                        <textarea type="text" name="comments" class="w-full text-gray-500 h-16 rounded-md p-4 font-semibold focus:outline-none focus:ring-2 ring-gray-300 ring-1 transition ease-in duration-150" placeholder="Escriba sus observaciones">{{ $comments }}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" id="save" class="bg-orange-400 px-2 py-1 rounded text-white hover:opacity-80 transition ease-in-out duration-200"">Guardar</button>
            </div>
        </form>
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
    <script type="text/javascript">
        function validation()
        {
            $.validate(
			{
				form	: '#clientForm',
				modules	: 'security',
				onError	: function($form)
				{
                    Swal.fire({
                        title: '¡Atención!',
                        text: 'Algunos campos presentan errores, favor de verificar',
                        icon: 'error',
                        })
                    return false;
				}
			});
        }
        $(document).ready(function()
		{
            validation();
            kind = $('#kind').val();
            if (kind !="")
            {
                $('#cfdiUsing').prop('disabled',false);
                $('#status').prop('disabled',false);
                if (kind==1)
                {
                    $('.physical').removeClass('hidden');
                    $('.moral').addClass('hidden');
                }
                else if (kind==2)
                {
                    $('.physical').addClass('hidden');
                    $('.moral').removeClass('hidden');
                }
            }
			$('#country').select2({
				placeholder             : "Seleccione un País",
				language                : "es",
				maximumSelectionLength  : 1,
				width                   : "100%"
			})
			$('#status').select2({
				placeholder             : "Seleccione un Estatus",
				language                : "es",
				maximumSelectionLength  : 1,
				width                   : "100%"
			})
			$('#cfdiUsing').select2({
				placeholder             : "Seleccione el uso del CFDI",
				language                : "es",
				maximumSelectionLength  : 1,
				width                   : "100%",
			})
            $(document).on('input','#rfc',function()
            {
                rfc = $('#rfc').val();
                if (rfc.length==12 || rfc.length==13)
                {
                    $('#cfdiUsing').prop('disabled',false);
                    $('#status').prop('disabled',false);
                }
                else
                {
                    $('#cfdiUsing').prop('disabled',true);
                    $('#status').prop('disabled',true);
                }
                if (rfc.length==12)
                {
                    $('.physical').addClass('hidden');
                    $('.moral').removeClass('hidden');
                    $('#kind').val(2);
                }
                else if (rfc.length==13)
                {
                    $('.physical').removeClass('hidden');
                    $('.moral').addClass('hidden');
                    $('#kind').val(1);
                }
                else
                {
                    $('.physical').addClass('hidden');
                    $('.moral').addClass('hidden');
                    $('#kind').val('');
                }
            })
        });
    </script>

@endsection
