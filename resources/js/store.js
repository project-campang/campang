import { createStore } from 'vuex';
import router from './router';
import { floor } from 'lodash';

const store = createStore({
    state() {
        return{
            // 쿠키 
            authFlg: document.cookie.indexOf('auth=') >= 0 ? true : false,
            // 유저 정보
            userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : null,
            commentData: [],
            commentList: [],
            pagination: {},
            paginationReview: {},
            paginationSearch: {},
            paginationCommunity: {},
            paginationComment:{},
            // 커뮤니티 게시글
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
            // 커뮤니티페이지 사이드바
            communityComment:[],
            communityCommentInsert:[],
            communityTypes: {
                1: { name: '자유 게시판' },
                2: { name: '리뷰 게시판' },
                3: { name: '가입 인사' },
                4: { name: '캠핑 꿀팁' },
                5: { name: '랭킹 게시판' },
            },
            campData: [],
            searchResult : [], // 캠핑장 검색 결과
            searchCount: [],
            wishes: false,
            campDetail: {},
            stateData: [],
            countyData: [],
            selectedState: '', // 선택된 시/도
            selectedCounty: '', // 선택된 구/군
            mapCenter: { 
                lat: 35.868312,
                lng: 128.593964, // 임시 기본 좌표
                imageUrl: '/images/map-pin.png'
            }, 
            stampCampingzang: [],
            mypageWishes:[],
            targetCamp: [],
            userPosition: {
                latitude: null,
                longitude: null,
              },
            currentTarget: null,
            isWithinTargetArea: false,
            stampCnt: {},
            stampUser:{id: null},
            currentCamp:{id: null},
            mypageContent:[],
            mypageReview:[],
            mypageComment:[],
            allImgs: [],
            localInfo: {
                state: '0'
                ,county: '0'
                ,page: '1'
            },
            communityDetail:{},

            // 관리자
            newmember:{},
            removeMember:{},
            usermanagement:[],
            adverTisement:[],
            adminAdverTisement:[],
            adminAdverTise:[],
            
        }
    },
    mutations: {
        // 카카오
        setAuth(state, payload) {
            state.authFlg = payload.authFlg;
            state.userInfo = payload.userInfo;
        },
        // 유저 쿠키
        setAuthFlg(state, value) {
            state.authFlg = value;
        },
        // 유저정보
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
            localStorage.setItem('userInfo', JSON.stringify(userInfo));
        },
        // 유저정보 수정
        updateUserInfo(state, userInfo) {
            state.userInfo = userInfo;
            localStorage.setItem('userInfo', JSON.stringify(userInfo));
        },
        // 메인 게시글
        // setBoardData(state, data) {
        //     state.boardData = data;
        // },
        // 메인 랭킹
        // setrankData(state, data) {
        //     state.boardData = data;
        // },
        // 메인 캠핑러
        setMainCampingler(state,data) {
            state.mainCampingler = data;
        },
        // 메인 캠핑장
        setMainCampingzang(state,data) {
            state.mainCampingzang = data;
        },
        // 메인 커뮤글
        setMainCommunity(state,data) {
            state.mainCommunity = data;
        },
        // 메인 꿀팁
        setTip(state,data) {
            state.tip = data;
        },
        // 메인 추천캠핑장
        setSuggestCam(state,data) {
            state.suggestCam = data;
        },
        // 메인 추천 캠핑브랜드
        setSuggestBrand(state,data) {
            state.suggestbrand = data;
        },
        // setCommunityTypes(state, data) {
        //     state.communityTypes = data; // 상태 업데이트
        // },
        // 마이페이지 캠핑도장
        setStampCampingzang(state, data) {
            state.stampCampingzang = data; // 상태 업데이트
        },
        // 마이페이지 찜목록
        setMypageWishes(state, data) {
            state.mypageWishes = data; // 상태 업데이트
        },
        // 마이페이지 게시글 목록
        setMypageContent(state, data) {
            state.mypageContent = data; // 상태 업데이트
        },
        // 마이페이지 리뷰 목록
        setMypageReview(state, data) {
            state.mypageReview = data; // 상태 업데이트
        },
        // 마이페이지 댓글 목록
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
        setPaginationComment(state, paginationData){
            state.paginationComment = paginationData;
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
        // 상세게시글 획득
        setCommunityDetail(state, detail) {
            state.communityDetail = detail;
        },

        setCommentPageGet(state, data) {
            state.communityComment = data;
        },
        setCommentPost(state, data) {
            state.communityCommentInsert = data;
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
        // setCommunityTypes(state, communityTypes) {
        //     state.communityTypes = communityTypes; // 상태 업데이트
        // },
        
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
        setUserPosition(state, position) {
            state.userPosition.latitude = position.latitude;
            state.userPosition.longitude = position.longitude;
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
            state.mapCenter = {
                lat: center.lat,
                lng: center.lng,
                imageUrl: '/images/map-pin.png' // 기본 이미지 URL 설정
            };
        },
        setAllImgs(state, data){
            state.allImgs = data;
        },
        // 로컬 정보 셋
        setLocalInfo(state, data) {
            state.localInfo = data;
        },

        // 관리자
        setNewMember(state,data){
            state.newmember = data;
        },
        setRemoveMember(state,data){
            state.removeMember = data;
        },
        setUserManagement(state,data){
            state.usermanagement = data;
        },
        setadverTisement(state,data){
            state.advertisement = data;
        },
        setNewadverTisement(state,data){
            state.adverTisement = data;
        },
        setadminAdverTisement(state,data){
            state.adminAdverTisement = data.data;
        },
        setadminAdverTise(state,data){
            state.adminAdverTise = data.data;
        },
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

        // 로그인 
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
        // 회원가입
        async register({ commit }, registerForm) {
            try {
                const response = await axios.post('/api/register', registerForm);
                commit('setAuthFlg', true);
                commit('setUserInfo', response.data.data);
                // router.replace('/main');
            } catch (error) {
                console.error('회원가입 실패:', error);
            }
        },
        // 사업자 회원가입
        async bizRegister({ commit }, bizRegisterForm) {
            try {
                const response = await axios.post('/api/bizRegister', bizRegisterForm);
                commit('setAuthFlg', true);
                commit('setUserInfo', response.data.data);
                // router.replace('/main');
            } catch (error) {
                console.error('회원가입 실패:', error);
            }
        },
        // 이메일 중복확인
        async checkEmailDuplicate(email) {
            try {
                const response = await axios.post('/api/check-email-duplicate', { email });
                return response.data.duplicate;
            } catch (error) {
                console.error('이메일 중복 확인 실패:', error);
                return false; // 실패 시 기본적으로 중복되지 않은 것으로 간주합니다.
            }
        },
        // 내정보수정
        async  updateUserInfo() {
            const formData = new FormData(document.querySelector('#updateUserInfoForm'));
            try {
                const response = await axios.post('/mypage/update', formData);
                store.commit('updateUserInfo', response.data.user);
            } catch (error) {
                console.error('Error updating user information:', error);
            }
        },
        
        // 로그아웃
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
        // 카카오로그인
        async kakaoUser({ commit }) {
            try {
                const response = await axios.get('/auth/kakao/user');
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                console.log(response);
                commit('setAuthFlg', true);
                commit('setUserInfo', response.data.data);
                commit('setAuth', { authFlg: true, userInfo: response.data.data });
                router.replace('/main');
            } catch (error) {
                console.error('kakaoUser failed:', error);
            }
        },
        // 마이페이지 도장깨기
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
        // 마이페이지 찜목록
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
        // 마이페이지 게시글
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
        // 마이페이지 리뷰
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
        // 마이페이지 댓글
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
        // 게시글수정
        async updatePost({ commit }, content) {
            try {
                const response = await axios.post('/api/content/update', content);
                commit('setMypageContent', response.data);
            } catch (error) {
                console.log(error);
                throw new Error('게시글 수정 실패');
            }
        },
        // 리뷰수정
        async updateReview({ commit }, content) {
            try {
                const response = await axios.post('/api/review/update', content);
                commit('setMypageReview', response.data);
            } catch (error) {
                throw new Error('리뷰 수정 실패');
            }
        },
        // 댓글수정
        async updateComment({ commit }, content) {
            try {
                const response = await axios.post('/api/comment/update', content);
                commit('setMypageComment', response.data);
            } catch (error) {
                throw new Error('댓글 수정 실패');
            }
        },
        // 게시글 삭제
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
        
        // 리뷰삭제
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
        // 댓글삭제
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
        myadverTisement(context) {
            const url = `/api/my/adverTisement`;

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setNewadverTisement', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                console.log(`게시글 획득 실패 (${error.response.data.code})`)
            })
        },


        // getBoardData(context) {
        //     const url = '/api/main';

        //     axios.get(url)
        //     .then(response => {
        //         console.log(response.data); // TODO
        //         context.commit('setBoardData', response.data.data);
        //     })
        //     .catch(error => {
        //         console.log(error.response); // TODO
        //         alert(`게시글 획득 실패 (${error.response.data.code})`)
        //     })
        // },
        // getrankData(context) {
        //     const url = '/api/rank';

        //     axios.get(url)
        //     .then(response => {
        //         console.log(response.data); // TODO
        //         context.commit('setrankdData', response.data.data);
        //     })
        //     .catch(error => {
        //         console.log(error.response); // TODO
        //         alert(`게시글 획득 실패 (${error.response.data.code})`)
        //     })
        // },
        // 메인캠핑러
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
        // 메인캠핑장
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
        // 메인커뮤니티게시글
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
        // 메인 꿀팁
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
        // 메인 추천 캠핑장
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
        // 메인추천 브랜드
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
        commentPageGet(context, { id, page }) {
            const url = `/api/camp/${id}/commentPage?page=${page}`;
            console.log('페이지확인',url);
            axios.get(url)
            .then(response => {
                // const test = response.data.data.links.filter((item, key) => {
                //     return !(key == 0 || key == (response.data.data.links.length - 1));
                // });
                context.commit('setCommentList', response.data.data.data);
                // console.log('data 확인', response.data.data);
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
        detailReviewTap(context,{ id, page }) {
            const url = (`/api/camp/${id}/reviewTap?page=${page}`);
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
        
        communityGet(context, { id, page = 1 }) {
            if (!id) {
            console.error('API 호출 오류: id가 정의되지 않았습니다.'); // 오류 로그 추가
            return;
            }
        
            const url = `/api/community/${id}/communityPage?page=${page}`;
            console.log('API 요청 URL:', url); // 디버깅 로그 추가
        
            axios.get(url)
            .then(response => {
                const data = response.data.data;
                console.log('API 응답 데이터:', data); // 디버깅 로그 추가
                context.commit('setCommunityList', data.data);
                context.commit('setPaginationCommunity', {
                current_page: data.current_page,
                first_page_url: data.first_page_url,
                last_page: data.last_page,
                last_page_url: data.last_page_url,
                total: data.total,
                per_page: data.per_page,
                prev_page_url: data.prev_page_url,
                next_page_url: data.next_page_url,
                links: response.data.links
                });
            })
            .catch(error => {
                console.error('API 호출 오류:', error.response); // 오류 로그 추가
                alert(`communityGet 오류: ${error.response}`);
            });
        },
        
        async communityDetailGet({ commit }, id) {
            try {
                // console.log(`Fetching data for post ID: ${id}`);
                const response = await fetch(`/api/community/post/${id}`);
                const data = await response.json();
                // console.log('Response JSON:', data);
        
                if (response.ok) {
                    console.log('Response OK. Data:', data.data);
                    commit('setCommunityDetail', data.data); // API 응답 데이터가 `data` 속성에 들어있다면 사용
                    return data.data;
                } else {
                    console.error('서버에서 오류가 발생했습니다:', data.message);
                    return null;
                }
            } catch (error) {
                console.error('데이터를 가져오는 중 오류가 발생했습니다.', error);
                return null;
            }
        },
        async commentCommunity({ commit }, pageInfo) {
            try {
                // console.log(`post ID: ${pageInfo.id}`);
                const response = await fetch(`/api/community/comment/post/${pageInfo.id}/communityPage?page=${pageInfo.page}`);
                // console.log('response',response);
                const data = await response.json();
                // console.log('Response JSON:', data);
        
                if (response.ok) {
                    console.log('Response OK. Data:', data.data);
                    commit('setCommentPageGet', data.data);
                    commit('setPaginationComment', {
                        current_page: data.pagination.current_page,
                        first_page_url: data.pagination.first_page_url,
                        last_page: data.pagination.last_page,
                        last_page_url: data.pagination.last_page_url,
                        total: data.pagination.total,
                        per_page: data.pagination.per_page,
                        prev_page_url: data.pagination.prev_page_url,
                        next_page_url: data.pagination.next_page_url,
                        links: data.pagination.links
                    });
                    return data.data;
                } else {
                    console.error('서버에서 오류가 발생했습니다:', data.message);
                    return null;
                }
            } catch (error) {
                console.error('댓글을 가져오는 중 오류가 발생했습니다.', error);
                return null;
            }
        },
        async updateCommunityComment({ commit }, content) {
            try {
                const response = await axios.post(`/api/community/comment/${id}/update`, content);
                commit('setCommentPost', response.data);
            } catch (error) {
                throw new Error('댓글 수정 실패');
            }
        },
        deleteComment(context , content) {
            const url = `/api/community/comment/${id}/delete`;

            axios.delete(url, content)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setCommentPost', response.data.data);
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert(`리뷰 삭제 실패 (${error.response.data.code})`)
            })
        },
        // async commentPost({ commit }, id) {
        //     try {
        //         const response = await fetch(`/api/community/comment/list/${id}`, { // URL 및 메서드 확인 필요
        //             method: 'GET',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //             },
        //         });
        //         const data = await response.json();
        
        //         if (response.ok) {
        //             commit('setCommentPost', data.data);
        //             return data.data;
        //         } else {
        //             console.error('서버에서 오류가 발생했습니다:', data.message);
        //             return null;
        //         }
        //     } catch (error) {
        //         console.error('댓글을 작성 중 오류가 발생했습니다.', error);
        //         return null;
        //     }
        // },
        commentPost(context, payload) {
            const { id, comment } = payload; // payload에서 데이터 추출
            const url = `/api/community/comment/insert/${id}`;
        
            // 데이터 객체를 JSON으로 생성
            const data = {
                community_id: id,
              comment: comment, // 전달받은 comment 값을 사용
            };
        
            console.log('보낼 데이터:', data);
        
            // 서버에 POST 요청 보내기
            axios.post(url, data, {
                headers: {
                'Content-Type': 'application/json', // JSON 형식으로 전송
            },
            })
            .then(response => {
                context.commit('setCommentPost', response.data.data); // 댓글 가장 앞에 추가
            })
            .catch(error => {
                console.error('댓글 작성 실패:', error.response.data);
                alert('댓글 작성 실패: ' + error.response.data.message);
            });
        },


        /**
         * 커뮤니티 게시글 작성
         * 
         * @param {*} context
         */
        
        communityInsert(context, id) {
            const url = `/api/community/${id}`;
            const insertForm = document.querySelector('#insertForm');
            const formData = new FormData(insertForm);
        
            axios.post(url, formData)
            .then(response => {
                context.commit('setUnshiftCommunityData', response.data.data);
                console.log('게시글 작성 완료');
            })
            .catch(error => {
                console.error('게시글 작성 실패:', error.response.data);
                alert('게시글 작성 실패: ' + error.response.data);
            });
        },
        // 커뮤니티 게시글 삭제
        async communityDelete({ commit }, id) {
            try {
                const response = await axios.delete(`/api/posts/delete/${id}`);
                console.log('삭제 성공:', response.data);
                commit('setCommunityList', response.data.data);
            } catch (error) {
                console.error('삭제 실패:', error.response.data);
                throw error;
            }
        },


        /**
         * 조회수 증가
         * 
         * @param {*} context 
         * @param {*} communityId 
         */
        async communityViews({ commit }, id) {
            try {
                const response = await axios.post(`/api/community/increase-view/${id}`);
                console.log('조회수+1 성공:', response.data);
                commit('setCommunityList', response.data.data);
            } catch (error) {
                console.error('조회수 증가 실패:', error.response.data);
                throw error;
            }
        },

        /**
         * 게시글 수정 처리
         * @param {*} context 
         */
        // communityUpdate(context) {
        //     const url = '/api/community';
        //     const updateTitle = document.querySelector('#detail-modal-title');
        //     const updateContent = document.querySelector('#detail-modal-content');
        // },

        // 캠핑장 상세페이지 get 
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

        /**
         * 캠핑장 데이터 획득
         * 
         * @param {*} context 
         */
        // campListGet(context, {page=1, state=0, county=0, caravan=false, }) {
        campListGet(context, inputData) {
            // const url = ('/api/search/searchPage?page=' + page);
            const url = ('/api/search');
            console.log( "\u001b[1;36m campListGet", url);

            const config = {
                params: inputData
            }
            axios.get(url, config)
            .then(response => {

                const campList = response.data.data;
                context.commit('setCampList', campList);
                // const data = response.data.data;
                // context.commit('setCampList', response.data.data);
                // console.log(response.data.data);
                // console.log(setCampList);
                console.log('store 캠프리스트', campList);
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
                if (campList.data.length > 0) {
                    // console.log('titletitle', campList.data.name);
                    const newCenter = {
                        lat: campList.data[0].latitude,
                        lng: campList.data[0].longitude,
                    }
                    
                    // console.log('campList[0].name', campList.data[0].name);
                    context.commit('updateMapCenter', newCenter);
                    console.log('\u001b[1;36m 중심 좌표 업데이트', newCenter);
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
            })
            .catch(error => {
                alert('state 획득 실패' + error.response.data);
            })
        },

        /**
         * 군/구 데이터 획득
         * @param {*} context 
         */
        countyGet(context ,id) {
            const url = `/api/county/${id}`;

            axios.get(url)
            .then(response => {
                context.commit('setCountyData', response.data.data);
                console.log('군구store',response.data.data);
            })
            .catch(error => {
                alert('county 획득 실패' + error.response.data);
            })
        },


        /**
         * 검색 결과 획득
         * 
         * @param {*} context 
         */
        searchResult(context) {
            console.log('searchResult Start');

            const url = ('/api/search');
            console.log( "\u001b[1;35m searchResult", url);

            const reqData = {
                params: context.state.localInfo
            };

            axios.get(url, reqData)
            .then(response => {
                const responseData = response.data.data;
                console.log('\u001b[1;35m 검색 결과 획득 성공', responseData);

                context.commit('setCampList', responseData);
                console.log('store 캠프데이터', context.state.campData);
                
                // 정렬
                

                if (context.state.campData.length > 0) {
                    const newCenter = {
                        lat: context.campData[0].latitude,
                        lng: context.campData[0].longitude
                    }
                    context.commit('updateMapCenter', newCenter);
                    console.log('지도 중심 좌표 업데이트', newCenter);
                }
            })
            .catch(error => {
                console.error('검색 결과 획득 실패', error.response);
                alert('검색 오류');
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
                        console.log('\u001b[1;34m 유저 좌표', position.coords.latitude, position.coords.longitude);
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
                console.log('스탬프정보',response.data.data[0]);
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
            },

        // 관리자페이지 로그인
        async adminLogin({ commit }, loginForm) {
            try {
                const response = await axios.post('/api/adminLogin', loginForm);
                commit('setAuthFlg', true);
                commit('setUserInfo', response.data.data);
                router.push('/dashboard');
                return response;
            } catch (error) {
                throw error;
            }
        },

        // 관리자페이지 신규유저
        setNewMember(context) {
            const url = '/api/Homepage/newmember';

            axios.get(url)
                .then(response => {
                    context.commit('setNewMember', response.data.data);
                    console.log(response.data.data);
                })
                .catch(error => {
                    console.log(`신규유저 획득 실패 (${error.response.data.code})`);
                    // console.log(response.data.data);
                });
        },

        // 관리자페이지 - 유저탈퇴
        deleteUser({ commit }, userId) {
            return axios.post(`/api/users/${userId}/delete`)
                .then(() => {
                    commit('removeMember', userId);
                    alert('사용자가 탈퇴되었습니다.');
                    location.reload();
                })
                .catch(error => {
                    console.error('사용자 탈퇴 중 에러 발생:', error);
                    alert('사용자 탈퇴 중 에러가 발생했습니다.');
                });
        },

        userManagement(context) {
            const url = '/api/Homepage/userManagement';

            axios.get(url)
                .then(response => {
                    context.commit('setUserManagement', response.data.data);
                    console.log(response.data.data);
                })
                .catch(error => {
                    console.log(`신규유저 획득 실패 (${error.response.data.code})`);
                    // console.log(response.data.data);
                });
        },
        async updateAdvertisement(context, formData) {
            try {
              const url = '/api/Homepage/updateAdvertisement';
              const response = await axios.post(url, formData); // POST 요청으로 데이터 전송
      
              context.commit('setAdminAdvertisement', response.data.data);
              console.log('광고 수정 성공');
            } catch (error) {
              console.error(`광고 수정 실패 (${error.response.data.code})`);
              throw error; // 실패 시 예외 처리
            }
          },
          async cancelAdvertisement(context, id) {
            try {
              const url = '/api/Homepage/cancelAdvertisement';
              const response = await axios.delete(url, {
                data: { id }  // DELETE 요청의 경우 데이터는 'data' 속성에 객체 형태로 전달해야 함
              });
          
              context.commit('setAdminAdvertisement', response.data.data);
              console.log('광고 취소 성공');
            } catch (error) {
              console.error(`광고 취소 실패 (${error.response.data.code})`);
              throw error; 
            }
          },
          
        async fetchAdvertisements({ commit }, adType) {
            try {
              const response = await axios.get('/api/Homepage/advertiseManagement', {
                params: { ad_type: adType }
              });
              commit('setadminAdverTisement', response.data);
            //   console.log(response.data.data);
            } catch (error) {
              console.error('광고 데이터를 가져오는 도중 에러 발생:', error);
            }
          },
        async advertisements({ commit }, adType) {
            try {
              const response = await axios.get('/api/Homepage/advertiseAdd', {
                params: { ad_type: adType }
              });
              commit('setadminAdverTise', response.data);
            //   console.log(response.data.data);
            } catch (error) {
              console.error('광고 데이터를 가져오는 도중 에러 발생:', error);
            }
          },
        
        // 광고신청
        adverTisement(context) {
            const url = '/api/submitAd';

            axios.get(url)
                .then(response => {
                    context.commit('setNewadverTisement', response.data.data);
                    // console.log(response.data.data);
                })
                .catch(error => {
                    console.log(`신규유저 획득 실패 (${error.response.data.code})`);
                    // console.log(response.data.data);
                });
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