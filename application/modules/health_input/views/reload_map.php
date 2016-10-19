            <div class="ac_cabin">
                <?php
                if(count($cabin_template) == 0) {
                    ?>
                    <div class="alert alert-danger">Template not found</div>
                    <?php
                }
                else {
                    ?>
                    <img src="<?php echo base_url(); ?>assets/upload_cabin/<?php echo $cabin_template[0]->FileImage;?>" id="ImageAirCraft" class="imgmapMainImage img-responsive" alt="" usemap="#map"/>
                    <?php
                    if(count($cabin_template_detail) > 0 ) {
                        ?>
                        <map name="map" id="map">
                        <?php
                        foreach ($cabin_template_detail as $v) {
                            ?>
                            <area href="#" onclick="Input.getMenu('<?php echo $v->id;?>', '<?php echo $v->noItem;?>')" state="AC" id="<?php echo $v->noItem;?>" shape="circle" coords="<?php echo $v->coordinate;?>" />
                            <?php
                        }
                        ?>
                        </map>
                        <?php
                    } 
                }
                ?>
            </div>