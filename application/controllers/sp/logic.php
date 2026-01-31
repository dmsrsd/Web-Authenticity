<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logic extends SpController {

	function __construct() {
        parent::__construct();
    }
	
	 
	public function upslug($table){
		$data = $this->model_global->get_data(array('select' => '*', 'table' => $table));
		if(isset($data) && count($data) > 0): foreach($data as $row):
			$field = strtolower(trim($row['nama']));
			$slugs = str_replace(" ","-",$field);
			$lat['slug'] = $slugs;
			$this->model_global->update($lat, $table,array('id_'.$table => $row['id_'.$table]));
			
		endforeach; endif; 
	}
	
    public function deletesoft($table,$id){
    	$delete = $this->model_global->delete($table, array('id_'.$table => $id));
        
    	if($delete){ 
			if(isset($_GET['_id'])){
				redirect($this->template['url'].$_GET['part']."?_id=".$_GET['_id']);
			}else{
				if(isset($_GET['k'])){
					redirect($this->template['url'].$_GET['part']."?k=".$_GET['k']);
				}else{
					redirect($this->template['url'].$_GET['part']);
				}
			}
    	}
    	else{
    		redirect(base_url());
    	}
    }
    public function delete($table,$id){
    	//$delete = $this->model_global->delete($table, array('id_'.$table => $id));
		switch($table){
			case "artikel";
				$data = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('id_artikel' => $id)));
				unlink("uploads/article/".$data['image']);
				unlink("uploads/article/".$data['thumbnail']);
				unlink("uploads/article/thumb/".$data['image']);
				unlink("uploads/article/thumb/".$data['thumbnail']);
			break;
			case "kontributor";
				$data = $this->model_global->get_data(array('data' => 'row','table' => 'kontributor', 'where' => array('id_kontributor' => $id)));
				unlink("uploads/contributor/".$data['image']);
			break;
			case "redeempoint";
				$data = $this->model_global->get_data(array('data' => 'row','table' => 'redeempoint', 'where' => array('id_redeempoint' => $id)));
				unlink("uploads/redeem/".$data['image']);
			break;
			case "soundroom";
				$data = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array('id_soundroom' => $id)));
				unlink("uploads/soundroom/".$data['sound']);
				unlink("uploads/soundroom/".$data['image']);
				unlink("uploads/soundroom/".$data['thumbnail']);
			break;
		}

    	$delete = $this->db->delete($table, array('id_'.$table => $id)); 
    	if($delete){
			if(isset($_GET['_id'])){
				redirect($this->template['url'].$_GET['part']."?_id=".$_GET['_id']);
			}else{
				if(isset($_GET['k'])){
					redirect($this->template['url'].$_GET['part']."?k=".$_GET['k']);
				}else{
					redirect($this->template['url'].$_GET['part']);
				}
			}
    	}
    	else{
    		redirect(base_url());
    	}
    }
 
    public function setlatest($id,$part){
		$up['latest'] = "0";
		$this->model_global->update($up, "video", array('latest' => '1'));
		$up['latest'] = "1";
		$this->model_global->update($up, "video", array('id_video' => $id));
		redirect($this->template['url'].$part);		
	}
    public function delete_ajax($table,$id){
		$res["status_ajx"] = "true";
		$res["hasil"] = "-----";
		$gd = $this->model_global->get_data(array('data' => 'row','table' => "".$table,  'where' => array('id_'.$table => $id)));
		switch($gd['status']){
			case "1";
				$up['status']="0";
				$this->model_global->update($up, "".$table, array('id_'.$table => $id));
				$res["hasil"] = "Tidak Aktif";
			break;
			case "0";
				$up['status']="1";
				$this->model_global->update($up, "".$table, array('id_'.$table => $id));
				$res["hasil"] = "Aktif";
			break;
		}
		$res["seta"] = $up['status'];
		
		echo json_encode($res);
    }

    public function validate_slug($table, $column, $slug, $id = 0) {
        if ($id != 0)
            $this->cimongo->where_ne('_id', new MongoId($id));

        $this->cimongo->like($column, $slug);
        
        $this->cimongo->order_by(array($column => 'desc'));
        $this->cimongo->limit(1);
        $res = $this->cimongo->get($table);
        if ($res->num_rows() == 0) {
            return $slug;
        } else {
            $row = $res->row_array();
            $slug = $row[$column];
            preg_match('/^(.+)([0-9]+)$/', $slug, $found);
            if (empty($found)) {
                return $slug.'-1';
            } else {
                return $slug.'-'.((int)$found+1);
            }
        }
    }
	
}