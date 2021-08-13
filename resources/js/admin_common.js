
require("./bootstrap");
require("bootstrap")
require("admin-lte/build/js/AdminLTE");
// require("@fortawesome/fontawesome-free/js/all");
import Vue from 'vue';

window.Vue = Vue;
Vue.component('table-list',require('./components/TableList.vue').default);

const app = new Vue({
    el: '#app'
});

window.plupload = require("plupload");

// window.E = require("wangeditor");