<template>
  <div class="commentItem" v-for="(item, key) in $store.state.commentList" :key="key">
    <div class="co-card-box">
      <div class="co-text-box">
        <div class="co co-nick">{{ item.nick_name }}</div>
        <div class="co co-co">{{ item.comment }}</div>
        <div class="co-at">{{ item.created_at }}</div>
      </div>
      <div v-if="isAuthor(item.user_id)" class="co-btn-box">
        <button type="button" class="btn-modify">수정</button>
        <button type="button" class="btn-delete">삭제</button>
      </div>
    </div>
    <hr>
  </div>
  <div class="page-btn">
    <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == 1" @click="prevPage()">< 이전 </button>
    <div class="page-num">{{ $store.state.pagination.current_page+'/'+$store.state.pagination.last_page }}</div>
    <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == $store.state.pagination.last_page" @click="nextPage()"> 다음 > </button>
  </div>  
</template>

<script setup>
// import { ref } from 'vue';
import { onBeforeMount } from 'vue';
import { useStore } from 'vuex';
import { computed } from 'vue';

  const store = useStore();
  // const pagination = reactive({});

  // 로그인한 사용자 정보 가져오기
const currentUser = computed(() => store.state.userInfo);

// computed를 사용하여 현재 사용자의 id를 동적으로 가져오기
const Author = computed(() => currentUser.value ? currentUser.value.id : null);

// 댓글 작성자와 현재 사용자의 id 비교 함수
const isAuthor = (userId) => {
  return Author.value === userId;
};

  // 빌드시 리스트 출력
  onBeforeMount(() => {
    store.dispatch('commentPageGet');
  // console.log(store.state.pagination.current_page);
  })

function prevPage() {
 store.dispatch('commentPageGet', store.state.pagination.current_page-1);
}

function nextPage() {
 store.dispatch('commentPageGet', store.state.pagination.current_page+1);
}

</script>

<style scoped src="../css/camp.css">
</style>