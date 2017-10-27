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
 * @link        https://gitbench.com
 */

class User extends CI_Model
{

    private static $db;

    function __construct(){
        parent::__construct();
        self::$db = &get_instance()->db;
    }

    // Get logged in user ID
    static function get_id()
    {
        $ci = &get_instance();
        return $ci->tank_auth->get_user_id();
    }

    // Get logged in user ID
    static function logged_in()
    {
        $ci = &get_instance();
        $logged_in = ($ci->tank_auth->is_logged_in()) ? TRUE : FALSE;
        if(!$logged_in) redirect('login');
        return ;
    }

    // Get user information
    static function view_user($id)
    {
        return self::$db->where('id',$id)->get('users')->row();
    }

    /**
     * Check user if admin
     */
    static function is_admin() {
        $ci = &get_instance();
        return ($ci->tank_auth->user_role($ci->tank_auth->get_role_id()) == 'admin') ? TRUE : FALSE;
    }

    /**
     * Check user if client
     */
    static function is_client() {
        $ci = &get_instance();
        return ($ci->tank_auth->user_role($ci->tank_auth->get_role_id()) == 'client') ? TRUE : FALSE;
    }

    /**
     * Check user if staff
     */
    static function is_staff() {
        $ci = &get_instance();
        return ($ci->tank_auth->user_role($ci->tank_auth->get_role_id()) == 'staff') ? TRUE : FALSE;
    }

    /**
     * Get user login information
     *
     * @return User data array
     */

    static function login_info($id) {
        return self::$db->where('id',$id)->get('users')->row();
    }

    /**
     * Get admins and staff
     */

    static function team() {
        return self::$db->where('role_id !=',2) -> get('users')->result();
    }

    // Get all users
    static function all_users(){
        return self::$db->get('users')->result();
    }

    static function user_status(){
        return self::$db->get('user_status')->result();
    }
    /**
     * Display username or full name if exists
     */
    static function displayName($user = '') {
        if(!self::check_user_exist($user)) return '[MISSING USER]';

        return (self::profile_info($user)->fullname == NULL)
            ? self::login_info($user)->username
            : self::profile_info($user)->fullname;
    }

    // Get access permissions
    static function perm_allowed($user,$perm) {
        $permission = self::$db->where(array('status'=>'active'))->get('permissions')->result();
        $json = self::profile_info($user)->allowed_modules;
        $allowed_modules = ($json == NULL) ? '{"settings":"permissions"}' : $json;
        $allowed_modules = json_decode($allowed_modules,true);
        if(!array_key_exists($perm, $allowed_modules)) return FALSE;

        foreach ($permission as $key => $p) {
            if ( array_key_exists($p->name, $allowed_modules) && $allowed_modules[$perm] == 'on') {
                return TRUE;
            }else{
                return FALSE;
            }
        }
        return FALSE;
    }


    /**
     * Get user role name e.g admin,staff etc
     */

    static function login_role_name() {
        $ci = &get_instance();
        return $ci->tank_auth->user_role($ci->tank_auth->get_role_id());
    }

    /**
     * Get user role name usind ID e.g admin,staff etc
     */

    static function get_role($user) {
        $ci = &get_instance();
        $id = self::login_info($user)->role_id;
        return $ci->tank_auth->user_role($id);
    }

    // Get all admin list
    static function admin_list(){
        return self::$db->where(array('role_id' => 1,'activated' => 1))->get('users')->result();
    }

    // Get all user list
    static function user_list(){
        return self::$db->where(array('role_id' => 2,'activated' => 1))->get('users')->result();
    }

    // Get staff list
    static function staff_list(){
        return self::$db->where(array('role_id' => 3,'activated' => 1))->get('users')->result();
    }

    // Get roles
    static function get_roles(){
        return self::$db->get('roles')->result();
    }

    /**
     * Get user profile information
     */

    static function profile_info($id) {
        return self::$db->where('user_id',$id) -> get('account_details')->row();
    }


    static function user_log($user)
    {
        return self::$db->where('user',$user)->order_by('activity_date','DESC')->get('activities')->result();
    }

    // Get user avatar URL
    static function avatar_url($user = NULL) {
        if(!self::check_user_exist($user)) return base_url().'resource/avatar/default_avatar.jpg';

        if (config_item('use_gravatar') == 'TRUE' && self::profile_info($user)->use_gravatar == 'Y') {
            $user_email = self::login_info($user)->email;
            return Applib::get_gravatar($user_email);
        } else {
            return base_url().'resource/avatar/'.self::profile_info($user)->avatar;
        }
    }

    static function check_user_exist($user){
        return self::$db->where('id',$user)->get('users')->num_rows();
    }

    // User can view invoice
    static function can_view_invoice($user, $invoice){
        $role = self::login_role_name();
        if ($role == 'admin') return TRUE;
        if($role == 'staff' && self::perm_allowed($user,'view_all_invoices')) return TRUE;
        if(self::check_user_exist($user) > 0){
            $client = Invoice::view_by_id($invoice)->client;
            $show_client =  Invoice::view_by_id($invoice)->show_client;
            return ($client == self::profile_info($user)->company && $show_client == 'Yes') ? TRUE : FALSE;
        }else{
            return FALSE;
        }
    }

    // Can pay Invoice
    static function can_pay_invoice(){
        if (self::login_role_name() == 'admin') return TRUE;
        elseif(self::login_role_name() == 'staff' && self::perm_allowed(self::get_id(),'pay_invoice_offline')){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // User can add estimate
    static function can_add_estimate(){
        if (self::is_admin() || self::perm_allowed(User::get_id(),'add_estimates')) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    static function can_view_estimate($user,$id){
        if (self::is_admin()) { return TRUE; }

        if(self::is_staff() && self::perm_allowed($user,'add_estimates')){
            return TRUE;
        }

        if(self::get_id()){
            $client = Estimate::view_estimate($id)->client;
            $show_client = Estimate::view_estimate($id)->show_client;
            if ($client == self::profile_info($user)->company && $show_client == 'Yes') {
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    static function can_edit_estimate(){
        return (self::is_admin() || self::perm_allowed(self::get_id(),'edit_estimates')) ? TRUE : FALSE;
    }

    // User can add invoice
    static function can_add_invoice(){
        if (self::login_role_name() == 'admin') return TRUE;
        elseif(self::login_role_name() == 'staff' && self::perm_allowed(self::get_id(),'add_invoices')){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    static function can_add_project(){
        if (self::is_admin() || self::perm_allowed(self::get_id(),'add_projects')) return TRUE;

        elseif (self::login_role_name() == 'client' && config_item('client_create_project') == 'TRUE') {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    static function can_edit_project($company,$project){
        return (self::is_admin() || self::perm_allowed(self::get_id(),'edit_all_projects')
            || $company == self::profile_info(self::get_id())->company) ? TRUE : FALSE;
    }

    // Check ticket permission
    static function can_view_ticket($user, $ticket){
        $info = Ticket::view_by_id($ticket);
        $user_dept = self::profile_info(self::get_id())->department;
        $dep = json_decode($user_dept,TRUE);

        if (is_array($dep) && in_array($info->department, $dep) || (self::is_staff()
                && $user_dept == $info->department || $info->reporter == $user)) {
            return TRUE;
        }

        if (self::is_admin() || $info->reporter == self::get_id()) {
            return TRUE;
        }else{
            return FALSE;
        }
    }







}

/* End of file model.php */
