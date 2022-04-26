

/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
  function( settings, data, dataIndex ) {

    // get the parts of the date string
    var regexp = /^(\d{4})[^\d]+(\d{2})[^\d]+(\d{2})[^\d]*$/gi;
    var matches = regexp.exec(data[4]);
    var now = new Date();     

    // create a JS Date object so we can do date comparisons 
    var row_date = new Date(matches[1],+matches[2]-1,matches[3]);


    // figure out how far back we need to filter
    var testDate = new Date();
    var filter_value = $('#dateFilter').val();


    if(filter_value == 'NULL'){
      return true;
    }
    else if(filter_value == '7D'){
      testDate.setDate(now.getDate() - 7 );   
    }
    else  if(filter_value == '15D'){
      testDate.setDate(now.getDate() - 15 );  
    }
    else  if(filter_value == '1M'){
      testDate.setMonth(now.getMonth() - 1 );      
    }


    if( (testDate < row_date) && (now > row_date)  ){

      // true means show
      return true; 
    }      

    return false;

  }
);

$(document).ready(function() {
  var all= 'all';
  var table = $('#example2').DataTable({
    "bLengthChange": false,
      "pageLength": 5,
      "language": {
          "sEmptyTable":     "ไม่มีข้อมูลในตาราง",
          "sInfo":           "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
          "sInfoEmpty":      "แสดง 0 ถึง 0 จาก 0 แถว",
          "sInfoFiltered":   "(กรองข้อมูล _MAX_ ทุกแถว)",
          "sInfoPostFix":    "",
          "sInfoThousands":  ",",
          "sLengthMenu":     "แสดง _MENU_ แถว",
          "sLoadingRecords": "กำลังโหลดข้อมูล...",
          "sProcessing":     "กำลังดำเนินการ...",
          "sSearch":         "ค้นหา: ",
          "sZeroRecords":    "ไม่พบข้อมูล",
          "oPaginate": {
              "sFirst":    "หน้าแรก",
          "sPrevious": "ก่อนหน้า",
              "sNext":     "ถัดไป",
          "sLast":     "หน้าสุดท้าย"
          },
          "oAria": {
              "sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
          "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
          }
      },
    "dom": 'rtipS',
    initComplete: function () {
      this.api().columns(0).every( function () {
            var column = this;
            var select = $('<select class="form-control"><option value="">เลือกทั้งหมด</option></select>')
                .appendTo( $('.serach_name').empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );
            column.data().unique().sort().each( function ( d, j ) {
                if(all === d) {
                    select.append( '<option SELECTED value="'+d+'">'+d+'</option>' )
                } else {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                }
            } );
        } );
        this.api().columns(7).every( function () {
            var column = this;
            var select = $('<select class="form-control"><option value="">เลือกทั้งหมด</option></select>')
                .appendTo( $('.serach_status').empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );
            column.data().unique().sort().each( function ( d, j ) {
                if(all === d) {
                    select.append( '<option SELECTED value="'+d+'">'+d+'</option>' )
                } else {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                }
            } );
        } );
      },

  }); 

  // Event listener to the two range filtering inputs to redraw on input
  $('#dateFilter').change( function() {
    table.draw();
  } );
} );



    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : false,
    //   "language": {
    //       "sEmptyTable":     "ไม่มีข้อมูลในตาราง",
    //       "sInfo":           "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
    //       "sInfoEmpty":      "แสดง 0 ถึง 0 จาก 0 แถว",
    //       "sInfoFiltered":   "(กรองข้อมูล _MAX_ ทุกแถว)",
    //       "sInfoPostFix":    "",
    //       "sInfoThousands":  ",",
    //       "sLengthMenu":     "แสดง _MENU_ แถว",
    //       "sLoadingRecords": "กำลังโหลดข้อมูล...",
    //       "sProcessing":     "กำลังดำเนินการ...",
    //       "sSearch":         "ค้นหา: ",
    //       "sZeroRecords":    "ไม่พบข้อมูล",
    //       "oPaginate": {
    //           "sFirst":    "หน้าแรก",
    //       "sPrevious": "ก่อนหน้า",
    //           "sNext":     "ถัดไป",
    //       "sLast":     "หน้าสุดท้าย"
    //       },
    //       "oAria": {
    //           "sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
    //       "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
    //       }
    //   },
    // });
    //   // Event listener to the two range filtering inputs to redraw on input
    //   $('#dateFilter').change( function() {
    //     $('#example2').DataTable().draw();
    //   } );
  // });