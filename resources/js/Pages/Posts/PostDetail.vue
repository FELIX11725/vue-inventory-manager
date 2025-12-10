<script setup>
import Header from '../components/Header.vue'
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <Header />

    <div class="py-8 px-4">
      <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-6">
          <a href="/posts" class="hover:text-indigo-600">Forum</a>
          <span class="mx-2">/</span>
          <a href="/category/general" class="hover:text-indigo-600">General Discussion</a>
          <span class="mx-2">/</span>
          <span class="text-gray-800 font-medium">Introducing Our New Guestbook</span>
        </nav>

        <!-- Post Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
          <!-- Post Header -->
          <div class="p-6 border-b border-gray-200">
            <div class="flex items-start justify-between">
              <div class="flex items-start gap-4">
                <!-- Avatar -->
                <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                  <span class="text-indigo-800 font-semibold">FA</span>
                </div>
                <div>
                  <h1 class="text-2xl font-bold text-gray-800">Introducing Our New Guestbook Feature</h1>
                  <div class="mt-1 flex flex-wrap items-center gap-3 text-sm text-gray-500">
                    <span class="font-medium text-gray-700">Felix Aliguma</span>
                    <span>•</span>
                    <time datetime="2025-12-05">Dec 5, 2025 at 3:42 PM</time>
                    <span>•</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                      <svg class="-ml-0.5 mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                      </svg>
                      General Discussion
                    </span>
                  </div>
                </div>
              </div>
              <button class="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Post Content -->
          <div class="px-6 py-5">
            <div class="prose prose-gray max-w-none">
              <p class="text-gray-700">
                Hi everyone! 🎉 I'm excited to announce our new guestbook feature — a simple, elegant way for visitors to leave messages and sign their names.
              </p>
              <p class="text-gray-700 mt-4">
                This was built using Laravel, Inertia.js, and Vue — with a focus on performance, accessibility, and delightful UX.
              </p>
              <div class="mt-6 flex gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                  #Laravel
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                  #Vue
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-cyan-100 text-cyan-800">
                  #Inertia
                </span>
              </div>
            </div>
          </div>

          <!-- Post Footer -->
          <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-4">
              <button class="flex items-center gap-1.5 text-gray-600 hover:text-indigo-600 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
                <span>Bookmark</span>
              </button>
              <button class="flex items-center gap-1.5 text-gray-600 hover:text-rose-600 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span>Like (12)</span>
              </button>
            </div>
            <div class="text-sm text-gray-500">
              <span>14 comments</span>
            </div>
          </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-10">
          <h2 class="text-2xl font-bold text-gray-800 mb-6">Comments</h2>

          <!-- Comment Form -->
          <div class="bg-white rounded-2xl shadow-md mb-8">
            <div class="border-b border-gray-200 px-6 py-4">
              <h3 class="font-semibold text-gray-800">Add a Comment</h3>
            </div>
            <div class="p-6">
              <form class="space-y-4">
                <!-- Avatar + Input -->
                <div class="flex gap-3">
                  <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                    <span class="text-indigo-800 font-medium">FA</span>
                  </div>
                  <div class="flex-1">
                    <textarea
                      rows="3"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                      placeholder="Write a thoughtful comment..."
                    ></textarea>
                  </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end">
                  <button
                    type="submit"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow transition-colors"
                  >
                    Post Comment
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Existing Comments -->
          <div class="space-y-6">
            <!-- Comment -->
            <div class="bg-white rounded-xl shadow border border-gray-200 p-5">
              <div class="flex gap-3">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-amber-100 flex items-center justify-center">
                  <span class="text-amber-800 font-medium">JD</span>
                </div>
                <div class="flex-1">
                  <div class="flex items-baseline justify-between">
                    <h4 class="font-medium text-gray-800">Jane Doe</h4>
                    <time class="text-xs text-gray-500 ml-2">Dec 5, 4:15 PM</time>
                  </div>
                  <p class="mt-2 text-gray-700">This looks amazing, Felix! The UI is so clean and intuitive. Can’t wait to try it out. 🚀</p>
                  <div class="mt-3 flex gap-3">
                    <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Like</button>
                    <button class="text-sm text-gray-600 hover:text-gray-800 font-medium">Reply</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Comment -->
            <div class="bg-white rounded-xl shadow border border-gray-200 p-5">
              <div class="flex gap-3">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-rose-100 flex items-center justify-center">
                  <span class="text-rose-800 font-medium">AJ</span>
                </div>
                <div class="flex-1">
                  <div class="flex items-baseline justify-between">
                    <h4 class="font-medium text-gray-800">Alex Johnson</h4>
                    <time class="text-xs text-gray-500 ml-2">Dec 5, 5:30 PM</time>
                  </div>
                  <p class="mt-2 text-gray-700">Great work! Have you considered adding email notifications for replies?</p>
                  <div class="mt-3 flex gap-3">
                    <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Like</button>
                    <button class="text-sm text-gray-600 hover:text-gray-800 font-medium">Reply</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.prose :where(p):not(:where([class~="not-prose"] *)) {
  margin-top: 0;
  margin-bottom: 0;
}
</style>