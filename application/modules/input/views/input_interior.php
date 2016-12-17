<link rel ="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/app.chi.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
<section class="content-header">
    <h1>
        <small>
            <a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Main Menu</a>
            <i class="fa fa-fw fa-angle-double-right"></i> Input
            <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url();?>/input/aircraft_type"> All Aircraft</a>
            <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $type;?> <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url('/input/performance/' . $type . '/' . $reg['regName']);?>"><?php echo $reg['regName'];?></a>
            <i class="fa fa-fw fa-angle-double-right"></i> <i class="fa fa-plane"></i> Interior Appearance
        </small>
    </h1>
</section>

<section class="content">
    <div class="row">
          <div class="col-md-4">
            <div class="list-group">
                <?php
                $active = 1;
                foreach ($items as $val) {
                ?>
                <a view="cabinMenu" cabinName="<?php echo $val->ini_name;?>" cabin="<?php echo $val->ini_id;?>" href="javascript:;" class="list-group-item chi-primary-text <?php echo ($active == 1) ? 'active':''; ?> "><i class="fa fa-link chi-pd-right-10"></i> <?php echo $val->ini_name;?></a>
                <?php  
                $active++;  
                }
                ?>
            </div>
        </div>
        <div class="col-md-8">
        <div class="box box-danger" template="intForm">
            <div class="box-header with-border">
              <h3 class="box-title">Input appereance form</h3>
            </div>
            <div class="box-body">
              <form name="intForm" role="form" action="javascript:;">
                <div class="form-group">
                    <label>Weight per area</label>
                    <input type="text" class="form-control" name="intWeight" readonly="readonly">
                  </div>
                <div class="form-group">
                  <label>Items per area</label>
                  <select name="intItem" class="form-control" style="width: 100%;">
                  </select>
                </div>
                <div template="intDetail" class="hidden">
                  <div class="form-group">
                    <label>Total item</label>
                    <input type="text" class="form-control" name="intTotal" readonly="readonly">
                  </div>
                  <div class="form-group hidden">
                    <label>Defect performance</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="intDefectPerform" readonly="readonly">
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                  <div class="form-group hidden">
                    <label>Dirty performance</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="intDirtyPerform" readonly="readonly">
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Defect</label>
                    <input type="text" class="form-control" name="intDefect">
                  </div>
                  <div class="form-group">
                    <label>Dirty</label>
                    <input type="text" class="form-control" name="intDirty">
                  </div>
                  <div class="form-group">
                    <label>Remark</label>
                    <textarea name="intRemark" class="form-control"></textarea>
                  </div>
                </div>
                <button name="intSubmit" class="btn btn-primary form-control">Input</button>
              </form>
            </div>
            </div><!-- end box header -->
          </div>
        </div>
        <!-- status bar -->
          <div class="row hidden" template="intStatus">
            <div class="col-md-12">
              <p class="text-center">
                <strong>Current Performance</strong>
              </p>
              <div class="progress-group">
                <span class="progress-text">Interior Performance</span>
                <span class="progress-number">
                  <b><span view="performanceBar"></span></b>/100%
                </span>
                <div class="progress sm">
                  <div view="progress-bar" style="width: 90%;"></div>
                </div>
              </div>
            </div>
          </div>
        <!-- table row -->
        <div class="row hidden" template="rowTable">
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped table-responsive table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Item name</th>
                            <th class="text-center">defect</th>
                            <th class="text-center">dirty</th>
                            <th class="text-center">remark</th>
                        </tr>
                        <tr class="hidden" view="templateRow">
                            <th class="text-center" view="rowNo"></th>
                            <th view="rowName"></th>
                            <th class="text-center" view="rowDefect"></th>
                            <th class="text-center" view="rowDirty"></th>
                            <th view="rowRemark"></th>
                        </tr>
                    </thead>
                    <tbody><!-- append by ajax --></tbody>
                </table>
            </div>
        </div>
        <!-- -->
    </div>
</section>
<script type="text/javascript">
    var baseUrl = '<?php echo site_url();?>/input/',
        iniID = '<?php echo $items[0]->ini_id;?>',
        iniName = '<?php echo $items[0]->ini_name;?>',
        acReg = '<?php echo $reg["regID"];?>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/fn.progress.color.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/app.input.int.js"></script>