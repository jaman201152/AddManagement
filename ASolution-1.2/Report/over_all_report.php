

<div class="easyui-accordion" style="width:40%;height:auto;">
      <!-- ******************* Report By Date From ******************* -->
      <h3 style="color:#0099FF; text-align: center; ">Reporting</h3>
    <div title="Report by Date" iconCls="icon-ok"  style="overflow:auto;padding:10px;">
  <center>
    <div class="easyui-panel" style="max-width:500px;padding:30px 60px;">
        
    <div style="margin-bottom:20px" style="width: 100%;">
      <select name="txthead" id="txthead" class="easyui-combobox" style="float: left; width:100%;" required="required">
        <option value="">Please Select Atleast One</option>
        <option value="order">Order</option>
                               <?php
        if($_SESSION['s_email'] =='admin@dailyasianage.com' || $_SESSION['s_email']=='superadmin@dailyasianage.com'){
            ?>
                <option value="Invoice/Billing">Invoice/Billing</option>
            <?php
        }
        ?>
      
        <!-- <option value="received">Received</option>-->
      </select>
    </div>

        <div style="margin-bottom:20px">
        <label>From Date:</label>
           <input class="easyui-datebox" id="txt_from_date"  labelPosition="top" style="width:100%;">
        </div>
  
        <div style="margin-bottom:20px">
         <label>To Date:</label>
            <input class="easyui-datebox" id="txt_to_date" labelPosition="top" style="width:100%;">
        </div>
        <a href="javascript:void()" class="easyui-linkbutton" id="p_view" onclick="filterReport()" style="width: 100%;"><i>Generate Report</i></a>

    </div>

  
  </center>
    </div>
  <!-- ******************* Report By Month To ******************* -->
    <div title="Report by Month" iconCls="icon-ok"  style="padding:10px;">
        
            <center>
    <div class="easyui-panel" style="max-width:400px;padding:30px 60px;">
        
    <div style="margin-bottom:20px" style="width: 100%;">
      <select name="txthead" id="txtmonthhead" class="easyui-combobox" style="float: left; width:100%;" required="required">
        <option value="">Please Select Atleast One</option>
        <option value="order">Order/Invoice/Billing</option>
      <!--                          <?php
        if($_SESSION['s_email'] =='admin@dailyasianage.com' || $_SESSION['s_email']=='superadmin@dailyasianage.com'){
            ?>
                <option value="Invoice/Billing">Invoice/Billing</option>
            <?php
        }
        ?> -->
      
        <!-- <option value="received">Received</option>-->
      </select>
    </div>

        <div style="margin-bottom:20px">
        <label>Select From Month Name:</label><br>
          <select id="start_month" class="easyui-combobox" name="dept" style="width:100%;">
             <option value="">Please Select Month</option>
                 <?php
                $starting_year2=strtotime("2017-01-01");
                $ending_year2=strtotime("2017-12-31");

                  for($month=$starting_year2;$month<$ending_year2; $month=strtotime('+1 month', $month) ) {
                      ?>
                 <option value="<?php echo date('m',$month);?>"> <?php echo date('F',$month);
                  }
                  ?>
          </select>
        </div>


        <div style="margin-bottom:20px">
        <label>Select To Month Name:</label><br>
          <select id="end_month" class="easyui-combobox" name="dept" style="width:100%;">
             <option value="">Please Select Month</option>
             <?php
                $starting_year1=strtotime("2017-01-01");
                $ending_year1=strtotime("2017-12-31");

                  for($month=$starting_year1;$month<$ending_year1; $month=strtotime('+1 month', $month) ) {
                      ?>
                 <option value="<?php echo date('m',$month);?>"> <?php echo date('F',$month);
                  }
                  ?>
          </select>
        </div>
  
        <div style="margin-bottom:20px">
        <label>Select Year:</label><br>
          <select id="month_year" class="easyui-combobox" name="dept" style="width:100%;">
            <option value="">Please Select Year</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
          </select>
        </div>
        <a href="javascript:void()" class="easyui-linkbutton" id="m_view" onclick="monthReport()" style="width: 100%;"><i>Generate Report by Month</i></a>

    </div>

    <!-- ******************* Report By Date To ******************* -->


    </div>

   <!-- ******************* Report By Year From ******************* -->
    <div title="Report by Year" iconCls="icon-ok" style="padding:10px;">
    <center>
    <div class="easyui-panel" style="max-width:400px;padding:30px 60px;">
        
    <div style="margin-bottom:20px" style="width: 100%;">
      <select name="txthead_year" id="txthead_year" class="easyui-combobox" style="float: left; width:100%;" required="required">
        <option value="">Please Select Atleast One</option>
         <option value="order">Order/Invoice/Billing</option>
