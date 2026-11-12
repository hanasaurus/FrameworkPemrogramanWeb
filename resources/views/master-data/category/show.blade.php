
<x-app-layout>
    <div class="p-6 space-y-6">

        <div>
            <h2 class="text-2xl font-bold">Detail Kategori</h2>
            <p class="text-gray-500">
                Informasi kategori dan produk di dalamnya.
            </p>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <h3 class="text-lg font-semibold mb-3">
                {{ $category->name }}
            </h3>

            <p class="text-gray-600">
                Total Produk:
                <strong>{{ $category->products->count() }}</strong>
            </p>

            <p class="text-gray-600">
                Total Stok:
                <strong>{{ number_format($totalStock) }}</strong>
            </p>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <h3 class="text-lg font-semibold mb-4">
                Daftar Produk
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">No</th>
                            <th class="p-3">Kode Produk</th>
                            <th class="p-3">Nama Produk</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3">Stok</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($category->products as $product)
                            <tr class="border-b">
                                <td class="p-3">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-3">
                                    {{ $product->code }}
                                </td>

                                <td class="p-3">
                                    {{ $product->name }}
                                </td>

                                <td class="p-3">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td class="p-3">
                                    {{ number_format($product->stock) }}
                                    {{ $product->unit }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="p-4 text-center text-gray-500">
                                    Belum ada produk dalam kategori ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('categories.index') }}"
           class="inline-block px-4 py-2 bg-gray-200 rounded">
            Kembali
        </a>

    </div>
</x-app-layout>