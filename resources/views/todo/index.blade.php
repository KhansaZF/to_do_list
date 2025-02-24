<x-app-layout>
    <div class="py-12 bg-[#85A1AE] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 shadow-md sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-extrabold text-gray-800">
                        Welcome to To-Do List 
                    </h1>
                    <a href="{{ route('todo.create') }}" class="bg-[#4F6D7A] hover:bg-[#3E5864] 
                    text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md">
                        Buat Baru
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($todos as $todo)
                    <div class="bg-white/90 backdrop-blur-md rounded-lg shadow-lg overflow-hidden transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <img src="{{ Storage::url($todo->image) }}" alt="{{ $todo->title }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $todo->title }}</h2>
                            <p class="text-gray-600 text-sm mt-2 line-clamp-2">
                                {{ $todo->description }}
                            </p>
                            <a href="/todo/{{ $todo->id }}" class="text-[#4F6D7A] text-sm font-semibold hover:underline">
                                Read more
                            </a>
                            <p class="mt-2 text-sm font-semibold 
    {{ strtolower(trim($todo->status)) == 'done' ? 'text-green-600' : 'text-red-600' }}">
    Status: {{ ucfirst($todo->status) }}
</p>
                         
                            <p class="mt-2 text-sm text-gray-500">Owned by: {{ $todo->user->name }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <a href="/todo/{{ $todo->id }}/edit" class="bg-[#85A1AE] hover:bg-[#6F8B97] 
                                text-white text-sm font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md">
                                    Edit
                                </a>
                                <form action="/todo/{{ $todo->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-[#C94C4C] hover:bg-[#B03F3F] 
                                    text-white text-sm font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

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
