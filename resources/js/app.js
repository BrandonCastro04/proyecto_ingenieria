/*import './bootstrap';*/
import { createApp } from 'vue';
import router from './router/index';
import App from './components/App.vue';
import store from './store';

createApp(App)
.use(store)
.use(router)
.mount('#app');

