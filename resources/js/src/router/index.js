import Vue from "vue";
import Router from "vue-router";
Vue.use(Router);

const routes = [
    {
        path: '/',
        name: 'pets',
        meta: {auth: true},
        component: () => import("../views/pets/index"),
    },
]

const router = new Router({
    mode: "history",
    linkActiveClass: "open",
    routes,
});
export default router;
