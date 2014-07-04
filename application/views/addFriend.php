<!DOCTYPE html>
<?php $this->load->helper('url'); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Friend</title>    
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" type="text/css" rel="stylesheet"/>
    <link href="../../css/style_shu.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript">
		function getBaseUrl(){
			var baseurl = '<?php echo base_url(); ?>';
			return baseurl;
		}

		$(document).ready(function(){
			$('.submit-button').button();
			
			
			
		});
	
	</script>    
</head>
<body>
             <!-- Start the container Div -->
             <div id="container"> 
                <!-- Registration Div starts here -->
                <div id="registration" style="width:60%">
                
                	<div class="regititle">
                    Add A New Friend
                	</div>	
                     <!-- Form Div starts here -->
                     <?php
					 $username = array(
                                  'name'        => 'username',
                                  'id'          => 'username',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
					 $firstname = array(
                                  'name'        => 'firstname',
                                  'id'          => 'firstname',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
                     $lastname = array(
                                  'name'        => 'lastname',
                                  'id'          => 'lastname',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );                   
                 
                                
					echo form_open('index.php/FriendManagement/addFriend');
				   
					   ?> 
                       <div class="personalinfo">
                         <div class="glabel"><label for="username">Username:</label></div>                                      
                         <div class="ginput">
	                        <div><?php echo form_input($username,set_value('username')); ?></div>
						 	<div id="validateUsername" class="errormsg"><?php echo form_error('username'); ?></div>                         
                         </div>
                       </div>
                       
                       <div class="personalinfo">
                         <div class="glabel"><label for="firstname">First Name:</label></div>
                         <div class="ginput">						  	
                        	<div style="float:left;margin-left:0px;"><?php echo form_input($firstname,set_value('firstname')); ?></div>
                            <div id="validateFirstname" class="errormsg"><?php echo form_error('firstname'); ?></div>
                         </div>
                       </div>

                       <div class="personalinfo">
                            <div class="glabel"><label for="lastname">Last Name:</label></div>
                            <div class="ginput">                            	
                                <div style="float:left;margin-left:0px;"><?php echo form_input($lastname,set_value('lastname')); ?></div>
                                <div id="validateLastname" class="errormsg"><?php echo form_error('lastname'); ?></div>   
                            </div>
                       </div>                   
                        
                       <div class="personalinfo">
                            <input type="submit" id="btnAdd" name="btnAdd" value="Submit" class="submit-button" />
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