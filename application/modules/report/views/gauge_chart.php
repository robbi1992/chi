<section class="content-header">
	<h1>Dashboard</h1>
</section>

<section class="content">
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Cabin Performance Index</h3>
        </div>
        <div class="box-body">
          <form name="formReport" action="javascript:;" role="form">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="searhType">Aircraft Type</label>
                  <select class="form-control" id="searchType" name="searchType">
                  	<option value="">--Please select week --</option>
                    <option>Week 1</option>
                    <option>Week 2</option>
                    <option>Week 3</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <label>&nbsp;</label>
                <button type="submit" name="searchBtn" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
              </div>
            </div><!-- end row -->
          </form>
        </div>
      </div>
      <!-- Bar chart -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-bar-chart-o"></i>
          <h3 class="box-title">Cabin Performance Index</h3>
        </div>
        <div class="box-body">
          <div id="barchart" style="width: 400px; height: 320px;"></div>
        </div>
      </div><!-- end bar chart -->
     </div>
    </div>
</section>
<script src="https://raw.githubusercontent.com/toorshia/justgage/master/raphael-2.1.4.min.js"></script>
<script src="https://raw.githubusercontent.com/toorshia/justgage/master/justgage.js"></script>
<script>
        var g3 = new JustGage({
        id: "barchart",
        value: getRandomInt(0, 100),
        min: 0,
        max: 100,
        title: "Custom Colors",
        label: "",
        levelColors: [
          "#00fff6",
          "#ff00fc"
        ]
      });
</script>

