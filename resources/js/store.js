import { createStore } from 'vuex';
import router from './router';
import axios from 'axios';

const store = createStore({
    state: {
        authFlg: false,
        userInfo: null,
    },
    mutations: {
        setAuthFlg(state, value) {
            state.authFlg = value;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
            localStorage.setItem('userInfo', JSON.stringify(userInfo));
        },
    },
    actions: {
        async login({ commit }, loginForm) {
            try {
                const response = await axios.post('/api/login', loginForm);
                commit('setAuthFlg', true);
                commit('setUserInfo', response.data.data);
                router.replace('/main');
            } catch (error) {
                console.error('로그인 실패:', error.response.data.message);
            }
        },

        async register({ commit }, registerForm) {
            try {
                const response = await axios.post('/api/register', registerForm);
                commit('setAuthFlg', true);
                commit('setUserInfo', response.data.data);
                router.replace('/main');
            } catch (error) {
                console.error('회원가입 실패:', error.response.data.message);
            }
        },

        async logout({ commit }) {
            try {
                await axios.post('/api/logout');
                commit('setAuthFlg', false);
                commit('setUserInfo', null);
                localStorage.removeItem('userInfo');
                router.replace('/main');
            } catch (error) {
                console.error('로그아웃 실패:', error.response.data.message);
            }
        },
    },
});

export default store;
