<template>
    <div class="row" v-on:click="click_inside">
        <div class="col-md-4">
            <fieldset class="shadow-sm bg-white p-2 mb-4">
                <legend  class="w-auto">Поиск</legend>
                <input type="search" class="form-control" placeholder="по номеру камеры или шкафу" v-model="search">
            </fieldset>

            <cameras-list :cameras='filtredCameras' :active_cam_id='active_cam_id'></cameras-list>
        </div>
        <div class="col-md-8">
            <cameras-index-map :cameras='filtredCameras'></cameras-index-map>
        </div>
    </div>
</template>

<script>
    import {EventBus} from "../../event-bus";

    export default {
        name: "CamerasIndexPage",
        props: ['cameras'],
        data() {
            return {
                search: '',
                active_cam_id: null,
            }
        },
        methods: {
            click_inside: function (e) {
                if( e.target.classList.value != 'badge badge-light' && !e.target.classList.value.includes('leaflet')) {
                    this.active_cam_id = null;
                }
            }
        },
        computed: {
            filtredCameras() {
                return this.cameras.filter( cam => {
                    return cam.title.toLowerCase().includes(this.search.toLowerCase()) || cam.cabinet.title.toLowerCase().includes(this.search.toLowerCase())
                });
            }
        },
        created() {
            const vm = this;
            EventBus.$on('showCameraOnMap', camera_id => {
                vm.active_cam_id = camera_id;
            });
        }
    }
</script>

<style scoped>

</style>
