<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Слайдер') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('admin.slider.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6" >
        @csrf

        <div class="grid gap-6 grid-cols-3 photos">
            @if(count($slides) > 0)
                @foreach($slides as $slide)
                    <div class="photo">
                        <button type="button" data-del class="photo__remove">X</button>
                        <x-file-input name="slide[]" class="mt-1 block w-full" data-preview="{{ $slide->name }}" alt="{{ $slide->alt }}" />
                        <input type="hidden" name="id[]" value="{{ $slide->id }}">
                        <div class="ui-input">
                            <span class="ui-input__label">Описание</span>
                            <x-text-input name="alt[]" type="text" class="mt-1 block w-full" value="{{ $slide->alt }}" />
                        </div>
                        <div class="ui-input">
                            <span class="ui-input__label">Ссылка</span>
                            <x-text-input name="link[]" type="text" class="mt-1 block w-full" value="{{ $slide->link }}" />
                        </div>
                        <div class="ui-input">
                            <span class="ui-input__label">Номер позиции</span>
                            <x-text-input name="position[]" type="text" class="mt-1 block w-full" value="{{ $slide->position }}" />
                        </div>
                    </div>
                @endforeach
            @else
                <div class="photo">
                    <button type="button" data-del class="photo__remove">X</button>
                    <x-file-input name="slide[]" class="mt-1 block w-full" />
                    <input type="hidden" name="id[]" value="{{ md5(uniqid('pic')) }}">
                    <div class="ui-input">
                        <span class="ui-input__label">Описание</span>
                        <x-text-input name="alt[]" type="text" class="mt-1 block w-full" />
                    </div>
                    <div class="ui-input">
                        <span class="ui-input__label">Ссылка</span>
                        <x-text-input name="link[]" type="text" class="mt-1 block w-full" value="{{ $slide->link }}" />
                    </div>
                    <div class="ui-input">
                        <span class="ui-input__label">Номер позиции</span>
                        <x-text-input name="position[]" type="text" class="mt-1 block w-full" />
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
            <x-primary-button type="button" data-copy="photo">{{ __('Добавить') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
