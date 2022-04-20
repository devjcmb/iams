import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router'
import env from './env.ts'

process.env.app = env;

createApp(App).use(router).mount('#app')