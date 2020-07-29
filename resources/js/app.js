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
     fetch(url)
     .then((res)=>{
         return res.json();
     })
     .then((json)=>{
        document.getElementById('topBanner').getElementsByTagName('img')[0].setAttribute('src',json.top.img);
        document.getElementById('topBanner').getElementsByTagName('img')[0].setAttribute('alt',json.top.alt_text);
        document.getElementById('topBanner').getElementsByTagName('img')[0].setAttribute('title',json.top.title);
        document.getElementById('topBanner').getElementsByTagName('img')[0].style.width = json.top.dimension.width;
        document.getElementById('topBanner').getElementsByTagName('a')[0].setAttribute('href',json.top.url);

        let el = document.getElementById('resultBanner');
        if(el!==null){
            el.getElementsByTagName('img')[0].setAttribute('src',json.result.img);
            el.getElementsByTagName('img')[0].setAttribute('alt',json.result.alt_text);
            el.getElementsByTagName('img')[0].setAttribute('title',json.result.title);
            el.getElementsByTagName('img')[0].style.width = json.result.dimension.width;
            el.getElementsByTagName('a')[0].setAttribute('href',json.result.url);
        }
        
        document.getElementById('contentBanner0').getElementsByTagName('img')[0].setAttribute('src',json.content[0].img);
        document.getElementById('contentBanner0').getElementsByTagName('img')[0].setAttribute('alt',json.content[0].alt_text);
        document.getElementById('contentBanner0').getElementsByTagName('img')[0].setAttribute('title',json.content[0].title);
        document.getElementById('contentBanner0').getElementsByTagName('img')[0].style.width = json.content[0].dimension.width;
        document.getElementById('contentBanner0').getElementsByTagName('a')[0].setAttribute('href',json.content[0].url);

        document.getElementById('contentBanner1').getElementsByTagName('img')[0].setAttribute('src',json.content[1].img);
        document.getElementById('contentBanner1').getElementsByTagName('img')[0].setAttribute('alt',json.content[1].alt_text);
        document.getElementById('contentBanner1').getElementsByTagName('img')[0].setAttribute('title',json.content[1].title);
        document.getElementById('contentBanner1').getElementsByTagName('img')[0].style.width = json.content[0].dimension.width;
        document.getElementById('contentBanner1').getElementsByTagName('a')[0].setAttribute('href',json.content[1].url);

        document.getElementById('contentBanner2').getElementsByTagName('img')[0].setAttribute('src',json.content[2].img);
        document.getElementById('contentBanner2').getElementsByTagName('img')[0].setAttribute('alt',json.content[2].alt_text);
        document.getElementById('contentBanner2').getElementsByTagName('img')[0].setAttribute('title',json.content[2].title);
        document.getElementById('contentBanner2').getElementsByTagName('img')[0].style.width = json.content[0].dimension.width;
        document.getElementById('contentBanner2').getElementsByTagName('a')[0].setAttribute('href',json.content[2].url);

        document.getElementById('contentBanner3').getElementsByTagName('img')[0].setAttribute('src',json.content[3].img);
        document.getElementById('contentBanner3').getElementsByTagName('img')[0].setAttribute('alt',json.content[3].alt_text);
        document.getElementById('contentBanner3').getElementsByTagName('img')[0].setAttribute('title',json.content[3].title);
        document.getElementById('contentBanner3').getElementsByTagName('img')[0].style.width = json.content[0].dimension.width;
        document.getElementById('contentBanner3').getElementsByTagName('a')[0].setAttribute('href',json.content[3].url);

        document.getElementById('contentBanner4').getElementsByTagName('img')[0].setAttribute('src',json.content[4].img);
        document.getElementById('contentBanner4').getElementsByTagName('img')[0].setAttribute('alt',json.content[4].alt_text);
        document.getElementById('contentBanner4').getElementsByTagName('img')[0].setAttribute('title',json.content[4].title);
        document.getElementById('contentBanner4').getElementsByTagName('img')[0].style.width = json.content[0].dimension.width;
        document.getElementById('contentBanner4').getElementsByTagName('a')[0].setAttribute('href',json.content[4].url);

        document.getElementById('contentBanner5').getElementsByTagName('img')[0].setAttribute('src',json.content[5].img);
        document.getElementById('contentBanner5').getElementsByTagName('img')[0].setAttribute('alt',json.content[5].alt_text);
        document.getElementById('contentBanner5').getElementsByTagName('img')[0].setAttribute('title',json.content[5].title);
        document.getElementById('contentBanner5').getElementsByTagName('img')[0].style.width = json.content[0].dimension.width;
        document.getElementById('contentBanner5').getElementsByTagName('a')[0].setAttribute('href',json.content[5].url);
        

        el = document.getElementById('stickyBanner');
        if(el!==null){
            el.getElementsByTagName('img')[0].setAttribute('src',json.sticky.img);
            el.getElementsByTagName('img')[0].setAttribute('alt',json.sticky.alt_text);
            el.getElementsByTagName('img')[0].setAttribute('title',json.sticky.title);
            el.getElementsByTagName('img')[0].style.width = json.sticky.dimension.width;
            el.getElementsByTagName('a')[1].setAttribute('href',json.sticky.url); // phan tu [0] la nut close
        }
     });
}

window.toggleStickyBanner = function(id){
    let el=document.getElementById(id);
    setInterval(() => {
        el.style.bottom = el.style.bottom==="0px"?"-120px":"0px"; 
    }, 5000);
}

/**
 * Canvas and QR image
 */
window.saveQrImage = function(){
    const canvas = document.createElement('canvas');
    const img = document.getElementById('qrResultImage');
    canvas.width=img.width;
    canvas.height=img.height;
    const context = canvas.getContext('2d');
    context.drawImage(img,0,0);
    
    document.getElementById('qrResultSave').href = canvas.toDataURL('image/png');
}

window.passValuesToChangeUsernameModal = function(id,name){
    document.getElementById("username").value = name;
    document.getElementById("userid").value = id;
}

window.changeUsername = function(id,name){
    //console.log('call ajax')
    $.ajax({
        url: '../utils/changeUsername',
        type: 'get',
        data: {'username':name,'userid':id},
        success: function(res){
            document.getElementById('showUsername').innerText = res;
        },
        dataType: 'text'
    });
    // console.log('end call ajax')
}