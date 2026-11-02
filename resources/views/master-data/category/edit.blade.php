
<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">

        <h2 class="text-xl font-bold mb-6">
            Edit Kategori
        </h2>

        <form action="{{ route('categories.update', $category->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Nama Kategori
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full border rounded p-2">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">
                    Deskripsi
                </label>

                <textarea name="description"
                          class="w-full border rounded p-2">{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>

            <a href="{{ route('categories.index') }}"
               class="ml-2 text-gray-600">
                Batal
            </a>

        </form>
    </div>
</x-app-layout>
