<template>
    <div class="admin-page">
      <div class="content">
        <div class="header">
          <h2>광고 관리</h2>
        </div>
        <div class="search-section">
          <div class="search-bar">
            <label for="adType">광고 유형:</label>
            <select id="adType" v-model="selectedAdType">
              <option value="브랜드">브랜드</option>
              <option value="업소">업소</option>
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
                <th>유형</th>
                <th>이메일</th>
                <th>사업장명</th>
                <th>광고기간</th>
                <th>결제(예정)금액</th>
                <th>상태</th>
                <th>관리</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(ad, index) in ads" :key="index">
                <td>{{ ad.type }}</td>
                <td>{{ ad.email }}</td>
                <td>{{ ad.businessName }}</td>
                <td>{{ ad.adPeriod }}</td>
                <td>{{ ad.payment }}</td>
                <td>{{ ad.status }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    관리
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
  import { ref } from 'vue';
  
  const selectedAdType = ref('');
  const ads = ref([
    { type: '브랜드', email: 'as@as.com', businessName: '캠핑장', adPeriod: '24-01-01 ~ 24-04-01 (3M)', payment: '100', status: '진행전' },
    { type: '업소', email: 'as@as.com', businessName: '캠핑모닥', adPeriod: '24-01-01 ~ 24-04-01 (3M)', payment: '50,000', status: '중단처리' },
    // 다른 광고 데이터 추가
  ]);
  
  function searchAds() {
    // 광고 검색 기능 추가
  }
  </script>
  
  <style scoped>
  
  </style>
  
<style scoped src="../css/admin.css"></style>