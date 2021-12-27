<template>
  <v-app>
    <v-card class="">
      <div v-if="!this.mode.edit">
        <v-card-title class="px-0 mt-2">Adicionar Tag</v-card-title>
      </div>
      <div v-else>
        <v-card-title class="px-0 mt-2 justify-content-between">
          <div>Editar Tag</div>
          <div>
            <button type="button" class="btn btn-light" @click.prevent="changeMode">
              <small>Adicionar Tag</small>
            </button>
          </div>
        </v-card-title>
      </div>
      <form>
        <div class="form-group mt-2 mb-3">
          <label class="mb-2" for="email">Nome</label>
          <input
            id="name"
            type="text"
            placeholder=""
            class="form-control px-3 d-block"
            required
            autocomplete="name"
            autofocus
            v-model="form.name"
          />
          <small v-if="this.error.name" class="text-danger ms-1">
            {{ this.error.name }}
          </small>
        </div>
        <div class="text-end mt-4">
          <div v-if="!this.mode.edit">
            <button
              type="submit"
              class="btn btn-success btn-xs"
              @click.prevent="addTag"
            >
              Adicionar Tag
            </button>
          </div>
          <div v-else>
            <button
              type="submit"
              class="btn btn-success btn-xs"
              @click.prevent="updateTag"
            >
              Atualizar Tag
            </button>
          </div>
        </div>
      </form>
    </v-card>
    <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
    >
      {{ text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="blue"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Fechar
        </v-btn>
      </template>
    </v-snackbar>
  </v-app>
</template>

<script>
import Tags from "../../apis/Tags";

export default {
  name: "TagForm",
  data() {
    return {
      id: "",
      form: {
        name: "",
      },
      error: {
        name: "",
      },
      mode: {
        edit: false,
      },
      snackbar: false,
      text: '',
      timeout: 3000,
    };
  },
  methods: {
    addTag() {
      Tags.addTag(this.form)
        .then((response) => {
          this.form.name = "";
          this.error.name = "";
          this.$emit("reload-table");
          this.text = response.data.message;
          this.snackbar = true;
        })
        .catch((error) => {
          if (!error.response.data.success) {
            this.error.name = error.response.data.data.name
              ? error.response.data.data.name[0]
              : "";
          }
        });
    },
    editTag(tag) {
      this.id = tag.id;
      this.form.name = tag.name;
      this.mode.edit = true;
      document.getElementById("name").focus();
    },
    updateTag() {
      Tags.updateTag(this.form, this.id)
        .then((response) => {
          this.form.name = "";
          this.error.name = "";
          this.mode.edit = false;
          this.$emit("reload-table");
          this.text = response.data.message;
          this.snackbar = true;
        })
        .catch((error) => {
          if (!error.response.data.success) {
            this.error.name = error.response.data.data.name
              ? error.response.data.data.name[0]
              : "";
          }
        });
    },
    deleteTag(id) {
      Tags.deleteTag(id).then((response) => {
          this.$emit("reload-table");
          this.text = response.data.message;
          this.snackbar = true;
        })
    },
    changeMode() {
      this.mode.edit = false;
      this.form.name = "";
      this.error.name = "";
    },
  },
};
</script>
