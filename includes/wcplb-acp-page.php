<script>
function wcplb_LabelOpacity_SliderChange(val)
{ document.getElementById('optLabelOpacity').value = val; 
  document.getElementById('optOpacityLabelId').innerHTML = val+'%';
}
    
function wcplb_BadgeOpacity_SliderChange(val,section)
{ switch(section)
        { case 'new':
               document.getElementById('optBadgeOpacity_new').value = val; 
               document.getElementById('optOpacityBadgeId_new').innerHTML = val+'%';
               break;

         case 'featured':
               document.getElementById('optBadgeOpacity_featured').value = val; 
               document.getElementById('optOpacityBadgeId_featured').innerHTML = val+'%';
               break;
               
          case 'sold':
               document.getElementById('optBadgeOpacity_sold').value = val; 
               document.getElementById('optOpacityBadgeId_sold').innerHTML = val+'%';
               break;

          case 'top':
               document.getElementById('optBadgeOpacity_top').value = val; 
               document.getElementById('optOpacityBadgeId_top').innerHTML = val+'%';
               break;

          case 'quantity':
               document.getElementById('optBadgeOpacity_quantity').value = val; 
               document.getElementById('optOpacityBadgeId_quantity').innerHTML = val+'%';
               break;          
               
          case 'cat':
               document.getElementById('optBadgeOpacity_cat').value = val; 
               document.getElementById('optOpacityBadgeId_cat').innerHTML = val+'%';
               break;
        }
}

function wcplb_ShowLabels()
{ var show = document.getElementById("divAllLabels");
  if (show.style.display === "none") {
    show.style.display = "block";
  } else {
    show.style.display = "none";
  }
}

function RB_UseCatColor_Change()
{ if (document.getElementById('optUseCatColor').checked)
     { document.getElementById("LabelBackgroundColor").style.display = "none";
     }
  else
     { document.getElementById("LabelBackgroundColor").style.display = "block";
     }
}

jQuery(document).ready(function($)
{ $(".all-labels").click(function()
   { $('img',this).toggle();
   });
});
</script>


<?php
$tmpStr = plugin_dir_path( __DIR__ );
if (substr($tmpStr,-1) == "/")
   $tmpPos = strrpos($tmpStr,'/',-2);
else    
   $tmpPos = strrpos($tmpStr,'/',-1);
$cssName = "wcplb.css";
$tmpStrPathDynamic = substr($tmpStr,0,$tmpPos) . '/' . WCPLB_PLUGIN_SLUG . '/custom';
$savePathCSS = $tmpStrPathDynamic . "/" . $cssName;
$PathFont = substr($tmpStr,0,$tmpPos) . '/' . WCPLB_PLUGIN_SLUG . '/fonts/';  
  
$wcplb_CurrentVersion = get_option('wcplbCurrentVersion');
$wcplb_CurrentType = get_option('wcplbCurrentType');

$opt_LabelType = get_option('optLabelType'); if ((!isset($opt_LabelType)) or ($opt_LabelType == "")) $opt_LabelType = "ImageLabel";
$opt_ShowLabelSingle = get_option('optShowLabelSingle'); if (!isset($opt_ShowLabelSingle)) $opt_ShowLabelSingle = 1;
$opt_ShowLabelShop = get_option('optShowLabelShop'); if (!isset($opt_ShowLabelShop)) $opt_ShowLabelShop = 1;

$opt_BadgeType = get_option('optBadgeType'); if ((!isset($opt_BadgeType)) or ($opt_BadgeType == "")) $opt_BadgeType = "ImageBadge";
$opt_ShowBadgeSingle = get_option('optShowBadgeSingle'); if (!isset($opt_ShowBadgeSingle)) $opt_ShowBadgeSingle = 1;
$opt_ShowBadgeShop = get_option('optShowBadgeShop'); if (!isset($opt_ShowBadgeShop)) $opt_ShowBadgeShop = 1;

$opt_LabelName = get_option('optLabelName'); if ($opt_LabelName == "") $opt_LabelName = "Label";
$opt_UseCatColor = get_option('optUseCatColor');
$opt_LabelColor = get_option('optLabelColor'); if ($opt_LabelColor == "") $opt_LabelColor = "#808080";
$opt_LabelPatternColor = get_option('optLabelPatternColor'); if ($opt_LabelPatternColor == "") $opt_LabelPatternColor = "#ffffff";
$opt_LabelOpacity = get_option('optLabelOpacity'); if ($opt_LabelOpacity == "") $opt_LabelOpacity = "75";
$opt_LabelFont = get_option('optLabelFont');
$opt_LabelFontColor = get_option('optLabelFontColor'); if ($opt_LabelFontColor == "") $opt_LabelFontColor = "#ffffff";

$opt_LabelMainInfo = get_option('optLabelMainInfo'); if (!isset($opt_LabelMainInfo)) $opt_LabelMainInfo = "Percent";
$opt_LabelMain_X = get_option('optLabelMain_X'); if ($opt_LabelMain_X == "") $opt_LabelMain_X = "0";
$opt_LabelMain_Y = get_option('optLabelMain_Y'); if ($opt_LabelMain_Y == "") $opt_LabelMain_Y = "0";

$opt_LabelSecondInfo = get_option('optLabelSecondInfo'); if (!isset($opt_LabelSecondInfo)) $opt_LabelSecondInfo = 1;
$opt_LabelSecond_X = get_option('optLabelSecond_X'); if ($opt_LabelSecond_X == "") $opt_LabelSecond_X = "0";
$opt_LabelSecond_Y = get_option('optLabelSecond_Y'); if ($opt_LabelSecond_Y == "") $opt_LabelSecond_Y = "0";

$opt_LabelShopFrom =   get_option('optLabelShopFrom'); if ($opt_LabelShopFrom == "") $opt_LabelShopFrom = "left";
$opt_LabelShop_X = get_option('optLabelShop_X'); if ($opt_LabelShop_X == "") $opt_LabelShop_X = "-5";
$opt_LabelShop_Y = get_option('optLabelShop_Y'); if ($opt_LabelShop_Y == "") $opt_LabelShop_Y = "-15";
$opt_LabelProductFrom =   get_option('optLabelProductFrom'); if ($opt_LabelProductFrom == "") $opt_LabelProductFrom = "left";
$opt_LabelProduct_X = get_option('optLabelProduct_X'); if ($opt_LabelProduct_X == "") $opt_LabelProduct_X = "-5";
$opt_LabelProduct_Y = get_option('optLabelProduct_Y'); if ($opt_LabelProduct_Y == "") $opt_LabelProduct_Y = "-15";

$opt_ShopText_X = get_option('optShopText_X'); if ($opt_ShopText_X == "") $opt_ShopText_X = "0";
$opt_ShopText_Y = get_option('optShopText_Y'); if ($opt_ShopText_Y == "") $opt_ShopText_Y = "0";

