<?php require("header.php");?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php require("navbar.php"); ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php require("menu.php"); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Items</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Items</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">


                <form class="form-group" action="<?php echo FORM_PATH; ?>" enctype="multipart/form-data" id="AddItemForm">

                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">

                                    <div class="ai-alert"></div>

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Product Category</label>
                                                <select class="form-control custom-select" name="item-product-category" id="item-product-category"></select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>Item Number</label>
                                                <input type="text" name="item-number" class="form-control">
                                            </div>
                                        </div>

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
                                            <label>Quantity</label>
                                            <input type="number" name="item-quantity" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Unit Price</label>
                                            <input type="text" name="item-unit-price" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Total Stock</label>
                                            <input type="text" name="item-total-stock" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Discount %</label>
                                            <input type="text" name="item-discount" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card" style="height:453px">
                                <div class="card-body">
                                    <div class="item-image text-center">
                                        <h1 class="mdi mdi-shopping" style="font-size:250px"></h1>
                                    </div>
                                        <br/>
                                    <label>File Upload</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="item-image">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <button class="btn btn-primary btn-lg" type="submit">Add Item</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- ============================================================== -->
                <!-- Modals -->
                <!-- ============================================================== -->
                <?php require("modals.php");?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php require("footer-note.php");?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <?php require("footer.php");?>