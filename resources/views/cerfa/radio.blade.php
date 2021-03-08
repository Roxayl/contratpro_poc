
<div class="form-group md-3 my-2">
    <label for="{{ $name }}">{{ $label }}</label>
    <br>

    @foreach($options as $optionName => $option)
        <label for="{{ $name }}[{{ $optionName }}]">{{ $option->label }}</label>
        <input type="radio" name="{{ $name }}" id="{{ $name }}[{{ $optionName }}]" value="{{ $optionName }}">
    @endforeach
</div>
