<template>
    <div class="sticky-top">
        <div style="height: 500px; width: 100%">
            <l-map
                :zoom="zoom"
                :center="center"
                :options="mapOptions"
                ref="myMap"
            >

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

                <l-feature-group ref="markersGroupRef">
                    <l-marker v-for="marker in markers" :key="marker.id"
                              :lat-lng="marker.coords"
                              :name="''+marker.id"
                              :icon="iconCamera"
                              ref="cameraMarkersRef"
                    >
                        <l-tooltip>{{ marker.title }}</l-tooltip>

                        <l-popup>
                            <p>Камера <a :href="linkToShow(marker)" title="перейти">{{ marker.title }}</a></p>
                        </l-popup>
                    </l-marker>
                </l-feature-group>

                <l-circle-marker
                    :lat-lng="me.center"
                    :radius="me.radius"
                    :color="me.color"
                    :visible="me.visible"
                >
                    <l-tooltip :content="me.tooltip"></l-tooltip>
                </l-circle-marker>

                <l-control-scale position="bottomleft" :imperial="false" :metric="true" :maxWidth="200"></l-control-scale>
            </l-map>
        </div>

        <div class="alert alert-warning" role="alert" v-if="map_error">
            {{ map_error_text }}
        </div>

    </div>
</template>

<script>
    import { latLng } from "leaflet";
    import { EventBus } from "../../event-bus";

    export default {
        name: "CamerasIndexMap",
        data() {
            return {
                // map params
                zoom: 9,
                center: latLng(59.749311, 30.615230),
                mapOptions: {
                    zoomSnap: 0.5
                },
                // tile-layer option
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                // тут храним объекты маркеров
                markerObjects: null,

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

                iconCamera: L.icon({
                    iconUrl: '/images/vendor/leaflet/dist/camera_green.png',
                    iconSize: [25, 37],
                    iconAnchor: [12, 40],
                    shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
                    shadowAnchor: [14, 46]
                }),

                me: {
                    center: [0,0],
                    visible: true,
                    radius: 6,
                    color: 'red',
                    tooltip: 'Местоположение не определено'
                },

                map_error: false,
                map_error_text: '',
            };
        },
        props: ['cameras'],
        mounted() {
            this.$nextTick(() => {
                // this.markerObjects = this.$refs.cameraMarkersRef.map(ref => ref.mapObject);
                this.markerObjects = this.$refs.cameraMarkersRef.map(ref => ref);
            });
            this.detectMyLocation();
        },
        updated() {
            // const map = this.$refs.myMap.mapObject;
            // const bounds = this.$refs.markersGroupRef.mapObject.getBounds();
            // map.fitBounds(bounds);
        },
        methods: {
            linkToShow(camera) {
                return `/cameras/${camera.id}`
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
                this.map_error_text = `Ошибка геолокации (${err.code}): ${err.message}`;
                this.map_error = true;
            },
        },
        computed: {
            markers: function() {
                return this.cameras.map(function(item) {
                    return {
                        id: item.id,
                        coords: latLng(item.lat, item.lng),
                        title: item.title,
                    }
                });
            }
        },
        created() {
            const vm = this;
            EventBus.$on('showCameraOnMap', camera_id => {
                console.log(`showCameraOnMap: Camera id ${camera_id} clicks`)
                for (let markerObject of this.markerObjects) {
                    markerObject.mapObject.closeTooltip();
                    if (markerObject.name == camera_id) {
                        // markerObject.mapObject.toggleTooltip();
                        markerObject.mapObject.openPopup();
                        //vm.center = markerObject.latLng;
                        vm.center = markerObject.latLng;
                    }
                }
            });
        },
    }
</script>

<style scoped>

</style>
