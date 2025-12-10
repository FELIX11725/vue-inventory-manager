<script setup>
import { useForm } from '@inertiajs/vue3'
import Header from '../components/Header.vue'

const form = useForm({
  name: null,
  price: null,
  stock_quantity: null,
  description: null,
})
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50">
    <Header />
    
    <div class="max-w-2xl mx-auto">
      
      

      <!-- Header -->
      <div class="text-center mb-10 pt-10">
       
      
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Add New Product</h1>
        <p class="mt-3 text-gray-500 max-w-lg mx-auto">
          Fill in the details below to register a new item in your inventory.
        </p>
      </div>

      <!--Form Card-->
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-cyan-50 px-6 py-4">
          <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Product Details
          </h2>
        </div>

        <form
          @submit.prevent="form.post('/store-product')"
          class="p-6 sm:p-8 space-y-6"
        >
          <!-- Name -->
          <div class="space-y-2">
            <label for="name" class="block text-sm font-medium text-gray-700 flex items-center gap-1.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Product Name
            </label>
            <div class="relative">
              <input
                id="name"
                type="text"
                v-model="form.name"
                :class="[
                  'w-full px-4 py-3 pl-10 border rounded-xl focus:outline-none transition-all',
                  form.errors.name
                    ? 'border-rose-400 bg-rose-50 focus:ring-2 focus:ring-rose-200'
                    : 'border-gray-300 hover:border-gray-400 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500'
                ]"
                placeholder="e.g. Premium Wireless Headphones"
              />
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <p v-if="form.errors.name" class="text-rose-600 text-sm italic font-medium ml-1 mt-1">
              {{ form.errors.name }}
            </p>
          </div>

          <!-- Price -->
          <div class="space-y-2">
            <label for="price" class="block text-sm font-medium text-gray-700 flex items-center gap-1.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
              </svg>
              Price (USD)
            </label>
            <div class="relative">
              <div class="absolute left-3 top-3.5 text-gray-500 font-medium">$</div>
              <input
                id="price"
                type="number"
                step="0.01"
                v-model="form.price"
                :class="[
                  'w-full px-4 py-3 pl-8 border rounded-xl focus:outline-none transition-all',
                  form.errors.price
                    ? 'border-rose-400 bg-rose-50 focus:ring-2 focus:ring-rose-200'
                    : 'border-gray-300 hover:border-gray-400 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500'
                ]"
                placeholder="0.00"
              />
            </div>
            <p v-if="form.errors.price" class="text-rose-600 text-sm italic font-medium ml-1 mt-1">
              {{ form.errors.price }}
            </p>
          </div>

          <!-- Stock Quantity -->
          <div class="space-y-2">
            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 flex items-center gap-1.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
              Stock Quantity
            </label>
            <div class="relative">
              <input
                id="stock_quantity"
                type="number"
                v-model="form.stock_quantity"
                min="0"
                :class="[
                  'w-full px-4 py-3 pl-10 border rounded-xl focus:outline-none transition-all',
                  form.errors.stock_quantity
                    ? 'border-rose-400 bg-rose-50 focus:ring-2 focus:ring-rose-200'
                    : 'border-gray-300 hover:border-gray-400 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500'
                ]"
                placeholder="e.g. 50"
              />
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
            </div>
            <p v-if="form.errors.stock_quantity" class="text-rose-600 text-sm italic font-medium ml-1 mt-1">
              {{ form.errors.stock_quantity }}
            </p>
          </div>

          <!-- Description -->
          <div class="space-y-2">
            <label for="description" class="block text-sm font-medium text-gray-700 flex items-center gap-1.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Description
            </label>
            <textarea
              id="description"
              v-model="form.description"
              :class="[
                'w-full px-4 py-3 pl-10 border rounded-xl focus:outline-none transition-all resize-none',
                form.errors.description
                  ? 'border-rose-400 bg-rose-50 focus:ring-2 focus:ring-rose-200'
                  : 'border-gray-300 hover:border-gray-400 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500'
              ]"
              placeholder="Briefly describe the product features..."
              rows="4"
            ></textarea>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p v-if="form.errors.description" class="text-rose-600 text-sm italic font-medium ml-1 mt-1">
              {{ form.errors.description }}
            </p>
          </div>

          <!-- Submit Button -->
          <div class="pt-2">
            <button
              type="submit"
              :disabled="form.processing"
              class="w-full flex items-center justify-center gap-2 py-3.5 px-5 bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-700 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-75 disabled:cursor-not-allowed"
            >
              <svg v-if="!form.processing" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              <svg v-else class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ form.processing ? 'Creating...' : 'Create Product' }}
            </button>
          </div>
        </form>
      </div>

      <!-- Subtle Footer -->
      <div class="mt-10 text-center text-gray-400 text-sm">
        <p>Fields marked with <span class="text-rose-500">*</span> are required</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Optional: Smooth pulse effect on focus */
input:focus, textarea:focus {
  animation: subtlePulse 0.6s ease-out;
}
@keyframes subtlePulse {
  0%, 100% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0); }
  50% { box-shadow: 0 0 0 8px rgba(99, 102, 241, 0.1); }
}
</style>