/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import 'leaflet/dist/leaflet.css';

// FIX leaflet's default icon path problems with webpack
import L from 'leaflet'
delete L.Icon.Default.prototype._getIconUrl
L.Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png')
})
// end FIX

import { LMap, LTileLayer, LControlLayers, LMarker, LPopup, LTooltip, LFeatureGroup, LControlScale, LCircleMarker, LControl } from 'vue2-leaflet';

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-control-layers', LControlLayers);
Vue.component('l-control-scale', LControlScale);
Vue.component('l-marker', LMarker);
Vue.component('l-popup', LPopup);
Vue.component('l-tooltip', LTooltip);
Vue.component('l-feature-group', LFeatureGroup);
Vue.component('l-circle-marker', LCircleMarker);
Vue.component('l-control', LControl);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./components', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
