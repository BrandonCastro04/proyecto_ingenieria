/*import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
*/
window._ = require('loadash');
try{
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstap');
} catch (e){}

window.axios = require(axios);
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector( 'meta[name="csrf-token"]');
if(token){
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.textContent;
}else{
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    
}