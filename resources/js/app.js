import Vue from "vue";
import routes from "./router/router";
require("./bootstrap");

//for form validation
import { HasError, AlertError } from "vform";
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
//for form validation

const app = new Vue({
    el: "#app",
    router: routes
});
