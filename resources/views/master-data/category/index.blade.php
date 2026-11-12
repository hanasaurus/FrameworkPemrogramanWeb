
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Kategori
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan berhasil --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pesan peringatan --}}
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Kategori</h3>

                    <a href="{{ route('categories.create') }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded">
                        Tambah Kategori
                    </a>
                </div>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-3">No</th>
                            <th class="border p-3">Nama Kategori</th>
                            <th class="border p-3">Deskripsi</th>
                            <th class="border p-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="border p-3 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border p-3">
                                    {{ $category->name }}
                                </td>

                                <td class="border p-3">
                                    {{ $category->description ?? '-' }}
                                </td>

                                <td class="border p-3 text-center">
    {{-- Tombol Edit --}}
    <a href="{{ route('categories.edit', $category) }}"
       class="text-blue-600 hover:underline mr-2">
        Edit
    </a>

    {{-- Tombol Detail --}}
    <a href="{{ route('categories.show', $category) }}"
       class="text-green-600 hover:underline mr-2">
        Detail
    </a>

    {{-- Tombol Hapus --}}
    <form action="{{ route('categories.destroy', $category) }}"
          method="POST"
          class="inline"
          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
        @csrf
        @method('DELETE')

        <button type="submit" class="text-red-600 hover:underline">
            Hapus
        </button>
    </form>
</td>
                        @empty
                            <tr>
                                <td colspan="4" class="border p-4 text-center">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
