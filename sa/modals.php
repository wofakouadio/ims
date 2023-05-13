<!-- *********************************** -->
<!-- USERS -->
<!-- *********************************** -->

    <!-- Add New User Modal -->
    <div class="modal fade" id="NewUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="NewUserForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Registration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="ur-alert alert alert-success alert-dismissible fade show" role="alert">
                            <span class="ur-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label>FullName</label>
                                <input type="text" name="user_fullname" class="form-control">
                            </div>
                            <div class="col form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="user_dob" class="form-control">
                            </div>
                            <div class="col form-group">
                                <label>Gender</label>
                                <select class="form-control" name="user_gender">
                                    <option value="-1">Choose</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Place of Birth</label>
                            <input type="text" name="user_placeOfBirth" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Main Address</label>
                            <input type="text" name="user_address1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Secondary Address</label>
                            <input type="text" name="user_address2" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label>Phone[Mobile]</label>
                                <input type="text" name="user_mobile" class="form-control">
                            </div>
                            <div class="col form-group">
                                <label>Phone 2</label>
                                <input type="text" name="user_contact" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input typw="text" name="user_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>User Type</label>
                            <select name="user_type" class="form-control">
                                <option value="-1">Choose</option>
                                <option value="ADMINISTRATOR">Administrator</option>
                                <option value="SALES">Sales</option>
                                <option value="VENDOR">Vendor</option>
                                <option value="CUSTOMER">Customer</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label>Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="user_profile">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                </div>
                            </div>
                            <div class="col form-group">
                                <label>ID Screenshot</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="user_id_profile">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create New User Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- User Account View/Update -->
    <div class="modal fade" id="UserAccountUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="UserAccountUpdateForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Data Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="uau-alert alert alert-success alert-dismissible fade show" role="alert">
                            <span class="uau-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label>FullName</label>
                                <input type="text" name="user_fullname" class="form-control">
                                <input type="hidden" name="user_id">
                            </div>
                            <div class="col form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="user_dob" class="form-control">
                            </div>
                            <div class="col form-group">
                                <label>Gender</label>
                                <select class="form-control" name="user_gender">
                                    <option value="-1">Choose</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Place of Birth</label>
                            <input type="text" name="user_placeOfBirth" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Main Address</label>
                            <input type="text" name="user_address1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Secondary Address</label>
                            <input type="text" name="user_address2" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label>Phone[Mobile]</label>
                                <input type="text" name="user_mobile" class="form-control">
                            </div>
                            <div class="col form-group">
                                <label>Phone 2</label>
                                <input type="text" name="user_contact" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input typw="text" name="user_email" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update User Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Update User Account Identity -->
    <div class="modal fade" id="UserIdentityUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="UserIdentityUpdateForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Data Identity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="uai-alert alert alert-success alert-dismissible fade show" role="alert">
                            <span class="uai-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="col form-group">
                            <label>FullName</label>
                            <input type="text" name="user_fullname" class="form-control" readonly>
                            <input type="hidden" name="user_id">
                        </div>
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <div class="user-profile"></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="user_profile">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ID Screenshot</label>
                            <div class="user-id-profile"></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="user_id_profile">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update Identity</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit User Account Type -->
    <div class="modal fade" id="UserAccountType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="UserAccountTypeForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Account Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="uat-alert alert alert-success alert-dismissible fade show" role="alert">
                            <span class="ur-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-group">
                            <label>FullName</label>
                            <input type="text" name="user_fullname" class="form-control" readonly>
                            <input type="hidden" name="user_id">
                        </div>
                        <div class="form-group">
                            <label>User Type</label>
                            <select name="user_type" class="form-control">
                                <option value="-1">Choose</option>
                                <option value="ADMINISTRATOR">Administrator</option>
                                <option value="SALES">Sales</option>
                                <option value="VENDOR">Vendor</option>
                                <option value="CUSTOMER">Customer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- User Account Status -->
    <div class="modal fade" id="UserAccountStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="UserAccountStatusForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Account Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="uas-alert alert alert-success alert-dismissible fade show" role="alert">
                            <span class="ur-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-group">
                            <label>FullName</label>
                            <input type="text" name="user_fullname" class="form-control" readonly>
                            <input type="hidden" name="user_id">
                        </div>
                        <div class="form-group">
                            <label>Account Status</label>
                            <select name="user_status" class="form-control">
                                <option value="-1">Choose</option>
                                <option value="1">ACTIVE</option>
                                <option value="2">INACTIVE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- User Account Reset -->
    <div class="modal fade" id="UserAccountReset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="UserAccountResetForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reset User Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="uar-alert alert alert-success alert-dismissible fade show" role="alert">
                            <span class="ur-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h4 class="uar-notice"></h4>
                        <input type="hidden" name="user_id">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- User Account Delete -->
    <div class="modal fade" id="UserAccountDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="UserAccountDeleteForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Account Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="uad-alert alert alert-success alert-dismissible fade show" role="alert">
                            <span class="ur-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h4 class="uad-notice"></h4>
                        <input type="hidden" name="user_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- *********************************** -->
<!-- USERS -->
<!-- *********************************** -->


<!-- *********************************** -->
<!-- ITEMS -->
<!-- *********************************** -->

    <!--  Add Item  -->
    <div class="modal fade" id="AddItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="AddItemForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Item Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="ai-alert alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="ai-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <select class="form-control" name="item-product-category" id="item-product-category" style="width: 100%"></select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Item Number</label>
                                    <input type="text" name="item-number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" name="item-name" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="item-status">
                                        <option value="0">Choose</option>
                                        <option value="1">ACTIVE</option>
                                        <option value="2">DISABLED</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="10" cols="5" name="item-description" class="form-control"></textarea>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" name="item-quantity" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Unit Price</label>
                                    <input type="text" name="item-unit-price" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Discount %</label>
                                    <input type="text" name="item-discount" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>File Upload</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="item-image">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--  View N Update Item  -->
    <div class="modal fade" id="ViewUpdateItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="ViewUpdateItemForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Item Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="ai-alert alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="ai-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#item-data" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Item Info</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#item-stock" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Stock Info</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#upload-item-image" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Upload Image</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="item-data" role="tabpanel">
                                <div class="p-20">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Product Category</label>
                                                <select class="form-control" name="item-product-category" id="item-product-category" style="width: 100%"></select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Item Number</label>
                                                <input type="text" name="item-number" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Item Name</label>
                                                <input type="text" name="item-name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="item-status">
                                                    <option value="0">Choose</option>
                                                    <option value="1">ACTIVE</option>
                                                    <option value="2">DISABLED</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="10" cols="5" name="item-description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Discount %</label>
                                                <input type="text" name="item-discount" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="item-stock" role="tabpanel">
                                <div class="p-20">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" name="item-quantity" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Unit Price</label>
                                        <input type="text" name="item-unit-price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Total Stock</label>
                                        <input type="number" name="item-total-stock" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="upload-item-image" role="tabpanel">
                                <div class="p-20">
                                    <div class="form-group">
                                        <div class="item-img-file text-center"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>File Upload</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="item-image">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--  Delete Item  -->
    <div class="modal fade" id="DeleteItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo FORM_PATH;?>" method="POST" id="DeleteItemForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Item Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alert -->
                        <div class="ai-alert alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="ai-alert-content"></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-group">
                            <h4 class="delete-item-notice"></h4>
                            <input type="hidden" name="item-number">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- *********************************** -->
<!-- ITEMS -->
<!-- *********************************** -->