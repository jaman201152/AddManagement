
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Order, Invoice and Billing System</title>
        
   <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Invoice And Billing System</title>
    <link rel="stylesheet" type="text/css" href="themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="themes/mobile.css">
    <link rel="stylesheet" type="text/css" href="themes/icon.css">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="jquery.easyui.min.js"></script>
    <script type="text/javascript" src="jquery.easyui.mobile.js"></script>

</head>
<body>

<div class="easyui-navpanel" style="position:relative">
        <header>
            <div class="m-toolbar">
                <div class="m-title">
                     
               
                 
                     <?php
                     include 'Menu/top_menu.php';
                     ?>
        
               
           

                </div>
            </div>
        </header>
        

        <div id="container"><!-- Center Region Start-->
                  
                    <?php
                    $pages=empty($_GET['pages'])? "" : $_GET['pages'];
                  
                    if($pages!=""){
                        include $pages;
                    }
                    else{
                        
                            //include 'Html_Page/homepage.html';
                   include '../Report/over_all_report.php';
                                    
                    }
                    ?>
    
        </div>
        


        <footer>
            <div class="m-buttongroup m-buttongroup-justified" style="width:100%">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-order',size:'large',iconAlign:'top',plain:true">Orders</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-invoice_color',size:'large',iconAlign:'top',plain:true">Invoices</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',size:'large',iconAlign:'top',plain:true">Reports</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-smartart',size:'large',iconAlign:'top',plain:true">E-Receipt</a>
            </div>
        </footer>
    
 
   
    </div>
    
            
    
	
          
            <!-- ***************** North Region End ******************* -->
            <div data-options="region:'south',split:'true',title:' ' " style="height:60px;"><!-- south Region Start-->
                <center>Copyright@ 2014 - 2016. &nbsp;&nbsp;&nbsp; <a href="http://www.aiminlife.com" title="aiminlife.com" style="text-decoration:none; color:#666;" target="_blank">Powered By - www.aiminlife.com</a></center>
            </div>
            <!-- ************ south Region End *********************-->
            
            <div data-options="region:'east',split:true" title="Recent Info" style="width:120px;"><!-- east Region Start-->
                  <?php
                                       include 'Menu/east_menu.php';
                  ?>
            </div>
            <!-- **************** east Region End ***********************-->
            
            <div data-options="region:'west',split:true" title="Admin Panel" style="width:200px;"><!-- west Region Start-->
                 <?php
                 include 'Menu/left_menu.php';
               
                ?>
                
            </div> <!-- ******************** west Region End ***************-->
       


	

	
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:150px;
		}
		.fitem input{
			width:160px;
		}
	</style>
        
            <script>
                
    
         
                      // ************** Start Clients Funtions **********************
   function dailyOrder(){
   $('#jloading').html('<img src="../themes/default/images/loading.gif"> Loading...');


// For Today Start

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd;
} 

if(mm<10) {
    mm='0'+mm;
} 

today = yyyy+'-'+mm+'-'+dd;

// For Today End.

 // Strart For Date Format
var given_date = today+' 00:00:01';
var date_arr = given_date.split(" "); 
var ymd = date_arr[0];
ymd = ymd.split('-');

var y = ymd[0];
var m = ymd[1];
var d = ymd[2];

var his = date_arr[1];
his = his.split(':');

var h = his[0];
var i = his[1];
var s = his[2];

var ampm = (h >= 12) ? "PM" : "AM";
//var months = ['January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'December'];
var months = ['01', '02', '03', '04', '05', '06','07', '08', '09', '10', '11', '12'];
//$('#date').html(d + ' ' + months[m-1] + ' ' + y + '   ' + h + ':' + i + ' ' +  ampm);
//var q=y + '-' + months[m-1] + '-' + d + '   ' + h + ':' + i + ' ' +  ampm;
var q=y + '-' + months[m-1] + '-' + d;
// End for Date format.
//alert(q);

                       $('#container').panel({
                href:'report/daily_order_report.php?q=' + q,
                onLoad:function(){
                    $('#jloading').panel('clear');
                }
                
                });
            }   
         // **************************** End Clients Function ********************************    
         
      
         
        </script>
<!--        
         $d=new DateTime($row['order_date']);
                $date=$d->format('d-m-Y H:i a'); // date show like d-m-Y.
                $o_date=array("o_date"=>"$date");
                $cust_order=  array_merge($row,$row_customer); // Two table data has been displayed in one array.
                $m=  array_merge($o_date,$cust_order);
		array_push($items, $m);-->
</body>
</html>