$opt_BadgeUse_featured = get_option('optBadgeUse_featured');
$opt_BadgeName_featured = get_option('optBadgeName_featured'); if ($opt_BadgeName_featured == "") $opt_BadgeName_featured = "Ribbon";
$opt_BadgeColor_featured = get_option('optBadgeColor_featured'); if ($opt_BadgeColor_featured == "") $opt_BadgeColor_featured = "#808080";
$opt_BadgePatternColor_featured = get_option('optBadgePatternColor_featured'); if ($opt_BadgePatternColor_featured == "") $opt_BadgePatternColor_featured = "#ffffff";
$opt_BadgeOpacity_featured = get_option('optBadgeOpacity_featured'); if ($opt_BadgeOpacity_featured == "") $opt_BadgeOpacity_featured = "75";
$opt_BadgeProductFrom_featured =   get_option('optBadgeProductFrom_featured'); if ($opt_BadgeProductFrom_featured == "") $opt_BadgeProductFrom_featured = "left";
$opt_BadgeProduct_X_featured = get_option('optBadgeProduct_X_featured'); if ($opt_BadgeProduct_X_featured == "") $opt_BadgeProduct_X_featured = "100";
$opt_BadgeProduct_Y_featured = get_option('optBadgeProduct_Y_featured'); if ($opt_BadgeProduct_Y_featured == "") $opt_BadgeProduct_Y_featured = "-15";
$opt_BadgeShopFrom_featured =   get_option('optBadgeShopFrom_featured'); if ($opt_BadgeShopFrom_featured == "") $opt_BadgeShopFrom_featured = "top_right";
$opt_BadgeShop_X_featured = get_option('optBadgeShop_X_featured'); if ($opt_BadgeShop_X_featured == "") $opt_BadgeShop_X_featured = "50";
$opt_BadgeShop_Y_featured = get_option('optBadgeShop_Y_featured'); if ($opt_BadgeShop_Y_featured == "") $opt_BadgeShop_Y_featured = "-15";
$opt_BadgeText_featured = get_option('optBadgeText_featured'); if ($opt_BadgeText_featured == "") $opt_BadgeText_featured = "...";
$opt_BadgeFontTextbox_featured = get_option('optBadgeFontTextbox_featured');
$opt_BadgeFontImage_featured = get_option('optBadgeFontImage_featured');
$opt_BadgeFontSize_featured = get_option('optBadgeFontSize_featured'); if ($opt_BadgeFontSize_featured == "") $opt_BadgeFontSize_featured = "30";
$opt_BadgeFontColor_featured = get_option('optBadgeFontColor_featured'); if ($opt_BadgeFontColor_featured == "") $opt_BadgeFontColor_featured = "#ffffff";
$opt_BadgeTextDir_featured = get_option('optBadgeTextDir_featured'); if ($opt_BadgeTextDir_featured == "") $opt_BadgeTextDir_featured = "TtoB";

$opt_BadgeNewDays = get_option('optBadgeNewDays'); if ($opt_BadgeNewDays == "") $opt_BadgeNewDays = "15";
$opt_BadgeUse_new = get_option('optBadgeUse_new');
$opt_BadgeName_new = get_option('optBadgeName_new'); if ($opt_BadgeName_new == "") $opt_BadgeName_new = "Ribbon";
$opt_BadgeColor_new = get_option('optBadgeColor_new'); if ($opt_BadgeColor_new == "") $opt_BadgeColor_new = "#808080";
$opt_BadgePatternColor_new = get_option('optBadgePatternColor_new'); if ($opt_BadgePatternColor_new == "") $opt_BadgePatternColor_new = "#ffffff";
$opt_BadgeOpacity_new = get_option('optBadgeOpacity_new'); if ($opt_BadgeOpacity_new == "") $opt_BadgeOpacity_new = "75";
$opt_BadgeProductFrom_new =   get_option('optBadgeProductFrom_new'); if ($opt_BadgeProductFrom_new == "") $opt_BadgeProductFrom_new = "left";
$opt_BadgeProduct_X_new = get_option('optBadgeProduct_X_new'); if ($opt_BadgeProduct_X_new == "") $opt_BadgeProduct_X_new = "100";
$opt_BadgeProduct_Y_new = get_option('optBadgeProduct_Y_new'); if ($opt_BadgeProduct_Y_new == "") $opt_BadgeProduct_Y_new = "-15";
$opt_BadgeShopFrom_new =   get_option('optBadgeShopFrom_new'); if ($opt_BadgeShopFrom_new == "") $opt_BadgeShopFrom_new = "top_right";
$opt_BadgeShop_X_new = get_option('optBadgeShop_X_new'); if ($opt_BadgeShop_X_new == "") $opt_BadgeShop_X_new = "50";
$opt_BadgeShop_Y_new = get_option('optBadgeShop_Y_new'); if ($opt_BadgeShop_Y_new == "") $opt_BadgeShop_Y_new = "-15";
$opt_BadgeText_new = get_option('optBadgeText_new'); if ($opt_BadgeText_new == "") $opt_BadgeText_new = "...";
$opt_BadgeFontTextbox_new = get_option('optBadgeFontTextbox_new');
$opt_BadgeFontImage_new = get_option('optBadgeFontImage_new');
$opt_BadgeFontSize_new = get_option('optBadgeFontSize_new'); if ($opt_BadgeFontSize_new == "") $opt_BadgeFontSize_new = "30";
$opt_BadgeFontColor_new = get_option('optBadgeFontColor_new'); if ($opt_BadgeFontColor_new == "") $opt_BadgeFontColor_new = "#ffffff";
$opt_BadgeTextDir_new = get_option('optBadgeTextDir_new'); if ($opt_BadgeTextDir_new == "") $opt_BadgeTextDir_new = "TtoB";

$opt_BadgeUse_sold = get_option('optBadgeUse_sold');
$opt_BadgeName_sold = get_option('optBadgeName_sold'); if ($opt_BadgeName_sold == "") $opt_BadgeName_sold = "Ribbon";
$opt_BadgeColor_sold = get_option('optBadgeColor_sold'); if ($opt_BadgeColor_sold == "") $opt_BadgeColor_sold = "#808080";
$opt_BadgePatternColor_sold = get_option('optBadgePatternColor_sold'); if ($opt_BadgePatternColor_sold == "") $opt_BadgePatternColor_sold = "#ffffff";
$opt_BadgeOpacity_sold = get_option('optBadgeOpacity_sold'); if ($opt_BadgeOpacity_sold == "") $opt_BadgeOpacity_sold = "75";
$opt_BadgeProductFrom_sold =   get_option('optBadgeProductFrom_sold'); if ($opt_BadgeProductFrom_sold == "") $opt_BadgeProductFrom_sold = "left";
$opt_BadgeProduct_X_sold = get_option('optBadgeProduct_X_sold'); if ($opt_BadgeProduct_X_sold == "") $opt_BadgeProduct_X_sold = "100";
$opt_BadgeProduct_Y_sold = get_option('optBadgeProduct_Y_sold'); if ($opt_BadgeProduct_Y_sold == "") $opt_BadgeProduct_Y_sold = "-15";
$opt_BadgeShopFrom_sold =   get_option('optBadgeShopFrom_sold'); if ($opt_BadgeShopFrom_sold == "") $opt_BadgeShopFrom_sold = "top_right";
$opt_BadgeShop_X_sold = get_option('optBadgeShop_X_sold'); if ($opt_BadgeShop_X_sold == "") $opt_BadgeShop_X_sold= "50";
$opt_BadgeShop_Y_sold = get_option('optBadgeShop_Y_sold'); if ($opt_BadgeShop_Y_sold == "") $opt_BadgeShop_Y_sold= "-15";
$opt_BadgeText_sold = get_option('optBadgeText_sold'); if ($opt_BadgeText_sold == "") $opt_BadgeText_sold = "...";
$opt_BadgeFontTextbox_sold = get_option('optBadgeFontTextbox_sold');
$opt_BadgeFontImage_sold = get_option('optBadgeFontImage_sold');
$opt_BadgeFontSize_sold = get_option('optBadgeFontSize_sold'); if ($opt_BadgeFontSize_sold == "") $opt_BadgeFontSize_sold = "30";
$opt_BadgeFontColor_sold = get_option('optBadgeFontColor_sold'); if ($opt_BadgeFontColor_sold == "") $opt_BadgeFontColor_sold = "#ffffff";
$opt_BadgeTextDir_sold = get_option('optBadgeTextDir_sold'); if ($opt_BadgeTextDir_sold == "") $opt_BadgeTextDir_sold = "TtoB";

