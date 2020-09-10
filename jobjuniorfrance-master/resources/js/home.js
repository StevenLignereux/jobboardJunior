import Vue from "vue";
import Board from "./components/Board.vue";
import Bus from "./Bus.js";

var board = new Vue({
    el: "#home",
    components: {
        Board,
    },
    data() {
        return {
            id: "",
        }
    },
    methods: {
        search: function(event) {
            Bus.$emit('search', event.target.value);
        }
    }
});