$(document).ready(()=>{

    /****************************************
    *       Users Accounts Table                   *
    ****************************************/
    $('#usersListviewDataTables').DataTable({
        order: true,
        lengthMenu:[
                [5, 10, 20, 30, 50, 100, -1],[5, 10, 20, 30, 50, 100, 'All']
            ],
        paging: true,
        dom: 'lBfrtip',
			buttons: [
				'copy',
				{extend: 'csv', footer: true, title: 'Purchase Report'},
				{extend: 'excel', footer: true, title: 'Purchase Report'},
				{extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Purchase Report'},
				{extend: 'print', footer: true, orientation: 'landscape',title: 'Purchase Report'},
            ],
        stateSave: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax:{
            url:'../models/server/super-admin/usersListviewDataTables.php',
            method: 'GET'
        }


    });

})