// Javascript file handling all scripts for login page

$("document").ready(()=>{


    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();

    // reset login form
    $("#btn-reset").on("click", (e)=>{
        e.preventDefault()
        $("#login-form")[0].reset();
        window.location.href = "user-verification"
    })

    /**************************************/
    /** USER VERIFICATION **/
    /**************************************/

        // ALERTS
        $(".uv-alert").hide()

        // submit verification form
        $("#verification-form").on("submit", (e)=>{

            e.preventDefault()
            $.ajax({
                url:'../models/server/login/user-verification-script.php',
                method:'POST',
                cache:false,
                data: $("#verification-form").serialize(),
                success:(UserVerification_Response)=>{
                    let user_verification = JSON.parse(UserVerification_Response)
                    if(user_verification.status == 'failed'){
                        $(".uv-alert").show().addClass("alert-warning").find(".alert-content").text(user_verification.msg)
                    }else{
                        $(".uv-alert").hide()
                    }
                    console.log(user_verification)
                }
            })

        })

})