<template>
    <div>
      <p>카카오 로그인 중입니다...</p>
    </div>
  </template>
  
  <script setup>
  import { onBeforeMount, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  import { useStore } from 'vuex';
  
  const route = useRoute();
  const store = useStore();
  
  onBeforeMount(() => {
      store.dispatch('kakaoUser');
  });
  </script>
  