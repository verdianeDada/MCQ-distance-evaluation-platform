/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import BoostrapVue from "bootstrap-vue";
Vue.use(BoostrapVue);

// import 'bootstrap/dist/css/bootstrap.css';
// import 'bootstrap-vue/dist/bootstrap-vue.css';
let axios = require("axios");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
  "student-dashboard",
  require("./components/student/Dashboard.vue").default
);

const app0 = new Vue({
  el: "#student-dashboard"
});
Vue.component(
  "teacher-dashboard",
  require("./components/teacher/Dashboard.vue").default
);

const app1 = new Vue({
  el: "#teacher-dashboard"
});

// for page Staff and News management
Vue.component("newstaff", require("./components/admin/NewStaff.vue").default);

const app2 = new Vue({
  el: "#newstaff"
});
// for forum
// Vue.component("forum", require("./components//Forum.vue").default);

// const app3 = new Vue({
//   el: "#forum"
// });

// write test page
Vue.component(
  "write-test",
  require("./components/student/WriteTest.vue").default
);

const app4 = new Vue({
  el: "#write-test"
});

Vue.component(
  "sitemanagement",
  require("./components/admin/sitemanagement/SiteManagement.vue").default
);

const app6 = new Vue({
  el: "#sitemanagement"
});
