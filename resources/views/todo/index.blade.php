<x-app-layout> 
    <div class="py-12 bg-[#85A1AE] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 shadow-md sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-extrabold text-gray-800 animate-pulse">
                        Welcome to To-Do List 
                    </h1>
                    <a href="{{ route('todo.create') }}" class="bg-[#4F6D7A] hover:bg-[#3E5864] 
                    text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md">
                        Buat Baru
                    </a>
                </div>

                <!-- Table View -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 bg-white rounded-lg">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-300 px-4 py-2">Image</th>
                                <th class="border border-gray-300 px-4 py-2">Title</th>
                                <th class="border border-gray-300 px-4 py-2">Description</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Owner</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todos as $todo)
                                <tr class="text-center">
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if($todo->image)
                                            <img src="{{ Storage::url($todo->image) }}" 
                                                 class="w-16 h-16 object-cover rounded-md mx-auto" 
                                                 alt="Task Image">
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 font-semibold">
                                        {{ $todo->title }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm">
                                        {{ Str::limit($todo->description, 50) }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 font-semibold 
                                        {{ strtolower(trim($todo->status)) == 'done' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ ucfirst($todo->status) }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $todo->user->name }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="/todo/{{ $todo->id }}/edit" 
                                           class="bg-[#85A1AE] hover:bg-[#6F8B97] text-white text-sm font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md">
                                            Edit
                                        </a>
                                        <form action="/todo/{{ $todo->id }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-[#C94C4C] hover:bg-[#B03F3F] text-white text-sm font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md">
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
                                <span class="flex items-center px-4 py-2 text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg> Prev
                                </span>
                            @else
                                <a href="{{ $todos->previousPageUrl() }}" 
                                class="flex items-center px-4 py-2 text-white bg-[#45444C] hover:bg-[#36353B] rounded-lg shadow-md transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg> Prev
                                </a>
                            @endif

                            @if ($todos->hasMorePages())
                                <a href="{{ $todos->nextPageUrl() }}" 
                                class="flex items-center px-4 py-2 text-white bg-[#45444C] hover:bg-[#36353B] rounded-lg shadow-md transition">
                                    Next
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @else
                                <span class="flex items-center px-4 py-2 text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed shadow-md">
                                    Next
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
