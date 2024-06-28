<template>
    <main class="main-container-community">
        <div class="sidebar-container">
            <div class="sidebar-box">
                <div class="page-title">
                    <div>캠핑 Talk</div>
                </div>
                <div class="board-name-list">
                    <div class="board-name">
                        <div><router-link to="/community/3" class="list-item">가입 인사</router-link></div>
                        <div><router-link to="/community/1" class="list-item">자유 게시판</router-link></div>
                        <div><router-link to="/community/4" class="list-item">캠핑 꿀팁</router-link></div>
                        <div><router-link to="/community/2" class="list-item">리뷰 게시판</router-link></div>
                        <div><router-link to="/community/5" class="list-item">랭킹 게시판</router-link></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container">
            <div class="content-top">
                <nav class="content-top-2">
                    <div class="content-head">
                        <!-- <div v-if="communityType"> -->
                        <div>
                            <!-- <a :href="`/community/${communityType.id}`" class="list-item">{{ communityType.name }}</a> -->
                            <a href="" class="list-item">게시판 이름</a>
                            {{ console.log('communityData', $store.state.communityData) }}
                            <button @click="openInsertModal" class="btn btn-outline-success">+</button>
                        </div>
                        <div class="board-comment">
                                <span>어쩌구 저쩌구를 남겨보세요.</span>
                        </div>
                        <div class="nav-item board-btn">
                            <!-- <button class="">최신순</button>
                            <button class="">인기순</button> -->
                        </div>
                    </div>
                    </nav>
            </div>
            <div class="content-btm">
                <div class="content-box">
                    <div class="list-group">
                        <div class="content-column2">
                            <div>글 번호</div>
                            <div class="title-text-align">글 제목</div>
                            <div>작성자</div>
                            <div>작성일</div>
                            <div>조회수</div>
                        </div>
                        <div @click="openDetailModal(item)" class="content-item" v-for="(item, key) in $store.state.communityData" :key="key">
                            <div>{{ item.id }}</div>
                            <div class="title-text-align">{{ item.title }}</div>
                            <div>{{ item.user_id }}</div>
                            <div>{{ item.created_at }}</div>
                            <div>{{ item.views }}</div>
                        </div>
                    </div>
                    <div class="pagination">
                        <button class="pre-next-btn" type="button" :disabled="$store.state.paginationCommunity.current_page == 1" @click="prevPage()">< 이전ㅤ</button>
                        {{ console.log('paginationCommunity 받아오나', $store.state.pagination) }}
                        <div class="page-num">{{ $store.state.paginationCommunity.current_page+'ㅤ/ㅤ'+$store.state.paginationCommunity.last_page }}</div>
                        <button class="pre-next-btn" type="button" :disabled="$store.state.paginationCommunity.current_page == $store.state.paginationCommunity.last_page" @click="nextPage()">ㅤ다음 > </button>
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
        <input type="hidden" name="community-type" id="community-type" :value="communityItem.type">
          <div class="modal-body">
            <input class="title-input" type="text" name="title" placeholder="제목을 적어주세요.">
            <textarea name="content" placeholder="내용을 적어주세요." max="200"></textarea>
            </div>
            <div class="modal-body">
                <input @change="setFile" class="" type="file" name="main_img" accept="image/*" multiple>
            <div class="img-box">
                <img :src="preview" alt="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
            <button @click="communityEvent()"  type="button" class="btn btn-primary">작성</button>
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
                <div class="modal-body detail-data">
                        <div class="detail-modal-title" id="detail-modal-title">{{ communityItem.title }}</div>
                        <div class="detail-modal-content" id="detail-modal-content">{{ communityItem.content }}</div>
                    <div class="img-box">
                        {{ console.log('communityItem.main_img', communityItem.main_img) }}
                        {{ console.log('communityItem.type', communityItem.type) }}
                        <img :src="communityItem.main_img" alt="">
                        <!-- <img src="/img/sample1.jpg" alt="">s -->
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
import { useRoute } from 'vue-router';
import axios from 'axios';


const store = useStore();
const route = useRoute();

// 커뮤니티 타입 데이터
const communityType = ref('');
const boardType = store.state.communityTypes;


// 모달 플래그
const modalFlg = ref(false);
let insertModal;
let detailModal;
let communityItem = reactive({});
const preview = ref('');

const communityData = reactive({
    content: '',
    img: null,
});


// 게시글 작성 처리, 모달 닫기, 새로 고침
function communityEvent(){
    store.dispatch('communityInsert');
    modalFlg.value = false;
    window.location.reload();
}

// 첨부 이미지 셋팅
function setFile(e) {
    // 저장
    communityItem.main_img = e.target.files[0];
    // console.log(communityItem.main_img);
    // 화면 표시
    preview.value = URL.createObjectURL(communityItem.main_img);
    console.log('으아아아아아아아아악', communityItem);
}

// 페이지네이션
function prevPage() {
    store.dispatch('communityGet', store.state.paginationCommunity.current_page-1);
    console.log('-1', store.state.paginationCommunity);
    console.log('-1', store.state.paginationCommunity.current_page);
    console.log('-1', store.state.paginationCommunity.current_page-1);
}

function nextPage() {
    store.dispatch('communityGet', store.state.paginationCommunity.current_page+1);
    console.log('+1', store.state.paginationCommunity);
    console.log('+1', store.state.paginationCommunity.current_page);
    console.log('+1', store.state.paginationCommunity.current_page+1);
}



onBeforeMount(async () => {
    // console.log('보드 비포 마운트');
    console.log('communityGet 시작');
    store.dispatch('communityGet', route.params.id);
    console.log('communityGet 완료');
    // console.log('서버 요청 보냄');
    // communityItem = data;
})

onMounted(async () => {
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
})

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
            communityItem.title = data.title;
            communityItem.content = data.content;
            communityItem.main_img = data.main_img;
            communityItem.views = data.views;
            communityItem.type = data.type;
            console.log('!!!!!!!!!!!!!!!!!!!!!!!' ,communityItem.views);
            console.log('!!!!!!!!!!!!!!!!!!!!!!!' ,communityItem.type);
            // // views 값  1 증가
            // if (communityItem.views !== undefined) {
            //     communityItem.views = data.views + 1;
            // } else {
            //     // views가 없으면 1로 초기화
            //     communityItem.views = 0;
            // }

            // console.log(communityItem.title);
            // console.log(communityItem.content);
            // console.log(communityItem.main_img);
            console.log('조회수 = ', communityItem.views);
            
        }        
    }



</script>

<style scope src="../css/community.css">
/* @import url('../css/community.css'); */
</style>