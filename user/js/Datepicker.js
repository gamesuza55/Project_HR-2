var $d = jQuery.noConflict();
function Datepicker1() {
        var datepicked = function() {
            var from = $d('#from-sick');
            var to = $d('#to-sick');
            var days = $d('#days-sick');
            

            var fromDate = from.datepicker('getDate')
            var toDate = to.datepicker('getDate')

            if (toDate && fromDate) {
                if (toDate.getTime() < fromDate.getTime()) {
                    alert('เลือก วันที่! ไม่ถูกต้อง กรุณาเลือกวันที่ให้ถูกต้อง');
                    document.getElementById("toDate").value == "1";
                }
            }

            if (toDate && fromDate) {
                var difference = 0;
                var oneDay = 86400000; //ms per day
                var difference = Math.ceil((toDate.getTime() - fromDate.getTime()) / oneDay + 1);
                days.val(difference);
            } 
  
        }


        $d(function() {
            $d('#from-sick, #to-sick').datepicker({
                dateFormat: "dd-mm-yy",
                // changeMonth: true, 
                // isBuddhist: true, 
                //defaultDate: toDay,
                todayHighlight:true,
                minDate: '0',
                //maxDate: '+9D',
                dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
                dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
                monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                onSelect: datepicked
            });
        });
}


function Datepicker2() {

        var datepicked = function() {
            var from = $d('#from-personal');
            var to = $d('#to-personal');
            var days = $d('#days-personal');
            

            var fromDate = from.datepicker('getDate')
            var toDate = to.datepicker('getDate')

            if (toDate && fromDate) {
                if (toDate.getTime() < fromDate.getTime()) {
                    alert('เลือก วันที่! ไม่ถูกต้อง กรุณาเลือกวันที่ให้ถูกต้อง');
                    document.getElementById("toDate").value == "";
                }
            }

            if (toDate && fromDate) {
                var difference = 0;
                var oneDay = 86400000; //ms per day
                var difference = Math.ceil((toDate.getTime() - fromDate.getTime()) / oneDay + 1);
                days.val(difference)
                
            }
        }


        $d(function() {
            $d('#from-personal, #to-personal').datepicker({
                dateFormat: "dd-mm-yy",
                // changeMonth: true, 
                // isBuddhist: true, 
                //defaultDate: toDay,
                todayHighlight:true,
                minDate: '0',
                //maxDate: '+9D',
                dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
                dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
                monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                onSelect: datepicked
            });
        });
        
}
function Datepicker3() {

        var datepicked = function() {
            var from = $d('#from-summer');
            var to = $d('#to-summer');
            var days = $d('#days-summer');
            

            var fromDate = from.datepicker('getDate')
            var toDate = to.datepicker('getDate')

            if (toDate && fromDate) {
                if (toDate.getTime() < fromDate.getTime()) {
                    alert('เลือก วันที่! ไม่ถูกต้อง กรุณาเลือกวันที่ให้ถูกต้อง');
                    document.getElementById("toDate").value == "";
                }
            }

            if (toDate && fromDate) {
                var difference = 0;
                var oneDay = 86400000; //ms per day
                var difference = Math.ceil((toDate.getTime() - fromDate.getTime()) / oneDay + 1);
                days.val(difference)
                
            }
        }


        $d(function() {
            $d('#from-summer, #to-summer').datepicker({
                dateFormat: "dd-mm-yy",
                // changeMonth: true, 
                // isBuddhist: true, 
                //defaultDate: toDay,
                todayHighlight:true,
                minDate: '0',
                //maxDate: '+10D',
                dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
                dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
                monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                onSelect: datepicked
            });
        });
        
}
function DatepickerEdit() {

        var datepicked = function() {
            var from = $d('#from-edit');
            var to = $d('#to-edit');
            var days = $d('#days');
            

            var fromDate = from.datepicker('getDate')
            var toDate = to.datepicker('getDate')

            if (toDate && fromDate) {
                if (toDate.getTime() < fromDate.getTime()) {
                    alert('เลือก วันที่! ไม่ถูกต้อง กรุณาเลือกวันที่ให้ถูกต้อง');
                    document.getElementById("toDate").value == "";
                }
            }

            if (toDate && fromDate) {
                var difference = 0;
                var oneDay = 86400000; //ms per day
                var difference = Math.ceil((toDate.getTime() - fromDate.getTime()) / oneDay + 1);
                days.val(difference)
                
            }
        }


        $d(function() {
            $d('#from-edit, #to-edit').datepicker({
                dateFormat: "dd-mm-yy",
                // changeMonth: true, 
                // isBuddhist: true, 
                //defaultDate: toDay,
                todayHighlight:true,
                minDate: '0',
                //maxDate: '+10D',
                dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
                dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
                monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                onSelect: datepicked
            });
        });
        
}
