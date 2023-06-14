import './bootstrap.js'
import { createApp } from "vue";
import App from "./App.vue";
import Router from './router.js'
import CKEditor from '@ckeditor/ckeditor5-vue';

createApp(App)
.use(Router)
.use( CKEditor )
.mount("#app");