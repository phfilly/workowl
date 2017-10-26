<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
    <?php
    $view = isset($_GET['view']) ? $_GET['view'] : '';
    $data['load_setting'] = $load_setting;
    switch ($view) {
        case 'currency':
            $this->load->view('currency',$data);
            break;
            default: ?>


        <?=$this->session->flashdata('form_error')?>
        <?php
        $attributes = array('class' => 'bs-example form-horizontal');
        echo form_open('settings/update', $attributes); ?>
            <section class="panel panel-default">
                <header class="panel-heading font-bold"><i class="fa fa-cogs"></i> <?=lang('payment_settings')?></header>
                <div class="panel-body">

                    <input type="hidden" name="settings" value="<?=$load_setting?>">

                     <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('update_xrates')?></label>
                        <div class="col-lg-4">
                            <label class="switch">
                                <input type="hidden" value="off" name="update_xrates" />
                                <input type="checkbox" <?php if(config_item('update_xrates') == 'TRUE'){ echo "checked=\"checked\""; } ?> name="update_xrates">
                                <span></span>
                            </label>
                        </div>
                        <span class="help-block m-b-none small text-danger">Requires CRONs setup</span>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('paypal_live')?></label>
                        <div class="col-lg-4">
                            <label class="switch">
                                <input type="hidden" value="off" name="paypal_live" />
                                <input type="checkbox" <?php if(config_item('paypal_live') == 'TRUE'){ echo "checked=\"checked\""; } ?> name="paypal_live">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('paypal_email')?> <span class="text-danger">*</span></label>
                        <div class="col-lg-4">
                            <input type="email" name="paypal_email" class="form-control" value="<?=config_item('paypal_email')?>" required>
                        </div>
                    </div>
                    
                    

                    <div class="line line-dashed line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('2checkout_live')?></label>
                        <div class="col-lg-4">
                            <label class="switch">
                                <input type="hidden" value="off" name="two_checkout_live" />
                                <input type="checkbox" <?php if(config_item('two_checkout_live') == 'TRUE'){ echo "checked=\"checked\""; } ?> name="two_checkout_live">
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label">2checkout Publishable Key</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('2checkout_publishable_key')?>" name="2checkout_publishable_key">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">2checkout Private Key</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('2checkout_private_key')?>" name="2checkout_private_key">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">2checkout Seller ID</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('2checkout_seller_id')?>" name="2checkout_seller_id">
                        </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('stripe_private_key')?></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('stripe_private_key')?>" name="stripe_private_key">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('stripe_public_key')?></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('stripe_public_key')?>" name="stripe_public_key">
                        </div>
                    </div>

                <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('braintee_live')?></label>
                        <div class="col-lg-4">
                            <label class="switch">
                                <input type="hidden" value="off" name="braintee_live" />
                                <input type="checkbox" <?php if(config_item('braintee_live') == 'TRUE'){ echo "checked=\"checked\""; } ?> name="braintee_live">
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('braintree_merchant_id')?></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('braintree_merchant_id')?>" name="braintree_merchant_id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('braintree_private_key')?></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('braintree_private_key')?>" name="braintree_private_key">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=lang('braintree_public_key')?></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('braintree_public_key')?>" name="braintree_public_key">
                        </div>
                    </div>


                    <div class="line line-dashed line-lg pull-in"></div>


                    <div class="form-group">
                        <label class="col-lg-4 control-label">Blockchain xPUB</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('bitcoin_address')?>" name="bitcoin_address">
                        </div>
                         <span class="help-block m-b-none small text-danger"><a href="https://blockchain.info/api/api_receive" target="_blank">Read More</a></span>
                         
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label">Blockchain API Key</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?=config_item('bitcoin_api_key')?>" name="bitcoin_api_key">
                        </div>
                        <span class="help-block m-b-none small text-danger"><a href="https://api.blockchain.info/v2/apikey/request/" target="_blank">Read More</a></span>
                        
                    </div>
                    
                    
                </div>
                <div class="panel-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-<?=config_item('theme_color');?>"><?=lang('save_changes')?></button>
                    </div>
                </div>
            </section>
        </form>

         <?php
            break;
    }
    ?>

    </div>
    <!-- End Form -->
</div>