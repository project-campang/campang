<template>
    <main class="main-container">
        <div class="sidebar-container">
            <div class="sidebar-box">
                <div class="page-title">
                    <span>캠핑 Talk</span>
                </div>
                <div class="board-name-list list-group">
                    <div class="board-name list-group">
                        <a href="" class="list-group-item">가입 인사</a>
                        <a href="" class="list-group-item">자유 게시판</a>
                        <a href="" class="list-group-item">캠핑 꿀팁</a>
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
                            <span class="board-select"></span>
                            <button @click="openInsertModal" class="btn btn-outline-success">+</button>
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
                        <div @click="openDetailModal" class="content-item" v-for="item in $store.state.communityData" :key="item" >
                            <span>{{ item.data.id }}</span>
                            <span>{{ item.data.title }}</span>
                            <span>{{ item.data.user_id }}</span>
                            <span>{{ item.data.created_at }}</span>
                            <span>{{ item.data.views }}</span>
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
<div v-show="modalFlg" class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">작성하기</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="insertForm" enctype="multipart/form-data">
          <div class="modal-body">
            <input class="title-input" type="text" name="title" placeholder="제목을 적어주세요.">
            <textarea name="content" placeholder="내용을 적어주세요." max="200"></textarea>
            </div>
            <div class="modal-body">
                <input class="" type="file" name="main_img" accept="image/*">
            <div class="img-box">
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
            <button @click="$store.dispatch('communityStore', communityData)" type="button" class="btn btn-primary">작성</button>
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
            <div class="modal-body detail-data" v-for="(item, key) in $store.state.communityData" :key="key">
                <span>{{ item.data.title }}</span>
                <span>{{ item.data.content }}</span>
            </div>
            <!-- <div class="modal-body detail-data">
                <div>제목</div>
                <div>내용</div>
            </div> -->
            <div class="modal-body">
                <div class="img-box">
                    <img src="" alt="">
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
import { onBeforeMount, onMounted, ref, reactive } from 'vue';
import { useStore } from 'vuex'


// 작성
const store = useStore();

onBeforeMount(() => {
    store.dispatch('commentGet');
})

// onBeforeMount(() => {
//     store.dispatch('communityStore');
// })

const communityData = reactive({
    title: '',
    content: '',
    main_img: '/public/img/sample1.jpg',
    other_img2: '/public/img/sample1.jpg',
    other_img3: '/public/img/sample1.jpg',
    other_img4: '/public/img/sample1.jpg',
    other_img5: '/public/img/sample1.jpg',
});


// 모달 플래그
const modalFlg = ref(false);
let insertModal;
let detailModal;

onMounted(() => {
    const insertModalElement = document.getElementById('insertModal');
    if (insertModalElement) {
        import('bootstrap').then(({ Modal }) => {
            insertModal = new Modal(insertModalElement);
        }).catch(err => {
            console.error('Bootstrap Modal import error:', err);
        });
    }
});

// 작성 모달 열기
function openInsertModal() {
    if(insertModal) {
        modalFlg.value = true;
        insertModal.show();
    }
}


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