<!--                                <?php
        if($_SESSION['s_email'] =='admin@dailyasianage.com' || $_SESSION['s_email']=='superadmin@dailyasianage.com'){
            ?>
                <option value="Invoice/Billing">Invoice/Billing</option>
            <?php
        }
        ?> -->
        <!-- <option value="received">Received</option>-->
      </select>
    </div>
        <div style="margin-bottom:20px">
        <label>Select From Year:</label><br>
          <select id="txtstart_year" class="easyui-combobox" name="txtstart_year" style="width:100%;">
              <option value=""> Select Year </option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
          </select>
        </div>
        <div style="margin-bottom:20px">
        <label>Select To Year:</label><br>
          <select id="txtend_year" class="easyui-combobox" name="txtend_year" style="width:100%;">
              <option value=""> Select Year </option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
          </select>
        </div>
        <a href="javascript:void()" class="easyui-linkbutton" onclick="yearReport()" style="width: 100%;"><i>Generate Report by Year</i></a>

    </div>


    
  </center>
    </div>
        <!-- ******************* Report By Year To ******************* -->
        
        <!-- ******************* Report By Client From ******************* -->
         <div title="Report by Client" iconCls="icon-ok"  style="overflow:auto;padding:10px;">
  <center>
    <div class="easyui-panel" style="max-width:500px;padding:30px 60px;">
        
        <div style="margin-bottom:20px" style="width: 100%;"> Client Name:
      <select name="txtclient_id" id="txtclient_id" class="easyui-combobox" style="float: left; width:100%;" required="required">
        <option value=""></option>
                    <?php
                    include 'conn.php';
                    $query_company =$con->prepare("select * from ( tbl_customer"
               . " inner join state on tbl_customer.district=state.id )");
                    $query_company->execute();
                    while ($row_ref = $query_company->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_ref);
                        ?>
                        <option value="<?php echo $cust_id; ?>"><?php echo $name.'('.$cust_id_new.')- '.$statename; ?></option>
                        <?php
                    }
                    ?>
        <!-- <option value="received">Received</option>-->
      </select>
    </div>
    <div style="margin-bottom:20px" style="width: 100%;">Report Type:
      <select name="txthead_client" id="txthead_client" class="easyui-combobox" style="float: left; width:100%;" required="required">
        <option value="order_client">Order</option>
                               <?php
        if($_SESSION['s_email'] =='admin@dailyasianage.com' || $_SESSION['s_email']=='superadmin@dailyasianage.com'){
            ?>
                <option value="Invoice/Billing_client">Invoice/Billing</option>
            <?php
        }
        ?>
      
        <!-- <option value="received">Received</option>-->
      </select>
    </div>

        <div style="margin-bottom:20px">
        <label>From Date:</label>
           <input class="easyui-datebox" id="txt_from_date_client"  labelPosition="top" style="width:100%;">
        </div>
  
        <div style="margin-bottom:20px">
         <label>To Date:</label>
            <input class="easyui-datebox" id="txt_to_date_client" labelPosition="top" style="width:100%;">
        </div>
        <a href="javascript:void()" class="easyui-linkbutton" id="p_view" onclick="clientReport()" style="width: 100%;"><i>Generate Report</i></a>

    </div>

  
  </center>
    </div>
    
    <!-- ******************* Report By Client To ******************* -->

       <!-- ******************* Report By District From ******************* -->
         <div title="Report by District" iconCls="icon-ok"  style="overflow:auto;padding:10px;">
  <center>
    <div class="easyui-panel" style="max-width:500px;padding:30px 60px;">
        
        <div style="margin-bottom:20px" style="width: 100%;"> District Name:
      <select name="txthead" id="txthead" class="easyui-combobox" style="float: left; width:100%;" required="required">
        <option value=""></option>
                    <?php
                    include 'conn.php';
                    $query_company1 = $con->prepare("Select * from tbl_customer");
                    $query_company1->execute();
                    while ($row_ref = $query_company1->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_ref);
                        ?>
                        <option value="<?php echo $cust_id; ?>"><?php echo $name; ?></option>
                        <?php
                    }
                    ?>
        <!-- <option value="received">Received</option>-->
      </select>
    </div>
    <div style="margin-bottom:20px" style="width: 100%;">Report Type:
      <select name="txthead" id="txthead" class="easyui-combobox" style="float: left; width:100%;" required="required">
        <option value="order">Order</option>
                               <?php
        if($_SESSION['s_email'] =='admin@dailyasianage.com' || $_SESSION['s_email']=='superadmin@dailyasianage.com'){
            ?>
                <option value="Invoice/Billing">Invoice/Billing</option>
            <?php
        }
        ?>
      
        <!-- <option value="received">Received</option>-->
      </select>
    </div>

        <div style="margin-bottom:20px">
        <label>From Date:</label>
           <input class="easyui-datebox" id="txt_from_date"  labelPosition="top" style="width:100%;">
        </div>
  
        <div style="margin-bottom:20px">
         <label>To Date:</label>
            <input class="easyui-datebox" id="txt_to_date" labelPosition="top" style="width:100%;">
        </div>
        <a href="javascript:void()" class="easyui-linkbutton" id="p_view" onclick="filterReport()" style="width: 100%;"><i>Generate Report</i></a>

    </div>

  
  </center>
    </div>

    <!-- ******************* Report By District To ******************* -->
    



</div>
</center>


