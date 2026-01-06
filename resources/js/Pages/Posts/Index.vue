<script setup >
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Header from '../components/Header.vue'
import Modal from '../components/Modal.vue'

defineProps({
    posts: []
})

const showFormModal = ref(false)
const selectedPostId = ref(null) // 👈 NEW: track which post we're commenting on
const commentBody = ref('') // 👈 NEW: bind input to this

const openCommentModal = (postId) => {
  selectedPostId.value = postId
  commentBody.value = ''
  showFormModal.value = true
}

const submitcomment = () => {
  if (!commentBody.value.trim()) return

  router.post(`/posts/${selectedPostId.value}/comments`, {
    body: commentBody.value
  }, {
    preserveScroll: true,
    onSuccess: () => {
      // Close modal and reset
      showFormModal.value = false
      commentBody.value = ''
      selectedPostId.value = null
    }
  })
}

const confirmDelete = (commentId) => {
    router.delete(`/comments/${commentId}`)
}
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <Header />
    <div class="max-w-4xl mx-auto pt-10">
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
      <!-- Header -->
      <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Mini-Forum</h1>
        <p class="mt-2 text-gray-600">A simple forum with posts and comments</p>

        <div class="flex justify-center gap-6">
          <a
            href="/create-post-category"
            class="mt-6 inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors"
          >
            Post Categories
          </a>

        


          
    <Modal 
      v-model="showFormModal" 
      title="User Information" 
      size="lg"
      :close-on-escape="false"
    >
    <template #header>
      <h1 class="text-xl-bold">Add a Comment</h1>
    </template>
      <template #body>
        <form @submit.prevent="submitcomment" class="form">
          <div class="form-group">
            <label for="name">Comment</label>
            <input
            v-model="commentBody"
            type="text"
            placeholder="enter comment.."
             class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        
            
            />
           
          </div>
        </form>
      </template>
      
      <template #footer="{ close }">
        <button @click="close" class="bg-white-600 text-black font-medium rounded-lg px-2 py-1 hover:bg-indigo-100 transition-colors">Cancel</button>
        <button @click="submitcomment" class="bg-indigo-600 text-white font-medium rounded-lg px-2 py-1 hover:bg-indigo-700 transition-colors">Save</button>
      </template>
    </Modal>
           
        </div>
      </div>

      <!-- Flash Message -->
      <div v-if="$page.props.flash?.message" class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ $page.props.flash.message }}
      </div>

      <!-- Posts List -->
      <div v-if="posts.length === 0" class="text-center py-12 text-gray-500">
        <p>No posts yet.</p>
        
      </div>

      <div v-for="post in posts" :key="post.id" class="mb-12 bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Post Header -->
        <div class="p-6 border-b border-gray-200">
          <h2 class="text-2xl font-bold text-gray-800">{{ post.title }}</h2>
          <p class="mt-2 text-gray-600">{{ post.content }}</p>
          <div class="mt-3 text-sm text-gray-500">
            Posted on {{ new Date(post.created_at).toLocaleDateString('en-US', { weekday: 'short', month: 'long', day: 'numeric',year:'numeric' }) }}
                    <button 
                        @click="openCommentModal(post.id)" 
                        class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center gap-1"
                        >
                         Add Comment
                    </button>
          </div>
        </div>

        <!-- Comments Section -->
        <div class="p-6">
          <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            {{ post.comments.length }} Comment{{ post.comments.length === 1 ? '' : 's' }}
          </h3>

          <!-- Comments List -->
          <div v-if="post.comments.length === 0" class="text-gray-500 italic">
            No comments yet.
          </div>


          <div v-for="comment in post.comments" :key="comment.id" class="mb-4 last:mb-0">
            <div class="flex gap-3">
              <!-- Avatar Placeholder -->
              <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                <span class="text-indigo-800 font-medium text-sm">
                  {{ comment.body.charAt(0).toUpperCase() }}
                </span>
              </div>

              <!-- Comment Content -->
              <div class="flex-1">
                <div class="bg-gray-100 rounded-lg px-4 py-3">
                  <p class="text-gray-800">{{ comment.body }}</p>
                </div>
                <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                  <span>{{ new Date(comment.created_at).toLocaleString('en-US',{month:'long',weekday:'short',day:'numeric',year:'numeric'}) }}</span>
                  
                  <!-- Delete Button -->
                    <div class="flex items-center gap-2 ml-auto">
                    <button
                      type="button"
                      @click="confirmDelete(comment.id)"
                      class="text-rose-600 hover:text-rose-800 font-medium flex items-center gap-1 disabled:opacity-50"
                    >
                      Delete
                    </button>

                    
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