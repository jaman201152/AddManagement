<?php
	include '../conn.php';
        
        $sep = "\t"; //tabbed character
    if (isset($_GET['today'])) {
        $today = $_GET['today'];
       // $today;
        $where = " where tbl_invoice.order_date like '$today%' ";
        echo $sep.$sep."The Asian Age".$sep."\n".$sep.$sep."Sr Tower, Tejgaon, Dhaka-1215.".$sep.$sep."\n".$sep.$sep."\n";
//if($voucher_type==='Payment Voucher'){ $voucher_type1 = "Purchase";}else{$voucher_type1="Salse ";}
 echo $sep." Report of all Invoice date from: ".$today." to ".$today."\n\n";
    }
           if(isset($_GET['fromWeekDate']) && isset($_GET['toWeekDate'])){
         $fromWeekDate = $_GET['fromWeekDate'];
            $fromWeekDaten=new DateTime($fromWeekDate);
            $fromWeekDatef = $fromWeekDaten->format('Y-m-d');
                
         $toWeekDate = $_GET['toWeekDate'];
         $toWeekDaten=new DateTime($toWeekDate);
         $toWeekDatef=$toWeekDaten->format('Y-m-d');
       // $fromWeekDatef.$toWeekDatef;
        $where = " where tbl_invoice.order_date between '$fromWeekDatef' and '$toWeekDatef' ";  
        echo $sep.$sep."The Asian Age".$sep."\n".$sep.$sep."Sr Tower, Tejgaon, Dhaka-1215.".$sep.$sep."\n".$sep.$sep."\n";
//if($voucher_type==='Payment Voucher'){ $voucher_type1 = "Purchase";}else{$voucher_type1="Salse ";}
 echo $sep." Report of all Invoice date from: ".$fromWeekDate." to ".$toWeekDatef."\n\n";
    }
        if(isset($_GET['tolastWeekDate']) && isset($_GET['fromlastWeekDate'])){
          $fromlastWeekDate = $_GET['fromlastWeekDate'];
          $fromlastWeekDaten=new DateTime($fromlastWeekDate);
          $fromlastWeekDatef = $fromlastWeekDaten->format('Y-m-d');
        
         $tolastWeekDate = $_GET['tolastWeekDate'];
         $tolastWeekDaten=new DateTime($tolastWeekDate);
        
         $tolastWeekDatef=$tolastWeekDaten->format('Y-m-d');
       // $fromWeekDatef.$toWeekDatef;
           $where = "where tbl_invoice.order_date between '$fromlastWeekDatef' and '$tolastWeekDatef' ";  
           echo $sep.$sep."The Asian Age".$sep."\n".$sep.$sep."Sr Tower, Tejgaon, Dhaka-1215.".$sep.$sep."\n".$sep.$sep."\n";
//if($voucher_type==='Payment Voucher'){ $voucher_type1 = "Purchase";}else{$voucher_type1="Salse ";}
 echo $sep." Report of all Invoice date from: ".$fromlastWeekDatef." to ".$tolastWeekDatef."\n\n";
    }

    if(isset($_GET['firstDayOfMonth']) && isset($_GET['lastDayOfMonth'])){
         $firstDayOfMonth = $_GET['firstDayOfMonth'];
          $lastDayOfMonth = $_GET['lastDayOfMonth'];
       //  $firstDayOfMonth.$lastDayOfMonth;
        $where = " where tbl_invoice.order_date between '$firstDayOfMonth' and '$lastDayOfMonth' "; 
        echo $sep.$sep."The Asian Age".$sep."\n".$sep.$sep."Sr Tower, Tejgaon, Dhaka-1215.".$sep.$sep."\n".$sep.$sep."\n";
//if($voucher_type==='Payment Voucher'){ $voucher_type1 = "Purchase";}else{$voucher_type1="Salse ";}
 echo $sep." Report of all Invoice date from: ".$firstDayOfMonth." to ".$lastDayOfMonth."\n\n";
    }
        if(isset($_GET['first_day_pre_month']) && isset($_GET['last_day_pre_month'])){
        $first_day_pre_month = $_GET['first_day_pre_month'];
        $last_day_pre_month = $_GET['last_day_pre_month'];
       //  $firstDayOfMonth.$lastDayOfMonth;
        $where = " where tbl_invoice.order_date between '$first_day_pre_month' and '$last_day_pre_month' ";         
        echo $sep.$sep."The Asian Age".$sep."\n".$sep.$sep."Sr Tower, Tejgaon, Dhaka-1215.".$sep.$sep."\n".$sep.$sep."\n";
 echo $sep." Report of all Invoice date from: ".$sep.$first_day_pre_month.$sep." to ".$sep.$last_day_pre_month.$sep."\n\n";
    }
    if(isset($_GET['all'])){
        $all = $_GET['all'];
       // "all time period.";
       $where = " ";
    echo $sep." Report of all Invoice date for all time period.".$sep." \n\n";
    }
        $query = $con->prepare("Select tbl_invoice.order_id,tbl_invoice.cust_id_new,tbl_invoice.order_date,tbl_invoice.price,"
                . "tbl_invoice.discount_amount,tbl_invoice.payable_amount,tbl_customer.name  from tbl_invoice"
                   . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id "
                . " $where ");
               
        
        $query->execute();
        $colcount = $query->columnCount(); // Get how many field in the table

$d_f=new DateTime();
$date_format=$d_f->format("d,M Y");
$date_excel= $d_f->format('d-m-Y');
$filename = "invoice_".$date_excel;      //File Name

$num = $query->rowCount(); // Get how many row in the table
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xlsx");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word

$sep = "\t"; //tabbed character


//start of printing column names as names of MySQL fields
$rs = $con->query('SELECT tbl_invoice.order_id,tbl_invoice.cust_id_new,tbl_invoice.order_date,tbl_invoice.price,tbl_invoice.discount_amount,'
        . 'tbl_invoice.payable_amount,tbl_customer.name FROM tbl_invoice'
             . " inner join tbl_customer on tbl_invoice.cust_id=tbl_customer.cust_id "
        . ' LIMIT 0');
for ($i = 0; $i < $rs->columnCount(); $i++) {
    $col = $rs->getColumnMeta($i);
    $columns[] = $col['name'];
    
    echo ucwords(str_replace("_", " ",$columns[$i])) . "\t"; // get table field name
}
print("\n");
//end of printing column names  
//start while loop to get data
    while($row = $query->fetch(PDO::FETCH_BOTH))
    {
        $schema_insert = "";
        for($j=0; $j<$colcount;$j++)
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



