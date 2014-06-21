<!DOCTYPE html>
<?php $this->load->helper('url'); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register</title>    
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" type="text/css" rel="stylesheet"/>
    <link href="../../css/style_shu.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript">
		var is_valid = new Array(2);
		checkform('init',false);	
		function getBaseUrl(){
			var baseurl = '<?php echo base_url(); ?>';
			return baseurl;
		}
		
		function getSiteUrl(){
			var siteurl = '<?php echo site_url('index.php/Registration'); ?>';
			return siteurl;	
		}
		
		
		function checkform(e,txt){
			
			switch(e){
						
				case 'username':						
					is_valid['username'] = txt;	
					break;	
							
				case 'email':		
					is_valid['email'] = txt;	
					break;
				
				default:
					is_valid['email'] = txt;	
					is_valid['username'] = txt;				
					break;
					
			}
			
		}
		
		
		
		$(document).ready(function(){
			checkform('init',false);	
			$('.submit-button').button();
			 
			var valUsername = $('#validateUsername');
			var valEmail = $('#validateEmail');
			
			var siteurl1 = getSiteUrl()+'/check_username';
			var siteurl2 = getSiteUrl()+'/check_email';
					
     		$('#screenname').keyup(function(){
					var t = this; 
					
					if (this.value != this.lastValue) {
						if (this.timer) clearTimeout(this.timer);
						
						valUsername.removeClass('error').html('checking availability...');
						
						this.timer = setTimeout(function () {		
							
						 	$.getJSON(siteurl1+'?username='+t.value, function(data) {
            					valUsername.html(data.msg);
								if(data.ok == true){
									valUsername.css('color','#3C3');
								}else{
									valUsername.css('color','#900');
								}
								checkform('username',data.ok);	
        					});
								
							
						}, 200); 
						
						this.lastValue = this.value;
					}
					
					
				
			});	
			
			
			$('#email').keyup(function(){
		
					var t = this; 
					
					if (this.value != this.lastValue) {
						if (this.timer) clearTimeout(this.timer);
						
						valEmail.removeClass('error').html('checking availability...');
		
						this.timer = setTimeout(function () {		
									
							$.getJSON(siteurl2+'?email='+t.value, function(data) {		
							    valEmail.html(data.msg);						
            					if(data.ok == true){
									valEmail.css('color','#3C3');
								}else{
									valEmail.css('color','#900');
								}
								checkform('email',data.ok);	
        					});
															   
							
						}, 200);				
						
					   this.lastValue = this.value;
					}
					
					
				
			});	
			
			$('.submit-button').click(function (evt) {
				if (is_valid['email'] == false || is_valid['username'] == false ){
					evt.preventDefault();				
				}
			});
			
		});
	
	</script>    
</head>
<body>
             <!-- Start the container Div -->
             <div id="container"> 
                <!-- Registration Div starts here -->
                <div id="registration">
                
                	<div class="regititle">
                    Register with your email address
                	</div>	
                     <!-- Form Div starts here -->
                     <?php
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
                    $screenname = array(
                                  'name'        => 'screenname',
                                  'id'          => 'screenname',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '60'
                                );
                    $email = array(
                                  'name'        => 'email',
                                  'id'          => 'email',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '100'
                                );
                    $password = array(
                                  'name'        => 'password',
                                  'id'          => 'password',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '30'
                                );
                    $confirmpassword = array(
                                  'name'        => 'confirmpassword',
                                  'id'          => 'confirmpassword',
                                  'class'		=> 'form_input',
                                  'maxlength'   => '30'
                                );
                 
                                
					echo form_open('index.php/registration/register');
				   
					   ?>
                      <div class="personalinfo">                                                       
                        <div class="glabel"><label for="firstname">First Name:</label></div>                        
                        <div class="ginput">	                        
                       		<?php echo form_input($firstname,set_value('firstname')); ?>  
                            <div id="validateFirstName" class="errormsg"><?php echo form_error('firstname'); ?></div>	    	                   				
                        </div>
                       </div>
                       
                       <div class="personalinfo">
                         <div class="glabel"><label for="lastname">Last Name:</label></div>                                      
                         <div class="ginput">
	                        <div><?php echo form_input($lastname,set_value('lastname')); ?></div>
						 	<div id="validateLastName" class="errormsg"><?php echo form_error('lastname'); ?></div>              	
                            	
                         </div>
                       </div>
                       
                       <div class="personalinfo">
                         <div class="glabel"><label for="screenname">Choose a Username:</label></div>
                         <div class="ginput">
						  	
                        	<?php echo form_input($screenname,set_value('screenname')); ?>
                            <div id="validateUsername" class="errormsg"><?php echo form_error('screenname'); ?></div>
                         </div>
                       </div>

                       <div class="personalinfo">
                            <div class="glabel"><label for="email">Your Email:</label></div>
                            <div class="ginput">
                            	
                                <?php echo form_input($email,set_value('email')); ?>
                                <div id="validateEmail" class="errormsg"><?php echo form_error('email'); ?></div>   
                            </div>
                       </div>

                       <div class="personalinfo">
                            <div class="glabel"><label for="password">Choose a Password:</label></div>
                            <div class="ginput">                            	
                                <?php echo form_password($password,set_value('password')); ?>
                           		<div id="validatePassword" class="errormsg"><?php echo form_error('password'); ?></div>
                            </div>
                        </div>

                        <div class="personalinfo">
                            <div class="glabel"><label for="confirmpassword">Confirm the Password:</label></div>
                            <div class="ginput">                           	
                           	    <?php echo form_password($confirmpassword,set_value('confirmpassword')); ?>
                            	<div id="validatePassword2" class="errormsg"><?php echo form_error('confirmpassword'); ?></div>                          		
                            </div>                                      
                        </div>

                        <div class="personalinfo">
                            <input type="submit" id="btnRegister" name="btnRegister" value="Register" class="submit-button" />
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