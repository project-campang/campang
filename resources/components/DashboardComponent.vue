
<template>
    <div class="admin-header">
        <h2>Campang</h2>
        <p>administrator Page</p>
    </div>
    <div class="admin-container">
      <nav class="sidebar">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('home')">홈</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('reservation')">예약관리</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('advertisement')">광고관리</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('users')">유저관리</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('posts')">게시글관리</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" @click.prevent="selectPage('camping')">캠핑장관리</a>
          </li>
        </ul>
      </nav>
      <div class="content">
        <div v-if="selectedPage === 'home'">
          <Homepage />
        </div>
        <div v-if="selectedPage === 'reservation'">
          <ReservationManagement />
        </div>
        <div v-if="selectedPage === 'advertisement'">
          <AdvertisementManagement />
        </div>
        <!-- <div v-if="selectedPage === 'users'">
          <UserManagement />
        </div>
        <div v-if="selectedPage === 'posts'">
          <PostManagement />
        </div>
        <div v-if="selectedPage === 'camping'">
          <CampingManagement />
        </div> -->
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import Homepage from '../components/Homepage.vue';
  import ReservationManagement from '../components/ReservationManagement.vue';
  import AdvertisementManagement from '../components/AdvertisementManagement.vue';
//   import UserManagement from '../components/UserManagement.vue';
//   import PostManagement from '../components/PostManagement.vue';
//   import CampingManagement from '../components/CampingManagement.vue';
  
  // 선택된 페이지 상태
  const selectedPage = ref('home');
  
  // 페이지 선택 함수
  function selectPage(page) {
    selectedPage.value = page;
  }
  </script>
  
  <style scoped src="../css/admin.css"></style>
  