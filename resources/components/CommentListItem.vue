<template>
    <div class="commentItem">
    <div>{{ commentItem.user_id }}</div>
    <div>{{ commentItem.created_at }}</div>
    <div>{{ commentItem.comment }}</div>
    <button type="button">수정</button>
    <button type="button">삭제</button>
  </div>
</template>

<script setup>
import { useStore } from 'vuex';

    const store = useStore();

    let commentItem = reactive({});


</script>

<style>
</style>