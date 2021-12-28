<template>
  <div class="container pt-4 pb-5">
    <div class="row">
      <div class="col-9">
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
