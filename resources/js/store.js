import { createStore } from 'vuex';
import router from './router';
import axios from 'axios';

export default createStore({
    state: {
        authFlg: false,
    },
    mutations: {
        setAuthFlg(state, value) {
            state.authFlg = value;
        }
    },
    actions: {
        login({ commit }, loginForm) {
            return axios.post('/api/login', loginForm)
                .then(response => {
                    commit('setAuthFlg', true);
                })
                .catch(error => {
                    console.error('로그인 실패:', error.response.data.message);
                });
        },
        register({ commit }, registerForm) {
            return axios.post('/api/register', registerForm)
                .then(response => {
                    commit('setAuthFlg', true);
                })
                .catch(error => {
                    console.error('회원가입 실패:', error.response.data.message);
                });
        },
        logout({ commit }) {
            return axios.post('/api/logout')
                .then(response => {
                    commit('setAuthFlg', false);
                })
                .catch(error => {
                    console.error('로그아웃 실패:', error.response.data.message);
                });
        }
    }
});
