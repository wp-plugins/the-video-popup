<?php
header("Content-Type: text/css");
$changedDir = '';
if (!$changedDir)$changedDir = preg_replace('|wp-content.*$|','', __FILE__);
include_once($changedDir.'/wp-load.php');
$toget=array('tvpp_width'=>'420px','tvpp_height'=>'325px','tvpp_bgcolor'=>'#ffffff','tvpp_bordercolor'=>'#000000');
if($toget)
{
	foreach($toget as $key=>$value)
	{
	$$key=(get_option($key))? get_option($key):$value;
	}
}

?>

.tvpp_popup{



 background-color: <?php echo $tvpp_bgcolor;?>;

    border: 2px solid <?php echo $tvpp_bordercolor;?>;

   border-radius: 5px 5px 5px 0;

    bottom: -2px;

    float: right;

    height: <?php echo $tvpp_height;?>;

    position: fixed;

    right: -400px;

    width: <?php echo $tvpp_width;?>;

}



.tvpp_popup_close{

  background-image: url("minus.png");

    color: #FF0000;

    cursor: pointer;

    display: inline;

    height: 16px;

    left: 3px;

    position: absolute;

    text-decoration: none;

    text-indent: -999em;

    top: 5px;

    width: 16px;

}

.tvpp_popup_max

{

	 background-image: url("plus.png");

	color: #FF0000;

    cursor: pointer;

    display: inline;

    height: 16px;

    left: 3px;

    position: absolute;

    text-decoration: none;

    text-indent: -999em;

    top: 5px;

    width: 16px;

	display:none;

}



/*------------------------------------......Popup-Css-Close.....---------------------------*/







.tvpp_popup_heading{



 font-family: Verdana;



    font-size: 13px;



    line-height: 20px;



    margin-top: 15px;



    padding: 10px;



}