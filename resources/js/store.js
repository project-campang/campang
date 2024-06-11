import { createStore } from 'vuex';
import router from './router';
import axios from 'axios';

const store = createStore({
    state() {
        return{
            authFlg: document.cookie.indexOf('auth=') >= 0 ? true : false,
            userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : null,
            commentData: [],
        }
    },
    mutations: {
        setAuth(state, payload) {
            state.authFlg = payload.authFlg;
            state.userInfo = payload.userInfo;
        },
        setAuthFlg(state, value) {
            state.authFlg = value;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
            localStorage.setItem('userInfo', JSON.stringify(userInfo));
        },
        //댓글 초기 삽입
        setCommentData(state, data){ state.commentData = data; },
        //작성된 댓글 맨위로 정렬
        setUnshiftCommentData(state,data) {
            state.CommentData.unshift(data);
        },
    },
    actions: {
        async login(context, loginForm) {
            try {
                const response = await axios.post('/api/login', loginForm);
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setAuthFlg', true);
                context.commit('setUserInfo', response.data.data);
                router.replace('/main');
            } catch (error) {
                console.error('로그인 실패:', error.response);
                console.log(error);
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
        async checkEmailDuplicate(email) {
            try {
                const response = await axios.post('/api/check-email-duplicate', { email });
                return response.data.duplicate;
            } catch (error) {
                console.error('이메일 중복 확인 실패:', error);
                return false; // 실패 시 기본적으로 중복되지 않은 것으로 간주합니다.
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
        async kakao_login({ commit }, code) {
            try {
              const response = await axios.get('/kakao/callback', {
                params: { code }
              });
            console.log(code);
            localStorage.setItem('userInfo', JSON.stringify(response.data.data));
            commit('setAuthFlg', true);
            commit('setUserInfo', response.data.data);
            commit('setAuth', { authFlg: true, userInfo: response.data });
            router.replace('/main');
            } catch (error) {
              console.error('Kakao callback failed:', error);
            }
          },
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
                console.log(response.data.data);
                context.commit('setCommentData', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert('댓글 습득 실패' + error);
            })
        }
    },
    
);

export default store;
