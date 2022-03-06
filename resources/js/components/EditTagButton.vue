<template>
  <div>
    <button class="btn btn-warning" @click="isEditTagModalOpen = true">
       <i class="fas fa-pencil"></i>
    </button>
    <edit-tag-modal v-if="isEditTagModalOpen" @close-modal="isEditTagModalOpen = false" :tag="tag"></edit-tag-modal>
  </div>
</template>

<script>
export default {
  props: {
    tag: Object
  },
  
  data() {
    return {
      isEditTagModalOpen: false,
    };
  },
};
</script>

