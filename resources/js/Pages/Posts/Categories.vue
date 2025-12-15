<script setup lang="js">
import { useForm } from '@inertiajs/vue3'
import Header from '../components/Header.vue'

const form = useForm({
    name: '',
})

defineProps({
    postcategories: []
})

function handleSubmit() {
    form.post('/create-categories', {
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <Header />

    <!-- Toast Notification -->
    <Transition name="toast">
      <div
        v-if="$page.props.flash.message"
        class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 max-w-md w-full px-4"
      >
        <div class="flex items-center justify-between gap-3 p-4 rounded-lg bg-emerald-500 text-white shadow-md">
          <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

    <div class="max-w-6xl mx-auto px-4 py-8">
      <!-- Page Header -->
      <div class="text-center mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Post Categories</h1>
        <p class="mt-2 text-gray-600">
          Create and manage categories for your blog posts.
        </p>
      </div>

      <!-- Two-column Layout: Form | List -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left: Create Category Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Add New Category
            </h2>
          </div>

          <form @submit.prevent="handleSubmit" class="p-5">
            <!-- Name Field -->
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Category Name 
              </label>
              <input
                v-model="form.name"
                type="text"
                class="w-full px-3.5 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                placeholder="e.g., Technology, Health"
              />
             <i> <p v-if="form.errors.name" class="mt-1 text-sm text-rose-600">{{ form.errors.name }}</p></i>
            </div>

    

            <!-- Submit Button -->
            <button
              type="submit"
              :disabled="form.processing"
              class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white font-medium py-2.5 px-4 rounded-md flex items-center justify-center gap-2 transition shadow-sm"
            >
              <svg v-if="!form.processing" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              <svg v-else class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
              </svg>
              {{ form.processing ? 'Creating...' : 'Create Category' }}
            </button>
          </form>
        </div>

        <!-- Right: Categories List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
              </svg>
              Existing Categories
             <!-- <span class="ml-1 bg-gray-200 text-gray-800 text-xs font-medium px-2 py-0.5 rounded">
                {{ categories.length }}
              </span>-->
            </h2>
          </div>

          <!-- List Container -->
          <div 
            class="max-h-[500px] overflow-y-auto divide-y divide-gray-100"
            style="scrollbar-width: thin; scrollbar-color: #e5e7eb transparent;"
          >
            <div 
              v-for="cat in postcategories" 
              :key="cat.id" 
              class="p-4 hover:bg-gray-50 transition"
            >
              <div class="flex items-start">
                <!-- Category Initials Badge -->
                <div class="flex-shrink-0 mr-3 mt-0.5">
                  <div class="h-8 w-8 rounded bg-indigo-100 flex items-center justify-center">
                    <span class="text-indigo-800 font-semibold text-xs">
                      {{ cat.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0,2) }}
                    </span>
                  </div>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                  <div class="flex items-baseline justify-between">
                    <h3 class="font-medium text-gray-900 truncate">{{ cat.name }}</h3>
                    <time 
                      class="text-xs text-gray-500 whitespace-nowrap ml-2"
                      :datetime="cat.created_at"
                    >
                      {{ new Date(cat.created_at).toLocaleDateString('en-US', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                      }) }}
                    </time>
                  </div>
                </div>
              </div>
            </div>

            <!-- Empty State -->
         <!--   <div v-if="categories.length === 0" class="p-8 text-center text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
              </svg>
              <p>No categories yet. Create your first one!</p>
            </div>-->
          </div>
        </div>
      </div>

      <!-- Footer Note -->
     
    </div>
  </div>
</template>

<style scoped>
.toast-enter-active,
.toast-leave-active {
  transition: all 0.3s ease;
}
.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translate(-50%, -20px);
}

.max-h-\[500px\]::-webkit-scrollbar {
  width: 6px;
}
.max-h-\[500px\]::-webkit-scrollbar-track {
  background: transparent;
}
.max-h-\[500px\]::-webkit-scrollbar-thumb {
  background-color: #e5e7eb;
  border-radius: 3px;
}
.max-h-\[500px\]::-webkit-scrollbar-thumb:hover {
  background-color: #d1d5db;
}
</style>