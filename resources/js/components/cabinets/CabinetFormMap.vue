<template>
    <div style="height: 300px; width: 100%">
        <l-map :zoom="zoom" :center="markerStartPosition">
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <l-marker :lat-lng="markerStartPosition" :draggable=true @update:latLng="dragMarkers"></l-marker>

            <l-marker v-for="cabinet in cabinets" :key="cabinet.id"
                      :lat-lng="cabinet.coords"
                      :name="''+cabinet.id"
                      :icon="iconCabinet"
                      ref="cabinetMarkersRef"></l-marker>
        </l-map>
    </div>
</template>

<script>
    import { latLng } from "leaflet";

    export default {
        name: "CabinetFormMap",
        props: ['coords','cabinets'],
        data() {
            return {
                zoom: 9,
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                iconCabinet: L.icon({
                    iconUrl: '/images/vendor/leaflet/dist/marker-icon-orange.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 40],
                    tooltipAnchor: [0,-30],
                    popupAnchor: [0,-30],
                    shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
                    shadowAnchor: [12, 41]
                }),
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
