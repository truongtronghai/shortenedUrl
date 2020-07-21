function toggleSidebar(classNameToggle){
    if(document.body.classList.contains(classNameToggle))
        document.body.classList.remove(classNameToggle);
    else
        document.body.classList.add(classNameToggle);
}

function addActiveStageNavLink(){
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    var sideNavLinks = document.getElementById('layoutSidenav_nav')
                                .getElementsByClassName('sb-sidenav')[0]
                                .getElementsByClassName('nav-link');
    
    var arrSideNavLinks = [...sideNavLinks];// chuyen tu HTMLCollection thanh array
    
    arrSideNavLinks.forEach(element => {
        if(element.href === path)
            element.classList.add('active');
    });
}