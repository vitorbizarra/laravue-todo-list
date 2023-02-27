import _ from 'lodash';
import Vuex from 'vuex';
import axios from './axios';
import router from '../routes/router'

export default new Vuex.Store({
    state: {
        authenticated: null,
        user: null,
        token: null
    },
    mutations: {
        authenticateUser(state, data) {
            sessionStorage.setItem('session', JSON.stringify(data))
            state.authenticated = data.authenticated;
            state.token = data.token;
            state.user = data.user;
        },
        unauthenticateUser(state) {
            sessionStorage.clear();
            state.authenticated = null;
            state.token = null;
            state.user = null;
        }
    },
    actions: {
        async login({ commit }, credentials) {
            await axios.get('../../sanctum/csrf-cookie');

            const res = await axios.post('login', credentials);
            res.data.authenticated = true;

            commit('authenticateUser', res.data);

            router.push('/minha-conta');
        },
        async logout({ commit }) {
            axios.post('logout');
            commit('unauthenticateUser');
            router.push('/login');
        },
        initState({ commit }) {
            const session = sessionStorage.getItem('session')
            if (session && typeof session === 'string' && session !== '') {
                commit('authenticateUser', JSON.parse(session))
            }
        },
    },
    getters: {
        isAuthenticated(state) {
            const session = sessionStorage.getItem('session')
            let data = null;

            if (session && typeof session === 'string' && session !== '') {
                data = JSON.parse(session)
            }

            state.authenticated = _.isEqual(data, state);
            return state.authenticated
        },
        user(state) {
            return state.user;
        },
        userToken(state) {
            return state.token;
        }
    },
    modules: {}
})