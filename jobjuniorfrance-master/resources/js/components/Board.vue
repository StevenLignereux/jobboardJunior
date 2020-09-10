<template>
  <div class="board mt-4 mx-auto">
    <div v-for="job in jobsList" :key="job.id">
      <card :job="job" :contracts="contracts[job.type]"></card>
    </div>
  </div>
</template>

<script>
import Bus from "../Bus.js";
import Card from './Card.vue';

export default {
  props: {
    jobs: Array,
    contracts: Array,
  },
  name: 'Board',
  components: {
      Card,
  },
  data() {
    return {
      jobsList: this.jobs,
      initJobs: this.jobs,
    };
  },
  mounted() {
    Bus.$on("search", (searchedWords) => {
      if (!searchedWords) {
        this.jobsList = this.initJobs;
      }
      else {
        if (this.jobs) {
          searchedWords = searchedWords.toUpperCase().split(' ');
          this.jobsList = this.initJobs.filter((job) => {
            if (job.tags.length > 0) {
              // format jobtags as a string, uppercased, space separated
              const jobTags = job.tags.map( item => item.name ).join(' ');
              const searchableFields = jobTags.toUpperCase() + " " + job.city.toUpperCase() + " " + job.company_name.toUpperCase() + " " + this.contracts[job.type].type.toUpperCase();
              return searchedWords.every( word => searchableFields.includes(word));
            }
          });
        }
      }
    });
  },
};
</script>
