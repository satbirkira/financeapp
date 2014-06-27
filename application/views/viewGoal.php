<!DOCTYPE html>
<?php $this->load->helper('url'); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View Goals</title>    
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" type="text/css" rel="stylesheet"/>
    <link href="../../css/style_shu.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript">
		function getBaseUrl(){
			var baseurl = '<?php echo base_url(); ?>';
			return baseurl;
		}
		
		$(document).ready(function(e) {
			$('#accordion').wrap('<div style="height: 300px"></div>');
			$('#accordion').accordion({
				fillSpace: true,
				autoHeight: true
			});
			
			setProgressVal();
			
			$('.dialog').dialog({
				autoOpen: false,
				resizable: false,
				modal: true,
				width: 400, 
				height: 150
			});
			
        });
			
	
	function setProgressVal(){
		var c = $('.progressDiv').length;		
		for (var i = 1; i<=c; i++){
			var id = '#progressDiv_';
			var pv = '#progVal_';
			id = id+i;
			pv = pv+i;
			var val = $(pv).text();
			val = val * 1;
			$(id).progressbar({
				value: val
			});
		}
	}
	
	function openDialog(o){
		var rep = /[A-Za-z_]/g;
		var id = o.id.replace(rep,'');
		$('#result_'+id).html('');
		document.getElementById('save_'+id).value = '';
		$('#dialog_'+id).dialog("open");

	}
	
	function deposit(o){
		var rep = /[A-Za-z_]/g;
		var id = o.id.replace(rep,'');
		var amount = $('#save_'+id).val();
		var gid = $('#goalId_'+id).val();
		var siteurl = '<?php echo site_url('index.php/depositManagement'); ?>';
		siteurl = siteurl+'/addDeposit';
		var d = new Date();
		var today = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
		
		$.getJSON(siteurl+'?gid='+gid+'&amount='+amount, function(data) {
			var result = $('#result_'+id);
			result.html(data.msg);
			if(data.ok == true){
				result.css('color','#3C3');
				//update Goal Info
				$('#progVal_'+id).html(data.precent);
				$('#progressDiv_'+id).progressbar({
					value: data.precent
				});
				//update goal progress table
				if ($('#progress_'+id +' tr').length == 1){
					$('#progress_'+id).empty();
					$('#progress_'+id).append("<tr><th></th><th>"+today+"</th></tr><tr><td>Deposit</td><td>"+amount+"</td></tr>");
					
				}else{
					var lastele = $('#progress_'+id+ ' tr:nth-child(1)');
					lastele.append("<th>"+today+"</th>");
					
					lastele = $('#progress_'+id+ ' tr:nth-child(2)');
					lastele.append("<td>"+amount+"</td>");

				}
				
			}else{
				result.css('color','#900');
			}	
					
		});
	}
	
	
	</script>    
    <style type="text/css">
		#accordion {margin: 5px}
		.goaltitle {
     	     margin-left: auto; margin-right: auto; text-align: left; font-size: 20px;;
             color: #F93; background-size: contain; margin-top: 0;
        }
		.ui-progressbar{
			background:none;
			border:solid;
			border-color:#F93;
			height: 20px;
		}
		.ui-progressbar-value {
			background-image:url(../../images/progress-animation.png);
		}
		table {
			width: 100%;
			border-collapse: collapse;
			}
		th {
		background: #333;
		color: #fff;
		font-weight: bold;
		}
		td, th {
		padding: 5px;
		border: 1px solid #ddd;
		text-align: left;
		}
	</style>
</head>
<body>
             <!-- Start the container Div -->
             <div id="container"> 
                <!-- goallist div starts here -->
                <div id="goallist">
                
                	<div class="pagetitle">
                    Your saving goals
                	</div>                   
                    <div id="accordion">
                    <?php 
					  $k = 0;
					  for($i = 0;$i<count($goals);$i++){
						  $k = $i +1;
					?>
                      <div class="goaltitle">
                        <div><a href="#">Goal:  <?php echo $goals[$i]['goalName']; ?></a>                                                 
                             <div id="addD_<?php echo $k ;?>" style="width: 25px; float:right; font-size:12px;" class="addD" onClick="openDialog(this);"><img src="../../images/add2.jpg" title="Add Deposit"/></div>
                             <span style="width: 20px; float:right; font-size:16px;">%</span>  
                             <span id="progVal_<?php echo $k; ?>" style="width: 30px; float:right; font-size:16px;">
                             <?php 
							 $percent = round($goals[$i]['currentlySaved']/$goals[$i]['totalCost'],2)*100;
							 echo $percent; ?>
                             </span>                             
                             <div id="progressDiv_<?php echo $k; ?>" class="progressDiv" style="width: 300px; float:right; margin-right: 5px;">                       	    
                             </div>
                        </div>                                         
                      </div>
                      
                      <div class="dcell">        
                        <input type="hidden" id="goalId_<?php echo $i+1; ?>" value="<?php echo $goals[$i]['goalId']; ?>" />                                    
                        <div class="goalinfo">
                            <label for="goalTotal">Goal total:</label>
                            <div class="info">$<?php echo $goals[$i]['totalCost']; ?></div>
                        </div>                     
                        <div class="goalinfo">
                            <label for="monthly">Estimated Monthly Deposit:</label>
                            <div class="info">$<?php echo $goals[$i]['monthlyDepot']; ?></div>
                        </div>  
                        <div class="goalinfo">
                            <label for="start">Start Date:</label>
                            <div class="info"><?php echo $goals[$i]['startDate']; ?></div>
                        </div>  
                        <div class="goalinfo">
                            <label for="target">Target Date:</label>
                            <div class="info"><?php echo $goals[$i]['targetDate']; ?></div>
                        </div>  
                        <div class="goalprogress" style="margin-top: 5px;">
                           <?php 
								if ($deposits[$i] != ''){
									?>
                            <table id="progress_<?php echo $i+1; ?>">
                              <tr>
                                <th></th>
                                <?php 
									  for($j = 0;$j<count($deposits[$i]);$j++){
								?>
                                <th class="thDate"><?php echo $deposits[$i][$j]['depositDate']; ?></th>
                                <?php } ?>
                              </tr>
                              <tr>
                                <td>Deposit</td>
                                 <?php
									  for($j = 0;$j<count($deposits[$i]);$j++){
								?>
                                <td class="tdAmount"><?php echo $deposits[$i][$j]['amount']; ?></td>
                                <?php } ?>
                              </tr>                              
                            </table>
                                <?php 
									}else{ 
									?>
                              <table id="progress_<?php echo $i+1; ?>">
                                <tr>
                                <th>Haven't started yet.</th>
                                </tr>
                              </table>

                                
                                <?php } ?>
                        </div>  
                       
                      </div>                     
                       
                      <!-- One Goal --> 
                      <?php } ?> 
                       
                       
                    </div>	
                    
                    <!-- Accordion Div ends here --> 
                    
                   
             </div> 
             <!-- Goal View Div ends here -->   
             <?php   
  			 for($i = 1 ; $i <= count($goals);$i++){ ?>
             <div id="dialog_<?php echo $i; ?>" class="dialog" title="Add deposit" style="400px;">
                 <div style="float:left;"><label for="total" >Saved($):</label></div>
                 <div style="float:left; margin-left:5px;"><input type="text" id="save_<?php echo $i; ?>" /></div>
                   <input id="btn_dg_<?php echo $i; ?>" type="button" onClick="deposit(this);" value="Submit" class="btn" />
                  <span id="result_<?php echo $i; ?>"></span>
             </div>
			 <?php } ?>
			 
            </div>
     <!-- End of the container Div -->
</body>
</html>