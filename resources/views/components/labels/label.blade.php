@php
    $mainClasses = "text-darkSoft font-semibold";
    $arrayFind = ["1" => ["text-"],"2" => ["font-"]];
@endphp
<label class="@if(isset($classLabel)) {{$classLabel}} @else {{$mainClasses}} @endif" @if (isset($attributeLabel)){{!!$attributeLabel!!}} @endif>
    @if (isset($label)) {{$label}} @else @isset($slot) {{$slot}} @endisset @endif
</label>
