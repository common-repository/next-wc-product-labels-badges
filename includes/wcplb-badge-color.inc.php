        <tr valign="top">
        <th scope="row"><?php esc_html_e('Badge color','next-wc-product-labels-badges'); ?></th>
        <td>
        <div>
        <input type="color" name="<?php echo esc_attr($nameBadgeColor) ?>" size=7 maxlength="7" value="<?php echo esc_attr(${'opt_BadgeColor_'.$section}) ?>" class="xxx" /> <?php esc_html_e('Background color','next-wc-product-labels-badges'); ?><br>
        </div>
        <input type="color" name="<?php echo esc_attr($nameBadgePatternColor) ?>" size=7 maxlength="7" value="<?php echo esc_attr(${'opt_BadgePatternColor_'.$section}) ?>" class="xxx" /> <?php esc_html_e('Pattern color','next-wc-product-labels-badges'); ?>
        </td></tr> 