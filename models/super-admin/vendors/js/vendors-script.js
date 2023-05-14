$(document).ready(()=>{

    //alerts
    $(".av-alert").hide()

    // Add new vendor
    $("#AddVendorForm").on("submit", (e)=>{
        e.preventDefault()
        $.ajax({
            url:'../models/',
            method:'',
            cache: false,
            data: $("#AddVendorForm").serialize(),
            success:(Response)=>{
                let response = JSON.parse(Response)
                console.log
            }
        })
    })

})