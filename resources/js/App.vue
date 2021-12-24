<template>
  <div
    class="main-content"
    :class="[!this.$route.meta.requiresAuth ? 'main-content-login' : '']"
  >
    <div v-if="this.$route.meta.requiresAuth">
        <navbar />
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
import Navbar from "./components/layouts/Navbar.vue";
export default {
  name: "App",
  components: { Navbar },
};
</script>
