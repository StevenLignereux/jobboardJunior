<template>
  <div>
    <v-select
      v-model="value"
      :inputName="name"
      :id="id"
      :options="tags"
      :reduce="name => name.id"
      label="name"
      multiple
    />
    <input type="hidden" v-model="value" :name="name" />
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  props: {
    id: String,
    name: String,
    tags: Array,
    defaultValue: {
      default: null,
      type: Array
    }
  },
  components: {
    vSelect
  },
  data() {
    return {
      value: this.defaultValue ? this.defaultValue.map( tag => tag.id ) : null
    };
  }
};
</script>