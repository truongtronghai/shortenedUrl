/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('admin-breadcrumb-component', require('./components/AdminBreadcrumbComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

/**
 * Script for managing banners
 * Why do I use the weird way to declare functions?
 * => read this: https://www.green-box.co.uk/adding-javascript-functions-to-laravel-mix-and-why-you-get-error-uncaught-referenceerror-function-is-not-defined/
 */
window.getBanners = function(url){
    //console.log(url);
     fetch(url)
     .then((res)=>{
         //console.log(res);
         return res.json();
     })
     .then((json)=>{
        document.getElementById('topBanner').getElementsByTagName('img')[0].setAttribute('src',json.top.img);
        document.getElementById('topBanner').getElementsByTagName('a')[0].setAttribute('href',json.top.url);

        let el = document.getElementById('resultBanner');
        if(el!==null){
            el.getElementsByTagName('img')[0].setAttribute('src',json.result.img);
            el.getElementsByTagName('a')[0].setAttribute('href',json.result.url);
        }
        
        document.getElementById('contentBanner0').getElementsByTagName('img')[0].setAttribute('src',json.content[0].img);
        document.getElementById('contentBanner0').getElementsByTagName('a')[0].setAttribute('href',json.content[0].url);

        document.getElementById('contentBanner1').getElementsByTagName('img')[0].setAttribute('src',json.content[1].img);
        document.getElementById('contentBanner1').getElementsByTagName('a')[0].setAttribute('href',json.content[1].url);

        document.getElementById('contentBanner2').getElementsByTagName('img')[0].setAttribute('src',json.content[2].img);
        document.getElementById('contentBanner2').getElementsByTagName('a')[0].setAttribute('href',json.content[2].url);

        document.getElementById('contentBanner3').getElementsByTagName('img')[0].setAttribute('src',json.content[3].img);
        document.getElementById('contentBanner3').getElementsByTagName('a')[0].setAttribute('href',json.content[3].url);

        document.getElementById('contentBanner4').getElementsByTagName('img')[0].setAttribute('src',json.content[4].img);
        document.getElementById('contentBanner4').getElementsByTagName('a')[0].setAttribute('href',json.content[4].url);

        document.getElementById('contentBanner5').getElementsByTagName('img')[0].setAttribute('src',json.content[5].img);
        document.getElementById('contentBanner5').getElementsByTagName('a')[0].setAttribute('href',json.content[5].url);
        

        el = document.getElementById('stickyBanner');
        if(el!==null){
            el.getElementsByTagName('img')[0].setAttribute('src',json.top.img);
            el.getElementsByTagName('a')[0].setAttribute('href',json.top.url);
        }
     });
}

window.toggleStickyBanner = function(id){
    let el=document.getElementById(id);
    setInterval(() => {
        el.style.bottom = el.style.bottom==="0px"?"-120px":"0px"; 
    }, 5000);
}