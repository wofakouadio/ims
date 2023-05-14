$(document).ready(()=>{

    /****************************************
     *       Vendors Accounts Table                   *
     ****************************************/
    $('#vendors-listview-dataTables').DataTable({
        order: [
            [0, "asc"]
        ],
        lengthMenu:[
            [5, 10, 20, 30, 50, 100, -1],[5, 10, 20, 30, 50, 100, 'All']
        ],
        paging: true,
        stateSave: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax:{
            url:'../models/super-admin/vendors/js/vendors-listview-dataTables.php',
        }
    });

})