$opt_BadgeNbBestSelling = get_option('optBadgeNbBestSelling'); if ($opt_BadgeNbBestSelling == "") $opt_BadgeNbBestSelling = "6";
$opt_BadgeBestSelling = "-";
$args = array(
     'post_type' => 'product',
     'meta_key' => 'total_sales',
     'orderby' => 'meta_value_num',
     'posts_per_page' => $opt_BadgeNbBestSelling,
);
$loop = new WP_Query($args);
while ($loop->have_posts()) : $loop->the_post(); 
global $product;
  $opt_BadgeBestSelling .= $product->get_id() . "-";
endwhile;
wp_reset_query();

$opt_BadgeUse_top = get_option('optBadgeUse_top');
$opt_BadgeName_top = get_option('optBadgeName_top'); if ($opt_BadgeName_top == "") $opt_BadgeName_top = "Ribbon";
$opt_BadgeColor_top = get_option('optBadgeColor_top'); if ($opt_BadgeColor_top == "") $opt_BadgeColor_top = "#808080";
$opt_BadgePatternColor_top = get_option('optBadgePatternColor_top'); if ($opt_BadgePatternColor_top == "") $opt_BadgePatternColor_top = "#ffffff";
$opt_BadgeOpacity_top = get_option('optBadgeOpacity_top'); if ($opt_BadgeOpacity_top == "") $opt_BadgeOpacity_top = "75";
$opt_BadgeProductFrom_top =   get_option('optBadgeProductFrom_top'); if ($opt_BadgeProductFrom_top == "") $opt_BadgeProductFrom_top = "left";
$opt_BadgeProduct_X_top = get_option('optBadgeProduct_X_top'); if ($opt_BadgeProduct_X_top == "") $opt_BadgeProduct_X_top = "100";
$opt_BadgeProduct_Y_top = get_option('optBadgeProduct_Y_top'); if ($opt_BadgeProduct_Y_top == "") $opt_BadgeProduct_Y_top = "-15";
$opt_BadgeShopFrom_top =   get_option('optBadgeShopFrom_top'); if ($opt_BadgeShopFrom_top == "") $opt_BadgeShopFrom_top = "top_right";
$opt_BadgeShop_X_top = get_option('optBadgeShop_X_top'); if ($opt_BadgeShop_X_top == "") $opt_BadgeShop_X_top= "50";
$opt_BadgeShop_Y_top = get_option('optBadgeShop_Y_top'); if ($opt_BadgeShop_Y_top == "") $opt_BadgeShop_Y_top= "-15";
$opt_BadgeText_top = get_option('optBadgeText_top'); if ($opt_BadgeText_top == "") $opt_BadgeText_top = "...";
$opt_BadgeFontTextbox_top = get_option('optBadgeFontTextbox_top');
$opt_BadgeFontImage_top = get_option('optBadgeFontImage_top');
$opt_BadgeFontSize_top = get_option('optBadgeFontSize_top'); if ($opt_BadgeFontSize_top == "") $opt_BadgeFontSize_top = "30";
$opt_BadgeFontColor_top = get_option('optBadgeFontColor_top'); if ($opt_BadgeFontColor_top == "") $opt_BadgeFontColor_top = "#ffffff";
$opt_BadgeTextDir_top = get_option('optBadgeTextDir_top'); if ($opt_BadgeTextDir_top == "") $opt_BadgeTextDir_top = "TtoB";

$opt_BadgeQuantity = get_option('optBadgeQuantity'); if ($opt_BadgeQuantity == "") $opt_BadgeQuantity = "5";
$opt_BadgeUse_quantity = get_option('optBadgeUse_quantity');
$opt_BadgeName_quantity = get_option('optBadgeName_quantity'); if ($opt_BadgeName_quantity == "") $opt_BadgeName_quantity = "Ribbon";
$opt_BadgeColor_quantity = get_option('optBadgeColor_quantity'); if ($opt_BadgeColor_quantity == "") $opt_BadgeColor_quantity = "#808080";
$opt_BadgePatternColor_quantity = get_option('optBadgePatternColor_quantity'); if ($opt_BadgePatternColor_quantity == "") $opt_BadgePatternColor_quantity = "#ffffff";
$opt_BadgeOpacity_quantity = get_option('optBadgeOpacity_quantity'); if ($opt_BadgeOpacity_quantity == "") $opt_BadgeOpacity_quantity = "75";
$opt_BadgeProductFrom_quantity =   get_option('optBadgeProductFrom_quantity'); if ($opt_BadgeProductFrom_quantity == "") $opt_BadgeProductFrom_quantity = "left";
$opt_BadgeProduct_X_quantity = get_option('optBadgeProduct_X_quantity'); if ($opt_BadgeProduct_X_quantity == "") $opt_BadgeProduct_X_quantity = "100";
$opt_BadgeProduct_Y_quantity = get_option('optBadgeProduct_Y_quantity'); if ($opt_BadgeProduct_Y_quantity == "") $opt_BadgeProduct_Y_quantity = "-15";
$opt_BadgeShopFrom_quantity =   get_option('optBadgeShopFrom_quantity'); if ($opt_BadgeShopFrom_quantity == "") $opt_BadgeShopFrom_quantity = "top_right";
$opt_BadgeShop_X_quantity = get_option('optBadgeShop_X_quantity'); if ($opt_BadgeShop_X_quantity == "") $opt_BadgeShop_X_quantity= "50";
$opt_BadgeShop_Y_quantity = get_option('optBadgeShop_Y_quantity'); if ($opt_BadgeShop_Y_quantity == "") $opt_BadgeShop_Y_quantity= "-15";
$opt_BadgeText_quantity = get_option('optBadgeText_quantity'); if ($opt_BadgeText_quantity == "") $opt_BadgeText_quantity = "...";
$opt_BadgeFontTextbox_quantity = get_option('optBadgeFontTextbox_quantity');
$opt_BadgeFontImage_quantity = get_option('optBadgeFontImage_quantity');
$opt_BadgeFontSize_quantity = get_option('optBadgeFontSize_quantity'); if ($opt_BadgeFontSize_quantity == "") $opt_BadgeFontSize_quantity = "30";
$opt_BadgeFontColor_quantity = get_option('optBadgeFontColor_quantity'); if ($opt_BadgeFontColor_quantity == "") $opt_BadgeFontColor_quantity = "#ffffff";
$opt_BadgeTextDir_quantity = get_option('optBadgeTextDir_quantity'); if ($opt_BadgeTextDir_quantity == "") $opt_BadgeTextDir_quantity = "TtoB";

