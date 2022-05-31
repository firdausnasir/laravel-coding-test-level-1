<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }} - {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('put')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p>ID: {{ $event->id }}</p>
                        <div class="content-start">
                            <span>Name: {{ $event->name }}</span>
                            =>
                            <label>
                                <input type="text" name="name" placeholder="Enter new name here" required>
                            </label>
                        </div>
                        <div class="content-start">
                            <span>Name: {{ $event->slug }}</span>
                            =>
                            <label>
                                <input type="text" name="slug" placeholder="Enter new slug here" required>
                            </label>
                        </div>
                        <p>Slug: {{ $event->slug }}</p>
                        <p>Start At: {{ $event->startAt }}</p>
                        <p>End At: {{ $event->endAt }}</p>
                        <p>Created At: {{ $event->createdAt }}</p>
                        <p>Updated At: {{ $event->updatedAt }}</p>
                        <p>Deleted At: {{ $event->deletedAt }}</p>
                    </div>

                    <div class="content-end mt-6">
                        <button type="submit" class="btn btn-outline-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
