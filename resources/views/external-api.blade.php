<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('External API') }} - {{ $url }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 table-responsive-md">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Website</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $value)
                            <tr>
                                <th scope="row">{{ $value['id'] }}</th>
                                <td>{{ $value['name'] }}</td>
                                <td>{{ $value['username'] }}</td>
                                <td>{{ $value['email'] }}</td>
                                <td>{{ implode(', ', Arr::except($value['address'], 'geo')) }}</td>
                                <td>{{ $value['phone'] }}</td>
                                <td>{{ $value['website'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
