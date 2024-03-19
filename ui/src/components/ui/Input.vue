<script setup lang="ts">
const model = defineModel();
</script>

<template>
  <input
    v-model="model"
    class="bg-surface border border-overlay text-sm rounded-md px-3 h-10 placeholder-muted focus:outline focus:outline-2 focus:outline-offset-1 focus:outline-overlay"
  >
</template>
