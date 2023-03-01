import { createApp } from 'vue';
import App from './views/App.vue'
import router from './routes/router.js';
import store from './services/store';

const app = createApp({
    components: { App }
});

import SiteNavbar from './components/SiteNavbar.vue';
app.component('site-navbar-component', SiteNavbar);

import AppNavbar from './components/AppNavbar.vue';
app.component('app-navbar-component', AppNavbar);

import Navbar from './components/Navbar.vue';
app.component('navbar-component', Navbar);

import TaskCard from './components/TaskCard.vue';
app.component('task-card-component', TaskCard);

app.use(router)
app.use(store)

app.mount('#app');
