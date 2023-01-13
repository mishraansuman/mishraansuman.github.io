var loadedswiper = false;

const onGSSwiperInteraction = (init = false) => {
    if (loadedswiper === true) {
        return;
    }
    loadedswiper = true;

    const SwiperScript = document.createElement("script");
    SwiperScript.src = gs_swiper_params.pluginURL + "/libs/swiper/swiper-bundle.min.js";
    SwiperScript.id = 'gs-swiper-loaded';
    document.body.appendChild(SwiperScript);

    setTimeout(function(){
        const SwiperScriptInit = document.createElement("script");
        SwiperScriptInit.src = gs_swiper_params.pluginURL + "/libs/swiper/init.js";
        SwiperScriptInit.id = 'gs-swiper-loaded-init';
        document.body.appendChild(SwiperScriptInit);
    }, 200);

};

document.body.addEventListener("mouseover", onGSSwiperInteraction, {once:true});
document.body.addEventListener("touchmove", onGSSwiperInteraction, {once:true});
window.addEventListener("scroll", onGSSwiperInteraction, {once:true});
document.body.addEventListener("keydown", onGSSwiperInteraction, {once:true});