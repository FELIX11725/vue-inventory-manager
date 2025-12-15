<script setup>
import Header from '../components/Header.vue'
import { useForm } from '@inertiajs/vue3'
import { computed } from "vue";


const form = useForm({
    post_category_id: '',
    title: '',
    content: ''
})

const props = defineProps({
  postcategories: []
})

const selectOptions = computed(() =>
    props.postcategories.map(c => ({
        id: c.id,
        text: c.name
    }))
)







function createPost() {
    form.post('/store-post', {
        onSuccess: () => {
            form.reset()
        }
    })

}
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <Header />

    <div class="max-w-4xl mx-auto px-4 py-8">
      <!-- Header -->
      <div class="text-center mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Create New Post</h1>
        <p class="mt-2 text-gray-600">
          Share your thoughts, ask a question, or start a discussion.
        </p>
      </div>

      <!-- Form Card -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
          <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Post Details
          </h2>
        </div>

        <form @submit.prevent="createPost" class="p-5 space-y-5">
          <!-- Category -->
          <div>
            <label for="post_category_id" class="block text-sm font-medium text-gray-700 mb-1">
              Category
            </label>
<Select2Vue3
  id="post_category_id"
  v-model="form.post_category_id"
  :options="selectOptions"
  :multiple="false"
  placeholder="Select a category"
/>
<i>
  <p v-if="form.errors.post_category_id" class="text-rose-600 text-sm mt-1">
    {{ form.errors.post_category_id }}
  </p>
</i>


          </div>

          <!-- Title -->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
              Title
            </label>
            <input
              v-model="form.title"
              type="text"
              class="w-full px-3.5 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="e.g. How we improved page load speed by 70%"
              maxlength="150"
            />
            <i><p v-if="form.errors.title" class="text-rose-600 text-sm mt-1">{{ form.errors.content }}</p></i>
          </div>

          <!-- Content -->
          <div>
            <div class="flex justify-between items-start">
              <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                Content
              </label>
              <span class="text-xs text-gray-500">0/2000</span>
            </div>
            <textarea
              id="content"
              v-model="form.content"
              rows="8"
              class="w-full px-3.5 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-mono text-sm"
              placeholder="Write your post here. You can use **bold**, *italic*, lists, links, etc. (Markdown supported)"
            ></textarea>
          <i><p v-if="form.errors.content" class="text-rose-600 text-sm mt-1">{{ form.errors.content }}</p></i>
            <p class="mt-1 text-xs text-gray-500">Supports Markdown • Line breaks preserved</p>
          </div>



          <!-- Actions -->
          <div class="pt-3 flex flex-wrap gap-3">
            <button
              type="submit"
              :disabled="form.processing"
              class="px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-md flex items-center gap-2 shadow-sm opacity-100 cursor-not-allowed"
            >
              <svg v-if="!form.processing" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <svg v-else class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
              {{ form.processing ? 'Creating...' : 'Create Post' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Optional subtle shadow on focus for consistency */
input:focus,
textarea:focus,
select:focus {
  outline: none;
  border-color: #4f46e5;
  box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}
</style>
