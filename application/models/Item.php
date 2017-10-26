<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Freelancer Office
 * 
 * Web based project and invoicing management system available on codecanyon
 *
 * @package     Freelancer Office
 * @author      William Mandai
 * @copyright   Copyright (c) 2014 - 2016 Gitbench,
 * @license     http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
 * @link        http://codecanyon.net/item/freelancer-office/8870728
 * @link     	https://gitbench.com
 */

class Item extends CI_Model
{

	private static $db;

	function __construct(){
		parent::__construct();
		self::$db = &get_instance()->db;
	}

	static function list_items()
	{
		return self::$db->where('deleted','No')->order_by('item_id','desc')->get('items_saved')->result();
	}

	static function list_tasks()
	{
		return self::$db->order_by('added','desc')->get('saved_tasks')->result();
	}
	
	static function view_item($id)
	{
		return self::$db->where('item_id',$id)->get('items_saved')->row();
	}
	static function view_task($id)
	{
		return self::$db->where('template_id',$id)->get('saved_tasks')->row();
	}
	
	

}

/* End of file model.php */