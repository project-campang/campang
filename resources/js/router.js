import { createWebHistory, createRouter } from 'vue-router';
import store from './store';




import MainComponent from '../components/MainComponent.vue';
import CommunityComponent from '../components/CommunityComponent.vue';
import CampComponent from '../components/CampComponent.vue';
import SearchComponent from '../components/SearchComponent.vue';
import KakaoCallback from '../components/KakaoCallback.vue';
import ReservationComponent from '../components/ReservationComponent.vue';
import MypageComponent from '../components/MypageComponent.vue';

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
        path: "/community/:type",
        component: CommunityComponent,
        props: true,  // props로 :type을 전달받을 수 있도록 설정
        children: [
            {
                path: 'communityPage',
                name: 'CommunityPage',
                component: CommunityPage,
                props: true,  // props로 페이지 번호를 전달받을 수 있도록 설정
            }
        ]
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
        path: "/oauth/kakao",
        component:KakaoCallback,
    },
    {
        path: "/camp/reserve",
        component:ReservationComponent,
        beforeEnter: chkAuth,
    },
    
];

function chkAuth(to, from, next) {
    if(store.state.authFlg) {
        next();
    } else {
        alert('로그인이 필요한 서비스입니다.');
        next('/main');
    }
}

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;