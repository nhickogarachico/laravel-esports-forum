<template>
  <div>
    <button class="btn btn-primary" @click="isTagModalOpen = true">
      Add Tag <i class="fas fa-plus"></i>
    </button>
    <add-tag-modal v-if="isTagModalOpen" @close-modal="isTagModalOpen = false"></add-tag-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isTagModalOpen: false,
    };
  },
};
</script>

