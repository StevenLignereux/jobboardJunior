import Vue from "vue";
import Wys from './components/Wys.vue';
import Impact from './components/Impact.vue';
import Selector from './components/Selector.vue';
var recruiter = new Vue({
    el: '#editor',
    data() {
        return {
            description: ''
        };
    },
    components: {
        Wys
    }
});

var options = new Vue({
    el: "#options",
    components: {
        Impact
    }
})


var tagSelector = new Vue({
    el: "#tag-selector",
    components: {
        Selector
    }
})