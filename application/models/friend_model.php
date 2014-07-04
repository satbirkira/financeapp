<?php
class Friend_Model extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function add_friend($arr)
    {
		$result = $this->db->insert('friendlist',$arr);
		return $result;
    }	
	
	function get_all_friends($uid)
	{
		$data = "";
		$sql = "SELECT fl.userId as userId, fl.friendId as friendId, u2.userName as friendName
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
	
	

}
?>
