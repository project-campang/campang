<template>
    <div>
    <h1>마이페이지</h1>
        <img src="/img/rank.jfif" alt="">
        <p>닉네임: 서린</p>
        <p>이메일: lsl9787@naver.com</p>
        <p></p>
        <p></p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">내정보수정</button>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">내정보 수정</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form >
                <div class="mb-3">
                    <label for="name" class="form-label">이름</label>
                    <input type="text"  class="form-control" id="name" autocomplete="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">이메일</label>
                    <input type="email"  class="form-control" id="email" autocomplete="email">
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-secondary">이메일 중복 확인</button>
                </div>
                <div class="mb-3">
                    <label for="nick_name" class="form-label">닉네임</label>
                    <input type="text"  class="form-control" id="nick_name" autocomplete="nickname">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">비밀번호</label>
                    <input type="password"  class="form-control" id="password" autocomplete="password">
                </div>
                <div class="mb-3">
                    <label for="ps_chk" class="form-label">비밀번호 확인</label>
                    <input type="password"  class="form-control" id="ps_chk" autocomplete="ps_chk">
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">휴대폰 번호</label>
                    <input type="text" class="form-control" id="tel" @input="oninputPhone" maxlength="14" autocomplete="user_num"/>
                </div>
                <!-- <div class="modal-footer">
                    <button @click="kakao_login" class="btn"><img src="/img/kakao-login.png" alt="카카오 로그인"></button>
                    <button @click="closeRegistration" type="button" class="btn btn-secondary">취소</button>
                    <button type="submit" class="btn btn-primary">회원가입</button>
                </div> -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                  <button type="button" class="btn btn-primary">완료</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
</template>
<script></script>
<style></style>