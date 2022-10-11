<template>
  <div
    class="sticky top-0 z-10 flex h-16 flex-shrink-0 justify-between bg-skin-base py-3 pr-9 pl-3 shadow"
  >
    <div class="flex items-center">
      <Button
        class="p-button-text p-button-sm flex items-center focus:shadow-none"
        @click="$emit('toggleSidebar')"
      >
        <i class="ri-menu-line"></i>
      </Button>

      <h1 class="flex items-center">{{ title }}</h1>
    </div>

    <div class="flex items-center">
      <a href="#" class="" @click="toggleTheme">
        <i :class="iconThemeClass"></i>
      </a>

      <Link class="ml-3" :href="route('adminAuth.logout')">
        <i class="ri-logout-circle-r-line"></i>
      </Link>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  title: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['toggleSidebar'])

const iconThemeClass = ref('ri-sun-line')

const toggleTheme = () => {
  if (document.documentElement.classList.contains('theme-cupcake')) {
    document.documentElement.classList.remove('theme-cupcake')
    iconThemeClass.value = 'ri-moon-line'
  } else {
    document.documentElement.classList.add('theme-cupcake')
    iconThemeClass.value = 'ri-sun-line'
  }
}
</script>
