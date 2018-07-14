
	<script>
		function addTab(title, url){
			if ($('#tt').tabs('exists', title)){
				$('#tt').tabs('select', title);
			}
                        
                        else {
				var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
				$('#tt').tabs('add',{
					title:title,
					content:content,
					closable:true
				});
			}
		}
	</script>




<!--	<div style="margin-bottom:10px">
            <a href="#" class="easyui-linkbutton" onclick="addTab('aiminlife','http://www.aiminlife.com/')">aiminlife</a><br/>
            <a href="#" class="easyui-linkbutton" onclick="addTab('jquery','http://www.jquery.com/')">jquery</a><br/>
            <a href="#" class="easyui-linkbutton" onclick="addTab('easyui','http://www.jeasyui.com/')">easyui</a><br/>
            
	</div>-->
<!--        
         <ul class="easyui-tree">
                <li>
                    <span  class="alert">All Clients</span>
                    <ul>
                        <li><span> <a href="javascript: void" onclick="addTab('All Clients','all_members_list.php')">All Members</a></span></li>
                        <li><span><a href="javascript: void" onclick="addTab('Contact Us','php_pages/contact.php')">Contact Us</a></span></li>
                        <li><span>Music</span></li>
                        <li><span>Picture</span></li>
                        <li><span>Database</span></li>
                    </ul>
                </li>
            
            </ul>-->
<!-- Left menu. -->
<style>
    ul li a{
        text-decoration: none;
        color:#555;
    }
</style>
<!--<ul class="easyui-tree">
    <li>
        <span>All Clients</span>
        <ul>
            <li><a href="?pages=pages/contact.php">Contact</a></li>
            <li><a href="javascript:void()" onclick="Clients();">All Clients</a></li>
        </ul>
    </li>
    
</ul>-->


<ul class="easyui-tree" data-options="animate:true">
    <li data-options="state:'closed' "><span>Order Report</span>
        <ul>
          <li><a href="javascript:void()" onclick="todayOrder();" >Today</a></li>
          <li><a href="javascript:void()" onclick="currentWeekOrder();" >Current Week</a></li>
          <li><a href="javascript: void()" onclick="lastWeek();" >Last Week</a></li>
          <li><a href="javascript: void()" onclick="currentMonth();" >Current Month</a></li>
          <li><a href="javascript: void()" onclick="lastMonth();" >Last Month</a> </li>
        </ul>
    </li>
  <li data-options="state:'closed' "><span>Invoice Report</span>
      <ul>
        <li><a href="javascript:void()" onclick="itodayOrder();" >Today</a></li>
         <li><a href="javascript:void()" onclick="icurrentWeekOrder();" >Current Week</a></li>
          <li><a href="javascript: void()" onclick="ilastWeek();" >Last Week</a></li>
          <li> <a href="javascript: void()" onclick="icurrentMonth();" >Current Month</a></li>
         <li> <a href="javascript: void()" onclick="ilastMonth();" >Last Month</a> </li>
      </ul>
  </li>
  <li data-options="state:'closed'"><span>Billing Report</span>
      <ul>
        <li><a href="javascript:void()" onclick="btodayOrder();" >Today</a></li>
        <li><a href="javascript:void()" onclick="bcurrentWeekOrder();" >Current Week</a></li>
        <li><a href="javascript: void()" onclick="blastWeek();" >Last Week</a></li>
        <li><a href="javascript: void()" onclick="bcurrentMonth();" >Current Month</a></li>
        <li><a href="javascript: void()" onclick="blastMonth();" >Last Month</a> </li>
      </ul>
  </li>
    <li>
        <span>Report Summery</span>
        <ul>
<!--            <li><a href="javascript: void()" onclick="showContent('Daily')">Daily</a></li>-->
             <!--<li><a href="javascript: void()" onclick="dailyOrder()">Daily</a></li>
            <li><a href="javascript: void()" onclick="showContent('Weekly')">Weekly</a></li>
           
            <li><a href="javascript: void()" onclick="addAccounting()">Monthly</a></li>
            -->
            <li><a href="javascript: void()" onclick="allOrder()">All Orders</a></li>
             <li><a href="javascript: void()" onclick="allInvoices()">All Invoices / Bill</a></li>
                    <?php
        if($_SESSION['s_email'] =='admin@dailyasianage.com' || $_SESSION['s_email']=='superadmin@dailyasianage.com'){
            ?>
            <li><a href="javascript: void()" onclick="allReceived()">All Bill Collection</a></li>
            <?php
        }
        ?>
            <li><a href="javascript: void()" onclick="clientOrderByName()">Client Order Account</a></li>
             <li><a href="javascript: void()" onclick="clientOrderByDistrict()">Client Order By District</a></li>
        </ul>
    </li>
