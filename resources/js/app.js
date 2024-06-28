require('./bootstrap');

import { createApp } from 'vue';
import { useKakao } from 'vue3-kakao-maps/@utils';
import AppComponent from '../components/AppComponent.vue';
import { library } from '@fortawesome/fontawesome-svg-core';
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import store from './store';
import router from './router';

useKakao('bd3ac557aa53da759b1a9d8a5d63dca8'); // 기본 appkey
// useKakao('c9c4e0fd6dc8fd56d1a304d70da78238'); // 비상시 appkey

createApp({
    components: {
        AppComponent,
    }
})
.use(store)
.use(router)
.mount('#app');

library.add(
    fas, far, fab,
)

// const app = createApp({
//     components: {
//         AppComponent,
//     }
// })

// app.component('font-awesome-icon', FontAwesomeIcon);
// app.use(store);
// app.use(router);

// library.add(
//     fas, far, fab,
// )

// app.mount('#app');