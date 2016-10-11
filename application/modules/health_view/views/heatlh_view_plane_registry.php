<section class="content-header">
	<h1>PERFORMANCE MONITORING<small><i class="fa fa-fw fa-angle-double-right"></i> AIRBUS-330</small></h1>
</section>
<section class="content">
    <div class="row">
    <?php
        $tag_html = '';
        $list_reg = array(
                        'PK-GPA' => array('red'),
                        'PK-GPC' => array('green'),
                        'PK-GPD' => array('yellow'),
                        'PK-GPE' => array('green'),
                        'PK-GPF' => array('red'),
                        'PK-GPG' => array('yellow'),
                        'PK-GPR' => array('green'),
                        'PK-GPT' => array('red'),
                        'PK-GPU' => array('yellow'),
                        'PK-GPV' => array('green'),
                        'PK-GPW' => array('yellow'),
                        'PK-GPX' => array('red'),
                        'PK-GPY' => array('red'),
                        'PK-GPZ' => array('yellow'),
                        'PK-GHA' => array('green'),
                        'PK-GHC' => array('red')
                         );
        $i = 1;
        foreach($list_reg as $key => $value ){
            
            foreach($value as $key2 => $value2 ){
            
                echo '<div class="col-lg-2 col-xs-4">
                          <!-- small box -->
                          <div class="wrap-box text-center">
                            <div class="box-icon bg-'. $value2 .'">
                                <span class="fa fa-5x fa-plane"></span>
                            </div>
                            <a href="' . base_url("/health_view/cabin/" . url_title('AIRBUS-330') .'/'. url_title($key)) . '">
                                <h4>' . $key .'</h4>
                            </a>
                          </div>
                        </div>';
            
            
                if($i % 6 == 0){
                    echo '</div><div class="row">';    
                }
            }
            $i++;
        }
    ?>
   
</section>

<script type="text/javascript">

</script>