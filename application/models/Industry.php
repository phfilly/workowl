<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Industry extends CI_Model
{
	private static $db;

	function __construct()
	{
		parent::__construct();
		self::$db = &get_instance()->db;
	}

	static function by_id($id)
	{
		return self::$db->where('id',$id)->get('industries')->row();
	}

	static function all_industries(){
        return self::$db->get('industries')->result();
    }
	
	public static function update($id, $data)
    {
        return self::$db->where('id', $id)->update('industries', $data);
	}

    public static function save($data)
    {
        return self::$db->insert('industries', $data);
	}
	
	public static function delete($id)
	{
		return self::$db->where('id', $id)->delete('industries');
	}
}

/* End of file model.php */