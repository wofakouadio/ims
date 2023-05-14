$(document).ready(()=>{
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
    // $("#ItemName").on("mouseover", ()=>{
    //     console.log(true)
    // })

})