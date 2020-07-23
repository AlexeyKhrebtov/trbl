<template>
    <div class="list-group">
        <div class="list-group-item" v-for="camera in cameras" :key="camera.id"
             v-bind:class="{ active: isActive(camera.id) }">
            <div class="d-flex w-100 justify-content-between mb-3">
                <h5 class="mb-1"><a class="list-group-item-action" :href="linkToShow(camera)" title="Подробнее">{{ camera.title }}</a></h5>
                <small title="местоположение">{{ camera.location_km }} км, {{ camera.location_piket }} пикет</small>
            </div>

            <div class="d-flex w-100 justify-content-between">
                <a href="#" :title="camera.id" class="badge badge-light" v-on:click.prevent="showCameraOnMap(camera.id)">Показать на карте</a>
                <span class="badge badge-dark" title="Шкаф">{{ camera.cabinet.title }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { EventBus } from "../../event-bus";

    export default {
        name: "CamerasList",
        props: ['cameras', 'active_cam_id'],
        data() {
            return {
                search: '',
            }
        },
        methods: {
            showCameraOnMap(id) {
                EventBus.$emit('showCameraOnMap', id);
            },
            linkToShow(camera) {
                return `/cameras/${camera.id}`
            },
            isActive: function(camera_id) {
                return camera_id === this.active_cam_id;
            }
        },
        computed: {

        }
    }
</script>

<style scoped>
    .list-group-item.active a.list-group-item-action {
        background: white;
    }
</style>
