<script setup lang="ts">
defineProps<{
  to: string;
}>();
</script>

<template>
  <RouterLink v-if="!to.startsWith('http')" :to="to" class="text-subtle text-sm font-medium transition-colors hover:text-iris hover:underline">
    <slot />
  </RouterLink>
  <a v-else :href="to" class="text-subtle text-sm font-medium transition-colors hover:text-iris hover:underline">
    <slot />
  </a>
</template>
