<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Transaksi Pembelian Sampah') }}
            </h2>
            <a href="{{ route('waste-purchases.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto" x-data="purchaseForm()">
        <form method="POST" action="{{ route('waste-purchases.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Data Master -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informasi Transaksi</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="supplier_id" :value="__('Supplier')" />
                                <select id="supplier_id" name="supplier_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm" required>
                                    <option value="" disabled selected>-- Pilih Supplier --</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('supplier_id')" />
                            </div>

                            <div>
                                <x-input-label for="payment_status" :value="__('Status Pembayaran')" />
                                <select id="payment_status" name="payment_status" x-model="paymentStatus" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm" required>
                                    <option value="paid">Lunas</option>
                                    <option value="unpaid">Belum Bayar (Hutang)</option>
                                    <option value="partial">Sebagian (DP)</option>
                                </select>
                            </div>

                            <div x-show="paymentStatus !== 'unpaid'" x-transition>
                                <x-input-label for="amount_paid" :value="__('Nominal Dibayar (Rp)')" />
                                <x-text-input id="amount_paid" name="amount_paid" type="number" x-model.number="amountPaid" class="mt-1 block w-full" />
                            </div>

                            <div>
                                <x-input-label for="notes" :value="__('Catatan (Opsional)')" />
                                <textarea id="notes" name="notes" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Item -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Item Sampah</h3>
                            <button type="button" @click="addItem()" class="px-3 py-1.5 bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800 rounded-md text-sm font-semibold transition-colors">
                                + Tambah Baris
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-3 py-2">Kategori</th>
                                        <th class="px-3 py-2 w-24">Harga/Kg</th>
                                        <th class="px-3 py-2 w-24">Berat (Kg)</th>
                                        <th class="px-3 py-2 w-32">Subtotal</th>
                                        <th class="px-3 py-2 w-12 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr class="border-b dark:border-gray-700">
                                            <td class="px-2 py-2">
                                                <select :name="`items[${index}][waste_category_id]`" x-model="item.categoryId" @change="updatePrice(index)" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-sm rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                                                    <option value="" disabled>Pilih Kategori</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" data-price="{{ $category->price_per_kg }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-2 py-2">
                                                <input type="number" :name="`items[${index}][price_per_kg]`" x-model.number="item.price" readonly class="w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-sm rounded-md shadow-sm" required>
                                            </td>
                                            <td class="px-2 py-2">
                                                <input type="number" :name="`items[${index}][weight_kg]`" x-model.number="item.weight" step="0.01" min="0.1" @input="calculateSubtotal(index)" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-sm rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                                            </td>
                                            <td class="px-2 py-2">
                                                <input type="number" :name="`items[${index}][subtotal]`" x-model.number="item.subtotal" readonly class="w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-sm rounded-md shadow-sm font-semibold" required>
                                            </td>
                                            <td class="px-2 py-2 text-center">
                                                <button type="button" @click="removeItem(index)" class="text-red-500 hover:text-red-700" x-show="items.length > 1">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-50 dark:bg-gray-700/50 font-bold">
                                        <td colspan="2" class="px-3 py-3 text-right">TOTAL</td>
                                        <td class="px-3 py-3">
                                            <span x-text="totalWeight"></span> Kg
                                            <input type="hidden" name="total_weight" :value="totalWeight">
                                        </td>
                                        <td class="px-3 py-3 text-green-600 dark:text-green-400">
                                            Rp <span x-text="formatCurrency(totalAmount)"></span>
                                            <input type="hidden" name="total_amount" :value="totalAmount">
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <x-primary-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900 py-3 px-6 text-base">
                                {{ __('Proses Pembelian') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Alpine JS Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('purchaseForm', () => ({
                paymentStatus: 'paid',
                amountPaid: 0,
                items: [
                    { categoryId: '', price: 0, weight: 0, subtotal: 0 }
                ],
                categories: @json($categories->map(function($c) { return ['id' => $c->id, 'price' => $c->price_per_kg]; })),
                
                addItem() {
                    this.items.push({ categoryId: '', price: 0, weight: 0, subtotal: 0 });
                },
                
                removeItem(index) {
                    if (this.items.length > 1) {
                        this.items.splice(index, 1);
                    }
                },
                
                updatePrice(index) {
                    const selectedCatId = this.items[index].categoryId;
                    const category = this.categories.find(c => c.id == selectedCatId);
                    if (category) {
                        this.items[index].price = category.price;
                        this.calculateSubtotal(index);
                    }
                },
                
                calculateSubtotal(index) {
                    const price = parseFloat(this.items[index].price) || 0;
                    const weight = parseFloat(this.items[index].weight) || 0;
                    this.items[index].subtotal = price * weight;
                    
                    // Auto-update amount paid if status is paid
                    if (this.paymentStatus === 'paid') {
                        this.amountPaid = this.totalAmount;
                    }
                },
                
                get totalWeight() {
                    return this.items.reduce((sum, item) => sum + (parseFloat(item.weight) || 0), 0).toFixed(2);
                },
                
                get totalAmount() {
                    const total = this.items.reduce((sum, item) => sum + (parseFloat(item.subtotal) || 0), 0);
                    // Also auto update amountPaid if status is paid
                    if (this.paymentStatus === 'paid') {
                        this.amountPaid = total;
                    } else if (this.paymentStatus === 'unpaid') {
                        this.amountPaid = 0;
                    }
                    return total;
                },
                
                formatCurrency(value) {
                    return new Intl.NumberFormat('id-ID').format(value);
                }
            }));
        });
    </script>
</x-app-layout>
