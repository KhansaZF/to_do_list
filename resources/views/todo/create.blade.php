<x-app-layout>
    <div class="py-12 bg-gradient-to-r from-[#85A1AE] via-[#B1E4EA] to-[#EDF8F9] min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white/50 backdrop-blur-lg shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Tambah To-Do</h2>
            <form class="space-y-4" method="POST" action="{{ route('todos.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="title" class="block text-gray-700 font-medium">Title</label>
                    <input type="text" id="title" name="title" class="w-full bg-white/80 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#85A1AE] focus:border-[#85A1AE] p-3 shadow-sm" placeholder="Masukkan judul" required />
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-medium">Description</label>
                    <input type="text" id="description" name="description" class="w-full bg-white/80 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#85A1AE] focus:border-[#85A1AE] p-3 shadow-sm" placeholder="Masukkan deskripsi" required />
                </div>

                <div>
                    <label for="status" class="block text-gray-700 font-medium">Status</label>
                    <select id="status" name="status" class="w-full bg-white/80 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#85A1AE] focus:border-[#85A1AE] p-3 shadow-sm">
                        <option value="pending">pending</option>
                        <option value="done">done</option>
                    </select>
                </div>

                <div>
                    <label for="image" class="block text-gray-700 font-medium">Upload Image</label>
                    <input type="file" id="image" name="image" class="w-full bg-white/80 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#85A1AE] focus:border-[#85A1AE] p-3 shadow-sm" required />
                </div>

                <button type="submit" class="w-full bg-[#85A1AE] hover:bg-[#6F8B97] text-white font-bold py-3 px-4 rounded-lg transition duration-300 shadow-md">
                    Submit
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
