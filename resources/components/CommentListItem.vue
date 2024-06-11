<template>
  <div class="commentItem" v-for="item in $store.state.commentData" :key="item">
    <div >{{ item.data.user_id }}</div>
    <div>{{ item.data.created_at }}</div>
    <div>{{ item.data.comment }}</div>
    <button type="button">수정</button>
    <button type="button">삭제</button>
  </div>
</template>

<script setup>
import { onBeforeMount } from 'vue';
import { useStore } from 'vuex';

    const store = useStore();

  onBeforeMount(() => {
    store.dispatch('commentGet');
  })

</script>

<style>
</style>