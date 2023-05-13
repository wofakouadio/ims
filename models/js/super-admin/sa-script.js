$(document).ready(()=>{

    /**
    * Handle the jQuery UI widget'sidebar type
    * toggle mini-sidebar
    */
        $("#main-wrapper").attr("data-sidebartype", "mini-sidebar").attr("class", "mini-sidebar");

    // custom select
    $(".custom-select").select2();

    /**
    * Users
    */
        // User registration
            $(".ur-alert").hide()
            $("#NewUserForm").on("submit", (e)=>{
                e.preventDefault()
                let form_data = $("#NewUserForm")[0]
                $.ajax({
                    url:'../models/server/super-admin/users/new-user-script.php',
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

        // User Account View
        $(".uau-alert").hide()
        $("#UserAccountUpdate").on("show.bs.modal", (event)=>{

            let str = $(event.relatedTarget)
            let modal = $("#UserAccountUpdate")
            let user_id = str.data("user_id")
            $.ajax({
                url:'../models/server/super-admin/users/user-data-script.php',
                method:'GET',
                cache:false,
                data:{user_id:user_id},
                success:(UserData_Response)=>{
                    let user_data = JSON.parse(UserData_Response)
                    modal.find("input[name=user_fullname]").val(user_data.data.user_fullname)
                    modal.find("input[name=user_id]").val(user_id)
                    modal.find("input[name=user_dob]").val(user_data.data.user_dob)
                    modal.find("select[name=user_gender]").val(user_data.data.user_gender)
                    modal.find("input[name=user_placeOfBirth]").val(user_data.data.user_placeofBirth)
                    modal.find("input[name=user_address1]").val(user_data.data.user_address_one)
                    modal.find("input[name=user_address2]").val(user_data.data.user_address_two)
                    modal.find("input[name=user_mobile]").val(user_data.data.user_mobile)
                    modal.find("input[name=user_contact]").val(user_data.data.user_contact)
                    modal.find("input[name=user_email]").val(user_data.data.user_email)
                }
            })
        })

        // Update User Account View
        $("#UserAccountUpdateForm").on("submit", (e)=>{

            e.preventDefault()
            $.ajax({
                url:'../models/server/super-admin/users/user-info-data-update-script.php',
                method:'POST',
                cache:false,
                data: $("#UserAccountUpdateForm").serialize(),
                success:(UserAccountUpdateFrom)=>{
                    let user_account_update = JSON.parse(UserAccountUpdateFrom)
                    if(user_account_update.status == "failed"){
                        $(".uau-alert").show().addClass(".alert-warning").text(user_account_update.msg)
                    }else{
                        $(".uau-alert").hide()
                        $("#UserAccountUpdate").modal("hide");
                        $('#users-listview-dataTables').DataTable().draw()
                        toastr.success(user_account_update.msg, "Notification")
                    }
                }
            })

        })


        // User Account Identity
        $(".uai-alert").hide()
        $("#UserIdentityUpdate").on("show.bs.modal", (event)=>{

            let str = $(event.relatedTarget);
            let user_id = str.data("user_id");
            let modal = $("#UserIdentityUpdate")
            $.ajax({
                url:'../models/server/super-admin/users/user-data-script.php',
                method:'GET',
                cache:false,
                data:{user_id:user_id},
                success:(UserData_Response)=>{
                    let user_data = JSON.parse(UserData_Response)
                    modal.find("input[name=user_fullname]").val(user_data.data.user_fullname)
                    modal.find("input[name=user_id]").val(user_id)
                    modal.find(".user-profile").html("<img src='../../../user-files/"+user_data.data.user_profile+"' width='150px' class='img'>")
                    modal.find(".user-id-profile").html("<img src='../../../user-files/"+user_data.data.user_id_profile+"' width='150px' class='img'>")
                }
            })

        })

        // Update User Account Identity
        $(".uai-alert").hide()
        $("#UserIdentityUpdateForm").on("submit", (e)=>{

            let form_data = $("#UserIdentityUpdateForm")[0]

            e.preventDefault()
            $.ajax({
                url:'../models/server/super-admin/users/user-identity-data-update-script.php',
                method:'POST',
                contentType:false,
                processData:false,
                data: new FormData(form_data),
                success:(UserIdentity_Response)=>{
                    let user_identity = JSON.parse(UserIdentity_Response)
                    if(user_identity.status == "failed"){
                        $(".uai-alert").show().addClass("alert-warning").text(user_identity.msg)
                    }else{
                        $(".uai-alert").hide()
                        $("#UserIdentityUpdate").modal("hide")
                        $("#UserIdentityUpdateForm")[0].reset()
                        toastr.success(user_identity.msg, "Notification")
                        $('#users-listview-dataTables').DataTable().draw()
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
                url:'../models/server/super-admin/users/user-data-script.php',
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

        // Update User Account Type
        $("#UserAccountTypeForm").on("submit", (e)=>{

            e.preventDefault()
            $.ajax({
                url:'../models/server/super-admin/users/user-type-data-update-script.php',
                cache:false,
                method:'POST',
                data: $("#UserAccountTypeForm").serialize(),
                success:(UserAccountType_Response)=>{
                    let user_account_type = JSON.parse(UserAccountType_Response)
                    if(user_account_type.status == "failed"){
                        $(".uat-alert").show().addClass("alert-warning").text(user_account_type.msg)
                    }else{
                        $(".uat-alert").hide()
                        $("#UserAccountType").modal('hide')
                        toastr.success(user_account_type.msg, "Notification")
                        $('#users-listview-dataTables').DataTable().draw()
                    }
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
                url:'../models/server/super-admin/users/user-data-script.php',
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

        // Update User Account Status
        $("#UserAccountStatusForm").on("submit", (e)=>{

            e.preventDefault()
            $.ajax({
                url:'../models/server/super-admin/users/user-status-data-update-script.php',
                cache:false,
                method:'POST',
                data: $("#UserAccountStatusForm").serialize(),
                success:(UserAccountStatus_Response)=>{
                    let user_account_status = JSON.parse(UserAccountStatus_Response)
                    if(user_account_status.status == "failed"){
                        $(".uat-alert").show().addClass("alert-warning").text(user_account_status.msg)
                    }else{
                        $(".uat-alert").hide()
                        $("#UserAccountStatus").modal('hide')
                        toastr.success(user_account_status.msg, "Notification")
                        $('#users-listview-dataTables').DataTable().draw()
                    }
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
                url:'../models/server/super-admin/users/user-data-script.php',
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

        // Update User Account Reset
        $("#UserAccountResetForm").on("submit", (e)=>{

            e.preventDefault()
            $.ajax({
                url:'../models/server/super-admin/users/user-reset-data-update-script.php',
                cache:false,
                method:'POST',
                data: $("#UserAccountResetForm").serialize(),
                success:(UserAccountReset_Response)=>{
                    let user_account_reset = JSON.parse(UserAccountReset_Response)
                    if(user_account_reset.reset == "failed"){
                        $(".uat-alert").show().addClass("alert-warning").text(user_account_reset.msg)
                    }else{
                        $(".uat-alert").hide()
                        $("#UserAccountReset").modal('hide')
                        toastr.success(user_account_reset.msg, "Notification")
                        $('#users-listview-dataTables').DataTable().draw()
                    }
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
                url:'../models/server/super-admin/users/user-data-script.php',
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

        // Update User Account Delete
        $("#UserAccountDeleteForm").on("submit", (e)=>{

            e.preventDefault()
            $.ajax({
                url:'../models/server/super-admin/users/user-delete-data-update-script.php',
                cache:false,
                method:'POST',
                data: $("#UserAccountDeleteForm").serialize(),
                success:(UserAccountDelete_Response)=>{
                    let user_account_delete = JSON.parse(UserAccountDelete_Response)
                    if(user_account_delete.delete == "failed"){
                        $(".uat-alert").show().addClass("alert-warning").text(user_account_delete.msg)
                    }else{
                        $(".uat-alert").hide()
                        $("#UserAccountDelete").modal('hide')
                        toastr.success(user_account_delete.msg, "Notification")
                        $('#users-listview-dataTables').DataTable().draw()
                    }
                }
            })

        })

    /**
    * Items
    */

        //dropdown placement for product category
        $("#item-product-category").select2({
            dropdownParent: $("#AddItemModal")
        })
        // Alerts
        $(".ai-alert").hide()
        // Load product categories
        const ProductCategories = () =>{
            $.ajax({
                url:"../models/server/super-admin/items/product-categories-script.php",
                cache:false,
                success:(data)=>{
                    // $("#item-product-category").html(data)
                    $("select[name=item-product-category]").html(data)
                }
            })
        }
        ProductCategories();

        //Add New Item
        $("#AddItemForm").on("submit", (e)=>{
            e.preventDefault()
            let form_data = $("#AddItemForm")[0];
            $.ajax({
                url: '../models/server/super-admin/items/add-item-script.php',
                method:'POST',
                cache:false,
                contentType:false,
                processData:false,
                data: new FormData(form_data),
                success: (AddItem_Response)=>{
                    let response = JSON.parse(AddItem_Response)
                    if(response.status === 'failed'){
                        $(".ai-alert").show().find(".ai-alert-content").text(response.msg + ' Error: ' + response.error)
                    }else{
                        $(".ai-alert").hide()
                        $("#AddItemModal").modal("hide")
                        toastr.success(response.msg, "Notification")
                        $("#AddItemForm")[0].reset()
                        $("#items-listview-dataTables").DataTable().draw()
                    }
                }
            })
        })

        // Load Item data into View N Update Item modal
        $("#ViewUpdateItemModal").on("show.bs.modal", (event)=>{
            let element = $(event.relatedTarget)
            let item_number = element.data("item_number")
            let modal = $("#ViewUpdateItemModal")
            $.ajax({
                url:'../models/server/super-admin/items/fetch-item-data-script.php',
                method:'GET',
                cache:false,
                data:{"item-number":item_number},
                success:(ItemData)=>{
                    let item_data = JSON.parse(ItemData)
                    modal.find("select[name=item-product-category]").val(item_data.data.item_product_category)
                    modal.find("input[name=item-name]").val(item_data.data.item_name)
                    modal.find("input[name=item-number]").val(item_number)
                    modal.find("select[name=item-status]").val(item_data.data.item_status)
                    modal.find("textarea[name=item-description]").val(item_data.data.item_description)
                    modal.find("input[name=item-total-stock]").val(item_data.data.stock_quantity)
                    modal.find("input[name=item-unit-price]").val(item_data.data.stock_price)
                    modal.find("input[name=item-discount]").val(item_data.data.item_discount)
                    if(item_data.data.item_file != "imageNotAvailable.jpg")
                        modal.find(".item-img-file").html('<img src="../../../items-files/'+item_number+'/'+item_data.data.item_file+'" class="img" width=365px height=365px>')
                    else
                        modal.find(".item-img-file").html('<img src="../../../items-files/imageNotAvailable.jpg" class="img" width=365px height=365px>')
                    modal.find("select[name=item-product-category]").val(item_data.data.item_product_category)
                    modal.find("select[name=item-product-category]").val(item_data.data.item_product_category)
                }
            })
        })
        //function to get item detail
        function TestingItemFile(item_number){
            $.ajax({
                url:'../models/server/super-admin/items/testing-item-script.php',
                method:'GET',
                cache:false,
                data:{"item-number":item_number},
                success:(ItemData)=>{
                    let item_data = JSON.parse(ItemData)
                    console.log(item_data)
                }
            })
        }
        // TestingItemFile(8999888)

        // Item PopOver Details
        // $("#ItemName").on("click",()=>{
        //
        //     $.ajax({
        //         url:'../models/server/super-admin-items/fetch-item-data-script.php',
        //         method:'GET',
        //         cache:false,
        //         data:{item_number:$("#ItemName").prop("data-id")},
        //         success:(ItemData)=>{
        //             let item_data = JSON.parse(ItemData)
        //             $('#ItemName').popover({
        //                 container: 'body',
        //                 title: 'Item Details',
        //                 trigger: 'hover',
        //                 html: true,
        //                 placement: 'right',
        //                 content: item_data
        //             })
        //
        //         }
        //     })
        //
        // })
        $("#ItemName").on("mouseover", ()=>{
            console.log(true)
        })

})