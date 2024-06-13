<template>
    <div>
        <hr>
        <form class="comment-form" id="commentForm">
            <textarea class="comment-area" name="comment" max="1000" placeholder="댓글을 남겨보세요"></textarea>
            <button @click="$store.dispatch('commentStore')" type="button" class="submit-btn">작성</button>
            <button type="reset" class="reset">초기화</button>
        </form>
    </div>
</template>

<script setup>

</script>

<style>
    @import url(../css/camp.css);
</style>