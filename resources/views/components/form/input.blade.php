@props([
    'id' => '',
    'type' => 'text',
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'options' => [],
])

<div>
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>

    @if ($required)
        <span class="text-danger">*</span>
    @endif

    @switch($type)
        @case('textarea')
            <textarea class="form-control" id="{{ $id }}" placeholder="{{ $placeholder }}" name="{{ $name }}"
                @if ($required) required @endif @if ($disabled) disabled @endif
                @if ($readonly) readonly @endif>{{ $value ?? old($name) }}</textarea>
        @break

        @case('select')
            <select class="form-select mb-3" name="{{ $name }}" id="{{ $id }}"
                aria-label="Default select example" @if ($required) required @endif
                @if ($disabled) disabled @endif @if ($readonly) readonly @endif>
                @foreach ($options as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" @if ($value == $optionValue || old($name) == $optionValue) selected @endif>
                        {{ $optionLabel }}
                    </option>
                @endforeach
            </select>
        @break

        @case('date')
            <input type="{{ $type }}" class="form-control" id="{{ $id }}" placeholder="{{ $placeholder }}"
                name="{{ $name }}" value="{{ $value ?? old($name) }}"
                @if ($required) required @endif @if ($disabled) disabled @endif
                @if ($readonly) readonly @endif>
        @break

        @default
            <input type="{{ $type }}" class="form-control" id="{{ $id }}" placeholder="{{ $placeholder }}"
                name="{{ $name }}" value="{{ $value ?? old($name) }}"
                @if ($required) required @endif @if ($disabled) disabled @endif
                @if ($readonly) readonly @endif>
    @endswitch

    @error($name)
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>
