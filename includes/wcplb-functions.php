<?php
if (!defined('WCPLB_KEY_DONATE'))
   { define('WCPLB_KEY_DONATE','69RHES6Y3CVPL');
   }
if (!defined('WCPLB_PLUGIN_NAME'))
   { define('WCPLB_PLUGIN_NAME','Next Labels');
   }
if (!defined('WCPLB_PLUGIN_SLUG'))
   { define('WCPLB_PLUGIN_SLUG','next-wc-product-labels-badges');
   }
if (!defined('WCPLB_VERSION'))
   { define('WCPLB_VERSION','1.4.3');
   }
if (!defined('WCPLB_TYPE'))
   { define('WCPLB_TYPE','Free');
   }
if (!defined('WCPLB_PLUGIN_PAGE'))
   { define('WCPLB_PLUGIN_PAGE','wcplb-acp');
   }
   
function theme_enqueue_styles()
{ wp_enqueue_style('parent-style',get_template_directory_uri() . '/style.css');

  $tmpStr = plugins_url('/',__FILE__);
  if (substr($tmpStr,-1) == "/")
     $tmpPos = strrpos($tmpStr,'/',-2);
  else   
     $tmpPos = strrpos($tmpStr,'/',-1);
  $tmpStrPathCustomCSS = substr($tmpStr,0,$tmpPos) . '/custom';
  $tmpStrPathCSS = substr($tmpStr,0,$tmpPos) . '/css';

  $PostID = get_the_ID();
  
  $cats="";
  foreach( wp_get_post_terms($PostID, 'product_cat' ) as $term ){
        if( $term ){
            $cats .= $term->name . ',';
        }
    }

  if (strpos($cats,"B"))
     wp_enqueue_style('child-style',$tmpStrPathCustomCSS . '/wcplb.css',array('parent-style'));
  else
     wp_enqueue_style('child-style',$tmpStrPathCustomCSS . '/wcplb.css',array('parent-style'));
     
  wp_enqueue_style('wcplb-front-style',$tmpStrPathCSS . '/front.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

add_action('admin_enqueue_scripts', 'wcplb_Styles');
function wcplb_Styles()
{ $tmpStr = plugins_url('/',__FILE__);
  if (substr($tmpStr,-1) == "/")
     $tmpPos = strrpos($tmpStr,'/',-2);
  else   
     $tmpPos = strrpos($tmpStr,'/',-1);
  $tmpStr = substr($tmpStr,0,$tmpPos);
  $tmpPathCSS = $tmpStr . '/css/style.css';
  wp_enqueue_style('wcplb_Styles', $tmpPathCSS);
}

add_action('plugins_loaded', 'wcplb_checkVersion');
function wcplb_CheckVersion()
{ $tmpCurVersion = get_option('wcplbCurrentVersion');
  $tmpCurType = get_option('wcplbCurrentType');
  if((version_compare($tmpCurVersion, WCPLB_VERSION, '<')) or (WCPLB_TYPE !== $tmpCurType))
    { wcplb_PluginActivation();
    }
}

function wcplb_PluginActivation()
{ update_option('wcplbCurrentVersion', WCPLB_VERSION);
  update_option('wcplbCurrentType', WCPLB_TYPE);
  
  return WCPLB_VERSION;
}
register_activation_hook(__FILE__, 'wcplb_PluginActivation');

add_action('admin_menu','wcplb_Add_Menu');
function wcplb_Add_Menu()
{ add_menu_page(
      'WC Product Labels & Badges',
      WCPLB_PLUGIN_NAME,
      'manage_options',
      
      'wcplb-acp',
      'wcplb_acp_callback',
      plugins_url(WCPLB_PLUGIN_SLUG . '/images/icon.png')
  );
   
  
  add_submenu_page('wcplb-acp', __('General settings','next-wc-product-labels-badges'), __('General Settings','next-wc-product-labels-badges'), 'manage_options', 'wcplb-acp&tab=wcplb_settings', 'render_generic_settings_page');
  add_submenu_page('wcplb-acp', __('Set labels','next-wc-product-labels-badges'), __('Set labels','next-wc-product-labels-badges'), 'manage_options', 'wcplb-acp&tab=wcplb_set_label', 'render_generic_settings_page');
  add_submenu_page('wcplb-acp', __('Set badges','next-wc-product-labels-badges'), __('Set badges','next-wc-product-labels-badges'), 'manage_options', 'wcplb-acp&tab=wcplb_set_badge', 'render_generic_settings_page');

	add_action('admin_init','register_wcplb_settings');  
}

add_action('init','wcplb_load_textdomain');
function wcplb_load_textdomain()
{ load_plugin_textdomain('next-wc-product-labels-badges',false,WCPLB_PLUGIN_SLUG . '/languages/'); 
}

function register_wcplb_settings()
{ register_setting('wcplb-settings-group','wcplbCurrentVersion');
  register_setting('wcplb-settings-group','wcplbCurrentType');

  register_setting('wcplb-settings-group','optLabelType');
  register_setting('wcplb-settings-group','optShowLabelSingle');
  register_setting('wcplb-settings-group','optShowLabelShop');
  register_setting('wcplb-settings-group','optBadgeType');  
  register_setting('wcplb-settings-group','optShowBadgeSingle');
  register_setting('wcplb-settings-group','optShowBadgeShop');
  
  register_setting('wcplb-set-label-group','optLabelName');
  register_setting('wcplb-set-label-group','optUseCatColor');
  register_setting('wcplb-set-label-group','optLabelColor');
  register_setting('wcplb-set-label-group','optLabelPatternColor');
  register_setting('wcplb-set-label-group','optLabelOpacity');
  register_setting('wcplb-set-label-group','optLabelFont');
  register_setting('wcplb-set-label-group','optLabelFontColor');
  register_setting('wcplb-set-label-group','optLabelShopFrom');
  register_setting('wcplb-set-label-group','optLabelShop_X');
  register_setting('wcplb-set-label-group','optLabelShop_Y');
  register_setting('wcplb-set-label-group','optShopText_X');
  register_setting('wcplb-set-label-group','optShopText_Y');
  register_setting('wcplb-set-label-group','optLabelProductFrom');
  register_setting('wcplb-set-label-group','optLabelProduct_X');
  register_setting('wcplb-set-label-group','optLabelProduct_Y');
  register_setting('wcplb-set-label-group','optLabelMainInfo');
  register_setting('wcplb-set-label-group','optLabelMain_X');
  register_setting('wcplb-set-label-group','optLabelMain_Y');
  register_setting('wcplb-set-label-group','optLabelSecondInfo');  
  register_setting('wcplb-set-label-group','optLabelSecond_X');
  register_setting('wcplb-set-label-group','optLabelSecond_Y');

  register_setting('wcplb-badge-featured-group','optBadgeUse_featured');  
  register_setting('wcplb-badge-featured-group','optBadgeName_featured');
  register_setting('wcplb-badge-featured-group','optBadgeColor_featured');
  register_setting('wcplb-badge-featured-group','optBadgePatternColor_featured');
  register_setting('wcplb-badge-featured-group','optBadgeOpacity_featured');
  register_setting('wcplb-badge-featured-group','optBadgeProductFrom_featured');
  register_setting('wcplb-badge-featured-group','optBadgeProduct_X_featured');
  register_setting('wcplb-badge-featured-group','optBadgeProduct_Y_featured');
  register_setting('wcplb-badge-featured-group','optBadgeShopFrom_featured');
  register_setting('wcplb-badge-featured-group','optBadgeShop_X_featured');
  register_setting('wcplb-badge-featured-group','optBadgeShop_Y_featured');  
  register_setting('wcplb-badge-featured-group','optBadgeText_featured');
  register_setting('wcplb-badge-featured-group','optBadgeFontTextbox_featured');
  register_setting('wcplb-badge-featured-group','optBadgeFontImage_featured');
  register_setting('wcplb-badge-featured-group','optBadgeFontSize_featured');
  register_setting('wcplb-badge-featured-group','optBadgeFontColor_featured');
  register_setting('wcplb-badge-featured-group','optBadgeTextDir_featured');
  
  register_setting('wcplb-badge-new-group','optBadgeNewDays');
  register_setting('wcplb-badge-new-group','optBadgeUse_new');
  register_setting('wcplb-badge-new-group','optBadgeName_new');
  register_setting('wcplb-badge-new-group','optBadgeColor_new');
  register_setting('wcplb-badge-new-group','optBadgePatternColor_new');
  register_setting('wcplb-badge-new-group','optBadgeOpacity_new');
  register_setting('wcplb-badge-new-group','optBadgeProductFrom_new');
  register_setting('wcplb-badge-new-group','optBadgeProduct_X_new');
  register_setting('wcplb-badge-new-group','optBadgeProduct_Y_new');
  register_setting('wcplb-badge-new-group','optBadgeShopFrom_new');
  register_setting('wcplb-badge-new-group','optBadgeShop_X_new');
  register_setting('wcplb-badge-new-group','optBadgeShop_Y_new');  
  register_setting('wcplb-badge-new-group','optBadgeText_new');
  register_setting('wcplb-badge-new-group','optBadgeFontTextbox_new');
  register_setting('wcplb-badge-new-group','optBadgeFontImage_new');
  register_setting('wcplb-badge-new-group','optBadgeFontSize_new');
  register_setting('wcplb-badge-new-group','optBadgeFontColor_new');
  register_setting('wcplb-badge-new-group','optBadgeTextDir_new');
  
  register_setting('wcplb-badge-sold-group','optBadgeUse_sold');  
  register_setting('wcplb-badge-sold-group','optBadgeName_sold');
  register_setting('wcplb-badge-sold-group','optBadgeColor_sold');
  register_setting('wcplb-badge-sold-group','optBadgePatternColor_sold');
  register_setting('wcplb-badge-sold-group','optBadgeOpacity_sold');
  register_setting('wcplb-badge-sold-group','optBadgeProductFrom_sold');
  register_setting('wcplb-badge-sold-group','optBadgeProduct_X_sold');
  register_setting('wcplb-badge-sold-group','optBadgeProduct_Y_sold');
  register_setting('wcplb-badge-sold-group','optBadgeShopFrom_sold');
  register_setting('wcplb-badge-sold-group','optBadgeShop_X_sold');
  register_setting('wcplb-badge-sold-group','optBadgeShop_Y_sold');  
  register_setting('wcplb-badge-sold-group','optBadgeText_sold');
  register_setting('wcplb-badge-sold-group','optBadgeFontTextbox_sold');
  register_setting('wcplb-badge-sold-group','optBadgeFontImage_sold');
  register_setting('wcplb-badge-sold-group','optBadgeFontSize_sold');
  register_setting('wcplb-badge-sold-group','optBadgeFontColor_sold');
  register_setting('wcplb-badge-sold-group','optBadgeTextDir_sold');
  
  register_setting('wcplb-badge-top-group','optBadgeBestSelling');   
  register_setting('wcplb-badge-top-group','optBadgeNbBestSelling');  
  register_setting('wcplb-badge-top-group','optBadgeUse_top');    
  register_setting('wcplb-badge-top-group','optBadgeName_top');
  register_setting('wcplb-badge-top-group','optBadgeColor_top');
  register_setting('wcplb-badge-top-group','optBadgePatternColor_top');
  register_setting('wcplb-badge-top-group','optBadgeOpacity_top');
  register_setting('wcplb-badge-top-group','optBadgeProductFrom_top');
  register_setting('wcplb-badge-top-group','optBadgeProduct_X_top');
  register_setting('wcplb-badge-top-group','optBadgeProduct_Y_top');
  register_setting('wcplb-badge-top-group','optBadgeShopFrom_top');
  register_setting('wcplb-badge-top-group','optBadgeShop_X_top');
  register_setting('wcplb-badge-top-group','optBadgeShop_Y_top');  
  register_setting('wcplb-badge-top-group','optBadgeText_top');
  register_setting('wcplb-badge-top-group','optBadgeFontTextbox_top');
  register_setting('wcplb-badge-top-group','optBadgeFontImage_top');
  register_setting('wcplb-badge-top-group','optBadgeFontSize_top');
  register_setting('wcplb-badge-top-group','optBadgeFontColor_top');
  register_setting('wcplb-badge-top-group','optBadgeTextDir_top');
    
  register_setting('wcplb-badge-quantity-group','optBadgeQuantity');
  register_setting('wcplb-badge-quantity-group','optBadgeUse_quantity');   
  register_setting('wcplb-badge-quantity-group','optBadgeName_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeColor_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgePatternColor_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeOpacity_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeProductFrom_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeProduct_X_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeProduct_Y_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeShopFrom_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeShop_X_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeShop_Y_quantity');  
  register_setting('wcplb-badge-quantity-group','optBadgeText_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeFontTextbox_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeFontImage_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeFontSize_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeFontColor_quantity');
  register_setting('wcplb-badge-quantity-group','optBadgeTextDir_quantity');
 
  register_setting('wcplb-badge-cat-group','optBadgeCat');
  register_setting('wcplb-badge-cat-group','optBadgeUse_cat'); 
  register_setting('wcplb-badge-cat-group','optBadgeName_cat');
  register_setting('wcplb-badge-cat-group','optBadgeOpacity_cat');
  register_setting('wcplb-badge-cat-group','optBadgeProductFrom_cat');
  register_setting('wcplb-badge-cat-group','optBadgeProduct_X_cat');
  register_setting('wcplb-badge-cat-group','optBadgeProduct_Y_cat');
  register_setting('wcplb-badge-cat-group','optBadgeShopFrom_cat');
  register_setting('wcplb-badge-cat-group','optBadgeShop_X_cat');
  register_setting('wcplb-badge-cat-group','optBadgeShop_Y_cat');
  register_setting('wcplb-badge-cat-group','optBadgeFontTextbox_cat');
  register_setting('wcplb-badge-cat-group','optBadgeFontImage_cat');
  register_setting('wcplb-badge-cat-group','optBadgeFontSize_cat');
  register_setting('wcplb-badge-cat-group','optBadgeFontColor_cat');
  register_setting('wcplb-badge-cat-group','optCatAssoHideEmpty');

  $orderby = 'name';
  $order = 'asc';
  $hide_empty = false ;
  $cat_args = array(
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty); 
  $product_categories = get_terms('product_cat',$cat_args);
  $NbCat = count($product_categories);
  foreach ($product_categories as $key => $category)
          { $tmpCatSlug = $category->slug;
            $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
            $tmpOptColorCatName = 'optBadgeColor_cat_'.$tmpCatSlug;
            register_setting('wcplb-badge-cat-group',$tmpOptColorCatName);
              
            $tmpOptTextCatName = 'optBadgeText_cat_'.$tmpCatSlug;
            register_setting('wcplb-badge-cat-group',$tmpOptTextCatName);
          }
  register_setting('wcplb-badge-cat-group','optCatAssoHierarchy');
}

function wcplb_acp_callback()
{ global $title;

  if (!current_user_can('administrator'))
     { wp_die(__('You do not have sufficient permissions to access this page.','next-wc-product-labels-badges'));
	   }
	
  print '<div class="wrap">';
  print "<h1 class=\"stabilo\">$title</h1><hr>";

  $file = plugin_dir_path( __FILE__ ) . "wcplb-acp-page.php";
  if (file_exists($file))
      require $file;

  echo "<p><em><b>" . esc_html__('Add for free','next-wc-product-labels-badges') . " <a target=\"_blank\" href=\"https://nxt-web.com/wordpress-plugins/\" style=\"color:#FE5500;font-weight:bold;font-size:1.2em\">" . esc_html__('Next Product Toolbox for WooCommerce','next-wc-product-labels-badges') .  "</a> " . esc_html__('to easily configure your WC products, add clouds and lists, improve SEO and much more!','next-wc-product-labels-badges') . "</b></em></p>";
  
  echo "<p><em><b>" . esc_html__('You like this plugin?','next-wc-orders') . " <a target=\"_blank\" href=\"https://www.paypal.com/donate/?hosted_button_id=" . WCPLB_KEY_DONATE . "\" style=\"color:#FE5500;font-weight:bold;font-size:1.2em\">" . esc_html__('Offer me a coffee!','next-wc-orders') . "</a></b></em>";
  $CoffeePath = plugin_dir_url( dirname( __FILE__ ) )  . '/images/coffee-donate.gif';
  echo '&nbsp;<img src="' . $CoffeePath . '"></p>';
  print '</div>';
}

function XXX_wcplb_notice_DataSaved()
{ $screen = get_current_screen();
  $tmpPluginPage = sanitize_text_field($_GET['page']);
  if ($screen->id !== 'toplevel_page_'.$tmpPluginPage) return;
  
  if (isset($_GET['settings-updated']))
     { $tmp_settings_updated = sanitize_text_field($_GET['settings-updated']);
       if ($tmp_settings_updated === "true") 
          { ?>
            <div class="notice notice-success is-dismissible">
                 <p><?php esc_html_e('YOUR Data have been saved successfully!','next-wc-product-labels-badges') ?></p>
            </div>
            <?php 
          }
       else 
          { ?>
            <div class="notice notice-warning is-dismissible">
                 <p><?php esc_html_e('Sorry, cannot do this...','next-wc-product-labels-badges') ?></p>
            </div>
            <?php
          }
     }
}

add_action('admin_notices','wcplb_warning_NoLabels');
function wcplb_warning_NoLabels()
{ $screen = get_current_screen();
  $tmpPluginPage = sanitize_text_field($_GET['page']);
  if ($screen->id !== 'toplevel_page_'.$tmpPluginPage) return;
    
  $opt_ShowLabelSingle = get_option('optShowLabelSingle');
  $opt_ShowLabelShop = get_option('optShowLabelShop');
  if (!$opt_ShowLabelSingle and !$opt_ShowLabelShop)
     { ?>
       <div class="notice notice-warning is-dismissible">
            <p><?php esc_html_e('Show labels is disabled on both single product and shop pages!','next-wc-product-labels-badges') ?></p>
       </div>
       <?php 
     }
}

function wcplb_GetTotalStock($product)
{ $total = 0;

  if ($product->is_type('variable')) 
     { if ($product->managing_stock())
          $total = $product->get_stock_quantity();
       else
          { $total = "NotManaged";
            foreach ($product->get_children() as $child_id)
                    { $variation = wc_get_product($child_id);
                      if ($variation->managing_stock())  $total += $variation->get_stock_quantity();
                    }
           }
     }
  else
     { if ($product->managing_stock())
          $total = $product->get_stock_quantity();
       else
          $total = "NotManaged";
     }
  return $total;
}

function wcplb_hide_sale()
{ return false;
}
add_filter('woocommerce_sale_flash', 'wcplb_hide_sale');

function wcplb_product_badge_new()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_new = get_option('optBadgeText_new');
  $opt_BadgeUse_new = get_option('optBadgeUse_new');
     
  $opt_BadgeNewDays = get_option('optBadgeNewDays');  
  $value = $opt_BadgeNewDays;
  if (($opt_BadgeUse_new) and (($product->is_type('simple')) || ($product->is_type('variable'))))
     { $post_date = $product->get_date_created();
       $post_date = date('Y-m-d',strtotime($post_date));
       $limit_date = date('Y-m-d',strtotime("-$value days",time()));
       
       if ($post_date >= $limit_date)
          { if ($opt_BadgeType == "TextBoxBadge")
               echo '<div class="BadgeTextProduct_New">' . esc_attr($opt_BadgeText_new) . '</div>';
            else
               echo '<span class="BadgeImgProduct_New"></span>';
          }
     }
}
$opt_BadgeProductFrom_new = get_option('optBadgeProductFrom_new');
if ($opt_BadgeProductFrom_new == "rightpage")
   add_action('woocommerce_single_product_summary','wcplb_product_badge_new',25);
else
   add_action('woocommerce_product_thumbnails','wcplb_product_badge_new',25);

function wcplb_product_badge_featured()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_featured = get_option('optBadgeText_featured');
  $opt_BadgeUse_featured = get_option('optBadgeUse_featured');
     
  if (($opt_BadgeUse_featured) and ($product->is_featured()))
     { if ($opt_BadgeType == "TextBoxBadge")
          echo "<div class='BadgeTextProduct_Featured'>" . esc_attr($opt_BadgeText_featured) . "</div>";
       else
          echo "<span class='BadgeImgProduct_Featured'></span>";
     }
}     
$opt_BadgeProductFrom_featured = get_option('optBadgeProductFrom_featured');
if ($opt_BadgeProductFrom_featured == "rightpage")
   add_action('woocommerce_single_product_summary','wcplb_product_badge_featured',25);
