<template>
  <div>
    <h2>유저 관리</h2>
    <input type="text" v-model="filterText" placeholder="유저 검색" class="search-input"/>
    <!-- 테이블 헤더를 대체하는 요소 -->
    <div class="user-list-header">
      <span>ID</span>
      <span>유형</span>
      <span>이메일</span>
      <span>이름</span>
      <span>닉네임</span>
      <span>전화번호</span>
      <span>전체 게시글</span>
      <span>상태</span>
      <span>관리</span>
    </div>
    <!-- 유저 목록을 필터링하여 보여주는 부분 -->
    <ul class="user-list">
      <li v-if="filterText" v-for="(item, key) in filteredUsers" :key="key" class="user-item">
        <span>{{ item.id }}</span>
        <span>{{ item.business === '0' ? '일반' : '사업자' }}</span>
        <span class="home-email">{{ item.email }}</span>
        <span>{{ item.name }}</span>
        <span>{{ item.nick_name }}</span>
        <span>{{ item.tel }}</span>
        <span>{{ item.post_count }}</span>
        <span>{{ item.deleted_at ? '탈퇴' : '정상' }}</span>
        <div class="actions">
          <button 
              type="button" 
              class="btn btn-primary btn-sm" 
              data-bs-toggle="modal" 
              data-bs-target="#exampleModal"
              @click="showUserDetails(item)"
          >
              보기
          </button>
          <button v-if="!item.deleted_at" class="btn btn-danger btn-sm" @click="confirmDeleteUser(item)">탈퇴</button>
        </div>
      </li>
      <!-- 검색어가 없을 때 전체 유저 목록을 보여주는 부분 -->
      <li v-else v-for="(item, index) in store.state.usermanagement" :key="index" class="user-item">
        <span>{{ item.id }}</span>
        <span>{{ item.business === '0' ? '일반' : '사업자' }}</span>
        <span class="home-email">{{ item.email }}</span>
        <span>{{ item.name }}</span>
        <span>{{ item.nick_name }}</span>
        <span>{{ item.tel }}</span>
        <span>{{ item.post_count }}</span>
        <span>{{ item.deleted_at ? '탈퇴' : '정상' }}</span>
        <div class="actions">
          <button 
              type="button" 
              class="btn btn-primary btn-sm" 
              data-bs-toggle="modal" 
              data-bs-target="#exampleModal"
              @click="showUserDetails(item)"
          >
              보기
          </button>
          <button v-if="!item.deleted_at" class="btn btn-danger btn-sm" @click="confirmDeleteUser(item)">탈퇴</button>
        </div>
      </li>
    </ul>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">유저정보</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="home-user-modal" v-if="selectedUser">
            <p><span class="label">유저ID:</span> {{ selectedUser.id }}</p>
            <p><span class="label">이메일:</span> {{ selectedUser.email }}</p>
            <p><span class="label">유형:</span> {{ selectedUser.business === '1' ? '일반' : '사업자' }}</p>
            <p><span class="label">이름:</span> {{ selectedUser.name }}</p>
            <p><span class="label">전화번호:</span> {{ selectedUser.tel }}</p>
            <p><span class="label">전체 게시글:</span> {{ selectedUser.post_count }}</p>
            <!-- <p><span class="label">총 예약횟수:</span> {{ selectedUser.reservations }}</p> -->
            <!-- <p><span class="label">캠핑장 등록 횟수:</span> {{ selectedUser.camps }}</p> -->
            <p><span class="label">프로필사진:</span> {{ selectedUser.profile }}</p>
            <p><span class="label">닉네임:</span> {{ selectedUser.nick_name }}</p>
            <p><span class="label">전체 댓글:</span> {{ selectedUser.comment_count }}</p>
            <!-- <p><span class="label">예약 환불 횟수:</span> {{ selectedUser.refunds }}</p> -->
            <p><span class="label">상태:</span> {{ selectedUser.deleted_at ? '탈퇴' : '정상' }}</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
          <button type="button" class="btn btn-danger" v-if="selectedUser && !selectedUser.deleted_at" @click="confirmDeleteUser(selectedUser)">탈퇴</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onBeforeMount } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const userManagement = ref([]); // 배열로 초기화
const selectedUser = ref(null);
const filterText = ref('');

onBeforeMount(async () => {
    try {
        await store.dispatch('userManagement');
        userManagement.value = store.state.usermanagement; // 데이터 할당
        console.log('유저 정보:', userManagement.value); // 데이터 확인
    } catch (error) {
        console.error('유저 정보를 가져오는 도중 에러 발생:', error);
    }
});

const showUserDetails = (user) => {
    selectedUser.value = user;
};

const confirmDeleteUser = (user) => {
    if (confirm(`${user.name}님을 탈퇴시키겠습니까?`)) {
        store.dispatch('deleteUser', user.id);
    }
};

// 검색어를 기준으로 유저 목록을 필터링하는 computed 프로퍼티
const filteredUsers = computed(() => {
  const text = filterText.value.toLowerCase().trim();
  if (!text) {
    // 검색어가 없을 때는 전체 유저 목록 반환
    return userManagement.value;
  } else {
    // 검색어를 포함하는 유저를 필터링하여 반환
    return userManagement.value.filter(user => {
      return (
        user.id.toString().toLowerCase().includes(text) ||
        user.email.toLowerCase().includes(text) ||
        user.name.toLowerCase().includes(text) ||
        user.nick_name.toLowerCase().includes(text) ||
        user.tel.toLowerCase().includes(text)
      );
    });
  }
});

</script>

<style scoped src="../css/admin.css"></style>