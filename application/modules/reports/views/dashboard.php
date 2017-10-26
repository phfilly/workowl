<?php
$chart_year = ($this->session->userdata('chart_year')) ? $this->session->userdata('chart_year') : date('Y');
$cur = App::currencies(config_item('default_currency'));
$this->lang->load('calendar',config_item('language'));
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<section id="content">
  <section class="hbox stretch">
    <aside>
      <section class="vbox">
        <section class="scrollable wrapper">
          <section class="panel panel-default">

          <header class="panel-heading">

            <?=$this->load->view('report_header');?>

          </header>

            <div class="panel-body">

            <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-info-sign"></i><?=lang('amount_displayed_in_your_cur')?>&nbsp;<span class="label label-success"><?=config_item('default_currency')?></span>
            </div>

            <div class="row">

             <div class="col-sm-4">



                    <section class="panel panel-info">
                        <div class="panel-body">
                          <div class="clear">
                            <span class="text-dark"><?=lang('total_sales')?></a>
                            <small class="block text-danger pull-right m-l bt">
                            <?=Applib::format_currency($cur->code,Report::total_paid());?>

                            </small>
                          </div>
                        </div>
                      </section>



                      <section class="panel panel-info">
                        <div class="panel-body">
                          <div class="clear">
                            <span class="text-dark"><?=lang('collected_this_year')?></a>
                            <small class="block text-danger pull-right m-l">
                              <strong>
                              <?=Applib::format_currency($cur->code,Report::year_amount(date('Y')));?>
                              </strong>
                            </small>
                          </div>
                        </div>
                      </section>


                       <section class="panel panel-info">
                        <div class="panel-body">
                          <div class="clear">
                            <span class="text-dark"><?=lang('paid_this_month')?></a>
                            <small class="block text-danger pull-right m-l">
                              <strong>
                              <?=Applib::format_currency($cur->code,Report::month_amount(date('Y'),date('m')));?>
                              </strong>
                            </small>
                          </div>
                        </div>
                      </section>

                      <section class="panel panel-info">
                        <div class="panel-body">
                          <div class="clear">
                            <span class="text-dark"><?=lang('last_month')?></a>
                            <small class="block text-muted pull-right m-l">
                            <?=Applib::format_currency($cur->code,Report::month_amount(date('Y'),date('m')-1));?>

                            </small>
                          </div>
                        </div>
                      </section>

                      <section class="panel panel-info">
                        <div class="panel-body">
                          <div class="clear">
                            <span class="text-dark"><?=lang('payments_received')?></a>
                            <small class="block text-muted pull-right m-l"><?=Report::num_payments()?></small>
                          </div>
                        </div>
                      </section>













            </div>


            <div class="col-md-8 b-top">
            <header class="panel-heading"><?=lang('invoiced_monthly')?></header>
                        <div id="bar-graph"></div>
            </div>

            </div>

            <div class="row b-t">



<!-- 1st Quarter -->
      <div class="col-md-3 col-sm-6">
        <div class="widget">
          <header class="widget-header">
            <h4 class="widget-title">1st <?=lang('quarter')?>, <?=$chart_year?></h4>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body p-t-lg">
          <?php
          $total_jan = Report::month_amount($chart_year, '01');
          $total_feb = Report::month_amount($chart_year, '02');
          $total_mar = Report::month_amount($chart_year, '03');
          $sum = array($total_jan,$total_feb,$total_mar);
          ?>
            <div class="clearfix m-b-md small text-muted"><?=lang('cal_january')?><div class="pull-right ">
            <?=Applib::format_currency($cur->code,$total_jan);?></div>
            </div>

            <div class="clearfix m-b-md small text-muted"><?=lang('cal_february')?><div class="pull-right ">
              <?=Applib::format_currency($cur->code,$total_feb);?>
            </div>
            </div>

            <div class="clearfix m-b-md small text-muted"><?=lang('cal_march')?><div class="pull-right ">
              <?=Applib::format_currency($cur->code,$total_mar);?>
            </div>
            </div>

            <div class="clearfix m-b-md small">
              <div class="pull-right text-dark"><strong>
              <?=Applib::format_currency($cur->code,array_sum($sum));?></strong></div>
            </div>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
      </div>

      <!-- 2nd Quarter -->
