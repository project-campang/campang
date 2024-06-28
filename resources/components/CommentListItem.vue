<template>
  <div class="commentItem" v-for="(item, key) in $store.state.commentList" :key="key">
    <div class="co-card-box">
      <div class="co-text-box">
        <div class="co co-nick">{{ item.nick_name }}</div>
        <div class="updateDiv" v-if="editCommentId === item.id">
          <textarea class="updateArea" v-model="editCommentText" maxlength="200"></textarea>
          <div>
            <button type="button" class="btn-modify" @click="saveComment(item.id)">저장</button>
            <button type="button" class="btn-delete" @click="cancelEdit()">취소</button>
          </div>
        </div>
        <div v-else>
          <div class="co co-co">{{ item.comment }}</div>
          <div class="co-at">{{ item.created_at }}</div>
        </div>
      </div>
      <div v-if="isAuthor(item.user_id)" class="co-btn-box">
        <button v-if="editCommentId !== item.id" type="button" class="btn-modify" @click="editComment(item)">수정</button>
        <button v-if="editCommentId !== item.id" type="button" class="btn-delete" @click="deleteComment(item.id)">삭제</button>
      </div>
    </div>
    <hr>
  </div>
  <div class="page-btn">
    <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == 1" @click="prevPage()">< 이전 </button>
    {{ console.log('pagination 받아오나', $store.state.pagination) }}
    <div class="page-num">{{ $store.state.pagination.current_page+'/'+$store.state.pagination.last_page }}</div>
    <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == $store.state.pagination.last_page" @click="nextPage()"> 다음 > </button>
  </div>  
</template>

<script setup>
// import { ref } from 'vue';
import { onBeforeMount,ref } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import { computed } from 'vue';

const route = useRoute();
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


// 수정 중인 댓글의 ID와 텍스트를 저장하는 변수
const editCommentId = ref(null);
const editCommentText = ref('');

// 댓글 수정 모드로 전환하는 함수
const editComment = (item) => {
  editCommentId.value = item.id;
  editCommentText.value = item.comment;
};

// 댓글 수정 모드 취소 함수
const cancelEdit = () => {
  editCommentId.value = null;
  editCommentText.value = '';
};

// 댓글 저장 함수
const saveComment = async (id) => {
  try {
    await axios.post(`/api/comment/${id}/update`, {
      comment: editCommentText.value
    });
    editCommentId.value = null;
    editCommentText.value = '';
    store.dispatch('commentPageGet',route.params.id ,store.state.pagination.current_page);
  } catch (error) {
    console.error('댓글 업데이트 오류:', error);
  }
};
const deleteComment = async (id) => {
  try {
    if (confirm('정말로 이 댓글을 삭제하시겠습니까?')) {
      await axios.delete(`/api/comment/${id}/delete`);
      // 댓글 삭제 후 Vuex 스토어 다시 불러오기
      store.dispatch('commentPageGet', route.params.id ,store.state.pagination.current_page);
    }
  } catch (error) {
    console.error('댓글 삭제 오류:', error);
  }
};

  // 빌드시 리스트 출력
  onBeforeMount(() => {
    store.dispatch('commentPageGet', route.params.id);
  // console.log(store.state.pagination.current_page);
  })

function prevPage() {
 store.dispatch('commentPageGet', store.state.pagination.current_page-1);
 console.log('-1', store.state.pagination.current_page);
}

function nextPage() {
 store.dispatch('commentPageGet', store.state.pagination.current_page+1);
 console.log('+1', store.state.pagination.current_page);
}


</script>

<style scoped src="../css/camp.css">
</style>