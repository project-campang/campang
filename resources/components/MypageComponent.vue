<template>
  <div class="my-page-section">
    <div v-if="$store.state.userInfo" class="my-page-side">
      <img :src="$store.state.userInfo.profile" alt="Profile Image">
      <p>{{ $store.state.userInfo.nick_name }}</p>
      <p>{{ $store.state.userInfo.email }}</p>
      <button @click="openModal($store.state.userInfo)" type="button" class="btn btn-primary my-page-button" data-bs-toggle="modal" data-bs-target="#userModal">내정보수정</button>
      <div class="my-page-box">
        <p class="mypage-stamp" @click="showstamp">내 도장판</p>
        <p>-정복한 캠핑장</p>
        <p>-찜목록</p>
        <p class="mypage-content" @click="showcontent">내가쓴글</p>
        <p>-게시글</p>
        <p>-리뷰</p>
        <p>-댓글</p>
      </div>
    </div>
    <div v-if="isstampVisible">
      <h1>정복한 캠핑장 _도장깨기</h1>
      <div class="stamp-top">
        <h3 class="stamp-top-h2">총 20군데 정복!</h3>
        <div class="stamp-top-item">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
          <img src="/img/puz.png" alt="">
        </div>
      </div>
      <h1>찜한 캠핑장 _찜목록</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item" aria-disabled="true">
                <div class="my-page-top">글 번호</div>
                <div class="my-page-top">글 제목</div>
                <div class="my-page-top">작성자</div>
                <div class="my-page-top">작성일</div>
              </div>
              <div class="content-row">
                <div class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
                <div  class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
                <div  class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
              </div>
              <hr class="item-hr">
            </div>
            <div class="pagination">
              <이전 1/5 다음>
            </div>
          </div>
        </div>
    </div>
    <div v-else class="posts-section">
        <h1>게시글</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item" aria-disabled="true">
                <div class="my-page-top">글 번호</div>
                <div class="my-page-top">글 제목</div>
                <div class="my-page-top">작성자</div>
                <div class="my-page-top">작성일</div>
              </div>
              <div class="content-row">
                <div class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
                <div  class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
                <div  class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
              </div>
              <hr class="item-hr">
            </div>
            <div class="pagination">
              <이전 1/5 다음>
            </div>
          </div>
        </div>
        <h1>리뷰</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item" aria-disabled="true">
                <div class="my-page-top">글 번호</div>
                <div class="my-page-top">글 제목</div>
                <div class="my-page-top">작성자</div>
                <div class="my-page-top">작성일</div>
              </div>
              <div class="content-row">
                <div class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
                <div class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
                <div class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
              </div>
              <hr class="item-hr">
            </div>
            <div class="pagination"></div>
          </div>
        </div>
        <h1>댓글</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item" aria-disabled="true">
                <div class="my-page-top">글 번호</div>
                <div class="my-page-top">글 제목</div>
                <div class="my-page-top">작성자</div>
                <div class="my-page-top">작성일</div>
              </div>
              <div class="content-row">
                <div class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
                <div class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
                <div class="content-row-num">1</div>
                <div class="title-text-align">어쩌고저쩌고끙끙</div>
                <div>이서린</div>
                <div>2024-06-21</div>
              </div>
              <hr class="item-hr">
            </div>
            <div class="pagination"></div>
          </div>
        </div>
      </div>
    
  </div>

  <!-- Modal -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="userModalLabel">내정보 수정</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUserInfoForm">
            <div class="mb-3">
              <label for="profile" class="form-label">프로필 사진</label>
              <input type="file" class="form-control" id="profile" name="profile" @change="onProfileChange">
              <img :src="userInfo.profile" alt="Profile Image" v-if="userInfo.profile" class="mt-3" style="width: 100px; height: 100px;">
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">이름</label>
              <input type="text" class="form-control" id="name" name="name" v-model="userInfo.name">
            </div>
            <div class="mb-3">
              <label for="nick_name" class="form-label">닉네임</label>
              <input type="text" class="form-control" id="nick_name" name="nick_name" v-model="userInfo.nick_name">
            </div>
            <div class="mb-3">
              <label for="tel" class="form-label">휴대폰 번호</label>
              <input type="text" class="form-control" id="tel" name="tel" v-model="userInfo.tel" @input="oninputPhone" maxlength="14">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
              <button type="button" @click="$store.dispatch('updateUserInfo')" class="btn btn-primary" data-bs-dismiss="modal">수정 완료</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useStore } from 'vuex';

const isstampVisible = ref(true);
const store = useStore();
const userInfo = ref({
  name: '',
  nick_name: '',
  email: '',
  tel: '',
  profile: ''
});

function showstamp() {
  isstampVisible.value = true;
}

function showcontent() {
  isstampVisible.value = false;
}

function openModal(data) {
  if (data) {
    userInfo.value = { ...data };
  }
}



function onProfileChange(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = () => {
      userInfo.value.profile = reader.result;
    };
    reader.readAsDataURL(file);
  }
}
</script>


<style  scope src="../css/user.css">
</style>
