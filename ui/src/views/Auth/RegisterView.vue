<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";
import { ofetch } from "~/lib/ofetch";
import GuestLayout from "~/components/layouts/GuestLayout.vue";
import { Button, Input, Label, Link } from "~/components/ui";
import { AuthHeading } from "~/components/auth";

const router = useRouter();
const form = ref({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

async function onSubmit() {
  try {
    await ofetch("/register", {
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
    <AuthHeading title="Register" />

    <form class="space-y-3 my-3 max-w-sm" @submit.prevent="onSubmit">
      <div class="flex flex-col gap-y-1">
        <Label for="name">Name</Label>
        <Input id="name" v-model="form.name" type="text" />
      </div>

      <div class="flex flex-col gap-y-1">
        <Label for="email">Email</Label>
        <Input id="email" v-model="form.email" type="email" />
      </div>

      <div class="flex flex-col gap-y-1">
        <Label for="password">Password</Label>
        <Input id="password" v-model="form.password" type="password" />
      </div>

      <div class="flex flex-col gap-y-1">
        <Label for="password_confirmation">Confirm Password</Label>
        <Input id="password_confirmation" v-model="form.password_confirmation" type="password" />
      </div>

      <Button type="submit">
        Register
      </Button>
    </form>

    <nav>
      <Link to="/login">
        Already registered? Login
      </Link>
    </nav>
  </GuestLayout>
</template>