<div class="col-md-3 col-sm-6">
        <div class="widget">
          <header class="widget-header">
            <h4 class="widget-title">2nd <?=lang('quarter')?>, <?=$chart_year?></h4>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body p-t-lg">
          <?php
          $total_apr = Report::month_amount($chart_year, '04');
          $total_may = Report::month_amount($chart_year, '05');
          $total_jun = Report::month_amount($chart_year, '06');
          $sum = array($total_apr,$total_may,$total_jun);
          ?>
            <div class="clearfix m-b-md small text-muted"><?=lang('cal_april')?><div class="pull-right">
            <?=Applib::format_currency($cur->code,$total_apr);?></div>
            </div>

            <div class="clearfix m-b-md small text-muted"><?=lang('cal_may')?><div class="pull-right">
              <?=Applib::format_currency($cur->code,$total_may);?>
            </div>
            </div>

            <div class="clearfix m-b-md small text-muted"><?=lang('cal_june')?><div class="pull-right">
              <?=Applib::format_currency($cur->code,$total_jun);?>
            </div>
            </div>

            <div class="clearfix m-b-md small">
              <div class="pull-right text-dark"><strong>
              <?=Applib::format_currency($cur->code,array_sum($sum));?></strong></div>
            </div>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
</div>

<!-- 3rd Quarter -->

<div class="col-md-3 col-sm-6">
        <div class="widget">
          <header class="widget-header">
            <h4 class="widget-title">3rd <?=lang('quarter')?>, <?=$chart_year?></h4>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body p-t-lg">
          <?php
          $total_jul = Report::month_amount($chart_year, '07');
          $total_aug = Report::month_amount($chart_year, '08');
          $total_sep = Report::month_amount($chart_year, '09');
          $sum = array($total_jul,$total_aug,$total_sep);
          ?>
            <div class="clearfix m-b-md small text-muted"><?=lang('cal_july')?><div class="pull-right">
            <?=Applib::format_currency($cur->code,$total_jul);?></div>
            </div>

            <div class="clearfix m-b-md small text-muted"><?=lang('cal_august')?><div class="pull-right">
              <?=Applib::format_currency($cur->code,$total_aug);?>
            </div>
            </div>

            <div class="clearfix m-b-md small text-muted"><?=lang('cal_september')?><div class="pull-right">
              <?=Applib::format_currency($cur->code,$total_sep);?>
            </div>
            </div>

            <div class="clearfix m-b-md small">
              <div class="pull-right text-dark"><strong>
              <?=Applib::format_currency($cur->code,array_sum($sum));?></strong></div>
            </div>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
</div>
<!-- 4th Quarter -->

<div class="col-md-3 col-sm-6">
        <div class="widget">
          <header class="widget-header">
            <h4 class="widget-title">4th <?=lang('quarter')?>, <?=$chart_year?></h4>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body p-t-lg">
          <?php
          $total_oct = Report::month_amount($chart_year, '10');
          $total_nov = Report::month_amount($chart_year, '11');
          $total_dec = Report::month_amount($chart_year, '12');
          $sum = array($total_oct,$total_nov,$total_dec);
          ?>
            <div class="clearfix m-b-md small text-muted"><?=lang('cal_october')?><div class="pull-right">
            <?=Applib::format_currency($cur->code,$total_oct);?></div>
            </div>

            <div class="clearfix m-b-md small text-muted"><?=lang('cal_november')?><div class="pull-right">
              <?=Applib::format_currency($cur->code,$total_nov);?>
            </div>
            </div>

            <div class="clearfix m-b-md small text-muted"><?=lang('cal_december')?><div class="pull-right">
              <?=Applib::format_currency($cur->code,$total_dec);?>
            </div>
            </div>

            <div class="clearfix m-b-md small">
              <div class="pull-right text-dark"><strong>
              <?=Applib::format_currency($cur->code,array_sum($sum));?></strong></div>
            </div>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
