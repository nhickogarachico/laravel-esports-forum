<template>
  <div>
    <button class="btn btn-danger" @click="isDeleteTagModalOpen = true">
      <i class="fas fa-trash"></i>
    </button>
    <delete-tag-confirmation v-if="isDeleteTagModalOpen" @close-modal="isDeleteTagModalOpen = false" :tag="tag"></delete-tag-confirmation>
  </div>
</template>

<script>
export default {
  props: {
    tag: Object
  },
  
  data() {
    return {
      isDeleteTagModalOpen: false,
    };
  },
};
</script>

