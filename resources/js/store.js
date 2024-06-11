import { createStore } from 'vuex';
import router from './router';
import axios from 'axios';

const store = createStore({
    state() {
        return{
            authFlg: false,
            userInfo: null,
            commentData: [],
        }
    },
    mutations: {
        setAuthFlg(state, value) {
            state.authFlg = value;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
            localStorage.setItem('userInfo', JSON.stringify(userInfo));
        },
        //댓글 초기 삽입
        setCommentData(state, data){ state.setBoardData = data; },
        //작성된 댓글 맨위로 정렬
        setUnshiftCommentData(state,data) {
            state.CommentData.unshift(data);
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
        /**
         * 댓글작성
         * 
         * @param {*} context 
         */
        commentStore(context) {
            const url = '/api/comment';
            const data = new FormData(document.querySelector('#commentForm'));
            
            console.log(data);

            axios.post(url, data)
                .then(response => {
                context.commit('setUnshiftCommentData', response.data.data); //댓글 가장 앞에 추가

                router.replace('/camp');
            })
            .catch(error => {
                
                console.log(error.response.data);
                alert('댓글 작성 실패'+error.response.data.code)
            })
        },











        commentGet(context){
            const url = '/api/comment';

            axios.get(url)
            .then(response => {
                context.commit('setCommentData', response.data.data);
            })
            .catch(error => {
                alert('댓글 습득 실패');
            })
        }
    },
});

export default store;
