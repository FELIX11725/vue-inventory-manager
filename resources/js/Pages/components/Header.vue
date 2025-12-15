<script setup>



</script>

<template>
  <header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Left: App Branding -->
        <div class="flex items-center">
          <div class="flex-shrink-0 flex items-center">
            <div class="h-8 w-8 rounded-lg bg-indigo-600 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
            </div>
            <span class="ml-3 text-xl font-bold text-gray-900">Inventory Manager</span>
          </div>
        </div>

        <!-- Center: Navigation Links (Desktop) -->
        <nav class="hidden md:flex space-x-1">
            <a
            href="/"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
          >
            Products
          </a>
          <a
            href="/create-product"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
          >
            Create Product
          </a>
          <a
            href="/create-post"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
          >
            Create Posts
          </a>
          <a
            href="/posts"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
          >
            View Posts
          </a>
          <a
            href="/view-users"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
          >
            View User Profiles
          </a>
          <a
            href="/settings"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
          >
            Update Profile
          </a>
          <a
            href="/signatures"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
          >
            Signatures
          </a>


        </nav>

        <!-- Right: Profile Area -->
        <div class="flex items-center">
          <!-- Profile Picture -->
          <div class="ml-4 relative flex-shrink-0">
            <img
              :src="$page.props.user.avatar_path?'/storage/'+$page.props.user.avatar_path:'/default/default.jpeg'"
              :alt="$page.props.user.name"
              class="h-10 w-10 rounded-full border-2 border-white shadow-sm object-cover"
            />
          </div>
        </div>
      </div>

      <!-- Mobile Navigation Toggle (Hidden by default, for future use) -->
      <div class="md:hidden pt-4 pb-3 border-t border-gray-200">
        <div class="space-y-1">
          <!-- Links would go here for mobile menu -->
        </div>
      </div>
    </div>
  </header>
</template>

<style scoped>

nav a:hover {
  transform: translateY(-1px);
}
</style>
