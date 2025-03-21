<x-app-layout>
    

    <div class="py-12 bg-[#85A1AE] min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white/30 backdrop-blur-md shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-center text-gray-500 mb-6">Edit To-Do</h2>
            <form class="space-y-4" method="POST" action="/todo/{{ $todo->id }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div>
                    <label for="title" class="block text-gray-500 font-medium">Title</label>
                    <input type="text" id="title" name="title" class="w-full bg-white/70 border border-gray-300 text-gray-900 rounded-lg focus:ring-gray-500 focus:border-gray-500 p-3 shadow-sm" value="{{ $todo->title }}" required />
                </div>

                <div>
                    <label for="description" class="block text-gray-500 font-medium">Description</label>
                    <input type="text" id="description" name="description" class="w-full bg-white/70 border border-gray-300 text-gray-900 rounded-lg focus:ring-gray-500 focus:border-gray-500 p-3 shadow-sm" value="{{ $todo->description }}" required />
                </div>

                <div>
                    <label for="status" class="block text-gray-500 font-medium">Status</label>
                    <select id="status" name="status" class="w-full bg-white/70 border border-gray-300 text-gray-900 rounded-lg focus:ring-gray-500 focus:border-gray-500 p-3 shadow-sm">
                        <option value="pending" {{ $todo->status == 'pending' ? 'selected' : '' }}>pending</option>
                        <option value="done" {{ $todo->status == 'done' ? 'selected' : '' }}>done</option>
                    </select>
                </div>

                <div>
                    <label for="image" class="block text-gray-500 font-medium">Upload New Image</label>
                    <input type="file" id="image" name="image" class="w-full bg-white/70 border border-gray-300 text-gray-900 rounded-lg focus:ring-gray-500 focus:border-gray-500 p-3 shadow-sm" />
                </div>

                <!-- Preview gambar lama -->
                @if($todo->image)
                <div class="text-center">
                    <p class="text-gray-500 mb-2">Current Image:</p>
                    <img src="{{ Storage::url($todo->image) }}" alt="Current Image" class="w-full h-40 object-cover rounded-lg shadow-md">
                </div>
                @endif

                <button type="submit" class="w-full bg-[#4F6D7A] hover:bg-[#3E5864] text-white font-bold py-3 px-4 rounded-lg transition duration-300 shadow-md">
                    Update
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
