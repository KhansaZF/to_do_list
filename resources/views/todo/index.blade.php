<x-app-layout>
    <div class="py-12 bg-[#f4f7fb] min-h-screen flex justify-center">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-xl p-6">
            <!-- Header -->
            <div class="flex flex-wrap justify-between items-center hidden-print">
                <h1 class="text-4xl font-extrabold text-gray-500
                    bg-gradient-to-r from-[#85A1AE] to-[#B1E4EA] bg-clip-text text-transparent 
                    drop-shadow-lg animate-fadeIn mb-8">
                    Welcome to To-Do List
                </h1>

                <!-- Tombol Buat Baru & Print -->
                <div class="flex items-center gap-4 ml-auto">
                    <a href="{{ route('todo.create') }}" 
                       class="bg-[#85A1AE] hover:bg-[#B1E4EA] text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300">
                        Buat Baru
                    </a>

                    <button onclick="printTable()" 
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 flex items-center space-x-2">
                        🖨 <span>Print</span>
                    </button>
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto" id="printArea">
                <table class="min-w-full bg-white border rounded-lg shadow-md">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-700">
                            <th class="py-3 px-5 text-left">Image</th>
                            <th class="py-3 px-5 text-left">Title</th>
                            <th class="py-3 px-5 text-left">Description</th>
                            <th class="py-3 px-5 text-left">Status</th>
                            <th class="py-3 px-5 text-left">Owner</th>
                            <th class="py-3 px-5 text-center hidden-print">Actions</th>
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
                            <td class="py-4 px-5 text-gray-600">
                                <span class="block print:block hidden">
                                    {{ $todo->description }}
                                </span>
                                <div x-data="{ expanded: false }" class="hidden-print">
                                    <span x-show="!expanded">
                                        {{ Str::limit($todo->description, 50) }}...
                                    </span>
                                    <span x-show="expanded">
                                        {{ $todo->description }}
                                    </span>
                                    <button @click="expanded = !expanded" 
                                        class="text-blue-500 underline ml-2 transition-transform transform hover:scale-105 hidden-print">
                                        <span x-show="!expanded">Read More</span>
                                        <span x-show="expanded">Read Less</span>
                                    </button>
                                </div>
                            </td>
                            
                            <td class="py-4 px-5 font-semibold 
                                {{ strtolower(trim($todo->status)) == 'done' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($todo->status) }}
                            </td>

                            <td class="py-4 px-5 text-gray-700">
                                {{ $todo->user ? $todo->user->name : 'Unknown' }}
                            </td>

                            <td class="py-4 px-5 flex justify-center space-x-2 hidden-print">
                                @if ($todo->user_id === Auth::id())
                                    <a href="/todo/{{ $todo->id }}/edit" 
                                       class="bg-[#B1E4EA] hover:bg-[#85A1AE] text-gray-800 text-sm font-bold py-2 px-4 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="/todo/{{ $todo->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus To-Do ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-[#EDF8F9] hover:bg-[#B1E4EA] text-red-600 text-sm font-bold py-2 px-4 rounded-lg transition">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 italic">Akses Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6 hidden-print">
                @if ($todos->onFirstPage())
                    <span class="text-gray-400 px-4 py-2">Previous</span>
                @else
                    <a href="{{ $todos->previousPageUrl() }}" 
                       class="bg-gray-500 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300">
                        Previous
                    </a>
                @endif

                <span class="text-gray-700">Page {{ $todos->currentPage() }} of {{ $todos->lastPage() }}</span>

                @if ($todos->hasMorePages())
                    <a href="{{ $todos->nextPageUrl() }}" 
                       class="bg-gray-500 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300">
                        Next
                    </a>
                @else
                    <span class="text-gray-400 px-4 py-2">Next</span>
                @endif
            </div>
        </div>
    </div>

    <!-- CSS Print -->
    <style>
        @media print {
            .hidden-print {
                display: none !important;  
            }
        }
    </style>

    <!-- JavaScript untuk Print -->
    <script>
        function printTable() {  //mendefinisikan sebuah fungsi bernama printTable(), fungsi ini akan dipanggil jika tombol Print di klik.
            window.print();  //fungsi bawaan JavaScript yang membuka dialog cetak pada browser.
        }
    </script>
</x-app-layout>
