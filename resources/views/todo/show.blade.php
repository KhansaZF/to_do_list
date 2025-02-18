<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">{{ $todo->title }}</h1>
                    <p class="text-gray-700 mt-2">{{ $todo->description }}</p>
                    <p class="mt-2 text-sm {{ $todo->status === 'Completed' ? 'text-green-600' : 'text-red-600' }}">
                        Status: {{ $todo->status }}
                    </p>
                    <p class="mt-2 text-sm text-gray-500">Owned by: {{ $todo->user->name }}</p>
                    <a href="{{ route('todo.index') }}" class="text-blue-600 mt-4 block">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
