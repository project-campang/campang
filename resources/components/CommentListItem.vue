<template>
  <div class="commentItem" v-for="item in $store.state.commentData" :key="item">
    <div>{{ item.user_id }}</div>
    <div>{{ item.created_at }}</div>
    <div>{{ item.comment }}</div>
    <button type="button">수정</button>
    <button type="button">삭제</button>
  </div>
</template>

<script setup>
import { useStore } from 'vuex';

    const store = useStore();


</script>

<style>
</style>