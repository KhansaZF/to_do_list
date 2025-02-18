<x-app-layout>
    

    <div class="py-12 bg-gradient-to-r from-blue-400 via-teal-300 to-blue-500 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white/30 backdrop-blur-md shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-center text-white mb-6">Tambah To-Do</h2>
            <form class="space-y-4" method="POST" action="{{ route('todos.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="title" class="block text-white font-medium">Title</label>
                    <input type="text" id="title" name="title" class="w-full bg-white/70 border border-gray-300 text-gray-900 rounded-lg focus:ring-teal-500 focus:border-teal-500 p-3 shadow-sm" placeholder="Masukkan judul" required />
                </div>

                <div>
                    <label for="description" class="block text-white font-medium">Description</label>
                    <input type="text" id="description" name="description" class="w-full bg-white/70 border border-gray-300 text-gray-900 rounded-lg focus:ring-teal-500 focus:border-teal-500 p-3 shadow-sm" placeholder="Masukkan deskripsi" required />
                </div>

                <div>
                    <label for="status" class="block text-white font-medium">Status</label>
                    <select id="status" name="status" class="w-full bg-white/70 border border-gray-300 text-gray-900 rounded-lg focus:ring-teal-500 focus:border-teal-500 p-3 shadow-sm">
                        <option value="pending">Pending</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <div>
                    <label for="image" class="block text-white font-medium">Upload Image</label>
                    <input type="file" id="image" name="image" class="w-full bg-white/70 border border-gray-300 text-gray-900 rounded-lg focus:ring-teal-500 focus:border-teal-500 p-3 shadow-sm" required />
                </div>

                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 shadow-md">
                    Submit
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
