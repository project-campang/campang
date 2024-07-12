<template>
    <div class="admin-page">
      <div class="content">
        <div class="header">
          <h2>광고 게시 관리</h2>
        </div>
        <div class="search-section">
          <div class="search-bar">
            <label for="adType">광고 유형:</label>
            <select id="adType" v-model="selectedAdType">
              <option value="0">업소</option>
              <option value="1">브랜드</option>
            </select>
            <button class="btn btn-primary" @click="searchAds">검색</button>
          </div>
          <div class="summary">
            <p>총 : 000개 진행중: 000개 만료: 000개 취소요청: 000개</p>
          </div>
        </div>
        <div class="table-section">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>번호</th>
                <th>광고 번호</th>
                <th>사업장명</th>
                <th>광고 기간</th>
                <th>결제(예정)금액</th>
                <th>상태</th>
                <th>관리</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in $store.state.adminAdverTisement" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ item.id }}</td>
                <td>{{ item.title }}</td>
                <td>{{ item.start_date + ' ~ ' + item.end_date }}</td>
                <td>{{ formatCurrency(item.amount) }}</td>
                <td>{{  item.status === '1' ? '접수' : item.status === '2' ? '대기' : item.status === '3' ? '완료' : '상태 없음' }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    수정
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    취소
                    </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  </template>
  
  <script setup>
  import { ref, onBeforeMount } from 'vue';
  import { useStore } from 'vuex';

const selectedAdType = ref('0');  
const store = useStore();
// const router = useRouter();
  
  // const selectedAdType = ref('');

  onBeforeMount(async () => {
    await searchAds();
    // try {
    //     await store.dispatch('advertiseManagement');
    //     console.log('유저 정보:', adminAdverTisement.value); // 데이터 확인
    // } catch (error) {
    //     console.error('유저 정보를 가져오는 도중 에러 발생:', error);
    // }
});

async function searchAds() {
  try {
    await store.dispatch('fetchAdvertisements', selectedAdType.value);
  } catch (error) {
    console.error('광고를 검색하는 도중 에러 발생:', error);
  }
}

function formatCurrency(value) {
  return new Intl.NumberFormat('ko-KR').format(value) + '원';
}
  

  </script>
  
  <style scoped>
  
  </style>
  
<style scoped src="../css/admin.css"></style>