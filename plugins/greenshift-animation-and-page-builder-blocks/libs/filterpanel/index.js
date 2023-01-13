const gcfiltersortBtns = document.querySelectorAll('.gspb_filtersort_btn:not(.active)');
gcfiltersortBtns.forEach(item => {
    item.addEventListener('click', function (ev) {
        let item = ev.target;
        let containerid = item.dataset.containerid;
        let activecontainer = document.getElementById(containerid);
        let sorttype = item.dataset.sorttype;
        let offset = item.dataset.offset;
        let filterPanel = activecontainer.parentElement.querySelector('.gspb_filter_panel');
        let choosenTax = filterPanel.querySelector('.gspb_tax_dropdown .gspb_choosed_tax');
        let tax;
        if (choosenTax !== null && choosenTax.innerHTML != '') {
            tax = choosenTax.getAttribute('data-taxdata');
           
        }
        let filterargs = activecontainer.dataset.filterargs;
        let innerargs = activecontainer.dataset.innerargs;
        let template = activecontainer.dataset.template;

        item.closest('ul').classList.add('activeul'); 
        item.classList.add('gspb_loadingbefore');         
        activecontainer.classList.add('sortingloading');

        const request = new XMLHttpRequest();
        request.open('POST', gspbscriptvars.ajax_url, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.responseType = 'json';
        request.onload = function () {
            if (this.status >= 200 && this.status < 400) {
                let responseobj = this.response.data;
                activecontainer.innerHTML = '';
                activecontainer.insertAdjacentHTML('beforeend',responseobj);

                item.closest('.gspb_filter_panel').querySelectorAll('span').forEach(function(itemfilter) {
                    itemfilter.classList.remove('active');
                });
                  
                item.classList.remove('gspb_loadingbefore');
                item.classList.add('active');               
                activecontainer.classList.remove('sortingloading'); 
                item.closest('ul').classList.remove('activeul'); 
                if(item.closest('ul').classList.contains('gspb_tax_dropdown')){
                    var taxDropdown = item.closest('.gspb_tax_dropdown');
                    taxDropdown.querySelector('.gspb_choosed_tax').innerHTML = item.innerHTML;
                    taxDropdown.querySelector('.gspb_choosed_tax').style.display = "block";
                    taxDropdown.querySelector('.gspb_choosed_tax').setAttribute('data-taxdata', item.getAttribute('data-sorttype'));
                    taxDropdown.querySelector('.gspb_tax_placeholder').style.display = "none";
                    filterPanel.querySelector('.gspb_filter_ul li:first-child span').classList.add('active');
                } 
    
            } else {
                // Response error
            }
        };
        request.onerror = function() {
            // Connection error
        };
        request.send('action=gspb_filterpost&security=' + gspbscriptvars.filternonce + '&sorttype=' + sorttype + '&filterargs='+filterargs +'&template=' + template + '&tax='+tax+'&containerid='+containerid+'&offset='+offset+'&innerargs='+innerargs);
    }, false);
});

const gctaxsortBtns = document.querySelectorAll('.gspb_tax_dropdown .label');
gctaxsortBtns.forEach(item => {
    item.addEventListener('click', function (ev) {
        ev.stopPropagation();
        ev.preventDefault();
        ev.target.closest('.gspb_tax_dropdown').classList.toggle('active');
    });
});

const gcfiltersortActives = document.querySelectorAll('.gspb_filter_ul .gspb_filtersort_btn.active');
gcfiltersortActives.forEach(item => {
    item.addEventListener('click', function (ev) {
        ev.preventDefault();
        ev.target.closest('.gspb_filter_panel').querySelectorAll('ul.gspb_filter_ul span').classList.toggle('showfiltermobile');
    });
});