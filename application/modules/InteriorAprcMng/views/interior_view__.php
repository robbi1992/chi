
        
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/redist/when.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/core.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/graphics.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/mapimage.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/mapdata.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/areadata.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/areacorners.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/scale.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/tooltip.js"></script>               

<script>

    
    function checkCoord(input){
        if ( input != 0 ) {
            return true;
        }
        return false;
    }
    
        
	$().ready(function(){
        
        var img = $('img');
        img.mapster({
            mapKey: 'state',
            mapValue: 'data-statename',
            isSelectable: false,
            showToolTip: true,
            areas: [
                { 
                    key: "AS",
                    selected: true,
                    fillColor: 'ff0000',
                    fillOpacity: 100
                },
                { 
                    key: "AD",
                    selected: true,
                    fillColor: 'ffeb3b',
                    fillOpacity: 100
                },
                { 
                    key: "AC",
                    selected: true,
                    fillColor: '8bc34a',
                    fillOpacity: 100
                }
                ]
        });
        
        $('area').mapster('select');
        
        $('area').bind('mouseover', function() {
            $(this).mapster('tooltip',this,$(this).attr('id').toUpperCase());
        });
    });
    

    
</script>


<section class="content-header">
	<h1>Interior Appereance<small><i class="fa fa-fw fa-angle-double-right"></i><b>AIRBUS-330 - <?php echo $typereg; ?></b></small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="ac_cabin">
                <img src="<?php echo base_url(); ?>assets/images/B777-GIA-GIG.jpg" id="ImageAirCraft" class="imgmapMainImage img-responsive" alt="" usemap="#map"/>
                <map name="map" id="map">
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area1" onclick="return checkCoord(1);" class="area test" shape="circle" coords="147,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area2" onclick="return checkCoord(2);" class="area test" shape="circle" coords="182,82,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area3" onclick="return checkCoord(3);" class="area test" shape="circle" coords="148,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area4" onclick="return checkCoord(4);" class="area test" shape="circle" coords="183,110,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area5" onclick="return checkCoord(5);" class="area test" shape="circle" coords="148,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area6" onclick="return checkCoord(6);" class="area test" shape="circle" coords="183,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area7" onclick="return checkCoord(7);" class="area test" shape="circle" coords="147,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area8" onclick="return checkCoord(8);" class="area test" shape="circle" coords="184,156,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area9" onclick="return checkCoord(9);" class="area test" shape="circle" coords="229,80,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area10" onclick="return checkCoord(10);" class="area test" shape="circle" coords="248,87,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area11" onclick="return checkCoord(11);" class="area test" shape="circle" coords="266,81,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area12" onclick="return checkCoord(12);" class="area test" shape="circle" coords="229,114,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area13" onclick="return checkCoord(13);" class="area test" shape="circle" coords="251,106,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area14" onclick="return checkCoord(14);" class="area test" shape="circle" coords="232,126,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area15" onclick="return checkCoord(15);" class="area test" shape="circle" coords="249,133,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area16" onclick="return checkCoord(16);" class="area test" shape="circle" coords="231,162,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area17" onclick="return checkCoord(17);" class="area test" shape="circle" coords="247,154,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area18" onclick="return checkCoord(18);" class="area test" shape="circle" coords="266,162,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area19" onclick="return checkCoord(19);" class="area test" shape="circle" coords="351,79,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area20" onclick="return checkCoord(20);" class="area test" shape="circle" coords="369,86,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area21" onclick="return checkCoord(21);" class="area test" shape="circle" coords="387,79,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area22" onclick="return checkCoord(22);" class="area test" shape="circle" coords="406,87,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area23" onclick="return checkCoord(23);" class="area test" shape="circle" coords="424,79,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area24" onclick="return checkCoord(24);" class="area test" shape="circle" coords="443,86,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area25" onclick="return checkCoord(25);" class="area test" shape="circle" coords="461,79,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area26" onclick="return checkCoord(26);" class="area test" shape="circle" coords="351,115,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area27" onclick="return checkCoord(27);" class="area test" shape="circle" coords="368,106,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area28" onclick="return checkCoord(28);" class="area test" shape="circle" coords="387,114,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area29" onclick="return checkCoord(29);" class="area test" shape="circle" coords="406,107,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area30" onclick="return checkCoord(30);" class="area test" shape="circle" coords="423,116,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area31" onclick="return checkCoord(31);" class="area test" shape="circle" coords="443,109,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area32" onclick="return checkCoord(32);" class="area test" shape="circle" coords="461,114,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area33" onclick="return checkCoord(33);" class="area test" shape="circle" coords="351,125,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area34" onclick="return checkCoord(34);" class="area test" shape="circle" coords="371,133,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area35" onclick="return checkCoord(35);" class="area test" shape="circle" coords="388,125,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area36" onclick="return checkCoord(36);" class="area test" shape="circle" coords="406,135,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area37" onclick="return checkCoord(37);" class="area test" shape="circle" coords="423,126,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area38" onclick="return checkCoord(38);" class="area test" shape="circle" coords="443,132,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area39" onclick="return checkCoord(39);" class="area test" shape="circle" coords="459,125,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area40" onclick="return checkCoord(40);" class="area test" shape="circle" coords="352,160,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area41" onclick="return checkCoord(41);" class="area test" shape="circle" coords="371,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area42" onclick="return checkCoord(42);" class="area test" shape="circle" coords="388,162,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area43" onclick="return checkCoord(43);" class="area test" shape="circle" coords="407,153,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area44" onclick="return checkCoord(44);" class="area test" shape="circle" coords="424,161,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area45" onclick="return checkCoord(45);" class="area test" shape="circle" coords="444,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area46" onclick="return checkCoord(46);" class="area test" shape="circle" coords="461,161,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area47" onclick="return checkCoord(47);" class="area test" shape="circle" coords="487,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area48" onclick="return checkCoord(48);" class="area test" shape="circle" coords="487,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area49" onclick="return checkCoord(49);" class="area test" shape="circle" coords="487,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area50" onclick="return checkCoord(50);" class="area test" shape="circle" coords="486,112,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area51" onclick="return checkCoord(51);" class="area test" shape="circle" coords="487,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area52" onclick="return checkCoord(52);" class="area test" shape="circle" coords="487,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area53" onclick="return checkCoord(53);" class="area test" shape="circle" coords="488,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area54" onclick="return checkCoord(54);" class="area test" shape="circle" coords="489,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area55" onclick="return checkCoord(55);" class="area test" shape="circle" coords="487,163,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area56" onclick="return checkCoord(56);" class="area test" shape="circle" coords="502,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area57" onclick="return checkCoord(57);" class="area test" shape="circle" coords="503,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area58" onclick="return checkCoord(58);" class="area test" shape="circle" coords="502,94,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area59" onclick="return checkCoord(59);" class="area test" shape="circle" coords="501,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area60" onclick="return checkCoord(60);" class="area test" shape="circle" coords="501,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area61" onclick="return checkCoord(61);" class="area test" shape="circle" coords="501,129,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area62" onclick="return checkCoord(62);" class="area test" shape="circle" coords="502,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area63" onclick="return checkCoord(63);" class="area test" shape="circle" coords="503,156,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area64" onclick="return checkCoord(64);" class="area test" shape="circle" coords="503,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area65" onclick="return checkCoord(65);" class="area test" shape="circle" coords="516,76,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area66" onclick="return checkCoord(66);" class="area test" shape="circle" coords="516,86,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area67" onclick="return checkCoord(67);" class="area test" shape="circle" coords="516,94,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area68" onclick="return checkCoord(68);" class="area test" shape="circle" coords="514,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area69" onclick="return checkCoord(69);" class="area test" shape="circle" coords="514,122,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area70" onclick="return checkCoord(70);" class="area test" shape="circle" coords="516,131,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area71" onclick="return checkCoord(71);" class="area test" shape="circle" coords="516,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area72" onclick="return checkCoord(72);" class="area test" shape="circle" coords="516,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area73" onclick="return checkCoord(73);" class="area test" shape="circle" coords="517,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area75" onclick="return checkCoord(75);" class="area test" shape="circle" coords="528,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area76" onclick="return checkCoord(76);" class="area test" shape="circle" coords="527,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area77" onclick="return checkCoord(77);" class="area test" shape="circle" coords="528,130,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area78" onclick="return checkCoord(78);" class="area test" shape="circle" coords="577,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area79" onclick="return checkCoord(79);" class="area test" shape="circle" coords="576,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area80" onclick="return checkCoord(80);" class="area test" shape="circle" coords="577,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area81" onclick="return checkCoord(81);" class="area test" shape="circle" coords="572,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area82" onclick="return checkCoord(82);" class="area test" shape="circle" coords="572,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area83" onclick="return checkCoord(83);" class="area test" shape="circle" coords="572,129,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area84" onclick="return checkCoord(84);" class="area test" shape="circle" coords="577,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area85" onclick="return checkCoord(85);" class="area test" shape="circle" coords="577,154,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area86" onclick="return checkCoord(86);" class="area test" shape="circle" coords="577,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area87" onclick="return checkCoord(87);" class="area test" shape="circle" coords="591,79,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area88" onclick="return checkCoord(88);" class="area test" shape="circle" coords="591,85,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area89" onclick="return checkCoord(89);" class="area test" shape="circle" coords="591,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area90" onclick="return checkCoord(90);" class="area test" shape="circle" coords="584,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area91" onclick="return checkCoord(91);" class="area test" shape="circle" coords="585,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area92" onclick="return checkCoord(92);" class="area test" shape="circle" coords="586,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area93" onclick="return checkCoord(93);" class="area test" shape="circle" coords="589,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area94" onclick="return checkCoord(94);" class="area test" shape="circle" coords="589,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area95" onclick="return checkCoord(95);" class="area test" shape="circle" coords="589,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area96" onclick="return checkCoord(96);" class="area test" shape="circle" coords="603,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area97" onclick="return checkCoord(97);" class="area test" shape="circle" coords="604,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area98" onclick="return checkCoord(98);" class="area test" shape="circle" coords="604,94,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area99" onclick="return checkCoord(99);" class="area test" shape="circle" coords="598,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area100" onclick="return checkCoord(100);" class="area test" shape="circle" coords="598,121,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area101" onclick="return checkCoord(101);" class="area test" shape="circle" coords="598,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area102" onclick="return checkCoord(102);" class="area test" shape="circle" coords="604,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area103" onclick="return checkCoord(103);" class="area test" shape="circle" coords="603,156,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area104" onclick="return checkCoord(104);" class="area test" shape="circle" coords="603,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area105" onclick="return checkCoord(105);" class="area test" shape="circle" coords="617,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area106" onclick="return checkCoord(106);" class="area test" shape="circle" coords="617,85,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area107" onclick="return checkCoord(107);" class="area test" shape="circle" coords="617,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area108" onclick="return checkCoord(108);" class="area test" shape="circle" coords="612,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area109" onclick="return checkCoord(109);" class="area test" shape="circle" coords="613,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area110" onclick="return checkCoord(110);" class="area test" shape="circle" coords="612,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area111" onclick="return checkCoord(111);" class="area test" shape="circle" coords="616,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area112" onclick="return checkCoord(112);" class="area test" shape="circle" coords="616,156,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area113" onclick="return checkCoord(113);" class="area test" shape="circle" coords="616,164,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area114" onclick="return checkCoord(114);" class="area test" shape="circle" coords="631,79,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area115" onclick="return checkCoord(115);" class="area test" shape="circle" coords="631,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area116" onclick="return checkCoord(116);" class="area test" shape="circle" coords="631,94,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area117" onclick="return checkCoord(117);" class="area test" shape="circle" coords="624,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area118" onclick="return checkCoord(118);" class="area test" shape="circle" coords="625,121,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area119" onclick="return checkCoord(119);" class="area test" shape="circle" coords="624,129,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area120" onclick="return checkCoord(120);" class="area test" shape="circle" coords="629,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area121" onclick="return checkCoord(121);" class="area test" shape="circle" coords="629,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area122" onclick="return checkCoord(122);" class="area test" shape="circle" coords="631,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area123" onclick="return checkCoord(123);" class="area test" shape="circle" coords="643,76,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area124" onclick="return checkCoord(124);" class="area test" shape="circle" coords="643,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area125" onclick="return checkCoord(125);" class="area test" shape="circle" coords="643,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area126" onclick="return checkCoord(126);" class="area test" shape="circle" coords="639,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area127" onclick="return checkCoord(127);" class="area test" shape="circle" coords="638,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area128" onclick="return checkCoord(128);" class="area test" shape="circle" coords="639,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area129" onclick="return checkCoord(129);" class="area test" shape="circle" coords="643,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area130" onclick="return checkCoord(130);" class="area test" shape="circle" coords="645,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area131" onclick="return checkCoord(131);" class="area test" shape="circle" coords="644,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area132" onclick="return checkCoord(132);" class="area test" shape="circle" coords="658,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area133" onclick="return checkCoord(133);" class="area test" shape="circle" coords="658,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area134" onclick="return checkCoord(134);" class="area test" shape="circle" coords="658,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area135" onclick="return checkCoord(135);" class="area test" shape="circle" coords="653,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area136" onclick="return checkCoord(136);" class="area test" shape="circle" coords="652,120,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area137" onclick="return checkCoord(137);" class="area test" shape="circle" coords="651,110,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area138" onclick="return checkCoord(138);" class="area test" shape="circle" coords="658,75,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area139" onclick="return checkCoord(139);" class="area test" shape="circle" coords="657,85,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area140" onclick="return checkCoord(140);" class="area test" shape="circle" coords="657,94,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area141" onclick="return checkCoord(141);" class="area test" shape="circle" coords="669,76,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area142" onclick="return checkCoord(142);" class="area test" shape="circle" coords="671,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area143" onclick="return checkCoord(143);" class="area test" shape="circle" coords="672,94,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area144" onclick="return checkCoord(144);" class="area test" shape="circle" coords="666,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area145" onclick="return checkCoord(145);" class="area test" shape="circle" coords="666,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area146" onclick="return checkCoord(146);" class="area test" shape="circle" coords="666,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area147" onclick="return checkCoord(147);" class="area test" shape="circle" coords="672,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area148" onclick="return checkCoord(148);" class="area test" shape="circle" coords="671,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area149" onclick="return checkCoord(149);" class="area test" shape="circle" coords="672,163,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area150" onclick="return checkCoord(150);" class="area test" shape="circle" coords="684,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area151" onclick="return checkCoord(151);" class="area test" shape="circle" coords="685,85,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area152" onclick="return checkCoord(152);" class="area test" shape="circle" coords="685,94,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area153" onclick="return checkCoord(153);" class="area test" shape="circle" coords="679,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area154" onclick="return checkCoord(154);" class="area test" shape="circle" coords="678,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area155" onclick="return checkCoord(155);" class="area test" shape="circle" coords="678,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area156" onclick="return checkCoord(156);" class="area test" shape="circle" coords="685,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area157" onclick="return checkCoord(157);" class="area test" shape="circle" coords="685,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area158" onclick="return checkCoord(158);" class="area test" shape="circle" coords="684,163,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area159" onclick="return checkCoord(159);" class="area test" shape="circle" coords="697,76,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area160" onclick="return checkCoord(160);" class="area test" shape="circle" coords="697,84,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area161" onclick="return checkCoord(161);" class="area test" shape="circle" coords="697,93,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area162" onclick="return checkCoord(162);" class="area test" shape="circle" coords="692,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area163" onclick="return checkCoord(163);" class="area test" shape="circle" coords="693,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area164" onclick="return checkCoord(164);" class="area test" shape="circle" coords="693,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area165" onclick="return checkCoord(165);" class="area test" shape="circle" coords="698,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area166" onclick="return checkCoord(166);" class="area test" shape="circle" coords="698,156,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area167" onclick="return checkCoord(167);" class="area test" shape="circle" coords="698,162,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area168" onclick="return checkCoord(168);" class="area test" shape="circle" coords="711,79,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area169" onclick="return checkCoord(169);" class="area test" shape="circle" coords="713,84,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area170" onclick="return checkCoord(170);" class="area test" shape="circle" coords="712,95,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area171" onclick="return checkCoord(171);" class="area test" shape="circle" coords="704,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area172" onclick="return checkCoord(172);" class="area test" shape="circle" coords="705,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area173" onclick="return checkCoord(173);" class="area test" shape="circle" coords="706,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area174" onclick="return checkCoord(174);" class="area test" shape="circle" coords="712,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area175" onclick="return checkCoord(175);" class="area test" shape="circle" coords="711,156,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area176" onclick="return checkCoord(176);" class="area test" shape="circle" coords="712,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area177" onclick="return checkCoord(177);" class="area test" shape="circle" coords="725,76,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area178" onclick="return checkCoord(178);" class="area test" shape="circle" coords="724,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area179" onclick="return checkCoord(179);" class="area test" shape="circle" coords="724,93,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area180" onclick="return checkCoord(180);" class="area test" shape="circle" coords="717,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area181" onclick="return checkCoord(181);" class="area test" shape="circle" coords="717,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area182" onclick="return checkCoord(182);" class="area test" shape="circle" coords="718,129,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area183" onclick="return checkCoord(183);" class="area test" shape="circle" coords="725,144,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area184" onclick="return checkCoord(184);" class="area test" shape="circle" coords="725,155,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area185" onclick="return checkCoord(185);" class="area test" shape="circle" coords="725,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area186" onclick="return checkCoord(186);" class="area test" shape="circle" coords="738,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area187" onclick="return checkCoord(187);" class="area test" shape="circle" coords="737,84,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area188" onclick="return checkCoord(188);" class="area test" shape="circle" coords="737,92,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area189" onclick="return checkCoord(189);" class="area test" shape="circle" coords="737,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area190" onclick="return checkCoord(190);" class="area test" shape="circle" coords="737,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area191" onclick="return checkCoord(191);" class="area test" shape="circle" coords="738,165,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area192" onclick="return checkCoord(192);" class="area test" shape="circle" coords="799,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area193" onclick="return checkCoord(193);" class="area test" shape="circle" coords="799,85,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area194" onclick="return checkCoord(194);" class="area test" shape="circle" coords="799,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area195" onclick="return checkCoord(195);" class="area test" shape="circle" coords="793,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area196" onclick="return checkCoord(196);" class="area test" shape="circle" coords="793,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area197" onclick="return checkCoord(197);" class="area test" shape="circle" coords="794,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area198" onclick="return checkCoord(198);" class="area test" shape="circle" coords="799,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area199" onclick="return checkCoord(199);" class="area test" shape="circle" coords="801,155,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area200" onclick="return checkCoord(200);" class="area test" shape="circle" coords="798,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area201" onclick="return checkCoord(201);" class="area test" shape="circle" coords="812,76,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area202" onclick="return checkCoord(202);" class="area test" shape="circle" coords="812,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area203" onclick="return checkCoord(203);" class="area test" shape="circle" coords="811,93,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area204" onclick="return checkCoord(204);" class="area test" shape="circle" coords="806,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area205" onclick="return checkCoord(205);" class="area test" shape="circle" coords="806,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area206" onclick="return checkCoord(206);" class="area test" shape="circle" coords="807,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area207" onclick="return checkCoord(207);" class="area test" shape="circle" coords="813,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area208" onclick="return checkCoord(208);" class="area test" shape="circle" coords="813,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area209" onclick="return checkCoord(209);" class="area test" shape="circle" coords="813,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area210" onclick="return checkCoord(210);" class="area test" shape="circle" coords="827,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area211" onclick="return checkCoord(211);" class="area test" shape="circle" coords="826,85,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area212" onclick="return checkCoord(212);" class="area test" shape="circle" coords="825,94,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area213" onclick="return checkCoord(213);" class="area test" shape="circle" coords="819,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area214" onclick="return checkCoord(214);" class="area test" shape="circle" coords="819,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area215" onclick="return checkCoord(215);" class="area test" shape="circle" coords="819,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area216" onclick="return checkCoord(216);" class="area test" shape="circle" coords="826,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area217" onclick="return checkCoord(217);" class="area test" shape="circle" coords="826,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area218" onclick="return checkCoord(218);" class="area test" shape="circle" coords="825,162,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area219" onclick="return checkCoord(219);" class="area test" shape="circle" coords="838,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area220" onclick="return checkCoord(220);" class="area test" shape="circle" coords="841,87,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area221" onclick="return checkCoord(221);" class="area test" shape="circle" coords="841,94,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area222" onclick="return checkCoord(222);" class="area test" shape="circle" coords="833,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area223" onclick="return checkCoord(223);" class="area test" shape="circle" coords="833,122,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area224" onclick="return checkCoord(224);" class="area test" shape="circle" coords="841,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area225" onclick="return checkCoord(225);" class="area test" shape="circle" coords="839,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area226" onclick="return checkCoord(226);" class="area test" shape="circle" coords="839,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area227" onclick="return checkCoord(227);" class="area test" shape="circle" coords="854,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area228" onclick="return checkCoord(228);" class="area test" shape="circle" coords="853,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area229" onclick="return checkCoord(229);" class="area test" shape="circle" coords="853,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area230" onclick="return checkCoord(230);" class="area test" shape="circle" coords="848,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area231" onclick="return checkCoord(231);" class="area test" shape="circle" coords="847,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area232" onclick="return checkCoord(232);" class="area test" shape="circle" coords="847,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area233" onclick="return checkCoord(233);" class="area test" shape="circle" coords="854,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area234" onclick="return checkCoord(234);" class="area test" shape="circle" coords="855,152,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area235" onclick="return checkCoord(235);" class="area test" shape="circle" coords="853,164,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area236" onclick="return checkCoord(236);" class="area test" shape="circle" coords="866,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area237" onclick="return checkCoord(237);" class="area test" shape="circle" coords="866,85,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area238" onclick="return checkCoord(238);" class="area test" shape="circle" coords="867,93,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area239" onclick="return checkCoord(239);" class="area test" shape="circle" coords="858,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area240" onclick="return checkCoord(240);" class="area test" shape="circle" coords="861,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area241" onclick="return checkCoord(241);" class="area test" shape="circle" coords="861,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area242" onclick="return checkCoord(242);" class="area test" shape="circle" coords="867,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area243" onclick="return checkCoord(243);" class="area test" shape="circle" coords="866,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area244" onclick="return checkCoord(244);" class="area test" shape="circle" coords="868,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area245" onclick="return checkCoord(245);" class="area test" shape="circle" coords="881,79,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area246" onclick="return checkCoord(246);" class="area test" shape="circle" coords="881,85,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area247" onclick="return checkCoord(247);" class="area test" shape="circle" coords="879,94,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area248" onclick="return checkCoord(248);" class="area test" shape="circle" coords="873,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area249" onclick="return checkCoord(249);" class="area test" shape="circle" coords="873,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area250" onclick="return checkCoord(250);" class="area test" shape="circle" coords="874,130,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area251" onclick="return checkCoord(251);" class="area test" shape="circle" coords="879,147,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area252" onclick="return checkCoord(252);" class="area test" shape="circle" coords="881,156,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area253" onclick="return checkCoord(253);" class="area test" shape="circle" coords="881,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area254" onclick="return checkCoord(254);" class="area test" shape="circle" coords="895,77,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area255" onclick="return checkCoord(255);" class="area test" shape="circle" coords="896,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area256" onclick="return checkCoord(256);" class="area test" shape="circle" coords="895,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area257" onclick="return checkCoord(257);" class="area test" shape="circle" coords="887,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area258" onclick="return checkCoord(258);" class="area test" shape="circle" coords="887,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area259" onclick="return checkCoord(259);" class="area test" shape="circle" coords="887,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area260" onclick="return checkCoord(260);" class="area test" shape="circle" coords="895,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area261" onclick="return checkCoord(261);" class="area test" shape="circle" coords="895,156,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area262" onclick="return checkCoord(262);" class="area test" shape="circle" coords="895,163,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area263" onclick="return checkCoord(263);" class="area test" shape="circle" coords="908,78,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area264" onclick="return checkCoord(264);" class="area test" shape="circle" coords="908,86,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area265" onclick="return checkCoord(265);" class="area test" shape="circle" coords="908,96,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area267" onclick="return checkCoord(267);" class="area test" shape="circle" coords="899,111,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area268" onclick="return checkCoord(268);" class="area test" shape="circle" coords="900,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area269" onclick="return checkCoord(269);" class="area test" shape="circle" coords="900,128,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area270" onclick="return checkCoord(270);" class="area test" shape="circle" coords="907,145,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area271" onclick="return checkCoord(271);" class="area test" shape="circle" coords="907,156,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area272" onclick="return checkCoord(272);" class="area test" shape="circle" coords="907,165,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area273" onclick="return checkCoord(273);" class="area test" shape="circle" coords="921,76,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area274" onclick="return checkCoord(274);" class="area test" shape="circle" coords="920,85,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area275" onclick="return checkCoord(275);" class="area test" shape="circle" coords="920,96,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area276" onclick="return checkCoord(276);" class="area test" shape="circle" coords="913,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area277" onclick="return checkCoord(277);" class="area test" shape="circle" coords="914,120,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area278" onclick="return checkCoord(278);" class="area test" shape="circle" coords="914,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area279" onclick="return checkCoord(279);" class="area test" shape="circle" coords="921,147,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area280" onclick="return checkCoord(280);" class="area test" shape="circle" coords="921,155,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area281" onclick="return checkCoord(281);" class="area test" shape="circle" coords="921,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area282" onclick="return checkCoord(282);" class="area test" shape="circle" coords="934,78,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area283" onclick="return checkCoord(283);" class="area test" shape="circle" coords="935,87,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area284" onclick="return checkCoord(284);" class="area test" shape="circle" coords="935,97,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area285" onclick="return checkCoord(285);" class="area test" shape="circle" coords="928,112,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area286" onclick="return checkCoord(286);" class="area test" shape="circle" coords="928,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area287" onclick="return checkCoord(287);" class="area test" shape="circle" coords="928,129,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area288" onclick="return checkCoord(288);" class="area test" shape="circle" coords="934,147,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area289" onclick="return checkCoord(289);" class="area test" shape="circle" coords="934,154,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area290" onclick="return checkCoord(290);" class="area test" shape="circle" coords="935,163,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area291" onclick="return checkCoord(291);" class="area test" shape="circle" coords="947,78,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area292" onclick="return checkCoord(292);" class="area test" shape="circle" coords="947,88,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area293" onclick="return checkCoord(293);" class="area test" shape="circle" coords="947,95,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area294" onclick="return checkCoord(294);" class="area test" shape="circle" coords="941,110,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area295" onclick="return checkCoord(295);" class="area test" shape="circle" coords="940,121,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area296" onclick="return checkCoord(296);" class="area test" shape="circle" coords="940,132,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area297" onclick="return checkCoord(297);" class="area test" shape="circle" coords="946,146,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area298" onclick="return checkCoord(298);" class="area test" shape="circle" coords="948,155,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area299" onclick="return checkCoord(299);" class="area test" shape="circle" coords="948,164,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area300" onclick="return checkCoord(300);" class="area test" shape="circle" coords="961,78,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area301" onclick="return checkCoord(301);" class="area test" shape="circle" coords="961,87,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area302" onclick="return checkCoord(302);" class="area test" shape="circle" coords="961,98,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area303" onclick="return checkCoord(303);" class="area test" shape="circle" coords="954,112,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area304" onclick="return checkCoord(304);" class="area test" shape="circle" coords="955,121,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area305" onclick="return checkCoord(305);" class="area test" shape="circle" coords="955,130,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area306" onclick="return checkCoord(306);" class="area test" shape="circle" coords="960,146,3" />
                    <area alt="" title="" href="#" state="AD" data-statename="" id="area307" onclick="return checkCoord(307);" class="area test" shape="circle" coords="960,154,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area308" onclick="return checkCoord(308);" class="area test" shape="circle" coords="961,163,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area309" onclick="return checkCoord(309);" class="area test" shape="circle" coords="974,161,3" />
                    <area alt="" title="" href="#" state="AS" data-statename="" id="area310" onclick="return checkCoord(310);" class="area test" shape="circle" coords="972,151,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area311" onclick="return checkCoord(311);" class="area test" shape="circle" coords="974,80,3" />
                    <area alt="" title="" href="#" state="AC" data-statename="" id="area312" onclick="return checkCoord(312);" class="area test" shape="circle" coords="973,89,3" />
                </map>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Interior Appereance - Seat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th style="width: 10px">No.</th>
                      <th>Item</th>
                      <th colspan="2">Average</th>
                    </tr>
                    
                    <?php
                        $tag_html = '';
                        $list_reg = array(
                                            'Seat Cover' => array('95'),
                                            'Seat Cushion' => array('50'),
                                            'Ottoman (Foot Rest)' => array('95'),
                                            'Seat Belt' => array('60'),
                                            'Amrest set' => array('70'),
                                            'folding Table' => array('95'),
                                            'Table Compartment' => array('99'),
                                            'Literature Pocket' => array('60'),
                                            'Snake Light' => array('100'),
                                            'Shell & Bumper' => array('95'),
                                            'Video Monitor' => array('100'),
                                            'Pax. Control Unit' => array('95'),
                                            'IFE Control' => array('100')
                                         );
                        $i = 1;
                        $progress = '';
                        foreach($list_reg as $key => $value ){
                            
                            foreach($value as $key2 => $value2 ){
                            
                                if($value2 >= 80){
                                    $progress = 'success';
                                    $bg = 'green';
                                }elseif($value2 <= 80 AND $value2 >= 60){
                                    $progress = 'warning';
                                    $bg = 'yellow';
                                }elseif($value2 <= 60 ){
                                    $progress = 'danger';
                                    $bg = 'red';
                                }
                            
                                echo '<tr>
                                      <td>'. $i .'</td>
                                      <td style="width:200px;">'. $key .'</td>
                                      <td style="width:200px;">
                                        <div class="progress progress-xs">
                                          <div class="progress-bar progress-bar-'. $progress .'" style="width: '. $value2 .'%"></div>
                                        </div>
                                      </td>
                                      <td style="text-align: center; width:50px;">
                                        <span class="badge bg-'. $bg .'">'. $value2 .'</span>                                        
                                      </td>
                                    </tr>';
                            
                            }
                            $i++;
                        }
                    ?>
                    
                  </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-3">
            <a href="<?php echo base_url("/health_view/interior/" . url_title('AIRBUS-330') .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-blue">
                <i class="fa fa-chevron-circle-right"></i> Seat
            </a>
            <a href="<?php echo base_url('#'); ?>" class="btn btn-lg btn-block btn-social bg-green">
                <i class="fa fa-chevron-circle-right"></i> Galley
            </a>
            <a href="<?php echo base_url('#'); ?>" class="btn btn-lg btn-block btn-social bg-green">
                <i class="fa fa-chevron-circle-right"></i> Lavatory
            </a>
            <a href="<?php echo base_url("/health_view/interior_seatcover/" . url_title('AIRBUS-330') .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-red">
                <i class="fa fa-chevron-circle-right"></i> Seat Cover
            </a>
            <a href="<?php echo base_url("/health_view/interior_carpet/" . url_title('AIRBUS-330') .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-red">
                <i class="fa fa-chevron-circle-right"></i> Carpet
            </a>
        </div>
    </div>
  
</section>

<script type="text/javascript">

</script