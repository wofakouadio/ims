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

        //User Account Type
        $(".uat-alert").hide()
        $("#UserAccountType").on("show.bs.modal", (event)=>{

            let str = $(event.relatedTarget)
            let user_id = str.data("user_id")
            let modal = $("#UserAccountType")
            $.ajax({
                url:'../models/server/super-admin/user-data-script.php',
                method:'GET',
                cache:false,
                data:{user_id:user_id},
                success:(UserData_Response)=>{
                    let user_data = JSON.parse(UserData_Response)
                    modal.find("input[name=user_fullname]").val(user_data.data.user_fullname)
                    modal.find("select[name=user_type]").val(user_data.data.user_type)
                    modal.find("input[name=user_id]").val(user_id)
                }
            })
        })

        // User Account Status
        $(".uas-alert").hide()
        $("#UserAccountStatus").on("show.bs.modal", (event)=>{

            let str = $(event.relatedTarget)
            let user_id = str.data("user_id")
            let modal = $("#UserAccountStatus")
            $.ajax({
                url:'../models/server/super-admin/user-data-script.php',
                method:'GET',
                cache:false,
                data:{user_id:user_id},
                success:(UserData_Response)=>{
                    let user_data = JSON.parse(UserData_Response)
                    modal.find("input[name=user_fullname]").val(user_data.data.user_fullname)
                    modal.find("select[name=user_status]").val(user_data.data.user_status)
                    modal.find("input[name=user_id]").val(user_id)
                }
            })
        })

        // User Account Reset
        $(".uar-alert").hide()
        $("#UserAccountReset").on("show.bs.modal", (event)=>{

            let str = $(event.relatedTarget)
            let user_id = str.data("user_id")
            let modal = $("#UserAccountReset")
            $.ajax({
                url:'../models/server/super-admin/user-data-script.php',
                method:'GET',
                cache:false,
                data:{user_id:user_id},
                success:(UserData_Response)=>{
                    let user_data = JSON.parse(UserData_Response)
                    modal.find(".uar-notice").text("Are you sure you want to reset "+user_data.data.user_fullname+" Account?")
                    modal.find("input[name=user_id]").val(user_id)
                }
            })
        })

        // User Account Delete
        $(".uad-alert").hide()
        $("#UserAccountDelete").on("show.bs.modal", (event)=>{

            let str = $(event.relatedTarget)
            let user_id = str.data("user_id")
            let modal = $("#UserAccountDelete")
            $.ajax({
                url:'../models/server/super-admin/user-data-script.php',
                method:'GET',
                cache:false,
                data:{user_id:user_id},
                success:(UserData_Response)=>{
                    let user_data = JSON.parse(UserData_Response)
                    modal.find(".uad-notice").text("Are you sure you want to delete "+user_data.data.user_fullname+" Account?")
                    modal.find("input[name=user_id]").val(user_id)
                }
            })
        })

})