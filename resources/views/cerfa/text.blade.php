
<div class="form-group md-3 my-2">
    <label for="{{ $name }}">{{ $label  }}</label>
    @if(!empty($description))
        <br><small>{{ $description }}</small>
    @endif
    <input name="{{ $name }}" id="{{ $name }}" type="text" class="form-control">
</div>
