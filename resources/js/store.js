import { createStore } from 'vuex';
import router from './router';

const store = createStore({
    state() {
        return{
            authFlg: document.cookie.indexOf('auth=') >= 0 ? true : false,
            userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : null,
            commentData: [],
            pagination: {},
            // curruntPage: null,
            communityData: [],
            boardData: [],
            rankData: [],
            mainCampingler:[],
            mainCampingzang:[],
            mainCommunity:[],
<<<<<<< HEAD
            reviewTap: [],
=======
            suggestCam:[],
            suggestbrand:[],
>>>>>>> 86e8ed04e5bde56297162283faeb8b7cfbce5bbf
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
        setBoardData(state, data) {
            state.boardData = data;
        },
        setrankData(state, data) {
            state.boardData = data;
        },
        setMainCampingler(state,data) {
            state.mainCampingler = data;
        },
        setMainCampingzang(state,data) {
            state.mainCampingzang = data;
        },
        setMainCommunity(state,data) {
            state.mainCommunity = data;
        },
        setSuggestCam(state,data) {
            state.suggestCam = data;
        },
        setSuggestBrand(state,data) {
            state.suggestbrand = data;
        },


        //댓글 초기 삽입
        // setCommentData(state, data){ 
        //     state.commentData = data;
        // },
        //작성된 댓글 맨위로 정렬
        setUnshiftCommentData(state,data) {
            state.CommentData.unshift(data);
        },
        // 페이지네이션을 위한 댓글 리스트
        setCommentList(state, data) {
            state.commentList = data;
        },
        setPagination(state, data) {
            state.pagination = data;
        },
        setDetailReviewTap(state, data){
            state.reviewTap = data;
        },


        // 게시글 획득
        setCommunityList(state, data) {
            state.communityData = data;
        },
        // 게시글 작성
        setUnshiftCommunityData(state, data) {
            state.communityData.unshift(data);
        },
        // 조회수 증가
        setCommunityViews(state, communityId) {
            const communityItem = state.communityData.find(item => item.id === communityId);
            if (communityItem) {
                communityItem.views++;
            }
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

        getBoardData(context) {
            const url = '/api/main';

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setBoardData', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert(`게시글 획득 실패 (${error.response.data.code})`)
            })
        },
        getrankData(context) {
            const url = '/api/rank';

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setrankdData', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert(`게시글 획득 실패 (${error.response.data.code})`)
            })
        },
        setMainCampingler(context) {
            const url = '/api/main';

            axios.get(url)
            .then(response => {
                context.commit('setMainCampingler', response.data.data);
                console.log(response.data.data);
            })
            .catch(error => {
                alert('오류오류' + error.response.data);
            })
        },
        setMainCampingzang(context) {
            const url = '/api/rank';

            axios.get(url)
            .then(response => {
                context.commit('setMainCampingzang', response.data.data);
                console.log(response.data.data);
            })
            .catch(error => {
                alert('오류오류' + error.response.data);
            })
        },
        setMainCommunity(context) {
            const url = '/api/main/community';

            axios.get(url)
            .then(response => {
                context.commit('setMainCommunity', response.data.data);
                console.log(response.data.data);
            })
            .catch(error => {
                alert('오류오류' + error.response.data);
            })
        },
        setSuggestCam(context) {
            const url = '/api/main/suggest/campingzang';


            axios.get(url)
            .then(response => {
                context.commit('setSuggestCam', response.data.data);
                console.log(response.data.data);
            })
            .catch(error => {
                alert('오류오류' + error.response.data);
                console.log(response.data.data);
            })
        },
        setSuggestBrand(context) {
            const url = '/api/main/suggest/brand';
        
            axios.get(url)
            .then(response => {
                context.commit('setSuggestBrand', response.data.data);
                console.log(response.data.data);
            })
            .catch(error => {
                // error.response를 사용하여 서버의 응답 데이터에 접근
                if (error.response) {
                    alert('오류: ' + error.response.data);
                    console.error('서버 응답:', error.response.data);
                } else if (error.request) {
                    alert('서버 응답이 없습니다. 네트워크 문제일 수 있습니다.');
                    console.error('요청:', error.request);
                } else {
                    alert('요청 오류: ' + error.message);
                    console.error('오류 메시지:', error.message);
                }
            });
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

                router.go('/camp');
                // location.reload();
            })
            .catch(error => {
                
                // console.log(error.response.data);
                alert('댓글 작성 실패'+error.response.data)
            })
        },
        /**
         * 댓글 페이지네이션
         * @param {*} context 
         * @param {*} page 
         */
        commentPageGet(context, page=1) {
            const url = ('/api/commentPage?page=' + page);
            console.log(url);
            axios.get(url)
            .then(response => {
                // const test = response.data.data.links.filter((item, key) => {
                //     return !(key == 0 || key == (response.data.data.links.length - 1));
                // });
                context.commit('setCommentList', response.data.data.data);
                context.commit('setPagination', {
                    current_page: response.data.data.current_page, // 현재페이지
                    first_page_url: response.data.data.first_page_url, // 첫번째페이지 url
                    last_page: response.data.data.last_page, // 마지막페이지
                    last_page_url: response.data.data.last_page_url, // 마지막페이지url
                    total: response.data.data.total, // 총 페이지
                    per_page: response.data.data.per_page, // 한페이지 당 갯수 (5)
                    prev_page_url: response.data.data.prev_page_url, // 이전페이지(처음이면 null)
                    next_page_url: response.data.data.next_page_url, // 다음페이지(끝이면 null)
                    links: response.data.data.links,
                    // test: test,
                });
                // context.commit('setCurrentPage', data);
                // console.log(test);
                // console.log(response.data);
            })
            .catch((e) => {
                    console.log(e);
                })
        },
        detailReviewTap(context) {
            const url = '/api/reviewTap';

            axios.get(url)
            .then(response => {
                context.commit('setDetailReviewTap', response.data.data);
                console.log(response.data.data);
            })
            .catch(error => {
                alert('오류오류' + error.response.data);
            })
        },










        /**
         * 커뮤니티 게시글 획득
         * 
         * @param {*} context 
         */
        communityGet(context) {
            const url = '/api/community';

            axios.get(url)
            .then(response => {
                // const data = response.data.data;
                context.commit('setCommunityList', response.data.data);
                // console.log(response.data.data);
                // console.log(setCommunityList);
            })
            .catch(error => {
                alert('오류오류' + error.response.data);
            })
        },



        /**
         * 커뮤니티 게시글 작성
         * 
         * @param {*} context
         */
        
        communityInsert(context) {
            const url = '/api/community';

            // const insertForm = document.querySelector('#insertForm');
            // console.log('insertForm', insertForm);

            const formData = new FormData(document.querySelector('#insertForm'));
            console.log('formData', formData);

            axios.post(url, formData)
            .then(response => {
                context.commit('setUnshiftCommunityData', response.data.data);
                // router.replace('/community');
                // router.go('/community');
                // location.reload('/community');
                console.error('게시글 작성 완료');

            })
            .catch(error => {
                console.error('게시글 작성 실패:', error.response.data);
                alert('게시글 작성 실패'+error.response.data);
            });
        },

        /**
         * 조회수 증가
         * 
         * @param {*} context 
         * @param {*} communityId 
         */
        async communityViews(context, communityId) {
            try {
                const response = await axios.post('/api/community', {id: communityId});

                commit('setCommunityViews', communityId)
            }
            catch {
                console.log('조회수 증가 실패 : ', error);
            } 
        },

        /**
         * 게시글 수정 처리
         * @param {*} context 
         */
        communityUpdate(context) {
            const url = '/api/community';
            const updateTitle = document.querySelector('#detail-modal-title');
            const updateContent = document.querySelector('#detail-modal-content');

        },

        /**
        * 게시글 삭제
        * @param {*} context
        */
    // "delete": function _delete(context, boardId) {
    //     var url = '/api/board/' + boardId;
    //     axios["delete"](url).then(function (response) {
    //       console.log(response.data, '삭제 완료');
    //       // context.commit('closeModal');
    //       _router__WEBPACK_IMPORTED_MODULE_0__["default"].replace('/board');
    //     })["catch"](function (error) {
    //       console.log(error.response.data, '삭제 실패');
    //     });
    //   }


    },
});

export default store;