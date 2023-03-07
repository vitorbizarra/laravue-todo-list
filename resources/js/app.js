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

import BaseModal from './components/BaseModal.vue';
app.component('base-modal-component', BaseModal);

import TaskForm from './components/TaskForm.vue';
app.component('task-form-component', TaskForm);

app.use(router)
app.use(store)

app.mount('#app');
