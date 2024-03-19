<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";
import { AuthHeading } from "~/components/auth";
import GuestLayout from "~/components/layouts/GuestLayout.vue";
import { Button, Checkbox, Input, Label, Link } from "~/components/ui";
import { ofetch } from "~/lib/ofetch";

const router = useRouter();
const form = ref({
  email: "",
  password: "",
  remember: false,
});

async function onSubmit() {
  try {
    await ofetch("/login", {
      method: "POST",
      body: form.value,
    });

    router.push({ name: "app" });
  }
  catch (error) {

  }
}
</script>

<template>
  <GuestLayout>
    <AuthHeading title="Login" />

    <form class="space-y-3 my-3 max-w-sm" @submit.prevent="onSubmit">
      <div class="flex flex-col gap-y-1">
        <Label for="email">Email</Label>
        <Input id="email" v-model="form.email" type="email" />
      </div>

      <div class="flex flex-col gap-y-1">
        <Label for="password">Password</Label>
        <Input id="password" v-model="form.password" type="password" />
      </div>

      <div class="flex items-center gap-x-2">
        <Checkbox id="remember-me" v-model="form.remember" />
        <Label for="remember-me">Remember me</Label>
      </div>

      <Button type="submit">
        Login
      </Button>
    </form>

    <nav class="flex items-center gap-x-1">
      <Link to="/register">
        Register
      </Link>
      <span class="text-muted">•</span>
      <Link to="/forgot-password">
        Forgot Password
      </Link>
    </nav>
  </GuestLayout>
</template>
