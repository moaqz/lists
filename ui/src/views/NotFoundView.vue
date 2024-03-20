<script setup lang="ts">
import GuestLayout from "~/components/layouts/GuestLayout.vue";
import { Link } from "~/components/ui";
</script>

<template>
  <GuestLayout>
    <div class="bg-surface p-6 rounded-lg flex flex-col gap-y-4 shadow-sm">
      <h1 class="text-4xl font-bold text-rose">
        Page not found
      </h1>

      <p class="text-text/70 text-pretty">
        We're sorry, we couldn't find the page you requested.
      </p>

      <Link to="/">
        ← Back to home
      </Link>
    </div>
  </GuestLayout>
</template>
