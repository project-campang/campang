<template>
    <div>
        <hr>
        <form class="comment-form" id="commentForm">
            <textarea v-if="$store.state.authFlg" v-model="newComment" class="comment-area" name="comment" max="1000" placeholder="댓글을 남겨보세요"></textarea>
            <textarea v-else v-model="newComment" class="comment-area" name="comment" max="1000" placeholder="로그인이 필요한 서비스 입니다." disabled="disabled"></textarea>
            <button @click="commentEvent()" type="button" class="submit-btn" :disabled="{disabled: !$store.state.authFlg}">작성</button>
            <button type="reset" class="reset">초기화</button>
        </form>
    </div>
</template>

<script setup>
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const route = useRoute();

function commentEvent(){
    store.dispatch('commentStore', route.params.id);
    window.location.reload();
}

let userInfo = store.state.userInfo;

</script>

<style >
@import url(../css/camp.css);
</style>