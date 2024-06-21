<template>
    <option v-for="(item, key) in $store.state.countyData" :key="key">{{ item.name }}</option>
</template>

<script setup>

</script>

<style>

</style>