$opt_BadgeUse_cat = get_option('optBadgeUse_cat');
$opt_BadgeName_cat = get_option('optBadgeName_cat'); if ($opt_BadgeName_cat == "") $opt_BadgeName_cat = "ArrowIn";
$opt_BadgeOpacity_cat = get_option('optBadgeOpacity_cat'); if ($opt_BadgeOpacity_cat == "") $opt_BadgeOpacity_cat = "75";
$opt_BadgeProductFrom_cat =   get_option('optBadgeProductFrom_cat'); if ($opt_BadgeProductFrom_cat == "") $opt_BadgeProductFrom_cat = "left";
$opt_BadgeProduct_X_cat = get_option('optBadgeProduct_X_cat'); if ($opt_BadgeProduct_X_cat == "") $opt_BadgeProduct_X_cat = "100";
$opt_BadgeProduct_Y_cat = get_option('optBadgeProduct_Y_cat'); if ($opt_BadgeProduct_Y_cat == "") $opt_BadgeProduct_Y_cat = "-15";
$opt_BadgeShopFrom_cat =   get_option('optBadgeShopFrom_cat'); if ($opt_BadgeShopFrom_cat == "") $opt_BadgeShopFrom_cat = "top_right";
$opt_BadgeShop_X_cat = get_option('optBadgeShop_X_cat'); if ($opt_BadgeShop_X_cat == "") $opt_BadgeShop_X_cat= "50";
$opt_BadgeShop_Y_cat = get_option('optBadgeShop_Y_cat'); if ($opt_BadgeShop_Y_cat == "") $opt_BadgeShop_Y_cat= "-15";
$opt_BadgeFontTextbox_cat = get_option('optBadgeFontTextbox_cat');
$opt_BadgeFontImage_cat = get_option('optBadgeFontImage_cat');
$opt_BadgeFontSize_cat = get_option('optBadgeFontSize_cat'); if ($opt_BadgeFontSize_cat == "") $opt_BadgeFontSize_cat = "30";
$opt_BadgeFontColor_cat = get_option('optBadgeFontColor_cat'); if ($opt_BadgeFontColor_cat == "") $opt_BadgeFontColor_cat = "#ffffff";
$opt_BadgeTextDir_cat = get_option('optBadgeTextDir_cat'); if ($opt_BadgeTextDir_cat == "") $opt_BadgeTextDir_cat = "TtoB";
$opt_CatAssoHideEmpty = get_option('optCatAssoHideEmpty');

$orderby = 'name';
$order = 'asc';
$hide_empty = false ;
$cat_args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty);
$product_categories = get_terms( 'product_cat', $cat_args );
$NbCat = count($product_categories);

if (!empty($product_categories))
   { foreach ($product_categories as $key => $category)
             { $tmpCatSlug = $category->slug;
               $tmpCatName = $category->name;
               $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
               $tmpOptColorCatName = 'optBadgeColor_cat_'.$tmpCatSlug;
               ${'opt_BadgeColor_cat_'.$tmpCatSlug} = get_option($tmpOptColorCatName); if (${'opt_BadgeColor_cat_'.$tmpCatSlug} == "") ${'opt_BadgeColor_cat_'.$tmpCatSlug} = "#fffffe";
               
               $tmpOptTextCatName = 'optBadgeText_cat_'.$tmpCatSlug;
               ${'opt_BadgeText_cat_'.$tmpCatSlug} = get_option($tmpOptTextCatName); if (${'opt_BadgeText_cat_'.$tmpCatSlug} == "") ${'opt_BadgeText_cat_'.$tmpCatSlug} = $tmpCatName;
             }
   }
   
$opt_CatAssoHierarchy = get_option('optCatAssoHierarchy');








$tmpVersionGD = "";
if (function_exists('gd_info'))
   { $A_InfoGD = gd_info();
     $tmpVersionGD = (empty($A_InfoGD['GD Version'])?"Not found!":$A_InfoGD['GD Version']);
   }
echo '<div align="right">' . esc_attr($wcplb_CurrentType) . ' Version v.' . esc_attr($wcplb_CurrentVersion) . ' - (GD Version: ' . esc_attr($tmpVersionGD)  . ')</div>';









function wcplb_LogFile($parMsg,$parNoticeType)
{ echo "<div class=\"notice notice-" . esc_attr($parNoticeType) . " is-dismissible\"><p>" . esc_attr($parMsg) . "</p></div>";
  
  $dir = plugin_dir_path( __DIR__ );
  $tmpPathLogFile = $dir . WCPLB_PLUGIN_SLUG . ".log";
  $handle = fopen($tmpPathLogFile,"a");
  if ($handle == false)
     { 
     }
  else
     { fwrite ($handle , date("D j M Y H:i:s", time()) . " - " . $parMsg . PHP_EOL); 
       fclose ($handle);
     }
}
require_once plugin_dir_path(__FILE__) . '/wcplb-draw-image.php';

$tmpTab = sanitize_text_field($_GET['tab']);
$tab = (isset($tmpTab) and $tmpTab != "")?$tmpTab:'wcplb_settings';
$tmpSection = sanitize_text_field($_GET['section']);
if($tab==='wcplb_set_badge')
  { $section = (isset($tmpSection) and $tmpSection != "")?$tmpSection:'new';
  }
if($tab==='wcplb_box')
  { $section = (isset($tmpSection) and $tmpSection != "")?$tmpSection:'metas';
  }
?>
<!-- Admin page content should all be inside .wrap -->
<div class="wrap">
<!-- Print the page title -->
<nav class="nav-tab-wrapper">
     <a href="?page=wcplb-acp&tab=wcplb_settings" class="nav-tab <?php if($tab==='wcplb_settings'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e('General Settings','next-wc-product-labels-badges'); ?></a>
     <a href="?page=wcplb-acp&tab=wcplb_set_label" class="nav-tab <?php if($tab==='wcplb_set_label'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e('Set labels','next-wc-product-labels-badges'); ?></a>
     <a href="?page=wcplb-acp&tab=wcplb_set_badge" class="nav-tab <?php if($tab==='wcplb_set_badge'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e('Set badges','next-wc-product-labels-badges'); ?></a>
