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
            <div :class="{ 'active': route.params.id === '3' }">
              <router-link :to="`/community/3`" class="list-item" :class="{ active: isActive('/community/3') }">가입 인사</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '4' }">
              <router-link :to="`/community/4`" class="list-item" :class="{ active: isActive('/community/4') }">캠핑 꿀팁</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '2' }">
              <router-link :to="`/community/2`" class="list-item" :class="{ active: isActive('/community/2') }">리뷰 게시판</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '5' }">
              <router-link :to="`/community/5`" class="list-item" :class="{ active: isActive('/community/5') }">랭킹 게시판</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="detail-content" v-if="postDetail">
      <div class="detail-content-top">
        <span class="post-detail-title">{{ postDetail.title }}</span>
        <button @click="goBack" class="btn commu-btn mb-3">목록</button>
      </div>
      <div class="detail-content-top2">
        <p class="sub-text">작성자ㅤ
          <span class="sub-text2">{{ postDetail.user_nick_name }}</span>
        </p>
        <p class="sub-text">
          조회수ㅤ
          <span class="sub-text2">{{ postDetail.views }}</span>
          ㅤ작성일ㅤ
          <span class="sub-text2">{{ getFormattedDate(postDetail.created_at) }}</span>
        </p>
      </div>
      <div class="detail-content-midle">
        <h3></h3>
        <p class="detail-content-text">{{ postDetail.content }}</p>
        <div class="img-box">
          <!-- <img v-if="postDetail.main_img" :src="postDetail.main_img" alt="post image" /> -->
          <p v-if="postDetail?.main_img" class="my-detail-title"></p>
          <img v-if="postDetail?.main_img" :src="postDetail.main_img" alt="Main Image" class="my-page-detailmodal">
          <p v-if="postDetail?.other_img2" class="my-detail-title"></p>
          <img v-if="postDetail?.other_img2" :src="postDetail.other_img2" alt="Other Image 2" class="my-page-detailmodal">
          <p v-if="postDetail?.other_img3" class="my-detail-title"></p>
          <img v-if="postDetail?.other_img3" :src="postDetail.other_img3" alt="Other Image 3" class="my-page-detailmodal">
          <p v-if="postDetail?.other_img4" class="my-detail-title"></p>
          <img v-if="postDetail?.other_img4" :src="postDetail.other_img4" alt="Other Image 4" class="my-page-detailmodal">
          <p v-if="postDetail?.other_img5" class="my-detail-title"></p>
          <img v-if="postDetail?.other_img5" :src="postDetail.other_img5" alt="Other Image 5" class="my-page-detailmodal">
        </div>
      </div>
      <div class="detail-content-bot">
        <form id="comment-form" class="community-comment">
          <textarea name="comment" id="comment" class="community-comment" v-model="newComment" placeholder="댓글을 입력하세요."></textarea>
          <button class="commu-btn" type="button" @click="addComment">등록</button>
        </form>
      </div>
      <!-- 댓글 출력 -->
      <div class="comments-comu">
        <div class="commentItem-comu" v-for="(item, key) in $store.state.communityComment" :key="key">
          <div class="co-card-box">
            <div class="co-text-box" v-if="editCommentId !== item.id">
              <p class="co co-co content-font commen-name">{{ item.nick_name }}</p>
              <p class="co-at content-font commen-comment">{{ item.comment }}</p>
              <p class="co-at content-font commen-comment">{{ getFormattedDate(item.created_at) }}</p>
            </div>
            <div v-if="editCommentId === item.id" class="updateDiv">
              <textarea class="updateArea" v-model="editCommentText" maxlength="200"></textarea>
              <div>
                <button type="button" class="btn-modify" @click="saveComment(item.id)">저장</button>
                <button type="button" class="btn-delete" @click="cancelEdit">취소</button>
              </div>
            </div>
            <div v-if="isAuthor(item.user_id)" class="co-btn-box">
              <button v-if="editCommentId !== item.id" type="button" class="btn-modify" @click="editComment(item)">수정</button>
              <button v-if="editCommentId !== item.id" type="button" class="btn-delete" @click="deleteComment(item.id)">삭제</button>
            </div>
          </div>
        </div>
      </div>
      <div class="commu-detail-page">
        <button class="pre-next-btn" type="button" :disabled="$store.state.paginationComment.current_page == 1" @click="prevPage()"> < 이전ㅤ</button>
        <div class="page-num">{{ $store.state.paginationComment.current_page + 'ㅤ/ㅤ' + $store.state.paginationComment.last_page }}</div>
        <button class="pre-next-btn" type="button" :disabled="$store.state.paginationComment.current_page == $store.state.paginationComment.last_page" @click="nextPage()"> ㅤ다음 ></button>
      </div>
    </div>
  </main>
</template>


<script setup>
import { onMounted, ref, reactive, watch, computed } from 'vue';
import { useStore } from 'vuex';
import { useRoute, useRouter } from 'vue-router';
import dayjs from 'dayjs';

const store = useStore();
const route = useRoute();
const router = useRouter();
const isLoggedIn = ref(false);

