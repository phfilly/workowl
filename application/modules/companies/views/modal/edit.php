<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?=lang('edit_client')?></h4>
        </div><?php $i = Client::view_by_id($company); ?>

<?php echo form_open(base_url().'companies/update'); ?>
        <input style="display:none">
        <input type="password" style="display:none">
        <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="active" data-toggle="tab" href="#tab-client-general"><?=lang('general')?></a></li>
                        <li><a data-toggle="tab" href="#tab-client-contact"><?=lang('contact')?></a></li>
                        <li><a data-toggle="tab" href="#tab-client-web"><?=lang('web')?></a></li>
                        <li><a data-toggle="tab" href="#tab-client-bank"><?=lang('bank')?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-client-general">
                            <input type="hidden" name="company_ref" value="<?=$i->company_ref?>">
                            <input type="hidden" name="co_id" value="<?=$i->co_id?>">
                            <div class="form-group">
                                    <label><?php if ($i->individual == 0) { echo lang('company_name'); } else { echo lang('full_name'); } ?><span class="text-danger">*</span></label>
                                    <input type="text" name="company_name" value="<?=$i->company_name?>" class="input-sm form-control" required>
                            </div>
                            <div class="form-group">
                                    <label><?=lang('email')?> <span class="text-danger">*</span></label>
                                    <input type="email" name="company_email" value="<?=$i->company_email?>" class="input-sm form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?=lang('notes')?></label>
                    <textarea name="notes" class="form-control"><?=$i->notes;?></textarea>
                            </div>

                        </div>
                        <div class="tab-pane fade in" id="tab-client-contact">
                            <div class="form-group col-md-4 no-gutter-left">
                                    <label><?=lang('phone')?> </label>
                                    <input type="text" value="<?=$i->company_phone?>" name="company_phone"  class="input-sm form-control">
                            </div>
                            <div class="form-group col-md-4">
                                    <label><?=lang('mobile_phone')?> </label>
                                    <input type="text" value="<?=$i->company_mobile?>" name="company_mobile"  class="input-sm form-control">
                            </div>
                            <div class="form-group col-md-4 no-gutter-right">
                                    <label><?=lang('fax')?> </label>
                                    <input type="text" value="<?=$i->company_fax?>" name="company_fax"  class="input-sm form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                    <label><?=lang('address')?></label>
                                    <textarea name="company_address" class="form-control"><?=$i->company_address?></textarea>
                            </div>
                            <div class="form-group col-md-6 no-gutter-left">
                                    <label><?=lang('city')?> </label>
                                    <input type="text" value="<?=$i->city?>" name="city" class="input-sm form-control">
                            </div>
                            <div class="form-group col-md-6 no-gutter-right">
                                    <label><?=lang('zip_code')?> </label>
                                    <input type="text" value="<?=$i->zip?>" name="zip" class="input-sm form-control">
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                    <label><?=lang('state_province')?> </label>
                                    <input type="text" value="<?=$i->state?>" name="state" class="input-sm form-control">
                            </div>
                            <div class="form-group col-md-6 no-gutter-right">
                                    <label><?=lang('country')?> </label>
                                    <select class="form-control" style="width:200px" name="country" >
                                            <optgroup label="<?=lang('selected_country')?>">
                                                    <option value="<?=$i->country?>"><?=$i->country?></option>
                                            </optgroup>
                                            <optgroup label="<?=lang('other_countries')?>">
                                                    <?php foreach (App::countries() as $country): ?>
                                                    <option value="<?=$country->value?>"><?=$country->value?></option>
                                                    <?php endforeach; ?>
                                            </optgroup>
                                    </select>
                            </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tab-client-web">
                            <div class="form-group">
                                    <label><?=lang('website')?> </label>
                                    <input type="text" value="<?=$i->company_website?>" name="company_website"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>Skype</label>
                                    <input type="text" value="<?=$i->skype?>" name="skype"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>LinkedIn</label>
                                    <input type="text" value="<?=$i->linkedin?>" name="linkedin"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" value="<?=$i->facebook?>" name="facebook"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" value="<?=$i->twitter?>" name="twitter"  class="input-sm form-control">
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tab-client-bank">
                            <div class="form-group">
                                    <label><?=lang('bank')?> </label>
                                    <input type="text" value="<?=$i->bank?>" name="bank"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                <label>SWIFT/BIC</label>
                                    <input type="text" value="<?=$i->bic?>" name="bic"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                <label>Sort Code</label>
                                    <input type="text" value="<?=$i->sortcode?>" name="sortcode"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('account_holder')?> </label>
                                    <input type="text" value="<?=$i->account_holder?>" name="account_holder"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('account')?> </label>
                                    <input type="text" value="<?=$i->account?>" name="account"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>IBAN</label>
                                    <input type="text" value="<?=$i->iban?>" name="iban"  class="input-sm form-control">
                            </div>
                        </div>

                        <div class="tab-pane fade in" id="tab-client-hosting">
                            <div class="form-group">
                                    <label><?=lang('hosting_company')?> </label>
                                    <input type="text" value="<?=$i->hosting_company?>" name="hosting_company" class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('hostname')?> </label>
                                    <input type="text" value="<?=$i->hostname?>" name="hostname" class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('account_username')?> </label>
                                    <input type="text" value="<?=$i->account_username?>" name="account_username" class="input-sm form-control" >
                            </div>
                            <div class="form-group">
                                    <label><?=lang('account_password')?> </label>
                                    <input type="password" value="<?=$i->account_password?>"  name="account_password" class="input-sm form-control" >
                            </div>
                            <div class="form-group">
                                    <label><?=lang('port')?> </label>
                                    <input type="text" value="<?=$i->port?>" name="port" class="input-sm form-control">
                            </div>
                        </div>
                    </div>
        </div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a>
			<button type="submit" class="btn btn-<?=config_item('theme_color');?>"><?=lang('save_changes')?></button>
		</form>
	</div>
</div>
</div>
<script type="text/javascript">
    $('.nav-tabs li a').first().tab('show');
</script>
