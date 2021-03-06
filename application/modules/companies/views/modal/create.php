<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Company</h4>
        </div><?php
            echo form_open(base_url().'companies/create'); ?>
        <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="active" data-toggle="tab" href="#tab-client-general"><?=lang('general')?></a></li>
                        <li><a data-toggle="tab" href="#tab-client-contact"><?=lang('contact')?></a></li>
                        <li><a data-toggle="tab" href="#tab-client-web"><?=lang('web')?></a></li>
                        <li><a data-toggle="tab" href="#tab-client-bank"><?=lang('bank')?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-client-general">
							<?php $company_ref = $this->applib->generate_string();
							while($this->db->where('company_ref', $company_ref)->get('companies')->num_rows() == 1) {
							$company_ref = $this->applib->generate_string();
							} ?>
							<input type="hidden" name="company_ref" value="<?=$company_ref?>">
                            <div class="form-group">
                                    <label><?=lang('company_name')?> / <?=lang('full_name')?><span class="text-danger">*</span></label>
                                    <input type="text" name="company_name" value="" class="input-sm form-control" required>
                            </div>
                            <div class="form-group">
                                    <label><?=lang('email')?> <span class="text-danger">*</span></label>
                                    <input type="email" name="company_email" value="" class="input-sm form-control" required>
                            </div>
                            <div class="form-group">
                                <label><?=lang('notes')?></label>
                                <textarea name="notes" class="form-control" placeholder="<?=lang('notes')?>" ></textarea>
                            </div>

                        </div>
                        <div class="tab-pane fade in" id="tab-client-contact">
                                <div class="form-group col-md-4 no-gutter-left">
                                        <label><?=lang('phone')?> </label>
                                        <input type="text" value="" name="company_phone"  class="input-sm form-control">
                                </div>
                                <div class="form-group col-md-4">
                                        <label><?=lang('mobile_phone')?> </label>
                                        <input type="text" value="" name="company_mobile"  class="input-sm form-control">
                                </div>
                                <div class="form-group col-md-4 no-gutter-right">
                                        <label><?=lang('fax')?> </label>
                                        <input type="text" value="" name="company_fax"  class="input-sm form-control">
                                </div>
                            <div class="clearfix"></div>
                                <div class="form-group">
                                        <label><?=lang('address')?></label>
                                        <textarea name="company_address" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-6 no-gutter-left">
                                        <label><?=lang('city')?> </label>
                                        <input type="text" value="" name="city" class="input-sm form-control">
                                </div>
                                <div class="form-group col-md-6 no-gutter-right">
                                        <label><?=lang('zip_code')?> </label>
                                        <input type="text" value="" name="zip" class="input-sm form-control">
                                </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                    <label><?=lang('state_province')?> </label>
                                    <input type="text" value="" name="state" class="input-sm form-control">
                            </div>
                                <div class="form-group col-md-6">
                                        <label><?=lang('country')?> </label>
                                        <select class="form-control" style="width:200px" name="country" >
                                                <optgroup label="<?=lang('selected_country')?>">
                                                        <option value="<?=config_item('company_country')?>"><?=config_item('company_country')?></option>
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
                                    <input type="text" value="" name="company_website"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>Skype</label>
                                    <input type="text" value="" name="skype"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>LinkedIn</label>
                                    <input type="text" value="" name="linkedin"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" value="" name="facebook"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" value="" name="twitter"  class="input-sm form-control">
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tab-client-bank">
                            <div class="form-group">
                                    <label><?=lang('bank')?> </label>
                                    <input type="text" value="" name="bank"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                <label>SWIFT/BIC</label>
                                    <input type="text" value="" name="bic"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                <label>Sort Code</label>
                                    <input type="text" value="" name="sortcode"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('account_holder')?> </label>
                                    <input type="text" value="" name="account_holder"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('account')?> </label>
                                    <input type="text" value="" name="account"  class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label>IBAN</label>
                                    <input type="text" value="" name="iban"  class="input-sm form-control">
                            </div>
                        </div>

                        <div class="tab-pane fade in" id="tab-client-hosting">
                            <div class="form-group">
                                    <label><?=lang('hosting_company')?> </label>
                                    <input type="text" value="" name="hosting_company" class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('hostname')?> </label>
                                    <input type="text" value="" name="hostname" class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('account_username')?> </label>
                                    <input type="text" value="" name="account_username" autocomplete="off" class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('account_password')?> </label>
                                    <input type="password" value="" autocomplete="off" class="input-sm form-control">
                            </div>
                            <div class="form-group">
                                    <label><?=lang('port')?> </label>
                                    <input type="text" value="" name="port" class="input-sm form-control">
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
