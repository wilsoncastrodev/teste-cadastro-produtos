<template>
  <div class="container pt-4 pb-5">
    <div class="row justify-content-md-center">
      <div class="col-lg-9">
        <report-products-relevant/>
      </div>
    </div>
  </div>
</template>

<script>
import ReportProductsRelevant from "../components/reports/ReportProductsRelevant.vue";

export default {
  name: "Tags",
  components: {
    ReportProductsRelevant,
  },
};
</script>
