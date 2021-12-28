<template>
  <div class="container pb-5">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-7 col-xl-5 px-md-5">
        <card-login>
          <div class="text-center mt-3 mb-4">
            <img :src="logo" >
          </div>
          <div class="text-center mt-3 mb-4">
            <span>Entre com o seu E-mail e Senha</span>
          </div>
          <form>
            <div class="form-group mt-2 mb-3">
              <label class="mb-2" for="email">E-mail</label>
              <input
                id="email"
                type="email"
                placeholder="Digite o seu o E-mail"
                class="form-control px-3 d-block"
                required
                autocomplete="email"
                autofocus
                v-model="form.email"
              />
              <small v-if="this.error.email" class="text-danger ms-1">
                {{ this.error.email }}
              </small>
            </div>
            <div class="form-group mb-4">
              <label class="mb-2" for="password">Senha</label>
              <input
                id="password"
                type="password"
                placeholder="Digite a sua Senha"
                class="form-control px-3"
                required
                autocomplete="current-password"
                v-model="form.password"
              />
              <small v-if="this.error.password" class="text-danger ms-1">
                {{ this.error.password }}
              </small>
            </div>
            <div class="form-group d-grid gap-2">
              <button
                type="submit"
                class="btn btn-primary btn-sm"
                @click.prevent="handleSubmit"
              >
                Entrar
              </button>
            </div>
            <alert-info>
              <div class="mb-2">
                <strong class="fw-semi-bold"
                  >Utilize o e-mail e a senha a seguir para fins de
                  demonstração:
                </strong>
              </div>
              <div>
                <div>E-mail: {{ usersDefault.user.login }}</div>
                <div>Senha: {{ usersDefault.user.pass }}</div>
              </div>
            </alert-info>
          </form>
        </card-login>
      </div>
    </div>
  </div>
</template>

<script>
import Auth from '../apis/Auth';
import CardLogin from "../components/cards/CardLogin.vue";
import AlertInfo from "../components/alerts/AlertInfo.vue";

export default {
  name: "Login",
  components: {
    CardLogin,
    AlertInfo
  },
  data() {
    return {
      logo: '/images/logo-promobit.svg',
      form: {
        email: "",
        password: "",
      },
      error: {
        email: "",
        password: ""
      },
     usersDefault: {
        user: {
          login: "usuario@promobit.com.br",
          pass: "123123123",
        },
      },
    };
  },
  methods: {
    handleSubmit() {
      Auth.login(this.form, this.$router).catch((error) => {
          if(!error.response.data.success) {
            this.error.email = error.response.data.data.email ? error.response.data.data.email[0] : '';
            this.error.password = error.response.data.data.password ? error.response.data.data.password[0] : '';
          }
      });
    },
  },
};
</script>
