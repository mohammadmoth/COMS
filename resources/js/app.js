/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'

import router from './router'

import * as auth   from './api/auth.js'











const PluginMethodeGlobal = {
  install () {
      Vue.auth = auth
      Vue.prototype.$auth = auth


  }
}


Vue.use(PluginMethodeGlobal)

/***lang start */
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)


import { languages } from './lang/config.js'
import { defaultLocale } from './lang/config.js'
import { htmlDir } from './lang/config.js'
const messages = Object.assign(languages)
/***lang end */

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./layouts/welcome.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router, // router
    auth,

//lang start
    i18n: new VueI18n({
        locale: defaultLocale,
        fallbackLocale: 'ar',
         messages
      })

      ,created(){
        let htmlEl=document.querySelector("html");
         htmlEl.setAttribute('dir',htmlDir[defaultLocale]);
         htmlEl.setAttribute('lang',defaultLocale);
       },
//langend

});
