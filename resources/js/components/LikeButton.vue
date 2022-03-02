<template>
  <form>
    <button
      type="button"
      class="btn like-button"
      @click.prevent="isPostLiked ? unlike() : like()"
    >
      <i
        :class="[
          'fas',
          'fa-thumbs-up',
          isPostLiked ? 'liked' : '',
        ]"
      ></i>
      {{ likesCount }}
    </button>
  </form>
</template>
<script>
export default {
  props: {
    post: Object,
  },
  data() {
    return {
      likesCount: 0,
      isPostLiked: false,
    };
  },
  methods: {
    like: function () {
      axios
        .post(`/p/${this.post.slug}/like`)
        .then((response) => {
          this.fetchLikesData();
        })
        .catch((error) => {
          window.location.href = "/login";
        });
    },
    unlike: function () {
      axios
        .delete(`/p/${this.post.slug}/like`)
        .then((response) => {
          this.fetchLikesData();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    fetchLikesData: function () {
      axios
        .get(`/p/${this.post.slug}/like`)
        .then((response) => {
          const { likesCount, isPostLiked } = response.data;
          this.likesCount = likesCount;
          this.isPostLiked = isPostLiked;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
  mounted() {
    this.fetchLikesData();
  },
};
</script>
