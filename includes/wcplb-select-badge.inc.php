<h2 class="title" style="display:inline;"><?php esc_html_e('Select badge','next-wc-product-labels-badges'); ?></h2>

  <span class="all-labels">
      <?php
      $imgLabelsShow = plugin_dir_url( __DIR__ )  . "images/labels-show.png";
      $imgLabelsHide = plugin_dir_url( __DIR__ )  . "images/labels-hide.png";
      echo "<img onclick=\"wcplb_ShowLabels()\" src=\"" . esc_attr($imgLabelsShow) . "\">";
      echo "<img onclick=\"wcplb_ShowLabels()\" src=\"" . esc_attr($imgLabelsHide) . "\" style=\"display:none;\">";
      ?>
  </span><font color="#808080"><em><?php esc_html_e('Show/Hide to select badge','next-wc-product-labels-badges'); ?></em></font>
  
  <?php  
  $tmpOptBadgeName = 'optBadgeName_'.$section;
  ?>
  
  <table class="form-table">
    <tr valign="top" id="divAllLabels" name="divAllLabels" style="display:none;">
    <th scope="row"><?php esc_html_e('Badges','next-wc-product-labels-badges'); ?></th>
    <td>
    <input type="radio" id="Ribbon" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="Ribbon" <?php echo(${'opt_BadgeName_'.$section}=="Ribbon"?"checked ":"");?> class="input-hidden" />
    <label for="Ribbon">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_Ribbon.png\">"; ?>
    </label>

    <input type="radio" id="LeftBannerOut" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="LeftBannerOut" <?php echo(${'opt_BadgeName_'.$section}=="LeftBannerOut"?"checked ":"");?>class="input-hidden" />
    <label for="LeftBannerOut">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_LeftBannerOut.png\">"; ?>
    </label>
    <input type="radio" id="LeftBannerIn" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="LeftBannerIn" <?php echo(${'opt_BadgeName_'.$section}=="LeftBannerIn"?"checked ":"");?>class="input-hidden" />
    <label for="LeftBannerIn">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_LeftBannerIn.png\">"; ?>
    </label>
    
    <input type="radio" id="RightBannerOut" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="RightBannerOut" <?php echo(${'opt_BadgeName_'.$section}=="RightBannerOut"?"checked ":"");?>class="input-hidden" />
    <label for="RightBannerOut">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_RightBannerOut.png\">"; ?>
    </label>
    <input type="radio" id="RightBannerIn" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="RightBannerIn" <?php echo(${'opt_BadgeName_'.$section}=="RightBannerIn"?"checked ":"");?>class="input-hidden" />
    <label for="RightBannerIn">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_RightBannerIn.png\">"; ?>
    </label>
    
    <input type="radio" id="Stamp" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="Stamp" <?php echo(${'opt_BadgeName_'.$section}=="Stamp"?"checked ":"");?> class="input-hidden" />
    <label for="Stamp">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_Stamp.png\">"; ?>
    </label>

    <input type="radio" id="DoubleRibbon" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="DoubleRibbon" <?php echo(${'opt_BadgeName_'.$section}=="DoubleRibbon"?"checked ":"");?> class="input-hidden" />
    <label for="DoubleRibbon">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_DoubleRibbon.png\">"; ?>
    </label>
           
    <input type="radio" id="Medal36" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="Medal36" <?php echo(${'opt_BadgeName_'.$section}=="Medal36"?"checked ":"");?> class="input-hidden" />
    <label for="Medal36">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_Medal36.png\">"; ?>
    </label>

    <input type="radio" id="Flower" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="Flower" <?php echo(${'opt_BadgeName_'.$section}=="Flower"?"checked ":"");?> class="input-hidden" />
    <label for="Flower">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_Flower.png\">"; ?>
    </label>
    
    <input type="radio" id="Victory" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="Victory" <?php echo(${'opt_BadgeName_'.$section}=="Victory"?"checked ":"");?> class="input-hidden" />
    <label for="Victory">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_Victory.png\">"; ?>
    </label>
    
    <input type="radio" id="Square" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="Square" <?php echo(${'opt_BadgeName_'.$section}=="Square"?"checked ":"");?> class="input-hidden" />
    <label for="Square">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_Square.png\">"; ?>
    </label>
            
    <input type="radio" id="ArrowOut" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="ArrowOut" <?php echo(${'opt_BadgeName_'.$section}=="ArrowOut"?"checked ":"");?>class="input-hidden" />
    <label for="ArrowOut">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_ArrowOut.png\">"; ?>
    </label>
    
    <input type="radio" id="ArrowIn" <?php echo "name=\"$tmpOptBadgeName\""; ?> value="ArrowIn" <?php echo(${'opt_BadgeName_'.$section}=="ArrowIn"?"checked ":"");?>class="input-hidden" />
    <label for="ArrowIn">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/badgeShop_ArrowIn.png\">"; ?>
    </label>
    </td></tr>
  </table>
