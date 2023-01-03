<div class="col-span-1">
    <label class="text-gray-600 font-semibold @if(isset($classLabel)) {{$classLabel}} @endif" @if (isset($attributeLabel)){{!!$attributeLabel!!}} @endif>@if (isset($label)) {{$label}} @else {{$slot}} @endif</label>
    <select class="relative p-2 text-gray-500 h-8 rounded-md font-semibold focus:outline-none focus:ring-2 ring-gray-600 ring-1 transition ease-in duration-150 @if(isset($classSelect)) {{$classSelect}} @endif" @if (isset($attributeSelect)) {!! $attributeSelect !!} @endif">
        @if (isset($options))
            @foreach ($options as $option)
                <option value={{$option["value"]}} @isset($option['selected']) selected @endisset>{{$option["content"]}}</option>
            @endforeach
        @endif
    </select>
</div>
