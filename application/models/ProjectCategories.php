<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProjectCategories extends CI_Model
{
    private static $db;

	function __construct()
	{
		parent::__construct();
		self::$db = &get_instance()->db;
	}

	static function by_id($id)
	{
		return self::$db->where('id',$id)->get('project_categories')->row();
	}

	static function get_all()
	{
		return self::$db->get('project_categories')->result();
	}
	
	public static function update($id, $data)
    {
        return self::$db->where('id', $id)->update('project_categories', $data);
	}

    public static function save($data)
    {
        return self::$db->insert('project_categories', $data);
	}
	
	public static function delete($id)
	{
		return self::$db->where('id', $id)->delete('project_categories');
	}
}

/* End of file model.php */