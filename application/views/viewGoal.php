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
		
		function getSiteUrl(){
			var siteurl = '<?php echo site_url('index.php/GoalManagement'); ?>';
			return siteurl;	
		}
		
		$(document).ready(function(e) {
			$('#accordion').wrap('<div style="height: 300px"></div>');
			$('#accordion').accordion({
				fillSpace: true,
				autoHeight: true
			});
			
			
			$('#progressDiv_1').progressbar({
				value: 75,
				create: function(e){
					$('#progVal').text($('#progressDiv_1').progressbar("value"));
				},
				complete: function(e){
					$('#incr').button("disable")
				},
				change: function(e){
					if ($(this).progressbar("value") < 100){
						$('#incr').button("enable")
					}
					$('#progVal').text($('#progressDiv_1').progressbar("value"));
				}
			});
        });
			
			
	
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
                <!-- Registration Div starts here -->
                <div id="goallist">
                
                	<div class="pagetitle">
                    Your saving goals
                	</div>                   
                    <div id="accordion">
                    <?php for($i = 0;$i<count($goals);$i++){
					?>
                      <div class="goaltitle">
                        <div><a href="#">Goal:  <?php echo $goals[$i]['goalName']; ?></a>                                                 
                             <div style="width: 25px; float:right; font-size:12px;"><img src="../../images/add2.jpg" title="Add Deposit"/></div>
                             <span style="width: 20px; float:right; font-size:16px;">%</span>  
                             <span id="progVal" style="width: 30px; float:right; font-size:16px;"></span>                             
                             <div id="progressDiv_1" style="width: 300px; float:right; margin-right: 5px;">                       	    
                             </div>
                        </div>                                         
                      </div>
                      
                      <div class="dcell">                                             
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
                            <table>
                              <tr>
                                <th></th>
                                <?php 
									  for($j = 0;$j<count($deposits[$i]);$j++){
								?>
                                <th><?php echo $deposits[$i][$j]['depositDate']; ?></th>
                                <?php } ?>
                              </tr>
                              <tr>
                                <td>Deposit</td>
                                 <?php
									  for($j = 0;$j<count($deposits[$i]);$j++){
								?>
                                <td><?php echo $deposits[$i][$j]['amount']; ?></td>
                                <?php } ?>
                                
                              </tr>                              
                            </table>
                                <?php 
									}else{ 
									?>
                              <table>
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
            </div>
     <!-- End of the container Div -->
</body>
</html>