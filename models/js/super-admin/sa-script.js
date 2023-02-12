$(document).ready(()=>{

    /**
    * Handle the jQuery UI widget'sidebar type
    * toggle mini-sidebar
    */
        $("#main-wrapper").attr("data-sidebartype", "mini-sidebar").attr("class", "mini-sidebar");

    /**
    * Users
    */
        // User registration
            $(".ur-alert").hide()
            $("#NewUserForm").on("submit", (e)=>{
                e.preventDefault()
                let form_data = $("#NewUserForm")[0]
                $.ajax({
                    url:'../models/server/super-admin/new-user-script.php',
                    method:'POST',
                    cache:false,
                    contentType:false,
                    processData:false,
                    data: new FormData(form_data),
                    success:(NewUserResponse)=>{
                        let new_user = JSON.parse(NewUserResponse)
                        if(new_user.status == "failed" && new_user.error == null){
                            $(".ur-alert").show().addClass("alert-warning").text(new_user.msg)
                            $(".ur-alert").removeClass("alert-danger")
                            $(".ur-alert").removeClass("alert-success")
                        }
                        else if(new_user.status == "failed" && new_user.error != null){
                            $(".ur-alert").show().addClass("alert-danger").text(new_user.msg)
                            $(".ur-alert").removeClass("alert-warning")
                            $(".ur-alert").removeClass("alert-success")
                        }else if(new_user.status == "success" && new_user.error == null) {
                            $(".ur-alert").removeClass("alert-success")
                            $(".ur-alert").removeClass("alert-warning")
                            $(".ur-alert").removeClass("alert-danger")
                            $('#usersListviewDataTables').DataTable().draw()
                            $("#NewUserModal").modal("hide")
                            $("#NewUserForm")[0].reset()
                            toastr.success(new_user.msg, "Notification")
                        }
                    }
                })
            })

})