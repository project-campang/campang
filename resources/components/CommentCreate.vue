<template>
    <div>
        <hr>
        <form class="comment-form" id="commentForm">
            <textarea v-if="$store.state.authFlg" v-model="newComment" class="comment-area" name="comment" max="1000" placeholder="댓글을 남겨보세요"></textarea>
            <textarea v-else v-model="newComment" class="comment-area" name="comment" max="1000" placeholder="로그인이 필요한 서비스 입니다." disabled="disabled"></textarea>
            <button @click="commentEvent" type="button" class="submit-btn" :disabled="!$store.state.authFlg">작성</button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';
import axios from 'axios';

const store = useStore();
const route = useRoute();
const newComment = ref('');

const commentEvent = async () => {
  try {
    if (newComment.value.trim() === '') {
      alert('댓글을 입력해주세요.');
      return;
    }
    
    const response = await axios.post(`/api/comment/${route.params.id}`, {
      comment: newComment.value
    });
    
    if (response.status === 200) {
      newComment.value = '';
      store.dispatch('commentPageGet', { id: route.params.id, page: store.state.pagination.current_page });
    } else {
      console.error('댓글 작성 오류:', response);
      alert('댓글 작성 중 오류가 발생했습니다.');
    }
  } catch (error) {
    console.error('댓글 작성 오류:', error.response ? error.response.data : error.message);
    alert('댓글 작성 중 오류가 발생했습니다.');
  }
};
</script>

<style >
@import url(../css/camp.css);
</style>