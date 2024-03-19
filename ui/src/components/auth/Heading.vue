<script lang="ts" setup>
defineProps<{
  title: string;
}>();
</script>

<template>
  <h1 class="text-4xl font-bold">
    {{ title }}
  </h1>

  <hr class="border-none my-6 h-2 bg-foam rounded-md">
</template>
