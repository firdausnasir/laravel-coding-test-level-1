<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="content-end">
                    <div class="rounded">
                        <form action="">
                            <input type="search" name="q" class="rounded mx-3 my-2" placeholder="Search id, name, or slug" aria-label="Search" aria-describedby="search-addon" value="{{ Request::get('q') }}"/>
                            <button class="btn btn-outline-dark mx-3 my-2">Search</button>
                        </form>
                    </div>
                    <div>
                        <a href="{{ route('events.create') }}" class="btn btn-outline-success mx-3 my-2">Create New Event</a>
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 table-responsive-md">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Start At</th>
                            <th scope="col">End At</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Deleted At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $data)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('events.show', $data) }}" class="text-dark text-decoration-none">{{ $data->id }}</a>
                                </th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->slug }}</td>
                                <td>{{ $data->startAt }}</td>
                                <td>{{ $data->endAt }}</td>
                                <td>{{ $data->createdAt }}</td>
                                <td>{{ $data->updatedAt }}</td>
                                <td>{{ $data->deletedAt ?? 'Not deleted' }}</td>
                                <td>
                                    <div class="flex flex-row content-start">
                                        <a href="{{ route('events.edit', $data) }}" class="btn btn-outline-info">Edit</a>
                                        @if(empty($data->deletedAt))
                                            <form action="{{ route('events.destroy', $data) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
