<template>
    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <router-link to="/" class="navbar-brand my-logo-img"></router-link>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">캠핑장 모아보기 |</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  캠핑Talk 
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">가입인사</a></li>
                  <li><a class="dropdown-item" href="#">자유게시판</a></li>
                  <li><a class="dropdown-item" href="#">랭킹</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">리뷰 모아보기</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">FAQ</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <div v-if="!$store.state.authFlg">
                <button @click.prevent="openLogin" class="btn btn-outline-success me-2">로그인</button>
                <button @click.prevent="openRegistration" class="btn btn-outline-success me-2">가입하기</button>
              </div>
              <div v-else>
                <button @click.prevent="logout" class="btn btn-outline-success">로그아웃</button>
              </div>
            </form>
          </div>
        </div>
      </nav>
    </header>
  
    <!-- loginModal -->
    <div v-show="loginFlg" class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="loginModalLabel">로그인</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="loginEmail" class="form-label">이메일</label>
                <input type="email" class="form-control" id="loginEmail">
              </div>
              <div class="mb-3">
                <label for="loginPassword" class="form-label">비밀번호</label>
                <input type="password" class="form-control" id="loginPassword">
              </div>
              <div class="mb-3">
                <p>혹시 가입한 적 없으신가요?</p>
                <a href="#" @click.prevent="goToRegistration">회원가입하러가기</a>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button @click="closeLogin" type="button" class="btn btn-secondary">취소</button>
            <button type="button" class="btn btn-primary">로그인</button>
          </div>
        </div>
      </div>
    </div>
  
    <!-- registrationModal -->
    <div v-show="registrationFlg" class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="registrationModalLabel">회원가입</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="regName" class="form-label">이름</label>
                <input type="text" class="form-control" id="regName">
              </div>
              <div class="mb-3">
                <label for="regEmail" class="form-label">이메일</label>
                <input type="email" class="form-control" id="regEmail">
              </div>
              <div class="mb-3">
                <button type="button" class="btn btn-outline-secondary">이메일 중복 확인</button>
              </div>
              <div class="mb-3">
                <label for="regNickname" class="form-label">닉네임</label>
                <input type="text" class="form-control" id="regNickname">
              </div>
              <div class="mb-3">
                <label for="regPassword" class="form-label">비밀번호</label>
                <input type="password" class="form-control" id="regPassword">
              </div>
              <div class="mb-3">
                <label for="regConfirmPassword" class="form-label">비밀번호 확인</label>
                <input type="password" class="form-control" id="regConfirmPassword">
              </div>
              <div class="mb-3">
                <label for="regPhone" class="form-label">휴대폰 번호</label>
                <input type="text" class="form-control" id="regPhone">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button @click="closeRegistration" type="button" class="btn btn-secondary">취소</button>
            <button type="button" class="btn btn-primary">회원가입</button>
          </div>
        </div>
      </div>
    </div>
  
    <main>
      <router-view></router-view>
    </main>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useStore } from 'vuex';
  
  // 로그인 모달 상태 및 인스턴스
  const loginFlg = ref(false);
  let loginModal;
  
  // 회원가입 모달 상태 및 인스턴스
  const registrationFlg = ref(false);
  let registrationModal;
  
  const store = useStore();
  
  onMounted(() => {
    const loginModalElement = document.getElementById('loginModal');
    if (loginModalElement) {
      import('bootstrap').then(({ Modal }) => {
        loginModal = new Modal(loginModalElement);
      }).catch(err => {
        console.error('Bootstrap Modal import error:', err);
      });
    }
  
    const registrationModalElement = document.getElementById('registrationModal');
    if (registrationModalElement) {
      import('bootstrap').then(({ Modal }) => {
        registrationModal = new Modal(registrationModalElement);
      }).catch(err => {
        console.error('Bootstrap Modal import error:', err);
      });
    }
  });
  
  // 로그인 모달 열기
  function openLogin() {
    if (loginModal) {
      loginFlg.value = true;
      loginModal.show();
    }
  }
  
  // 로그인 모달 닫기
  function closeLogin() {
    if (loginModal) {
      loginFlg.value = false;
      loginModal.hide();
    }
  }
  
  // 회원가입 모달 열기
  function openRegistration() {
    if (registrationModal) {
      registrationFlg.value = true;
      registrationModal.show();
    }
  }
  
  // 회원가입 모달 닫기
  function closeRegistration() {
    if (registrationModal) {
      registrationFlg.value = false;
      registrationModal.hide();
    }
  }
  
  // 회원가입 이동 (로그인 모달 닫고 회원가입 모달 열기)
  function goToRegistration() {
    closeLogin();
    openRegistration();
  }
  
  // 로그아웃
  function logout() {
    store.dispatch('logout');
  }
  </script>
  
  <style>
  @import url('../css/main.css');
  </style>
  