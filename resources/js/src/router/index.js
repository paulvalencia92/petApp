import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

const routes = [
    {
        path: '/',
        name: 'pets',
        component: () => import("../views/pets/index"),
    },
    {
        path: '/add-pet',
        name: 'add-pet',
        component: () => import("../views/pets/create"),
    },
    {
        path: '/pet-details/:id',
        name: 'pet-details',
        component: () => import("../views/pets/show"),
        props: true
    },
]

const router = new Router({
    mode: "history",
    linkActiveClass: "open",
    routes,
});
export default router;
