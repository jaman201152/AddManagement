<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Receive Payment Info</title>
        <style>
            h2 {
  text-align: center;
}

table caption {
	padding: .5em 0;
}

@media screen and (max-width: 767px) {
  table caption {
    border-bottom: 1px solid #ddd;
  }
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
        </style>
    </head>
    <body>
        <?php
       
         include '../conn.php';
         
         
       
        
        $from_date =New DateTime($_GET['from_date']);
       $from_date_f =  $from_date->format('Y-m-d 00:00:01');
        
        $to_date =New DateTime($_GET['to_date']);
      $to_date_f =  $to_date->format('Y-m-d 23:59:59');
      
        $sql = $con->prepare("Select * from tbl_ememo where payment_date between '$from_date_f' and '$to_date_f' ");
        $sql->execute();
       
           ?>
    
        
        <hr/>
        <h3>Date Retrieve from <?php echo $from_date_f. 'to' .$to_date_f ?> with Bootstrap</h3>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
          <caption class="text-center"> Receipt Transaction from <?php echo $from_date_f."to".$to_date_f;?></caption>
          
               <thead>
            <th>Cust. Id.</th>
             <th>Order Id.</th>
             <th>Invoice Id.</th>
              <th>Receive Amt.</th>
            
            </thead>
           <tbody>
                  <?php
                   while($row=$sql->fetch(PDO::FETCH_ASSOC)){
            extract($row);
                  ?>
                  <tr>
                      <td><?php echo $cust_id;?></td>
                       <td><?php echo $order_id;?></td>
                        <td><?php echo $invoice_num?></td>
                        <td><?php echo $receive_amount;?></td>
                  </tr>
            
        
        <?php
        }
        ?>
                    </tbody>
          
          <tfoot>
           
          </tfoot>
        </table>
      </div><!--end of .table-responsive-->
    </div>
  </div>
</div>


        
        
    </body>
</html>
