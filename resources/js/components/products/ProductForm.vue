<template>
  <v-app>
    <v-card class="">
      <div v-if="!this.mode.edit">
        <v-card-title class="px-0 mt-2">Adicionar Produto</v-card-title>
      </div>
      <div v-else>
        <v-card-title class="px-0 mt-2 justify-content-between">
          <div>Editar Produto</div>
          <div>
            <button type="button" class="btn btn-light" @click.prevent="changeMode">
              <small>Adicionar Produto</small>
            </button>
          </div>
        </v-card-title>
      </div>
      <form>
        <div class="form-group mt-2 mb-3">
          <label class="mb-2" for="name">Nome</label>
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
        <div class="form-group mt-2 mb-3">
          <label class="mb-2" for="tag">Tags</label>
          <v-autocomplete
            v-model="form.tags"
            :items="tags"
            item-text="name"
            item-value="id"
            label="Selecione as Tags"
            multiple
            deletable-chips
            dense
            chips
            small-chips
            solo
          ></v-autocomplete>
        </div>
        <div class="text-end mt-5">
          <div v-if="!this.mode.edit">
            <button
              type="submit"
              class="btn btn-success btn-xs"
              @click.prevent="addProduct"
            >
              Adicionar Produto
            </button>
          </div>
          <div v-else>
            <button
              type="submit"
              class="btn btn-success btn-xs"
              @click.prevent="updateProduct"
            >
              Atualizar Produto
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
import Products from "../../apis/Products";
import Tags from "../../apis/Tags";

export default {
  name: "ProductForm",
  data() {
    return {
      id: "",
      tags: [],
      form: {
        name: "",
        tags: []
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
    addProduct() {
      Products.addProduct(this.form)
        .then((response) => {
          this.form.name = "";
          this.form.tags = null;
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
    editProduct(product) {
      this.id = product.id;
      this.form.name = product.name;
      this.form.tags = [];
      product.tags.map((value) => {
          this.form.tags.push(value.id);
      })
      this.mode.edit = true;
      document.getElementById("name").focus();
    },
    updateProduct() {
      Products.updateProduct(this.form, this.id)
        .then((response) => {
          this.form.name = "";
          this.form.tags = null;
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
    deleteProduct(id) {
      Products.deleteProduct(id).then((response) => {
          this.$emit("reload-table");
          this.text = response.data.message;
          this.snackbar = true;
        })
    },
    listTags() {
      Tags.listTags().then((response) => {
        this.tags = response.data.data;
      });
    },
    changeMode() {
      this.mode.edit = false;
      this.form.name = "";
      this.form.tags = null;
      this.error.name = "";
    },
  },
  mounted() {
    this.listTags();
  }
};
</script>
