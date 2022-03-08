<template>
  <div class="confirmation-modal" ref="confirmationModal">
    <div class="confirmation-modal-content mx-auto">
      <div class="card border-0">
        <div class="card-header d-flex justify-content-end">
          <button class="btn" @click="$emit('close-modal')">
            <i class="fas fa-times text-white"></i>
          </button>
        </div>
        <div class="card-body">
          <div
            class="alert alert-danger"
            role="alert"
            v-if="validationError.length > 0"
          >
            {{ validationError }}
          </div>
          <form @submit.prevent="deletePost">
            <p>
              You are deleting a post. Please type your username below to
              confirm.
            </p>
            <p class="fw-bold mb-2">{{ post.user.username }}</p>
            <input
              type="text"
              class="form-control mb-2"
              v-model="usernameConfirmation"
            />
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
    post: Object,
  },
  data() {
    return {
      usernameConfirmation: "",
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
    deletePost: function () {
      axios
        .delete(`/p/${this.post.slug}/delete`, {
          data: {
            usernameConfirmation: this.usernameConfirmation,
          },
        })
        .then((response) => {
          this.$emit("close-modal");
          window.location.reload();
        })
        .catch((error) => {
          if (error.response.data.message) {
            this.validationError = error.response.data.message;
          }
        });
    },
  },
  mounted() {
    this.closeModalOnOutsideClick(this.$refs.confirmationModal);
  },
};
</script>

<style scoped>
.confirmation-modal {
  position: fixed;
  z-index: 999;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
  top: 0;
  left: 0;
}

.confirmation-modal-content {
  margin-top: 125px;
  width: 50%;
}
</style>