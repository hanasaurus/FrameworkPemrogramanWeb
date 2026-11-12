
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Riwayat Transaksi Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">
                    Daftar Transaksi Saya
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-3">No</th>
                                <th class="border p-3">No. Invoice</th>
                                <th class="border p-3">Tanggal</th>
                                <th class="border p-3">Total</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="border p-3 text-center">
                                        {{ $transactions->firstItem() + $loop->index }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $transaction->invoice_number }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $transaction->created_at->format('d-m-Y H:i') }}
                                    </td>

                                    <td class="border p-3 text-right">
                                        Rp{{ number_format($transaction->total, 0, ',', '.') }}
                                    </td>

                                    <td class="border p-3 text-center">
                                        <a href="{{ route('pos.struk', $transaction) }}"
                                           class="text-blue-600 hover:underline">
                                            Lihat Struk
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="border p-4 text-center text-gray-500">
                                        Belum ada transaksi yang dibuat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
