// Javascript file handling all scripts for login page

$("document").ready(()=>{


    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();

    // reset login form
    $("#btn-reset").on("click", (e)=>{
        e.preventDefault()
        $("#login-form")[0].reset();
        window.location.href = "../logout/"
    })

    // show/hide password
    $("#btn-pass").on("click", (e)=>{
        e.preventDefault()
        let u_pass = $("input[name=u-pass]")
        let eye_icon = $("#eye-icon")

        if(u_pass.attr("type") == "password"){
            u_pass.attr("type","text")
            eye_icon.attr("class", "fas fa-eye")
        }else{
            u_pass.attr("type","password")
            eye_icon.attr("class", "fas fa-eye-slash")
        }
    })

    /**************************************/
    /** USER VERIFICATION **/
    /**************************************/

        // ALERTS
        $(".uv-alert").hide()
        // $(".ul-alert").hide()

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
                        // $(".ul-alert").hide()
                        // $(".uv-alert").removeClass("alert-success")
                    }else{
                        $("#login-form .ul-alert").show().addClass("alert-success").find(".alert-content").text(user_verification.msg)
                        // $(".uv-alert").hide()
                        $("#login-form").find("input[name=u-name]").val(user_verification.data.user_name)
                        $("#login-form").find("input[name=u-id]").val(user_verification.data.user_id)
                        window.location.href = user_verification.data.url
                    }
                    // console.log(user_verification)=
                }
            })

        })


    /**************************************/
    /** USER LOGIN **/
    /**************************************/

        // ALERTS
        $(".ul-alert").hide()
        // Login form submission
        $("#login-form").on("submit", (e)=>{

            e.preventDefault();
            $.ajax({
                url:'../models/server/login/user-login-script.php',
                method: 'POST',
                cache: false,
                data: $("#login-form").serialize(),
                success:(UserLogin_Response)=>{
                    let user_login = JSON.parse(UserLogin_Response)
                    if(user_login.status == "failed"){
                        $(".ul-alert").show().addClass("alert-warning").find(".alert-content").text(user_login.msg)
                        $(".ul-alert").removeClass("alert-success")
                    }else{
                        $(".ul-alert").show().addClass("alert-success").find(".alert-content").text(user_login.msg)
                        $(".ul-alert").removeClass("alert-warning")
                        window.location.href = "../"+user_login.data.url
                    }
                    console.log(user_login)
                }
            })

        })

})