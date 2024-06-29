<template>
    <main class="main-container-community">
      <div class="sidebar-container">
        <div class="sidebar-box">
          <div class="page-title">
            <div>캠핑 Talk</div>
          </div>
          <div class="board-name-list">
            <div class="board-name">
                <div><router-link :to="`/community/1`" class="list-item">자유 게시판</router-link></div>
                <div><router-link :to="`/community/3`" class="list-item">가입 인사</router-link></div>
                <div><router-link :to="`/community/4`" class="list-item">캠핑 꿀팁</router-link></div>
                <div><router-link :to="`/community/2`" class="list-item">리뷰 게시판</router-link></div>
                <div><router-link :to="`/community/5`" class="list-item">랭킹 게시판</router-link></div>
            </div>
          </div>
        </div>
      </div>
      <div class="content-container">
        <div class="content-top">
          <nav class="content-top-2">
            <div class="content-head">
              <div>
                <h1>{{ getCommunityTypeName(route.params.id) }}</h1>
            </div>
            <button @click="openInsertModal" class="btn btn-outline-success">+</button>
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
            <input type="hidden" name="community-type" id="community-type" :value="route.params.id">
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
                <img :src="communityItem.main_img" alt="">
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
  import { onBeforeMount, onMounted, ref, reactive, watch } from 'vue';
  import { useStore } from 'vuex';
  import { useRoute } from 'vue-router';
  
  const store = useStore();
  const route = useRoute();
  const isLoggedIn = ref(false); // 로그인 여부를 저장할 변수
  
  watch(() => route.params.id, async (newId) => {
    console.log('라우트가 변경되었습니다. 새로운 id:', newId); // 로그 추가
    if (newId) {
      await store.dispatch('communityGet', { id: newId });
    } else {
      console.error('새로운 라우트 id가 정의되지 않았습니다.'); // 오류 로그 추가
    }
  });
  
  // 커뮤니티 타입 데이터
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
  
  function checkLoginStatus() {
    isLoggedIn.value = Boolean(store.state.authFlg);
  }
  
  // 게시글 작성 처리, 모달 닫기, 새로 고침
  function communityEvent() {

  
    // 로그인된 경우, 게시글 작성 처리
    const id = route.params.id; // 현재 라우트의 ID를 가져옵니다
    store.dispatch('communityInsert', id);
    modalFlg.value = false;
    window.location.reload();
  }
  
  // 첨부 이미지 셋팅
  function setFile(e) {
    communityItem.main_img = e.target.files[0];
    preview.value = URL.createObjectURL(communityItem.main_img);
    console.log('첨부 이미지:', communityItem.main_img);
  }
  
  // 페이지네이션
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
    console.log('현재 라우트 id:', id); // 로그 추가
    if (id) {
      await store.dispatch('communityGet', { id });
    } else {
      console.error('라우트 id가 정의되지 않았습니다.'); // 오류 로그 추가
    }
  });
  
  onMounted(async () => {
    const id = route.params.id;
    store.dispatch('communityGet', { id });
  });
  
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
  });
  
  // 작성 모달 열기
  function openInsertModal() {
    checkLoginStatus(); // 로그인 상태 확인
    if (!isLoggedIn.value) {
      alert('로그인이 필요합니다.');
      return; // 로그인되지 않은 경우 함수 종료
    }
    else if(insertModal) {
      modalFlg.value = true;
      insertModal.show();
    }
  }
  
  // 상세 모달 열기
  function openDetailModal(data) {
    if (detailModal) {
      modalFlg.value = true;
      detailModal.show();
      communityItem.title = data.title;
      communityItem.content = data.content;
      communityItem.main_img = data.main_img;
      communityItem.views = data.views;
      communityItem.type = data.type;
      console.log('상세 데이터:', communityItem); // 데이터 확인용 로그
    }
  }
  
  function getCommunityTypeName(id) {
    return boardType[id]?.name || 'Unknown Board';
  }
  
  </script>
  
  <style scope src="../css/community.css">
  /* @import url('../css/community.css'); */
  </style>
  