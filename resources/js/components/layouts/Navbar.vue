<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light d-none d-md-flex pb-0 pt-1">
      <div class="container d-block">
        <div class="row mb-3">
          <div class="col-12 col-md-3 col-lg-4 mt-3 pt-1">
            <router-link :to="{ name: 'Products' }">
              <img :src="logo" >
            </router-link>
          </div>
          <div class="col-md-9 col-lg-4 mt-2 d-none d-md-block">
            <div class="d-flex justify-content-end justify-content-lg-center h-100 ms-3">
              <router-link :to="{ name: 'Products' }" class="nav-link">
                  PRODUTOS
              </router-link>
              <router-link :to="{ name: 'Tags' }" class="nav-link">
                  TAGS
              </router-link>
              <router-link :to="{ name: 'Reports' }" class="nav-link">
                  RELATÓRIOS
              </router-link>
              <span class="nav-link">||</span>
              <a href="" @click.prevent="handleSubmit" class="nav-link">
                SAIR
              </a>
            </div>
          </div>
          <div class="col-lg-4 d-none d-lg-flex justify-content-end">
            <div class="nav-profile nav-profile-letter">
              <span>{{ firstLetterName }}</span>
            </div>
            <div class="nav-profile nav-profile-name mx-2">
              <span>{{ firstWordName }}</span>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-mobile d-flex d-md-none pb-0">
      <div class="container-fluid g-0">
        <div class="row g-0">
          <div class="col-12 text-center mt-md-2 mb-md-3 p-2 p-md-auto">
            <img :src="logo" >
          </div>
          <div class="col-12">
            <div class="navbar-menu-mobile d-flex justify-content-center">
              <router-link :to="{ name: 'Products' }" class="nav-link">
                  PRODUTOS
              </router-link>
              <router-link :to="{ name: 'Tags' }" class="nav-link">
                  TAGS
              </router-link>
              <router-link :to="{ name: 'Reports' }" class="nav-link">
                  RELATÓRIOS
              </router-link>
              <a href="" @click.prevent="handleSubmit" class="nav-link">
                SAIR
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import Auth from '../../apis/Auth';
import { getUserCurrent } from '../../services/api';

export default {
  name: "Navbar",
  data() {
    return {
      logo: '/images/logo-promobit-white.svg',
      user: getUserCurrent()
    };
  },
  computed: {
    firstLetterName() {
      return this.user.name.charAt(0);
    },
    firstWordName() {
      return this.user.name.split(" ")[0];
    },
  },
  methods: {
    handleSubmit() {
      Auth.logout(this.$router);
    },
  },
};
</script>
