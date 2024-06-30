<template>
  <main class="main-container-community">
    <!-- Sidebar -->
    <div class="sidebar-container">
      <div class="sidebar-box">
        <div class="page-title">
          <div>캠핑 Talk</div>
        </div>
        <div class="board-name-list">
          <div class="board-name">
            <div :class="{ 'active': route.params.id === '1' }">
              <router-link
                :to="`/community/1`"
                class="list-item"
                :class="{ active: isActive('/community/1') }"
              >자유 게시판</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '3' }" >
              <router-link :to="`/community/3`" class="list-item" 
              :class="{ active: isActive('/community/3') }">가입 인사</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '4' }">
              <router-link :to="`/community/4`" class="list-item" 
              :class="{ active: isActive('/community/4') }">캠핑 꿀팁</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '2' }">
              <router-link :to="`/community/2`" class="list-item" 
              :class="{ active: isActive('/community/2') }">리뷰 게시판</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '5' }">
              <router-link :to="`/community/5`" class="list-item" 
              :class="{ active: isActive('/community/5') }">랭킹 게시판</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="content-container">
      <div class="content-top">
        <nav class="content-top-2">
          <div class="content-head">
            <div>
              <h1>{{ getCommunityTypeName(route.params.id) }}</h1>
            </div>
            <div class="board-comment">
              <button @click="openInsertModal" class="btn btn-outline-success">글작성</button>
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
              <div>기타</div>
            </div>
            <div
              @click="openDetailModal(item)"
              class="content-item"
              v-for="(item, index) in $store.state.communityData"
              :key="index"
            >
              <div>{{ index + 1 }}</div>
              <div class="title-text-align">{{ item.title }}</div>
              <div>{{ item.user_id }}</div>
              <div>{{ item.created_at }}</div>
              <div>
                <div class="btn-container" v-if="isAuthor(item.user_id)">
                  <button type="button" class="btn btn-outline-warning" @click.stop="updatePost(item)">수정</button>
                  <button type="button" class="btn btn-outline-danger" @click.stop="deletePost(item.id)">삭제</button>
                </div>
              </div>
            </div>
          </div>
          <div class="pagination">
            <button
              class="pre-next-btn"
              type="button"
              :disabled="$store.state.paginationCommunity.current_page == 1"
              @click="prevPage()"
            >
              < 이전ㅤ
            </button>
            <div class="page-num">
              {{ $store.state.paginationCommunity.current_page + 'ㅤ/ㅤ' + $store.state.paginationCommunity.last_page }}
            </div>
            <button
              class="pre-next-btn"
              type="button"
              :disabled="$store.state.paginationCommunity.current_page == $store.state.paginationCommunity.last_page"
              @click="nextPage()"
            >
              ㅤ다음 >
            </button>
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
        <form id="insertForm" enctype="multipart/form-data">
          <input type="hidden" name="community-type" id="community-type" :value="route.params.id" />
          <div class="modal-body">
            <input class="title-input" type="text" name="title" placeholder="제목을 적어주세요." />
            <textarea name="content" placeholder="내용을 적어주세요." max="200"></textarea>
          </div>
          <div class="modal-body">
            <input @change="setFile" class="" type="file" name="main_img" accept="image/*" multiple />
            <div class="img-box">
              <img :src="preview" alt="" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
            <button @click="communityEvent" type="button" class="btn btn-primary">작성</button>
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
              <img :src="communityItem.main_img" alt="" />
            </div>
          </div>
          <div class="modal-footer">
            <div>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- 수정 모달 -->
<div v-show="modalFlg" class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">글 수정</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form @submit.prevent="submitUpdate">
        <input type="hidden" id="id" v-model="selectedContent.id">
        <div class="modal-body detail-data">
          <input class="detail-modal-title" id="detail-modal-title" v-model="selectedContent.title">
          <textarea class="detail-modal-content" id="detail-modal-content" v-model="selectedContent.content"></textarea>
          <h3>사진은 마이페이지 -> 내글목록에서 수정해주세요!</h3>
        </div>
        <div class="modal-footer">
            <div>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" >수정완료</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


  
<script setup>
import { onBeforeMount, onMounted, ref, reactive, watch } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();
const isLoggedIn = ref(false);

// const route = useRoute();

function isActive(path) {
  return route.path === path;
}

let updateModal;
const selectedContent = reactive({
  id:'',
  title: '',
  content: '',
});

// 로그인된 사용자의 ID를 가져옴
const userId = store.state.userInfo.id;

watch(() => route.params.id, async (newId) => {
  console.log('라우트가 변경되었습니다. 새로운 id:', newId);
  if (newId) {
    await store.dispatch('communityGet', { id: newId });
  } else {
    console.error('새로운 라우트 id가 정의되지 않았습니다.');
  }
});

