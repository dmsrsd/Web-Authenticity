<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Model_global extends CI_Model { 
	
	public function escape_str($str, $like = FALSE)
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = $this->escape_str($val, $like);
			}

			return $str;
		}

		if (function_exists('mysqli_real_escape_string') AND is_object($this->conn_id))
		{
			$str = mysqli_real_escape_string($this->conn_id, $str);
		}
		else
		{
			$str = addslashes($str);
		}

		// escape LIKE condition wildcards
		if ($like === TRUE)
		{
			$str = str_replace(array('%', '_'), array('\\%', '\\_'), $str);
		}

		return $str;
	}	
	public function get_data($array)
    {
		$this->db->cache_on();
        if (isset($array['table'])) {
            if (isset($array['select']))    $this->db->select($array['select']);
            if (isset($array['join']))      $this->db->join($array['join'][0],$array['join'][1]);
            if (isset($array['join2']))     $this->db->join($array['join2'][0],$array['join2'][1]);
            if (isset($array['join3']))     $this->db->join($array['join3'][0],$array['join3'][1]);
            if (isset($array['join4']))     $this->db->join($array['join4'][0],$array['join4'][1]);
            if (isset($array['where']))     $this->db->where($array['where']);
            if (isset($array['where_in']))  $this->db->where_in($array['where_in'][0], $array['where_in'][1]);
            if (isset($array['where_not_in']))  $this->db->where_not_in($array['where_not_in'][0], $array['where_not_in'][1]);
            if (isset($array['like']))      $this->db->like($array['like']);
            if (isset($array['or_like']))   $this->db->or_like($array['or_like']);
            if (isset($array['not_like']))  $this->db->not_like($array['not_like']);
            if (isset($array['order_by']))  $this->db->order_by($array['order_by']);
            if (isset($array['group_by']))  $this->db->group_by($array['group_by']);
            if (isset($array['limit']))     $this->db->limit($array['limit']);
            if (isset($array['paging'])){
				$ind = explode(",",$array['paging']);
				$this->db->limit($ind[0],$ind[1]);
			}
            $this->db->from($array['table']);
            if (isset($array['data']) && $array['data'] == 'row') 
                return $this->db->get()->row_array();
            else
                return $this->db->get()->result_array();
        } else
            return array();
    }

    public function insert($data, $table){
		$this->db->cache_off();
    	$this->db->insert($table, $data);
        // $this->session->set_userdata('orderId', $this->db->insert_id());

    	if($this->db->insert_id() > 0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    public function insertId($data, $table){
		$this->db->cache_off();
    	$this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        // $this->session->set_userdata('orderId', $this->db->insert_id());

    	if($insert_id > 0){
    		return $insert_id;
    	}
    	else{
    		return false;
    	}
    }

    public function update($data, $table, $where){
		$this->db->cache_off();
		$this->db->where($where);
		$this->db->update($table, $data); 
        if ($this->db->trans_status() === FALSE){
            return false;
        }
        else{
            return true;
        }
    }

    public function delete($table, $where){
		$this->db->cache_off();
        // $this->db->delete($table, $where);
        $data = array('status' => -1);
        $this->db->where($where);
        $this->db->update($table, $data);

        if ($this->db->trans_status() === FALSE){
            return false;
        }
        else{
            return true;
        }
    }

    public function query($query){
		$this->db->cache_on();
        $query = $this->db->query($query);
        if(strpos($query,'insert') !== false){
            return $this->db->affected_rows();
        }
        else if(strpos($query,'update') !== false){
            return $this->db->affected_rows();
        }
        else if(strpos($query,'select') !== false){
            return $query->result_array();
        }
    }

    public function update_counter($table, $slug) { 

        $this->db->where('slug', urldecode($slug)); 
        $this->db->select('views'); 
        $count = $this->db->get('ever_'.$table)->row();

        $this->db->where('slug', urldecode($slug)); 
        $this->db->set('views', ($count->views + 1)); 
        $this->db->update('ever_'.$table); 
    }
 
}
?>
