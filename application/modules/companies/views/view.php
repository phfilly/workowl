<?php
$i = Client::view_by_id($company);
?>
<section id="content">
    <section class="hbox stretch">

        <!-- .aside -->
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b b-light">
                    <a href="<?=base_url()?>companies/update/<?=$i->co_id?>" class="btn btn-<?=config_item('theme_color');?> btn-sm pull-right" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> <?=lang('edit')?></a>

                    <p><?=$i->company_name?> - <?=lang('details')?> </p>
                </header>
                <section class="scrollable wrapper">
                    <section class="panel panel-default">
                        <span class="text-danger"><?=$this->session->flashdata('form_errors')?></span>

                        <div class="panel-body">

                            <?php if($i->primary_contact <= 0) { ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">×</button> <i class="fa fa-info-sign"></i>
                                    <?=lang('no_primary_contact')?>
                                </div>
                            <?php } ?>


                            <!-- Details START -->
                            <div class="col-md-4">
                                <div class="group">
                                    <h4 class="subheader text-muted h3"><?=lang('contact_details')?></h4>
                                    <div class="line"></div>
                                    <div class="row inline-fields">
                                        <strong><?php echo ($i->individual == 0) ? lang('company_name') : lang('full_name');  ?>: </strong>
                                        <?=$i->company_name?>
                                    </div>
                                    <?php if ($i->individual == 0) { ?>
                                        <div class="row inline-fields">
                                            <strong><?=lang('contact_person')?>: </strong>
                                            <?=($i->primary_contact) ? User::displayName($i->primary_contact) : ''; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="row inline-fields">
                                        <strong><?=lang('email')?>: </strong>
                                        <a href="mailto:<?=$i->company_email?>"><?=$i->company_email?></a>
                                    </div>
                                    <div class="row inline-fields">
                                        <strong><?=lang('phone')?>: </strong>
                                        <a href="tel:<?=$i->company_phone?>"><?=$i->company_phone?></a>
                                    </div>
                                    <div class="row inline-fields">
                                        <strong><?=lang('mobile_phone')?>: </strong>
                                        <a href="tel:<?=$i->company_mobile?>"><?=$i->company_mobile?></a>
                                    </div>
                                    <div class="row inline-fields">
                                        <strong><?=lang('fax')?>: </strong>
                                        <a href="tel:<?=$i->company_fax?>"><?=$i->company_fax?></a>
                                    </div>
                                    <div class="row inline-fields">
                                        <strong><?=lang('vat')?>: </strong>
                                        <?=$i->VAT?>
                                    </div>

                                    <h4 class="subheader text-muted h3"><?=lang('address')?></h4>
                                    <div class="line"></div>

                                    <div class="row inline-fields">
                                        <?=nl2br($i->company_address)?><br />
                                        <?=$i->city?>, <?=$i->zip?><br />
                                        <?=$i->state?>, <?=$i->country?>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="group">
                                    <h4 class="subheader text-muted h3"><?=lang('web')?></h4>
                                    <div class="line"></div>
                                    <div class="row inline-fields">
                                        <strong><?=lang('website')?>: </strong>
                                        <a href="<?=$i->company_website?>" class="text-info" target="_blank">
                                                <?=$i->company_website?></a>
                                    </div>
                                    <div class="row inline-fields">
                                        <strong>Skype: </strong>
                                        <a href="skype:<?=$i->skype?>?call"><?=$i->skype?></a>
                                    </div>
                                    <div class="row inline-fields">
                                        <strong>LinkedIn: </strong>
                                        <a href="<?=$i->linkedin?>" class="text-info" target="_blank"><?=$i->linkedin?></a>
                                    </div>
                                    <div class="row inline-fields">
                                        <strong>Facebook: </strong>
                                        <a href="<?=$i->facebook?>" class="text-info" target="_blank"><?=$i->facebook?></a>
                                    </div>
                                    <div class="row inline-fields">
                                        <strong>Twitter: </strong>
                                        <a href="<?=$i->twitter?>" class="text-info" target="_blank"><?=$i->twitter?></a>
                                    </div>
                                </div>
                            </div>

                            <!-- End Web Details -->

                            <div class="col-md-4">
                                <div class="group">
                                    <h4 class="subheader text-muted h3"><?=lang('notes')?> &amp; <?=lang('files')?>

                                    <a href="<?=base_url()?>companies/file/add/<?=$i->co_id?>" class="btn btn-<?=config_item('theme_color');?> btn-xs pull-right" data-toggle="ajaxModal" data-placement="left" title="<?=lang('upload_file')?>">
                                        <i class="fa fa-plus-circle"></i> </a>
                                    </h4>
                                    <div class="line"></div>

                                    <?=($i->notes == '') ? 'No Notes' : nl2br_except_pre($i->notes);?>


                                    <p>

                                    <ul class="list-unstyled p-files">
                                    <?php $this->load->helper('file');
                                      foreach (Client::has_files($i->co_id) as $key => $f) {
                                          $icon = $this->applib->file_icon($f->ext);
                                          $real_url = base_url().'resource/uploads/'.$f->file_name;
                                          ?>
                                        <div class="line"></div>
                                            <li>
                                              <?php if ($f->is_image == 1) : ?>
                                                  <?php if ($f->image_width > $f->image_height) {
                                                      $ratio = round(((($f->image_width - $f->image_height) / 2) / $f->image_width) * 100);
                                                      $style = 'height:100%; margin-left: -'.$ratio.'%';
                                                  } else {
                                                      $ratio = round(((($f->image_height - $f->image_width) / 2) / $f->image_height) * 100);
                                                      $style = 'width:100%; margin-top: -'.$ratio.'%';
                                                  }  ?>
                                    <div class="file-icon icon-small">
                                        <a href="<?=base_url()?>companies/file/<?=$f->file_id?>" data-toggle="ajaxModal"><img style="<?=$style?>" src="<?=$real_url?>" /></a>
                                    </div>
                                    <?php else : ?>
                                    <div class="file-icon icon-small"><i class="fa <?=$icon?> fa-lg"></i></div>
                                    <?php endif; ?>

                                    <a data-toggle="tooltip" data-placement="top" data-original-title="<?=$f->description?>" class="text-muted" href="<?=base_url()?>companies/file/<?=$f->file_id?>">
                                                  <?=(empty($f->title) ? $f->file_name : $f->title)?>
                                    </a>

                                    <div class="pull-right">

                                    <a href="<?=base_url()?>companies/file/delete/<?=$f->file_id?>" data-toggle="ajaxModal"><i class="fa fa-trash-o text-danger"></i>
                                    </a>

                                    </div>

                                    </li>


                                            <?php } ?>
                                        </ul>
                                    </p>


                                </div>
                            </div>
                            <!-- End File and Notes section -->

                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <hr>
                                <div class="col-md-5 no-gutter">



                                    <a href="<?=base_url()?>companies/account/hosting/<?=$i->co_id?>" class="btn btn-sm btn-<?=config_item('theme_color');?>" data-toggle="ajaxModal" title="<?=lang('hosting_account')?>"><i class="fa fa-info-circle"></i> <?=lang('show_account_details')?></a>





                                    <a href="<?=base_url()?>companies/account/bank/<?=$i->co_id?>" class="btn btn-sm btn-<?=config_item('theme_color');?>" data-toggle="ajaxModal" title="<?=lang('bank_account')?>"><i class="fa fa-money"></i> <?=lang('show_bank_details')?></a>


                                </div>


                                <div class="col-md-7 no-gutter">
                                    <div class="rec-pay col-md-6 no-gutter">
                                        <h4 class="subheader text-muted text-right"><?=lang('received_amount')?>:

                                            <strong class="text-success">
                                                <?php $cur = Client::client_currency($i->co_id);?>
                                                <?=Applib::format_currency($cur->code, Client::amount_paid($i->co_id))?>
                                            </strong>

                                        </h4>
                                    </div>
                                    <div class="rec-pay col-md-6 no-gutter">
                                        <h4 class="subheader text-muted text-right">
                                            <?=lang('expense_cost')?> :
                                            <strong class="text-danger">
                                                <?php $cur = Client::client_currency($i->co_id);?>
                                                <?=Applib::format_currency($cur->code, Expense::total_by_client($i->co_id))?>
                                            </strong>

                                        </h4>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- Details END -->

                        <div class="panel-body">
                            <?php if ($i->individual == 0) { ?>
                                <!-- Client Contacts -->
                                <div class="col-md-12">
                                    <section class="panel panel-default b-top">
                                        <header class="panel-heading">
                                            <a href="<?=base_url()?>contacts/add/<?=$i->co_id?>" class="btn btn-xs btn-<?=config_item('theme_color');?> pull-right" data-toggle="ajaxModal"><i class="fa fa-plus"></i> Add User</a>

                                            <i class="fa fa-user"></i> Users</header>



                                        <table id="table-client-details-1" class="table table-striped b-t b-light text-sm AppendDataTables">
                                            <thead>
                                            <tr>
                                                <th><?=lang('full_name')?></th>
                                                <th><?=lang('email')?></th>
                                                <th><?=lang('mobile_phone')?> </th>
                                                <th>Skype</th>
                                                <th class="col-date"><?=lang('last_login')?> </th>
                                                <th class="col-options no-sort"><?=lang('options')?></th>
                                            </tr> </thead> <tbody>
                                            <?php foreach (Client::get_client_contacts($company) as $key => $contact) { ?>
                                                <tr>
                                                    <td><a class="thumb-sm avatar">
                                                            <img src="<?php echo User::avatar_url($contact->user_id);?>" class="img-circle">
                                                        <?=$contact->fullname?>
                                                        </a>
                                                        </td>
                                                    <td class="text-info" ><?=$contact->email?> </td>
                                                    <td><a href="tel:<?=User::profile_info($contact->user_id)->phone?>"><b><i class="fa fa-phone"></i></b> <?=User::profile_info($contact->user_id)->phone?></a></td>
                                                    <td><a href="skype:<?=User::profile_info($contact->user_id)->skype?>?call"><?=User::profile_info($contact->user_id)->skype?></a></td>
                                                    <?php
                                                    if ($contact->last_login == '0000-00-00 00:00:00') {
                                                        $login_time = "-";
                                                    }else{ $login_time = strftime(config_item('date_format')." %H:%M:%S", strtotime($contact->last_login)); } ?>
                                                    <td><?=$login_time?> </td>
                                                    <td>

                                                        <a href="<?=base_url()?>companies/send_invoice/<?=$contact->user_id?>/<?=$i->co_id?>" class="btn btn-default btn-xs" title="<?=lang('email_invoice')?>" data-toggle="ajaxModal">
                                                            <i class="fa fa-envelope"></i> </a>

                                                        <a href="<?=base_url()?>companies/make_primary/<?=$contact->user_id?>/<?=$i->co_id?>" class="btn btn-default btn-xs" title="<?=lang('primary_contact')?>" >
                                                            <i class="fa fa-chain <?php if ($i->primary_contact == $contact->user_id) { echo "text-danger"; } ?>"></i> </a>
                                                        <a href="<?=base_url()?>contacts/update/<?=$contact->user_id?>" class="btn btn-default btn-xs" title="<?=lang('edit')?>"  data-toggle="ajaxModal">
                                                            <i class="fa fa-edit"></i> </a>
                                                        <a href="<?=base_url()?>users/account/delete/<?=$contact->user_id?>" class="btn btn-default btn-xs" title="<?=lang('delete')?>" data-toggle="ajaxModal">
                                                            <i class="fa fa-trash-o"></i> </a>
                                                    </td>
                                                </tr>
                                            <?php  } ?>



                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                            <?php } ?>
                            <!-- Client Invoices -->


                            <div class="col-sm-6">
                                <section class="panel panel-default b-top">
                                    <header class="panel-heading"><i class="fa fa-list"></i> <?=strtoupper(lang('invoices'))?> </header>
            <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                                    <table class="table table-striped b-t b-light text-sm">
                                        <thead>
                                        <tr>
                                            <th><?=lang('reference_no')?></th>
                                            <th><?=lang('date_issued')?></th>
                                            <th><?=lang('due_date')?> </th>
                                            <th class="col-currency"><?=lang('amount')?> </th>
                                        </tr> </thead> <tbody>
                    <?php foreach (Invoice::get_client_invoices($company) as $key => $invoice) { ?>
                                            <tr>
                                                <td><a class="text-info" href="<?=base_url()?>invoices/view/<?=$invoice->inv_id?>"><?=$invoice->reference_no?></a></td>
                                                <td><?=strftime(config_item('date_format'), strtotime($invoice->date_saved));?> </td>
                                                <td><?=strftime(config_item('date_format'), strtotime($invoice->due_date));?> </td>
                                                <td class="col-currency">
                                                    <?=Applib::format_currency($invoice->currency, Invoice::get_invoice_subtotal($invoice->inv_id))?>
                                                </td>
                                            </tr>
                                        <?php  } ?>



                                        </tbody>
                                    </table>
                </section>

                                    </section>

                                <section class="panel panel-default ">
                                    <header class="panel-heading"><i class="fa fa-link"></i> <?=strtoupper(lang('links'))?> </header>
                <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                                    <table class="table table-striped b-t b-light text-sm">
                                        <thead>
                                        <tr>
                                            <th><?=lang('link_title')?></th>
                                            <th class="col-options no-sort"><?=lang('options')?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach (Project::get_client_links($company) as $link) { ?>
                                            <tr>
                                                <td>
                                                    <img class="favicon" src="http://www.google.com/s2/favicons?domain=<?=$link->link_url;?>" />
                                                    <a href="<?=base_url()?>projects/view/<?=$link->project_id?>?group=links&view=link&id=<?=$link->link_id?>">
                                                        <?=$link->link_title?>
                                                    </a>
                                                </td>

                                                <td>
                                                    <?php if (User::login_role_name() != 'client' || Project::settings($link->project_id,'show_project_links')) {  ?>
                                                        <a href="<?=base_url()?>projects/links/pin/<?=$link->project_id;?>/<?=$link->link_id?>" title="<?=lang('link_pin');?>" class="foAjax btn btn-xs <?=($i->co_id == $link->client ? 'btn-danger':'btn-default');?> btn"><i class="fa fa-thumb-tack"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <a href="<?=$link->link_url?>" target="_blank" title="<?=$link->link_title?>" class="btn btn-xs btn-primary"><i class="fa fa-external-link text-white"></i></a>
                                                </td>
                                            </tr>
                                        <?php  } ?>
                                        </tbody>
                                    </table>
                </section>
                                </section>


                            </div>
                            <!-- Client Projects -->
                            <div class="col-md-6">
                                <section class="panel panel-default b-top">
                                    <header class="panel-heading"><i class="fa fa-cubes"></i> <?=strtoupper(lang('projects'))?> </header>
                    <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                                <table class="table table-striped b-t b-light text-sm">
                                        <thead>
                                        <tr>
                                            <th><?=lang('project_code')?></th>
                                            <th><?=lang('project_name')?></th>
                                            <th><?=lang('progress')?> </th>
                                        </tr>
                                        </thead> <tbody>
                                        <?php foreach (Project::by_client($company) as $key => $project) { ?>
                                            <tr>
                                                <td><a class="text-info" href="<?=base_url()?>projects/view/<?=$project->project_id?>">
                                                        <?=$project->project_code?></a></td>
                                                <td><?=$project->project_title?> </td>
                                                <td>
                                                    <div class="progress progress-xs m-t-xs progress-striped active m-b-none">
                                                        <div class="progress-bar progress-bar-success" data-toggle="tooltip" data-original-title="<?=$project->progress?>%" style="width: <?=$project->progress?>%">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php  } ?>
                                        </tbody>
                                    </table>

                                    </section>

                                </section></div>



                            <!-- Client payments -->
                            <div class="col-md-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading"><i class="fa fa-usd"></i> <?=strtoupper(lang('payments'))?> </header>
                    <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                                <table class="table table-striped b-t b-light text-sm">
                                        <thead>
                                        <tr>
                                            <th><?=lang('date')?></th>
                                            <th><?=lang('invoice')?></th>
                                            <th><?=lang('amount')?> </th>
                                        </tr> </thead> <tbody>
                                        <?php
                                        foreach (Payment::client_payments($company) as $key => $p) {
                                            $cur = Client::client_currency($p->paid_by); ?>
                                            <tr>
                                                <td>
                            <a class="text-info" href="<?=base_url()?>payments/view/<?=$p->p_id?>">
                                                <?=strftime(config_item('date_format'), strtotime($p->created_date));?>
                            </a>
                                                </td>
                                                <td><a class="text-success" href="<?=base_url()?>invoices/view/<?=$p->invoice?>">
                                                        <?php echo Invoice::view_by_id($p->invoice)->reference_no;?>
                                                    </a>
                                                </td>
                                                <td><?php echo Applib::format_currency($cur->code, $p->amount); ?></td>

                                            </tr>
                                        <?php } ?>



                                        </tbody>
                                    </table>
                </section>
                                </section></div>


                            <!-- End -->
                        </div>
                    </section>
                </section>
            </section>
        </aside>
        <!-- /.aside -->
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>