const boardType = store.state.communityTypes;
const modalFlg = ref(false);
let insertModal;
let detailModal;
let communityItem = reactive({});
const preview = ref('');

const communityData = reactive({
  content: '',
  img: null,
});

function checkLoginStatus() {
  isLoggedIn.value = Boolean(store.state.authFlg);
}

function communityEvent() {
  const id = route.params.id;
  store.dispatch('communityInsert', id);
  modalFlg.value = false;
  window.location.reload();
}

function setFile(e) {
  communityItem.main_img = e.target.files[0];
  preview.value = URL.createObjectURL(communityItem.main_img);
  console.log('첨부 이미지:', communityItem.main_img);
}

function prevPage() {
  const currentPage = store.state.paginationCommunity.current_page;
  if (currentPage > 1) {
    store.dispatch('communityGet', { id: route.params.id, page: currentPage - 1 });
  }
}

function nextPage() {
  const currentPage = store.state.paginationCommunity.current_page;
  const lastPage = store.state.paginationCommunity.last_page;
  if (currentPage < lastPage) {
    store.dispatch('communityGet', { id: route.params.id, page: currentPage + 1 });
  }
}

onBeforeMount(async () => {
  const id = route.params.id;
  console.log('현재 라우트 id:', id);
  if (id) {
    await store.dispatch('communityGet', { id });
  } else {
    console.error('라우트 id가 정의되지 않았습니다.');
  }
});

onMounted(async () => {
  const id = route.params.id;
  store.dispatch('communityGet', { id });
});

onMounted(async () => {
  const insertModalElement = document.getElementById('insertModal');
  if (insertModalElement) {
    try {
      const { Modal } = await import('bootstrap');
      insertModal = new Modal(insertModalElement);
    } catch (err) {
      console.error('Bootstrap Modal import error:', err);
    }
  }
  const detailModalElement = document.getElementById('detailModal');
  if (detailModalElement) {
    try {
      const { Modal } = await import('bootstrap');
      detailModal = new Modal(detailModalElement);
    } catch (err) {
      console.error('Bootstrap Modal import error:', err);
    }
  }
  const updateModalElement = document.getElementById('updateModal');
  if (updateModalElement) {
    try {
      const { Modal } = await import('bootstrap');
      updateModal = new Modal(updateModalElement);
    } catch (err) {
      console.error('Bootstrap Modal import error:', err);
    }
  }
});

function openInsertModal() {
  checkLoginStatus();
  if (!isLoggedIn.value) {
    alert('로그인이 필요합니다.');
    return;
  } else if (insertModal) {
    modalFlg.value = true;
    insertModal.show();
  }
}

function openDetailModal(data) {
  if (detailModal) {
    modalFlg.value = true;
    detailModal.show();
    communityItem.title = data.title;
    communityItem.content = data.content;
    communityItem.main_img = data.main_img;
    communityItem.views = data.views;
    communityItem.type = data.type;
    console.log('상세 데이터:', communityItem);
  }
}

function getCommunityTypeName(id) {
  return boardType[id]?.name || 'Unknown Board';
}

// 내 글인지 확인하는 함수
function isAuthor(postUserId) {
  return postUserId === userId;
}

// 게시글 수정 함수
// updatePost 메서드 수정
function updatePost(item) {
  selectedContent.id = item.id;
  selectedContent.title = item.title;
  selectedContent.content = item.content;

  const updateModalElement = document.getElementById('updateModal');
  if (updateModalElement) {
    modalFlg.value = true;
    updateModal.show();
  }
}



// 게시글 삭제 함수
function deletePost(id) {
  if (confirm('정말 삭제하시겠습니까?')) {
    store.dispatch('communityDelete', id);
    store.dispatch('communityGet', { id: route.params.id });
  //   const id = route.params.id;
  //   if (id) {
  //   await store.dispatch('communityGet', { id });
  // } 
  }
}
//게시글 수정함수
function submitUpdate() {
  const formData = new FormData();
  formData.append('id', selectedContent.id); // 수정: selectedContent.value.id -> selectedContent.id
  formData.append('title', selectedContent.title); // 수정: selectedContent.value.title -> selectedContent.title
  formData.append('content', selectedContent.content); // 수정: selectedContent.value.content -> selectedContent.content

  store.dispatch('updatePost', formData);
  store.dispatch('communityGet', { id: route.params.id });
  
  // 수정이 완료되면 모달을 닫습니다.
  const updateModalElement = document.getElementById('updateModal');
  if (updateModalElement) {
    updateModal.hide(); // 모달을 닫습니다.
  }
}
</script>


  
  <style scope src="../css/community.css">
  /* @import url('../css/community.css'); */
  </style>
  