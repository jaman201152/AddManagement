   
<?php

 include '../conn.php';

  $divisionid = isset($_GET['q']) ? $_GET['q'] : ''; // for Division
  $districtid = isset($_GET['districtId']) ? $_GET['districtId'] : ''; // for District
  $cityid = isset($_GET['cityId']) ? $_GET['cityId'] : ''; // for District 
           
            if(!empty($divisionid) && empty($districtid)){
                    $where = " where country.id='$divisionid' ";
             }
            if((!empty($divisionid) && !empty($districtid)) && empty($cityid) ){
                    $where = " where country.id='$divisionid' and state.id='$districtid' "; 
             }
            if((!empty($divisionid) && !empty($districtid)) && !empty($cityid)){
                    $where = " where country.id='$divisionid' "
                            . " and state.id='$districtid' and city.id='$cityid' "; 
             }
            
//    $test= $con->prepare("SELECT tbl_order.cust_id,tbl_customer.cust_id,
//                tbl_customer.district,state.statename,country.country,country.id,
//                SUM(unit_price * qty) AS amount
//                FROM tbl_customer
//                INNER JOIN tbl_order USING(cust_id)
//                INNER JOIN state on tbl_customer.district=state.id
//                INNER JOIN country on tbl_customer.division=country.id "
//                .$where.
//                " GROUP BY  tbl_order.cust_id 
//                order by country.id ASC, tbl_customer.district ASC");
//        $test->execute();
        
        
     
                
   $query_order = $con->prepare("SELECT tbl_customer.cust_id,tbl_customer.cust_id_new,
        state.statename,count(cust_id) as order_number,tbl_customer.name,
        SUM(qty * unit_price) priceEach, 
        SUM((qty * unit_price)*(front_page/100)) as front_charge,
        SUM((qty * unit_price)*(back_page/100)) as back_charge,
        SUM((qty * unit_price)*(color/100)) as color_charge,
        SUM(discount_amount) as discount_amt,
        SUM(qty * unit_price)+SUM((qty * unit_price)*(front_page/100))+SUM((qty * unit_price)*(back_page/100))
        +SUM((qty * unit_price)*(color/100))-SUM(discount_amount) as total_bill,
       (SUM(qty * unit_price)+SUM((qty * unit_price)*(front_page/100))+SUM((qty * unit_price)*(back_page/100))
        +SUM((qty * unit_price)*(color/100))-SUM(discount_amount))*vat/100 as vat_amt,
        (SUM(qty * unit_price)+SUM((qty * unit_price)*(front_page/100))+SUM((qty * unit_price)*(back_page/100))
        +SUM((qty * unit_price)*(color/100))-SUM(discount_amount))*tax/100 as tax_amt
        FROM tbl_customer
        INNER JOIN tbl_order USING(cust_id)
        INNER JOIN state on tbl_customer.district=state.id
        INNER JOIN country on tbl_customer.division=country.id "
         .$where.
        " GROUP BY  tbl_order.cust_id
        ORDER BY  SUM(qty * unit_price)+SUM((qty * unit_price)*(front_page/100))+SUM((qty * unit_price)*(back_page/100))
        +SUM((qty * unit_price)*(color/100))-SUM(discount_amount) DESC");
   $query_order->execute();
   
     
      
//        while($row=$query_order->fetch(PDO::FETCH_ASSOC)){
//            echo $row['statename'].', ';
//        }
?>
<style>
    .client_order_report{
         border: 1px solid #ccc; font-weight: 500;
         color:#444; border-collapse: collapse;
    }
 .client_order_report tr:hover{
        background: #f1f2f3; color:#444; font-size:15px;
    }
    .client_order_report tr td{
           border: 1px solid #ccc;
    }
    .client_order_report thead{
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        width: 100%; background: #f1f2f3; color:#444;
    }
    .client_order_report .highlight{ color:red; font-weight: 500; }
    
    .advance_search{
        border:1px #ccc solid;
        padding:50px;
    }
    
</style>
<button type="button" onclick="printPage();" id="print" style="display:none;">Print Preview</button>
<div class="all_client">
    
    <table border="0" class="client_order_report" width="100%" style="color:#333;">
    <caption style="font-size: 14px; color:#0081c2; font-weight: bold; ">
        <?php 
         echo 'Total Number of records-'.$num = $query_order->rowCount().' ';
        ?>
        of this Division
    </caption>
    <thead>
        <tr>
            <th align="center"># Client Name</th>
            <th>Client ID</th>
            <th>Billing Amt.</th>
            <th>Discount Amt.</th>
            <th>Total Billing Amt.(Without Vat & Tax)</th>
            <th>Vat Amt.</th>
            <th>Tax Amt.</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        $sr= 1;
            $total_amount=0; 
        $total_dis_amount=0;
        $total_bill_amount=0;
        $total_vat_amount=0;
        $total_tax_amount=0;
           while($row=$query_order->fetch(PDO::FETCH_ASSOC)){ // Start order tbale while loop
                  
                       ?>
        <tr>
            <td colspan="7">
                <span class="heading_client">
                    <?php 
                    echo $sr++.'. '.$row['name'].', '.$row['statename'].' [Number of Order-<span class="highlight">'.$row['order_number'].'</span>]';
                    ?>:
                </span>
            </td>
        </tr>
               <tr>
                   <td>&nbsp;</td>
                <td align="left"><?php echo $row['cust_id_new']; ?></td>
                <td  align="center">
                    <?php $t_amt = $row['priceEach']+$row['front_charge']+$row['back_charge']+$row['color_charge'];
                    echo number_format($t_amt,2,'.',',');
                        $total_amount +=$t_amt;
                    
                    ?>
                </td>
                <td  align="center">
                    <?php
                    echo number_format($row['discount_amt'],2,'.',',');
                     $total_dis_amount +=$row['discount_amt'];
                    ?>
                </td>
                <td  align="center">
                    <?php
                    echo number_format($row['total_bill'],2,'.',',');
                    $total_bill_amount +=$row['total_bill'];
                    ?>
                </td>
                <td  align="center">
                    <?php
                    echo number_format($row['vat_amt'],2,'.',',');
                     $total_vat_amount +=$row['vat_amt'];
                    ?>
                </td>
                <td  align="center">
                    <?php 
                    echo number_format($row['tax_amt'],2,'.',',');
                       $total_tax_amount +=$row['tax_amt'];
                    ?>
                
                </td>
        </tr>
        
        <?php
           }
        ?>
       <tr style="font-weight: bold; text-align: center;">
            <td>&nbsp;</td>
            <td>Total Amt. (Tk.)</td>
            <td><?php echo number_format($total_amount,2,'.',',');?></td>
             <td><?php echo number_format($total_dis_amount,2,'.',',');?></td>
              <td><?php echo number_format($total_bill_amount,2,'.',',');?></td>
               <td><?php echo number_format($total_vat_amount,2,'.',',');?></td>
                <td><?php echo number_format($total_tax_amount,2,'.',',');?></td>
        </tr>
    </tbody>
</table>
    
    </div>
 <script>
     function printPage() {
         
         document.getElementById("print").style.visibility = "visible";
        //Get the print button and put it into a variable
         var printButton = document.getElementById("print");
      //print();
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print();
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
 </script>