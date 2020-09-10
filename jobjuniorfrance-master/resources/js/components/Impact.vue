<template>
  <fieldset class="border p-4" id="price">
    <legend class="w-auto text-center p-3 blue-title">ayez plus d'impact</legend>
    <div class="custom-control custom-checkbox">
      <input
        type="checkbox"
        name="is_highlight"
        class="custom-control-input"
        id="highlight"
        v-model="highlight"
      />
      <label class="custom-control-label normal" for="highlight">
        Votre annonce sera mis en avant avec le fond en:
        <span class="highlight">highlight</span>
        (+ {{ propshighlight / 100 }}€)
      </label>
    </div>
    <div class="custom-control custom-checkbox">
      <input
        type="checkbox"
        class="custom-control-input"
        id="during_one_week"
        name="end_week_at"
        v-model="end_week_at"
      />
      <label
        class="custom-control-label normal"
        for="during_one_week"
      >Votre annonce sera dans ⭐ Les Top Jobs ⭐ pendant une semaine entière (+{{ propsweek / 100 }} € )</label>
    </div>
    <div class="custom-control custom-checkbox">
      <input
        type="checkbox"
        class="custom-control-input"
        id="during_one_month"
        name="end_month_at"
        v-model="end_month_at"
      />
      <label
        class="custom-control-label normal"
        for="during_one_month"
      >Votre annonce sera dans ⭐ Les Top Jobs ⭐ pendant un mois entier (+{{ propsmonth / 100 }}€ )</label>
    </div>
    <div class="float-right">
      <button type="submit" class="btn bg-bl mt-5">
        Mettre en ligne - {{ price / 100}} € HT
        <br />
        {{ (parseInt(price) + (parseInt(price) * 0.2) ) / 100 }} € TTC
      </button>
    </div>
  </fieldset>
</template>

<script>
export default {
  props: ["propsprice", "propshighlight", "propsweek", "propsmonth"],
  data() {
    return {
      price: this.propsprice,
      highlight: "",
      end_week_at: "",
      end_month_at: ""
    };
  },
  watch: {
    highlight: function(checked) {
      this.price = checked
        ? parseInt(this.price) + parseInt(this.propshighlight)
        : parseInt(this.price) - parseInt(this.propshighlight);
    },
    end_week_at: function(checked) {
      this.price = checked
        ? parseInt(this.price) + parseInt(this.propsweek)
        : parseInt(this.price) - parseInt(this.propsweek);
    },
    end_month_at: function(checked) {
      this.price = checked
        ? parseInt(this.price) + parseInt(this.propsmonth)
        : parseInt(this.price) - parseInt(this.propsmonth);
    }
  }
};
</script>
