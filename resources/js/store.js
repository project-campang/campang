import { createStore } from 'vuex';
import router from './router';
import { floor } from 'lodash';

const store = createStore({
    state() {
        return{
            authFlg: document.cookie.indexOf('auth=') >= 0 ? true : false,
            userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : null,
            commentData: [],
            commentList: [],
            pagination: {},
            paginationReview: {},
            paginationSearch: {},
            paginationCommunity: {},
            communityData: [],
            boardData: [],
            rankData: [],
            mainCampingler:[],
            mainCampingzang:[],
            mainCommunity:[],
            tip:[],
            reviewTap: [],
            suggestCam:[],
            suggestBrand:[],
            communityTypes: [], // community_types 데이터를 저장할 상태
            campData: [],
            searchResult : [], // 캠핑장 검색 결과
            searchCount: [],
            wishes: false,
            campDetail: {},
            stateData: [],
            countyData: [],
            selectedState: '', // 선택된 시/도
            selectedCounty: '', // 선택된 구/군
            mapCenter: { lat: 37.566826, lng: 126.9786567 }, // 임시 기본 좌표
            stampCampingzang: [],
            mypageWishes:[],
            targetCamp: [],
            userPosition: null,
            currentTarget: null,
            isWithinTargetArea: false,
            stampCnt: {},
            stampUser:{id: null},
            currentCamp:{id: null},
            mypageContent:[],
            mypageReview:[],
            mypageComment:[],
            allImgs: [],
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
        updateUserInfo(state, userInfo) {
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
        setTip(state,data) {
            state.tip = data;
        },
        setSuggestCam(state,data) {
            state.suggestCam = data;
        },
        setSuggestBrand(state,data) {
            state.suggestbrand = data;
        },
        setCommunityTypes(state, data) {
            state.communityTypes = data; // 상태 업데이트
        },
        setStampCampingzang(state, data) {
            state.stampCampingzang = data; // 상태 업데이트
        },
        setMypageWishes(state, data) {
            state.mypageWishes = data; // 상태 업데이트
        },
        setMypageContent(state, data) {
            state.mypageContent = data; // 상태 업데이트
        },
        setMypageReview(state, data) {
            state.mypageReview = data; // 상태 업데이트
        },
        setMypageComment(state, data) {
            state.mypageComment = data; // 상태 업데이트
        },

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
        setPaginationReview(state, data){
            state.paginationReview = data;
        },
        setPaginationSearch(state, paginationData){
            state.paginationSearch = paginationData;
        },
        setPaginationCommunity(state, paginationData){
            state.paginationCommunity = paginationData;
        },
        // addWish(state, camp_id) {
        //     state.wishes.push({ camp_id });
        // },
        toggleWish(state) {
            state.wishes = !state.wishes;
        },
        // // 찜 삭제
        // removeWish(state, camp_id) {
        //     state.wishes = state.wishes.filter(wish => wish.camp_id !== camp_id);
        // },

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
        setCommunityTypes(state, communityTypes) {
            state.communityTypes = communityTypes; // 상태 업데이트
        },
        
        setCampDetail(state, data){
            state.campDetail = data;
        },


        setCampDetail(state, data){
            state.campDetail = data;
        },

        // 시/도 데이터 획득
        setStateData(state, data) {
            state.stateData = data;
        },
        // 군/구 데이터 획득
        setCountyData(state, data) {
            state.countyData = data;
        },
        // 선택된 시/도 획득
        setSelectedState(state, selectedState) {
            state.selectedState = selectedState;
        },
        // 선택된 구/군 획득
        setSelectedCounty(state, selectedCounty) {
            state.selectedCounty = selectedCounty;
        },

        // 캠핑장 데이터 획득
        setCampList(state, data) {
            state.campData = data;
        },
        setSearchCount(state, data) {
            state.searchCount = data;
        },
        // // 캠핑장 검색 결과 획득
        // setSearchResult(state, campData) {
        //     state.searchResult = countyData;
        // },
        // 유저 위치 획득
        setUserPosition(state,position){
            state.userPosition = position;
        },
        // 정복캠핑장 정보
        setTargetCamp(state, data){
            state.targetCamp = data;
        },
        // 캠핑장 위치 반경 내
        setWithinTargetArea(state, isWithin) {
            state.isWithinTargetArea = isWithin;
        },
        setCurrentTarget(state, data){
            state.currentTarget = data;
        },
        // 스탬프 갯수
        setStampCnt(state, data){
            state.stampCnt = data;
        },
        //스탬프 찍기
        setStampUser(state, user){
            state.stampUser.id = user.id;
        },
        setCurruntCamp(state, camp){
            state.currentCamp.id = camp.id;
        },
        updateMapCenter(state, center) {
            state.mapCenter = center;
        },
        setAllImgs(state, data){
            state.allImgs = data;
        }
    },
    actions: {
        // async login(context, loginForm) {
        //     try {
        //         const response = await axios.post('/api/login', loginForm);
        //         localStorage.setItem('userInfo', JSON.stringify(response.data.data));
        //         context.commit('setAuthFlg', true);
        //         context.commit('setUserInfo', response.data.data);
        //         // router.replace('/main');
        //     } catch (error) {
        //         console.error('로그인 실패:', error.response);
        //         console.log(error);
        //     }
        // },

        // async login (context, loginForm)  {
        //     try {
        //         const response = await axios.post('/api/login', loginForm);
        //         context.commit('setAuthFlg', true);
        //         context.commit('setUserInfo', response.data.data);
        //         return response;
        //     } catch (error) {
        //         if (error.response && error.response.status === 422) {
        //             throw new Error('Unauthorized'); // 401 Unauthorized 오류 반환
        //         }
        //         throw error;
        //     }
        // },

        async login({ commit }, loginForm) {
            try {
                const response = await axios.post('/api/login', loginForm);
                commit('setAuthFlg', true);
                commit('setUserInfo', response.data.data);
                return response;
            } catch (error) {
                throw error;
            }
        },

        async register({ commit }, registerForm) {
            try {
                const response = await axios.post('/api/register', registerForm);
                console.log(response);
                commit('setAuthFlg', true);
                commit('setUserInfo', response.data.data);
                // router.replace('/main');
            } catch (error) {
                console.error('회원가입 실패:', error);
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
        async  updateUserInfo() {
            const formData = new FormData(document.querySelector('#updateUserInfoForm'));
            try {
                const response = await axios.post('/mypage/update', formData);
                store.commit('updateUserInfo', response.data.user);
            } catch (error) {
                console.error('Error updating user information:', error);
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
        
        setStampCampingzang(context) {
            const url = '/api/mypage/stamp';

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setStampCampingzang', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                console.log(`게시글 획득 실패 (${error.response.data.code})`)
            })
        },
        setMypageWishes(context) {
            const url = '/api/mypage/wishes';

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setMypageWishes', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                console.log(`게시글 획득 실패 (${error.response.data.code})`)
            })
        },
        setMypageContent(context) {
            const url = '/api/mypage/content';

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setMypageContent', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                console.log(`게시글 획득 실패 (${error.response.data.code})`)
            })
        },
        setMypageReview(context) {
            const url = '/api/mypage/review';

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setMypageReview', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                console.log(`게시글 획득 실패 (${error.response.data.code})`)
            })
        },
        setMypageComment(context) {
            const url = '/api/mypage/comment';

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setMypageComment', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                console.log(`게시글 획득 실패 (${error.response.data.code})`)
            })
        },
        async updatePost({ commit }, content) {
            try {
                const response = await axios.post('/api/content/update', content);
                commit('setMypageContent', response.data);
            } catch (error) {
                console.log(error);
                throw new Error('게시글 수정 실패');
            }
        },
        async updateReview({ commit }, content) {
            try {
                const response = await axios.post('/api/review/update', content);
                commit('setMypageReview', response.data);
            } catch (error) {
                throw new Error('리뷰 수정 실패');
            }
        },
        async updateComment({ commit }, content) {
            try {
                const response = await axios.post('/api/comment/update', content);
                commit('setMypageComment', response.data);
            } catch (error) {
                throw new Error('댓글 수정 실패');
            }
        },
        deletePost(context, content) {
            const url = `/api/posts/delete/${content.id}`; // content.id를 URL에 직접 포함시킴
            axios.delete(url) // DELETE 요청에는 데이터를 직접 전달하지 않음
                .then(response => {
                    console.log(response.data);
                    context.commit('setMypageContent', response.data.data);
                })
                .catch(error => {
                    console.log(error.response);
                    alert(`게시글 삭제 실패 (${error.response.data.code})`);
                });
        },
        
        
        deleteReview(context, content) {
            const url = `/api/reviews/delete/${content.id}`;

            axios.delete(url, content)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setMypageReview', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert(`리뷰 삭제 실패 (${error.response.data.code})`)
            })
        },
        deleteComment(context , content) {
            const url = `/api/comments/delete/${content.id}`;

            axios.delete(url, content)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setMypageComment', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert(`리뷰 삭제 실패 (${error.response.data.code})`)
            })
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
                alert('setMainCampingler 오류오류' + error.response.data);
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
                alert('setMainCampingzang 오류오류' + error.response.data);
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
                alert('setMainCommunity 오류오류' + error.response.data);
            })
        },
        setTip(context) {
            const url = '/api/main/tip';

            axios.get(url)
            .then(response => {
                context.commit('setTip', response.data.data);
                console.log(response.data.data);
            })
            .catch(error => {
                alert('setTip 오류오류' + error.response.data);
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
                alert('setSuggestCam 오류오류' + error.response.data);
                console.log(response.data.data);
            })
        },
        setSuggestBrand(context) {
        const url = '/api/main/suggest/brand';

        axios.get(url)
            .then(response => {
                context.commit('setSuggestBrand', response.data.data); // 'data'는 API 응답 구조에 따라 다를 수 있습니다.
                console.log(response.data.data);
            })
            .catch(error => {
                if (error.response) {
                    alert('오류: ' + error.response.data.message); // message는 서버 응답 구조에 따라 다를 수 있습니다.
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
         * 댓글 작성
         * 
         * @param {*} context 
         */
        commentStore(context, id) {
            const url = '/api/comment/'+id;
            const data = new FormData(document.querySelector('#commentForm'));
            
            console.log(data);

            axios.post(url, data)
                .then(response => {
                context.commit('setUnshiftCommentData', response.data.data); //댓글 가장 앞에 추가

                router.go('/camp/' + id);
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
         commentPageGet(context,id, page=1) {
            const url = ('/api/camp/'+id+'/commentPage?page=' + page);
            console.log(url);
            axios.get(url)
            .then(response => {
                // const test = response.data.data.links.filter((item, key) => {
                //     return !(key == 0 || key == (response.data.data.links.length - 1));
                // });
                context.commit('setCommentList', response.data.data.data);
                console.log('data 확인', response.data.data);
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
                console.log('response.data.data.current_page', response.data.data.current_page);
                // context.commit('setCurrentPage', data);
                // console.log(test);
                // console.log(response.data);
            })
            .catch((e) => {
                    console.log(e);
                })
        },
        detailReviewTap(context, page=1) {
            const url = ('/api/reviewTap?page=' + page);
            // const url = '/api/reviewTap';

            axios.get(url)
            .then(response => {
                context.commit('setDetailReviewTap', response.data.data.data);
                context.commit('setPaginationReview', {
                    current_page: response.data.data.current_page, // 현재페이지
                    last_page: response.data.data.last_page, // 마지막페이지
                });
                console.log(response.data.data);
            })
            .catch(error => {
                alert('detailReviewTap 오류오류' + error.response.data);
            })
        },

        detailWishToggle({commit,state}, id){
            const upsertUrl = '/api/camp/'+id+'/wishBtnUpsert';
                axios.post(upsertUrl)
                .then(() => {
                    commit('toggleWish');
                })
                .catch(error=> {
                    alert('업설트 오류오류', error);
                    console.log('이게뭐지',state.wishes);
                    console.error('Error details:', error);
                    console.log('State:', state.wishes);
                    console.log('URL:', upsertUrl);
                });
            
        },

        // // 찜 토글
        // async toggleWish({ commit, state }, { user_id, camp_id }) {
        //     try {
        //     const found = state.wishes.some(wish => wish.camp_id === camp_id);
            
        //     if (found) {
        //         // 이미 찜한 경우 삭제
        //         await axios.delete(`/api/wishBtn/${camp_id}`);
        //         commit('removeWish', camp_id);
        //     } else {
        //         // 찜하지 않은 경우 추가
        //         await axios.post(`/api/wishBtn`, { user_id, camp_id });
        //         commit('addWish', camp_id);
        //     }
        //     } catch (error) {
        //     console.error('Error toggling wish:', error);
        //     }
        // },






        /**
         * 커뮤니티 게시글 획득
         * 
         * @param {*} context 
         */
        // communityGet(context, id, page=1) {
        communityGet(context, id, page=1) {
            // const url = ('/api/community/'+id+'/communityPage?page='+page);
            const url = ('/api/community/' + id + '/communityPage?page=' + page);

            axios.get(url)
            .then(response => {
                // const data = response.data.data;
                context.commit('setCommunityList', response.data.data.data);
                context.commit('setPaginationCommunity', {
                    current_page: response.data.data.current_page, // 현재페이지
                    first_page_url: response.data.data.first_page_url, // 첫번째페이지 url
                    last_page: response.data.data.last_page, // 마지막페이지
                    last_page_url: response.data.data.last_page_url, // 마지막페이지url
                    total: response.data.data.total, // 총 페이지
                    per_page: response.data.data.per_page, // 한페이지 당 갯수 (5)
                    prev_page_url: response.data.data.prev_page_url, // 이전페이지(처음이면 null)
                    next_page_url: response.data.data.next_page_url, // 다음페이지(끝이면 null)
                    links: response.data.links,
                    // test: test,
                });
                // context,commit('setCommunityTypes', data);
                console.log('setPaginationCommunity 실행됨');
                console.log('response.data.data.current_page', response.data.data.current_page);
                console.log('데이터 확인1', response.data);
                console.log('데이터 확인2', response.data.data);
            })
            .catch(error => {
                alert('communityGet 오류오류~~' + error.response);
            })
        },


            // // 게시판타입
            // async fetchCommunityTypes({ commit }, id) {
            //     try {
            //         const response = await axios.get(``);
            //         commit('setCommunityTypes', response.data);
            //     } catch (error) {
            //         commit('setError', error.response ? error.response.data : 'Error fetching community type');
            //         console.error('Error fetching community type:', error);
            //     }
            // },


        /**
         * 커뮤니티 게시글 작성
         * 
         * @param {*} context
         */
        
        communityInsert(context, id,) {
            const url = ('/api/community/' + id);

            const insertForm = document.querySelector('#insertForm');
            console.log('insertForm', insertForm);

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

        campDetailGet(context, id){
            const url = '/api/camp/'+id;
            console.log(url);

            axios.get(url)
            .then(response => {
                context.commit('setCampDetail', response.data.data);
                console.log(response.data);
            })
            .catch( error => {
                console.log('정보획득 실패 : ', error);
            })

        },
        // async campDetailGet({ commit }, id) {
        //     try {
        //       const response = await axios.get(`/api/camp/${id}`);
        //       commit('setCampDetail', {
        //             campInfo: response.data.data.campInfo,
        //             amenityInfo: response.data.data.amenityInfo,
        //             amusementInfo: response.data.data.amusementInfo,
        //             siteTypeInfo: response.data.data.siteTypeInfo,
        //             topoInfo: response.data.data.topoInfo,
        //         });
        //     } catch (error) {
        //       console.error('Error fetching detailed info:', error);
        //     }
        //   },

        /**
         * 캠핑장 데이터 획득
         * 
         * @param {*} context 
         */
        campListGet(context, page=1) {
            // const url = ('/api/search/searchPage?page=' + page);
            // const url = ('/api/search/searchPage?page=' + page);
            const url = ('/api/search/searchPage?page=' + page);
            console.log(url);
            axios.get(url)
            .then(response => {

                const campList = response.data.data.data;
                context.commit('setCampList', campList);
                // const data = response.data.data;
                // context.commit('setCampList', response.data.data);
                // console.log(response.data.data);
                // console.log(setCampList);
                console.log('campList', campList);
                context.commit('setPaginationSearch', {
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
                if (campList.length > 0) {
                    const newCenter = {
                        lat: campList[0].latitude,
                        lng: campList[0].longitude
                    }
                    
                    console.log('campList[0].latitude', campList[0].latitude);
                    context.commit('updateMapCenter', newCenter);
                    console.log('지도 중심 좌표 업데이트', newCenter);
                };
                
            })
            .catch(error => {
                console.log(error);
            })
        },



        /**
         * 시/도 데이터 획득
         * @param {*} context 
         */
        stateGet(context) {
            const url = '/api/state'

            axios.get(url)
            .then(response => {
                context.commit('setStateData', response.data.data);
                // console.log(response.data.data);
            })
            .catch(error => {
                alert('state 획득 실패' + error.response.data);
            })
        },

        /**
         * 군/구 데이터 획득
         * @param {*} context 
         */
        // countyGet(context) {
        //     const url = '/api/county';

        //     axios.get(url)
        //     .then(response => {
        //         context.commit('setCountyData', response.data.data);
        //         // console.log(response.data.data);
        //     })
        //     .catch(error => {
        //         alert('county 획득 실패' + error.response.data);
        //     })
        // },
    // Vuex 액션
        countyGet({ commit }, selectedStateId) {
            const url = '/api/county';
        
            axios.get(url, {
            params: {
                state_id: selectedStateId
            }
            })
            .then(response => {
            commit('setCountyData', response.data.data);
            })
            .catch(error => {
            alert('군/구 데이터 획득 실패: ' + error.response.data);
            });
        },


        /**
         * 검색 결과 획득
         * 
         * @param {*} context 
         */
        searchResult(context, local, page=1) {
            console.log('searchResult Start');
            const selectedState = local.state;
            const selectedCounty = local.county;
            // const page = context.page;

            // const url = `/api/search?state=${state}&county=${county}&page=${page}`;
            const url = ('/api/search/searchPage?page=' + page);
            
            // const selectStateElement = document.querySelector('#select1');
            // const selectCountyElement = document.querySelector('#select2');
            // const selectedState = selectStateElement.value;
            // const selectedCounty = selectCountyElement.value;
            // console.log(selectedState);
            // console.log(selectedCounty);

            const data = new FormData(document.querySelector('#searchForm'));

            axios.post(url, data)
                .then(response => {
                    const campList = response.data.data.data;
                    context.commit('setCampList', campList);
                    console.log('searchResult 검색 결과 획득 성공', campList);
                    console.log('searchResult setCampList', context.state.campData);
                    console.log(campList[0]);
                    context.commit('setPaginationSearch', {
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
                    if (campList.length > 0) {
                        const newCenter = {
                            lat: campList[0].latitude,
                            lng: campList[0].longitude
                        }
                        
                        console.log('links', response.data.data.links);
                        console.log('length', response.data.data.length);
                        context.commit('updateMapCenter', newCenter);
                        console.log('지도 중심 좌표 업데이트', newCenter);
                    };


                    console.log('000', campList[0].latitude);
                    console.log('000', campList[0].longitude);

                })
                .catch(error => {
                    console.error('검색 결과 획득 실패', error);
                    alert('시/도와 구/군을 모두 선택해주세요');
                });
            },
            
            /**
             * 검색결과 카운트
             * @param {*} context 
             */
            searchCount(context) {

                const url = 'api/searchCount';
                axios.get(url) 
                .then(response => {
                    context.commit('setSearchCount', response.data.data);
                })
                .catch(error => {
                    console.error('카운트에러', error);
                })
            },

            // markerShow(context) {
            //     const url = ('/api/search/searchPage?page=' + page);
            //     console.log('Marker clicked:', url);
            // }

            // 메인에서 검색값 가져오는 처리
            // setSelection(context) {
            //     context.commit('setSelectedState', selectedState);
            //     context.commit('setSelectedCounty', selectedCounty);
            // },



            // 검색창 연결
            // async fetchStateData({ commit }) {
            //     try {
            //         const response = await axios.get('/api/state');
            //         commit('setStateData', response.data.data);
            //     } catch(error) {
            //         console.log('시/도 데이터 가져오기 실패', error);
            //     }
            // },
            // async fetchCountyData({ commit }, stateId) {
            //     try {
            //         const response = await axios.get(`/api/county?state_id=${stateId}`);
            //         commit('setCountyData', response.data.data);
            //     } catch (error) {
            //         console.error('구/군 데이터 가져오기 실패:', error);
            //     }
            // },

            // selectState({ commit, dispatch , stateId}) {
            //     commit('setSelectedState', stateId);
            //     dispatch('fetchCountyData', stateId);
            // },

            // async searchResult({ commit }, { state, county }) { // `searchResult` 액션 추가
            //     const url = '/api/search';
        
            //     try {
            //       const response = await axios.post(url, { state, county });
            //       commit('setSearchResult', response.data);
            //       console.log('검색 결과 획득 성공', response.data);
            //     } catch (error) {
            //       console.error('검색 결과 획득 실패', error);
            //       alert('검색 실패: ' + error.message);
            //     }
            // }


            async fetchCamps({commit, dispatch}){
                const url = 'api/main/stampTarget';
                try{
                    const response = await axios.get(url);
                    commit('setTargetCamp', response.data.data);
                    dispatch('checkPosition');
            } catch(e){
                    console.error('캠핑장 패치 실패', e);
                }
            },
            updateUserPosition({commit, dispatch}){
                if(navigator.geolocation) {
                navigator.geolocation.watchPosition(
                    (position) => {
                        commit('setUserPosition', {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            });
                        dispatch('checkPosition');
                    },
                    () => {
                        console.error('유저 위치 확인 실패');
                    });
                } else {
                    console.error('geolocation을 사용할 수 없는 브라우저');
                }
            },
            checkPosition({state, commit}){
                let flg = true;
                if(!state.userPosition || state.targetCamp.length === 0) return;

                state.targetCamp.forEach(targetCamp => {
                const distance = floor(
                        calculateSimpleDistance(
                        state.userPosition.latitude,
                        state.userPosition.longitude,
                        targetCamp.latitude,
                        targetCamp.longitude
                        ),
                        2
                    ) ;
                    const targetRadius = 0.01; // 목표위치 반경 약 1km
                    if(distance <= targetRadius) {
                        commit('setCurrentTarget', targetCamp);
                        commit('setWithinTargetArea', true);
                        flg = false;
                        return;
                    }
                });

                if(flg) {
                    commit('setWithinTargetArea', false);
                }
            },
            stampCnt(context){
                const url = 'api/stampCnt';
                axios.get(url)
                .then(response => {
                    console.log('stampCnt then');
                    context.commit('setStampCnt', response.data.data[0]);
                // console.log(response.data.data);
                })
                .catch(error => {
                    console.log('stamp 갯수 획득 실패' + error.response);
                })
            },
            // stampStore(context){
            //     const url = 'api/stampStore';
            //     axios.post(url)
            //     .then(response => {
            //         console.log('stamp갱신 성공');
                    
            //     })
            //     .catch(error => {
            //         console.log('stamp 갱신 실패' + error.response);
            //     })
            // },
            updateUser({ commit }, user) {
                commit('setStampUser', user);
            },
            updateCurrentCamp({ commit }, camp) {
                commit('setCurrentCamp', camp);
            },
            detailImgGet(context, id){
                const url = 'api/camp/'+id+'/imgs';

                axios.get(url)
                .then(response => {
                    context.commit('setAllImgs', response.data.data);
                })
                .catch(error => {
                    console.log('사진획득 실패', error.response);
                })
            }

    },



});

// 단순 거리 계산 함수 (Pythagorean Theorem 사용)
function calculateSimpleDistance(lat1, lon1, lat2, lon2) {
    return Math.sqrt(
      Math.pow(lat1 - lat2, 2) +
      Math.pow(lon1 - lon2, 2)
    );
    // const R = 6371e3; // 지구의 반경 (미터 단위)
    // const P1 = lat1 * Math.PI / 180; // φ, λ를 라디안으로 변환
    // const P2 = lat2 * Math.PI / 180;
    // const DP = (lat2 - lat1) * Math.PI / 180;
    // const DL = (lon2 - lon1) * Math.PI / 180;
  
    // const a =
    //   Math.sin(DP / 2) * Math.sin(DP / 2) +
    //   Math.cos(P1) * Math.cos(P2) * Math.sin(DL / 2) * Math.sin(DL / 2);
    // const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  
    // return R * c;
  }

export default store;