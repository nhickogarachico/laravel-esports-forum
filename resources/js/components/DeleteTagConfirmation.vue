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
          <form @submit.prevent="deleteTag">
            <p>
              You are deleting a tag. Please type your password below to
              confirm.
            </p>
            <div class="alert alert-danger" role="alert" v-if="validationError">
              {{ validationError }}
            </div>
            <input type="password" class="form-control" v-model="password" />
            <button
              type="submit"
              class="btn btn-secondary"
              @click="$emit('close-modal')"
            >
              Cancel
            </button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    tag: Object,
  },
  data() {
    return {
      password: "",
      validationError: "",
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
    deleteTag: function () {
      axios
        .delete(`/admin/tags/${this.tag.id}/delete`, {
          data: {
            password: this.password,
          },
        })
        .then((response) => {
          window.location.reload();
        })
        .catch((error) => {
          const { message } = error.response.data;
          this.validationError = message;
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