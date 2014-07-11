
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
			$('.accordion').wrap('<div style="height: 300px"></div>');
			$('.accordion').accordion({
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
			
			$('.dialog2').dialog({
				autoOpen: false,
				resizable: false,
				modal: true,
				width: 500, 
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
		
		c = $('.coprogressDiv').length;
		for (var i = 1; i<=c; i++){
			var id = '#coprogressDiv_';
			var pv = '#coprogVal_';
			id = id+i;
			pv = pv+i;
			var val = $(pv).text();
			val = val * 1;
			$(id).progressbar({
				value: val
			});
		}
		
	}
	
	function openDialog(type,o){
		var rep = /[A-Za-z_]/g;
		var id = o.id.replace(rep,'');
		
		if(type =='own'){
			$('#result_'+id).html('');
			document.getElementById('save_'+id).value = '';
			$('#dialog_'+id).dialog("open");
		}else{
			$('#resultc_'+id).html('');
			document.getElementById('savec_'+id).value = '';
			$('#dialogc_'+id).dialog("open");

		}

	}
	
	function removeGoal(o){
		var c = confirm("Are you sure you want to remove this goal?");
		if (c != true) {
			return;
		} else {			
			var rep = /[A-Za-z_]/g;
			var id = o.id.replace(rep,'');
			var gid = $('#goalId_'+id).val();
			var siteurl = '<?php //echo site_url('index.php/goalManagement');
			                     echo site_url('goalManagement'); ?>';
			siteurl = siteurl+'/deleteGoal';
			
			$.getJSON(siteurl+'?gid='+gid, function(data) {
				if (data.ok == true){
					//alert('removing goal success.');
					$('#goal_'+id).remove();
					$('#goalcell_'+id).remove();
					
				}else{
					alert(data.msg);
				}
						
			});
			
		}
		
		
	}
	
	function deposit(type,o){
		var rep = /[A-Za-z_]/g;
		var id = o.id.replace(rep,'');
		if (type == 'own'){
			var amount = $('#save_'+id).val();
			var gid = $('#goalId_'+id).val();
			var siteurl = '<?php //echo site_url('index.php/depositManagement'); 
								 echo site_url('depositManagement'); ?>';
			siteurl = siteurl+'/addDeposit';
			//alert(siteurl);
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
					//update monthly deposit
					$('#goalcell_'+id+' .goalinfo:nth-child(3) .info').html('$'+data.monthly);
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
		}else{//collaborate on goals
			var amount = $('#savec_'+id).val();
			var gid = $('#cogoalId_'+id).val();
			var siteurl = '<?php //echo site_url('index.php/depositManagement'); 
								 echo site_url('depositManagement'); ?>';
			siteurl = siteurl+'/addDeposit';
			var d = new Date();
			var today = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
			
			$.getJSON(siteurl+'?gid='+gid+'&amount='+amount, function(data) {
				var result = $('#resultc_'+id);
				result.html(data.msg);
				if(data.ok == true){
					result.css('color','#3C3');
					//update Goal Info
					$('#coprogVal_'+id).html(data.precent);
					$('#coprogressDiv_'+id).progressbar({
						value: data.precent
					});
					//update monthly deposit
					$('#cogoalcell_'+id+' .goalinfo:nth-child(3) .info').html('$'+data.monthly);
					//update goal progress table
					if ($('#coprogress_'+id +' tr').length == 1){
						$('#coprogress_'+id).empty();
						$('#coprogress_'+id).append("<tr><th></th><th>"+today+"</th></tr><tr><td>Deposit</td><td>"+amount+"</td></tr>");
						
					}else{
						var lastele = $('#coprogress_'+id+ ' tr:nth-child(1)');
						lastele.append("<th>"+today+"</th>");
						
						lastele = $('#coprogress_'+id+ ' tr:nth-child(2)');
						lastele.append("<td>"+amount+"</td>");
	
					}
					
				}else{
					result.css('color','#900');
				}	
						
			});
		
		}
		
	}
	
	
	function invite(o){
		var rep = /[A-Za-z_]/g;
		var id = o.id.replace(rep,'');
		$('#result2_'+id).html('');
		$('#dialog2_'+id).dialog("open");
		
	}
	
	function inviteFriend(o){
		var rep = /[A-Za-z_]/g;
		var id = o.id.replace(rep,'');
		var uid = document.getElementsByName("friends")[0].value;
		var gid = document.getElementById('goalId_'+id).value;	
		var sel = document.getElementsByName("friends")[0].selectedIndex;
		var selopt = document.getElementsByName("friends")[0].options;
		var uname = selopt[sel].text;
		var siteurl = '<?php //echo site_url('index.php/goalManagement'); 
							echo site_url('goalManagement'); ?>';
		siteurl = siteurl+'/addCollaborator';
		
		$.getJSON(siteurl+'?gid='+gid+'&uid='+uid, function(data) {
			var result = $('#result2_'+id);
			result.html(data.msg);
			if(data.ok == true){
				result.css('color','#3C3');
				//update Goal Info
				if(data.exist == false){
				var old = $('#goalcell_'+id+' .goalinfo:nth-child(6) .info').html();
				if (old != 'None'){
  				  $('#goalcell_'+id+' .goalinfo:nth-child(6) .info').html(old+' '+uname);
				}else{
				  $('#goalcell_'+id+' .goalinfo:nth-child(6) .info').html(uname);
					}
				}
				
				
			}else{
				result.css('color','#900');
			}	
					
		});
	}
	
	</script>    
    <style type="text/css">
		.accordion {margin: 5px}
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
			 
			 <div class="goals_top_menu">
			 	<div class="goals_top_menu_container">
				 <a href="http://localhost/page/viewGoal" class="selected">View Goal</a>
				 <a href="http://localhost/page/addGoal">Add Goal</a>
				 <a href="http://localhost/page/viewFriends">View Friends</a>
				 <a href="http://localhost/page/addFriend">Add Friend</a>
				 <a href="http://localhost/page/viewFriendsGoal">View Friend's Goals</a>
				</div>
			 </div>
			 
                <!-- goallist div starts here -->
                <div id="goallist" class="goallist">
                
                    <div class="pagetitle">
                    Your saving goals
                    </div>
                    <?php
                     if(count($goals) == 0 || $goals == ''){
                    ?>
                      <div> You haven't setup any goal yet. </div>
                      <div style="font-size:16px; color:#666; width: 50%; margin-left:auto; margin-right:auto;">
                        <a href="<?php //echo site_url('index.php/page'); 
									    echo site_url('page');?>/addGoal">Add A Saving Goal</a>       
                      </div>
                    <?php 
                     }else{
                    ?>                   
                    
                        <div id="accordion_1" class="accordion">
                        <?php 
                          $k = 0;
                          for($i = 0;$i<count($goals);$i++){
                              $k = $i +1;
                        ?>
                          <div class="goaltitle" id="goal_<?php echo $k ;?>">
                            <div><a href="#">Goal:  <?php echo $goals[$i]['goalName']; ?></a>  
                                 <div id="inviteF_<?php echo $k ;?>" style="width: 25px; float:right; font-size:12px;" class="addD" onClick="invite(this);"><img src="../../images/add.jpg" width="33" height="33" title="Invite friends to collaborate"/></div>
                                 <div id="addD_<?php echo $k ;?>" style="width: 25px; float:right; font-size:12px;" class="addD" onClick="openDialog('own',this);"><img src="../../images/add2.jpg" title="Add Deposit"/></div>
                                 <div id="rmG_<?php echo $k ;?>" style="width: 25px; float:right; font-size:12px;" class="rmG" onClick="removeGoal(this);"><img src="../../images/delete.jpg" title="Remove Goal"/></div>
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
                          
                          <div class="dcell" id="goalcell_<?php echo $k ;?>">        
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
                                <div class="info">
								<?php 
									$goals_start_day = date("F d", STRTOTIME($goals[$i]['startDate']));
									$goals_start_year = date("Y", STRTOTIME($goals[$i]['startDate']));
									echo $goals_start_day . ", ". $goals_start_year;
									
								?>
								
								</div>
                            </div>  
                            <div class="goalinfo">
                                <label for="target">Target Date:</label>
                                <div class="info">
								<?php 
									$goals_target_day = date("F d", STRTOTIME($goals[$i]['targetDate']));
									$goals_target_year = date("Y", STRTOTIME($goals[$i]['targetDate']));
									echo $goals_target_day . ", ". $goals_target_year;
								
								?>
								
								</div>
                            </div>  
                            <div class="goalinfo">
                                <label for="target">Collaborators:</label>
                                <div class="info"><?php if ($members[$i] != '') {
									
									  for ($j=0;$j<count($members[$i]);$j++){
										 echo $members[$i][$j]['userName'].' ';
								  	  } 
									}else{
										echo 'None';
									}?></div>
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
                                    <th class="thDate">
									<?php 
									
									$deposits_day = date("F d", STRTOTIME($deposits[$i][$j]['depositDate']));
									$deposits_year = date("Y", STRTOTIME($deposits[$i][$j]['depositDate']));
									echo $deposits_day . ", ". $deposits_year;
									
									
									?>
									
									</th>
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
                  <?php } ?>  
                   
             </div> 
             <!-- Goal View Div ends here -->   
             
            <!-- goal collaborated view -->
            <div id="goallist_2" class="goallist">
                
                    <div class="pagetitle">
                    You're collaborating on these saving goals
                    </div>
                    <?php
                     if(count($cogoals)== 0 || $cogoals == ''){
                    ?>
                      <div> You haven't join any goal yet. </div>                      
                    <?php 
                     }else{
                    ?>                   
                    
                        <div id="accordion_2" class="accordion">
                        <?php 
                          $k = 0;
                          for($i = 0;$i<count($cogoals);$i++){
                              $k = $i +1;
                        ?>
                          <div class="goaltitle" id="cogoal_<?php echo $k ;?>">
                            <div><a href="#">Goal:  <?php echo $cogoals[$i]['goalName']; ?></a>  
                                 <div id="coaddD_<?php echo $k ;?>" style="width: 25px; float:right; font-size:12px;" class="addD" onClick="openDialog('co',this);"><img src="../../images/add2.jpg" title="Add Deposit"/></div>
                                 <span style="width: 20px; float:right; font-size:16px;">%</span>  
                                 <span id="coprogVal_<?php echo $k; ?>" style="width: 30px; float:right; font-size:16px;">
                                 <?php 
                                 $percent = round($cogoals[$i]['currentlySaved']/$cogoals[$i]['totalCost'],2)*100;
                                 echo $percent; ?>
                                 </span>                             
                                 <div id="coprogressDiv_<?php echo $k; ?>" class="coprogressDiv" style="width: 300px; float:right; margin-right: 5px;">                       	    
                                 </div>
                            </div>                                         
                          </div>
                          
                          <div class="dcell" id="cogoalcell_<?php echo $k ;?>">        
                            <input type="hidden" id="cogoalId_<?php echo $i+1; ?>" value="<?php echo $cogoals[$i]['goalId']; ?>" />                                    
                            <div class="goalinfo">
                                <label for="goalTotal">Goal total:</label>
                                <div class="info">$<?php echo $cogoals[$i]['totalCost']; ?></div>
                            </div>                     
                            <div class="goalinfo">
                                <label for="monthly">Estimated Monthly Deposit:</label>
                                <div class="info">$<?php echo $cogoals[$i]['monthlyDepot']; ?></div>
                            </div>  
                            <div class="goalinfo">
                                <label for="start">Start Date:</label>
                                <div class="info">
								<?php 
								
									$goals_colab_start_day = date("F d", STRTOTIME($goals[$i]['startDate']));
									$goals_colab_start_year = date("Y", STRTOTIME($goals[$i]['startDate']));
									echo $goals_colab_start_day . ", ". $goals_colab_start_year;
								
								
								?>
								</div>
                            </div>  
                            <div class="goalinfo">
                                <label for="target">Target Date:</label>
                                <div class="info">
								<?php 
								
									$goals_colab_target_day = date("F d", STRTOTIME($goals[$i]['targetDate']));
									$goals_colab_target_year = date("Y", STRTOTIME($goals[$i]['targetDate']));
									echo $goals_colab_target_day . ", ". $goals_colab_target_year;
								
								?>
								</div>
                            </div>  
                            <div class="goalinfo">
                                <label for="target">Collaborators:</label>
                                <div class="info"><?php if ($comembers[$i] != '') {
									
									  for ($j=0;$j<count($comembers[$i]);$j++){
										 echo $comembers[$i][$j]['userName'].' ';
								  	  } 
									}else{
										echo 'None';
									}?></div>
                            </div> 
                            <div class="goalprogress" style="margin-top: 5px;">
                               <?php 
                                    if ($codeposits[$i] != ''){
                                        ?>

                                <table id="coprogress_<?php echo $i+1; ?>">
                                  <tr>
                                    <th></th>
                                    <?php 
                                          for($j = 0;$j<count($codeposits[$i]);$j++){
                                    ?>
                                    <th class="thDate">
									
									<?php 
									
										$deposits_colab_day = date("F d", STRTOTIME($codeposits[$i][$j]['depositDate']));
										$deposits_colab_year = date("Y", STRTOTIME($deposits[$i][$j]['depositDate']));
										echo $deposits_colab_day . ", ". $deposits_colab_year;
									
									
									?>
									
									</th>
                                    <?php } ?>
                                  </tr>
                                  <tr>
                                    <td>Deposit</td>
                                     <?php
                                          for($j = 0;$j<count($codeposits[$i]);$j++){
                                    ?>
                                    <td class="tdAmount"><?php echo $codeposits[$i][$j]['amount']; ?></td>
                                    <?php } ?>
                                  </tr>                              
                                </table>
                                    <?php 
                                        }else{ 
                                        ?>
                                  <table id="coprogress_<?php echo $i+1; ?>">
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
                  <?php } ?>  
                   
             </div> 
             <!-- Goal View Div ends here -->    
             
             
             <?php   
  			 for($i = 1 ; $i <= count($goals);$i++){ ?>
             <div id="dialog_<?php echo $i; ?>" class="dialog" title="Add deposit">
                 <div style="float:left;"><label for="total" >Saved($):</label></div>
                 <div style="float:left; margin-left:5px;"><input type="text" id="save_<?php echo $i; ?>" /></div>
                   <input id="btn_dg_<?php echo $i; ?>" type="button" onClick="deposit('own',this);" value="Submit" class="btn" />
                  <span id="result_<?php echo $i; ?>"></span>
             </div>
			 <?php } ?>
             
             
             <?php   
  			 for($i = 1 ; $i <= count($goals);$i++){ ?>
             <div id="dialog2_<?php echo $i; ?>" class="dialog2" title="Invite Your Friend">
                 <?php if (count($friends) < 1 || $friends == ''){
				 ?>
                 <div> You don't have any friends. :( </div> 
                 <?php					 
				 }else{
				 ?>
                 <div style="float:left;"><label for="total" >Send Invitation To:</label></div>
                 <div style="float:left; margin-left:1px;">
                    <select name="friends">
                      <?php for ($f = 0; $f<count($friends); $f++){
					  ?>
                      <option value="<?php echo $friends[$f]['friendId']; ?>"><?php echo $friends[$f]['friendName']; ?></option>                      
                      <?php } ?>
                    </select>
                 </div>
                 <input id="btn_dgf_<?php echo $i; ?>" type="button" onClick="inviteFriend(this);" value="Submit" class="btn" />
                 <span id="result2_<?php echo $i; ?>"></span>
             </div>
			 <?php 
				 }
			} ?>
			
            <!--Dialog for adding deposit to collaborating goal -->
            
            <?php   
  			 for($i = 1 ; $i <= count($cogoals);$i++){ ?>
             <div id="dialogc_<?php echo $i; ?>" class="dialog" title="Add deposit">
                 <div style="float:left;"><label for="total" >Saved($):</label></div>
                 <div style="float:left; margin-left:5px;"><input type="text" id="savec_<?php echo $i; ?>" /></div>
                   <input id="btn_dgc_<?php echo $i; ?>" type="button" onClick="deposit('c',this);" value="Submit" class="btn" />
                  <span id="resultc_<?php echo $i; ?>"></span>
             </div>
			 <?php } ?>           
           
            
            </div>
     <!-- End of the container Div -->
</body>
</html>