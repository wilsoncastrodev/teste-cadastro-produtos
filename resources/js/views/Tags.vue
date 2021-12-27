<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-4">
        <tag-add @reload-table="reloadTable" ref="form" />
      </div>
      <div class="col-8">
        <tags-list @edit-tag="editTag" @delete-tag="deleteTag" ref="list"/>
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
      }
  },
};
</script>
