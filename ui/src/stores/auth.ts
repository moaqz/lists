import { defineStore } from "pinia";
import { ofetch } from "~/lib/ofetch";

interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: boolean | null;
  updated_at: string | Date;
  created_at: string | Date;
};

interface AuthState {
  user: User | null;
  authenticated: boolean;
}

export const useAuthStore = defineStore("auth", {
  state: (): AuthState => ({
    user: null,
    authenticated: false,
  }),
  getters: {
    isLoggedIn(state) {
      return state.authenticated;
    },
  },
  actions: {
    async checkStatus() {
      try {
        const data = await ofetch<User>("/api/user");
        this.user = data;
        this.authenticated = true;
      }
      catch {
        /**
         * The response failed or the user is not authenticated.
         */
        this.user = null;
        this.authenticated = false;
      }
    },
    async logout() {
      try {
        await ofetch("/logout", { method: "POST" });
        this.user = null;
        this.authenticated = false;
      }
      catch (err) { }
    },
  },
});