else
   add_action('woocommerce_product_thumbnails','wcplb_product_badge_featured',25);

function wcplb_product_badge_top()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_top = get_option('optBadgeText_top');
  $opt_BadgeUse_top = get_option('optBadgeUse_top');

  $tmp_BadgeBestSelling  = get_option('optBadgeBestSelling');
  $tmpId = "-" . $product->get_id() . '-';
  
  if (($opt_BadgeUse_top) and (strpos($tmp_BadgeBestSelling,$tmpId) !== false))
     { if ($opt_BadgeType == "TextBoxBadge")
          echo "<div class='BadgeTextProduct_Top'>" . esc_attr($opt_BadgeText_top) . "</div>";
       else
          echo "<span class='BadgeImgProduct_Top'></span>";
     }
}
$opt_BadgeProductFrom_top = get_option('optBadgeProductFrom_top');
if ($opt_BadgeProductFrom_top == "rightpage")
   add_action('woocommerce_single_product_summary','wcplb_product_badge_top',25);
else
   add_action('woocommerce_product_thumbnails','wcplb_product_badge_top',25);
    
function wcplb_product_badge_sold()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_sold = get_option('optBadgeText_sold');
  $opt_BadgeUse_sold = get_option('optBadgeUse_sold');
    
  if ($opt_BadgeUse_sold)    
     { $stock_quantity = wcplb_GetTotalStock($product);  
       if (($stock_quantity !== "NotManaged") and ($stock_quantity <= 0))
          { if ($opt_BadgeType == "TextBoxBadge")
               echo "<div class='BadgeTextProduct_Sold'>" . esc_attr($opt_BadgeText_sold) . "</div>";
            else
               echo "<span class='BadgeImgProduct_Sold'></span>";
          }
     } 
}
$opt_BadgeProductFrom_sold = get_option('optBadgeProductFrom_sold');
if ($opt_BadgeProductFrom_sold == "rightpage")
   add_action('woocommerce_single_product_summary','wcplb_product_badge_sold',25);
