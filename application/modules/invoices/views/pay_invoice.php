<!-- Start -->
<section id="content">
    <section class="hbox stretch">

        <aside class="aside-md bg-white b-r" id="subNav">

            <header class="dk header b-b">
                <?php
                if(User::is_admin() || User::perm_allowed(User::get_id(),'add_invoices')) { ?>
                    <a href="<?=base_url()?>invoices/add" data-original-title="<?=lang('new_invoice')?>" data-toggle="tooltip" data-placement="top" class="btn btn-icon btn-<?=config_item('theme_color');?> btn-sm pull-right"><i class="fa fa-plus"></i></a>
                <?php } ?>

                <p class="h4"><?=lang('all_invoices')?></p>
            </header>

            <section class="vbox">
                <section class="scrollable w-f">
                    <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

                        <?=$this->load->view('sidebar/invoices',$invoices)?>

                    </div></section>
            </section>
        </aside>

        <aside>
            <section class="vbox">

                <?php $inv = Invoice::view_by_id($id); ?>

                <header class="header bg-white b-b clearfix hidden-print">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">

                            <a href="<?=site_url()?>invoices/view/<?=$inv->inv_id?>" class="btn btn-sm btn-dark">
                                <?=lang('view_invoice')?>
                            </a>


                            <?php if (User::is_admin() || User::perm_allowed(User::get_id(),'edit_all_invoices')) { ?>


                                <?php if ($inv->show_client == 'Yes') { ?>
                                    <a class="btn btn-sm btn-success" href="<?=base_url()?>invoices/hide/<?=$inv->inv_id?>" data-title="<?=lang('hide_to_client')?>" data-toggle="tooltip" data-placement="bottom" ><i class="fa fa-eye-slash"></i>
                                    </a>
                                <?php } else { ?>
                                    <a class="btn btn-sm btn-dark" href="<?= base_url() ?>invoices/show/<?= $inv->inv_id ?>" data-toggle="tooltip" data-placement="bottom" data-title="<?= lang('show_to_client') ?>"><i class="fa fa-eye"></i> <?= lang('show_to_client') ?>
                                    </a>
                                <?php } ?>
                            <?php } ?>

                            <?php if (Invoice::payment_status($inv->inv_id) != 'fully_paid') : ?>

                                <?php if (User::is_admin() || User::perm_allowed(User::get_id(),'pay_invoice_offline')) { ?>

                                <?php } else { if ($inv->allow_paypal == 'Yes') { ?>

                                    <a class="btn btn-sm btn-success" href="<?=base_url()?>paypal/pay/<?=$inv->inv_id?>" data-toggle="ajaxModal" title="<?= lang('via_paypal') ?>">
                                        <?=lang('via_paypal')?>
                                    </a>
                                <?php } if ($inv->allow_2checkout == 'Yes') { ?>

                                    <a class="btn btn-sm btn-success" href="<?=base_url()?>checkout/pay/<?=$inv->inv_id?>" data-toggle="ajaxModal" title="<?=lang('via_2checkout')?>"><?= lang('via_2checkout') ?></a>

                                <?php } if ($inv->allow_stripe == 'Yes') { ?>


                                    <button id="customButton" class="btn btn-sm btn-success" ><?=lang('via_stripe')?></button>


                                <?php } if ($inv->allow_bitcoin == 'Yes') { ?>
                                    <a class="btn btn-sm btn-success" href="<?= base_url() ?>bitcoin/pay/<?= $inv->inv_id ?>" data-toggle="ajaxModal" title="<?= lang('via_bitcoin') ?>"><?= lang('via_bitcoin') ?></a>
                                <?php } ?>
                                <?php } ?>
                            <?php endif; ?>



                            <div class="btn-group">
                                <button class="btn btn-sm btn-<?=config_item('theme_color');?> dropdown-toggle" data-toggle="dropdown"><?= lang('more_actions') ?><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">

                                    <?php if (Invoice::get_invoice_subtotal($inv->inv_id) > 0) { ?>

                                        <?php if (User::is_admin() || User::perm_allowed(User::get_id(),'email_invoices')){ ?>
                                            <li>
                                                <a href="<?=base_url()?>invoices/send_invoice/<?=$inv->inv_id?>" data-toggle="ajaxModal" title="<?= lang('email_invoice') ?>"><?=lang('email_invoice')?></a>
                                            </li>

                                        <?php } if (User::get_id() || User::perm_allowed(User::get_id(),'send_email_reminders')){ ?>
                                            <li>
                                                <a href="<?= base_url() ?>invoices/remind/<?=$inv->inv_id?>" data-toggle="ajaxModal" title="<?= lang('send_reminder') ?>"><?=lang('send_reminder')?></a>
                                            </li>
                                        <?php } ?>
                                        <li><a href="<?=base_url()?>invoices/timeline/<?=$inv->inv_id?>">
                                                <?=lang('invoice_history')?></a>
                                        </li>
                                    <?php } ?>


                                </ul>
                            </div>

                            <?php if (User::is_admin() || User::perm_allowed(User::get_id(),'edit_all_invoices')) { ?>
                                <a href="<?=base_url()?>invoices/edit/<?=$inv->inv_id?>" class="btn btn-sm btn-default" data-original-title="<?=lang('edit_invoice')?>" data-toggle="tooltip" data-placement="bottom">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            <?php } ?>

                            <?php if (User::is_admin() || User::perm_allowed(User::get_id(),'delete_invoices')) { ?>
                                <a href="<?=base_url()?>invoices/delete/<?=$inv->inv_id?>" class="btn btn-sm btn-danger" title="<?=lang('delete_invoice')?>" data-toggle="ajaxModal">
                                    <i class="fa fa-trash"></i>
                                </a>
                            <?php } ?>



                        </div>
                        <div class="col-sm-3 m-b-xs pull-right">
                            <?php if (config_item('pdf_engine') == 'invoicr') : ?>
                                <a href="<?=base_url()?>fopdf/invoice/<?=$inv->inv_id?>" class="btn btn-sm btn-dark pull-right">
                                    <i class="fa fa-file-pdf-o"></i> <?=lang('pdf')?>
                                </a>
                            <?php elseif (config_item('pdf_engine') == 'mpdf') : ?>
                                <a href="<?=base_url()?>invoices/pdf/<?=$inv->inv_id?>" class="btn btn-sm btn-dark pull-right">
                                    <i class="fa fa-file-pdf-o"></i> <?= lang('pdf') ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>



                <section class="scrollable wrapper">

                    <!-- Start create invoice -->
                    <div class="col-sm-12">
                        <section class="panel panel-default">


                            <div class="panel-body">


                                <?php
                                $attributes = array('class' => 'bs-example form-horizontal');
                                echo form_open_multipart(base_url().'invoices/pay',$attributes);
                                $cur = App::currencies($inv->currency);
                                ?>

                                <input type="hidden" name="invoice" value="<?=$id?>">
                                <input type="hidden" name="currency" value="<?=$cur->code?>">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('trans_id')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <?php $this->load->helper('string'); ?>
                                        <input type="text" class="form-control" value="<?=random_string('nozero', 6);?>" name="trans_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group">

        <label class="col-lg-3 control-label"><?=lang('amount')?> (<?=$cur->symbol?>) 
        <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
        <input type="text" class="form-control" value="<?=Applib::format_deci(Invoice::get_invoice_due_amount($id));?>" name="amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('payment_date')?></label>
                                    <div class="col-lg-8">
                                        <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'), time());?>" name="payment_date" data-date-format="<?=config_item('date_picker_format');?>" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('payment_method')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <select name="payment_method" class="form-control">
                                            <?php
                                            foreach (Invoice::payment_methods() as $key => $m) { ?>
                                                <option value="<?=$m->method_id?>"><?=$m->method_name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('notes')?></label>
                                    <div class="col-lg-8">
                                        <textarea name="notes" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('payment_slip')?></label>
                                    <div class="col-lg-3">
                                        <label class="switch">
                                            <input type="hidden" value="off" name="attach_slip" />
                                            <input type="checkbox" name="attach_slip" id="attach_slip">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div id="attach_field" style="display:none">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?=lang('attach_file')?></label>

                                        <div class="col-lg-3">
                                            <input type="file" class="filestyle" data-buttonText="<?=lang('choose_file')?>" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s" name="payment_slip">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('send_email')?></label>
                                    <div class="col-lg-8">
                                        <label class="switch">
                                            <input type="checkbox" name="send_thank_you">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer"> <a href="<?=base_url()?>invoices/view/<?=$id?>" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
                                    <button type="submit" class="btn btn-<?=config_item('theme_color');?>"><?=lang('add_payment')?></button>
                                    </form>



                                </div>
                        </section>
                    </div>


                    <!-- End create invoice -->

                </section>




            </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>

<?php if($inv->allow_stripe == 'Yes'){ ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
<?php } ?>
<!-- end -->