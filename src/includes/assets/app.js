import { createApp } from 'vue'
import MainComponent from "./component/main-component.js";

window.addEventListener('load', function () {
    createApp(MainComponent).mount('#app')
    document.getElementById('loader').classList.add('d-none')
    document.getElementById('app').classList.remove('d-none')
});