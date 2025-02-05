<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }} - {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>ID: {{ $event->id }}</p>
                    <p>Name: {{ $event->name }}</p>
                    <p>Slug: {{ $event->slug }}</p>
                    <p>Start At: {{ $event->startAt }}</p>
                    <p>End At: {{ $event->endAt }}</p>
                    <p>Created At: {{ $event->createdAt }}</p>
                    <p>Updated At: {{ $event->updatedAt }}</p>
                    <p>Deleted At: {{ $event->deletedAt }}</p>
                </div>

                <div class="content-end mt-6">
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-info">Edit</a>
                    <form action="{{ route('events.destroy', $event) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
