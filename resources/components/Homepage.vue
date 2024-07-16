<template>

  <div>
    <h2>새로운 요청</h2>
    <div class="request-section">
      <!-- <div class="request-box">
        <p>캠핑장 등록</p>
        <p v-if="newCampgroundRegistrationCount !== null">{{ newCampgroundRegistrationCount }} 건</p>
        <p v-else>Loading...</p>
      </div> -->
      <div class="request-box">
        <p>광고 신청</p>
        <p class="text-danger">{{ getStatusCount('1') }}건</p>
        <!-- <p v-if="newAdvertisementRequestCount !== null">{{ newAdvertisementRequestCount }} 건</p> -->
        <!-- <p v-else>Loading...</p> -->
      </div>
    </div>
  </div>

    <h2>최근 가입내역 5건</h2>
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
    <ul class="user-list">
      <li v-for="(item, key) in store.state.newmember" :key="key" class="user-item">
        <span class="aggroL">{{ item.id }}</span>
        <span class="aggroL">{{ item.business === '0' ? '일반' : '사업자' }}</span>
        <span class="home-email aggroL">{{ item.email }}</span>
        <span class="aggroL">{{ item.name }}</span>
        <span class="aggroL">{{ item.nick_name }}</span>
        <span class="aggroL">{{ item.tel }}</span>
        <span class="aggroL">{{ item.post_count }}</span>
        <span class="aggroL">{{ item.deleted_at ? '탈퇴' : '정상' }}</span>
        <div class="actions">
          <button 
              type="button" 
              class="btn btn-outline-primary btn-sm m-1 aggroL" 
              data-bs-toggle="modal" 
              data-bs-target="#exampleModal"
              @click="showUserDetails(item)"
          >
              보기
          </button>
          <button v-if="!item.deleted_at" class="btn btn-outline-danger btn-sm m-1 aggroL" @click="confirmDeleteUser(item)">탈퇴</button>
        </div>
      </li>
    </ul>


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
import { ref, onBeforeMount, computed } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const newMembers = ref([]);
const selectedUser = ref(null);

// 신규 캠핑장 등록 건수 계산
// const newCampgroundRegistrationCount = computed(() => {
//   if (!store.state.searchResult) return null;

//   return store.state.searchResult.filter(item => {
//     const createdAt = new Date(item.created_at);
//     const today = new Date();
//     const sevenDaysAgo = new Date(today.setDate(today.getDate() - 7));
//     return createdAt >= sevenDaysAgo;
//   }).length;
// });

// 광고 신청 건수 계산
const newAdvertisementRequestCount = computed(() => {
  if (!store.state.adminAdverTisement) return null;
  console.log('신규광고',store.state.adminAdverTisement);

  return store.state.adminAdverTisement.filter(item => {
    const createdAt = new Date(item.created_at);
    const today = new Date();
    const sevenDaysAgo = new Date(today.setDate(today.getDate() - 7));
    return createdAt >= sevenDaysAgo;
  }).length;
});

function getStatusCount(status) {
  return store.state.adminAdverTisement.filter(item => item.status === status).length;
}
onBeforeMount(() => {

  store.dispatch('setNewMember')
    .then(() => {
      newMembers.value = store.state.newmember;
    })
    .catch((error) => {
      console.error('신규 유저를 가져오는 도중 에러 발생:', error);
    });

    if(store.state.adminAdverTisement.length < 1 ) {
        store.dispatch('fetchAdvertisements');
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
</script>

<style scoped src="../css/admin.css"></style>
