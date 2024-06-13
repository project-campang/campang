<template>
    <main class="main-container-community">
        <div class="sidebar-container">
            <div class="sidebar-box">
                <div class="page-title">
                    <span>캠핑 Talk</span>
                </div>
                <div class="board-name-list">
                    <div class="board-name">
                        <div><a href="" class="list-item">가입 인사</a></div>
                        <div><a href="" class="list-item">자유 게시판</a></div>
                        <div><a href="" class="list-item">캠핑 꿀팁</a></div>
                        <div><a href="" class="list-item">리뷰 게시판</a></div>
                        <div><a href="" class="list-item">랭킹 게시판</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container">
            <div class="content-top">
                <nav class="content-top-2 navbar navbar-expand-lg bg-body-tertiary">
                    <div class="content-head">
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
                        <div class="content-column list-item" aria-disabled="true">
                            <span>글 번호</span>
                            <span>글 제목</span>
                            <span>작성자</span>
                            <span>작성일</span>
                            <span>조회수</span>
                        </div>
                        <div @click="openDetailModal" class="content-item" v-for="(item, key) in $store.state.communityData" :key="key">
                            <span>{{ item.id }}</span>
                            <span>{{ item.title }}</span>
                            <span>{{ item.user_id }}</span>
                            <span>{{ item.created_at }}</span>
                            <span>{{ item.views }}</span>
                            </div>
                        <hr class="item-hr">
                    </div>
                    <div class="pagination"></div>
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
                <input class="" type="file" name="main_img" accept="image/*" multiple>
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
            <button @click="$store.dispatch('communityStore')" type="button" class="btn btn-primary">작성</button>
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
                <span class="detail-modal-title">{{ item.title }}</span>
                <span class="detail-modal-content">{{ item.content }}</span>
                <div class="img-box">
                    <img :src="item.img">
                </div>
            </div>
            <div class="modal-body detail-data">
                <div>제목</div>
                <div>내용</div>
            </div>
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
import { useStore } from 'vuex';


// 게시글 획득
const store = useStore();

// onBeforeMount(() => {
//     store.dispatch('communityGet');
// })

// 모달
// 모달 플래그
const modalFlg = ref(false);
let insertModal;
let detailModal;
// let communityData = reactive({});
// let communityData = reactive({
//     title: '',
//     content: '',
//     main_img: '/public/img/sample1.jpg',
//     other_img2: '/public/img/sample1.jpg',
//     other_img3: '/public/img/sample1.jpg',
//     other_img4: '/public/img/sample1.jpg',
//     other_img5: '/public/img/sample1.jpg',
// });


onBeforeMount(() => {
    store.dispatch('communityGet');
  })

// onMounted
onMounted(async () => {
    // 커뮤니티 데이터 가져오기
    // try {
    //     await store.dispatch('communityGet');
    //     console.log('작동됨');
        
    // } catch (error) {
    //     console.error('Error fetching community data:', error);
    // }
    
    // 작성 모달 초기화
    const insertModalElement = document.getElementById('insertModal');
    if (insertModalElement) {
        try {
            const { Modal } = await import('bootstrap');
            insertModal = new Modal(insertModalElement);
        } catch (err) {
            console.error('Bootstrap Modal import error:', err);
        }
    }

    // 상세 모달 초기화
    const detailModalElement = document.getElementById('detailModal');
    if (detailModalElement) {
        try {
            const { Modal } = await import('bootstrap');
            detailModal = new Modal(detailModalElement);
        } catch (err) {
            console.error('Bootstrap Modal import error:', err);
        }
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
function openDetailModal(data) {
    if(detailModal) {
        modalFlg.value = true;
        detailModal.show();
        communityData = data;
    }
}

</script>

<style>

@import url('../css/community.css');
</style>