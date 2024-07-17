<template>
    <div class="admin-page">
      <div class="content">
        <div class="header">
          <h2>환불 요청</h2>
        </div>
        <div class="search-section">
          <div class="search-bar">
            <label for="region">지역:</label>
            <select id="region" v-model="selectedRegion">
              <option value="시/도">시/도</option>
              <!-- 지역 옵션 추가 -->
            </select>
            <label for="date">검색:</label>
            <input type="text" id="date" v-model="searchQuery" placeholder="날짜 입력" />
            <button class="btn btn-primary" @click="searchRefunds">검색</button>
          </div>
          <div class="summary">
            <p>총 예약: 000개 환불: 000개 취소/환불: 000개</p>
          </div>
        </div>
        <div class="table-section">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>유저ID</th>
                <th>사업장명</th>
                <th>예약일</th>
                <th>예약자명</th>
                <th>전화번호</th>
                <th>상태</th>
                <th>관리</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(refund, index) in refunds" :key="index">
                <td class="admin-list">{{ refund.userId }}</td>
                <td class="admin-list">{{ refund.businessName }}</td>
                <td class="admin-list">{{ refund.reservationDate }}</td>
                <td class="admin-list">{{ refund.customerName }}</td>
                <td class="admin-list">{{ refund.phoneNumber }}</td>
                <td class="admin-list">{{ refund.status }}</td>
                <td>
                  <button class="btn btn-primary btn-sm">관리</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const selectedRegion = ref('');
  const searchQuery = ref('');
  const refunds = ref([
    { userId: 1, businessName: '어디캠핑장', reservationDate: '24-01-01 ~ 24-04-01 (3M)', customerName: '김누구', phoneNumber: '010-1000-0000', status: '예약확정' },
    { userId: 2, businessName: '어디캠핑장', reservationDate: '24-01-01 ~ 24-04-01 (3M)', customerName: '김누구', phoneNumber: '010-1000-0000', status: '완료' },
    // 다른 환불 요청 데이터 추가
  ]);
  
  function searchRefunds() {
    // 검색 기능 추가
  }
  </script>
  
<style scoped src="../css/admin.css"></style>