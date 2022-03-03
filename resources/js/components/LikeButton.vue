<template>
  <form>
    <button
      type="button"
      class="btn like-button"
      @click.prevent="isLiked ? unlike() : like()"
    >
      <i
        :class="[
          'fas',
          'fa-thumbs-up',
          isLiked ? 'liked' : '',
        ]"
      ></i>
      {{ likesCount }}
    </button>
  </form>
</template>
<script>
export default {
  props: {
    likeRouteParameter: [Number, String],
    likeable: String
  },
  data() {
    return {
      likesCount: 0,
      isLiked: false,
    };
  },
  methods: {
    like: function () {
      axios
        .post(`/${this.likeable}/${this.likeRouteParameter}/like`)
        .then((response) => {
          this.fetchLikesData();
        })
        .catch((error) => {
          window.location.href = "/login";
        });
    },
    unlike: function () {
      axios
        .delete(`/${this.likeable}/${this.likeRouteParameter}/like`)
        .then((response) => {
          this.fetchLikesData();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    fetchLikesData: function () {
      axios
        .get(`/${this.likeable}/${this.likeRouteParameter}/like`)
        .then((response) => {
          const { likesCount, isLiked } = response.data;
          this.likesCount = likesCount;
          this.isLiked = isLiked;
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
