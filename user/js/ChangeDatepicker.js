function formatDate(date) {
  var monthNames = [
    "01", "02", "03",
    "04", "05", "06", "07",
    "08", "09", "10",
    "11", "12"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return day + '-' + monthNames[monthIndex] + '-' + year;
  var now = formatDate(new Date());
}

function countDay1(count) {

  var now = formatDate(new Date());

 if(count == '1.0') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1   
    document.getElementById("days-sick").value = 1;
    document.getElementById("to-sick").style.display = '';
    document.getElementById("to-sick").value = now;

  } 
 else if(count == '0.5MN') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1

    document.getElementById("days-sick").value = 'ลาครึ่งวัน-เช้า';
    document.getElementById("to-sick").style.display = 'none';
    document.getElementById("to-sick").value = now;

  }   

 else if(count == '0.5AF') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1

    document.getElementById("days-sick").value = 'ลาครึ่งวัน-บ่าย';
    document.getElementById("to-sick").style.display = 'none';
    document.getElementById("to-sick").value = now;

  } 

}

function countDay2(count) {

  var now = formatDate(new Date());

 if(count == '1.0') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1   
    document.getElementById("days-personal").value = 1;
    document.getElementById("to-personal").style.display = '';
    document.getElementById("to-personal").value = now;

  } 
 else if(count == '0.5MN') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1

    document.getElementById("days-personal").value = 'ลาครึ่งวัน-เช้า';
    document.getElementById("to-personal").style.display = 'none';
    document.getElementById("to-personal").value = now;

  }   

 else if(count == '0.5AF') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1

    document.getElementById("days-personal").value = 'ลาครึ่งวัน-บ่าย';
    document.getElementById("to-personal").style.display = 'none';
    document.getElementById("to-personal").value = now;

  } 

}

function countDay3(count) {

  var now = formatDate(new Date());

 if(count == '1.0') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1   
    document.getElementById("days-summer").value = 1;
    document.getElementById("to-summer").style.display = '';
    document.getElementById("to-summer").value = now;

  } 
 else if(count == '0.5MN') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1

    document.getElementById("days-summer").value = 'ลาครึ่งวัน-เช้า';
    document.getElementById("to-summer").style.display = 'none';
    document.getElementById("to-summer").value = now;

  }   

 else if(count == '0.5AF') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1

    document.getElementById("days-summer").value = 'ลาครึ่งวัน-บ่าย';
    document.getElementById("to-summer").style.display = 'none';
    document.getElementById("to-summer").value = now;

  } 

}

function countDayEdit(count) {

  var now = formatDate(new Date());

 if(count == '1.0') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1   
    document.getElementById("days").value = 1;
    document.getElementById("to-edit").style.display = '';
    document.getElementById("to-edit").value = now;
    return false;

  } 
  if(count == '0.5MN') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1

    document.getElementById("days").value = 'ลาครึ่งวัน-เช้า';
    document.getElementById("to-edit").style.display = 'none';
    document.getElementById("to-edit").value = now;
    return false;
  }   

  if(count == '0.5AF') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1
    document.getElementById("days").value = 'ลาครึ่งวัน-บ่าย';
    document.getElementById("to-edit").style.display = 'none';
    document.getElementById("to-edit").value = now;
    return false;
  } 

}



