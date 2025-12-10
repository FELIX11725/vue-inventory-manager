<script setup>
import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import Header from '../components/Header.vue'


defineProps({
    users: []
})


const search = ref('')
let debounceTimeout = null

watch(search, (newSearch) => {
  clearTimeout(debounceTimeout)
  debounceTimeout = setTimeout(() => {
    router.get(
        '/view-users',
        { search: newSearch },
        {
            preserveState: true,
            replace: true,
        }
    )
  }, 300)
})



</script>

<template>
  <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 ">
    <Header />
    <div class="max-w-6xl mx-auto pt-10">
      <!-- Flash Message – Toast -->
      <Transition name="toast">
        <div
          v-if="$page.props.flash?.message"
          class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 max-w-2xl w-full px-4"
        >
          <div class="flex items-center justify-between gap-3 p-4 rounded-xl bg-emerald-500 text-white shadow-lg">
            <div class="flex items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span class="font-medium">{{ $page.props.flash.message }}</span>
            </div>
            <button
              @click="$page.props.flash.message = null"
              class="text-emerald-100 hover:text-white"
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
      <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">User Directory</h1>
        <p class="mt-2 text-gray-500">Search and manage registered users.</p>
      </div>

      <!-- 🔍 Search Input (ADDED ABOVE USER LIST) -->
      <div class="mb-8 max-w-2xl mx-auto">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
          <input
            id="search-input"
            v-model="search"
            type="text"
            placeholder="Search by name or email…"
            class="w-full pl-11 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm"
          />
        </div>
        <div v-if="search" class="mt-2 text-sm text-indigo-600">
          Showing results for <span class="font-medium">"{{ search }}"</span>
        </div>
      </div>

      <!-- Users Table Card -->
      <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-semibold text-gray-800">
            {{ users.length }} {{ users.length === 1 ? 'User' : 'Users' }}
          </h2>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ user.id }}</td>
                <td class="px-5 py-4">
                  <div class="h-10 w-10 rounded-full overflow-hidden bg-gray-200">
                    <img
                      :src="user.avatar_path 
                        ? `/storage/${user.avatar_path}` 
                        : `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=4f46e5&color=fff`"
                      :alt="user.name"
                      class="h-full w-full object-cover"
                      @error="$event.target.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name[0])}&background=94a3b8&color=fff`"
                    />
                  </div>
                </td>
                <td class="px-5 py-4 text-sm font-medium text-gray-900">{{ user.name }}</td>
                <td class="px-5 py-4 text-sm text-gray-500">{{ user.email }}</td>
                <td class="px-5 py-4 text-sm text-gray-500">
                  {{ new Date(user.created_at).toLocaleDateString() }}
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Empty State -->
          <div v-if="users.length === 0" class="text-center py-12 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <p class="mt-4">
              {{ search ? `No users match "${search}"` : 'No users found' }}
            </p>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.toast-enter-active, .toast-leave-active {
  transition: all 0.1s ease;
}
.toast-enter-from, .toast-leave-to {
  opacity: 0; transform: translate(-50%, -20px) scale(0.9);
}
</style>