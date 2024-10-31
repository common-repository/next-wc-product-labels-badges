    <?php
    $opt_CatAssoHideEmpty = get_option('optCatAssoHideEmpty');
    $opt_CatAssoHierarchy= get_option('optCatAssoHierarchy');

          $orderby = 'name';
          $order = 'asc';
          $hide_empty = false;
          $cat_args = array(
                    'orderby'    => $orderby,
                    'order'      => $order,
                    'hide_empty' => $hide_empty);
          $product_categories = get_terms('product_cat',$cat_args);
          $NbCat = count($product_categories);
    ?>
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Empty categories','next-wc-product-labels-badges'); ?></th>
        <td><input type="checkbox" name="optCatAssoHideEmpty" value=1 <?php echo($opt_CatAssoHideEmpty==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Hide categories with NO product','next-wc-product-labels-badges'); ?>
        </td></tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Categories','next-wc-product-labels-badges'); 
                              echo " [" . esc_attr($NbCat) . "]"; ?></th>
        <td>
<?php
function get_wc_categories(int $parent = 0, int $level = 0): string
{ $opt_CatAssoHideEmpty = get_option('optCatAssoHideEmpty');
  $opt_CatAssoHierarchy= get_option('optCatAssoHierarchy');

  $args = array(
        'taxonomy' => 'product_cat',
        'hide_empty' => ($opt_CatAssoHideEmpty==1),
        'parent'   => $parent
    );

  $product_categories = get_terms($args);
  if (empty($product_categories))
     { return '';
     }
 
  foreach ($product_categories as $key => $category)
          { $tmpCatSlug = $category->slug;
            $tmpCatName = $category->name;
            $tmpCatSlug = str_replace('-','_',$tmpCatSlug);
            $tmpOptColorCatName = 'optBadgeColor_cat_'.$tmpCatSlug;
            $tmpOptTextCatName = 'optBadgeText_cat_'.$tmpCatSlug;
            
            ${'opt_BadgeColor_cat_'.$tmpCatSlug} = get_option($tmpOptColorCatName); if (${'opt_BadgeColor_cat_'.$tmpCatSlug} == "") ${'opt_BadgeColor_cat_'.$tmpCatSlug} = "#fffffe";
            ${'opt_BadgeText_cat_'.$tmpCatSlug} = get_option($tmpOptTextCatName); if (${'opt_BadgeText_cat_'.$tmpCatSlug} == "") ${'opt_BadgeText_cat_'.$tmpCatSlug} = $tmpCatName;
     
            $text .= "<br><input name=\"" . $tmpOptTextCatName . "\" id=\"" . $tmpOptTextCatName . "\" type=\"text\" value=\"" . ${'opt_BadgeText_cat_'.$tmpCatSlug} . "\">";
            $text .= "<input name=\"" . $tmpOptColorCatName . "\" id=\"" . $tmpOptColorCatName . "\" type=\"color\" value=\"" . ${'opt_BadgeColor_cat_'.$tmpCatSlug} . "\">";
            if ($opt_CatAssoHierarchy == 1)
               { for ($l=0;$l<$level;$l++)
                     $text .="&nbsp;&nbsp;&nbsp;";
               }
            $text .= '<a href="' . get_term_link($category->term_id) . '">';
            if ($level == 0) $text .= '<b>';
            $text .= $category->name.'</a>';
            if ($level == 0) $text .= '</b>';
            $text .= get_wc_categories($category->term_id,$level+1);
          }
  return $text;
}
echo get_wc_categories();
?>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php esc_html_e('Hierarchy','next-wc-product-labels-badges'); ?></th>
        <td><input type="checkbox" name="optCatAssoHierarchy" value=1 <?php echo($opt_CatAssoHierarchy==1?"checked ":"");?>class="wppd-ui-toggle" /> <?php esc_html_e('Show hierarchical categories','next-wc-product-labels-badges'); ?>
        </td></tr>        
