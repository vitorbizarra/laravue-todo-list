import Home from '../views/Home.vue'
import Hello from '../views/Hello.vue'
import Example from '../views/Example.vue'
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/hello',
        name: 'hello',
        component: Hello
    },
    {
        path: '/example',
        name: 'example',
        component: Example
    },
];

const router = createRouter({ history: createWebHistory(), routes });

export default router;