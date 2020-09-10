<template>
  <VueTrix v-model="editorContent" :inputName="name" />
</template>


<script>
import VueTrix from "vue-trix";
export default {
  props: ["name", "init"],
  components: {
    VueTrix
  },
  data() {
    return {
      editorContent: this.init ? this.init : null
    };
  }
};
</script>