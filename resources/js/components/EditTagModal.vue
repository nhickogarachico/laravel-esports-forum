<template>
  <div class="add-tag-modal" ref="addTagModal">
    <div class="add-tag-modal-content mx-auto">
      <div class="card">
        <div class="card-header d-flex justify-content-end">
          <button class="btn" @click="$emit('close-modal')">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="card-body">
          <div
            class="alert alert-danger"
            role="alert"
            v-if="validationErrors.tag.length"
          >
            {{ validationErrors.tag[0] }}
          </div>
          <div
            class="alert alert-danger"
            role="alert"
            v-if="validationErrors.queryTag.length"
          >
            {{ validationErrors.queryTag[0] }}
          </div>
          <form @submit.prevent="editTag">
            <div class="mb-3">
              <label for="tag">Tag</label>
              <input
                type="text"
                class="form-control"
                name="tag"
                v-model="tagName"
                @input="queryTag = slugify(tagName)"
              />
            </div>
            <div class="mb-3">
              <label for="query-tag">Query Tag</label>
              <input
                type="text"
                class="form-control"
                name="query-tag"
                v-model="queryTag"
              />
            </div>
            <button class="btn btn-secondary" @click="$emit('close-modal')">
              Cancel
            </button>
            <button class="btn btn-primary">Edit Tag</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props: {
        tag: Object
    },
  data() {
    return {
      tagName: this.tag.tag,
      queryTag: this.tag.query_tag,
      validationErrors: {
        tag: [],
        queryTag: [],
      },
    };
  },
  methods: {
    closeModalOnOutsideClick: function (modal) {
      window.addEventListener("click", (event) => {
        if (event.target === modal) {
          this.$emit("close-modal");
        }
      });
    },
    slugify: function (tag) {
      return tag
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "-")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
    },
    editTag: function () {
      axios
        .put(`/admin/tags/${this.tag.id}/edit`, {
          tag: this.tagName,
          query_tag: this.queryTag,
        })
        .then((response) => {
          window.location.reload();
        })
        .catch((error) => {
          console.log(error.response.data)
          const {errors} = error.response.data;
           if (errors.tag) {
            this.validationErrors.tag = errors.tag;
          } else {
            this.validationErrors.tag = [];
          }
          if (errors.query_tag) {
            this.validationErrors.queryTag = errors.query_tag;
          } else {
            this.validationErrors.queryTag = [];
          }
        });
    },
  },
  mounted() {
    this.closeModalOnOutsideClick(this.$refs.addTagModal);
  },
};
</script>

<style scoped>
.add-tag-modal {
  position: fixed;
  z-index: 999;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
  top: 0;
  left: 0;
}

.add-tag-modal-content {
  margin-top: 25px;
  width: 25%;
}
</style>