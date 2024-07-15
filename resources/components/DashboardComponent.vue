
<template>
    <div class="admin-header">
        <h2>Campang</h2>
        <p>administrator Page</p>
        <button class="btn btn-secondary" @click.prevent="logout">로그아웃</button>
        <h2 class="text-end">{{ adminName }}님 반갑습니다</h2>
    </div>
    <div class="admin-container">
      <nav class="sidebar">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('home')">홈</a>
          </li>
          <li class="nav-item">
            <!-- <a href="#" class="nav-link" @click.prevent="selectPage('reservation')">예약관리</a> -->
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('users')">유저관리</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('advertisement')">광고 요청 관리</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('posts')">광고 게시 관리</a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('camping')">캠핑장관리</a>
          </li> -->
        </ul>
      </nav>
      <div class="content">
        <div v-if="selectedPage === 'home'">
          <Homepage />
        </div>
        <!-- <div v-if="selectedPage === 'reservation'">
          <ReservationManagement />
        </div> -->
        <div v-if="selectedPage === 'users'">
          <UserManagement />
        </div>
        <div v-if="selectedPage === 'advertisement'">
          <AdvertisementManagement />
        </div>
        <div v-if="selectedPage === 'posts'">
          <PostManagement />
        </div>
        <div v-if="selectedPage === 'camping'">
          <CampingManagement />
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { computed } from 'vue';
  import { useStore } from 'vuex';
  import { useRouter } from 'vue-router';

  import Homepage from '../components/Homepage.vue';
  import ReservationManagement from '../components/ReservationManagement.vue';
  import AdvertisementManagement from '../components/AdvertisementManagement.vue';
  import UserManagement from '../components/UserManagement.vue';
  import PostManagement from '../components/PostManagement.vue';
  import CampingManagement from '../components/CampingManagement.vue';


const store = useStore();
const router = useRouter();

const adminName = computed(() => {
  const userInfo = store.state.userInfo;
  return userInfo ? userInfo.username : 'Guest';
});
  
  // 선택된 페이지 상태
  const selectedPage = ref('home');
  
  // 페이지 선택 함수
  function selectPage(page) {
    selectedPage.value = page;
  }

// 로그아웃 처리 함수
function logout() {
    store.dispatch('logout')
        .then(() => {
          router.replace('/admin');
        })
        .catch(error => {
            console.error('로그아웃 실패:', error);
        });
}
  </script>
  
  <style scoped src="../css/admin.css"></style>
  