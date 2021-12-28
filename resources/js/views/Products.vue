<template>
  <div class="container pt-4 pb-5">
    <div class="row">
      <div class="col-lg-4 mb-4 mb-lg-auto">
        <product-add @reload-table="reloadTable" ref="form" />
      </div>
      <div class="col-lg-8">
        <products-list
          @edit-product="editProduct"
          @delete-product="deleteProduct"
          ref="list"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ProductAdd from "../components/products/ProductForm.vue";
import ProductsList from "../components/products/ProductsList.vue";

export default {
  name: "Products",
  components: {
    ProductAdd,
    ProductsList,
  },
  methods: {
    reloadTable() {
      this.$refs.list.listProducts();
    },
    editProduct(product) {
      this.$refs.form.editProduct(product);
    },
    deleteProduct(id) {
      this.$refs.form.deleteProduct(id);
    },
  },
};
</script>
