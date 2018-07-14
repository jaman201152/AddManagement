<?php

 $q = isset($_POST['q']) ? strval($_POST['q']) : '';

include '../conn.php';

    $rs = $con->prepare("select * from tbl_customer " 
        . " inner join tbl_reference on tbl_customer.ref_id=tbl_reference.ref_id "
        ." inner join country on tbl_customer.division=country.id "
        ." inner join state on tbl_customer.district=state.id "
        . " where tbl_customer.name like '%$q%' or tbl_customer.cust_id_new like '%$q%' ");
    $rs->execute();
    $rows = array();
    while($row =$rs->fetch(PDO::FETCH_ASSOC)){
            $rows[] = $row;
    }
    
  echo json_encode($rows);


