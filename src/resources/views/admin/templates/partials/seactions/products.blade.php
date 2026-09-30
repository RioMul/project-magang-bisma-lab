@php
    $body = $templateData['body'] ?? [];
    $products = $body['products'] ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#0369a1]">
                Products
            </span>

            <h2 class="mt-1 text-xl font-bold text-slate-900">
                Product Catalog
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Atur produk yang ditampilkan pada template.
            </p>
        </div>

        <button
            type="button"
            @click="products.push({
                name: '',
                price: 0,
                old_price: 0,
                rating: 0,
                sold: 0,
                image: ''
            })"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#0369a1] hover:bg-[#027ea7] text-white text-xs font-semibold transition"
        >
            <svg
                class="w-4 h-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 5v14M5 12h14"
                />
            </svg>

            Add Product
        </button>

    </div>

    <div class="space-y-5">

        <template x-for="(product, index) in products" :key="index">

            <div class="border border-slate-200 rounded-2xl p-5">

                <div class="flex items-center justify-between mb-5">

                    <div class="flex items-center gap-3">

                        <span
                            class="w-8 h-8 rounded-lg bg-sky-50 text-[#0369a1] flex items-center justify-center text-xs font-bold"
                            x-text="index + 1"
                        ></span>

                        <div>
                            <p class="text-sm font-bold text-slate-800">
                                Product
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Product information
                            </p>
                        </div>

                    </div>

                    <button
                        type="button"
                        @click="products.splice(index, 1)"
                        class="text-xs font-semibold text-rose-400 hover:text-rose-600"
                    >
                        Remove
                    </button>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="md:col-span-2">

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Product Name
                        </label>

                        <input
                            type="text"
                            :name="`body[products][${index}][name]`"
                            x-model="product.name"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                        >

                    </div>

                    <div>

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Price
                        </label>

                        <input
                            type="number"
                            min="0"
                            :name="`body[products][${index}][price]`"
                            x-model="product.price"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                        >

                    </div>

                    <div>

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Old Price
                        </label>

                        <input
                            type="number"
                            min="0"
                            :name="`body[products][${index}][old_price]`"
                            x-model="product.old_price"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                        >

                    </div>

                    <div>

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Rating
                        </label>

                        <input
                            type="number"
                            min="0"
                            max="5"
                            step="0.1"
                            :name="`body[products][${index}][rating]`"
                            x-model="product.rating"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                        >

                    </div>

                    <div>

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Sold
                        </label>

                        <input
                            type="number"
                            min="0"
                            :name="`body[products][${index}][sold]`"
                            x-model="product.sold"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                        >

                    </div>

                    <div class="md:col-span-2">

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Image
                        </label>

                        <input
                            type="text"
                            :name="`body[products][${index}][image]`"
                            x-model="product.image"
                            placeholder="tech2.png"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm"
                        >

                    </div>

                </div>

            </div>

        </template>

    </div>

    <div
        x-show="products.length === 0"
        class="py-14 text-center border border-dashed border-slate-200 rounded-2xl"
    >

        <p class="text-sm font-semibold text-slate-600">
            No products
        </p>

        <p class="text-xs text-slate-400 mt-1">
            Klik Add Product untuk menambahkan produk.
        </p>

    </div>

</div>