</ul>
<!--<ul class="easyui-tree">
    <li>
        <span>Report</span>
        <ul>
            <li><a href="javascript: void()" onclick="showContent('Voucher')">Voucher</a></li>
            <li><a href="javascript: void()" onclick="showContent('Trial Balance')">Trial Balance</a></li>
            <li><a href="javascript: void()" onclick="report()">Financial Statement</a></li>
        </ul>
    </li>
</ul>-->

<!--	<div id="tt" class="easyui-tabs" style="width:400px;height:250px;">
		<div title="Home">
                    home
		</div>
	</div>-->

<!--<a href="#" onclick="javascript:$('#dd').panel('open')">Open</a>-->
<div id='test' class="easyui-dialog" closed='true' style="height: 400px; width: 600px;">test</div>
<!-- <script type="text/javascript" src="js/dateCustomize.js"></script> -->
<script>
      function showContent(language){
                    $('#container').html('<h2>You select ' + language+'</h2>');
                        }
                        
                  function showPage(){
                    $('#container').load('Html_Page/homepage.html');
                        }
                   function addAccounting(){
                      $('#test').dialog('open');
                  }
                  
                  function allOrder(){
                      $('#container').window('open');
                      $('#container').load('Report/all_order.php', {"all": "all"});
                  
                  } // display Individual Report
                  function clientOrderByName(){
                      $('#container').window('open');
                      $('#container').load('Report/all_client_bill.php',{'all':'all'});
                  }
                     function clientOrderByDistrict(){
                      $('#container').window('open');
                      $('#container').load('Report/all_order_by_district.php',{'all':'all'});
                  }
                     function allReceived(){
                     $('#container').window('open');
                      $('#container').load('Report/all_receive.php',{'all':'all'});
                  } // display Individual Report
                  function allInvoices(){
                     $('#container').window('open');
                      $('#container').load('Report/all_invoice.php',{'all':'all'});
                  } // display Individual Report

                  // *************** For Order Report **************

                 function todayOrder() {  // pick date today
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
                $('#container').window('open');
                      $('#container').load('Report/all_order.php', {"today": today});
                 }

              function currentWeekOrder() {  // pick date today
   var curr = new Date(); // get current date
 var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
 var last = first + 6; // last day is the first day + 6
 //var day = (curr.getDate() < 10) ? "0" + curr.getDate() : curr.getDate();
 var firstday = new Date(curr.setDate(first));
 var lastday = new Date(curr.setDate(last));
 var frommonth =firstday.getMonth()+1; // it incerase month number because indexing from 0;
 var tomonth =lastday.getMonth()+1;    // it incerase month number because indexing from 0;
 var day = (firstday.getDate() < 10) ? "0" + firstday.getDate() : firstday.getDate();
 var month = (frommonth < 10) ? "0" + frommonth : frommonth;
 var year = firstday.getFullYear() ;
 
 var lastdate = (lastday.getDate() < 10) ? "0" + lastday.getDate() : lastday.getDate();
 var lastmonth = (tomonth < 10) ? "0" + tomonth : tomonth;
 var lastyear = lastday.getFullYear();
 
 var fromWeekDate = year + "-" + month + "-" + day;
 var toWeekDate = lastyear + "-" + lastmonth + "-" + lastdate;
        $('#container').window('open');
        $('#container').load('Report/all_order.php',  { "fromWeekDate":  fromWeekDate, "toWeekDate": toWeekDate  } );
              }

                  function lastWeek() {  // pick date lastweek
           var curr = new Date(); // get current date
 var last = curr.getDate() - curr.getDay() -1; // First day is the day of the month - the day of the week
 var first = last - 6; // first day of the last week - 6
 //var day = (curr.getDate() < 10) ? "0" + curr.getDate() : curr.getDate();
 var firstday = new Date(curr.setDate(last));
 var lastday = new Date(curr.setDate(first));
 var frommonth =firstday.getMonth()+1; // it incerase month number because indexing from 0;
 var tomonth =lastday.getMonth()+1;    // it incerase month number because indexing from 0;
 var day = (firstday.getDate() < 10) ? "0" + firstday.getDate() : firstday.getDate();
 var month = (frommonth < 10) ? "0" + frommonth : frommonth;
 var year = firstday.getFullYear() ;
 
 var lastdate = (lastday.getDate() < 10) ? "0" + lastday.getDate() : lastday.getDate();
 var lastmonth = (tomonth < 10) ? "0" + tomonth : tomonth;
 var lastyear = lastday.getFullYear();
 
 var fromlastWeekDate = lastyear + "-" + lastmonth + "-" + lastdate; 
 var tolastWeekDate = year + "-" + month + "-" + day;
            $('#container').window('open'); 
    $('#container').load('Report/all_order.php',{'fromlastWeekDate':fromlastWeekDate,'tolastWeekDate':tolastWeekDate});
                 }

                 function currentMonth() { // pick date currentMonth
                  var curr = new Date();
                   y = curr.getFullYear(), m = curr.getMonth();
var firstDayOfMonth = new Date(y, m, 1);
var lastDayOfMonth = new Date(y, m + 1, 0);

var fy = firstDayOfMonth.getFullYear();
var fm = firstDayOfMonth.getMonth()+1;
var realfm = (fm < 10) ? "0" + fm : fm;
var fd = firstDayOfMonth.getDate();
var realfd = (fd < 10) ? "0" + fd : fd;

var ly = lastDayOfMonth.getFullYear();
var lm = lastDayOfMonth.getMonth()+1;
var reallm = (lm < 10) ? "0" + lm : lm;
var ld = lastDayOfMonth.getDate();
var realld = (ld < 10) ? "0" + ld : ld;
var firstDayOfMonthf = fy+"-"+realfm+"-"+realfd;
var lastDayOfMonthf = ly+"-"+reallm+"-"+realld;
 // alert(firstDayOfMonthf+" and "+lastDayOfMonthf);
 $('#container').window('open');
    $('#container').load('Report/all_order.php',  { "firstDayOfMonth":  firstDayOfMonthf, "lastDayOfMonth": lastDayOfMonthf  });
                 }

                 function lastMonth() {  // pick date lastMonth
                     
    var now = new Date();
    var prevMonthLastDate = new Date(now.getFullYear(), now.getMonth(), 0);
    var prevMonthFirstDate = new Date(now.getFullYear() - (now.getMonth() > 0 ? 0 : 1), (now.getMonth() - 1 + 12) % 12, 1);

    var formatDateComponent = function(dateComponent) {
      return (dateComponent < 10 ? '0' : '') + dateComponent;
    };

    var formatDate = function(date) {
      return  date.getFullYear() + '-' + formatDateComponent(date.getMonth() + 1) + '-' + formatDateComponent(date.getDate());
    };
 var first_day_pre_month = formatDate(prevMonthFirstDate);
  var last_day_pre_month = formatDate(prevMonthLastDate);
 
    // alert(formatDate(prevMonthFirstDate) + ' : ' + formatDate(prevMonthLastDate)); 
$('#container').window('open');
                $('#container').load('Report/all_order.php',{'first_day_pre_month':first_day_pre_month,'last_day_pre_month':last_day_pre_month});
                
                 }

