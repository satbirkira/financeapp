<!DOCTYPE html>
<?php $this->load->helper('url'); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Friend List</title>    
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui-1.10.4.custom/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" type="text/css" rel="stylesheet"/>
    <link href="../../css/style_shu.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript">
		function unfriend(o){
			var rep = /[A-Za-z_]/g;
			var id = o.id.replace(rep,'');
			var fid = $('#userId_'+id).val();
			var siteurl = '<?php //echo site_url('index.php/friendManagement'); 
							echo site_url('friendManagement');?>';
			siteurl = siteurl+'/deleteFriend';
			$.getJSON(siteurl+'?fid='+fid, function(data) {
				if (data.ok == true){
					$('#friend_'+id).remove();					
				}else{
					alert(data.msg);
				}
						
			});
		}
		
		
	</script>    
</head>
<body>
             <!-- Start the container Div -->
             <div id="container"> 
                <!-- Registration Div starts here -->
                <div id="registration" style="width:60%">
                
                	<div class="regititle">
                       <div style="width:50%;margin-left:auto;margin-right:auto;">Friend List</div>
                      <div style="width:150px; float:right; font-size:16px; color:#666"><a href="<?php //echo site_url('index.php/page/addFriend'); 
					  																				echo site_url('page/addFriend');?>" >Add More Friends</a>       </div>
                	</div>	
                    <?php if (count($friends)>0 && $friends !=''){ 
							for ($i = 0; $i<count($friends); $i++){
					?>
                    <div style="float:left; margin-right:5px; width:100px" id="friend_<?php echo $i+1; ?>">                     
                      <input type="hidden" id="userId_<?php echo $i+1; ?>" value="<?php echo $friends[$i]['friendId'];?>" />
                      <div class="delete" id="del_<?php echo $i+1; ?>" onClick="unfriend(this);" style="cursor:pointer;"><img src="../../images/delete.jpg" width="15px" height="15px" /></div>
                      <div style="width:80px">
                         <img src="../../uploads/profile/<?php echo $friends[$i]['friendImg']; ?>" width="100px" height="100px" />
                      </div>
                      <div>
                        <?php echo $friends[$i]['friendName'];?>
                      </div>
                    </div> 
                    <?php
						}
					}else{
						?> 
                    <div>You haven't added any friend yet. </div>
                    <?php } ?>
                                          
                </div> 
             <!-- Registration Div ends here -->     
            </div>
     <!-- End of the container Div -->
</body>
</html>