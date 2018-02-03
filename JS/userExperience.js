function initResponsive() {
    var winHeight = window.innerHeight;
    var headerHeight =  document.getElementById("page-header-wrapper").offsetHeight; //computed values
    var footerHeight = document.getElementById('footer-wrapper').offsetHeight; //computed values

    document.getElementById("body-wrapper").style.minHeight = winHeight - headerHeight - footerHeight + "px";
}