else
   add_action('woocommerce_product_thumbnails','wcplb_product_badge_sold',25);
   
function wcplb_product_badge_quantity()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_quantity = get_option('optBadgeText_quantity');
  $opt_BadgeUse_quantity = get_option('optBadgeUse_quantity'); 
    
  if ($opt_BadgeUse_quantity)
     { $opt_BadgeQuantity =  get_option('optBadgeQuantity');
       $stock_quantity = wcplb_GetTotalStock($product);
       if (($stock_quantity !== "NotManaged") and ($stock_quantity <= $opt_BadgeQuantity) and ($stock_quantity > 0))
          { if ($opt_BadgeType == "TextBoxBadge")
               echo "<div class='BadgeTextProduct_Quantity'>" . esc_attr($opt_BadgeText_quantity) . "</div>";
            else
               echo "<span class='BadgeImgProduct_Quantity'></span>";
          }
     }
}
$opt_BadgeProductFrom_quantity = get_option('optBadgeProductFrom_quantity');
if ($opt_BadgeProductFrom_quantity == "rightpage")
   add_action('woocommerce_single_product_summary','wcplb_product_badge_quantity',25);
else
   add_action('woocommerce_product_thumbnails','wcplb_product_badge_quantity',25);
  
function wcplb_product_badge_cat()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeUse_cat = get_option('optBadgeUse_cat'); 
    
  if ($opt_BadgeUse_cat)
     { $terms = get_the_terms($product->ID,'product_cat');
       foreach ($terms as $term)
               { $tmpProductCatSlug = $term->slug;
                 break;
               }   
       $tmpOptTextCatName = 'optBadgeText_cat_'.$tmpProductCatSlug;
       $tmpBadgeText_cat = get_option($tmpOptTextCatName);

       if ($opt_BadgeType == "TextBoxBadge")
           echo "<div class='BadgeTextProduct_Cat_" . esc_attr($tmpProductCatSlug) . "'>" . esc_attr($tmpBadgeText_cat) . "</div>";
       else
           echo "<span class='BadgeImgProduct_Cat_" . esc_attr($tmpProductCatSlug) . "'></span>";
     }
}
$opt_BadgeProductFrom_cat = get_option('optBadgeProductFrom_cat');
if ($opt_BadgeProductFrom_cat == "rightpage")
   add_action('woocommerce_single_product_summary','wcplb_product_badge_cat',25); 
else
   add_action('woocommerce_product_thumbnails','wcplb_product_badge_cat',25);
  
function wcplb_shop_badge_sold()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_sold = get_option('optBadgeText_sold');
  $opt_BadgeUse_sold = get_option('optBadgeUse_sold');

  if ($opt_BadgeUse_sold)    
     { $stock_quantity = wcplb_GetTotalStock($product);  
       if (($stock_quantity !== "NotManaged") and ($stock_quantity <= 0))
          { if ($opt_BadgeType == "TextBoxBadge")
               echo "<div class='BadgeTextShop_Sold'>" . esc_attr($opt_BadgeText_sold) . "</div>";
            else
               echo "<span class='BadgeImgShop_Sold'></span>";
          }
     } 
}
$opt_BadgeShopFrom_sold = get_option('optBadgeShopFrom_sold');
if (($opt_BadgeShopFrom_sold == "bot_left") or ($opt_BadgeShopFrom_sold == "bot_right"))
   add_action('woocommerce_before_shop_loop_item_title','wcplb_shop_badge_sold',25);
else
   add_action('woocommerce_before_shop_loop_item','wcplb_shop_badge_sold',25);

function wcplb_shop_badge_quantity()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_quantity = get_option('optBadgeText_quantity');
  $opt_BadgeUse_quantity = get_option('optBadgeUse_quantity'); 

  if ($opt_BadgeUse_quantity)
     { $opt_BadgeQuantity =  get_option('optBadgeQuantity');
       $stock_quantity = wcplb_GetTotalStock($product);
       if (($stock_quantity !== "NotManaged") and ($stock_quantity <= $opt_BadgeQuantity) and ($stock_quantity > 0))
          { if ($opt_BadgeType == "TextBoxBadge")
               echo "<div class='BadgeTextShop_Quantity'>" . esc_attr($opt_BadgeText_quantity) . "</div>";
            else
               echo "<span class='BadgeImgShop_Quantity'></span>";
          }
     }
}
$opt_BadgeShopFrom_quantity = get_option('optBadgeShopFrom_quantity');
if (($opt_BadgeShopFrom_quantity == "bot_left") or ($opt_BadgeShopFrom_quantity == "bot_right"))
   add_action('woocommerce_before_shop_loop_item_title','wcplb_shop_badge_quantity',25);
else
   add_action('woocommerce_before_shop_loop_item','wcplb_shop_badge_quantity',25);

function wcplb_shop_badge_featured()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_featured = get_option('optBadgeText_featured');
  $opt_BadgeUse_featured = get_option('optBadgeUse_featured');
     
  if (($opt_BadgeUse_featured) and ($product->is_featured()))
     { if ($opt_BadgeType == "TextBoxBadge")
          echo "<div class='BadgeTextShop_Featured'>" . esc_attr($opt_BadgeText_featured) . "</div>";
       else
          echo "<span class='BadgeImgShop_Featured'></span>";
     }
}
$opt_BadgeShopFrom_featured = get_option('optBadgeShopFrom_featured');
if (($opt_BadgeShopFrom_featured == "bot_left") or ($opt_BadgeShopFrom_featured == "bot_right"))
   add_action('woocommerce_before_shop_loop_item_title','wcplb_shop_badge_featured',25);
else
   add_action('woocommerce_before_shop_loop_item','wcplb_shop_badge_featured',25);

function wcplb_shop_badge_top()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_top = get_option('optBadgeText_top');
  $opt_BadgeUse_top = get_option('optBadgeUse_top');

  $tmp_BadgeBestSelling  = get_option('optBadgeBestSelling');
  $tmpId = "-" . $product->get_id() . '-';
  
  if (($opt_BadgeUse_top) and (strpos($tmp_BadgeBestSelling,$tmpId) !== false))
     { if ($opt_BadgeType == "TextBoxBadge")
          echo "<div class='BadgeTextShop_Top'>" . esc_attr($opt_BadgeText_top) . "</div>";
       else
          echo "<span class='BadgeImgShop_Top'></span>";
     }
}
$opt_BadgeShopFrom_top = get_option('optBadgeShopFrom_top');
if (($opt_BadgeShopFrom_top == "bot_left") or ($opt_BadgeShopFrom_top == "bot_right"))
   add_action('woocommerce_before_shop_loop_item_title','wcplb_shop_badge_top',25); 
else
   add_action('woocommerce_before_shop_loop_item','wcplb_shop_badge_top',25);

function wcplb_shop_badge_new()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeText_new = get_option('optBadgeText_new');
  $opt_BadgeUse_new = get_option('optBadgeUse_new');
  $opt_BadgeNewDays = get_option('optBadgeNewDays');  
  $value = $opt_BadgeNewDays;
  if (($opt_BadgeUse_new) and (($product->is_type('simple')) || ($product->is_type('variable'))))
     { $post_date = $product->get_date_created();
       $post_date = date('Y-m-d',strtotime($post_date));
       $limit_date = date('Y-m-d',strtotime("-$value days",time()));
       
       if ($post_date >= $limit_date)
          { if ($opt_BadgeType == "TextBoxBadge")
               echo "<div class='BadgeTextShop_New'>" . esc_attr($opt_BadgeText_new) . "</div>"; 
            else
               echo "<span class='BadgeImgShop_New'></span>";
          }
     }
}
$opt_BadgeShopFrom_new = get_option('optBadgeShopFrom_new');
if (($opt_BadgeShopFrom_new == "bot_left") or ($opt_BadgeShopFrom_new == "bot_right"))
   add_action('woocommerce_before_shop_loop_item_title','wcplb_shop_badge_new',25); 
