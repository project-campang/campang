<template>
  <div class="commentItem" v-for="(item, key) in $store.state.commentList" :key="key">
    <div class="co-card-box">
      <div class="co-text-box">
        <div class="co-nick">{{ item.nick_name }}</div>
        <div class="co-co">{{ item.comment }}</div>
        <div class="co-at">{{ item.created_at }}</div>
      </div>
      <div class="co-btn-box">
        <button type="button">수정</button>
        <button type="button">삭제</button>
      </div>
    </div>
    <hr>
  </div>
  <div class="page-btn">
    <!-- 이전 페이지로 이동하는 버튼 -->
    <!-- <button @click="gotoPreviousPage" :disabled="pagination.prev_page_url === null">이전</button> -->

    <!-- 페이지 번호를 나타내는 버튼 -->
    <!-- <button v-for="pageNumber in pagination.last_page" :key="pageNumber"
            @click="gotoPage(pageNumber)"
            :class="{ 'active': pageNumber === pagination.current_page }"
            :disabled="pageNumber === pagination.current_page">{{ pageNumber }}</button> -->

    <!-- 다음 페이지로 이동하는 버튼 -->
    <!-- <button @click="gotoNextPage" :disabled="pagination.next_page_url === null">다음</button> -->
  </div>  
</template>

<script setup>
// import { ref } from 'vue';
import { onBeforeMount } from 'vue';
import { useStore } from 'vuex';

  const store = useStore();
  // const pagination = ref(store.state.pagination);

  // 빌드시 리스트 출력
  onBeforeMount(() => {
    store.dispatch('commentPageGet');
  })


  const gotoPage = (pageNumber) => {
  store.dispatch('commentPageGet', pageNumber); // 페이지 데이터를 가져오는 액션 호출
};

// const gotoPreviousPage = () => {
//   const prevPage = pagination.value.current_page - 1;
//   if (prevPage >= 1) {
//     gotoPage(prevPage);
//   }
// };

const gotoNextPage = () => {
  const nextPage = pagination.value.current_page + 1;
  if (nextPage <= pagination.value.last_page) {
    gotoPage(nextPage);
  }
};
</script>

<style>
  .active {
    font-weight: bold; /* 현재 페이지 표시를 위해 스타일링 */
  }
</style>