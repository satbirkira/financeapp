<?php
class Deposit_Model extends CI_Model {
	
	var $goalID = "";
	var $eventDate = "";
	var $amountChanged = "";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function add_deposit($arrHis)
    {
		$result = $this->db->insert('history',$arrHis);
		return $result;
    }
		
	function get_deposit_history($gid)
	{
		$data = "";
		$sql = "SELECT *
				FROM history
				WHERE goalID = ?
				ORDER BY eventDate asc ";
									
		$query = $this->db->query($sql,$gid);
		
		$i = 0;
		foreach($query->result_array() as $row){
			
			 $data[$i]['historyId'] = $row['historyID'];
     	     $data[$i]['goalId'] = $row['goalID'];
			 $data[$i]['depositDate'] = $row['eventDate'];
			 $data[$i]['amount'] = $row['amountChanged'];
			 
			 $i++;
		}
		
		
		return $data;	
	}

}
?>