else
   add_action('woocommerce_before_shop_loop_item','wcplb_shop_badge_new',25);

function wcplb_shop_badge_cat()
{ global $product;
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeUse_cat = get_option('optBadgeUse_cat');

  if (true)
     { $terms = get_the_terms($product->ID,'product_cat');
       foreach ($terms as $term)
               { $tmpProductCatSlug = $term->slug;
                 break;
               }   
       $tmpOptTextCatName = 'optBadgeText_cat_'.$tmpProductCatSlug;
       $tmpBadgeText_cat = get_option($tmpOptTextCatName);
       
       if ($opt_BadgeType == "TextBoxBadge")
               echo "<div class='BadgeTextShop_Cat_" . esc_attr($tmpProductCatSlug) . "'>" . esc_attr($tmpBadgeText_cat) . "</div>"; 
            else
               echo "<span class='BadgeImgShop_Cat_" . esc_attr($tmpProductCatSlug) . "'></span>";
          
     }
}
$opt_BadgeShopFrom_cat = get_option('optBadgeShopFrom_cat');
if (($opt_BadgeShopFrom_cat == "bot_left") or ($opt_BadgeShopFrom_cat == "bot_right"))
   add_action('woocommerce_before_shop_loop_item_title','wcplb_shop_badge_cat',25);
else
   add_action('woocommerce_before_shop_loop_item','wcplb_shop_badge_cat',25);

function wcplb_mylabel_product_percentage_loop()
{ global $product;
  if (!$product->is_on_sale()) return;

  $opt_ShowLabelSingle = get_option('optShowLabelSingle');
  if (!$opt_ShowLabelSingle) return;

  $opt_LabelType = get_option('optLabelType');
  $opt_LabelMainInfo = get_option('optLabelMainInfo');
  $opt_LabelSecondInfo = get_option('optLabelSecondInfo');
  
  if ($product->is_type('simple'))
     { $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
       $max_dif = $product->get_regular_price() - $product->get_sale_price();
       $tmpStrDiscount = "-"; $tmpFontSizeDiscount = "4";
     }
  elseif ($product->is_type('grouped'))
         { $children_ids = $product->get_children();
           foreach ($children_ids as $child_id)
                   { $child_product = wc_get_product($child_id);
                     $price = (float) $child_product->get_regular_price();
                     $sale = (float) $child_product->get_sale_price();
                     if ($price != 0 && !empty($sale))
                        { $percentage = ($price - $sale) / $price * 100;
                          $dif = ($price - $sale);
                        }
                     if ($percentage > $max_percentage) $max_percentage = $percentage;
                     if ($dif > $max_dif) $max_dif = $dif;
                   }
           $tmpStrDiscount = esc_html__('Up to -','next-wc-product-labels-badges'); $tmpFontSizeDiscount = "3";
         }   
  elseif ($product->is_type('variable')) 
         { $max_percentage = 0; $max_dif = 0;
           foreach ($product->get_children() as $child_id)
                   { $variation = wc_get_product($child_id);
                     $price = $variation->get_regular_price();
                     $sale = $variation->get_sale_price(); 
                     if ($price != 0 && !empty($sale))
                        { $percentage = ($price - $sale) / $price * 100;
                          $dif = ($price - $sale);
                        }
                     if ($percentage > $max_percentage) $max_percentage = $percentage;
                     if ($dif > $max_dif) $max_dif = $dif;
                   }
           $tmpStrDiscount = esc_html__('Up to -','next-wc-product-labels-badges'); $tmpFontSizeDiscount = "3";
         }
   if ($max_percentage <= 0) return;
 
   if ($opt_LabelType == "TextBoxLabel")
      { $opt_UseCatColor = get_option('optUseCatColor');
        if ($opt_UseCatColor == 1)
           { $terms = get_the_terms($product->ID, 'product_cat');
             foreach ($terms as $term)
                     { $tmpProductCatSlug = $term->slug;
                       break;
                     }
             echo "<div class=\"label-product-textbox tbx-" . esc_attr(tmpProductCatSlug) . "\">";
           }
        else
           echo "<div class=\"label-product-textbox tbx\">";
        
        switch ($opt_LabelMainInfo)
               { case "Percent":
                      echo "<font size=" . esc_attr($tmpFontSizeDiscount) . "rem>" . esc_attr($tmpStrDiscount) . esc_attr(round($max_percentage)) . "%" . "</font>"; 
                      break;
                      
                 case "Total":
                      echo "<font size=" . esc_attr($tmpFontSizeDiscount) . "rem>" . esc_attr($tmpStrDiscount) . esc_attr(round($max_dif)) . get_woocommerce_currency_symbol() . "</font>"; 
                      break;
                      
                 default:
               }
        if ($opt_LabelSecondInfo)
           { switch ($opt_LabelMainInfo)
               { case "Percent":
                      echo "<br><font size=2rem>(" . esc_attr($tmpStrDiscount) . esc_attr(round($max_dif)) . get_woocommerce_currency_symbol() . ")</font>"; 
                      break;
                      
                 case "Total":
                      echo "<br><font size=2rem>(" . esc_attr($tmpStrDiscount) . esc_attr(round($max_percentage)) . "%)</font>"; 
                      break;
                      
                 default:
               }
           }
        echo "</div>";
      }
   else 
      { echo "<span class='label-product'></span>";
        switch ($opt_LabelMainInfo)
               { case "Percent":
                      echo "<span class='label-product-main-info'>-" . esc_attr(round($max_percentage)) . "%</span>";
                      break;
                      
                 case "Total":
                      echo "<span class='label-product-main-info'>-" . esc_attr($max_dif) . get_woocommerce_currency_symbol() . "</span>";
                      break;
                      
                 default:
               }

        if ($opt_LabelSecondInfo)
           { switch ($opt_LabelMainInfo)
               { case "Percent":
                      echo "<span class='label-product-second-info'>(" . esc_attr($tmpStrDiscount) . esc_attr($max_dif) . get_woocommerce_currency_symbol() . ")</span>";
                      break;
                      
                 case "Total":
                      echo "<span class='label-product-second-info'>(" . esc_attr($tmpStrDiscount) . esc_attr(round($max_percentage)) . "%)</span>";
                      break;
                      
                 default:
               }
           }
      }
}
if ($opt_BadgeProductFrom_new == "rightpage")
   add_action('woocommerce_single_product_summary','wcplb_mylabel_product_percentage_loop',25);
else
   add_action('woocommerce_product_thumbnails','wcplb_mylabel_product_percentage_loop',25); 

function mylabel_shop_percentage_loop()
{ global $product;
  if (!$product->is_on_sale()) return;

  $opt_ShowLabelShop = get_option('optShowLabelShop');
  if (!$opt_ShowLabelShop) return;

  $opt_LabelType = get_option('optLabelType');
  
  if ($product->is_type('simple'))
     { $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
       $tmpStrDiscount = "-"; $tmpFontSizeDiscount = "4";
     }
  elseif ($product->is_type('grouped'))
         { $children_ids = $product->get_children();
           foreach ($children_ids as $child_id)
                   { $child_product = wc_get_product($child_id);
                     $price = (float) $child_product->get_regular_price();
                     $sale = (float) $child_product->get_sale_price();
                     if ($price != 0 && !empty($sale))
                        { $percentage = ($price - $sale) / $price * 100;
                        }
                     if ($percentage > $max_percentage) $max_percentage = $percentage;
                   }
           $tmpStrDiscount = esc_html__('Up to -','next-wc-product-labels-badges'); $tmpFontSizeDiscount = "3";
         }   
  elseif ($product->is_type('variable')) 
         { $max_percentage = 0; $max_dif = 0;
           foreach ($product->get_children() as $child_id)
                   { $variation = wc_get_product($child_id);
                     $price = $variation->get_regular_price();
                     $sale = $variation->get_sale_price(); 
                     if ($price != 0 && !empty($sale))
                        { $percentage = ($price - $sale) / $price * 100;
                        }
                     if ($percentage > $max_percentage) $max_percentage = $percentage;
                   }
           $tmpStrDiscount = esc_html__('Up to -','next-wc-product-labels-badges'); $tmpFontSizeDiscount = "3";
         }
   if ($max_percentage <= 0) return;
                        
  if ($opt_LabelType == "TextBoxLabel")
     { $opt_UseCatColor = get_option('optUseCatColor');
       if ($opt_UseCatColor == 1)
          { $terms = get_the_terms($product->ID, 'product_cat');
            foreach ($terms as $term)
                    { $tmpProductCatSlug = $term->slug;
                      break;
                    }  
            echo "<div class=\"label-shop-textbox tbx-" . esc_attr($tmpProductCatSlug) . "\">-" . esc_attr(round($max_percentage)) . "%</div>";
          }
       else
          echo "<div class=\"label-shop-textbox tbx\">-" . esc_attr(round($max_percentage)) . "%</div>";
     }
  else
     { echo "<span class='label-shop'>-" . esc_attr(round($max_percentage)) . "%</span>";
     }
}
add_action('woocommerce_before_shop_loop_item', 'mylabel_shop_percentage_loop',25);

function GetBadgeSize($parBadgeName)
{ switch ($parBadgeName)
         { case "Ribbon":
                return "120x120";
                break;

           case "DoubleRibbon":
                return "150x50";
                break;
                
           case "LeftBannerIn":
                return "150x50";
                break;
           case "LeftBannerOut":
                return "150x50";
                break;
           case "RightBannerIn":
                return "150x50";
                break;
           case "RightBannerOut":
                return "150x50";
                break;
                                
           case "Stamp":
                return "150x110";
                break;

           case "Medal36":
                return "100x150";
                break;
                
           case "Flower":
                return "100x150";
                break;

           case "Square":
                return "100x150";
                break;
                
           case "Victory":
                return "110x150";
                break;
                
           case "ArrowOut":
                return "50x150";
                break;

           default:
                return "120x120";
                break;
         }
}

