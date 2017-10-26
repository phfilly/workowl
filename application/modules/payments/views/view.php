<section id="content">
  <section class="hbox stretch">

    <aside class="aside-md bg-white b-r" id="subNav">
      <header class="dk header b-b">

        <p class="h4"><?=lang('all_payments')?></p>
      </header>
      <section class="vbox">
        <section class="scrollable w-f">
          <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">


            <ul class="nav">

      <?php foreach ($payments as $key => $p) { ?>
        <li class="b-b b-light <?php if($p->p_id == $this->uri->segment(3)){ echo "bg-light dk"; } ?>">
        <a href="<?=base_url()?>payments/view/<?=$p->p_id?>" class="small">
        <strong>
        <?=ucfirst(Client::view_by_id($p->paid_by)->company_name)?>
        </strong>
        <div class="pull-right">
        <strong><?=Applib::format_currency(Invoice::view_by_id($p->invoice)->currency,$p->amount)?></strong>
        </div> <br>
        <small class="block small text-muted"><?=$p->trans_id?>
          <span class="pull-right"><?=strftime(config_item('date_format'), strtotime($p->created_date));?></span>
        </small>

        </a> </li>
        <?php } ?>
      </ul>




            </div>
            </section>
          </section>
        </aside>

        <aside>
          <section class="vbox">
            <header class="header bg-white b-b clearfix">
              <div class="row m-t-sm">
                <div class="col-sm-8 m-b-xs">
                <?php $i = Payment::view_by_id($id); ?>

                <?php if(User::is_admin() || User::perm_allowed(User::get_id(),'edit_payments')){ ?>

                    <a href="<?=base_url()?>payments/edit/<?=$i->p_id?>" title="<?=lang('edit_payment')?>" class="btn btn-sm btn-<?=config_item('theme_color');?>">
                  <i class="fa fa-pencil text-white"></i> <?=lang('edit_payment')?></a>

                  <?php if($i->refunded == 'No'){ ?>
                  <a href="<?=base_url()?>payments/refund/<?=$i->p_id?>" title="<?=lang('refunded')?>" class="btn btn-sm btn-<?=config_item('theme_color');?>" data-toggle="ajaxModal">
                  <i class="fa fa-warning text-white"></i> <?=lang('refunded')?></a>
                  <?php } ?>

                  <?php } ?>

                  <a href="<?=base_url()?>payments/pdf/<?=$i->p_id?>" title="<?=lang('pdf')?>" class="btn btn-sm btn-<?=config_item('theme_color');?>">
                  <i class="fa fa-file-pdf-o text-white"></i> <?=lang('pdf')?> <?=lang('receipt')?></a>

                </div>
                <div class="col-sm-4 m-b-xs">

              </div>
            </div> </header>
            <section class="scrollable wrapper">
              <!-- Start Payment -->
              <?php if($i->refunded == 'Yes') { ?>
              <div class="alert alert-danger hidden-print">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <i class="fa fa-warning"></i> <?=lang('transaction_refunded')?>
              </div>
              <?php } ?>


              <div class="column content-column">
                <div class="details-page">
                  <div class="details-container clearfix" style="margin-bottom:20px">
                    <div style="font-size:10pt;">

                      <div style="padding:35px;">

                        <div style="padding:35px 0 50px;text-align:center">
                          <span style="text-transform: uppercase; border-bottom:1px solid #eee;font-size:13pt;"><?=lang('payments_received')?></span>
                        </div>
                        <div style="width: 70%;float: left;">
                          <div style="width: 100%;padding: 11px 0;">
                            <div style="color:#999;width:35%;float:left;"><?=lang('payment_date')?></div>
                            <div style="width:65%;border-bottom:1px solid #eee;float:right;foat:right;"><?=strftime(config_item('date_format')." %H:%M:%S", strtotime($i->created_date));?></div>
                            <div style="clear:both;"></div>
                          </div><div style="width: 100%;padding: 10px 0;">
                          <div style="color:#999;width:35%;float:left;"><?=lang('transaction_id')?></div>
                          <div style="width:65%;border-bottom:1px solid #eee;float:right;foat:right;min-height:22px"><?=$i->trans_id?></div>
                          <div style="clear:both;"></div>
                        </div>
                      </div>
                      <div class="bg-<?=config_item('theme_color')?>" style="text-align:center;color:white;float:right;width: 25%;
                        padding: 20px 5px;">
                        <span> <?=lang('amount_received')?></span><br>
                                <?php $cur = Invoice::view_by_id($i->invoice)->currency; ?>

                        <span style="font-size:16pt;"><?=Applib::format_currency($cur, $i->amount)?></span>
                        </div><div style="clear:both;"></div>
                        <div style="padding-top:10px">
                          <div style="width:75%;border-bottom:1px solid #eee;float:right"><strong><a href="<?=base_url()?>companies/view/<?=$i->paid_by?>">
                          <?=ucfirst(Client::view_by_id($i->paid_by)->company_name);?></a></strong></div>
                          <div style="color:#999;width:25%"><?=lang('received_from')?></div>
                        </div>
                        <div style="padding-top:25px">
                          <div style="width:75%;border-bottom:1px solid #eee;float:right">
                          <?=App::get_method_by_id($i->payment_method)?></div>
                          <div style="color:#999;width:25%"><?=lang('payment_mode')?></div>
                        </div>

                        <div style="padding-top:25px">
                          <div style="width:75%;border-bottom:1px solid #eee;float:right">
                          <?=$i->currency?></div>
                          <div style="color:#999;width:25%"><?=lang('currency')?></div>
                        </div>


                        <div style="padding-top:25px">
                          <div style="width:75%;border-bottom:1px solid #eee;float:right">
                          <?=($i->notes) ? $i->notes : 'NULL'; ?></div>
                          <div style="color:#999;width:25%"><?=lang('notes')?></div>
                        </div>

                        <?php if($i->attached_file) : ?>

                         <div style="padding-top:25px">
                          <div style="width:75%;border-bottom:1px solid #eee;float:right">
                          <a href="<?=base_url()?>resource/uploads/<?=$i->attached_file?>" target="_blank">
                          <?=$i->attached_file?>
                          </a>
                          </div>
                          <div style="color:#999;width:25%"><?=lang('attachment')?></div>
                        </div>

                      <?php endif; ?>


                        <div style="margin-top:100px">
                          <div style="width:100%">
                            <div style="width:50%;float:left"><h4><?=lang('payment_for')?></h4></div>
                            <div style="clear:both;"></div>
                          </div>

                          <table style="width:100%;margin-bottom:35px;table-layout:fixed;" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                              <tr style="height:40px;background:#f5f5f5">
                                <td style="padding:5px 10px 5px 10px;word-wrap: break-word;">
                                  <?=lang('invoice_code')?>
                                </td>
                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;" align="right">
                                  <?=lang('invoice_date')?>
                                </td>
                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;" align="right">
                                  <?=lang('due_amount')?>
                                </td>
                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;" align="right">
                                  <?=lang('paid_amount')?>
                                </td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr style="border-bottom:1px solid #ededed">
                                <td style="padding: 10px 0px 10px 10px;" valign="top">
                                <a href="<?=base_url()?>invoices/view/<?=$i->invoice?>"><?=Invoice::view_by_id($i->invoice)->reference_no;?></a></td>
                                <td style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;" valign="top">
                <?=strftime(config_item('date_format'), strtotime(Invoice::view_by_id($i->invoice)->date_saved));?>
                                </td>
                                <td style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;" valign="top">
                                  <span>
                <?=Applib::format_currency($cur, Invoice::get_invoice_due_amount($i->invoice))?> </span>
                                </td>
                                <td style="text-align:right;padding: 10px 10px 10px 5px;word-wrap: break-word;" valign="top">
                                  <span><?=Applib::format_currency($cur, $i->amount)?></span>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
              <!-- End Payment -->
            </section>
            </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
            <!-- end -->
