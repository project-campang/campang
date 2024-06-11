require('./bootstrap');

import { createApp } from 'vue';
import { useKakao } from 'vue3-kakao-maps/@utils';
import AppComponent from '../components/AppComponent.vue';
import store from './store';
import router from './router';

useKakao('bd3ac557aa53da759b1a9d8a5d63dca8');

createApp({
    components: {
        AppComponent,
    }
})
.use(store)
.use(router)
.mount('#app');