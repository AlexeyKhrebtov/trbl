<template>
    <div style="height: 300px; width: 100%">
        <l-map :zoom="zoom" :center="markerStartPosition">
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <l-marker :lat-lng="markerStartPosition" :draggable=true @update:latLng="dragMarkers"></l-marker>
        </l-map>
    </div>
</template>

<script>
    import { latLng } from "leaflet";

    export default {
        name: "CabinetFormMap",
        props: ['coords'],
        data() {
            return {
                zoom: 9,
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            }
        },
        computed: {
            markerStartPosition: function() {
                return latLng(this.coords)
            },
            markerPosition: function() {
                return {lat: this.markerLat, lng: this.markerLng}
            }
        },
        methods: {
            dragMarkers(LatLng) {
                $('input[name=lat]').val(LatLng.lat)
                $('input[name=lng]').val(LatLng.lng)
            }
        }
    }
</script>

<style scoped>

</style>