function wcplb_BuildCSS()
{ $tmpStr = plugin_dir_path( __DIR__ );
  if (substr($tmpStr,-1) == "/")
     $tmpPos = strrpos($tmpStr,'/',-2);
  else   
     $tmpPos = strrpos($tmpStr,'/',-1);
  $tmpStrPathDynamic = substr($tmpStr,0,$tmpPos) . '/' . WCPLB_PLUGIN_SLUG . '/custom';

  $opt_UseCatColor = get_option('optUseCatColor');
  $opt_LabelName = get_option('optLabelName');
  $opt_LabelColor = get_option('optLabelColor');
  $opt_LabelFont = get_option('optLabelFont');
  $opt_LabelFontColor = get_option('optLabelFontColor');
  $opt_LabelOpacity = get_option('optLabelOpacity');
  $opt_LabelShopFrom = get_option('optLabelShopFrom');
  $opt_LabelShop_X = get_option('optLabelShop_X');
  $opt_LabelShop_Y = get_option('optLabelShop_Y');
  $opt_ShopText_X = get_option('optShopText_X');
  $opt_ShopText_Y = get_option('optShopText_Y');
  $opt_LabelProductFrom = get_option('optLabelProductFrom');
  $opt_LabelProduct_X = get_option('optLabelProduct_X');
  $opt_LabelProduct_Y = get_option('optLabelProduct_Y');
  $opt_LabelMain_X = get_option('optLabelMain_X');
  $opt_LabelMain_Y = get_option('optLabelMain_Y');
  $opt_LabelSecond_X = get_option('optLabelSecond_X');
  $opt_LabelSecond_Y = get_option('optLabelSecond_Y');
  
  $opt_BadgeType = get_option('optBadgeType');
  $opt_BadgeName_featured = get_option('optBadgeName_featured');
  $opt_BadgeUse_featured = get_option('optBadgeUse_featured');
  $opt_BadgeColor_featured = get_option('optBadgeColor_featured');
  $opt_BadgeFontTextbox_featured = get_option('optBadgeFontTextbox_featured');
  $opt_BadgeFontImage_featured = get_option('optBadgeFontImage_featured');
  $opt_BadgeFontColor_featured = get_option('optBadgeFontColor_featured');
  $opt_BadgeOpacity_featured = get_option('optBadgeOpacity_featured');
  $opt_BadgeProductFrom_featured = get_option('optBadgeProductFrom_featured');
  $opt_BadgeProduct_X_featured = get_option('optBadgeProduct_X_featured');
  $opt_BadgeProduct_Y_featured = get_option('optBadgeProduct_Y_featured');
  $opt_BadgeShopFrom_featured = get_option('optBadgeShopFrom_featured');
  $opt_BadgeShop_X_featured = get_option('optBadgeShop_X_featured');
  $opt_BadgeShop_Y_featured = get_option('optBadgeShop_Y_featured');
   
  $opt_BadgeName_new = get_option('optBadgeName_new');  
  $opt_BadgeUse_new = get_option('optBadgeUse_new');
  $opt_BadgeColor_new = get_option('optBadgeColor_new');
  $opt_BadgeFontTextbox_new = get_option('optBadgeFontTextbox_new');
  $opt_BadgeFontImage_new = get_option('optBadgeFontImage_new');
  $opt_BadgeFontColor_new = get_option('optBadgeFontColor_new');
  $opt_BadgeOpacity_new = get_option('optBadgeOpacity_new');
  $opt_BadgeProductFrom_new = get_option('optBadgeProductFrom_new');
  $opt_BadgeProduct_X_new = get_option('optBadgeProduct_X_new');
  $opt_BadgeProduct_Y_new = get_option('optBadgeProduct_Y_new');
  $opt_BadgeShopFrom_new = get_option('optBadgeShopFrom_new');
  $opt_BadgeShop_X_new = get_option('optBadgeShop_X_new');
  $opt_BadgeShop_Y_new = get_option('optBadgeShop_Y_new');
  
  $opt_BadgeName_sold = get_option('optBadgeName_sold');
  $opt_BadgeUse_sold = get_option('optBadgeUse_sold');
  $opt_BadgeColor_sold = get_option('optBadgeColor_sold');  
  $opt_BadgeFontTextbox_sold = get_option('optBadgeFontTextbox_sold');
  $opt_BadgeFontImage_sold = get_option('optBadgeFontImage_sold');
  $opt_BadgeFontColor_sold = get_option('optBadgeFontColor_sold');
  $opt_BadgeOpacity_sold = get_option('optBadgeOpacity_sold');
  $opt_BadgeProductFrom_sold = get_option('optBadgeProductFrom_sold');
  $opt_BadgeProduct_X_sold = get_option('optBadgeProduct_X_sold');
  $opt_BadgeProduct_Y_sold = get_option('optBadgeProduct_Y_sold');
  $opt_BadgeShopFrom_sold = get_option('optBadgeShopFrom_sold');
  $opt_BadgeShop_X_sold = get_option('optBadgeShop_X_sold');
  $opt_BadgeShop_Y_sold = get_option('optBadgeShop_Y_sold');
  
  $opt_BadgeName_top = get_option('optBadgeName_top');
  $opt_BadgeUse_top = get_option('optBadgeUse_top');
  $opt_BadgeColor_top = get_option('optBadgeColor_top');  
  $opt_BadgeFontTextbox_top = get_option('optBadgeFontTextbox_top');
  $opt_BadgeFontImage_top = get_option('optBadgeFontImage_top');
  $opt_BadgeFontColor_top = get_option('optBadgeFontColor_top');
  $opt_BadgeOpacity_top = get_option('optBadgeOpacity_top');
  $opt_BadgeProductFrom_top = get_option('optBadgeProductFrom_top');
  $opt_BadgeProduct_X_top = get_option('optBadgeProduct_X_top');
  $opt_BadgeProduct_Y_top = get_option('optBadgeProduct_Y_top');
  $opt_BadgeShopFrom_top = get_option('optBadgeShopFrom_top');
  $opt_BadgeShop_X_top = get_option('optBadgeShop_X_top');
  $opt_BadgeShop_Y_top = get_option('optBadgeShop_Y_top');
  
  $opt_BadgeName_quantity = get_option('optBadgeName_quantity');
  $opt_BadgeUse_quantity = get_option('optBadgeUse_quantity');
  $opt_BadgeColor_quantity = get_option('optBadgeColor_quantity');  
  $opt_BadgeFontTextbox_quantity = get_option('optBadgeFontTextbox_quantity');
  $opt_BadgeFontImage_quantity = get_option('optBadgeFontImage_quantity');
  $opt_BadgeFontColor_quantity = get_option('optBadgeFontColor_quantity');
  $opt_BadgeOpacity_quantity = get_option('optBadgeOpacity_quantity');
  $opt_BadgeProductFrom_quantity = get_option('optBadgeProductFrom_quantity');
  $opt_BadgeProduct_X_quantity = get_option('optBadgeProduct_X_quantity');
  $opt_BadgeProduct_Y_quantity = get_option('optBadgeProduct_Y_quantity');
  $opt_BadgeShopFrom_quantity = get_option('optBadgeShopFrom_quantity');
  $opt_BadgeShop_X_quantity = get_option('optBadgeShop_X_quantity');
  $opt_BadgeShop_Y_quantity = get_option('optBadgeShop_Y_quantity');
  
  $opt_BadgeUse_cat = get_option('optBadgeUse_cat');
  $opt_BadgeName_cat = get_option('optBadgeName_cat');
  $opt_BadgeOpacity_cat = get_option('optBadgeOpacity_cat');
  $opt_BadgeProductFrom_cat =   get_option('optBadgeProductFrom_cat');
  $opt_BadgeProduct_X_cat = get_option('optBadgeProduct_X_cat');
  $opt_BadgeProduct_Y_cat = get_option('optBadgeProduct_Y_cat');
  $opt_BadgeShopFrom_cat =   get_option('optBadgeShopFrom_cat');
  $opt_BadgeShop_X_cat = get_option('optBadgeShop_X_cat');
  $opt_BadgeShop_Y_cat = get_option('optBadgeShop_Y_cat');
  $opt_BadgeFontTextbox_cat = get_option('optBadgeFontTextbox_cat');
  $opt_BadgeFontImage_cat = get_option('optBadgeFontImage_cat');
  $opt_BadgeFontSize_cat = get_option('optBadgeFontSize_cat');
  $opt_BadgeFontColor_cat = get_option('optBadgeFontColor_cat');
  $opt_BadgeTextDir_cat = get_option('optBadgeTextDir_cat');
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
                 $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
                 $tmpOptColorCatName = 'optBadgeColor_cat_'.$tmpCatSlug;
                 ${'opt_BadgeColor_cat_'.$tmpCatSlug} = get_option($tmpOptColorCatName);
               
                 $tmpOptTextCatName = 'optBadgeText_cat_'.$tmpCatSlug;
                 ${'opt_BadgeText_cat_'.$tmpCatSlug} = get_option($tmpOptTextCatName);
               }
     }
   
  $opt_CatAssoHierarchy = get_option('optCatAssoHierarchy');
  
  $Width = 150; $Height = 150;
  if ($opt_BadgeType == "TextBoxBadge")
     { $Width = 150; $Height = 150;
     }
  else
     { $tmpWxH = GetBadgeSize($opt_BadgeName_featured); $listWxH = explode("x",$tmpWxH);
        $tmpWidth_featured = $listWxH[0]; $tmpHeight_featured = $listWxH[1];
       $tmpWxH = GetBadgeSize($opt_BadgeName_new); $listWxH = explode("x",$tmpWxH);
        $tmpWidth_new = $listWxH[0]; $tmpHeight_new = $listWxH[1];
       $tmpWxH = GetBadgeSize($opt_BadgeName_top); $listWxH = explode("x",$tmpWxH);
        $tmpWidth_top = $listWxH[0]; $tmpHeight_top = $listWxH[1];
       $tmpWxH = GetBadgeSize($opt_BadgeName_sold); $listWxH = explode("x",$tmpWxH);
        $tmpWidth_sold = $listWxH[0]; $tmpHeight_sold = $listWxH[1];
       $tmpWxH = GetBadgeSize($opt_BadgeName_quantity); $listWxH = explode("x",$tmpWxH);
        $tmpWidth_quantity = $listWxH[0]; $tmpHeight_quantity = $listWxH[1];
       $tmpWxH = GetBadgeSize($opt_BadgeName_cat); $listWxH = explode("x",$tmpWxH);
        $tmpWidth_cat = $listWxH[0]; $tmpHeight_cat= $listWxH[1];
     }
  
  $cssName = "wcplb.css";
  $fd = fopen($tmpStrPathDynamic . "/" . $cssName, "w");
  
  if ($opt_LabelProductFrom == "rightpage") $opt_LabelProductFrom = "right";
  fwrite($fd,".label-product {\n");
  fwrite($fd,"position: absolute;\n");
  fwrite($fd,"top: " . $opt_LabelProduct_Y . "px;\n");
  fwrite($fd,$opt_LabelProductFrom . ": " . $opt_LabelProduct_X . "px;\n");
  fwrite($fd,"width: " . $Width . "px;\n");
  fwrite($fd,"height: " . $Height . "px;\n");  
  fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/LabelProduct.png) 0 0 no-repeat;\n");
  fwrite($fd,"opacity: " . $opt_LabelOpacity/100 . ";\n");
  fwrite($fd,"}\n");
  fwrite($fd,"\n"); 
  
  switch ($opt_LabelName)
         { case "Label":
                $tmp_ShopText_X = $opt_ShopText_X + 15;
                $tmp_ShopText_Y = $opt_ShopText_Y + 22;
                $tmp_LabelMain_X = $opt_LabelMain_X + 40;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 40;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 50;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 70;
                break;
           case "Flag":
                $tmp_ShopText_X = $opt_ShopText_X + 3;
                $tmp_ShopText_Y = $opt_ShopText_Y + 3;
                $tmp_LabelMain_X = $opt_LabelMain_X + 5;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 10;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 10;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 50;
                break;
           case "Flash":
                $tmp_ShopText_X = $opt_ShopText_X + 5;
                $tmp_ShopText_Y = $opt_ShopText_Y + 15;
                $tmp_LabelMain_X = $opt_LabelMain_X + 10;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 25;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 30;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 75;
                break;                
           case "Corner":
                $tmp_ShopText_X = $opt_ShopText_X + 1;
                $tmp_ShopText_Y = $opt_ShopText_Y + 18;
                $tmp_LabelMain_X = $opt_LabelMain_X + 5;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 35;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 25;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 70;
                break;
           case "Star":
                $tmp_ShopText_X = $opt_ShopText_X + 5;
                $tmp_ShopText_Y = $opt_ShopText_Y + 15;
                $tmp_LabelMain_X = $opt_LabelMain_X + 15;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 36;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 28;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 66;
                break;
           case "Star5":
                $tmp_ShopText_X = $opt_ShopText_X + 12;
                $tmp_ShopText_Y = $opt_ShopText_Y + 22;
                $tmp_LabelMain_X = $opt_LabelMain_X + 26;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 48;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 35;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 75;
                break;    
           case "Star8":
                $tmp_ShopText_X = $opt_ShopText_X + 5;
                $tmp_ShopText_Y = $opt_ShopText_Y + 16;
                $tmp_LabelMain_X = $opt_LabelMain_X + 12;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 30;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 30;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 65;
                break;                            
           case "Drop":
                $tmp_ShopText_X = $opt_ShopText_X + 0;
                $tmp_ShopText_Y = $opt_ShopText_Y + 15;
                $tmp_LabelMain_X = $opt_LabelMain_X + 5;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 35;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 25;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 70;
                break;
          case "Circle":
                $tmp_ShopText_X = $opt_ShopText_X + 3;
                $tmp_ShopText_Y = $opt_ShopText_Y + 22;
                $tmp_LabelMain_X = $opt_LabelMain_X + 10;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 45;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 30;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 80;
                break;
          case "Bubble":
                $tmp_ShopText_X = $opt_ShopText_X + 4;
                $tmp_ShopText_Y = $opt_ShopText_Y + 18;
                $tmp_LabelMain_X = $opt_LabelMain_X + 10;
                $tmp_LabelMain_Y = $opt_LabelMain_Y + 40;
                $tmp_LabelSecond_X = $opt_LabelSecond_X + 30;
                $tmp_LabelSecond_Y = $opt_LabelSecond_Y + 70;
                break;                
         }       
         
  fwrite($fd,".label-product-main-info {\n");
  fwrite($fd,"font-weight: bold;\n");
  fwrite($fd,"position: absolute;\n");
  fwrite($fd,"top: " . $opt_LabelProduct_Y . "px;\n");
  fwrite($fd,$opt_LabelProductFrom . ": " . $opt_LabelProduct_X . "px;\n");
  fwrite($fd,"width: " . $Width . "px;\n");
  fwrite($fd,"height: " . $Height . "px;\n");
  fwrite($fd,"color: " . $opt_LabelFontColor . ";\n");
  fwrite($fd,"padding-top: " . $tmp_LabelMain_Y . "px;\n");
  fwrite($fd,"padding-left: " . $tmp_LabelMain_X . "px;\n");
  fwrite($fd,"box-sizing: border-box;\n");
  fwrite($fd,"z-index: 1;\n");
  fwrite($fd,"font-family: " . $opt_LabelFont . ";\n");
  fwrite($fd,"font-size: 2.1rem;\n");
  fwrite($fd,"font-weight: 600;\n");
  fwrite($fd,"line-height: 18px;\n");
  fwrite($fd,"opacity: 0.8;\n");
  fwrite($fd,"}\n");
  fwrite($fd,"\n");
  
  fwrite($fd,".label-product-second-info {\n");
  fwrite($fd,"position: absolute;\n");
  fwrite($fd,"top: " . $opt_LabelProduct_Y . "px;\n");
  fwrite($fd,$opt_LabelProductFrom . ": " . $opt_LabelProduct_X . "px;\n");
  fwrite($fd,"width: " . $Width . "px;\n");
  fwrite($fd,"height: " . $Height . "px;\n");
  fwrite($fd,"color: " . $opt_LabelFontColor . ";\n");
  fwrite($fd,"padding-top: " . $tmp_LabelSecond_Y . "px;\n");
  fwrite($fd,"padding-left: " . $tmp_LabelSecond_X . "px;\n");
  fwrite($fd,"box-sizing: border-box;\n");
  fwrite($fd,"z-index: 1;\n");
  fwrite($fd,"font-family: " . $opt_LabelFont . ";\n");
  fwrite($fd,"font-size: 0.9rem;\n");
  fwrite($fd,"font-weight: 100;\n");
  fwrite($fd,"line-height: 10px;\n");
  fwrite($fd,"}\n");
  fwrite($fd,"\n");
    
  fwrite($fd,".label-product-textbox {\n");
  fwrite($fd,"display: inline;\n");
  fwrite($fd,"padding: .2em .6em .3em;\n");
  fwrite($fd,"font-family: " . $opt_LabelFont . ";\n");
  fwrite($fd,"font-size: 100%;\n");
  fwrite($fd,"font-weight: bold;\n");
  fwrite($fd,"color: " . $opt_LabelFontColor . ";\n");
  fwrite($fd,"text-align: center;\n");
  fwrite($fd,"border-radius: .25em;\n");
  fwrite($fd,"position: absolute;\n");
  fwrite($fd,"top: " . $opt_LabelProduct_Y . "px;\n");
  fwrite($fd,$opt_LabelProductFrom . ": " . $opt_LabelProduct_X . "px;\n");
  fwrite($fd,"z-index: 500;\n");
  fwrite($fd,"opacity: " . $opt_LabelOpacity/100 . ";\n");
  fwrite($fd,"}\n");
  fwrite($fd,"\n");

