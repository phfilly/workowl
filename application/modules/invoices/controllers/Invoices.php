<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Freelancer Office.
 *
 * Web based project and invoicing management system available on codecanyon
 *
 * @author      William Mandai
 * @copyright   Copyright (c) 2014 - 2016 Gitbench,
 * @license     http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 *
 * @link        http://codecanyon.net/item/freelancer-office/8870728
 * @link     	https://gitbench.com
 */
class Invoices extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        User::logged_in();

        $this->load->module('layouts');
        $this->load->library(array('template', 'form_validation'));
        $this->template->title(lang('invoices').' - '.config_item('company_name'));

        if (isset($_GET['login'])) {
            $this->tank_auth->remote_login($_GET['login']);
        }

        $this->load->model(array('Invoice', 'App', 'Client', 'Expense'));

        App::module_access('menu_invoices');

        $this->filter_by = $this->_filter_by();

        $this->applib->set_locale();
    }

    public function index()
    {
        $this->template->title(lang('invoices').' - '.config_item('company_name'));
        $data['page'] = lang('invoices');
        $data['datatables'] = true;
        $data['invoices'] = $this->_show_invoices();
        $this->template
    ->set_layout('users')
    ->build('invoices', isset($data) ? $data : null);
    }

    public function view($invoice_id = null)
    {
        if (!User::can_view_invoice(User::get_id(), $invoice_id)) {
            App::access_denied('invoices');
        }

        $this->template->title(lang('invoices').' - '.config_item('company_name'));
        $data['page'] = lang('invoices');
        $data['stripe'] = true;
        $data['twocheckout'] = true;
        $data['sortable'] = true;
        $data['typeahead'] = true;
        $data['invoices'] = $this->_show_invoices(); // GET a list of the Invoices
    $data['id'] = $invoice_id;
        Invoice::evaluate_invoice($invoice_id);

        $this->template
    ->set_layout('users')
    ->build('view', isset($data) ? $data : null);
    }

    public function autoitems()
    {
        $query = 'SELECT * FROM (
		SELECT item_name FROM fx_items
		UNION ALL
		SELECT item_name FROM fx_estimate_items
		UNION ALL
		SELECT item_name FROM fx_items_saved
	) a
	GROUP BY item_name
	ORDER BY item_name ASC';
        $names = $this->db->query($query)->result();
        $name = array();
        foreach ($names as $n) {
            $name[] = $n->item_name;
        }
        $data['json'] = $name;
        $this->load->view('json', isset($data) ? $data : null);
    }

    public function autoitem()
    {
        $name = $_POST['name'];
        $query = "SELECT * FROM (
		SELECT item_name, item_desc, quantity, unit_cost FROM fx_items
		UNION ALL
		SELECT item_name, item_desc, quantity, unit_cost FROM fx_estimate_items
		UNION ALL
		SELECT item_name, item_desc, quantity, unit_cost FROM fx_items_saved
	) a
	WHERE a.item_name = '".$name."'";
        $names = $this->db->query($query)->result();
    //$items = $this->db->where('item_name',$name)->get(($scope == 'invoices' ? 'items':'estimate_items'))->result();
    $name = $names[0];
        $data['json'] = $name;
        $this->load->view('json', isset($data) ? $data : null);
    }

    public function add()
    {
        if (!User::can_add_invoice()) {
            App::access_denied('invoices');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('reference_no', 'Ref No', 'required|is_unique[invoices.reference_no]');
            $this->form_validation->set_rules('client', 'Client', 'required');
            if ($this->form_validation->run() == false) {
                $_POST = '';
                redirect('invoices/add');
            } else {
                if (config_item('increment_invoice_number') == 'TRUE') {
                    $_POST['reference_no'] = config_item('invoice_prefix').Invoice::generate_invoice_number();
                }

                $_POST['allow_paypal'] = ($this->input->post('allow_paypal') == 'on') ? 'Yes' : 'No';
                $_POST['allow_2checkout'] = ($this->input->post('allow_2checkout') == 'on') ? 'Yes' : 'No';
                $_POST['allow_stripe'] = ($this->input->post('allow_stripe') == 'on') ? 'Yes' : 'No';
                $_POST['allow_bitcoin'] = ($this->input->post('allow_bitcoin') == 'on') ? 'Yes' : 'No';
                $_POST['allow_braintree'] = ($this->input->post('allow_braintree') == 'on') ? 'Yes' : 'No';

            // Inherit currency
            if ($_POST['currency'] == '') {
                $currency = Client::client_currency($_POST['client']);
                $_POST['currency'] = $currency->code;
            }

                $_POST['due_date'] = Applib::date_formatter($_POST['due_date']);
                unset($_POST['files']);

                if ($invoice_id = App::save_data('invoices', $this->input->post())) {
                    // Log Activity
                $activity = array(
                    'user' => User::get_id(),
                    'module' => 'invoices',
                    'module_field_id' => $invoice_id,
                    'activity' => 'activity_invoice_created',
                    'icon' => 'fa-plus',
                    'value1' => $_POST['reference_no'],
                );
                    App::Log($activity); // Log activity
                Applib::go_to('invoices/view/'.$invoice_id, 'success', lang('invoice_created_successfully'));
                }
            }
        } else {
            $data['page'] = lang('invoices');
            $data['editor'] = true;
            $data['datepicker'] = true;
            $data['form'] = true;
            $data['braintree_setup'] = true;
            $data['invoices'] = $this->_show_invoices(); // GET a list of the Invoices

        $this->template
        ->set_layout('users')
        ->build('create_invoice', isset($data) ? $data : null);
        }
    }

    public function edit($invoice_id = null)
    {
        if (User::is_admin() || User::perm_allowed(User::get_id(), 'edit_all_invoices')) {
            if ($this->input->post()) {
                $invoice_id = $this->input->post('inv_id', true);

                $this->form_validation->set_rules('client', 'Client', 'required');
                if ($this->form_validation->run() == false) {
                    $_POST = '';
                    Applib::go_to('invoices/edit/'.$invoice_id, 'error', lang('error_in_form'));
                } else {
                    $_POST['allow_2checkout'] = ($this->input->post('allow_2checkout') == 'on') ? 'Yes' : 'No';
                    $_POST['allow_paypal'] = ($this->input->post('allow_paypal') == 'on') ? 'Yes' : 'No';
                    $_POST['allow_stripe'] = ($this->input->post('allow_stripe') == 'on') ? 'Yes' : 'No';
                    $_POST['allow_bitcoin'] = ($this->input->post('allow_bitcoin') == 'on') ? 'Yes' : 'No';
                    $_POST['allow_braintree'] = ($this->input->post('allow_braintree') == 'on') ? 'Yes' : 'No';
                    $_POST['due_date'] = Applib::date_formatter($_POST['due_date']);
            // $date = new DateTime($_POST['date_saved']);
            $_POST['date_saved'] = Applib::date_formatter($_POST['date_saved']).' 00:00:00';

                    unset($_POST['files']);

                    if (Invoice::update($invoice_id, $this->input->post())) {
                        if ($this->input->post('r_freq') != 'none') {
                            Invoice::recur($invoice_id, $this->input->post());
                        }
                // Log Activity
                $activity = array(
                    'user' => User::get_id(),
                    'module' => 'invoices',
                    'module_field_id' => $invoice_id,
                    'activity' => 'activity_invoice_edited',
                    'icon' => 'fa-pencil',
                    'value1' => $_POST['reference_no'],
                );
                        App::Log($activity); // Log activity

                Applib::go_to('invoices/view/'.$invoice_id, 'success', lang('invoice_edited_successfully'));
                    }
                }
            } else {
                $data['page'] = lang('invoices');
                $data['datepicker'] = true;
                $data['form'] = true;
                $data['editor'] = true;
                $data['braintree_setup'] = true;
                $data['clients'] = Client::get_all_clients();
                $data['invoices'] = $this->_show_invoices();
                $data['currencies'] = App::currencies();
                $data['id'] = $invoice_id;
                $this->template
                ->set_layout('users')
                ->build('edit_invoice', isset($data) ? $data : null);
            }
        } else {
            App::access_denied('invoices');
        }
    }

    public function _show_invoices()
    {
        if (User::is_admin() || User::perm_allowed(User::get_id(), 'view_all_invoices')) {
            return $this->all_invoices($this->filter_by);
        } else {
            return $this->client_invoices(User::profile_info(User::get_id())->company, $this->filter_by);
        }
    }

    public function all_invoices($filter_by = null)
    {
        switch ($filter_by) {
            case 'paid':
            return Invoice::paid_invoices();
            break;

            case 'unpaid':
            return Invoice::unpaid_invoices();
            break;

            case 'partially_paid':
            return Invoice::partially_paid_invoices();
            break;

            case 'recurring':
            return Invoice::recurring_invoices();
            break;

            default:
            return Invoice::get_invoices();
            break;
        }
    }

    public function client_invoices($company, $filter_by)
    {
        switch ($filter_by) {

            case 'paid':
                return Invoice::paid_invoices($company);
                break;

            case 'unpaid':
                return Invoice::unpaid_invoices($company);
            break;

            case 'partially_paid':
                return Invoice::partially_paid_invoices($company);
            break;

            case 'recurring':
                return Invoice::recurring_invoices($company);
            break;

            default:
                return Invoice::get_client_invoices($company);
            break;
        }
    }

    public function pay($invoice = null)
    {
        if (!User::can_pay_invoice()) {
            App::access_denied('invoices');
        }
        $this->load->model('Payment');
        if ($this->input->post()) {
            $invoice_id = $this->input->post('invoice');

            $paid_amount = Applib::format_deci($this->input->post('amount'));

            $this->form_validation->set_rules('amount', 'Amount', 'required');

            if ($this->form_validation->run() == false) {
                Applib::go_to('invoices/view/'.$invoice_id, 'error', lang('payment_failed'));
            } else {
                $due = Invoice::get_invoice_due_amount($invoice_id);

                if ($paid_amount > $due) {
                    Applib::go_to('invoices/view/'.$invoice_id, 'error', lang('overpaid_amount'));
                }

                if ($this->input->post('attach_slip') == 'on') {
                    if (file_exists($_FILES['payment_slip']['tmp_name']) || is_uploaded_file($_FILES['payment_slip']['tmp_name'])) {
                        $upload_response = $this->upload_slip($this->input->post());
                        if ($upload_response) {
                            $attached_file = $upload_response;
                        } else {
                            $attached_file = null;
                            Applib::go_to('invoices/view/'.$invoice_id, 'error', lang('file_upload_failed'));
                        }
                    }
                }

                $data = array(
                'invoice' => $invoice_id,
                'paid_by' => Invoice::view_by_id($invoice_id)->client,
                'payment_method' => $this->input->post('payment_method'),
                'currency' => $this->input->post('currency'),
                'amount' => $paid_amount,
                'payment_date' => Applib::date_formatter($this->input->post('payment_date')),
                'trans_id' => $this->input->post('trans_id'),
                'notes' => $this->input->post('notes'),
                'month_paid' => date('m'),
                'year_paid' => date('Y'),
            );

                $payment_id = Payment::save_pay($data);

                if (isset($attached_file)) {
                    $data = array('attached_file' => $attached_file);
                    Payment::update_pay($payment_id, $data);
                }

                if (Invoice::payment_status($invoice_id) == 'fully_paid') {
                    Invoice::update($invoice_id, array('status' => 'Paid'));
                }
            // Log Activity
            $cur = Invoice::view_by_id($invoice_id)->currency;
                $cur_i = App::currencies($cur);

                $data = array(
                'user' => User::get_id(),
                'module' => 'invoices',
                'module_field_id' => $invoice_id,
                'activity' => 'activity_payment_of',
                'icon' => 'fa-usd',
                'value1' => $cur_i->symbol.''.$paid_amount,
                'value2' => Invoice::view_by_id($invoice_id)->reference_no,
            );
                App::Log($data); // Log activity

            if ($this->input->post('send_thank_you') == 'on') {
                $this->_send_payment_email($invoice_id, $paid_amount);
            } //send thank you email

            if (config_item('notify_payment_received') == 'TRUE') {
                $this->_notify_admin($invoice_id, $paid_amount, $cur);
            }

                Applib::go_to('invoices/view/'.$invoice_id, 'success', lang('payment_added_successfully'));
            }
        } else {
            $data['page'] = lang('invoices');
            $data['id'] = $invoice;
            $data['datepicker'] = true;
            $data['attach_slip'] = true;
            $data['invoices'] = $this->_show_invoices();

            $this->template
        ->set_layout('users')
        ->build('pay_invoice', isset($data) ? $data : null);
        }
    }

    public function _notify_admin($invoice, $amount, $cur)
    {
        $client = Client::view_by_id(Invoice::view_by_id($invoice)->client)->company_name;
        $admins = User::admin_list();

        foreach ($admins as $key => $user) {
            $data = array(
                                'email' => $user->email,
                                'invoice_ref' => Invoice::view_by_id($invoice)->reference_no,
                                'amount' => Applib::format_quantity($amount),
                                'currency' => $cur,
                                'invoice_id' => $invoice,
                                'client' => $client,
                            );

            $email_msg = $this->load->view('new_payment', $data, true);

            $params = array(
                                'subject' => '['.config_item('company_name').'] Payment Confirmation',
                                'recipient' => $user->email,
                                'message' => $email_msg,
                                'attached_file' => '',
                                );

            modules::run('fomailer/send_email', $params);
        }
    }

    public function add_expenses($client = null)
    {
        $this->load->model('Project');
        if ($this->input->post()) {
            $invoice = $this->input->post('invoice');
            foreach ($_POST['expense'] as $key => $ar) {
                $expense = Expense::view_by_id($key);
                $cat = App::get_category_by_id($expense->category);

                $title = 'N/A';
                if ($expense->project > 0) {
                    $title = Project::by_id($expense->project)->project_title;
                }

                $data = array(
                'item_name' => lang('expenses').' [ '.$expense->expense_date.' ]',
                'item_desc' => '['.$title.']'.PHP_EOL.'&raquo; '.$cat.PHP_EOL.'&raquo; '.$expense->notes,
                'unit_cost' => $expense->amount,
                'invoice_id' => $invoice,
                'total_cost' => $expense->amount,
                'quantity' => '1.00',

            );
                Invoice::save_items($data);
                $data = array('invoiced' => '1', 'invoiced_id' => $invoice);
                Expense::update($expense->id, $data);
            }

            Applib::go_to('invoices/view/'.$invoice, 'success', lang('item_added_successfully'));
        } else {
            $data['client'] = $client;
            $data['invoice'] = $this->uri->segment(4);
            $data['expenses'] = Expense::billable_by_client($client);
            $this->load->view('modal/add_expenses', $data);
        }
    }

    public function show($invoice_id = null)
    {
        $data = array('show_client' => 'Yes');
        Invoice::update($invoice_id, $data);
        Applib::go_to($_SERVER['HTTP_REFERER'], 'success', lang('invoice_visible'));
    }
    public function hide($invoice_id = null)
    {
        $data = array('show_client' => 'No');
        Invoice::update($invoice_id, $data);
        Applib::go_to($_SERVER['HTTP_REFERER'], 'success', lang('invoice_not_visible'));
    }

    public function mark_as_paid($invoice = null)
    {
        if ($this->input->post()) {
            $invoice_id = $this->input->post('invoice');
            $this->load->helper('string');
            $info = Invoice::view_by_id($invoice_id);

            $due = Invoice::get_invoice_due_amount($invoice_id);

            $transaction = array(
            'invoice' => $invoice_id,
            'paid_by' => $info->client,
            'payment_method' => '1',
            'currency' => $info->currency,
            'amount' => Applib::format_deci($due),
            'payment_date' => date('Y-m-d'),
            'trans_id' => random_string('nozero', 6),
            'month_paid' => date('m'),
            'year_paid' => date('Y'),
        );

            App::save_data('payments', $transaction);

            $data = array('status' => 'Paid');
            App::update('invoices', array('inv_id' => $invoice_id), $data);

            $inv_cur = $info->currency;
            $cur_i = App::currencies($inv_cur);

        // Log activity
            $data = array(
                'module' => 'invoices',
                'module_field_id' => $invoice_id,
                'user' => User::get_id(),
                'activity' => 'activity_payment_of',
                'icon' => 'fa-usd',
                'value1' => $cur_i->symbol.' '.$due,
                'value2' => $info->reference_no,
                );
            App::Log($data);

            Applib::go_to('invoices/view/'.$invoice_id, 'success', lang('payment_added_successfully'));
        } else {
            $data = array('invoice' => $invoice);
            $this->load->view('modal/mark_as_paid', $data);
        }
    }

    public function stop_recur($invoice_id = null)
    {
        if (User::is_client()) {
            Applib::go_to('invoices', 'error', lang('access_denied'));
        }

        if ($this->input->post()) {
            $invoice = $this->input->post('invoice', true);
            $this->load->model('invoices/invoices_recurring');

            if ($this->invoices_recurring->stop($invoice)) {
                // Log activity
            $data = array(
                'module' => 'invoices',
                'module_field_id' => $invoice,
                'user' => User::get_id(),
                'activity' => 'activity_recurring_stopped',
                'icon' => 'fa-plus',
                'value1' => Invoice::view_by_id($invoice)->reference_no,
                'value2' => '',
                );
                App::Log($data);
                Applib::go_to('invoices/view/'.$invoice, 'success', lang('recurring_invoice_stopped'));
            }
        } else {
            $data['invoice'] = $invoice_id;
            $this->load->view('modal/stop_recur', $data);
        }
    }

    public function timeline($invoice_id = null)
    {
        $this->template->title(lang('invoices'));
        $data['page'] = lang('invoices');

        $data['activities'] = Invoice::activities($invoice_id);
        $data['invoices'] = $this->_show_invoices();
        $data['id'] = $invoice_id;
        $this->template
    ->set_layout('users')
    ->build('timeline', isset($data) ? $data : null);
    }

    public function transactions($invoice_id = null)
    {
        $this->load->model('Payment');
        $this->template->title(lang('payments'));
        $data['page'] = lang('invoices');

        $data['invoices'] = $this->_show_invoices();
        $data['datatables'] = true;
        $data['payments'] = Payment::by_invoice($invoice_id);
        $data['id'] = $invoice_id;
        $this->template
    ->set_layout('users')
    ->build('invoice_payments', isset($data) ? $data : null);
    }

    public function delete($invoice_id = null)
    {
        if ($this->input->post()) {
            $invoice = $this->input->post('invoice', true);
            Invoice::delete($invoice);

            Applib::go_to('invoices', 'success', lang('invoice_deleted_successfully'));
        } else {
            $data['invoice'] = $invoice_id;
            $this->load->view('modal/delete_invoice', $data);
        }
    }

    public function remind($invoice = null)
    {
        if ($this->input->post()) {
            $invoice = $this->input->post('invoice_id');
            $message = $this->input->post('message');

            $cur = Invoice::view_by_id($invoice)->currency;
            $reference = Invoice::view_by_id($invoice)->reference_no;

            $subject = $this->input->post('subject');
            $signature = App::email_template('email_signature', 'template_body');

            $logo_link = create_email_logo();

            $logo = str_replace('{INVOICE_LOGO}', $logo_link, $message);
            $ref = str_replace('{REF}', $reference, $logo);

            $client = str_replace('{CLIENT}', $this->input->post('client_name'), $ref);
            $amount = str_replace('{AMOUNT}', $this->input->post('amount'), $client);
            $currency = str_replace('{CURRENCY}', App::currencies($cur)->symbol, $amount);
            $link = str_replace('{INVOICE_LINK}', base_url().'invoices/view/'.$invoice, $currency);
            $signature = str_replace('{SIGNATURE}', $signature, $link);
            $message = str_replace('{SITE_NAME}', config_item('company_name'), $signature);

            $this->_email_invoice($invoice, $message, $subject, $cc = 'off');

        // Log Activity
        $activity = array(
            'user' => User::get_id(),
            'module' => 'invoices',
            'module_field_id' => $invoice,
            'activity' => 'activity_invoice_reminder_sent',
            'icon' => 'fa-shopping-cart',
            'value1' => $reference,
        );
            App::Log($activity); // Log activity

        Applib::go_to('invoices/view/'.$invoice, 'success', lang('reminder_sent_successfully'));
        } else {
            $data['id'] = $invoice;
            $this->load->view('modal/invoice_reminder', $data);
        }
    }

    public function send_invoice($invoice_id = null)
    {
        if ($this->input->post()) {
            $id = $this->input->post('invoice');
            $invoice = Invoice::view_by_id($id);

            $client = Client::view_by_id($invoice->client);
            $due = Invoice::get_invoice_due_amount($id);
            $cur = App::currencies($invoice->currency);

            if ($client->primary_contact > 0) {
                $login = '?login='.$this->tank_auth->create_remote_login($client->primary_contact);
            } else {
                $login = '';
            }

            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $signature = App::email_template('email_signature', 'template_body');

            $logo_link = create_email_logo();

            $logo = str_replace('{INVOICE_LOGO}', $logo_link, $message);

            $client_name = str_replace('{CLIENT}', $client->company_name, $logo);
            $ref = str_replace('{REF}', $invoice->reference_no, $client_name);
            $amount = str_replace('{AMOUNT}', Applib::format_quantity($due), $ref);
            $currency = str_replace('{CURRENCY}', $cur->symbol, $amount);
            $link = str_replace('{INVOICE_LINK}', base_url().'invoices/view/'.$id.$login, $currency);
            $signature = str_replace('{SIGNATURE}', $signature, $link);
            $message = str_replace('{SITE_NAME}', config_item('company_name'), $signature);

            $this->_email_invoice($id, $message, $subject, $this->input->post('cc_self')); // Email Invoice

        $data = array('emailed' => 'Yes', 'date_sent' => date('Y-m-d H:i:s', time()));
            Invoice::update($id, $data);

        // Log Activity
        $activity = array(
            'user' => User::get_id(),
            'module' => 'invoices',
            'module_field_id' => $id,
            'activity' => 'activity_invoice_sent',
            'icon' => 'fa-envelope',
            'value1' => $invoice->reference_no,
        );
            App::Log($activity);

            Applib::go_to('invoices/view/'.$id, 'success', lang('invoice_sent_successfully'));
        } else {
            $data['id'] = $invoice_id;
            $this->load->view('modal/email_invoice', $data);
        }
    }

    public function chart()
    {
        $data['chart'] = true; // Load chart JS
    $this->load->view('invoices/invoice_chart', isset($data) ? $data : null);
    }

    public function pdf($invoice_id = null)
    {
        if (!User::can_view_invoice(User::get_id(), $invoice_id)) {
            App::access_denied('invoices');
        }

        $data['page'] = lang('invoices');
        $data['stripe'] = true;
        $data['twocheckout'] = true;
        $data['sortable'] = true;
        $data['typeahead'] = true;
        $data['rates'] = Invoice::get_tax_rates();
        $data['id'] = $invoice_id;

        $html = $this->load->view('invoice_pdf', $data, true);

        $pdf = array(
        'html' => $html,
        'title' => lang('invoice').' '.Invoice::view_by_id($invoice_id)->reference_no,
        'author' => config_item('company_name'),
        'creator' => config_item('company_name'),
        'filename' => lang('invoice').' '.Invoice::view_by_id($invoice_id)->reference_no.'.pdf',
        'badge' => config_item('display_invoice_badge'),
    );

        $this->applib->create_pdf($pdf);
    }

    public function attach_pdf($invoice_id)
    {
        if (!User::can_view_invoice(User::get_id(), $invoice_id)) {
            App::access_denied('invoices');
        }

        $data['page'] = lang('invoices');
        $data['stripe'] = true;
        $data['twocheckout'] = true;
        $data['sortable'] = true;
        $data['typeahead'] = true;
        $data['rates'] = Invoice::get_tax_rates();
        $data['id'] = $invoice_id;

        $html = $this->load->view('invoice_pdf', $data, true);

        $pdf = array(
        'html' => $html,
        'title' => lang('invoice').' '.Invoice::view_by_id($invoice_id)->reference_no,
        'author' => config_item('company_name'),
        'creator' => config_item('company_name'),
        'attach' => true,
        'filename' => lang('invoice').' '.Invoice::view_by_id($invoice_id)->reference_no.'.pdf',
        'badge' => config_item('display_invoice_badge'),
    );

        $invoice = $this->applib->create_pdf($pdf);

        return $invoice;
    }

    public function _send_payment_email($invoice_id, $paid_amount)
    {
        $message = App::email_template('payment_email', 'template_body');
        $subject = App::email_template('payment_email', 'subject');
        $signature = App::email_template('email_signature', 'template_body');

        $info = Invoice::view_by_id($invoice_id);

        $logo_link = create_email_logo();

        $logo = str_replace('{INVOICE_LOGO}', $logo_link, $message);
        $ref = str_replace('{REF}', $info->reference_no, $logo);
        $invoice_currency = str_replace('{INVOICE_CURRENCY}', App::currencies($info->currency)->symbol, $ref);
        $amount = str_replace('{PAID_AMOUNT}', Applib::format_quantity($paid_amount), $invoice_currency);
        $EmailSignature = str_replace('{SIGNATURE}', $signature, $amount);
        $message = str_replace('{SITE_NAME}', config_item('company_name'), $EmailSignature);

        $data['message'] = $message;
        $message = $this->load->view('email_template', $data, true);
        $params['recipient'] = Client::view_by_id($info->client)->company_email;
        $params['subject'] = '['.config_item('company_name').']'.' '.$subject;
        $params['message'] = $message;
        $params['attached_file'] = '';
        $params['alt_email'] = 'billing';

        modules::run('fomailer/send_email', $params);
    }

    public function _email_invoice($invoice_id, $message, $subject, $cc)
    {
        $data['message'] = $message;
        $invoice = Invoice::view_by_id($invoice_id);

        $message = $this->load->view('email_template', $data, true);

        $params = array(
        'recipient' => Client::view_by_id($invoice->client)->company_email,
        'subject' => $subject,
        'message' => $message,
    );

        $this->load->helper('file');
        $attach['inv_id'] = $invoice_id;
        if (config_item('pdf_engine') == 'invoicr') {
            $invoicehtml = modules::run('fopdf/attach_invoice', $attach);
        }
        if (config_item('pdf_engine') == 'mpdf') {
            $invoicehtml = $this->attach_pdf($invoice_id);
        }

        $params['attached_file'] = './resource/tmp/'.lang('invoice').' '.$invoice->reference_no.'.pdf';
        $params['attachment_url'] = base_url().'resource/tmp/'.lang('invoice').' '.$invoice->reference_no.'.pdf';

        if (strtolower($cc) == 'on') {
            $params['cc'] = User::login_info(User::get_id())->email;
        }

        modules::run('fomailer/send_email', $params);
    //Delete invoice in tmp folder
    if (is_file('./resource/tmp/'.lang('invoice').' '.$invoice->reference_no.'.pdf')) {
        unlink('./resource/tmp/'.lang('invoice').' '.$invoice->reference_no.'.pdf');
    }
    }

    public function _get_clients()
    {
        $sort = array('order_by' => 'date_added', 'order' => 'desc');

        return Applib::retrieve(Applib::$companies_table, array('co_id !=' => '0'));
    }

    public function upload_slip($data)
    {
        Applib::is_demo();

        if ($data) {
            $config['upload_path'] = './resource/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|docx|doc';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('payment_slip')) {
                $filedata = $this->upload->data();

                return $filedata['file_name'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function _filter_by()
    {
        $filter = isset($_GET['view']) ? $_GET['view'] : '';

        switch ($filter) {

        case 'paid':
        return 'paid';
        break;

        case 'unpaid':
        return 'unpaid';
        break;

        case 'partially_paid':
        return 'partially_paid';

        break;
        case 'recurring':
        return 'recurring';
        break;

        default:
        return null;
        break;
    }
    }
}

/* End of file invoices.php */
