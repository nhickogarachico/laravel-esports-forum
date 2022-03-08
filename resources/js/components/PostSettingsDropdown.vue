<template>
  <div>
    <div class="dropdown">
      <button
        class="
          btn
          position-relative
          button-in-stretched-link
          p-0
        "
        type="button"
        :id="`postDropdown${post.id}`"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        <i class="fas fa-ellipsis"></i>
      </button>
      <ul
        class="dropdown-menu dropdown-menu-end me-4"
        :aria-labelledby="`postDropdown${post.id}`"
      >
        <li>
          <a class="dropdown-item" :href="`/p/${post.slug}/edit`">Edit Post</a>
        </li>
        <li>
          <button
            class="dropdown-item"
            type="button"
            @click="isDeletePostConfirmationOpen = true"
          >
            Delete Post
          </button>
        </li>
      </ul>
    </div>
    <delete-post-confirmation
      v-if="isDeletePostConfirmationOpen"
      :post="post"
      @close-modal="isDeletePostConfirmationOpen = false"
    ></delete-post-confirmation>
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

<style scoped>
  .dropdown-menu {
    transform: translate3d(25.5px, 19.5px, 0px) !important;
  }
</style>