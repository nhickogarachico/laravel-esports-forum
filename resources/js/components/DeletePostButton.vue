<template>
  <div>
    <button
      class="btn btn-danger"
      type="button"
      @click="isDeletePostConfirmationOpen = true"
    >
      <i class="fas fa-trash"></i>
    </button>
    <delete-post-admin-confirmation
      v-if="isDeletePostConfirmationOpen"
      :post="post"
      @close-modal="isDeletePostConfirmationOpen = false"
    ></delete-post-admin-confirmation>
  </div>
</template>

<script>
export default {
  props: {
    post: Object,
  },
  data() {
    return {
      isDeletePostConfirmationOpen: false,
    };
  },
};
</script>