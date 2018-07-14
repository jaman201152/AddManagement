    <?php
        include '../conn.php';
   $query_order = $con->prepare("SELECT cust_id,cust_id_new,count(cust_id) as order_number,
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
        FROM tbl_order 
        GROUP BY  cust_id 
        ORDER BY  SUM(qty * unit_price)+SUM((qty * unit_price)*(front_page/100))+SUM((qty * unit_price)*(back_page/100))
        +SUM((qty * unit_price)*(color/100))-SUM(discount_amount) DESC");
   $query_order->execute();
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
       .client_order_report .highlight{ color:green;  }
</style>
<div class="all_client">
    
    <table border="0" class="client_order_report" width="100%" style="color:#333;">
    <caption style="font-size: 14px; color:#0081c2; font-weight: bold; ">Order Account By Client Name</caption>
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
               $query_cust = $con->prepare("Select * from tbl_customer");
               $query_cust->execute();
               while($row_cust=$query_cust->fetch(PDO::FETCH_ASSOC)){ // Start customer table while loop
                   if($row_cust['cust_id']==$row['cust_id']){
                       ?>
        <tr>
            <td colspan="7"><span class="heading_client"><?php echo $sr++.'. '.$row_cust['name'].' <span class="highlight">[Total Order: '.$row['order_number'].']</span>';?>:</span></td>

        </tr>
               <tr>
                   <td>&nbsp;</td>
                <td align="left"><?php echo $row['cust_id_new']; ?></td>
                <td  align="center"><?php 
                $t_amt = $row['priceEach']+$row['front_charge']+$row['back_charge']+$row['color_charge'];
                    echo number_format($t_amt,2,'.',',');
                    $total_amount +=$t_amt;
                    ?>
                </td>
                <td  align="center"><?php
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
                   } // if order table cust id and customer table id is equal then show tr
               } // Customer table while loop End.
        ?>
 
        <?php
        } // End Order table While loop
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

