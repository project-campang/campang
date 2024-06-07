<template>
    <!-- <header>
      <div class="header-container">
        <div class="header-content">
          <div class="title">
            <router-link to="/"><h1>Vuestagram</h1></router-link>
          </div>
          <img class="img-logo" alt="logo" src="/logo.png">
          <div class="btn-group">
            <div v-if="!$store.state.authFlg">
              <button @click="$router.push('/login')" class="btn btn-header btn-bg-black">로그인</button>
              <button @click="$router.push('/registration')" class="btn btn-header btn-bg-white">가입하기</button>
            </div>
            <div v-else>
              <button @click="$store.dispatch('logout')" class="btn btn-header btn-bg-black">로그아웃</button>
            </div>
          </div>
        </div>
      </div>
    </header>
    <hr>
  
    <main>
      <UserInfoComponent v-if="$store.state.userInfo"/>
      <div class="container">
        <router-view></router-view>
      </div>
    </main>

    <footer>
      <p>ⓒ 2024. Meerkat All rights reserved.</p>
    </footer> -->

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <router-link to="/" class="navbar-brand my-logo-img" href="#"></router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
                </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">캠핑장 모아보기   |</a>
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
                <button @click="openlogin(item)"  class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">로그인</button>
                <button @click="" class="btn btn-outline-success me-2">가입하기</button>
              </div>
              <div v-else>
                <button @click="" class="btn btn-outline-success">로그아웃</button>
              </div>              
            </form>
          </div>
        </div>
      </nav>
    </header>
  <!-- Modal -->
<div v-if="loginflg" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">로그인</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button  @click="closelogin(item)" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<main>
  <router-view></router-view>
</main>
</template>
  
<script setup>
import { onBeforeMount, reactive, ref } from 'vue';
import { useStore } from 'vuex';


let loginFlg = ref(false);

function openlogin(data) {
  detailItem = {};
  detailFlg.value = true;
}

function closelogin(data) {
  detailItem = {};
  detailFlg.value = false;
}



</script>
  
<style>
@import url(../css/main.css);
</style>