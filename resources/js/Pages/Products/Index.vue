<script setup>
import { Link } from '@inertiajs/vue3'
import Header from '../components/Header.vue' 



defineProps({
    products: []
})
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 ">
    <Header />

    <div class="max-w-7xl mx-auto">
        <!-- Top Right: Settings Button -->
<div class="flex justify-end mb-6">

</div>
      <!-- Flash Message – Toast-Style Banner -->
      <Transition name="toast">
        <div
          v-if="$page.props.flash.message"
          class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 max-w-2xl w-full px-6"
        >
          <div
            class="flex items-center justify-between gap-3 p-4 rounded-xl bg-emerald-500 text-white shadow-lg"
          >
            <div class="flex items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span class="font-medium">{{ $page.props.flash.message }}</span>
            </div>
            <button
              @click="$page.props.flash.message = null"
              class="text-emerald-100 hover:text-white focus:outline-none"
              aria-label="Dismiss"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </Transition>

      <!-- Page Header -->
      <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Product Inventory</h1>
        <p class="text-gray-500 max-w-2xl mx-auto">
          Manage your product catalog efficiently. Add new items or update existing ones at any time.
        </p>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row justify-center gap-4 mb-12">
       
        



        
        
      </div>

      <!-- Product Table Card -->
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            All Products
          </h2>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 tracking-tight">Product</th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 tracking-tight">Price</th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 tracking-tight">Description</th>
                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 tracking-tight">Stock</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
              <tr
                v-for="product in products"
                :key="product.id"
                class="hover:bg-gray-50 transition-colors duration-200"
              >
                <td class="px-6 py-5">
                  <div class="font-medium text-gray-900">{{ product.name }}</div>
                </td>
                <td class="px-6 py-5">
                  <span class="font-mono font-semibold text-gray-800">
                    ${{ typeof product.price === 'number' ? (product.price / 100).toFixed(2) : product.price }}
                  </span>
                </td>
                <td class="px-6 py-5 max-w-md">
                  <p class="text-gray-600 text-sm line-clamp-2">
                    {{ product.description || '—' }}
                  </p>
                </td>
                <td class="px-6 py-5">
                  <span
                    :class="[
                      product.stock_quantity > 10
                        ? 'bg-emerald-100 text-emerald-800'
                        : product.stock_quantity > 0
                        ? 'bg-amber-100 text-amber-800'
                        : 'bg-rose-100 text-rose-800',
                      'px-3 py-1 inline-flex items-center text-xs font-medium rounded-full'
                    ]"
                  >
                    <span class="h-1.5 w-1.5 rounded-full mr-1.5"
                      :class="[
                        product.stock_quantity > 10 ? 'bg-emerald-500' :
                        product.stock_quantity > 0 ? 'bg-amber-500' :
                        'bg-rose-500'
                      ]"
                    ></span>
                    {{ product.stock_quantity || 0 }} in stock
                  </span>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Empty State -->
          <div
            v-if="products.length === 0"
            class="text-center py-16 px-6 bg-gray-50 border-t"
          >
            <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-gray-200 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No products yet</h3>
            <p class="text-gray-500 max-w-md mx-auto mb-6">
              Start building your inventory by adding your first product.
            </p>
            <Link
              href="/create-product"
              class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow transition-colors"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Add Your First Product
            </Link>
          </div>
        </div>
      </div>

      <!-- Subtle Footer Spacer -->
      <div class="h-10"></div>
    </div>
  </div>
</template>

<style scoped>
.toast-enter-active,
.toast-leave-active {
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translate(-50%, -20px) scale(0.95);
}
</style>