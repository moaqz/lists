<script setup lang="ts">
import { useRouter } from "vue-router";
import AuthLayout from "~/components/layouts/AuthLayout.vue";
import { Button } from "~/components/ui";
import { useAuthStore } from "~/stores/auth";

const router = useRouter();
const auth = useAuthStore();

async function logout() {
  auth.logout();
  router.push({
    name: "auth.login",
  });
}
</script>

<template>
  <AuthLayout>
    <h1>App</h1>
    <Button @click.once="logout">
      Logout
    </Button>
  </AuthLayout>
</template>
