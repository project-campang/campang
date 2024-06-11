<template>
    <main class="main-container">
        <div class="sidebar-container">
            <div class="sidebar-box">
                <div class="page-title">
                    <span>캠핑 Talk</span>
                </div>
                <div class="board-name-list list-group">
                    <div class="board-name list-group">
                        <a href="" class="list-group-item">가입인사</a>
                        <a href="" class="list-group-item">자유 게시판</a>
                        <a href="" class="list-group-item">캠핑꿀팁</a>
                        <a href="" class="list-group-item">리뷰 게시판</a>
                        <a href="" class="list-group-item">랭킹 게시판</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container">
            <div class="content-top">
                <nav class="content-top-2 navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <div>
                            <span class="board-select">자유 게시판</span>
                            <button @click="openCreateModal" class="btn btn-outline-success">+</button>
                        </div>
                        <div class="board-comment nav-item" id="navbarSupportedContent">
                                <span>어쩌구 저쩌구를 남겨보세요.</span>
                        </div>
                        <div class="nav-item board-btn">
                            <button class="btn btn-outline-secondary">최신순</button>
                            <button class="btn btn-outline-secondary">인기순</button>
                        </div>
                    </div>
                    </nav>
            </div>
            <div class="content-bottom">
                <div class="content-box">
                    <div class="list-group">
                        <div class="content-column list-group-item" aria-disabled="true">
                            <span>글 번호</span>
                            <span>글 제목</span>
                            <span>작성자</span>
                            <span>작성일</span>
                            <span>조회수</span>
                        </div>
                        <div @click="openDetailModal" class="content-item">
                            <span>10</span>
                            <span>뭐라뭐라뭐라</span>
                            <span>가나다</span>
                            <span>2024-06-06</span>
                            <span>66</span>
                        </div>
                        <hr class="item-hr">
                        <div class="content-item">
                            <span>10</span>
                            <span>뭐라뭐라뭐라</span>
                            <span>가나다</span>
                            <span>2024-06-06</span>
                            <span>66</span>
                        </div>
                        <hr class="item-hr">
                        <div class="content-item">
                            <span>10</span>
                            <span>뭐라뭐라뭐라</span>
                            <span>가나다</span>
                            <span>2024-06-06</span>
                            <span>66</span>
                        </div>
                        <hr class="item-hr">
                    </div>
                </div>
            </div>
        </div>
    </main>

<!-- 작성 모달 -->
<div v-show="modalFlg" class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">작성하기</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="">
          <div class="modal-body">
            <input class="title-input" type="text" name="title" placeholder="제목을 적어주세요." max="50">
            <textarea name="content" placeholder="내용을 적어주세요." max="200"></textarea>
            </div>
            <div class="modal-body">
            <input type="file" name="img" accept="image/*">
            <div class="img-box">
                <img src="/public/img/sample1.jpg" alt="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
            <button type="button" class="btn btn-primary">작성</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- 상세 모달 -->
<div v-show="modalFlg" class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">상세</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="">
          <div class="modal-body">
            <input class="title-input" type="text" name="title" placeholder="제목을 적어주세요." max="50">
            <textarea name="content" placeholder="내용을 적어주세요." max="200"></textarea>
            </div>
            <div class="modal-body">
            <input type="file" name="img" accept="image/*">
            <div class="img-box">
                <img src="/public/img/sample1.jpg" alt="">
            </div>
          </div>
          <div class="modal-footer">
            <div>
                <button type="button" class="btn btn-outline-warning start-0">수정</button>
                <button type="button" class="btn btn-outline-danger">삭제</button>
            </div>
            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>


</template>

<script setup>
import { onMounted, reactive, ref } from 'vue';
import store from '../js/store';
import router from '../js/router';

// 모달 플래그
const modalFlg = ref(true);
let createModal;
let detailModal;

onMounted(() => {
    const createModalElement = document.getElementById('createModal');
    if (createModalElement) {
        import('bootstrap').then(({ Modal }) => {
            createModal = new Modal(createModalElement);
        }).catch(err => {
            console.error('Bootstrap Modal import error:', err);
        });
    }
});

// 작성 모달 열기
function openCreateModal() {
    if(createModal) {
        modalFlg.value = true;
        createModal.show();
    }
}

// 작성
const boardInfo = reactive({
    // content: '',
    // img: null,
});

// const preview = ref('');

// function setFile(e) {
//     // 저장
//     boardInfo.img = e.target.files[0];
//     // 화면 표시
//     preview.value = URL.createObjectURL(boardInfo.img);
// }

// 상세 모달 열기
function openDetailModal() {
    if(detailModal) {
        modalFlg.value = true;
        detailModal.show();
    }
}

onMounted(() => {
    const detailModalElement = document.getElementById('detailModal');
    if (detailModalElement) {
        import('bootstrap').then(({ Modal }) => {
            detailModal = new Modal(detailModalElement);
        }).catch(err => {
            console.error('Bootstrap Modal import error:', err);
        });
    }
});

</script>

<style>

@import url('../css/community.css');
</style>