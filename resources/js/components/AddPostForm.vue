<template>
  <form @submit.prevent="addPost">
    <div
      class="alert alert-danger"
      role="alert"
      v-if="validationErrors.title.length"
    >
      {{ validationErrors.title[0] }}
    </div>
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
      <label for="title">Title</label>
      <input
        id="title"
        type="text"
        class="form-control"
        name="title"
        v-model="title"
      />
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
    <button type="submit" class="btn btn-primary">Post</button>
  </form>
</template>

<script>
export default {
  props: {
    tags: {
      type: Array,
      default: [],
    },
    userId: Number,
    username: String,
  },
  data() {
    return {
      title: "",
      content: "",
      selectedCategoryTags: [],
      validationErrors: {
        title: [],
        content: [],
        selectedCategoryTags: [],
      },
    };
  },
  methods: {
    slugifyTitle: function (title) {
      return title
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
    },
    addPost: function () {

      axios
        .post(`/u/${this.username}/p/new`, {
          title: this.title,
          content: this.content,
          tags: this.selectedCategoryTags,
          slug: this.slugifyTitle(this.title),
          user_id: this.userId,
        })
        .then((response) => {
          const { slug } = response.data;
          window.location.href = `/p/${slug}`;
        })
        .catch((error) => {
          console.log(error.response)
          const { errors } = error.response.data;
          if (errors.title) {
            this.validationErrors.title = errors.title;
          } else {
            this.validationErrors.title = [];
          }
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

          this.$nextTick(function() {
            window.scrollTo(0,0);
          })
        });
    },
  },
};
</script>