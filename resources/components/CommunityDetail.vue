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
        <h2>{{ postDetail.title }}</h2>
        <!-- <p>{{ communityTypeName }}</p> -->
        <button @click="goBack" class="btn commu-btn">목록으로 돌아가기</button>
      </div>
      <div class="detail-content-top2">
        <p>작성자: {{ postDetail.user_nick_name }}</p>
        <p>조회수: {{ postDetail.views }} 작성일: {{ getFormattedDate(postDetail.created_at) }}</p>
      </div>
      <div class="detail-content-midle">
        <h3></h3>
        <p>{{ postDetail.content }}</p>
        <div class="img-box">
          <img v-if="postDetail.main_img" :src="postDetail.main_img" alt="post image" />
        </div>
      </div>
      <div class="detail-content-bot">
        <input class="community-comment" type="text" v-model="newComment" placeholder="댓글을 입력하세요." />
        <button class="commu-btn" @click="addComment">등록</button>
      </div>
      <!-- 댓글 출력 -->
      <div class="comments-comu">
        <div class="commentItem-comu" v-for="(item, key) in $store.state.communityComment.data" :key="key">
          <div class="co-card-box">
            <div class="co-text-box">
              <p class="co co-co content-font commen-name">{{ item.nick_name }}</p>
              <p class="co-at content-font commen-comment">{{ item.comment }}</p>
              <p class="co-at content-font commen-comment">{{ getFormattedDate(item.created_at) }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="commu-detail-page">이전 1 2 3 4 5 다음</div>

    </div>
  </main>
</template>

<script setup>
import { onMounted, ref, reactive, watch } from 'vue';
import { useStore } from 'vuex';
import { useRoute, useRouter } from 'vue-router';
import dayjs from 'dayjs';

const store = useStore();
const route = useRoute();
const router = useRouter();

const postId = route.params.id;
const postDetail = ref(null); 
const newComment = ref('');
const communityTitle = ref('');
const communityTypeName = ref('');

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
    const comments = await store.dispatch('commentCommunity', id);
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
  return dayjs(dateTime).format('YYYY.MM.DD HH:mm');
}

function getCommunityTypeName(id) {
  return store.state.communityTypes[id]?.name || 'Unknown Board';
}

onMounted(async () => {
  await fetchPostDetail(postId);
});

function goBack() {
  router.push(`/community/${route.params.id}`);
}

async function addComment() {
  if (newComment.value) {
    if (postDetail.value && postDetail.value.comments) {
      const id = route.params.id;
      try {
        const response = await fetch(`/api/community/comment/insert/${id}`, { // 올바른 경로로 수정
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${store.state.token}` // 로그인 상태에서 토큰을 사용하여 인증
          },
          body: JSON.stringify({
            community_id: id,  // 현재 게시글의 ID
            comment: newComment.value
          })
        });

        if (!response.ok) {
          throw new Error('댓글 작성 실패');
        }

        const data = await response.json();
        console.log('댓글 작성 성공:', data);

        // 댓글 작성 후 화면을 업데이트합니다. 예를 들어, 새로 작성한 댓글을 리스트에 추가할 수 있습니다.
        newComment.value = '';
        await store.dispatch('commentPost', id); // 댓글 리스트 업데이트
      } catch (error) {
        console.error('댓글 작성 중 오류 발생:', error);
      }
    } else {
      console.error('댓글을 추가할 수 없습니다. 게시글이 로드되지 않았거나 댓글 리스트가 초기화되지 않았습니다.');
    }
  } else {
    console.error('댓글 내용을 입력해주세요.');
  }
}


function isActive(path) {
  return route.path === path;
}
</script>

<style scoped src="../css/community.css"></style>
