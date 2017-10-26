<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugin extends CI_Model {

    private $hook_defaults = array(
            "module" => "gitbench_module",
            "parent" => "",
            "hook" => "default_hook",
            "icon" => "",
            "name" => "gitbench_module",
            "route" => "module",
            "order" => "",
            "access" => "1",
            "core" => "0",
            "enabled" => "1"
        );
    public $plugin_defaults = array(
            "id" => "com.gitbench.plugin",
            "route" => "plugin",
            "name" => "plugin",
            "title" => "Plugin",
            "description" => "",
            "version" => "1.0",
            "author" => "Gitbench",
            "plugin_uri" => "",
            "update_uri" => "",
            "image_uri" => "",
            "installed" => "0",
            "has_update" => "0",
            "update_version" => ""
        );

    function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
        if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) != 'admin') {
            $this->session->set_flashdata('response_status', 'error');
            $this->session->set_flashdata('message', lang('access_denied'));
            redirect('logout');
        }
    }
    
    function register_plugin($plugin)
    {
        $plugin = array_merge($this->plugin_defaults, $plugin);
        if (count($this->db->where('id', $plugin['id'])->get('plugins')->result_array()) == 1) {
            return $this->db->where('id',$plugin['id'])->update('plugins', $plugin);
        }
        return $this->db->insert('plugins', $plugin);
    }
    
    function remove_plugin($plugin)
    {
        return $this->db->delete('plugins', array("id" => $plugin["id"]));
    }
    
    function installed($plugin, $value)
    {
        return $this->db->where('id',$plugin["id"])->update('plugins', array('installed' => $value));
    }

    function register_hook($hook)
    {
        $part = explode("_",$hook["hook"]);
        $role = $part[count($part)-1];
        if ($role == 'admin') { $hook["access"] = 1; }
        if ($role == 'client') { $hook["access"] = 2; }
        if ($role == 'staff') { $hook["access"] = 3; }
        
        if (!$hook["order"] > 0) {$hook["order"] = count($this->db->where('hook',$hook["hook"])->where('parent','')->get('hooks')->result_array()) + 1; }
        
        if (count($this->db->where('module', $hook['module'])->where('hook',$hook["hook"])->get('hooks')->result_array()) == 1) {
            return $this->db->where('module',$hook['module'])->where('hook',$hook["hook"])->update('hooks', array_merge($this->hook_defaults, $hook));
        }
        return $this->db->insert('hooks', array_merge($this->hook_defaults, $hook));
    }
    
    function remove_hook($hook)
    {
        return $this->db->delete('hooks', array("module" => $hook["module"], "hook" => $hook["hook"]));
    }
    
    
}

/* End of file install.php */
/* Location: ./system/application/models/plugin.php */