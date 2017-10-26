<!-- Start -->
<section id="content">
    <section class="hbox stretch">

        <aside class="aside-md bg-white b-r" id="subNav">


            <header class="dk header b-b">
                <a href="<?=base_url()?>invoices/add" data-original-title="<?=lang('new_invoice')?>" data-toggle="tooltip" data-placement="top" class="btn btn-icon btn-<?=config_item('theme_color');?> btn-sm pull-right"><i class="fa fa-plus"></i></a>
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
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">

                            <div class="btn-group">

                            </div>

                        </div>
                        <div class="col-sm-4 m-b-xs">

                        </div>
                    </div> </header>
                <section class="scrollable wrapper">

                    <!-- Start create invoice -->
                    <div class="col-sm-12">
                        <section class="panel panel-default">
                            <header class="panel-heading font-bold"><i class="fa fa-info-circle"></i> <?=lang('invoice_details')?></header>
                            <div class="panel-body">

                                <?php
                                $attributes = array('class' => 'bs-example form-horizontal');
                                echo form_open(base_url().'invoices/add',$attributes);
                                ?>
                                <?php echo validation_errors(); ?>


                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('reference_no')?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" value="<?=config_item('invoice_prefix')?><?php
                                        if(config_item('increment_invoice_number') == 'FALSE'){
                                            $this->load->helper('string');
                                            echo random_string('nozero', 6);
                                        }else{
                                            echo Invoice::generate_invoice_number();
                                        }
                                        ?>" name="reference_no">
                                    </div>

                                </div>



                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('client')?> <span class="text-danger">*</span> </label>
                                    <div class="col-lg-6">
                                        <select class="select2-option" style="width:280px" name="client" >
                                            <optgroup label="<?=lang('clients')?>">
                                                <?php foreach (Client::get_all_clients() as $client): ?>
                                                    <option value="<?=$client->co_id?>"><?=ucfirst($client->company_name)?></option>
                                                <?php endforeach;  ?>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <a href="<?=base_url()?>companies/create" class="btn btn-<?=config_item('theme_color');?> btn-sm" data-toggle="ajaxModal" title="<?=lang('new_company')?>" data-placement="bottom"><i class="fa fa-plus"></i> <?=lang('new_client')?></a>

                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('due_date')?></label>
                                    <div class="col-lg-5">
                                        <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="<?=strftime(config_item('date_format'), strtotime("+".config_item('invoices_due_after')." days"));?>" name="due_date" data-date-format="<?=config_item('date_picker_format');?>" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('tax')?> 1</label>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input class="form-control money" type="text" value="<?=config_item('default_tax')?>" name="tax">
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('tax')?> 2</label>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input class="form-control money" type="text" value="<?=config_item('default_tax2')?>" name="tax2">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('discount')?></label>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input class="form-control money" type="text" value="<?=set_value('discount')?>" name="discount">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('extra_fee')?></label>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input class="form-control money" type="text" value="<?=set_value('extra_fee')?>" name="extra_fee">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?=lang('currency')?></label>
                                    <div class="col-lg-5">
                                        <select name="currency" class="form-control">
                                            <option value=""><?=lang('client_default_currency')?></option>
                                            <?php foreach (App::currencies() as $cur) : ?>
                                                <option value="<?=$cur->code?>"><?=$cur->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <?php if(config_item('2checkout_private_key') != '' AND config_item('2checkout_publishable_key') != ''){ ?>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?=lang('allow_2checkout')?></label>
                                        <div class="col-lg-4">
                                            <label class="switch">
                                                <input type="checkbox" name="allow_2checkout">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } else{ ?><input type="hidden" name="allow_2checkout" value="off"> <?php } ?>


                                <?php if(config_item('paypal_email') != ''){ ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?=lang('allow_paypal')?></label>
                                        <div class="col-lg-4">
                                            <label class="switch">
                                                <input type="checkbox" name="allow_paypal">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } else{ ?><input type="hidden" name="allow_paypal" value="off"> <?php } ?>


                                <?php if(config_item('stripe_private_key') != '' AND config_item('stripe_public_key') != ''){ ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?=lang('allow_stripe')?></label>
                                        <div class="col-lg-4">
                                            <label class="switch">
                                                <input type="checkbox" name="allow_stripe">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } else{ ?><input type="hidden" name="allow_stripe" value="off"> <?php } ?>

                                <?php if(config_item('braintree_merchant_id') != '' AND config_item('braintree_public_key') != ''){ ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?=lang('allow_braintree')?></label>
                                        <div class="col-lg-4">
                                            <label class="switch">
                                                <input type="checkbox" name="allow_braintree" id="use_braintree">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="braintree_setup" style="display:none">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label"><?=lang('braintree_merchant_account')?></label>
                                            <div class="col-lg-5">
                                                <input type="text" class="form-control" placeholder="xxxxx" name="braintree_merchant_ac" value="">
                                            </div>
                                            <span class="help-block m-b-none small text-danger">If using multi currency <a href="https://articles.braintreepayments.com/control-panel/important-gateway-credentials" target="_blank">Read More</a></span>
                                        </div>
                                    </div>

                                <?php } else{ ?><input type="hidden" name="allow_braintree" value="off"> <?php } ?>




                                <?php if(config_item('bitcoin_address') != ''){ ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?=lang('allow_bitcoin')?></label>
                                        <div class="col-lg-4">
                                            <label class="switch">
                                                <input type="checkbox" name="allow_bitcoin">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } else{ ?><input type="hidden" name="allow_bitcoin" value="off"> <?php } ?>

                                <div class="form-group terms">
                                    <label class="col-lg-3 control-label"><?=lang('notes')?> </label>
                                    <div class="col-lg-9">
                                        <textarea name="notes" class="form-control foeditor" value="notes"><?=config_item('default_terms')?></textarea>
                                    </div>
                                </div>




                                <button type="submit" class="btn btn-sm btn-<?=config_item('theme_color');?>"><i class="fa fa-plus"></i> <?=lang('create_invoice')?></button>



                                </form>
                            </div>
                        </section>
                    </div>


                    <!-- End create invoice -->



                </section>




            </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>



<!-- end -->