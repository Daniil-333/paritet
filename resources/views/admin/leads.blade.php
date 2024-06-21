<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Заявки') }}
        </h2>
    </x-slot>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Номер заявки</th>
                    <th>Имя</th>
                    <th>Номер телефона</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                    <tr>
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
