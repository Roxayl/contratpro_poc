
<div class="form-group md-3 my-2">
    <label for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-control">
        <option value="0">-- Choisir --</option>
        @foreach($options as $optionName => $option)
            <option value="{{ $optionName }}">{{ $option->label }}</option>
        @endforeach
    </select>
</div>
