<script setup>
import Header from '../components/Header.vue'
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <Header />

    <div class="py-10 px-4">
      <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
          <div class="inline-flex items-center justify-center h-14 w-14 rounded-2xl bg-indigo-100 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
          </div>
          <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Create New Post</h1>
          <p class="mt-2 text-gray-600">
            Share your thoughts, ask a question, or start a discussion.
          </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
          <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-cyan-50 px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Post Details
            </h2>
          </div>

          <div class="p-6">
            <form @submit.prevent="handlesubmit" class="space-y-6">
              <!-- Category Selector -->
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
                  <option>General Discussion</option>
                 
                </select>
              </div>

              <!-- Title -->
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Post Title</label>
                <input
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                  placeholder="e.g. Introducing our new guestbook feature"
                />
              </div>

              <!-- Content -->
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Content</label>
                <textarea
                  rows="8"
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                  placeholder="Write your post here... You can use markdown or plain text. Be clear, kind, and constructive."
                ></textarea>
                <div class="flex justify-between text-xs text-gray-500">
                  <span>Supports Markdown</span>
                  <span>0/1000 characters</span>
                </div>
              </div>

              <!-- Attachments (Optional) -->
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Attachments (Optional)</label>
                <div class="flex items-center gap-3">
                  <button
                    type="button"
                    class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-indigo-700 border border-gray-300 rounded-lg hover:border-indigo-400 transition-colors"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    Upload Image
                  </button>
                  <button
                    type="button"
                    class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-indigo-700 border border-gray-300 rounded-lg hover:border-indigo-400 transition-colors"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Attach File
                  </button>
                </div>
              </div>

              <!-- Actions -->
              <div class="flex flex-wrap gap-3 pt-4">
                <button
                  type="submit"
                  class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-700 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all"
                >
                  <span>Publish Post</span>
                </button>
                <button
                  type="button"
                  class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors"
                >
                  Save Draft
                </button>
                <button
                  type="button"
                  class="px-6 py-3 text-gray-600 font-medium hover:text-gray-800 transition-colors"
                >
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>