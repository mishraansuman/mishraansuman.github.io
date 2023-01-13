"use strict";
let gssharelist = document.getElementsByClassName('gs-share-link');
for (let i = 0; i < gssharelist.length; i++) {
    gssharelist[i].addEventListener("click", (e) => {
        e.preventDefault();
        let href = e.currentTarget.getAttribute("data-href"),
            service = e.currentTarget.getAttribute("data-service"),
            width = "pinterest" === service ? 750 : 650,
            height  = "twitter" === service || "linkedin" === service ? 500 : "pinterest" === service ? 320 : 300,
            top     = ( screen.height / 2 ) - height / 2,
            left    = ( screen.width / 2 ) - width / 2;
            
            let options = "top=" + top + ",left=" + left + ",width=" + width + ",height=" + height;
            window.open( href, service, options );
    }, false);
}