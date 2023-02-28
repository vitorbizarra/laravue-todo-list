import store from "../services/store";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("../views/site/Home.vue"),
        meta: { requiresAuth: false },
    },
    {
        path: "/saiba-mais",
        name: "saiba-mais",
        component: () => import("../views/site/About.vue"),
        meta: { requiresAuth: false },
    },
    {
        path: "/contato",
        name: "contato",
        component: () => import("../views/site/Contact.vue"),
        meta: { requiresAuth: false },
    },
    {
        path: "/login",
        name: "login",
        component: () => import("../views/site/Login.vue"),
        meta: { requiresAuth: false },
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: () => import("../views/app/Dashboard.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/minha-conta",
        name: "minha-conta",
        component: () => import("../views/app/Profile.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/:catchAll(.*)",
        name: "notFound",
        component: () => import("../views/NotFound.vue"),
        meta: { requiresAuth: false },
    },
];

const router = createRouter({ history: createWebHistory(), routes });

router.beforeEach((to, from, next) => {
    if (!to.matched.some((record) => record.meta.requiresAuth)) {
        next();
        return;
    }
    if (!store.getters.isAuthenticated) {
        next({
            path: "/login",
            query: {
                redirect: to.fullPath,
            },
        });
        return;
    }
    next();
    return;
});

export default router;