if ($opt_BadgeType == "TextBoxBadge") {
  if ($opt_BadgeUse_new)
     { if ($opt_BadgeProductFrom_new == "rightpage") $opt_BadgeProductFrom_new = "right";
       fwrite($fd,".BadgeTextProduct_New {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_new . ";\n");
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_new . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"font-weight: bold;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_new . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_new . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_new . ": " . $opt_BadgeProduct_X_new . "px;\n");
       fwrite($fd,"z-index: 999;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_new/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_featured)
     { if ($opt_BadgeProductFrom_featured == "rightpage") $opt_BadgeProductFrom_featured = "right";
       fwrite($fd,".BadgeTextProduct_Featured {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_featured . ";\n");
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_featured . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"font-weight: bold;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_featured . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_featured . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_featured . ": " . $opt_BadgeProduct_X_featured . "px;\n");
       fwrite($fd,"z-index: 999;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_featured/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_top)
     { if ($opt_BadgeProductFrom_top == "rightpage") $opt_BadgeProductFrom_top = "right";
       fwrite($fd,".BadgeTextProduct_Top {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_top . ";\n");
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_top . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"font-weight: bold;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_top . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_top . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_top . ": " . $opt_BadgeProduct_X_top . "px;\n");
       fwrite($fd,"z-index: 999;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_top/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_sold)
     { if ($opt_BadgeProductFrom_sold == "rightpage") $opt_BadgeProductFrom_sold = "right";
       fwrite($fd,".BadgeTextProduct_Sold {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_sold . ";\n");
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_sold . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"font-weight: bold;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_sold . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_sold . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_sold . ": " . $opt_BadgeProduct_X_sold . "px;\n");
       fwrite($fd,"z-index: 999;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_sold/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_quantity)
     { if ($opt_BadgeProductFrom_quantity == "rightpage") $opt_BadgeProductFrom_quantity = "right";
       fwrite($fd,".BadgeTextProduct_Quantity {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_quantity . ";\n");
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_quantity . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"font-weight: bold;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_quantity . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_quantity . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_quantity . ": " . $opt_BadgeProduct_X_quantity . "px;\n");
       fwrite($fd,"z-index: 999;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_quantity/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_cat)
     { if ($opt_BadgeProductFrom_cat == "rightpage") $opt_BadgeProductFrom_cat = "right";
       foreach ($product_categories as $key => $category)
               { $tmpCatSlug = $category->slug;
                 $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
                 fwrite($fd,".BadgeTextProduct_Cat_" . $tmpCatSlug . " {\n");
                 fwrite($fd,"background-color: " . ${'opt_BadgeColor_cat_'.$tmpCatSlug} . ";\n");
                 fwrite($fd,"display: inline;\n");
                 fwrite($fd,"padding: .2em .6em .3em;\n");
                 fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_cat . ";\n");
                 fwrite($fd,"font-size: 100%;\n");
                 fwrite($fd,"font-weight: bold;\n");
                 fwrite($fd,"color: " . $opt_BadgeFontColor_cat . ";\n");
                 fwrite($fd,"text-align: center;\n");
                 fwrite($fd,"border-radius: .25em;\n");
                 fwrite($fd,"position: absolute;\n");
                 fwrite($fd,"top: " . $opt_BadgeProduct_Y_cat . "px;\n");
                 fwrite($fd,$opt_BadgeProductFrom_cat . ": " . $opt_BadgeProduct_X_cat . "px;\n");
                 fwrite($fd,"z-index: 999;\n");
                 fwrite($fd,"opacity: " . $opt_BadgeOpacity_cat/100 . ";\n");
                 fwrite($fd,"}\n");
                 fwrite($fd,"\n");
               }
     }
}

if ($opt_BadgeType == "ImageBadge") {                        
  if ($opt_BadgeUse_new)
     { if ($opt_BadgeProductFrom_new == "rightpage") $opt_BadgeProductFrom_new = "right";
       fwrite($fd,".BadgeImgProduct_New {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_new . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_new . ": " . $opt_BadgeProduct_X_new . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_new . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_new . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeProduct_new.png) 0 0 no-repeat;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_new . ";\n");
       fwrite($fd,"box-sizing: border-box;\n");
       fwrite($fd,"z-index: 1;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_new/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_featured)
     { if ($opt_BadgeProductFrom_featured == "rightpage") $opt_BadgeProductFrom_featured = "right";
       fwrite($fd,".BadgeImgProduct_Featured {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_featured . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_featured . ": " . $opt_BadgeProduct_X_featured . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_featured . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_featured . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeProduct_featured.png) 0 0 no-repeat;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_featured . ";\n");
       fwrite($fd,"box-sizing: border-box;\n");
       fwrite($fd,"z-index: 1;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_featured/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_top)
     { if ($opt_BadgeProductFrom_top == "rightpage") $opt_BadgeProductFrom_top = "right";
       fwrite($fd,".BadgeImgProduct_Top {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_top . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_top . ": " . $opt_BadgeProduct_X_top . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_top . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_top . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeProduct_top.png) 0 0 no-repeat;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_top . ";\n");
       fwrite($fd,"box-sizing: border-box;\n");
       fwrite($fd,"z-index: 1;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_top/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_sold)
     { if ($opt_BadgeProductFrom_sold == "rightpage") $opt_BadgeProductFrom_sold = "right";
       fwrite($fd,".BadgeImgProduct_Sold {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_sold . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_sold . ": " . $opt_BadgeProduct_X_sold . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_sold . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_sold . "px;\n");  
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeProduct_sold.png) 0 0 no-repeat;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_sold . ";\n");
       fwrite($fd,"box-sizing: border-box;\n");
       fwrite($fd,"z-index: 1;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_sold/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_quantity)
     { if ($opt_BadgeProductFrom_quantity == "rightpage") $opt_BadgeProductFrom_quantity = "right";
       fwrite($fd,".BadgeImgProduct_Quantity {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeProduct_Y_quantity . "px;\n");
       fwrite($fd,$opt_BadgeProductFrom_quantity . ": " . $opt_BadgeProduct_X_quantity . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_quantity . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_quantity . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeProduct_quantity.png) 0 0 no-repeat;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_quantity . ";\n");
       fwrite($fd,"box-sizing: border-box;\n");
       fwrite($fd,"z-index: 1;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_quantity/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }     
  if ($opt_BadgeUse_cat)
     { if ($opt_BadgeProductFrom_cat == "rightpage") $opt_BadgeProductFrom_cat = "right";
       foreach ($product_categories as $key => $category)
               { $tmpCatSlug = $category->slug;
                 $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
                 fwrite($fd,".BadgeImgProduct_Cat_" . $tmpCatSlug . " {\n");
                 fwrite($fd,"position: absolute;\n");
                 fwrite($fd,"top: " . $opt_BadgeProduct_Y_cat . "px;\n");
                 fwrite($fd,$opt_BadgeProductFrom_cat . ": " . $opt_BadgeProduct_X_cat . "px;\n");
                 fwrite($fd,"width: " . $tmpWidth_cat . "px;\n");
                 fwrite($fd,"height: " . $tmpHeight_cat . "px;\n"); 
                 fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeProduct_cat_" . $tmpCatSlug . ".png) 0 0 no-repeat;\n");
                 fwrite($fd,"color: " . $opt_BadgeFontColor_cat . ";\n");
                 fwrite($fd,"box-sizing: border-box;\n");
                 fwrite($fd,"z-index: 1;\n");
                 fwrite($fd,"opacity: " . $opt_BadgeOpacity_cat/100 . ";\n");
                 fwrite($fd,"}\n");
                 fwrite($fd,"\n");
               }
     }
}
                  
  fwrite($fd,".label-shop {\n");
  fwrite($fd,"font-weight: bold;\n");
  fwrite($fd,"position: absolute;\n");
  fwrite($fd,"top: " . $opt_LabelShop_Y . "px;\n");
  fwrite($fd,$opt_LabelShopFrom . ": " . $opt_LabelShop_X . "px;\n");
  fwrite($fd,"width: 75px;\n");
  fwrite($fd,"height: 75px;\n");
  fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/LabelShop.png) 0 0 no-repeat;\n");
  fwrite($fd,"color: " . $opt_LabelFontColor . ";\n");
  fwrite($fd,"padding-top: " . $tmp_ShopText_Y . "px;\n");
  fwrite($fd,"padding-left: " . $tmp_ShopText_X . "px;\n");
  fwrite($fd,"box-sizing: border-box;\n");
  fwrite($fd,"z-index: 1;\n");
  fwrite($fd,"font-family: " . $opt_LabelFont . ";\n");
  fwrite($fd,"font-size: 1.1rem;\n");
  fwrite($fd,"line-height: 15px;\n");
  fwrite($fd,"opacity: " . $opt_LabelOpacity/100 . ";\n");
  fwrite($fd,"}\n");
  fwrite($fd,"\n");
  
  fwrite($fd,".label-shop-textbox {\n");
  fwrite($fd,"font-weight: bold;\n");  
  fwrite($fd,"display: inline;\n");
  fwrite($fd,"padding: .2em .6em .3em;\n");
  fwrite($fd,"font-family: " . $opt_LabelFont . ";\n");
  fwrite($fd,"font-size: 100%;\n");
  fwrite($fd,"color: " . $opt_LabelFontColor . ";\n");
  fwrite($fd,"text-align: center;\n");
  fwrite($fd,"border-radius: .25em;\n");
  fwrite($fd,"position: absolute;\n");
  fwrite($fd,"top: " . $opt_LabelShop_Y . "px;\n");
  fwrite($fd,$opt_LabelShopFrom . ": " . $opt_LabelShop_X . "px;\n");
  fwrite($fd,"z-index: 500;\n");
  fwrite($fd,"opacity: " . $opt_LabelOpacity/100 . ";\n");
  fwrite($fd,"}\n");
  fwrite($fd,"\n");

if ($opt_BadgeType == "TextBoxBadge") {
  if ($opt_BadgeUse_new)
     { if (($opt_BadgeShopFrom_new == "bot_left") or ($opt_BadgeShopFrom_new == "bot_right")) $opt_BadgeShop_Y_new -= $tmpHeight_new/2;
       if (($opt_BadgeShopFrom_new == "bot_left") or ($opt_BadgeShopFrom_new == "top_left"))
          $opt_BadgeShopFrom_new = "left";
       else
          $opt_BadgeShopFrom_new = "right";
       fwrite($fd,".BadgeTextShop_New {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_new . ";\n");
       fwrite($fd,"font-weight: bold;\n");  
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_new . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_new . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_new . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_new . ": " . $opt_BadgeShop_X_new . "px;\n");
       fwrite($fd,"z-index: 500;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_new/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_featured)
     { if (($opt_BadgeShopFrom_featured == "bot_left") or ($opt_BadgeShopFrom_featured == "bot_right")) $opt_BadgeShop_Y_featured -= $tmpHeight_featured/2;
       if (($opt_BadgeShopFrom_featured == "bot_left") or ($opt_BadgeShopFrom_featured == "top_left"))
          $opt_BadgeShopFrom_featured = "left";
       else
          $opt_BadgeShopFrom_featured = "right";
       fwrite($fd,".BadgeTextShop_Featured {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_featured . ";\n");
       fwrite($fd,"font-weight: bold;\n");  
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_featured . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_featured . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_featured . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_featured . ": " . $opt_BadgeShop_X_featured . "px;\n");
       fwrite($fd,"z-index: 500;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_featured/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_top)
     { if (($opt_BadgeShopFrom_top == "bot_left") or ($opt_BadgeShopFrom_top == "bot_right")) $opt_BadgeShop_Y_top -= $tmpHeight_top/2;
       if (($opt_BadgeShopFrom_top == "bot_left") or ($opt_BadgeShopFrom_top == "top_left"))
          $opt_BadgeShopFrom_top = "left";
       else
          $opt_BadgeShopFrom_top = "right";
       fwrite($fd,".BadgeTextShop_Top {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_top . ";\n");
       fwrite($fd,"font-weight: bold;\n");  
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_top . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_top . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_top . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_top . ": " . $opt_BadgeShop_X_top . "px;\n");
       fwrite($fd,"z-index: 500;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_top/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_sold)
     { if (($opt_BadgeShopFrom_sold == "bot_left") or ($opt_BadgeShopFrom_sold == "bot_right")) $opt_BadgeShop_Y_sold -= $tmpHeight_sold/2;
       if (($opt_BadgeShopFrom_sold == "bot_left") or ($opt_BadgeShopFrom_sold == "top_left"))
          $opt_BadgeShopFrom_sold = "left";
       else
          $opt_BadgeShopFrom_sold = "right";
       fwrite($fd,".BadgeTextShop_Sold {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_sold . ";\n");
       fwrite($fd,"font-weight: bold;\n");  
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_sold . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_sold . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_sold . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_sold . ": " . $opt_BadgeShop_X_sold . "px;\n");
       fwrite($fd,"z-index: 500;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_sold/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_quantity)
     { if (($opt_BadgeShopFrom_quantity == "bot_left") or ($opt_BadgeShopFrom_quantity == "bot_right")) $opt_BadgeShop_Y_quantity -= $tmpHeight_quantity/2;
       if (($opt_BadgeShopFrom_quantity == "bot_left") or ($opt_BadgeShopFrom_quantity == "top_left"))
          $opt_BadgeShopFrom_quantity = "left";
       else
          $opt_BadgeShopFrom_quantity = "right";
       fwrite($fd,".BadgeTextShop_Quantity {\n");
       fwrite($fd,"background-color: " . $opt_BadgeColor_quantity . ";\n");
       fwrite($fd,"font-weight: bold;\n");  
       fwrite($fd,"display: inline;\n");
       fwrite($fd,"padding: .2em .6em .3em;\n");
       fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_quantity . ";\n");
       fwrite($fd,"font-size: 100%;\n");
       fwrite($fd,"color: " . $opt_BadgeFontColor_quantity . ";\n");
       fwrite($fd,"text-align: center;\n");
       fwrite($fd,"border-radius: .25em;\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_quantity . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_quantity . ": " . $opt_BadgeShop_X_quantity . "px;\n");
       fwrite($fd,"z-index: 500;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_quantity/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }  
  if ($opt_BadgeUse_cat)
     { if (($opt_BadgeShopFrom_cat == "bot_left") or ($opt_BadgeShopFrom_cat == "bot_right")) $opt_BadgeShop_Y_cat -= $tmpHeight_quantity/2;
       if (($opt_BadgeShopFrom_cat == "bot_left") or ($opt_BadgeShopFrom_cat == "top_left"))
          $opt_BadgeShopFrom_cat = "left";
       else
          $opt_BadgeShopFrom_cat = "right";
          
       foreach ($product_categories as $key => $category)
               { $tmpCatSlug = $category->slug;
                 $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
                 
                 fwrite($fd,".BadgeTextShop_Cat_" . $tmpCatSlug . " {\n");
                 fwrite($fd,"background-color: " . ${'opt_BadgeColor_cat_'.$tmpCatSlug} . ";\n");
                 fwrite($fd,"font-weight: bold;\n");  
                 fwrite($fd,"display: inline;\n");
                 fwrite($fd,"padding: .2em .6em .3em;\n");
                 fwrite($fd,"font-family: " . $opt_BadgeFontTextbox_cat . ";\n");
                 fwrite($fd,"font-size: 100%;\n");
                 fwrite($fd,"color: " . $opt_BadgeFontColor_cat . ";\n");
                 fwrite($fd,"text-align: center;\n");
                 fwrite($fd,"border-radius: .25em;\n");
                 fwrite($fd,"position: absolute;\n");
                 fwrite($fd,"top: " . $opt_BadgeShop_Y_cat . "px;\n");
                 fwrite($fd,$opt_BadgeShopFrom_cat . ": " . $opt_BadgeShop_X_cat . "px;\n");
                 fwrite($fd,"z-index: 500;\n");
                 fwrite($fd,"opacity: " . $opt_BadgeOpacity_cat/100 . ";\n");
                 fwrite($fd,"}\n");
                 fwrite($fd,"\n");
               }
     }
}

if ($opt_BadgeType == "ImageBadge") {      
  if ($opt_BadgeUse_new)
     { if (($opt_BadgeShopFrom_new == "bot_left") or ($opt_BadgeShopFrom_new == "bot_right")) $opt_BadgeShop_Y_new -= $tmpHeight_new/2;
       if (($opt_BadgeShopFrom_new == "bot_left") or ($opt_BadgeShopFrom_new == "top_left"))
          $opt_BadgeShopFrom_new = "left";
       else
          $opt_BadgeShopFrom_new = "right";
       fwrite($fd,".BadgeImgShop_New {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_new . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_new . ": " . $opt_BadgeShop_X_new . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_new/2 . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_new/2 . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeShop_new.png) 0 0 no-repeat;\n");
       fwrite($fd,"z-index: 15;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_new/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_featured)
     { if (($opt_BadgeShopFrom_featured == "bot_left") or ($opt_BadgeShopFrom_featured == "bot_right")) $opt_BadgeShop_Y_featured -= $tmpHeight_featured/2;
       if (($opt_BadgeShopFrom_featured == "bot_left") or ($opt_BadgeShopFrom_featured == "top_left"))
          $opt_BadgeShopFrom_featured = "left";
       else
          $opt_BadgeShopFrom_featured = "right";
       fwrite($fd,".BadgeImgShop_Featured {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_featured . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_featured . ": " . $opt_BadgeShop_X_featured . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_featured/2 . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_featured/2 . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeShop_featured.png) 0 0 no-repeat;\n");
       fwrite($fd,"z-index: 15;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_featured/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_top)
     { if (($opt_BadgeShopFrom_top == "bot_left") or ($opt_BadgeShopFrom_top== "bot_right")) $opt_BadgeShop_Y_top -= $tmpHeight_top/2;
       if (($opt_BadgeShopFrom_top == "bot_left") or ($opt_BadgeShopFrom_top == "top_left"))
          $opt_BadgeShopFrom_top = "left";
       else
          $opt_BadgeShopFrom_top = "right";
       fwrite($fd,".BadgeImgShop_Top {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_top . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_top . ": " . $opt_BadgeShop_X_top . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_top/2 . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_top/2 . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeShop_top.png) 0 0 no-repeat;\n");
       fwrite($fd,"z-index: 15;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_top/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_sold)
     { if (($opt_BadgeShopFrom_sold == "bot_left") or ($opt_BadgeShopFrom_sold == "bot_right")) $opt_BadgeShop_Y_sold -= $tmpHeight_sold/2;
       if (($opt_BadgeShopFrom_sold == "bot_left") or ($opt_BadgeShopFrom_sold == "top_left"))
          $opt_BadgeShopFrom_sold = "left";
       else
          $opt_BadgeShopFrom_sold = "right";
       fwrite($fd,".BadgeImgShop_Sold {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_sold . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_sold . ": " . $opt_BadgeShop_X_sold . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_sold/2 . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_sold/2 . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeShop_sold.png) 0 0 no-repeat;\n");
       fwrite($fd,"z-index: 15;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_sold/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_quantity)
     { if (($opt_BadgeShopFrom_quantity == "bot_left") or ($opt_BadgeShopFrom_quantity == "bot_right")) $opt_BadgeShop_Y_quantity -= $tmpHeight_quantity/2;
       if (($opt_BadgeShopFrom_quantity == "bot_left") or ($opt_BadgeShopFrom_quantity == "top_left"))
          $opt_BadgeShopFrom_quantity = "left";
       else
          $opt_BadgeShopFrom_quantity = "right";
       fwrite($fd,".BadgeImgShop_Quantity {\n");
       fwrite($fd,"position: absolute;\n");
       fwrite($fd,"top: " . $opt_BadgeShop_Y_quantity . "px;\n");
       fwrite($fd,$opt_BadgeShopFrom_quantity . ": " . $opt_BadgeShop_X_quantity . "px;\n");
       fwrite($fd,"width: " . $tmpWidth_quantity/2 . "px;\n");
       fwrite($fd,"height: " . $tmpHeight_quantity/2 . "px;\n"); 
       fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeShop_quantity.png) 0 0 no-repeat;\n");
       fwrite($fd,"z-index: 15;\n");
       fwrite($fd,"opacity: " . $opt_BadgeOpacity_quantity/100 . ";\n");
       fwrite($fd,"}\n");
       fwrite($fd,"\n");
     }
  if ($opt_BadgeUse_cat)
     { if (($opt_BadgeShopFrom_cat == "bot_left") or ($opt_BadgeShopFrom_cat == "bot_right")) $opt_BadgeShop_Y_cat -= $tmpHeight_quantity/2;
       if (($opt_BadgeShopFrom_cat == "bot_left") or ($opt_BadgeShopFrom_cat == "top_left"))
          $opt_BadgeShopFrom_cat = "left";
       else
          $opt_BadgeShopFrom_cat = "right";
          
       foreach ($product_categories as $key => $category)
               { $tmpCatSlug = $category->slug;
                 $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
       
                 fwrite($fd,".BadgeImgShop_Cat_" . $tmpCatSlug . " {\n");
                 fwrite($fd,"position: absolute;\n");
                 fwrite($fd,"top: " . $opt_BadgeShop_Y_cat . "px;\n");
                 fwrite($fd,$opt_BadgeShopFrom_cat . ": " . $opt_BadgeShop_X_cat . "px;\n");
                 fwrite($fd,"width: " . $tmpWidth_cat/2 . "px;\n");
                 fwrite($fd,"height: " . $tmpHeight_cat/2 . "px;\n"); 
                 fwrite($fd,"background: transparent url(" . plugin_dir_url( __DIR__ ) . "custom/BadgeShop_cat_" . $tmpCatSlug . ".png) 0 0 no-repeat;\n");
                 fwrite($fd,"z-index: 15;\n");
                 fwrite($fd,"opacity: " . $opt_BadgeOpacity_cat/100 . ";\n");
                 fwrite($fd,"}\n");
                 fwrite($fd,"\n");
               }
     }
}
          
  if ($opt_UseCatColor == 1)
     { if (!empty($product_categories))
          { foreach ($product_categories as $key => $category)
                    { $tmpCatSlug = $category->slug;
                      $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
       
                      fwrite($fd,".tbx-" . $tmpCatSlug . " {\n");
                      fwrite($fd,"background-color: " . ${'opt_BadgeColor_cat_'.$tmpCatSlug} . ";\n");
                      fwrite($fd,"}\n");
                    }
          }
     }
  else
     { fwrite($fd,".tbx {\n");
       fwrite($fd,"background-color: " . $opt_LabelColor . ";\n");
       fwrite($fd,"}\n");
     }
  fwrite($fd,"\n");
    
  fclose($fd);
}
add_action('updated_option','wcplb_BuildCSS', 10, 3);
