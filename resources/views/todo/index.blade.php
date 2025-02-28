<x-app-layout>
    <div class="py-12 bg-[#f4f7fb] min-h-screen flex justify-center">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-4xl font-extrabold text-gray-800 text-center 
    bg-gradient-to-r from-[#85A1AE] to-[#B1E4EA] bg-clip-text text-transparent 
    drop-shadow-lg animate-fadeIn">
    Welcome to To-Do List
</h1>

                <a href="{{ route('todo.create') }}" 
                   class="bg-[#85A1AE] hover:bg-[#B1E4EA] text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
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
                                   class="bg-[#B1E4EA] hover:bg-[#85A1AE] text-gray-800 text-sm font-bold py-2 px-4 rounded-lg transition">
                                    Edit
                                </a>
                                <form action="/todo/{{ $todo->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-[#EDF8F9] hover:bg-[#B1E4EA] text-red-600 text-sm font-bold py-2 px-4 rounded-lg transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($todos->hasPages())
                <div class="flex flex-col items-center mt-8 space-y-2">
                    <span class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold text-gray-900">{{ $todos->firstItem() }}</span> - 
                        <span class="font-semibold text-gray-900">{{ $todos->lastItem() }}</span> dari 
                        <span class="font-semibold text-gray-900">{{ $todos->total() }}</span> entri
                    </span>

                    <div class="flex items-center space-x-2">
                        @if ($todos->onFirstPage())
                            <span class="flex items-center px-4 py-2 text-gray-400 bg-gray-200 rounded-full cursor-not-allowed">
                                ⬅️ Prev
                            </span>
                        @else
                            <a href="{{ $todos->previousPageUrl() }}" 
                               class="flex items-center px-4 py-2 text-white bg-[#85A1AE] rounded-full shadow-md hover:bg-[#B1E4EA] transition">
                                ⬅️ Prev
                            </a>
                        @endif

                        @if ($todos->hasMorePages())
                            <a href="{{ $todos->nextPageUrl() }}" 
                               class="flex items-center px-4 py-2 text-white bg-[#85A1AE] rounded-full shadow-md hover:bg-[#B1E4EA] transition">
                                Next ➡️
                            </a>
                        @else
                            <span class="flex items-center px-4 py-2 text-gray-400 bg-gray-200 rounded-full cursor-not-allowed">
                                Next ➡️
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
