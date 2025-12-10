<script setup>
import { ref,  watch } from 'vue'
import { useForm,usePage } from '@inertiajs/vue3'
import Header from '../components/Header.vue' 


  

const page = usePage();



const form = useForm({
  name: page.props.user.name,
  email: page.props.user.email,
  password:page.props.user.password,
  avatar_path: null,
})

const avatarPreview = ref()

watch(
  () => form.avatar_path,
  (newAvatar) => {
    if (newAvatar) {
      const reader = new FileReader()
      reader.onload = (e) => {
        avatarPreview.value = e.target?.result 
      }
      reader.readAsDataURL(newAvatar)
    } else {
      avatarPreview.value = null
    }
  }
)

function adduser() {
  form.post('/add-user')
}
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!--Header Inserted -->
    <Header />

    <div class="py-10 px-4">
      <div class="max-w-5xl mx-auto">
        <!-- Top Accent -->
        <div class="flex justify-center mb-8">
          <div class="h-1 w-24 bg-gradient-to-r from-indigo-500 to-cyan-500 rounded-full"></div>
        </div>

        <!-- Page Header -->
        <div class="text-center mb-8">
          <h1 class="text-3xl md:text-4xl font-bold text-gray-800">My Profile</h1>
          <p class="mt-2 text-gray-500">
            Update your personal details and avatar
          </p>
        </div>

        <!--Two-Column Layout: Avatar (Left) | Form (Right) -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
          <div class="p-6 sm:p-8">
            <form @submit.prevent="adduser" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
              <!--Avatar Section (1/3 width) -->
              <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-xl p-6 text-center">
                  <h3 class="font-semibold text-gray-800 mb-4 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile Picture
                  </h3>

                  <!-- Avatar Preview Area -->
                  <div class="relative group mb-6 flex justify-center">
                    <div
                      class="h-32 w-32 mx-auto rounded-full bg-gray-200 flex items-center justify-center overflow-hidden shadow-md ring-4 ring-white"
                    >
                      <img
                        v-if="avatarPreview"
                        :src="avatarPreview"
                        alt="Avatar Preview"
                        class="h-full w-full object-cover"
                      />
                      <div v-else class="text-gray-500 text-center px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-sm">No photo</span>
                      </div>
                    </div>
                  </div>

                  
                  <input
                    ref="avatarInput"
                    type="file"
                    
                    @input="form.avatar_path = $event.target.files[0]"
                  />
                  <div v-if="form.errors.avatar_path" class="text-rose-600 text-sm mt-1">
                    {{ form.errors.avatar_path }}
                  </div>

                  <!-- Upload Button -->
                  <button
                    type="button"
                    @click="$refs.avatarInput.click()"
                    class="w-full text-sm font-medium text-indigo-600 hover:text-indigo-800 py-2 flex items-center justify-center gap-1 transition-colors"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Change Photo
                  </button>

                  <!-- Avatar Upload Progress (Focused Here) -->
                     <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                     </progress>

                  <p class="mt-3 text-xs text-gray-500">
                    JPG, PNG • Max 2MB
                  </p>
                </div>
              </div>

              <!--RIGHT: Form Fields (2/3 width) -->
              <div class="lg:col-span-2 space-y-6">
                <div class="bg-gray-50 rounded-xl p-6">
                  <h2 class="text-lg font-semibold text-gray-800 mb-5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Personal Information
                  </h2>

                  <!-- Name -->
                  <div class="space-y-2 mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                      Full Name
                    </label>
                    <input
                      id="name"
                      type="text"
                      v-model="form.name"
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                      placeholder="e.g. Felix Aliguma"
                    />
                    <p v-if="form.errors.name" class="text-rose-600 text-sm mt-1">
                      {{ form.errors.name }}
                    </p>
                  </div>

                  <!-- Email -->
                  <div class="space-y-2 mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                      Email Address
                    </label>
                    <input
                      id="email"
                      type="email"
                      v-model="form.email"
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                      placeholder="felix@example.com"
                    />
                    <p v-if="form.errors.email" class="text-rose-600 text-sm mt-1">
                      {{ form.errors.email }}
                    </p>
                  </div>

                  <!-- Password (Optional for update) -->
                  <div class="space-y-2 mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                      Password <span class="text-gray-400">(leave blank to keep current)</span>
                    </label>
                    <input
                      id="password"
                      type="password"
                      v-model="form.password"
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                      placeholder="••••••••"
                    />
                    <p v-if="form.errors.password" class="text-rose-600 text-sm mt-1">
                      {{ form.errors.password }}
                    </p>
                  </div>

                  <!-- Submit Button -->
                  <div class="pt-2">
                    <button
                      type="submit"
                      :disabled="form.processing"
                      class="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-700 hover:to-cyan-700 text-white font-medium rounded-lg shadow transition-all disabled:opacity-80"
                    >
                      <svg v-if="!form.processing" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                      </svg>
                      <svg v-else class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                      {{ form.processing ? 'Saving...' : 'Save Changes' }}
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Footer Note -->
        <div class="mt-6 text-center text-gray-400 text-sm">
          <p>Your changes are saved securely</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Optional: subtle hover lift on cards */
.bg-gray-50:hover {
  box-shadow: 0 4px 12px -2px rgba(0,0,0,0.05);
  transform: translateY(-1px);
  transition: all 0.2s ease;
}
</style>