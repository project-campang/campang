<template>
    <div>
        <hr>
        <div>작성자 이름</div>
        <form id="commentForm">
            <textarea name="comment" max="1000"></textarea>
            <button @click="$store.dispatch('commentStore')" type="button">작성</button>
            <button type="reset">초기화</button>
        </form>
    </div>
</template>

<script setup>

</script>

<style>
</style>