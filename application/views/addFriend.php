<!DOCTYPE html>
<?php $this->load->helper('url'); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Friend</title>    
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../js/jquery.tmpl.js"></script>
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" type="text/css" rel="stylesheet"/>
    <link href="../../css/style_shu.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript">
		function getBaseUrl(){
			var baseurl = '<?php echo base_url(); ?>';
			return baseurl;
		}

		$(document).ready(function(){
			$('.submit-button').button();			
			
			$('#btnSearch').click(function(e) {
				$('#result').empty();

                var username = $('#username').val();
                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
				var siteurl = '<?php //echo site_url('index.php/FriendManagement'); 
				                     echo site_url('FriendManagement'); ?>';
				siteurl = siteurl+'/searchFriend';
				
				$.getJSON(siteurl+'?fname='+username+'&firstname='+firstname+'&lastname='+lastname, function(data) {
					if (data.ok == true){						
						var num = data.friends.length;
						//alert(num);
						for (var i = 0; i<num; i++){
							var elems = $('#friendTmpl').tmpl(data.friends[i]);
							var j =i+1;
							var newrow = "<div id=\"row"+j+"\" class=\"drow\"></div>";
							$('#result').append(newrow);
							elems.slice(0).appendTo("#row"+j);
							if(data.friends[i].friendStatus == 'added'){
								//alert('added');
								$('#row'+j+' .add-button').attr("disabled", "disabled");
								$('#row'+j+' .add-button').attr("value","Added");
							}
						}
						$('.add-button').button();
						
						$('.add-button').click(function(e) {
							var btn = $(this);
							var fid = $(this).prev().val();
							//alert(fid);			
							var siteurl = '<?php //echo site_url('index.php/FriendManagement'); 
												 echo site_url('FriendManagement'); ?>';
							siteurl = siteurl+'/addOneFriend';
							
							$.getJSON(siteurl+'?fid='+fid, function(data) {
								if (data.ok == true){						
									btn.attr("disabled", "disabled");
									btn.attr("value","Added");
								}else{						
									alert(data.msg);
								}
								
							});
							
							
						});
						
					}else{						
						var newrow = "<div>"+data.msg+"</div>";
						$('#result').append(newrow);
					}
							
				});
            });
			
			
			
			
		});
	
	</script>    
    <script id="friendTmpl" type="text/x-jquery-tmpl">	
	  <div style="float:left; margin-right:5px; width:100px" id="frienddiv">   	                     
		  <div style="width:80px">
			 <img src="../../uploads/profile/${userImage}" width="100px" height="100px" />
		  </div>
		  <div>${userName}</div>
		  <div><input type="hidden" name="userId" value="${userId}" class="userIdhid" />  
		       <input type="button" name="btnAdd" value="Add" class="add-button" />
		  </div>
      </div>    
	</script>
</head>
<body>
             <!-- Start the container Div -->
             <div id="container"> 
			 
			 <a href="http://localhost/page/viewGoal">View Goal</a>
			 <a href="http://localhost/page/addGoal">Add Goal</a>
			 <a href="http://localhost/page/viewFriends">View Friends</a>
			 <a href="http://localhost/page/addFriend">Add Friend</a>
			 <a href="http://localhost/page/viewFriendsGoal">View Friend's Goals</a>
			 
			 
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
                 
                                
					//echo form_open('index.php/page/addFriend');
				   echo form_open('page/addFriend');
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
                            <input type="button" id="btnSearch" name="btnSearch" value="Search" class="submit-button" />
                       </div>

                   
                <?php
                    echo form_close();
                ?>
                   
                 <!-- Form Div ends here -->  
                 <div id="result"> 
                    
                 </div>
             </div> 
             <!-- Registration Div ends here -->     
            </div>
     <!-- End of the container Div -->
</body>
</html>