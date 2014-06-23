<!DOCTYPE html>
<?php $this->load->helper('url'); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add a New Goal</title>    
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
		
		
		$(document).ready(function(){
			$('.submit-button').button();
			
			$('#startDate').datepicker({
				showOn: "both",
				buttonImage: "../../images/calendar.gif",
				buttonImageOnly: true,
				constrainInput: true,
				minDate: "0",
				maxDate: "+10y",
				appendText: '(yyyymmdd)'

			});
			
			$('#targetDate').datepicker({
				showOn: "both",
				buttonImage: "../../images/calendar.gif",
				buttonImageOnly: true,
				constrainInput: true,
				minDate: "0",
				maxDate: "+10y",
				appendText: '(yyyymmdd)'

			});
			
			
		});
	
	</script>    
</head>
<body>
             <!-- Start the container Div -->
             <div id="container"> 
                <!-- Registration Div starts here -->
                <div id="registration" style="width:60%">
                
                	<div class="regititle">
                    Add a New Saving Goal
                	</div>	
                     <!-- Form Div starts here -->
                     <?php
					 $goalTitle = array(
                                  'name'        => 'goalTitle',
                                  'id'          => 'goalTitle',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
					 $total = array(
                                  'name'        => 'total',
                                  'id'          => 'total',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
                     $startDate = array(
                                  'name'        => 'startDate',
                                  'id'          => 'startDate',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
                     $targetDate = array(
                                  'name'        => 'targetDate',
                                  'id'          => 'targetDate',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '100'
                                );
                     $monthlyDepot = array(
                                  'name'        => 'monthlyDepot',
                                  'id'          => 'monthlyDepot',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '30'
                                );
                     $interestRate = array(
                                  'name'        => 'interestRate',
                                  'id'          => 'interestRate',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '30'
                                );
                 
                                
					echo form_open('index.php/GoalManagement/addGoal');
				   
					   ?>
                      <div class="personalinfo">                                                       
                        <div class="glabel"><label for="goalTitle">What is your saving goal?</label></div>                        
                        <div class="ginput">	                        
                       		<?php echo form_input($goalTitle,set_value('goalTitle')); ?>  
                            <div id="validateGoalTitle" class="errormsg"><?php echo form_error('goalTitle'); ?></div>             				
                        </div>
                       </div>
                       
                       <div class="personalinfo">
                         <div class="glabel"><label for="total">Goal Total($):</label></div>                                      
                         <div class="ginput">
	                        <div><?php echo form_input($total,set_value('total')); ?></div>
						 	<div id="validateTotal" class="errormsg"><?php echo form_error('total'); ?></div>                         </div>
                       </div>
                       
                       <div class="personalinfo">
                         <div class="glabel"><label for="startDate">Start Date:</label></div>
                         <div class="ginput">						  	
                        	<div style="float:left;margin-left:0px;"><?php echo form_input($startDate,set_value('startDate')); ?></div>
                            <div id="validateStartDate" class="errormsg"><?php echo form_error('startDate'); ?></div>
                         </div>
                       </div>

                       <div class="personalinfo">
                            <div class="glabel"><label for="targetDate">Target Date:</label></div>
                            <div class="ginput">                            	
                                <div style="float:left;margin-left:0px;"><?php echo form_input($targetDate,set_value('targetDate')); ?></div>
                                <div id="validateTargetDate" class="errormsg"><?php echo form_error('targetDate'); ?></div>   
                            </div>
                       </div>

                       <div class="personalinfo">
                            <div class="glabel"><label for="monthlyDepot">Estimated Monthly Deposit($):</label></div>
                            <div class="ginput">                            	
                                <?php echo form_input($monthlyDepot,set_value('monthlyDepot')); ?>
                           		<div id="validateMonthlyDepot" class="errormsg"><?php echo form_error('monthlyDepot'); ?></div>
                            </div>
                        </div>

                        <div class="personalinfo">
                            <div class="glabel"><label for="interestRate">Annual Interest Rate(%):</label></div>
                            <div class="ginput">                           	
                           	    <?php echo form_input($interestRate,set_value('interestRate')); ?>
                                <div id="validateInterestRate" class="errormsg"><?php echo form_error('interestRate'); ?></div>                		    </div>                                      
                        </div>

                        <div class="personalinfo">
                            <input type="submit" id="btnAdd" name="btnAdd" value="Submit" class="submit-button" />
                            <input type="reset" id="btnReset" name="btnReset" value="Reset" class="submit-button" />
                        </div>

                   
                <?php
                    echo form_close();
                ?>
                   
                 <!-- Form Div ends here -->  
             </div> 
             <!-- Registration Div ends here -->     
            </div>
     <!-- End of the container Div -->
</body>
</html>