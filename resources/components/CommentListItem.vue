<template>
  <div class="commentItem" v-for="(item, key) in $store.state.commentList" :key="key">
    <div class="co-card-box">
      <div class="co-text-box">
        <div class="co co-nick">{{ item.nick_name }}</div>
        <div class="co co-co">{{ item.comment }}</div>
        <div class="co-at">{{ item.created_at }}</div>
      </div>
      <div class="co-btn-box">
        <button type="button" class="btn-modify">수정</button>
        <button type="button" class="btn-delete">삭제</button>
      </div>
    </div>
    <hr>
  </div>
  <div class="page-btn">
    <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == 1" @click="prevPage()">< 이전 </button>

    <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == $store.state.pagination.last_page" @click="nextPage()"> 다음 > </button>
  </div>  
</template>

<script setup>
// import { ref } from 'vue';
import { onBeforeMount } from 'vue';
import { useStore } from 'vuex';

  const store = useStore();
  // const pagination = reactive({});

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

// function gotoPage() {
//   store.dispatch('commentPageGet', store.state.pagination.current_page = store.state.pagination.links.map(link => link.label));
//   console.log(store.state.pagination.links.key);
// }

// function currentPage(page){
//   store.dispatch('commentPageGet', page);
// }

</script>

<style scoped src="../css/camp.css">
  .active {
    font-weight: bold; /* 현재 페이지 표시를 위해 스타일링 */
  }
/* 
  @import url(../css/camp.css); */
</style>