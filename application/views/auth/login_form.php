<?php
$login = array(
	'name'	=> 'login',
	'class'	=> 'form-control input-lg',
	'placeholder' => lang('username'),
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or Username';
} else if ($login_by_username) {
	$login_label = 'Username';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'inputPassword',
	'placeholder' => lang('password'),
	'size'	=> 30,
	'class' => 'form-control input-lg'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'class'	=> 'form-control input-lg',
	'maxlength'	=> 10,
);
?>


<div class="content">

<section id="content" class="m-t-lg wrapper-md" style="margin-top:5px;">

                <div id="login-darken"></div>
		<div id="login-form" class="container aside-xxl animated fadeInUp">


		<span class="navbar-brand block <?=(config_item('blur_login') == 'TRUE') ? 'text-white':'';?>">
                    <?php $display = config_item('logo_or_icon'); ?>
			<?php if ($display == 'logo' || $display == 'logo_title') { ?>
			<img src="<?=base_url()?>resource/images/<?=config_item('company_logo')?>" class="img-responsive <?=($display == 'logo' ? "" : "thumb-sm m-r-sm")?>">
			<?php } elseif ($display == 'icon' || $display == 'icon_title') { ?>
			<i class="fa <?=config_item('site_icon')?>"></i>
			<?php } ?>
			<?php
                if ($display == 'logo_title' || $display == 'icon_title') {
                    if (config_item('website_name') == '') {
                    	echo config_item('company_name');
                    } else {
                    	echo config_item('website_name'); }
                        }
            ?>
                </span>
		 <section class="panel panel-default bg-white m-t-lg" style="border-radius:3px;">
		<header class="panel-heading text-center"> <strong>WorkOwl Admin</strong>
			<?php  echo modules::run('sidebar/flash_msg');?>
		</header>
		<?php
		$attributes = array('class' => 'panel-body wrapper-lg');
		echo form_open($this->uri->uri_string(),$attributes); ?>

			<div class="form-group">
				<label class="control-label"><?=lang('email_user')?></label>
				<?php echo form_input($login); ?>
				<span style="color: red;">
				<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
			</div>
			<div class="form-group">
				<label class="control-label"><?=lang('password')?></label>
				<?php echo form_password($password); ?>
				<span style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
			</div>


	<table>

	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
			
	<?php echo $this->recaptcha->render(); ?>

	<?php } else { ?>
    <tr><td colspan="2"><p><?=lang('enter_the_code_exactly')?></p></td></tr>


	<tr>
		<td colspan="3"><?php echo $captcha_html; ?></td>
		<td style="padding-left: 5px;"><?php echo form_input($captcha); ?></td>
		<span style="color: red;"><?php echo form_error($captcha['name']); ?></span>
	</tr>
	<?php }
	} ?>
</table>

	<div class="checkbox">
				<label>
					<?php echo form_checkbox($remember); ?> <?=lang('this_is_my_computer')?>
				</label>
			</div>
 <a href="<?=base_url()?>auth/forgot_password" class="pull-right m-t-xs"><small><?=lang('forgot_password')?></small></a>
			<button type="submit" class="btn btn-<?=config_item('theme_color');?>"><?=lang('sign_in')?></button>
			<div class="line line-dashed">
			</div>
                        <?php echo form_close(); ?>

                        <!-- footer -->
        <?php if (config_item('hide_branding') == 'FALSE') : ?>
	<footer id="footer" style="background-color: #f6f5f5; padding: 10px 0; border-radius: 0 0 4px 4px; margin-bottom:0;">
	<div class="text-center text-muted padder">
		<p> <small><?=lang('powered_by')?>  <a href="http://codecanyon.net/item/freelancer-office/8870728" target="_blank">Freelancer Office</a> v<?=config_item('version')?>
		<br>&copy; <?=date('Y')?> <a href="<?=config_item('company_domain')?>" target="_blank"><?=config_item('company_name')?></a> </small> </p>
	</div>
	</footer>
        <?php endif; ?>
	<!-- / footer -->

 </section>

	</div>
	</section>
    </div>
