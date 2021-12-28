<template>
  <div class="container pt-4 pb-5">
    <div class="row">
      <div class="col-lg-4 mb-4 mb-lg-auto">
        <tag-add @reload-table="reloadTable" ref="form" />
      </div>
      <div class="col-lg-8">
        <tags-list @edit-tag="editTag" @delete-tag="deleteTag" ref="list" />
      </div>
    </div>
  </div>
</template>

<script>
import TagAdd from "../components/tags/TagForm.vue";
import TagsList from "../components/tags/TagsList.vue";

export default {
  name: "Tags",
  components: {
    TagAdd,
    TagsList,
  },
  methods: {
    reloadTable() {
      this.$refs.list.listTags();
    },
    editTag(tag) {
      this.$refs.form.editTag(tag);
    },
    deleteTag(id) {
      this.$refs.form.deleteTag(id);
    },
  },
};
</script>
