<script setup lang="js">
import { useForm } from '@inertiajs/vue3'
import Header from '../components/Header.vue'

const form = useForm({
    name: '',
    message: '',
})

defineProps({
    signatures: []
})

function handleSubmit() {
    form.post('/store-signatures', {
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <Header />
    
    <!-- Toast Notification (unchanged logic, slightly refined styling) -->
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
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Guestbook</h1>
        <p class="mt-2 text-gray-600">
          Leave your mark! Share a thought, greeting, or encouragement.
        </p>
      </div>

      <!-- Two-column Layout: Form | List -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left: Signature Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
              Sign the Guestbook
            </h2>
          </div>

          <form @submit.prevent="handleSubmit" class="p-5">
            <!-- Name Field -->
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Your Name
              </label>
              <input
                v-model="form.name"
                type="text"
                class="w-full px-3.5 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                placeholder="e.g., Felix Aliguma"
                maxlength="50"
              />
              <p v-if="form.errors.name" class="mt-1 text-sm text-rose-600">{{ form.errors.name }}</p>
            </div>

            <!-- Message Field -->
            <div class="mb-5">
              <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                Your Message
              </label>
              <textarea
                id="message"
                v-model="form.message"
                rows="4"
                class="w-full px-3.5 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                placeholder="Share a thought, greeting, or encouragement..."
                maxlength="280"
              ></textarea>
              <div class="flex justify-between mt-1">
                <p v-if="form.errors.message" class="text-sm text-rose-600">{{ form.errors.message }}</p>
              </div>
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              :disabled="form.processing"
              class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white font-medium py-2.5 px-4 rounded-md flex items-center justify-center gap-2 transition shadow-sm"
            >
              <svg v-if="!form.processing" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
              </svg>
              <svg v-else class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
              </svg>
              {{ form.processing ? 'Signing...' : 'Add Signature' }}
            </button>
          </form>
        </div>

        <!-- Right: Signatures List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Recent Signatures
              <span class="ml-1 bg-gray-200 text-gray-800 text-xs font-medium px-2 py-0.5 rounded">
                {{ signatures.length }}
              </span>
            </h2>
          </div>

          <!-- List Container -->
          <div 
            class="max-h-[500px] overflow-y-auto divide-y divide-gray-100"
            style="scrollbar-width: thin; scrollbar-color: #e5e7eb transparent;"
          >
            <div 
              v-for="sig in signatures" 
              :key="sig.id" 
              class="p-4 hover:bg-gray-50 transition"
            >
              <div class="flex">
                <!-- Avatar Placeholder -->
                <div class="flex-shrink-0 mr-3">
                  <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-700 font-medium text-sm">
                      {{ sig.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0,2) }}
                    </span>
                  </div>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                  <div class="flex items-baseline justify-between">
                    <h3 class="font-medium text-gray-900 truncate">{{ sig.name }}</h3>
                    <time 
                      class="text-xs text-gray-500 whitespace-nowrap ml-2"
                      :datetime="sig.created_at"
                    >
                      {{ new Date(sig.created_at).toLocaleDateString('en-US', { 
                        month: 'short', 
                        day: 'numeric', 
                        year: 'numeric' 
                      }) }}
                    </time>
                  </div>
                  <p class="mt-1.5 text-gray-700 text-sm break-words">{{ sig.message }}</p>
                </div>
              </div>
            </div>

            <!-- Empty State -->
            <div v-if="signatures.length === 0" class="p-8 text-center text-gray-500">
              <p>No signatures yet. Be the first to sign!</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Note -->
      
    </div>
  </div>
</template>

<style scoped>
/* Toast transition */
.toast-enter-active,
.toast-leave-active {
  transition: all 0.3s ease;
}
.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translate(-50%, -20px);
}

/* Custom scrollbar (modern, subtle) */
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