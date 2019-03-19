
require("./bootstrap");

require("admin-lte");

window.Vue = require("vue");

//vue components
Vue.component('table-list',require('./components/TableList.vue').default);

const app = new Vue({
    el: '#app'
});


window.plupload = require("plupload");
// window.E = require("wangeditor");