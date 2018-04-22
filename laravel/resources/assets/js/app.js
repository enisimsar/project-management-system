
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import './bootstrap';
import CategoryCard from "./components/CategoryCard.vue";

Vue.component('category-card', CategoryCard);

const app = new Vue({
    el: '#app'
});
