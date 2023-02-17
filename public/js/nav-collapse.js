document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
        element.addEventListener('click', function(e){
            let nextEl = element.nextElementSibling;
            let parentEl = element.parentElement;

            if(nextEl){
                e.preventDefault();
                let myCollapse = new bootstrap.Collapse(nextEl);

                if(nextEl.classList.contains('show')){
                    myCollapse.hide();
                } else {
                    myCollapse.show();
                    // find another submenu with class = show
                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    // if it exists, then close all of them
                    if(opened_submenu){
                        new bootstrap.Collapse(opened_submenu);
                    }
                }
                
            }
        }); // addEventListener
    }) // forEach
});