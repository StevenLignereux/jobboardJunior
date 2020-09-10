<template>
  <div>
    <div class="row job-card minimal p-2 p-md-3" :class="background" @click="toggleDescription">
      <div class="col-12 col-lg-9">
        <small>{{ job.company_name }}</small>
        <div class="row">
          <div class="col">
            <strong>{{ job.title }}</strong>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-8">
            <div
              class="st-badge mt-1"
              v-for="tag in job.tags"
              :key="job.id.toString() + '-' + tag.id.toString()"
            >{{ tag.name }}</div>
          </div>
        </div>
      </div>
      <div class="col-1">
        <div class="row d-none d-sm-none d-md-none d-lg-block">&nbsp;</div>
        <div
          class="row d-none d-sm-none d-md-none d-lg-block p-1"
          :class="contracts.badgeClass"
        >{{ contracts.type }}</div>
      </div>
      <div class="col-0 col-lg-2 mt-2 mt-sm-2 mt-md-2 d-block">
        <div class="row d-block d-sm-block d-md-block d-lg-none">
          <div class="col-sm-flex ml-3 mb-2" :class="contracts.badgeClass">{{ contracts.type }}</div>
        </div>
        <div class="row">
          <div class="col upper">🌍 {{ job.city }}</div>
        </div>
        <div class="row">
          <div class="col" v-if="diff === 0">Posté aujourd'hui</div>
          <div class="col" v-else-if="diff === 1">Posté il y a 1 jour</div>
          <div class="col" v-else>Posté il y a {{ diff }} jours</div>
        </div>
      </div>
    </div>
    <description :job="job"></description>
  </div>
</template>

<script>
import Bus from "../Bus.js";
import Description from "./Description.vue";
import "fix-date";
export default {
  props: {
    job: Object,
    contracts: Object
  },
  components: {
    Description
  },
  data() {
    return {
      background: this.job.is_highlight ? "bg-highlight" : ""
    };
  },
  methods: {
    toggleDescription: function() {
      Bus.$emit("toggleDescription", {
        id: this.job.id,
        link: this.job.link,
        slug: this.job.slug
      });
    }
  },
  computed: {
    diff: function() {
      const today = new Date();
      const jobCreationDate = new Date(this.job.validate_at);
      const diffTime = Math.abs(today - jobCreationDate);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) - 1;
      return diffDays;
    }
  }
};
</script>