<script type="text/javascript">

 function filterReport(){
        var from_date = $('#txt_from_date').datebox('getValue');
        var to_date = $('#txt_to_date').datebox('getValue');
        var head = $('#txthead').combobox('getValue');
        if(from_date!="" && to_date!="" && head!=""){
            //url:'invoice/by_date_filter_all_invoices.php?from_date='+from_date+'&to_date='+to_date
       if(head==='order'){
          window.open("Report/print_preview_order_by_date.php?from_date="+from_date+'&to_date='+to_date+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else if(head==='Invoice/Billing'){
              window.open("Report/generate_report.php?from_date="+from_date+'&to_date='+to_date+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else if(head==='received'){
              window.open("Report/generate_report_received.php?from_date="+from_date+'&to_date='+to_date+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else{
        alert('Item Select Error!');
       }
       //var row=$('#dg').datagrid('getSelected');
          }
          else{
            $.messager.show({
                title : 'Instruction:',
                msg : "Please Enter one item, From Date and To Date.",
                showType : 'show'
                // style:{
                //     right:'',
                //     top:document.body.scrollBottom+document.documentElement.scrollBottom,
                //     bottom:''
                // }
            });
          }


    }

    function monthReport(){

      var from_month = $('#start_month').datebox('getValue');
        var to_month = $('#end_month').datebox('getValue');
        var head = $('#txtmonthhead').combobox('getValue');
        var month_year = $('#month_year').combobox('getValue');

        if(from_month!="" && to_month!="" && head!="" && month_year!=""){
            //url:'invoice/by_date_filter_all_invoices.php?from_date='+from_date+'&to_date='+to_date
       if(head==='order'){
          window.open("Report/report_month/order_report_by_month.php?from_month="+from_month+'&to_month='+to_month+'&head='+head+'&month_year='+month_year,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else if(head==='Invoice/Billing'){
              window.open("Report/generate_report.php?from_month="+from_month+'&to_month='+to_month+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else if(head==='received'){
              window.open("Report/generate_report_received.php?from_month="+from_month+'&to_month='+to_date+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else{
        alert('Item Select Error!');
       }
       //var row=$('#dg').datagrid('getSelected');
          }
          else{
            $.messager.show({
                title : 'Instruction:',
                msg : "Please Enter one item, From month and To month.",
                showType : 'show'
                // style:{
                //     right:'',
                //     top:document.body.scrollBottom+document.documentElement.scrollBottom,
                //     bottom:''
                // }
            });
          }


    }

        function yearReport(){

        var from_year = $('#txtstart_year').datebox('getValue');
        var to_year = $('#txtend_year').datebox('getValue');
        var head = $('#txthead_year').combobox('getValue');

        if(from_year!="" && to_year!="" && head!=""){
            //url:'invoice/by_date_filter_all_invoices.php?from_date='+from_date+'&to_date='+to_date
       if(head==='order'){
          window.open("Report/report_month/order_report_by_year.php?from_year="+from_year+'&to_year='+to_year+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else if(head==='Invoice/Billing'){
              window.open("Report/generate_report.php?from_month="+from_year+'&to_year='+to_year+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else if(head==='received'){
              window.open("Report/generate_report_received.php?from_month="+from_year+'&to_year='+to_date+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else{
        alert('Item Select Error!');
       }
       //var row=$('#dg').datagrid('getSelected');
          }
          else{
            $.messager.show({
                title : 'Instruction:',
                msg : "Please Enter one item, From Year and To Year.",
                showType : 'show'
                // style:{
                //     right:'',
                //     top:document.body.scrollBottom+document.documentElement.scrollBottom,
                //     bottom:''
                // }
            });
          }


    }
    
    
 function clientReport(){
        var client_id = $('#txtclient_id').combobox('getValue');
      
        var from_date = $('#txt_from_date_client').datebox('getValue');
        var to_date = $('#txt_to_date_client').datebox('getValue');
        var head = $('#txthead_client').combobox('getValue');
        if(from_date!=="" && to_date!=="" && head!=="" && client_id!==""){
            //url:'invoice/by_date_filter_all_invoices.php?from_date='+from_date+'&to_date='+to_date
       if(head==='order_client'){
          window.open("Report/print_pre_order_by_client.php?client_id="+client_id+'&from_date='+from_date+'&to_date='+to_date+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else if(head==='Invoice/Billing_client'){
              window.open("Report/generate_report_client.php?client_id="+client_id+"&from_date="+from_date+'&to_date='+to_date+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else if(head==='received'){
              window.open("Report/generate_report_received.php?from_date="+from_date+'&to_date='+to_date+'&head='+head,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=no,direction=no,scrollbars=yes");
       }
       else{
        alert('Item Select Error!');
       }
       //var row=$('#dg').datagrid('getSelected');
          }
          else{
            $.messager.show({
                title : 'Instruction:',
                msg : "Please Enter one item, From Date and To Date.",
                showType : 'show'
                // style:{
                //     right:'',
                //     top:document.body.scrollBottom+document.documentElement.scrollBottom,
                //     bottom:''
                // }
            });
          }


    }

</script>