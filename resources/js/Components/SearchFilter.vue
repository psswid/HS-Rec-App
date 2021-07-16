<template>
  <div class="flex items-center">
    <div class="flex w-full bg-white shadow rounded">
      <dropdown :auto-close="false" class="px-4 md:px-6 rounded-l border-r hover:bg-gray-100 focus:border-white focus:ring focus:z-10" placement="bottom-start">
        <div :v-slot="dropdown" class="mt-2 px-4 py-6 w-screen shadow-xl bg-white rounded" :style="{ maxWidth: `${maxWidth}px` }">
          <slot />
        </div>
      </dropdown>
    </div>
    <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500" type="button" @click="$emit('reset')">Reset</button>
  </div>
</template>

<script>
import Dropdown from '@/Components/FilterDropdown'

export default {
  components: {
    Dropdown,
  },
  props: {
    maxWidth: {
      type: Number,
      default: 400,
    },
  },
}
</script>
