<template>
  <v-app>
    <v-card>
      <v-card-title>
        Relatório de Relevância de Produtos
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
        :items="items"
        :search="search"
      >
      </v-data-table>
    </v-card>
  </v-app>
</template>

<script>
import Reports from '../../apis/Reports';
export default {
  name: "ReportProductsRelevant",
  data() {
    return {
      search: "",
      headers: [
        { text: "Nome da Tag", align: "start", value: "name" },
        { text: "Quantidade de Produtos", value: "products_count" },
      ],
      items: [],
    };
  },
  methods: {
    productsRelevant() {
      Reports.productsRelevant().then((response) => {
        console.log(response);
        this.items = response.data.data;
      });
    },
  },
  mounted() {
    this.productsRelevant();
  }
};
</script>
