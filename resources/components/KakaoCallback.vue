<template>
    <div>
      <p>카카오 로그인 중입니다...</p>
    </div>
  </template>
  
  <script setup>
  import { onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  import { useStore } from 'vuex';
  
  const route = useRoute();
  const store = useStore();
  
  onMounted(async () => {
    const code = route.query.code;
    if (code) {
      await store.dispatch('kakao_login', code);
    }
  });
  </script>
  