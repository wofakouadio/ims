$(document).ready(()=>{

    /****************************************
     *       Items Accounts Table                   *
     ****************************************/
    $('#items-listview-dataTables').DataTable({
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
            url:'../models/server/super-admin/items/items-listview-dataTables.php',
        }
    });

})