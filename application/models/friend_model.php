<?php
class Friend_Model extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function add_friend($arr)
    {
		//look for the friend in friend list
		
  		  $sql = "SELECT *
				  FROM friendlist fl
				  WHERE fl.userId = ?
				  and fl.friendId =?";	
				  			
		  $query = $this->db->query($sql,array($arr['userId'],$arr['friendId']));
		
		  if ($query->num_rows()>0) { //the friend has been added already
			$data = array(
						'friendDeleted' => 0
				);				
			$this->db->where('userId',$arr['userId']);
			$this->db->where('friendId', $arr['friendId']);
			$this->db->update('friendlist',$data);
			$result = $this->db->affected_rows();
		  }else{
		
   		     $result = $this->db->insert('friendlist',$arr);
		  }
		return $result;
    }	
	
	function get_all_friends($uid)
	{
		$data = "";
		$sql = "SELECT fl.userId as userId, fl.friendId as friendId, u2.userName as friendName, u2.userProfileImage as userImage
				FROM friendlist fl, user u, user u2
				WHERE u.userID = ?
				  and u.userID = fl.userId
				  and u2.userID = fl.friendId
				  and fl.friendDeleted = 0";
									
		$query = $this->db->query($sql,$uid);
		
		$i = 0;
		foreach($query->result_array() as $row){
			
			 $data[$i]['userId'] = $row['userId'];
     	     $data[$i]['friendId'] = $row['friendId'];
			 $data[$i]['friendName'] = $row['friendName'];
			 $data[$i]['friendImg'] = $row['userImage'];		 		
			 
			 $i++;
		}
		
		
		return $data;	
	}

	function remove_friend($uid,$fid)
    {
		$data = array(
						'friendDeleted' => 1
				);				
		$this->db->where('userId',$uid);
		$this->db->where('friendId', $fid);
		$this->db->update('friendlist',$data);
		$affected = $this->db->affected_rows();
		
		return $affected;

    }
	
	function check_friend_o($uid,$arr){
		$data = "";
		if ($arr['fname'] != ''){
  		  $sql = "SELECT u.userName as friendUserName, u.userFirstName as friendFirstName, u.userLastName as friendLastName
				  FROM friendlist fl, user u
				  WHERE fl.friendDeleted = 0
				  and fl.userId = ?
				  and fl.friendId = u.userID
				  and u.userName = ?";	
				  			
		  $query = $this->db->query($sql,array($uid,$arr['fname']));
		
		  if ($query->num_rows()>0) { //the friend has been added already
			$data = 'exist';
			
		  }else{ //find user information
		     $sql = "SELECT *
				     FROM user
					WHERE userName like '%?%'";	
				  			
		     $query = $this->db->query($sql,$arr['fname']);
			 if ($query->num_rows()>0){
  		       $i = 0;
	           foreach($query->result_array() as $row){
			
			     $data[$i]['userId'] = $row['userID'];
     	         $data[$i]['userFirstName'] = $row['userFirstName'];
			     $data[$i]['userLastName'] = $row['userLastName'];		 		
			 	 $data[$i]['error'] = '';
			     $i++;
		       }
			 }else{
				 $data[0]['error'] = 'user doesn\'t exist.';
			 }
			
		  }
		  
		}else{// find friends using firstname and lastname
			if ($arr['lastname'] != '' && $arr['firstname'] != ''){
				  $sql = "SELECT u.userName as friendUserName, u.userFirstName as friendFirstName, u.userLastName as friendLastName
				          FROM friendlist fl, user u
				 		  WHERE fl.friendDeleted = 0
				 		  and fl.userId = ?
				  		  and fl.friendId = u.userID
				  		  and u.userFirstName = ?
						  and u.userLastName = ?";	
				  			
				  $query = $this->db->query($sql,array($uid,$arr['firstname'],$arr['lastname']));
				
				  if ($query->num_rows()>0) { //the friend has been added already
					$data = 'exist';
				  }else{
					 $sql =  "SELECT *
				     		  FROM user
		  					  WHERE Lower(userFirstName) = Lower(?) 
							  and Lower(userLastName) = Lower(?)";	
				  			
					 $query = $this->db->query($sql,array($arr['firstname'],$arr['lastname']));
					 if ($query->num_rows()>0){
					   $i = 0;
					   foreach($query->result_array() as $row){
					
						 $data[$i]['userId'] = $row['userID'];
						 $data[$i]['userFirstName'] = $row['userFirstName'];
						 $data[$i]['userLastName'] = $row['userLastName'];		 		
						 $data[$i]['error'] = '';
						 $i++;
					   }
					 }else{
						 $data[0]['error'] = 'user doesn\'t exist.';
					 }
					  
					  
				  }
				
			}
			
		}
		
		return $data;	
		
	}
	
	
	function search_friend($arr){
		$uid = $this->session->userdata('suis_user_id');
		//$uid = 2;
									 
		$sql = "(SELECT u.*,'added' as status
				 FROM user u, friendlist fl
				 WHERE (u.userName like '%".$arr['fname']."%'
				    or u.userFirstName like '%".$arr['firstname']."%'
				    or u.userLastName like '%".$arr['lastname']."%')
				 and u.userID != ?
				 and fl.userId = ?
				 and fl.friendId = u.userID 
				 and fl.friendDeleted = 0)

				 union(
				 SELECT u.*,'not added' as status
				 FROM user u
				 WHERE (u.userName like '%".$arr['fname']."%'
				    or u.userFirstName like '%".$arr['firstname']."%'
				    or u.userLastName like '%".$arr['lastname']."%')
				 and u.userID not in (select friendId
					                  from friendlist
									where userId = ? and friendDeleted = 0)
				 and u.userID != ?)";
		  			
		 $query = $this->db->query($sql,array($uid,$uid,$uid,$uid));
		 
		 if ($query->num_rows()>0){
		   $i = 0;
		   foreach($query->result_array() as $row){
		
			 $data[$i]['userId'] = $row['userID'];			 
			 $data[$i]['userName'] = $row['userName'];			 
			 $data[$i]['userFirstName'] = $row['userFirstName'];
			 $data[$i]['userLastName'] = $row['userLastName'];
			 $data[$i]['userImage'] = $row['userProfileImage'];	
			 $data[$i]['friendStatus'] = $row['status']; 		
			 $i++;
		   }
		 }else{
			 $data='no user';
		 }
			
		return $data;	
		
	}

}
?>
