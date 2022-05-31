<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }} - Create New
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

            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="content-start">
                            <span>Name:</span>
                            =>
                            <label>
                                <input type="text" name="name" placeholder="Enter new name here" required value="{{ old('name') }}">
                            </label>
                        </div>
                        <div class="content-start">
                            <span>Slug: </span>
                            =>
                            <label>
                                <input type="text" name="slug" placeholder="Enter new slug here" required value="{{ old('slug') }}">
                            </label>
                        </div>
                        <div class="content-start">
                            <span>Start At: </span>
                            =>
                            <label>
                                <input type="datetime-local" name="startAt" placeholder="Enter new slug here" required value="{{ old('startAt') }}">
                            </label>
                        </div>
                        <div class="content-start">
                            <span>End At: </span>
                            =>
                            <label>
                                <input type="datetime-local" name="endAt" placeholder="Enter new slug here" required value="{{ old('endAt') }}">
                            </label>
                        </div>
                    </div>

                    <div class="content-end mt-6">
                        <button type="submit" class="btn btn-outline-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