</div>
      <!-- End Quarters -->

            </div>
            <!-- End Row -->

            <div class="row">


            <div class="col-sm-4">
                            <section class="panel panel-default b-top">
                                <header class="panel-heading"><?=lang('top_clients')?></header>

                                <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">


                <ul class="list-group alt">

              <?php foreach (Report::top_clients(20) as $key => $client) { ?>
                      <li class="list-group-item">
                            <div><a href="<?=base_url()?>companies/view/<?=$client->co_id?>">
                            <?=Client::view_by_id($client->co_id)->company_name?></a>
                            <small class="text-muted pull-right">
                            <?=Applib::format_currency($cur->code,Client::amount_paid($client->co_id));?>
                              </small>
                            </div>

                      </li>


              <?php } ?>
                    </ul>



                                </section>


                            </section>
            </div>

            <div class="col-sm-4">
                            <section class="panel panel-default b-top">
                                <header class="panel-heading"><?=lang('outstanding')?></header>

                                <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">


               <ul class="list-group alt">
               <?php foreach (Report::outstanding() as $key => $i) {  ?>
                      <li class="list-group-item">
                            <div><a href="<?=base_url()?>invoices/view/<?=$i->inv_id?>">
                            <?=$i->reference_no;?></a>
                            <small class="text-muted pull-right">
                            <?php if ($i->currency != config_item('default_currency')) {
                                echo Applib::format_currency($cur->code,Applib::convert_currency($i->currency, Invoice::get_invoice_due_amount($i->inv_id)));
                                  }else{
                                echo Applib::format_currency($cur->code,Invoice::get_invoice_due_amount($i->inv_id));
                                  }
                              ?>
                              </small>
                            </div>

                      </li>


              <?php } ?>
                    </ul>


                                </section>


                            </section>
            </div>

            <div class="col-sm-4">
                            <section class="panel panel-default b-top">
                                <header class="panel-heading"><?=lang('unbilled_expenses')?></header>

                                <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">


                    <ul class="list-group alt">
               <?php
                foreach (Report::unbilled_expenses() as $key => $e) {
                $client = Client::view_by_id($e->client);
                ?>
                      <li class="list-group-item">
                            <div><a href="<?=base_url()?>companies/view/<?=$e->client?>">
                            <?=$client->company_name?></a>
                            <small class="text-muted pull-right">
                            <?php if ($client->currency != config_item('default_currency')) {
                                echo Applib::format_currency($cur->code,Applib::convert_currency($client->currency,Expense::total_by_client($e->client)));
                                  }else{
                                echo Applib::format_currency($cur->code,Expense::total_by_client($e->client));
                                  }
                              ?>
                              </small>
                            </div>

                      </li>


              <?php } ?>
                    </ul>

                                </section>


                            </section>
            </div>



            </div>
            <!-- End Row -->



            </div>

          </section>
        </section>


        </section> </aside> </section> <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <!-- end -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
  /*
 * Play with this code and it'll update in the panel opposite.
 *
 * Why not try some of the options above?
 */
Morris.Bar({
  element: 'bar-graph',
  data: [
    { y: 'Jan', a: <?=Report::invoiced($chart_year,'01')?> },
    { y: 'Feb', a: <?=Report::invoiced($chart_year,'02')?> },
    { y: 'Mar', a: <?=Report::invoiced($chart_year,'03')?> },
    { y: 'Apr', a: <?=Report::invoiced($chart_year,'04')?> },
    { y: 'May', a: <?=Report::invoiced($chart_year,'05')?> },
    { y: 'Jun', a: <?=Report::invoiced($chart_year,'06')?> },
    { y: 'Jul', a: <?=Report::invoiced($chart_year,'07')?> },
    { y: 'Aug', a: <?=Report::invoiced($chart_year,'08')?> },
    { y: 'Sep', a: <?=Report::invoiced($chart_year,'09')?> },
    { y: 'Oct', a: <?=Report::invoiced($chart_year,'10')?> },
    { y: 'Nov', a: <?=Report::invoiced($chart_year,'11')?> },
    { y: 'Dec', a: <?=Report::invoiced($chart_year,'12')?> }
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Invoices'],
  preUnits:'<?=$cur->symbol?>',
  barColors: ["#38354a"]
});
</script>
