<template>
    <div class="map">

    </div>
</template>

<script setup>
    // import { KakaoMap, KakaoMapMarker } from 'vue3-kakao-maps';
    // const coordinate = {
    // lat: 37.566826,
    // lng: 126.9786567
    // };

    // export default {
    //     data() {
    //         return{};
    //     },
    //     mounted() {
    //         if (window.kakao && window.kakao.maps) {
    //             this.initMap();
    //         } else {
    //             const script = document.createElement('script');
    //             /* global kakao */
    //             script.onload = () => kakao.maps.load(this.initMap);
    //             script.src =
    //             'http://dapi.kakao.com/v2/maps/sdk.js?autoload=false&appkey=카카오API_KEY';
    //             document.head.appendChild(script);
    //         }
    //     },
    //     methods: {
    //         initMap() {
    //             const mapContainer = document.getElementById('map'), // 지도를 표시할 div
    //                 mapOption = {
    //                     center: new kakao.maps.LatLng(37.564343, 126.947613), // 지도의 중심좌표
    //                     level: 3, // 지도의 확대 레벨
    //                 };
    //                 const map = new kakao.maps.Map(mapContainer, mapOption);
    //             const positions = [
    //                 {
    //                     latlng: new kakao.maps.LatLng(37.562632898194835, 126.9454282268269),
    //                 },
    //                 {
    //                     latlng: new kakao.maps.LatLng(37.56195884514403, 126.94922601468826),
    //                 },
    //             ];
    //             positions.forEach(function(pos) {
    //                 const marker = new kakao.maps.Marker({
    //                     position: pos.latlng,
    //                 });
    //                 marker.setMap(map);
    //             })
    //         }
    //     },
    // }


</script>

<style>

</style>