<template>
  <form @submit.prevent="editPost">
    <div
      class="alert alert-danger"
      role="alert"
      v-if="validationErrors.content.length"
    >
      {{ validationErrors.content[0] }}
    </div>
    <div
      class="alert alert-danger"
      role="alert"
      v-if="validationErrors.selectedCategoryTags.length"
    >
      {{ validationErrors.selectedCategoryTags[0] }}
    </div>
    <div class="mb-2">
      <h3>{{ post.title }}</h3>
    </div>
    <div class="mb-2">
      <textarea
        name="content"
        class="form-control"
        placeholder="Share your thoughts."
        v-model="content"
      ></textarea>
    </div>
    <tags-input
      :category-tags="tags"
      :selected-category-tags="selectedCategoryTags"
    ></tags-input>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      default: {
        title: "",
        content: "",
        slug: "",
        user_id: 0,
      },
    },
    tags: {
      type: Array,
      default: [],
    },
    postTags: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      content: this.post.content,
      selectedCategoryTags: this.postTags,
      validationErrors: {
        content: [],
        selectedCategoryTags: [],
      },
    };
  },
  methods: {
    editPost: function () {
      axios
        .put(`/p/${this.post.slug}/edit`, {
          content: this.content,
          tags: this.selectedCategoryTags,
        })
        .then((response) => {
          window.location.href = `/p/${this.post.slug}`;
        })
        .catch((error) => {
          const { errors } = error.response.data;
          if (errors.content) {
            this.validationErrors.content = errors.content;
          } else {
            this.validationErrors.content = [];
          }
          if (errors.tags) {
            this.validationErrors.selectedCategoryTags = errors.tags;
          } else {
            this.validationErrors.selectedCategoryTags = [];
          }

          this.$nextTick(function () {
            window.scrollTo(0, 0);
          });
        });
    },
  },
  mounted() {},
};
</script>