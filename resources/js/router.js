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
import AdminComponent from '../components/AdminComponent.vue';
import DashboardComponent from '../components/DashboardComponent.vue';
import Homepage from '../components/Homepage.vue';
import ReservationManagement from '../components/ReservationManagement.vue';
import AdvertisementManagement from '../components/AdvertisementManagement.vue';
import UserManagement from '../components/UserManagement.vue';

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
    // 관리자 라우터
    {
        path: "/admin",
        component:AdminComponent,
    },
    {
        path: "/dashboard",
        component:DashboardComponent,
        beforeEnter: chkAdmin,
    },
    {
        path: "/Homepage",
        component:Homepage,
        beforeEnter: chkAdmin,
    },
    {
        path: "/ReservationManagement",
        component:ReservationManagement,
        beforeEnter: chkAdmin,
    },
    {
        path: "/AdvertisementManagement",
        component:AdvertisementManagement,
        beforeEnter: chkAdmin,
    },
    {
        path: "/UserManagement",
        component:UserManagement,
        beforeEnter: chkAdmin,
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
// 관리자
function chkAdmin(to, from, next) {
    if (store.state.authFlg) {
        next();
    } else {
        alert('로그인이 필요한 서비스입니다.');
        next('/admin');
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
