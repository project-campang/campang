import { createStore } from 'vuex';
import router from './router';

const store = createStore({
    state() {
        return {
            authFlg: document.cookie.indexOf('auth=') >= 0 ? true : false,
            userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : null,
            boardData: [],
            moreBoardFlg: true,
        }
    },
    mutations: {
        // 인증 플레그 저장
        setAuthFlg(state, flg) {
            state.authFlg = flg;
        },
        // 유저 정보 저장
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
       
    },
    actions: {
        /**
         * 로그인 처리
         * 
         * @param {store} context 
         */
        login(context) {
            const url = '/api/login';
            const form = document.querySelector('#loginForm');
            const data = new FormData(form);
            axios.post(url, data)
            .then(response => {
                console.log(response.data); // TODO
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setUserInfo', response.data.data);

                //인증처리
                context.commit('setAuthFlg', true);

                router.replace('/board');
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert('로그인에 실패했습니다.(' + error.response.data.code + ')');
            });
        },

        /**
         * 로그아웃
         * @param {*} context 
         */
        logout(context) {
            const url = '/api/logout';

            axios.post(url)
            .then(response => {
                console.log(response.data); // TODO
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert('문제가 발생해 강제 로그아웃합니다. (' + error.response.data.code + ')');
            })
            .finally(() => {
                localStorage.clear();

                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', null);

                router.replace('/login');
            });
        },

        // 회원가입
        registration(context) {
            const url = '/api/registration';
            const data = new FormData(document.querySelector('#registrationForm'));

            axios.post(url, data)
            .then(response => {
                console.log(response.data); // TODO
                router.replace('/login');
            })
            .catch(error => {
                console.log(error.response.data); // TODO
                alert('회원가입에 실패했습니다.(' + error.response.data.code +')');
            });

        },

    }
});

export default store;