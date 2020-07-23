<template>
    <div style="height: 300px; width: 100%">
        <l-map :zoom="zoom" :center="markerStartPosition">
            <l-control-layers position="topright"  ></l-control-layers>

            <l-tile-layer
                v-for="tile in tileProviders"
                :key="tile.name"
                :name="tile.name"
                :visible="tile.visible"
                :url="tile.url"
                :attribution="tile.attribution"
                layer-type="base"
            ></l-tile-layer>
            <l-tile-layer :url="url_rzd" :attribution="attribution"></l-tile-layer>
            <l-marker :lat-lng="markerStartPosition" :draggable=true @update:latLng="dragMarkers"></l-marker>
            <l-control-scale position="bottomleft" :imperial="false" :metric="true" :maxWidth="200"></l-control-scale>
        </l-map>
    </div>
</template>

<script>
    import { latLng } from "leaflet";

    export default {
        name: "CameraFormMap",
        props: ['coords'],
        data() {
            return {
                zoom: 9,
                //url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                // url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}.png',

                // url: 'https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWxleGV5bWVnYWV4IiwiYSI6ImNrYTZ1YXZsZTAzanUycG16cjd2dzF4cTEifQ.zshkRpxUPdwWRDz5tnXy4w',
                tileProviders: [
                    {
                        name: 'Схема',
                        visible: true,
                        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                        url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    },
                    {
                        name: 'Спутник',
                        visible: false,
                        attribution: '',
                        url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}.png'

                    },
                    // {
                    //     name: 'rzd',
                    //     visible: true,
                    //     attribution: '',
                    //     url: 'https://{s}.tiles.openrailwaymap.org/standard/{z}/{x}/{y}.png'
                    // }

                ],
                url_rzd: 'https://{s}.tiles.openrailwaymap.org/standard/{z}/{x}/{y}.png',
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
