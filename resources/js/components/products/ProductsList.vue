<template>
  <v-app>
    <v-card>
      <v-card-title>
        Produtos
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Pesquisar"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="products"
        :search="search"
      >
        <template v-slot:[`item.tags`]="{ item }">
          <div v-for="tag in item.tags" :key="tag.id" class="d-inline">
            <span class="badge">{{ tag.name }}</span>
          </div>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
          <a href="" @click.prevent="editProduct(item)"><i class="fas fa-edit mr-2"></i></a>
          <a href="" @click.prevent="deleteProduct(item)"><i class="fas fa-trash"></i></a>
        </template>
      </v-data-table>
    </v-card>
  </v-app>
</template>

<script>
import Products from '../../apis/Products';
export default {
  name: "ProductsList",
  data() {
    return {
      search: "",
      headers: [
        { text: "Nome", align: "start", value: "name" },
        { text: "Tags", value: "tags" },
        { text: "Data de Criação", value: "created_at" },
        { text: "Ações", value: "actions" },
      ],
      products: [],
    };
  },
  methods: {
    listProducts() {
      Products.listProducts().then((response) => {
        this.products = response.data.data;
      });
    },
    editProduct(item) {
      this.$emit('edit-product', item);
    },
    deleteProduct(item) {
      this.$emit('delete-product', item.id);
    }
  },
  mounted() {
    this.listProducts();
  }
};
</script>
