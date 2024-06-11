import { createWebHistory, createRouter } from 'vue-router';
import store from './store';




import MainComponent from '../components/MainComponent.vue';
import CommunityComponent from '../components/CommunityComponent.vue';
import CampComponent from '../components/CampComponent.vue';
import SearchComponent from '../components/SearchComponent.vue';

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
        path: "/community",
        component: CommunityComponent,
    },
    {
        path: "/camp",
        component: CampComponent,
    },
    {
        path: "/search",
        component: SearchComponent,
    },
     
];

// function chkAuth(to, from, next) {
//     if(store.state.authFlg) {
//         next();
//     } else {
//         alert('로그인이 필요한 서비스입니다.');
//         next('/login');
//     }
// }

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;