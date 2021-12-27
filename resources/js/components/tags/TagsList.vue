<template>
  <v-app>
    <v-card>
      <v-card-title>
        Tags
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
        :items="tags"
        :search="search"
      >
        <template v-slot:[`item.actions`]="{ item }">
          <a href="" @click.prevent="editTag(item)"><i class="fas fa-edit mr-2"></i></a>
          <a href="" @click.prevent="deleteTag(item)"><i class="fas fa-trash"></i></a>
        </template>
      </v-data-table>
    </v-card>
  </v-app>
</template>

<script>
import Tags from '../../apis/Tags';
export default {
  name: "TagsList",
  data() {
    return {
      search: "",
      headers: [
        { text: "Nome", align: "start", value: "name" },
        { text: "Data de Criação", value: "created_at" },
        { text: "Ações", value: "actions" },
      ],
      tags: [],
    };
  },
  methods: {
    listTags() {
      Tags.listTags().then((response) => {
        this.tags = response.data.data;
      });
    },
    editTag(item) {
      this.$emit('edit-tag', item);
    },
    deleteTag(item) {
      this.$emit('delete-tag', item.id);
    }
  },
  mounted() {
    this.listTags();
  }
};
</script>
