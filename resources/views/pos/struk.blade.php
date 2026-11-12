
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Struk Transaksi</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-md mx-auto px-4 sm:px-6">

            {{-- Tombol di luar area struk --}}
            <div class="no-print flex gap-2 mb-4">
                <button onclick="window.print()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Cetak Struk
                </button>

                <a href="{{ route('pos.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Transaksi Baru
                </a>
            </div>

            {{-- Area struk --}}
            <div class="receipt">
                <x-card>
                    <p class="text-center font-semibold">
                        POS Barokah Mart
                    </p>

                    <p class="text-center text-xs text-gray-500 mb-3">
                        {{ $transaction->invoice_number }}
                    </p>

                    <p class="text-xs text-gray-500 mb-3">
                        {{ $transaction->created_at->format('d M Y H:i') }}
                        &middot;
                        Kasir: {{ $transaction->user->name }}
                    </p>

                    <hr class="mb-3">

                    @foreach ($transaction->details as $detail)
                        <div class="flex justify-between text-sm mb-1">
                            <span>
                                {{ $detail->product->name }} x{{ $detail->qty }}
                            </span>

                            <span>
                                Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach

                    <hr class="my-3">

                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>
                            Rp{{ number_format($transaction->total, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Bayar</span>
                        <span>
                            Rp{{ number_format($transaction->pay, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Kembali</span>
                        <span>
                            Rp{{ number_format($transaction->change, 0, ',', '.') }}
                        </span>
                    </div>

                    <hr class="my-3">

                    <p class="text-center text-xs text-gray-500">
                        Terima kasih telah berbelanja!
                    </p>
                </x-card>
            </div>

        </div>
    </div>
</x-app-layout>

<style>
    @media print {
        .no-print,
        nav,
        header {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .receipt {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 auto !important;
            padding: 0 !important;
            box-shadow: none !important;
        }
    }
</style>
