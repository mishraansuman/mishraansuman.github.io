const gcInfiniteObserves = document.getElementsByClassName('gspb_ajax_pagination_btn');

let infiniteobserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            let item = entry.target;
            GSPBajaxpagination(item);
            //observer.disconnect();
        }
    });
});

for (let itemobserve of gcInfiniteObserves) {
    infiniteobserver.observe(itemobserve);
}

function GSPBajaxpagination(item){
    let containerid = item.dataset.containerid;
    let activecontainer = document.getElementById(containerid);
    let sorttype = item.dataset.sorttype;
    let offset = item.dataset.offset;
    let perpage = parseInt(activecontainer.dataset.perpage);
    let filterPanel = activecontainer.parentElement.querySelector('.gspb_filter_panel');
    let choosenTax = filterPanel.querySelector('.gspb_tax_dropdown .gspb_choosed_tax');
    let tax;
    if (choosenTax.length > 0 && choosenTax.html() != '') {
        tax = choosenTax.getAttribute('data-taxdata');
        if (tax) {
            tax = JSON.parse(tax);
        }
    }
    let filterargs = activecontainer.dataset.filterargs;
    let innerargs = activecontainer.dataset.innerargs;
    let template = activecontainer.dataset.template;
    let data = {
        'action': 'gspb_filterpost',
        'sorttype': sorttype,
        'filterargs': filterargs,
        'template': template,
        'tax': tax,
        'containerid': containerid,
        'offset': offset,
        'innerargs': innerargs,
        'security': gspbscriptvars.filternonce
    };
    const request = new XMLHttpRequest();
    request.open('POST', gspbscriptvars.ajax_url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.responseType = 'json';
    request.onload = function () {
        if (this.status >= 200 && this.status < 400) {
            let responseobj = this.response.data;
            activecontainer.insertAdjacentHTML('beforeend',responseobj);
            if( responseobj.indexOf('gcnomoreclass') >= 0){
                activecontainer.querySelector('.gspb_ajax_pagination').remove();
            }else{
                activecontainer.appendChild(activecontainer.querySelector('.gspb_ajax_pagination'));
                let offsetactual = parseInt(activecontainer.querySelector('.gspb_ajax_pagination span').dataset.offset);
                activecontainer.querySelector('.gspb_ajax_pagination span').dataset.offset = offsetactual + perpage;
            }

        } else {
            // Response error
        }
    };
    request.onerror = function() {
        // Connection error
    };
    request.send('action=gspb_filterpost&security=' + gspbscriptvars.filternonce + '&sorttype=' + sorttype + '&filterargs='+filterargs +'&template=' + template + '&tax='+tax+'&containerid='+containerid+'&offset='+offset+'&innerargs='+innerargs);
}