$(document).ready(function(){
    NProgress.start();
});
$(window).load(function(){
    setTimeout(function(){
        NProgress.set(0.4);
    }, 500);
    setTimeout(function(){
        NProgress.set(0.6);
    }, 1000);
    setTimeout(function(){
        NProgress.set(0.8);
    }, 1500);
    setTimeout(function(){
        NProgress.done();
    }, 2000);
});