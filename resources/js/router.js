import { createWebHistory, createRouter } from 'vue-router';
import store from './store';




import MainComponent from '../components/MainComponent.vue';

const routes = [
		{
            path: '/',
            components: MainComponent,
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