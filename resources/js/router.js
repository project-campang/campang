import { createWebHistory, createRouter } from 'vue-router';
import store from './store';

// 컴포넌트 임포트
import MainComponent from '../components/MainComponent.vue';
import CommunityComponent from '../components/CommunityComponent.vue';
import CommunityDetail from '../components/CommunityDetail.vue';
import CampComponent from '../components/CampComponent.vue';
import SearchComponent from '../components/SearchComponent.vue';
import KakaoCallback from '../components/KakaoCallback.vue';
import ReservationComponent from '../components/ReservationComponent.vue';
import MypageComponent from '../components/MypageComponent.vue';
import FaqComponent from '../components/FaqComponent.vue';
import NotFound from '../components/NotFound.vue';

const routes = [
    {
        path: "/",
        redirect: "/main",
    },
    {
        path: "/main",
        component: MainComponent,
    },
    {
        path: '/community/:id',
        component: CommunityComponent,
        name: 'Community'
    },    
    {
        path: '/community/detail/:id',
        name: 'CommunityDetail',
        component: CommunityDetail,
    },  
    {
        path: "/mypage",
        component: MypageComponent,
        beforeEnter: chkAuth,
    },
    {
        path: "/camp/:id",
        component: CampComponent,
    },
    {
        path: "/search",
        component: SearchComponent,
    },
    {
        path: '/kakao/callback',
        component:KakaoCallback,
    },
    {
        path: "/camp/reserve",
        component:ReservationComponent,
        beforeEnter: chkAuth,
    },
    {
        path: "/faq",
        component:FaqComponent,
    },
    {
        path: '/:pathMatch(.*)*', 
        name: 'NotFound',
        component: NotFound
    },
];

// 로그인 체크 함수
function chkAuth(to, from, next) {
    if (store.state.authFlg) {
        next();
    } else {
        alert('로그인이 필요한 서비스입니다.');
        next('/main');
    }
}

// Vue Router 생성
const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        // 스크롤 위치를 최상단으로 설정
        return { top: 0 };
    }
});

export default router;
