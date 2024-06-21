<template>
    <div>
        <hr>
        <form class="comment-form" id="commentForm">
            <textarea v-model="newComment" class="comment-area" name="comment" max="1000" placeholder="댓글을 남겨보세요"></textarea>
            <button @click="commentEvent()" type="button" class="submit-btn">작성</button>
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

</script>

<style >
@import url(../css/camp.css);
</style>