</nav>

    <div class="tab-content">
    <?php switch($tab)
          { case 'wcplb_settings': ?> 
  
    <form method="post" action="options.php">
    <?php settings_fields('wcplb-settings-group'); ?>
    <?php do_settings_sections('wcplb-settings-group'); ?>

<h2 class="title"><?php esc_html_e('Labels','next-wc-product-labels-badges'); ?></h2>
<table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Type of label','next-wc-product-labels-badges'); ?></th>
        <td><input type="radio" name="optLabelType" value="TextBoxLabel" <?php echo($opt_LabelType=="TextBoxLabel"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Text box labels (Do NOT need GD library)','next-wc-product-labels-badges'); ?><br>
            <input type="radio" name="optLabelType" value="ImageLabel" <?php echo($opt_LabelType=="ImageLabel"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Image labels','next-wc-product-labels-badges'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Show labels','next-wc-product-labels-badges'); ?></th>
        <td><input type="checkbox" name="optShowLabelSingle" value=1 <?php echo($opt_ShowLabelSingle==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Display label on product page','next-wc-product-labels-badges'); ?>
            <br><input type="checkbox" name="optShowLabelShop" value=1 <?php echo($opt_ShowLabelShop==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Display label on shop page','next-wc-product-labels-badges'); ?>
        </td></tr>
</table>

<h2 class="title" style="display:inline;"><?php esc_html_e('Badges','next-wc-product-labels-badges'); ?></h2>
<table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Type of badge','next-wc-product-labels-badges'); ?></th>
        <td><input type="radio" name="optBadgeType" value="TextBoxBadge" <?php echo($opt_BadgeType=="TextBoxBadge"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Text box badges (Do NOT need GD library)','next-wc-product-labels-badges'); ?><br>
            <input type="radio" name="optBadgeType" value="ImageBadge" <?php echo($opt_BadgeType=="ImageBadge"?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Image badges','next-wc-product-labels-badges'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Show badges','next-wc-product-labels-badges'); ?></th>
        <td><input type="checkbox" name="optShowBadgeSingle" value=1 <?php echo($opt_ShowBadgeSingle==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Display badges on product page','next-wc-product-labels-badges'); ?>
            <br><input type="checkbox" name="optShowBadgeShop" value=1 <?php echo($opt_ShowBadgeShop==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Display badges on shop page','next-wc-product-labels-badges'); ?>
        </td></tr>
</table>
            
    <?php submit_button(esc_html__('Save','next-wc-product-labels-badges')); ?>
</form>

        <?php break;   
               
               case 'wcplb_set_label':?> 
<form method="post" action="options.php">
<?php settings_fields('wcplb-set-label-group'); ?>
<?php do_settings_sections('wcplb-set-label-group'); ?>

<table class="form-table">
<tr valign="top">
<td>
    <?php if ($opt_LabelType == "ImageLabel") include('wcplb-select-label.inc.php'); ?>    

<h2 class="title"><?php esc_html_e('Label settings','next-wc-product-labels-badges'); ?></h2>

  <table class="form-table">
        <?php if ($opt_LabelType == "TextBoxLabel") include('wcplb-cat-colors.inc.php'); ?>    
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Label color','next-wc-product-labels-badges'); ?></th>
        <td>
        <div id="LabelBackgroundColor" name="LabelBackgroundColor">
        <input type="color" name="optLabelColor" size=7 maxlength="7" value="<?php echo esc_attr($opt_LabelColor) ?>" class="xxx" /> <?php esc_html_e('Background color','next-wc-product-labels-badges'); ?><br>
        </div>
        <input type="color" name="optLabelPatternColor" size=7 maxlength="7" value="<?php echo esc_attr($opt_LabelPatternColor) ?>" class="xxx" /> <?php esc_html_e('Pattern color','next-wc-product-labels-badges'); ?>
        </td>
        </tr> 
        
        <tr valign="top" id="Opacity" name="Opacity">
        <th scope="row"><?php esc_html_e('Label opacity','next-wc-product-labels-badges'); ?></th>
        <td><?php esc_html_e('Set the opacity','next-wc-product-labels-badges'); ?><br>
            <div style="display: inline-block; color:#0250BB;" align="center" id="optOpacityLabelId"><em><?php echo esc_attr($opt_LabelOpacity) ?>%</em></div>
            <input type="range" oninput="wcplb_LabelOpacity_SliderChange(this.value);" id="optLabelOpacity_slider" name="optLabelOpacity_slider" style="width:50%;margin-bottom:0px;" min="0" max="100" value="<?php echo esc_attr($opt_LabelOpacity) ?>"/>
            <input type="hidden" id="optLabelOpacity" name="optLabelOpacity" pattern="[0-9]{1,3}" size=3 min="0" max="100" maxlength="3" value="<?php echo esc_attr($opt_LabelOpacity) ?>"/>
            <br><font color="#808080"><em><?php esc_html_e('From 0% (fully transparent) to 100% (fully opaque)','next-wc-product-labels-badges'); ?></em></font>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Font','next-wc-product-labels-badges'); ?></th>
        <td><select name="optLabelFont">
            <?php
            echo "<option " . ("serif"==$opt_LabelFont?"selected ":"") . "value=\"serif\">" . esc_html__('Serif','next-wc-product-labels-badges') . "</option>";
            echo "<option " . ("sans-serif"==$opt_LabelFont?"selected ":"") . "value=\"sans-serif\">" . esc_html__('Sans serif','next-wc-product-labels-badges') . "</option>";
            echo "<option " . ("cursive"==$opt_LabelFont?"selected ":"") . "value=\"cursive\">" . esc_html__('Cursive','next-wc-product-labels-badges') . "</option>";
            echo "<option " . ("fantasy"==$opt_LabelFont?"selected ":"") . "value=\"fantasy\">" . esc_html__('Fantasy','next-wc-product-labels-badges') . "</option>";
            echo "<option " . ("monospace"==$opt_LabelFont?"selected ":"") . "value=\"monospace\">" . esc_html__('Monospace','next-wc-product-labels-badges') . "</option>";
            ?>
            </select></td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php esc_html_e('Font color','next-wc-product-labels-badges'); ?></th>
        <td><input type="color" name="optLabelFontColor" size=7 maxlength="7" value="<?php echo esc_attr($opt_LabelFontColor) ?>" class="xxx" /></td>
        </tr> 
    </table>

    <h2 class="title"><?php esc_html_e('Shop page','next-wc-product-labels-badges'); ?></h2>
    <table> 
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Label alignment','next-wc-product-labels-badges'); ?></th>
        <td><input type="radio" value="left" id="left" name="optLabelShopFrom" <?php echo($opt_LabelShopFrom=="left"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Left','next-wc-product-labels-badges'); ?>
            <input type="radio" value="right" id="right" name="optLabelShopFrom" <?php echo($opt_LabelShopFrom=="right"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Right','next-wc-product-labels-badges'); ?><br>
            <?php esc_html_e('Offset X','next-wc-product-labels-badges'); ?> <input type="number" name="optLabelShop_X" size=5 value="<?php echo esc_attr($opt_LabelShop_X) ?>" class="xxx" />px<br>
            <?php esc_html_e('Offset Y','next-wc-product-labels-badges'); ?> <input type="number" name="optLabelShop_Y" size=5 value="<?php echo esc_attr($opt_LabelShop_Y) ?>" class="xxx" />px
        </td></tr>
        
        <?php if ($opt_LabelType == "ImageLabel") include('wcplb-align-shop.inc.php'); ?>
    </table> 
      
    <h2 class="title"><?php esc_html_e('Product page','next-wc-product-labels-badges'); ?></h2>
    
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Label alignment','next-wc-product-labels-badges'); ?></th>
        <td><input type="radio" value="left" id="left" name="optLabelProductFrom" <?php echo($opt_LabelProductFrom=="left"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Left','next-wc-product-labels-badges'); ?>
            <input type="radio" value="right" id="right" name="optLabelProductFrom" <?php echo($opt_LabelProductFrom=="right"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Right','next-wc-product-labels-badges'); ?>
            <input type="radio" value="rightpage" id="rightpage" name="optLabelProductFrom" <?php echo($opt_LabelProductFrom=="rightpage"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Right of the product page','next-wc-product-labels-badges'); ?><br>
            <?php esc_html_e('Offset X','next-wc-product-labels-badges'); ?> <input type="number" name="optLabelProduct_X" size=5 value="<?php echo esc_attr($opt_LabelProduct_X) ?>" class="xxx" />px<br>
            <?php esc_html_e('Offset Y','next-wc-product-labels-badges'); ?> <input type="number" name="optLabelProduct_Y" size=5 value="<?php echo esc_attr($opt_LabelProduct_Y) ?>" class="xxx" />px
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Main content','next-wc-product-labels-badges'); ?></th>
        <td><?php esc_html_e('Fisrt information on labels','next-wc-product-labels-badges'); ?><br>
            <input type="radio" name="optLabelMainInfo" value="Percent" <?php echo($opt_LabelMainInfo=="Percent"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Percent discount','next-wc-product-labels-badges'); ?><br>
            <input type="radio" name="optLabelMainInfo" value="Total" <?php echo($opt_LabelMainInfo=="Total"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Total discount','next-wc-product-labels-badges'); ?>
        </td></tr>
        
    <?php if ($opt_LabelType == "ImageLabel") include('wcplb-align-main.inc.php'); ?>

        <tr valign="top">
        <th scope="row"><?php esc_html_e('Complementary content','next-wc-product-labels-badges'); ?></th>
        <td><input type="checkbox" name="optLabelSecondInfo" value=1 <?php echo($opt_LabelSecondInfo==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Show secondary information','next-wc-product-labels-badges'); ?>
        </td></tr>

    <?php if ($opt_LabelType == "ImageLabel") include('wcplb-align-second.inc.php'); ?>
    </table>       
</td>
<th valign="top" align="top" colspan="6">
<?php
  $Width = 150;
  $Height = 150;
  
  $coeff = 2;
  $image = imagecreatetruecolor($Width*$coeff, $Height*$coeff);
  $imageProduct = imagecreatetruecolor($Width, $Height);
  $imageShop = imagecreatetruecolor($Width/2, $Height/2);
  
  list($red, $green, $blue) = sscanf($opt_LabelColor, "#%02x%02x%02x");
  $tmpLabelcolor = imageColorAllocate($image, $red, $green, $blue);
  
  list($red, $green, $blue) = sscanf($opt_LabelPatternColor, "#%02x%02x%02x");
  $tmpLabelPatterncolor = imageColorAllocate($image, $red, $green, $blue);

$white = imagecolorallocate($image, 0xff, 0xff, 0xff);  
$very_light_white = imageColorAllocate($image, 0xF0, 0xF0, 0xF0);
$gray = imagecolorallocate($image, 56, 56, 56);
$plume_gray = imagecolorallocate($image, 192, 192, 192);
$light_gray = imagecolorallocate($image, 128, 128, 128);
$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
$black = imagecolorallocate($image, 0x00, 0x00, 0x00);
$pink = imageColorAllocate($image, 255, 105, 180);
$cyan = imagecolorallocate($image, 0, 255, 255);
$yellow = imagecolorallocate($image, 255, 255, 0);
$navy     = imagecolorallocate($image, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($image, 0x90, 0x00, 0x00);

$transparent_color = $white;
imagefill($image,0,0,$transparent_color);
imagecolortransparent($image,$transparent_color);
imagecolortransparent($imageProduct,$transparent_color);
imagecolortransparent($imageShop,$transparent_color);

if ($opt_LabelType == "TextBoxLabel")
   { wcplb_DrawImg_TextBox($image, 0, 0, 150, 150, 10, $opt_LabelColor);
   }
else
   { switch ($opt_LabelName)
       { case "Label":
              wcplb_DrawImg_Label($image,$opt_LabelColor);
              break;
         
         case "Flag":
              wcplb_DrawImg_Flag($image,$opt_LabelColor);
              break;

         case "Flash":
              wcplb_DrawImg_Flash($image,$opt_LabelColor,$opt_LabelPatternColor);
              break;         
         
         case "Corner":
              wcplb_DrawImg_Corner($image,$opt_LabelColor);
              break;

         case "Star":
               wcplb_DrawImg_Star($image,$opt_LabelColor,100,12,0.75); 
               break;
         case "Star5":
               wcplb_DrawImg_Star($image,$opt_LabelColor,120,5,0.5); 
               break;
         case "Star8":
               wcplb_DrawImg_Star8($image,$opt_LabelColor); 
               break;
                                                    
         case "Drop":
               wcplb_DrawImg_Drop($image,$opt_LabelColor);
               break;
        
         case "Bubble":
              wcplb_DrawImg_Bubble($image,$opt_LabelColor,$opt_LabelPatternColor);
              break;
         
         case "Circle":
              wcplb_DrawImg_Circle($image,$opt_LabelColor);
              break;
                       
         default:
              break;
       }
   }
    
  imagecopyresampled($imageProduct,$image,0,0,0,0,$Width,$Height,$Width*$coeff,$Height*$coeff);
  imagecopyresampled($imageShop,$image,0,0,0,0,$Width/2,$Height/2,$Width*$coeff,$Height*$coeff);
  ob_start();
  imagepng($imageProduct);
  $imgP = ob_get_clean();
  echo "<img src='data:image/gif;base64," . base64_encode($imgP) . "'>";     
  $pngProductName = "LabelProduct.png";
  file_put_contents($tmpStrPathDynamic . "/" . $pngProductName,$imgP);
  
  ob_start();
  imagepng($imageShop);
  $imgS = ob_get_clean();
  $pngShopName = "LabelShop.png";
  file_put_contents($tmpStrPathDynamic . "/" . $pngShopName,$imgS);  
  imagedestroy($image);
  imagedestroy($imageProduct);
  imagedestroy($imageShop);

?>
</th>
</tr>
</table> 
    <?php submit_button(esc_html__('Save','next-wc-product-labels-badges')); ?>
</form>
               <?php break;
                             
               case 'wcplb_set_badge':?> 
               
    <?php
    switch ($section)
           { case 'new':?>
                   <h1 class="screen-reader-text">Set badge</h1>
		               <ul class="subsubsub"><li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=new" class="current"><?php esc_html_e('New','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=featured" class=""><?php esc_html_e('Featured','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=sold" class=""><?php esc_html_e('Sold out','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=top" class=""><?php esc_html_e('Best selling','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=quantity" class=""><?php esc_html_e('Quantity','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=cat" class=""><?php esc_html_e('Categories','next-wc-product-labels-badges'); ?></a> </li>
		               </ul><br class="clear">
             <?php break;
             
             case 'featured':?>
                   <h1 class="screen-reader-text">Set badge</h1>
		               <ul class="subsubsub"><li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=new" class=""><?php esc_html_e('New','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=featured" class="current"><?php esc_html_e('Featured','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=sold" class=""><?php esc_html_e('Sold out','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=top" class=""><?php esc_html_e('Best selling','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=quantity" class=""><?php esc_html_e('Quantity','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=cat" class=""><?php esc_html_e('Categories','next-wc-product-labels-badges'); ?></a> </li>
		               </ul><br class="clear">
             <?php break;
                                         
             case 'sold':?>
                   <h1 class="screen-reader-text">Set badge</h1>
		               <ul class="subsubsub"><li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=new" class=""><?php esc_html_e('New','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=featured" class=""><?php esc_html_e('Featured','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=sold" class="current"><?php esc_html_e('Sold out','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=top" class=""><?php esc_html_e('Best selling','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=quantity" class=""><?php esc_html_e('Quantity','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=cat" class=""><?php esc_html_e('Categories','next-wc-product-labels-badges'); ?></a> </li>
		               </ul><br class="clear">
             <?php break;               
               
             case 'top':?>
                   <h1 class="screen-reader-text">Set badge</h1>
		               <ul class="subsubsub"><li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=new" class=""><?php esc_html_e('New','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=featured" class=""><?php esc_html_e('Featured','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=sold" class=""><?php esc_html_e('Sold out','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=top" class="current"><?php esc_html_e('Best selling','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=quantity" class=""><?php esc_html_e('Quantity','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=cat" class=""><?php esc_html_e('Categories','next-wc-product-labels-badges'); ?></a> </li>
		               </ul><br class="clear">
             <?php break;    
              
             case 'quantity':?>
                   <h1 class="screen-reader-text">Set badge</h1>
		               <ul class="subsubsub"><li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=new" class=""><?php esc_html_e('New','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=featured" class=""><?php esc_html_e('Featured','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=sold" class=""><?php esc_html_e('Sold out','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=top" class=""><?php esc_html_e('Best selling','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=quantity" class="current"><?php esc_html_e('Quantity','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=cat" class=""><?php esc_html_e('Categories','next-wc-product-labels-badges'); ?></a> </li>
		               </ul><br class="clear">
             <?php break;    
                                          
             case 'cat':?>
                   <h1 class="screen-reader-text">Set badge</h1>
		               <ul class="subsubsub"><li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=new" class=""><?php esc_html_e('New','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=featured" class=""><?php esc_html_e('Featured','next-wc-product-labels-badges'); ?></a> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=sold" class=""><?php esc_html_e('Sold out','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=top" class=""><?php esc_html_e('Best selling','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=quantity" class=""><?php esc_html_e('Quantity','next-wc-product-labels-badges'); ?></a> </li> | </li>
		                                     <li><a href="?page=wcplb-acp&amp;tab=wcplb_set_badge&amp;section=cat" class="current"><?php esc_html_e('Categories','next-wc-product-labels-badges'); ?></a> </li>
		               </ul><br class="clear">
             <?php break; 
             
             default:?>
             <?php break;
           } ?>
              
<?php
$tmpFieldsName = "wcplb-badge-" . $section . "-group";
$nameBadgeUse = "optBadgeUse_" . $section;
$nameBadgeColor = "optBadgeColor_" . $section;
$nameBadgePatternColor = "optBadgePatternColor_" . $section;

$nameOpacityBadgeId = "optOpacityBadgeId_" . $section;               
$nameoptBadgeOpacity = "optBadgeOpacity_" . $section;
$nameBadgeOpacity_slider = "optBadgeOpacity_slider_" . $section;

$nameBadgeText = "optBadgeText_" . $section;
$nameBadgeFontTextbox = "optBadgeFontTextbox_" . $section;
$nameBadgeFontImage = "optBadgeFontImage_" . $section;
$nameBadgeFontSize = "optBadgeFontSize_" . $section;
$nameBadgeFontColor = "optBadgeFontColor_" . $section;
$nameBadgeTextDir = "optBadgeTextDir_" . $section;
$nameBadgeProductFrom = "optBadgeProductFrom_" . $section;
$nameBadgeProduct_X = "optBadgeProduct_X_" . $section;
$nameBadgeProduct_Y = "optBadgeProduct_Y_" . $section;
$nameBadgeShopFrom = "optBadgeShopFrom_" . $section;
$nameBadgeShop_X= "optBadgeShop_X_" . $section;
$nameBadgeShop_Y = "optBadgeShop_Y_" . $section;
?>
<form method="post" action="options.php">
<?php settings_fields($tmpFieldsName); ?>
<?php do_settings_sections($tmpFieldsName); ?>

<table class="form-table">
<tr valign="top">
<td>
  <?php if ($opt_BadgeType == "ImageBadge") include('wcplb-select-badge.inc.php'); ?>    
  <h2 class="title"><?php esc_html_e('Badge settings','next-wc-product-labels-badges'); echo " [" . esc_attr(ucfirst($section)) . "]" ?></h2>

  <table class="form-table">
        <?php if ($opt_LabelType == "TextBoxBadge") include('wcplb-cat-colors.inc.php'); ?>  
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Activate this badge','next-wc-product-labels-badges'); ?></th>
        <td><input type="checkbox" name="<?php echo esc_attr($nameBadgeUse) ?>" value=1 <?php echo(${'opt_BadgeUse_'.$section}==1?"checked ":"");?>class="wppd-ui-toggle" />
        </td></tr>
                  
        <?php if ($section == "new") include('wcplb-badge-newness.inc.php'); ?>
        <?php if ($section == "top") include('wcplb-badge-bestselling.inc.php'); ?>
        <?php if ($section == "quantity") include('wcplb-badge-quantity.inc.php'); ?>
                 
        <?php
        if ($section != "cat")
           include('wcplb-badge-color.inc.php');
        else
           include('wcplb-badge-color-cat.inc.php');
        ?>
        
        <tr valign="top" id="Opacity" name="Opacity">
        <th scope="row"><?php esc_html_e('Badge opacity','next-wc-product-labels-badges'); ?></th>
        <td><?php esc_html_e('Set the opacity','next-wc-product-labels-badges'); ?><br>
            <div style="display: inline-block; color:#0250BB;" align="center" id="<?php echo esc_attr($nameOpacityBadgeId) ?>"><em><?php echo esc_attr(${'opt_BadgeOpacity_'.$section}) ?>%</em></div>
            <input type="range" oninput="wcplb_BadgeOpacity_SliderChange(this.value,'<?php echo esc_attr($section) ?>');" id="<?php echo esc_attr($nameBadgeOpacity_slider) ?>" name="<?php echo esc_attr($nameBadgeOpacity_slider) ?>" style="width:50%;margin-bottom:0px;" min="0" max="100" value="<?php echo esc_attr(${'opt_BadgeOpacity_'.$section}) ?>"/>
            <input type="hidden" id="<?php echo esc_attr($nameoptBadgeOpacity) ?>" name="<?php echo esc_attr($nameoptBadgeOpacity) ?>" pattern="[0-9]{1,3}" size=3 min="0" max="100" maxlength="3" value="<?php echo esc_attr(${'opt_BadgeOpacity_'.$section}) ?>"/>
            <br><font color="#808080"><em><?php esc_html_e('From 0% (fully transparent) to 100% (fully opaque)','next-wc-product-labels-badges'); ?></em></font>
        </td></tr>
        
        <?php if ($section != "cat") include('wcplb-badge-text.inc.php'); ?>
        
        <?php
        if ($opt_BadgeType == "TextBoxBadge")
           include('wcplb-badge-font-textbox.inc.php');
        else
           include('wcplb-badge-font-image.inc.php');
        ?>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Font color','next-wc-product-labels-badges'); ?></th>
        <td><input type="color" name="<?php echo esc_attr($nameBadgeFontColor) ?>" size=7 maxlength="7" value="<?php echo esc_attr(${'opt_BadgeFontColor_'.$section}) ?>" class="xxx" />
        </td></tr>
        
        <?php
        if ((${'opt_BadgeName_'.$section} == "ArrowIn") or (${'opt_BadgeName_'.$section} == "ArrowOut")) include('wcplb-badge-flip-text.inc.php');
        ?>
        
    </table>
    
    <h2 class="title"><?php esc_html_e('Shop page','next-wc-product-labels-badges'); ?></h2>
    <table> 
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Badge alignment','next-wc-product-labels-badges'); ?></th>
        <td><input type="radio" value="top_left" id="<?php echo esc_attr($nameBadgeShopFrom) ?>" name="<?php echo esc_attr($nameBadgeShopFrom) ?>" <?php echo(${'opt_BadgeShopFrom_'.$section}=="top_left"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Top left','next-wc-product-labels-badges'); ?>
            <input type="radio" value="top_right" id="<?php echo esc_attr($nameBadgeShopFrom) ?>" name="<?php echo esc_attr($nameBadgeShopFrom) ?>" <?php echo(${'opt_BadgeShopFrom_'.$section}=="top_right"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Top right','next-wc-product-labels-badges'); ?>
            <input type="radio" value="bot_left" id="<?php echo esc_attr($nameBadgeShopFrom) ?>" name="<?php echo esc_attr($nameBadgeShopFrom) ?>" <?php echo(${'opt_BadgeShopFrom_'.$section}=="bot_left"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Bottom left','next-wc-product-labels-badges'); ?>
            <input type="radio" value="bot_right" id="<?php echo esc_attr($nameBadgeShopFrom) ?>" name="<?php echo esc_attr($nameBadgeShopFrom) ?>" <?php echo(${'opt_BadgeShopFrom_'.$section}=="bot_right"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Bottom right','next-wc-product-labels-badges'); ?><br>
            <?php esc_html_e('Offset X','next-wc-product-labels-badges'); ?> <input type="number" name="<?php echo esc_attr($nameBadgeShop_X) ?>" size=5 value="<?php echo esc_attr(${'opt_BadgeShop_X_'.$section}) ?>" class="xxx" />px<br>
            <?php esc_html_e('Offset Y','next-wc-product-labels-badges'); ?> <input type="number" name="<?php echo esc_attr($nameBadgeShop_Y) ?>" size=5 value="<?php echo esc_attr(${'opt_BadgeShop_Y_'.$section}) ?>" class="xxx" />px<br>
            <?php 
            switch (${'opt_BadgeName_'.$section})
                   { case "LeftBannerIn":
                     case "LeftBannerOut":
                          echo "<em>"; esc_html_e('Better aligned Top left with X = -4 and Y around 200','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "RightBannerIn":
                     case "RightBannerOut":
                          echo "<em>"; esc_html_e('Better aligned Top right with X = -4 and Y around 200','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "ArrowIn":
                     case "ArrowOut":
                          echo "<em>"; esc_html_e('Better aligned Top right with X = 5 and Y = -5','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Ribbon":
                          echo "<em>"; esc_html_e('Better aligned Top right with X = -5 and Y = -5','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "DoubleRibbon":
                          echo "<em>"; esc_html_e('Better aligned Top left with X = 100 and Y = -5','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Medal36":
                          echo "<em>"; esc_html_e('Better aligned Top right with X = -5 and Y = -5','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Flower":
                          echo "<em>"; esc_html_e('Better aligned Top right with X = -5 and Y = -5','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Square":
                          echo "<em>"; esc_html_e('Better aligned Top right with X = -5 and Y = -5','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Victory":
                          echo "<em>"; esc_html_e('Better aligned Top right with X = -5 and Y = 0','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Stamp":
                          echo "<em>"; esc_html_e('Better aligned Top right with X = 0 and Y = -10','next-wc-product-labels-badges'); echo "</em>";
                          break;
                   }
            ?>
        </td></tr>
    </table> 
        
    <h2 class="title"><?php esc_html_e('Product page','next-wc-product-labels-badges'); ?></h2>
    <table> 
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Badge alignment','next-wc-product-labels-badges'); ?></th>
        <td><input type="radio" value="left" id="<?php echo esc_attr($nameBadgeProductFrom) ?>" name="<?php echo esc_attr($nameBadgeProductFrom) ?>" <?php echo(${'opt_BadgeProductFrom_'.$section}=="left"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Left','next-wc-product-labels-badges'); ?>
            <input type="radio" value="right" id="<?php echo esc_attr($nameBadgeProductFrom) ?>" name="<?php echo esc_attr($nameBadgeProductFrom) ?>" <?php echo(${'opt_BadgeProductFrom_'.$section}=="right"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Right','next-wc-product-labels-badges'); ?>
            <input type="radio" value="rightpage" id="<?php echo esc_attr($nameBadgeProductFrom) ?>" name="<?php echo esc_attr($nameBadgeProductFrom) ?>" <?php echo(${'opt_BadgeProductFrom_'.$section}=="rightpage"?"checked ":"");?>class="xxx" /> <?php esc_html_e('Right of the product page','next-wc-product-labels-badges'); ?><br>
            <?php esc_html_e('Offset X','next-wc-product-labels-badges'); ?> <input type="number" name="<?php echo esc_attr($nameBadgeProduct_X) ?>" size=5 value="<?php echo esc_attr(${'opt_BadgeProduct_X_'.$section}) ?>" class="xxx" />px<br>
            <?php esc_html_e('Offset Y','next-wc-product-labels-badges'); ?> <input type="number" name="<?php echo esc_attr($nameBadgeProduct_Y) ?>" size=5 value="<?php echo esc_attr(${'opt_BadgeProduct_Y_'.$section}) ?>" class="xxx" />px<br>
            <?php 
            switch (${'opt_BadgeName_'.$section})
                   { case "LeftBannerIn":
                     case "LeftBannerOut":
                          echo "<em>"; esc_html_e('Better aligned Left with X = -4 and Y around 400','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "RightBannerIn":
                     case "RightBannerOut":
                          echo "<em>"; esc_html_e('Better aligned Right with X = -4 and Y around 400','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "ArrowIn":
                     case "ArrowOut":
                          echo "<em>"; esc_html_e('Better aligned Right with X = 10 and Y from 0 and more','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Ribbon":
                          echo "<em>"; esc_html_e('Better aligned Right with X = -1 and Y = -1','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "DoubleRibbon":
                          echo "<em>"; esc_html_e('Better aligned Left with X = 100 and Y = -5','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Medal36":
                          echo "<em>"; esc_html_e('Better aligned Right with X = -1 and Y = -1','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Flower":
                          echo "<em>"; esc_html_e('Better aligned Right with X = -1 and Y = -1','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Square":
                          echo "<em>"; esc_html_e('Better aligned Right with X = 0 and Y = 0','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Victory":
                          echo "<em>"; esc_html_e('Better aligned Right with X = 0 and Y = 0','next-wc-product-labels-badges'); echo "</em>";
                          break;
                     case "Stamp":
                          echo "<em>"; esc_html_e('Better aligned Right of the product page with X = 0 and Y = 0','next-wc-product-labels-badges'); echo "</em>";
                          break;
                   }
            ?>
        </td></tr>
    </table>       
        
</td>
<th valign="top" align="top" colspan="6">
<?php
include('wcplb-show-image-badge.inc.php');
?>
</th>
</tr>
</table> 
    <?php submit_button(esc_html__('Save','next-wc-product-labels-badges')); ?>
</form>            
       
             
              
               

    <?php break;
      default:
    } ?>
    </div>
  </div>
  