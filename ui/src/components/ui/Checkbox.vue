<script setup lang="ts">
const model = defineModel();
</script>

<template>
  <input
    v-model="model"
    type="checkbox"
    class="accent-foam focus:outline focus:outline-2 focus:outline-offset-1 focus:outline-foam/80"
  >
</template>