const postId = route.params.id;
const postDetail = ref(null); 
const newComment = ref('');
const communityTitle = ref('');
const communityTypeName = ref('');
const currentUser = computed(() => store.state.userInfo);

function prevPage() {
  const currentPage = store.state.paginationComment.current_page;
  if (currentPage > 1) {
    store.dispatch('commentCommunity', { id: postId, page: currentPage - 1 });
  }
}

function nextPage() {
  const currentPage = store.state.paginationComment.current_page;
  const lastPage = store.state.paginationComment.last_page;
  if (currentPage < lastPage) {
    store.dispatch('commentCommunity', { id: postId, page: currentPage + 1 });
  }
}




// computed를 사용하여 현재 사용자의 id를 동적으로 가져오기
const Author = computed(() => currentUser.value ? currentUser.value.id : null);


// 댓글 작성자와 현재 사용자의 id 비교 함수
const isAuthor = (userId) => {
  return Author.value === userId;
};


// 이 함수가 호출될 때마다 콘솔에 로그를 출력하여 확인
console.log('로그인 사용자 ID:', Author.value);

watch(
  () => route.params.id,
  async newId => {
    await fetchPostDetail(newId);
  }
);

// fetchPostDetail 함수에서 Vuex에 데이터 저장
async function fetchPostDetail(id) {
  try {
    const post = await store.dispatch('communityDetailGet', id);
    const comments = await store.dispatch('commentCommunity', { id: id, page: 1 });
    if (post) {
      post.comments = post.comments || [];
      postDetail.value = post;
      // 댓글 데이터를 store에 저장
      store.commit('setCommentPageGet', comments);
      communityTitle.value = store.state.communityTypes[route.params.id]?.name || '모름';
      communityTypeName.value = getCommunityTypeName(route.params.id);
      console.log('Comments:', comments); // 댓글 데이터 확인
      console.log(store.state.communityComment); // 댓글 데이터 확인
    } else {
      console.error('게시글 정보를 불러올 수 없습니다.');
    }
  } catch (error) {
    console.error('데이터를 가져오는 중 오류가 발생했습니다.', error);
  }
}



function getFormattedDate(dateTime) {
  return dateTime.split(' ')[0]; // 공백을 기준으로 나눠서 첫 번째 부분만 반환
}

function getCommunityTypeName(id) {
  return store.state.communityTypes[id]?.name || 'Unknown Board';
}

onMounted(async () => {
  await fetchPostDetail(postId);
});

function goBack() {
  // 이전 페이지로 돌아가기
  router.back();
  // 또는 router.go(-1);
}

function checkLoginStatus() {
  isLoggedIn.value = Boolean(store.state.authFlg);
}

async function addComment() {
  // 로그인 상태 확인
  checkLoginStatus();
  if (!isLoggedIn.value) {
    alert('로그인이 필요합니다.');
    return;
  }

  // 댓글 내용 확인
  if (!newComment.value) {
    alert('댓글 내용을 입력해주세요.');
    return;
  }

  // 현재 게시글 ID 가져오기
  const id = route.params.id;

  try {
    // Vuex 스토어의 commentPost 액션에 데이터를 전달
    await store.dispatch('commentPost', { id, comment: newComment.value });

    // 댓글 작성이 성공적으로 완료된 후 입력란 초기화
    newComment.value = '';

    // 댓글 작성 후 게시글 상세 정보와 댓글 다시 가져오기
    await fetchPostDetail(id);
  } catch (error) {
    console.error('댓글 작성 중 오류 발생:', error);
    alert('댓글 작성 중 오류가 발생했습니다. 다시 시도해주세요.');
  }
}





function isActive(path) {
  return route.path === path;
}

// 댓글 수정 삭제

// 수정 중인 댓글의 ID와 텍스트를 저장하는 변수
const editCommentId = ref(null);
const editCommentText = ref('');

// 댓글 수정 모드 취소 함수
const cancelEdit = () => {
  editCommentId.value = null;
  editCommentText.value = '';
};

// 댓글 수정 모드로 전환하는 함수
const editComment = (item) => {
  console.log('수정할 댓글:', item);
  editCommentId.value = item.id;
  editCommentText.value = item.comment;
};

// 댓글 저장 함수
const saveComment = async (id) => {
  console.log('저장할 댓글 ID:', id);
  console.log('수정된 댓글 내용:', editCommentText.value);
  try {
    await axios.post(`/api/community/comment/${id}/update`, {
      comment: editCommentText.value
    });
    editCommentId.value = null;
    editCommentText.value = '';
    await fetchPostDetail(route.params.id); // 댓글 저장 후 게시글 상세 정보 다시 가져오기
  } catch (error) {
    console.error('댓글 업데이트 오류:', error);
  }
};


const deleteComment = async (id) => {
  try {
    if (confirm('정말로 이 댓글을 삭제하시겠습니까?')) {
      await axios.delete(`/api/community/comment/${id}/delete`);
      // 댓글 삭제 후 Vuex 스토어 다시 불러오기
      await fetchPostDetail(route.params.id);
    }
  } catch (error) {
    console.error('댓글 삭제 오류:', error);
  }
};
</script>

<style scoped src="../css/community.css"></style>