// End Oreder Report

// *************** For Invoice Report **************

                 function itodayOrder() {  // pick date today
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
                $('#container').window('open');
                      $('#container').load('Report/all_invoice.php', {"today": today});
                 }

              function icurrentWeekOrder() {  // pick date today
   var curr = new Date(); // get current date
 var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
 var last = first + 6; // last day is the first day + 6
 //var day = (curr.getDate() < 10) ? "0" + curr.getDate() : curr.getDate();
 var firstday = new Date(curr.setDate(first));
 var lastday = new Date(curr.setDate(last));
 var frommonth =firstday.getMonth()+1; // it incerase month number because indexing from 0;
 var tomonth =lastday.getMonth()+1;    // it incerase month number because indexing from 0;
 var day = (firstday.getDate() < 10) ? "0" + firstday.getDate() : firstday.getDate();
 var month = (frommonth < 10) ? "0" + frommonth : frommonth;
 var year = firstday.getFullYear() ;
 
 var lastdate = (lastday.getDate() < 10) ? "0" + lastday.getDate() : lastday.getDate();
 var lastmonth = (tomonth < 10) ? "0" + tomonth : tomonth;
 var lastyear = lastday.getFullYear();
 
 var fromWeekDate = year + "-" + month + "-" + day;
 var toWeekDate = lastyear + "-" + lastmonth + "-" + lastdate;
$('#container').window('open');
        $('#container').load('Report/all_invoice.php',  { "fromWeekDate":  fromWeekDate, "toWeekDate": toWeekDate  } );
              }

                  function ilastWeek() {  // pick date lastweek
           var curr = new Date(); // get current date
 var last = curr.getDate() - curr.getDay() -1; // First day is the day of the month - the day of the week
 var first = last - 6; // first day of the last week - 6
 //var day = (curr.getDate() < 10) ? "0" + curr.getDate() : curr.getDate();
 var firstday = new Date(curr.setDate(last));
 var lastday = new Date(curr.setDate(first));
 var frommonth =firstday.getMonth()+1; // it incerase month number because indexing from 0;
 var tomonth =lastday.getMonth()+1;    // it incerase month number because indexing from 0;
 var day = (firstday.getDate() < 10) ? "0" + firstday.getDate() : firstday.getDate();
 var month = (frommonth < 10) ? "0" + frommonth : frommonth;
 var year = firstday.getFullYear() ;
 
 var lastdate = (lastday.getDate() < 10) ? "0" + lastday.getDate() : lastday.getDate();
 var lastmonth = (tomonth < 10) ? "0" + tomonth : tomonth;
 var lastyear = lastday.getFullYear();
 
 var fromlastWeekDate = lastyear + "-" + lastmonth + "-" + lastdate; 
 var tolastWeekDate = year + "-" + month + "-" + day;
             $('#container').window('open');
    $('#container').load('Report/all_invoice.php',{'fromlastWeekDate':fromlastWeekDate,'tolastWeekDate':tolastWeekDate});
                 }

                 function icurrentMonth() { // pick date currentMonth
                  var curr = new Date();
                   y = curr.getFullYear(), m = curr.getMonth();
var firstDayOfMonth = new Date(y, m, 1);
var lastDayOfMonth = new Date(y, m + 1, 0);

var fy = firstDayOfMonth.getFullYear();
var fm = firstDayOfMonth.getMonth()+1;
var realfm = (fm < 10) ? "0" + fm : fm;
var fd = firstDayOfMonth.getDate();
var realfd = (fd < 10) ? "0" + fd : fd;

var ly = lastDayOfMonth.getFullYear();
var lm = lastDayOfMonth.getMonth()+1;
var reallm = (lm < 10) ? "0" + lm : lm;
var ld = lastDayOfMonth.getDate();
var realld = (ld < 10) ? "0" + ld : ld;
var firstDayOfMonthf = fy+"-"+realfm+"-"+realfd;
var lastDayOfMonthf = ly+"-"+reallm+"-"+realld;
 // alert(firstDayOfMonthf+" and "+lastDayOfMonthf);
 $('#container').window('open');
    $('#container').load('Report/all_invoice.php',  { "firstDayOfMonth":  firstDayOfMonthf, "lastDayOfMonth": lastDayOfMonthf  });
                 }

                 function ilastMonth() {  // pick date lastMonth
                     
    var now = new Date();
    var prevMonthLastDate = new Date(now.getFullYear(), now.getMonth(), 0);
    var prevMonthFirstDate = new Date(now.getFullYear() - (now.getMonth() > 0 ? 0 : 1), (now.getMonth() - 1 + 12) % 12, 1);

    var formatDateComponent = function(dateComponent) {
      return (dateComponent < 10 ? '0' : '') + dateComponent;
    };

    var formatDate = function(date) {
      return  date.getFullYear() + '-' + formatDateComponent(date.getMonth() + 1) + '-' + formatDateComponent(date.getDate());
    };
 var first_day_pre_month = formatDate(prevMonthFirstDate);
  var last_day_pre_month = formatDate(prevMonthLastDate);
 
    // alert(formatDate(prevMonthFirstDate) + ' : ' + formatDate(prevMonthLastDate)); 
$('#container').window('open');
                $('#container').load('Report/all_invoice.php',{'first_day_pre_month':first_day_pre_month,'last_day_pre_month':last_day_pre_month});
                
                 }
    // End Invoice Report
    
    // *************** Start For Bill Report **************

                 function btodayOrder() {  // pick date today
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
                $('#container').window('open');
                      $('#container').load('Report/all_receive.php', {"today": today});
                 }

              function bcurrentWeekOrder() {  // pick date today
   var curr = new Date(); // get current date
 var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
 var last = first + 6; // last day is the first day + 6
 //var day = (curr.getDate() < 10) ? "0" + curr.getDate() : curr.getDate();
 var firstday = new Date(curr.setDate(first));
 var lastday = new Date(curr.setDate(last));
 var frommonth =firstday.getMonth()+1; // it incerase month number because indexing from 0;
 var tomonth =lastday.getMonth()+1;    // it incerase month number because indexing from 0;
 var day = (firstday.getDate() < 10) ? "0" + firstday.getDate() : firstday.getDate();
 var month = (frommonth < 10) ? "0" + frommonth : frommonth;
 var year = firstday.getFullYear() ;
 
 var lastdate = (lastday.getDate() < 10) ? "0" + lastday.getDate() : lastday.getDate();
 var lastmonth = (tomonth < 10) ? "0" + tomonth : tomonth;
 var lastyear = lastday.getFullYear();
 
 var fromWeekDate = year + "-" + month + "-" + day;
 var toWeekDate = lastyear + "-" + lastmonth + "-" + lastdate;
$('#container').window('open');
    $('#container').load('Report/all_receive.php',  { "fromWeekDate":  fromWeekDate, "toWeekDate": toWeekDate  } );
              }

                  function blastWeek() {  // pick date lastweek
           var curr = new Date(); // get current date
 var last = curr.getDate() - curr.getDay() -1; // First day is the day of the month - the day of the week
 var first = last - 6; // first day of the last week - 6
 //var day = (curr.getDate() < 10) ? "0" + curr.getDate() : curr.getDate();
 var firstday = new Date(curr.setDate(last));
 var lastday = new Date(curr.setDate(first));
 var frommonth =firstday.getMonth()+1; // it incerase month number because indexing from 0;
 var tomonth =lastday.getMonth()+1;    // it incerase month number because indexing from 0;
 var day = (firstday.getDate() < 10) ? "0" + firstday.getDate() : firstday.getDate();
 var month = (frommonth < 10) ? "0" + frommonth : frommonth;
 var year = firstday.getFullYear() ;
 
 var lastdate = (lastday.getDate() < 10) ? "0" + lastday.getDate() : lastday.getDate();
 var lastmonth = (tomonth < 10) ? "0" + tomonth : tomonth;
 var lastyear = lastday.getFullYear();
 
 var fromlastWeekDate = lastyear + "-" + lastmonth + "-" + lastdate; 
 var tolastWeekDate = year + "-" + month + "-" + day;
             $('#container').window('open');
    $('#container').load('Report/all_receive.php',{'fromlastWeekDate':fromlastWeekDate,'tolastWeekDate':tolastWeekDate});
                 }

                 function bcurrentMonth() { // pick date currentMonth
                  var curr = new Date();
                   y = curr.getFullYear(), m = curr.getMonth();
var firstDayOfMonth = new Date(y, m, 1);
var lastDayOfMonth = new Date(y, m + 1, 0);

var fy = firstDayOfMonth.getFullYear();
var fm = firstDayOfMonth.getMonth()+1;
var realfm = (fm < 10) ? "0" + fm : fm;
var fd = firstDayOfMonth.getDate();
var realfd = (fd < 10) ? "0" + fd : fd;

var ly = lastDayOfMonth.getFullYear();
var lm = lastDayOfMonth.getMonth()+1;
var reallm = (lm < 10) ? "0" + lm : lm;
var ld = lastDayOfMonth.getDate();
var realld = (ld < 10) ? "0" + ld : ld;
var firstDayOfMonthf = fy+"-"+realfm+"-"+realfd;
var lastDayOfMonthf = ly+"-"+reallm+"-"+realld;
 // alert(firstDayOfMonthf+" and "+lastDayOfMonthf);
 $('#container').window('open');
    $('#container').load('Report/all_receive.php',  { "firstDayOfMonth":  firstDayOfMonthf, "lastDayOfMonth": lastDayOfMonthf  });
                 }

                 function blastMonth() {  // pick date lastMonth
                     
    var now = new Date();
    var prevMonthLastDate = new Date(now.getFullYear(), now.getMonth(), 0);
    var prevMonthFirstDate = new Date(now.getFullYear() - (now.getMonth() > 0 ? 0 : 1), (now.getMonth() - 1 + 12) % 12, 1);

    var formatDateComponent = function(dateComponent) {
      return (dateComponent < 10 ? '0' : '') + dateComponent;
    };

    var formatDate = function(date) {
      return  date.getFullYear() + '-' + formatDateComponent(date.getMonth() + 1) + '-' + formatDateComponent(date.getDate());
    };
 var first_day_pre_month = formatDate(prevMonthFirstDate);
  var last_day_pre_month = formatDate(prevMonthLastDate);
 
    // alert(formatDate(prevMonthFirstDate) + ' : ' + formatDate(prevMonthLastDate)); 
    $('#container').window('open');
                $('#container').load('Report/all_receive.php',{'first_day_pre_month':first_day_pre_month,'last_day_pre_month':last_day_pre_month});
                
                 }





    
</script>


