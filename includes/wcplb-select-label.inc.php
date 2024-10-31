<h2 class="title" style="display:inline;"><?php esc_html_e('Select label','next-wc-product-labels-badges'); ?></h2>

  <span class="all-labels">
      <?php
      $imgLabelsShow = plugin_dir_url( __DIR__ )  . "images/labels-show.png";
      $imgLabelsHide = plugin_dir_url( __DIR__ )  . "images/labels-hide.png";
      echo "<img onclick=\"wcplb_ShowLabels()\" src=\"" . esc_attr($imgLabelsShow) . "\">";
      echo "<img onclick=\"wcplb_ShowLabels()\" src=\"" . esc_attr($imgLabelsHide) . "\" style=\"display:none;\">";
      ?>
  </span><font color="#808080"><em><?php esc_html_e('Show/Hide to select label','next-wc-product-labels-badges'); ?></em></font>
  
  <table class="form-table">
    <tr valign="top" id="divAllLabels" name="divAllLabels" style="display:none;">
    <th scope="row"><?php esc_html_e('Labels','next-wc-product-labels-badges'); ?></th>
    <td>
    <input type="radio" id="Label" name="optLabelName" value="Label" <?php echo($opt_LabelName=="Label"?"checked ":"");?> class="input-hidden" /> <?php //esc_html_e('Label','next-wc-product-labels-badges'); ?>
    <label for="Label">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Label.png\">"; ?>
    </label>
    
    <input type="radio" id="Flag" name="optLabelName" value="Flag" <?php echo($opt_LabelName=="Flag"?"checked ":"");?> class="input-hidden" /> <?php //esc_html_e('Flag','next-wc-product-labels-badges'); ?>
    <label for="Flag">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Flag.png\">"; ?>
    </label>
    
    <input type="radio" id="Star" name="optLabelName" value="Star" <?php echo($opt_LabelName=="Star"?"checked ":"");?> class="input-hidden" />
    <label for="Star">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Star.png\">"; ?>
    </label>
    <input type="radio" id="Star5" name="optLabelName" value="Star5" <?php echo($opt_LabelName=="Star5"?"checked ":"");?> class="input-hidden" />
    <label for="Star5">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Star5.png\">"; ?>
    </label>
    <input type="radio" id="Star8" name="optLabelName" value="Star8" <?php echo($opt_LabelName=="Star8"?"checked ":"");?> class="input-hidden" />
    <label for="Star8">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Star8.png\">"; ?>
    </label>

    <input type="radio" id="Flash" name="optLabelName" value="Flash" <?php echo($opt_LabelName=="Flash"?"checked ":"");?> class="input-hidden" />
    <label for="Flash">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Flash.png\">"; ?>
    </label>
                
    <input type="radio" id="Corner" name="optLabelName" value="Corner" <?php echo($opt_LabelName=="Corner"?"checked ":"");?> class="input-hidden" />
    <label for="Corner">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Corner.png\">"; ?>
    </label>
    
    <input type="radio" id="Drop" name="optLabelName" value="Drop" <?php echo($opt_LabelName=="Drop"?"checked ":"");?> class="input-hidden" />
    <label for="Drop">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Drop.png\">"; ?>
    </label>
  
    <input type="radio" id="Circle" name="optLabelName" value="Circle" <?php echo($opt_LabelName=="Circle"?"checked ":"");?>class="input-hidden" />
    <label for="Circle">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Circle.png\">"; ?>
    
    <input type="radio" id="Bubble" name="optLabelName" value="Bubble" <?php echo($opt_LabelName=="Bubble"?"checked ":"");?>class="input-hidden" />
    <label for="Bubble">
    <?php echo "<img src=\"" .  plugin_dir_url( __DIR__ )  . "images/labelShop_Bubble.png\">"; ?>
    </label>
    </td></tr>
  </table>
