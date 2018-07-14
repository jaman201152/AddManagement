     // *************** Start today date pick *********************
              var d = new Date();
    var year = d.getFullYear();
    var month = (d.getMonth() < 10) ? "0" + (d.getMonth() + 1) : (d.getMonth() + 1);
    var day = (d.getDate() < 10) ? "0" + d.getDate() : d.getDate();
    var hour = (d.getHours() < 10) ? "0" + d.getHours() : d.getHours();
    var minute = (d.getMinutes() < 10) ? "0" + d.getMinutes() : d.getMinutes();
    var second = (d.getSeconds() < 10) ? "0" + d.getSeconds() : d.getSeconds();

    // alert(d.getDate() + "." + month + "." + d.getFullYear() + " " + hour + ":" + minute + ":" + second); 
    var today = year + "-" + month + "-" + day;
    //*************** End Today Date Pick *****************

    //*************** Start Week Date Pick *****************
    function currentWeek(){
         var curr = new Date(); // get current date
var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
var last = first + 6; // last day is the first day + 6
 //var day = (curr.getDate() < 10) ? "0" + curr.getDate() : curr.getDate();
var firstday = new Date(curr.setDate(first));
var lastday = new Date(curr.setDate(last));

var day = (firstday.getDate() < 10) ? "0" + firstday.getDate() : firstday.getDate();
var month = (firstday.getMonth() < 10) ? "0" + firstday.getMonth() : firstday.getMonth();
 var year = firstday.getFullYear() ;
 
 var lastdate = (lastday.getDate() < 10) ? "0" + lastday.getDate() : lastday.getDate();
var lastmonth = (lastday.getMonth() < 10) ? "0" + lastday.getMonth() : lastday.getMonth();
 var lastyear = lastday.getFullYear();
 
var fromWeekDate = year + "-" + month + "-" + day;
var toWeekDate = lastyear + "-" + lastmonth + "-" + lastdate;
alert(fromWeekDate+" "+toWeekDate);
    }
   
    // ************** End Week Date Pick ****************
    