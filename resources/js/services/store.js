import _ from "lodash";
import Vuex from "vuex";
import axios from "./axios";
import router from "../routes/router";

export default new Vuex.Store({
    state: {
        session: {
            authenticated: null,
            user: null,
            token: null,
        },
        tasks: [],
    },
    mutations: {
        authenticateUser(state, data) {
            sessionStorage.setItem("session", JSON.stringify(data));
            state.session.authenticated = data.authenticated;
            state.session.token = data.token;
            state.session.user = data.user;
        },
        unauthenticateUser(state) {
            sessionStorage.clear();
            state.session.authenticated = null;
            state.session.token = null;
            state.session.user = null;
        },
        setTasks(state, data) {
            state.tasks = data;
        },
        cleanTasks(state) {
            state.tasks = []
        },
    },
    actions: {
        async login({ commit, dispatch }, credentials) {
            try {
                await axios.get("../../sanctum/csrf-cookie");

                const res = await axios.post("login", credentials);
                res.data.authenticated = true;

                dispatch("loadTasks");

                if (this.state.tasks) {
                    commit("authenticateUser", res.data);
                }

                if(this.state.session.authenticated){
                    router.push("/dashboard");
                }

            } catch (error) {
                return error.response.data.message;
            }
        },
        async register({ commit }, credentials) {
            try {
                await axios.get("../../sanctum/csrf-cookie");

                const res = await axios.post("register", credentials);

                router.push("/login");
            } catch (error) {
                let message = error.response.data.message.split("(")[0];
                return message;
            }
        },
        async logout({ commit }) {
            axios.post("logout");
            commit("unauthenticateUser");
            commit("cleanTasks");
            router.push("/login");
        },
        initState({ commit }) {
            const session = sessionStorage.getItem("session");
            if (session && typeof session === "string" && session !== "") {
                commit("authenticateUser", JSON.parse(session));
            }
        },
        async loadTasks({ commit }) {
            try {
                const res = await axios.get("tasks");

                let tasks = {};

                tasks.todo = res.data.filter((task) => task.status == "todo");
                tasks.doing = res.data.filter((task) => task.status == "doing");
                tasks.done = res.data.filter((task) => task.status == "done");

                commit("setTasks", tasks);
            } catch (error) {
                return error.response.data;
            }
        },
        async storeTask({ commit }, data) {
            try {
                const res = await axios.post("tasks", data);
            } catch (error) {
                return error.response.data;
            }
        },
        async updateTask({ commit }, data) {
            try {
                const res = await axios.put(`tasks/${data.task_id}`, data.task_data);
            } catch (error) {
                return error.response.data;
            }
        },
        async deleteTask({ dispatch }, task_id) {
            try {
                await axios.delete(`tasks/${task_id}`);
                dispatch("loadTasks");
            } catch (error) {
                return error;
            }
        },
    },
    getters: {
        isAuthenticated(state) {
            const session = sessionStorage.getItem("session");
            let data = null;

            if (session && typeof session === "string" && session !== "") {
                data = JSON.parse(session);
            }

            state.session.authenticated = _.isEqual(data, state.session);
            return state.session.authenticated;
        },
        user(state) {
            return state.session.user;
        },
        userToken(state) {
            return state.session.token;
        },
        tasks(state) {
            return state.tasks;
        },
    },
    modules: {},
});
