import Home from '../views/Home.vue'
import SaibaMais from '../views/SaibaMais.vue'
import Contato from '../views/Contato.vue'
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/saiba-mais',
        name: 'saiba-mais',
        component: SaibaMais
    },
    {
        path: '/contato',
        name: 'contato',
        component: Contato
    },
];

const router = createRouter({ history: createWebHistory(), routes });

export default router;