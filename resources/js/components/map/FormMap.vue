<template>
    <div style="height: 400px; width: 100%">
        <l-map :zoom="zoom" ref="map" :center="markerStartPosition">
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

            <l-tile-layer :url="url_rzd" :attribution="attribution" layer-type="overlay" name="Железные дороги"></l-tile-layer>

            <l-circle-marker
                :lat-lng="me.center"
                :radius="me.radius"
                :color="me.color"
                :visible="me.visible"
            >
                <l-tooltip :content="me.tooltip"></l-tooltip>
            </l-circle-marker>

            <l-marker v-for="cabinet in cabinets" :key="'cabinet_'+cabinet.id"
                      :lat-lng="[cabinet.lat, cabinet.lng]"
                      :name="''+cabinet.id"
                      :icon="iconCabinet"
                      ref="cabinetMarkersRef">
                <l-tooltip>Шкаф {{ cabinet.title }}</l-tooltip>
            </l-marker>

            <l-marker v-for="camera in cameras" :key="'camera_'+camera.id"
                      :lat-lng="[camera.lat, camera.lng]"
                      :name="''+camera.id"
                      :icon="iconCamera"
                      ref="cameraMarkersRef">
                <l-tooltip>Камера {{ camera.title }}</l-tooltip>
            </l-marker>


            <l-marker :lat-lng="markerStartPosition" :draggable=this.candragmarker @update:latLng="dragMarkers" :zIndexOffset="1000"></l-marker>

            <l-control position="topleft">
                <button
                    @click.prevent="moveMarkerToMyPosition"
                    title="Установить маркер по моему местоположению"
                    class="btn btn-light mt-2"
                    v-if="this.candragmarker"
                >
                    <i class="fas fa-crosshairs"></i>
                </button>
            </l-control>

            <l-control-scale position="bottomleft" :imperial="false" :metric="true" :maxWidth="200"></l-control-scale>
        </l-map>
    </div>
</template>

<script>
    import { latLng } from "leaflet";

    export default {
        name: "FormMap",
        props: {
            coords: Object,
            candragmarker: Boolean,
            cabinets: Array,
            cameras: Array,
        },
        data() {
            return {
                zoom: 9,
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
                        url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}.png',
                    },

                ],
                url_rzd: 'https://{s}.tiles.openrailwaymap.org/standard/{z}/{x}/{y}.png',
                me: {
                    center: [0,0],
                    visible: true,
                    radius: 6,
                    color: 'red',
                    tooltip: 'Местоположение не определено'
                },
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                copy_coords: this.coords,

                iconCabinet: L.icon({
                    iconUrl: '/images/vendor/leaflet/dist/marker-icon-orange.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 40],
                    tooltipAnchor: [0,-30],
                    popupAnchor: [0,-30],
                    shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
                    shadowAnchor: [12, 41]
                }),

                iconCamera: L.icon({
                    iconUrl: '/images/vendor/leaflet/dist/camera_green.png',
                    iconSize: [25, 37],
                    iconAnchor: [13, 36],
                    shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
                    shadowAnchor: [13, 41],
                    tooltipAnchor: [0,-25],
                }),
            }
        },
        computed: {
            markerStartPosition: {
                get: function() {
                    return latLng(this.copy_coords)
                },
                // setter
                set: function(newValue) {
                    this.copy_coords = newValue;
                }
            },
            markerPosition: function() {
                return {lat: this.markerLat, lng: this.markerLng}
            }
        },
        methods: {
            dragMarkers(LatLng) {
                $('input[name=lat]').val(LatLng.lat)
                $('input[name=lng]').val(LatLng.lng)
            },

            detectMyLocation() {
                const options = {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                };
                navigator.geolocation.getCurrentPosition(this.geoSuccess, this.geoError, options);
            },

            geoSuccess(pos) {
                var crd = pos.coords;

                console.log('Ваше текущее метоположение:');
                console.log(`Широта: ${crd.latitude}`);
                console.log(`Долгота: ${crd.longitude}`);
                console.log(`Плюс-минус ${crd.accuracy} метров.`)
                console.log(crd)

                // Обновим данные
                this.me.tooltip = `Текущее местоположение ± ${crd.accuracy} метров.`;
                this.me.center = [crd.latitude, crd.longitude];
                this.me.visible = true;
                this.me.color = 'blue'
            },

            geoError(err) {
                console.warn(`геолокация ERROR(${err.code}): ${err.message}`);
            },

            moveMarkerToMyPosition() {
                console.log('перемещение маркера');
                if (this.me.center[0] !== 0) {
                    this.markerStartPosition = latLng(this.me.center);
                    this.$refs.map.mapObject.flyTo(this.markerStartPosition)

                }
                else {
                    alert('Местоположение не определено!');
                }
            },
        },
        mounted: function () {
            this.detectMyLocation();
        },
    }
</script>

<style scoped>

</style>
