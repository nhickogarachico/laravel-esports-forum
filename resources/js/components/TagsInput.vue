/** 
    Props

    @categoryTags: Array -> Array containing all the tags that can be selected

 */

<template>
  <div class="mb-3">
    <label for="tag" class="d-block">Tags</label>
    <div
      class="tags-container form-control"
      ref="tagsContainer"
      @click="$refs.tagText.focus()"
    >
      <div
        class="selected-tags-container d-inline-block"
        ref="selectedTagsContainer"
        v-if="selectedCategoryTags.length"
      >
        <span
          v-for="tag in selectedCategoryTags"
          :key="tag.id"
          class="badge bg-primary ms-2 tag"
          @click="removeTag(tag)"
          >{{ tag.tag }} <i class="fas fa-times ms-1"></i
        ></span>
      </div>
      <input
        type="text"
        class="form-control tag-text d-inline-block"
        name="tag"
        v-model="categoryTagInput"
        @input="displayMatchedTags"
        @click="displayMatchedTags"
        ref="tagText"
        :style="{ width: tagTextWidth }"
      />
    </div>
    <div class="tag-dropdown" v-if="isTagDisplayed">
      <div
        v-for="tag in searchedCategoryTags"
        :key="tag.id"
        class="tag-dropdown-item"
        @click="addTag(tag)"
      >
        {{ tag.tag }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    categoryTags: {
      type: Array,
      default: [],
    },
    selectedCategoryTags: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      isTagDisplayed: false,
      categoryTagInput: "",
      searchedCategoryTags: this.categoryTags,
    };
  },
  computed: {
    tagTextWidth() {
      return this.selectedCategoryTags.length > 0 ? "auto" : "100%";
    },
  },
  methods: {
    displayMatchedTags: function () {
      this.isTagDisplayed = true;
      let searchedRegex = new RegExp(
        "^" + this.escapeRegex(this.categoryTagInput),
        "i"
      );

      this.searchedCategoryTags = this.categoryTags.filter((tag) => {
        return (
          tag.tag.match(searchedRegex) &&
          !this.selectedCategoryTags.includes(tag)
        );
      });
    },
    escapeRegex: function (stringToEscape) {
      return stringToEscape.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
    },
    hideTagDropdownOnOutsideClick: function () {
      document.addEventListener("click", (e) => {
        const withinBoundaries = e.composedPath().includes(this.$refs.tagText);
        if (!withinBoundaries) this.isTagDisplayed = false;
      });
    },
    addTag: function (tag) {
      this.selectedCategoryTags.push(tag);
      this.categoryTagInput = "";
    },

    removeTag: function (tag) {
      this.selectedCategoryTags.splice(
        this.selectedCategoryTags.indexOf(tag),
        1
      );
    },
  },
  mounted() {
    this.hideTagDropdownOnOutsideClick();
  },
};
</script>

<style scoped>
.tag-dropdown {
  background-color: white;
  border: 1px solid #ced4da;
  border-top: none;
  max-height: 280px;
  overflow: auto;
}

.tag-dropdown-item {
  padding: 0.5rem;
  cursor: pointer;
}

.tag-dropdown-item:hover {
  background-color: #ced4da;
}

.tags-container {
  padding: 0;
}

.tag {
  cursor: pointer;
}

.tag-text {
  border: 0;
  font-size: 0.75em;
}

.tag-text:focus,
.tag-text:active {
  outline: none;
  box-shadow: none;
}
</style>