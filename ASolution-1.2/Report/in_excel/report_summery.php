<?php
/*******EDIT LINES 3-8*******/
session_start();
$DB_Server = "localhost"; //MySQL Server    
$DB_Username = "root"; //MySQL Username     
$DB_Password = "";             //MySQL Password     
$DB_DBName = "accounting";         //MySQL Database Name  
$DB_TBLName = "tbl_personal_account"; //MySQL Table Name   

$voucher_type= $_GET['type'];
$report=$_REQUEST['report']; // this value get from reportCreditVoucher.php form

 
        if($report==='today'){
            //$today = $_REQUEST['today'];
            $msg = "Today's Transaction ";
           $today = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d"),   date("Y")));
           $between = "between '$today' and '$today'";
        }
        elseif ($report==='yesterday') {
             $msg = "Yesterday's Transaction ";
            $yesterday = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")-1,   date("Y")));
            $between = "between '$yesterday' and '$yesterday'";
        }
        elseif ($report==='lastSevenDays') {
            $msg = "Transaction of last 7 days ";
             $lastSevenDayFrom = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")-6, date("Y")));
             $lastSevenDayTo = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d"), date("Y")));
            $between = "between '$lastSevenDayFrom' and '$lastSevenDayTo'";
        }
        elseif ($report==='currentMonth') {
             $msg = "Transaction of this month ";
              $firstDayOfMonth = date('Y-m-d',strtotime('first day of this month'));
              $lastDayOfMonth = date('Y-m-d',strtotime('last day of this month'));
              $between = "between '$firstDayOfMonth' and '$lastDayOfMonth'";
        }
           elseif ($report==='lastThirtyDays') {
               $msg = "Transaction of last 30 days ";
              $firstDayOftday = date('Y-m-d',mktime(0,0,0, date("m"), date("d")-29, date("Y")));
              $lastDayOftday = date('Y-m-d',mktime(0,0,0, date("m"), date("d"), date("Y")));
              $between = "between '$firstDayOftday' and '$lastDayOftday'";
        }
        elseif ($report==='lastMonth') {
            $msg = "Transaction of last month ";
              $firstDayOfMonth = date('Y-m-d',strtotime('first day of last month'));
              $lastDayOfMonth = date('Y-m-d',strtotime('last day of last month'));
             $between = "between '$firstDayOfMonth' and '$lastDayOfMonth'";
        }
           elseif ($report==='lastSixMonth') {
               $msg = "Transaction of last six months ";
                $today = date('Y-m-d',mktime(0, 0, 0, date("m")-6, date("d"),   date("Y")));
             $firstDayOflastSixMonth = date('Y-m-01',strtotime($today));
            //$fDOSM = date('Y-m-d', strtotime($time));
              $lastDaySixMonth = date('Y-m-d',strtotime('last day of this month'));
             $between = "between '$firstDayOflastSixMonth' and '$lastDaySixMonth'";
        }
        else{
            $msg = "There is no date range";
        }
        
$by_company_name = $_GET['by_company_name'];

$d_f=new DateTime();
$date_format=$d_f->format("d,M Y");
$date_excel= $d_f->format('d-m-Y');
$filename = "personal_account_".$date_excel;         //File Name

//create MySQL connection 
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   
$Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
//execute query 
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    

$sql1=  mysql_query("Select * from tbl_company_info where com_id='".$_SESSION['com_id']."' ");
while($row=  mysql_fetch_array($sql1)){
    extract($row);
}   // This query get company info for starting date and ending date



if($by_company_name!='all'){
      $test="where voucher_name='$voucher_type'  and creditorOrdebitor='$by_company_name' ";
      $sql = "Select  entrydate,payment_date,product_service,description,payable_amount,amount,due_amount  from $DB_TBLName "
        . " $test and status='1' and (entrydate $between ) "
        . " and com_id='".$_SESSION['com_id']."' order by entrydate ASC,creditorOrdebitor ASC ";
}
else{
     $test="where voucher_name='$voucher_type' ";
      $sql = "Select  creditorOrdebitor,entrydate,payment_date,product_service,description,payable_amount,amount,due_amount  from $DB_TBLName "
        . " $test and status='1' and (entrydate $between ) "
        . " and com_id='".$_SESSION['com_id']."' order by entrydate ASC,creditorOrdebitor ASC ";
}



$result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
$num=  mysql_num_rows($result);
$file_ending = "xlsx";
//header info for browser
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word

$sep = "\t"; //tabbed character

echo $sep.$sep.$com_name.$sep."\n".$sep.$sep.$address1.$sep.$sep."\n".$sep.$sep.$email.$sep."\n".$sep.$sep."Phone: ".$phone."\n\n";
if($voucher_type==='Payment Voucher'){ $voucher_type1 = "Purchase";}else{$voucher_type1="Salse ";}
echo $sep.$voucher_type1." report of ".$by_company_name." date between ".$between."\n\n";
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }  
    
if($num==0){
    echo "\n".$sep."there is no Transaction during this date range.";
}
