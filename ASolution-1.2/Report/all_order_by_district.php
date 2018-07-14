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
    .client_order_report .highlight{ color:red; font-weight: 500; }
    
    .advance_search{
        border:1px #ccc solid;
        padding:50px;
    }
    
</style>
<div class="advance_search">
    <span><strong>Filter By</strong> </span>
    <label>Division:</label>
           <select  name="division" id="country" onChange="getState(this.value)">
                            <option value="">Select Division</option>
                            <option value="1">Dhaka</option>
                            <option value="2">Chittagong</option>
                            <option value="3">Rajshahi</option>
                            <option value="4">Khulna</option>
                            <option value="5">Barisal</option>
                            <option value="6">Sylhet</option>
                            <option value="7">Rangpur</option>
                             <option value="8">Mymensingh</option>
                        </select>
    
    <div id="statediv_order_form" style="display:inline;">
                            <label>District</label>
                            <select name="district" class="district" >
                                <option value="">Select Division First</option>
                            </select>
                        </div>
    
                    <div id="citydiv_order_form" style="display:inline;">
                            <label>Upazila</label>
                            <select name="upazila" class="sub_district">
                                <option value="">Select District First</option>
                            </select>
                    </div>
    <input type="button" name="advance_search" value="Filter" class="filter" style="width:100px;padding:2px;cursor: pointer;">
     <button type="button" onclick="printPreview();" style="width:100px;padding:2px;cursor: pointer;">Print Preview</button>
    <hr>
    <br>
    <div id="advance_filter_container_div">

<div class="all_client">
    
    <table border="0" class="client_order_report" width="100%" style="color:#333;">
    <caption style="font-size: 14px; color:#0081c2; font-weight: bold; ">Order Account By District</caption>
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
                   if($row_cust['cust_id']==$row['cust_id']){ // if cust_id of tbl_customer  = cust_id of tbl_order is equal
                        $query_district = $con->prepare("Select * from state order by statename");
               $query_district->execute();
               while($row_state=$query_district->fetch(PDO::FETCH_ASSOC)){
                   if($row_state['id']==$row_cust['district']){ // if district of tbl_customer = id of statename is equeal

                       ?>
        <tr>
            <td colspan="7">
                <span class="heading_client">
                    <?php 
                    echo $sr++.'. '.$row_cust['name'].', '.$row_state['statename'].' [Number of Order-<span class="highlight">'.$row['order_number'].'</span>]';
                    ?>:
                </span>
            </td>

        </tr>
               <tr>
                   <td>&nbsp;</td>
                <td align="left"><?php echo $row['cust_id_new']; ?></td>
                <td  align="center">
                    <?php 
                    $t_amt = $row['priceEach']+$row['front_charge']+$row['back_charge']+$row['color_charge'];
                            
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
                              
                   } // if district of tbl_customer = id of statename is equeal
               } // State Table while loop End
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

        
         </div>
    
</div>
 <script language="javascript" type="text/javascript">

 function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	
	
	function getState(countryId) {		
		
		var strURL="pages/findStateForAdvanceSearch.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState === 4) {
					// only if "OK"
					if (req.status === 200) {						
						document.getElementById('statediv_order_form').innerHTML=req.responseText;	
                                            
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			};			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getCity(countryId,stateId) {		
		var strURL="pages/findCity.php?country="+countryId+"&state="+stateId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv_order_form').innerHTML=req.responseText;
                                                   document.getElementById('ref_citydiv').innerHTML = req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
        
        // END GET CITY FUNCTION for Customer
        
        </script>
        
        <script type="text/javascript">
            
            $(document).ready(function(){
                
                 $(':input[type="submit"]').prop('disabled', true);
                $('#country').change(function(){
                    var divisionId = $(this).val();
               $.ajax({
                           url:'Report/advance_filter_order.php?q='+divisionId,
                           success: function(data){
                           $('#advance_filter_container_div').html(data);
                           $(':input[type="submit"]').prop('disabled', false);
                           }
                       }); //  For Order of Division Load in the Div.
                }); 
                // ********** End change method for Division loading **************
                
                 $('.district').change(function(){
                    var divisionId = $('#country').val();
                    var districtId = $(this).val();
               $.ajax({
                           url:'Report/advance_filter_order.php?q='+divisionId+'&districtId='+districtId,
                           success: function(data){
                           $('#advance_filter_container_div').html(data);
                           $(':input[type="submit"]').prop('disabled', false);
                           }
                       }); //  For Order of Division Load in the Div.

                }); 
                // ********** End change method for Division loading **************
                
                     $('.filter').on('click',function(){
                    var divisionId = $('#country').val();
                     var districtId = $('.district').val();
                      var upazilaId = $('.sub_district').val();
                     
               $.ajax({
                           url:'Report/advance_filter_order.php?q='+divisionId+'&districtId='+districtId+'&cityId='+upazilaId,
                           success: function(data){
                           $('#advance_filter_container_div').html(data);
                           $(':input[type="submit"]').prop('disabled', false);
                           }
                       }); //  For Order of Division Load in the Div.

                }); 
               
                  
                
            });
            
          function printPreview(){
                    var divisionId = $('#country').val();
                     var districtId = $('.district').val();
                      var upazilaId = $('.sub_district').val();
                       window.open("Report/advance_filter_order.php?q="+divisionId+'&districtId='+districtId+'&cityId='+upazilaId,"myNewWinsr","width=990,height=600,toolbar=0,menubar=no,status=no,resizable=yes,location=center,direction=no,scrollbars=yes");
                };  
            
        </script>

