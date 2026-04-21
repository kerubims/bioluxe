<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mesin Kasir (POS)') }}
            </h2>
            <a href="{{ route('sales.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Riwayat Penjualan
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto" x-data="posSystem()">
        
        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('sales.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Daftar Produk (Kiri) -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                        
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Belanja</h3>
                            <button type="button" @click="addItem()" class="px-3 py-1.5 bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800 rounded-md text-sm font-semibold transition-colors">
                                + Tambah Produk
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-3 py-2">Produk</th>
                                        <th class="px-3 py-2 w-24">Harga</th>
                                        <th class="px-3 py-2 w-24 text-center">Qty</th>
                                        <th class="px-3 py-2 w-32 text-right">Subtotal</th>
                                        <th class="px-3 py-2 w-12 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr class="border-b dark:border-gray-700">
                                            <td class="px-2 py-2">
                                                <select :name="`items[${index}][product_id]`" x-model="item.productId" @change="updatePrice(index)" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-sm rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                                                    <option value="" disabled>Pilih Produk</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-2 py-2">
                                                <input type="number" :name="`items[${index}][price]`" x-model.number="item.price" readonly class="w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-sm rounded-md shadow-sm" required>
                                            </td>
                                            <td class="px-2 py-2">
                                                <div class="flex items-center">
                                                    <button type="button" @click="decrementQty(index)" class="px-2 py-1 bg-gray-200 dark:bg-gray-600 rounded-l-md hover:bg-gray-300 dark:hover:bg-gray-500">-</button>
                                                    <input type="number" :name="`items[${index}][quantity]`" x-model.number="item.quantity" min="1" @input="calculateSubtotal(index)" class="w-full text-center border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-sm focus:ring-green-500 focus:border-green-500 p-1" style="appearance: textfield;" required>
                                                    <button type="button" @click="incrementQty(index)" class="px-2 py-1 bg-gray-200 dark:bg-gray-600 rounded-r-md hover:bg-gray-300 dark:hover:bg-gray-500">+</button>
                                                </div>
                                            </td>
                                            <td class="px-2 py-2 text-right">
                                                <input type="hidden" :name="`items[${index}][subtotal]`" x-model.number="item.subtotal">
                                                <span class="font-semibold text-gray-900 dark:text-white" x-text="formatCurrency(item.subtotal)"></span>
                                            </td>
                                            <td class="px-2 py-2 text-center">
                                                <button type="button" @click="removeItem(index)" class="text-red-500 hover:text-red-700" x-show="items.length > 1">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran (Kanan) -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6 sticky top-6">
                        
                        <div class="text-center mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Total Tagihan</h3>
                            <div class="text-4xl font-bold text-green-600 dark:text-green-400">
                                Rp <span x-text="formatCurrency(totalAmount)"></span>
                            </div>
                            <input type="hidden" name="total_amount" :value="totalAmount">
                        </div>

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="customer_id" :value="__('Pelanggan (Opsional)')" />
                                <select id="customer_id" name="customer_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm">
                                    <option value="">-- Umum / Tanpa Nama --</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="payment_method" :value="__('Metode Pembayaran')" />
                                <div class="flex gap-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="payment_method" value="cash" class="text-green-600 focus:ring-green-500" checked>
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Tunai (Cash)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="payment_method" value="transfer" class="text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Transfer</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="amount_paid" :value="__('Uang Diterima (Rp)')" />
                                <x-text-input id="amount_paid" name="amount_paid" type="number" x-model.number="amountPaid" class="mt-1 block w-full font-bold text-lg" required />
                                
                                <div class="mt-2 flex gap-2">
                                    <button type="button" @click="amountPaid = totalAmount" class="px-2 py-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-xs rounded border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300">Uang Pas</button>
                                    <button type="button" @click="amountPaid = Math.ceil(totalAmount/50000)*50000" class="px-2 py-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-xs rounded border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300" x-show="totalAmount > 0">Genap 50k</button>
                                    <button type="button" @click="amountPaid = Math.ceil(totalAmount/100000)*100000" class="px-2 py-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-xs rounded border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300" x-show="totalAmount > 0">Genap 100k</button>
                                </div>
                            </div>

                            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">Kembalian:</span>
                                    <span class="text-xl font-bold" :class="changeAmount < 0 ? 'text-red-500' : 'text-blue-600 dark:text-blue-400'">
                                        Rp <span x-text="formatCurrency(changeAmount)"></span>
                                    </span>
                                </div>
                            </div>
                            
                            <div>
                                <x-input-label for="notes" :value="__('Catatan (Opsional)')" />
                                <textarea id="notes" name="notes" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" :disabled="changeAmount < 0 || totalAmount <= 0" :class="{'opacity-50 cursor-not-allowed': changeAmount < 0 || totalAmount <= 0}">
                                BAYAR SEKARANG
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Alpine JS Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('posSystem', () => ({
                amountPaid: 0,
                items: [
                    { productId: '', price: 0, quantity: 1, subtotal: 0 }
                ],
                productsList: @json($products->map(function($p) { return ['id' => $p->id, 'price' => $p->price]; })),
                
                addItem() {
                    this.items.push({ productId: '', price: 0, quantity: 1, subtotal: 0 });
                },
                
                removeItem(index) {
                    if (this.items.length > 1) {
                        this.items.splice(index, 1);
                    }
                },
                
                updatePrice(index) {
                    const selectedId = this.items[index].productId;
                    const product = this.productsList.find(p => p.id == selectedId);
                    if (product) {
                        this.items[index].price = product.price;
                        this.calculateSubtotal(index);
                    }
                },

                incrementQty(index) {
                    this.items[index].quantity++;
                    this.calculateSubtotal(index);
                },

                decrementQty(index) {
                    if (this.items[index].quantity > 1) {
                        this.items[index].quantity--;
                        this.calculateSubtotal(index);
                    }
                },
                
                calculateSubtotal(index) {
                    const price = parseFloat(this.items[index].price) || 0;
                    const qty = parseInt(this.items[index].quantity) || 0;
                    this.items[index].subtotal = price * qty;
                },
                
                get totalAmount() {
                    return this.items.reduce((sum, item) => sum + (parseFloat(item.subtotal) || 0), 0);
                },

                get changeAmount() {
                    return (parseFloat(this.amountPaid) || 0) - this.totalAmount;
                },
                
                formatCurrency(value) {
                    return new Intl.NumberFormat('id-ID').format(value);
                }
            }));
        });
    </script>
</x-app-layout>
