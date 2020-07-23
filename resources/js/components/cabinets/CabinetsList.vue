<template>
    <div class="list-group">
        <div class="list-group-item" v-for="cabinet in cabinets" :key="cabinet.id">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><a class="list-group-item-action" :href="linkToShow(cabinet)" title="Подробнее">{{ cabinet.title }}</a></h5>
                <small title="местоположение">{{ cabinet.location_km }} км, {{ cabinet.location_piket }} пикет</small>
            </div>

            <div class="d-flex">
                <dl class="row mb-n1">
                    <dt class="col">Камер</dt>
                    <dd class="col">{{ cabinet.cameras_count || 'нет'}}</dd>
                </dl>
            </div>

            <div class="d-flex w-100 justify-content-between">
                <a href="#" :title="cabinet.id" class="badge badge-light" v-on:click.prevent="showCabinetOnMap(cabinet.id)">Показать на карте</a>
                <span class="badge badge-dark" title="ОПО">{{ cabinet.sector.title }}</span>
            </div>

        </div>
    </div>

</template>

<script>
    import { EventBus } from "../../event-bus";

    export default {
        name: "CabinetsList",
        props: ['cabinets'],
        data() {
            return {

            }
        },
        methods: {
            showCabinetOnMap(id) {
                EventBus.$emit('showCabinetOnMap', id);
            },
            linkToShow(cabinet) {
                return `/cabinets/${cabinet.id}`
            },
        }
    }
</script>

<style scoped>

</style>
