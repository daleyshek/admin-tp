
require("./bootstrap");
require("admin-lte");

import Vue from 'vue';

Vue.component('table-list',require('./components/TableList.vue').default);

const app = new Vue({
    el: '#app'
});

window.plupload = require("plupload");

// window.E = require("wangeditor");