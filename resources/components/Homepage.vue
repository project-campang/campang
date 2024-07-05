<template>
    <div>
      <h2>새로운 요청</h2>
      <div class="request-section">
        <div class="request-box">
          <p>캠핑장등록</p>
          <p>0 건</p>
        </div>
        <div class="request-box">
          <p>광고 신청</p>
          <p>1 건</p>
        </div>
        <div class="request-box">
          <p>예약환불 신청</p>
          <p>0 건</p>
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
        <li v-for="(user, index) in users" :key="index" class="user-item">
          <span>{{ user.id }}</span>
          <span>{{ user.type }}</span>
          <span>{{ user.email }}</span>
          <span>{{ user.name }}</span>
          <span>{{ user.nickname }}</span>
          <span>{{ user.phone }}</span>
          <span>{{ user.posts }}</span>
          <span>{{ user.status }}</span>
          <div class="actions">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                보기
            </button>
            <button class="btn btn-danger btn-sm">탈퇴</button>
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
        <div class="home-user-modal">
            <p>유져ID: 11223</p>
            <p>이메일: asdf@asdf.com</p>
            <p>유형: 일반</p>
            <p>이름: 김누구</p>
            <p>전화번호: 010-0000-0000</p>
            <p>전체 게시글: 1,500개</p>
            <p>총 예약횟수: 10 회</p>
            <p>캠핑장 등록 겟수: 0회</p>
            <p>프로필사진: 807807.png</p>
            <p>닉네임: 김누구셈</p>
            <p>전체 댓글: 100개</p>
            <p>예약 환불 횟수: 1회</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-danger">탈퇴</button>
      </div>
    </div>
  </div>
</div>
</template>
  
  <script setup>
  import { ref } from 'vue';
  
  const users = ref([
    { id: 1, type: '일반', email: 'user1@example.com', name: '이름1', nickname: '닉네임1', phone: '010-0000-0000', posts: 1, status: '정상' },
    { id: 2, type: '일반', email: 'user2@example.com', name: '이름2', nickname: '닉네임2', phone: '010-0000-0001', posts: 2, status: '정상' },
    { id: 3, type: '사업자', email: 'user3@example.com', name: '이름3', nickname: '닉네임3', phone: '010-0000-0002', posts: 3, status: '정상' },
    { id: 4, type: '일반', email: 'user4@example.com', name: '이름4', nickname: '닉네임4', phone: '010-0000-0003', posts: 4, status: '정상' },
    { id: 5, type: '사업자', email: 'user5@example.com', name: '이름5', nickname: '닉네임5', phone: '010-0000-0004', posts: 5, status: '정상' },
  ]);
  </script>
  
  <style scoped src="../css/admin.css"></style>
  