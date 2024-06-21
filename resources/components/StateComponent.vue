<template>
    <option v-for="(item, key) in $store.state.stateData" :key="key">{{ item.name }}</option>
</template>

<script setup>

</script>

<style>

</style>