@props([
    'disabled' => false,
    'className' => null,
    'alt' => null,
])

<label class="ui-input {{ $className ?? ''}}">
    <span class="ui-input__label">{{ $label ?? __('Фотография') }}</span>
    <div class="ui-input__drag">
        @if($attributes['data-preview'])
            <img src="{{ $attributes['data-preview'] }}" alt="{{ $alt ?? ''}}">
        @else
            Загрузить
        @endif
    </div>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ui-input__file']) !!} type="file">
</label>
