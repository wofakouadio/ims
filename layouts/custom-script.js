$(document).ready(()=>{
    /**
     * Handle the jQuery UI widget'sidebar type
     * toggle mini-sidebar
     */
    $("#main-wrapper").attr("data-sidebartype", "mini-sidebar").attr("class", "mini-sidebar");

    // custom select
    $(".custom-select").select2();
})