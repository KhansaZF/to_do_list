<x-app-layout>
    <div class="py-12 bg-[#f4f7fb] min-h-screen flex justify-center">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Welcome to To-Do List</h1>
                <a href="{{ route('todo.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                    Buat Baru
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-lg shadow-md">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-700">
                            <th class="py-3 px-5 text-left">Image</th>
                            <th class="py-3 px-5 text-left">Title</th>
                            <th class="py-3 px-5 text-left">Description</th>
                            <th class="py-3 px-5 text-left">Status</th>
                            <th class="py-3 px-5 text-left">Owner</th>
                            <th class="py-3 px-5 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="py-4 px-5">
                                <img src="{{ Storage::url($todo->image) }}" alt="{{ $todo->title }}" 
                                     class="w-16 h-16 object-cover rounded-full border border-gray-300">
                            </td>
                            <td class="py-4 px-5 text-gray-800 font-medium">{{ $todo->title }}</td>
                            <td class="py-4 px-5 text-gray-600 line-clamp-1">{{ $todo->description }}</td>
                            <td class="py-4 px-5 font-semibold 
                                {{ strtolower(trim($todo->status)) == 'done' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($todo->status) }}
                            </td>
                            <td class="py-4 px-5 text-gray-700">{{ $todo->user->name }}</td>
                            <td class="py-4 px-5 flex justify-center space-x-2">
                                <a href="/todo/{{ $todo->id }}/edit" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-2 px-4 rounded-lg transition">
                                    Edit
                                </a>
                                <form action="/todo/{{ $todo->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold py-2 px-4 rounded-lg transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
