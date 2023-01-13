"use strict";
let anchorscrollers = document.getElementsByClassName('gs-smoothscrollto');
const GSPBscrollIntoViewWithOffset = (selector, offset) => {
    window.scrollTo({
      behavior: 'smooth',
      top:
        document.querySelector(selector).getBoundingClientRect().top -
        document.body.getBoundingClientRect().top -
        offset,
    })
  }
for (let i = 0; i < anchorscrollers.length; i++) {
    let obj= anchorscrollers[i];
    obj.addEventListener('click', function (e) {
        e.preventDefault();
        let offset = obj.getAttribute('data-scrolloffset') || 0;
        GSPBscrollIntoViewWithOffset(this.getAttribute('href'), offset);
    });
}