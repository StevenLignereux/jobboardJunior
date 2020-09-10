<template>
  <div v-show="isShown" class="row job-card pb-3">
    <div class="col">
      <h5 v-if="job.job_description" class="mb-3 mt-3">Description du poste</h5>
      <div v-html="job.job_description"></div>
      <h5 v-if="job.how_to_apply" class="mb-3 mt-3">Comment postuler ?</h5>
      <div v-if="job.how_to_apply" v-html="job.how_to_apply"></div>
    </div>
  </div>
</template>

<script>
import Bus from "../Bus.js";
export default {
  props: {
    job: Object
  },
  data() {
    return {
      isShown: false
    };
  },
  mounted() {
    Bus.$on("toggleDescription", clickedJob => {
      if (clickedJob.id == this.job.id) {
        if (clickedJob.link && clickedJob.slug) {
          window.open(clickedJob.slug, "_blank, rel=noopener, rel=noreferrer");
        } else {
          this.isShown = !this.isShown;
        }
      }
    });
  }
};
</script>