        <tr valign="top">
        <th scope="row"><?php esc_html_e('Text direction','next-wc-product-labels-badges'); ?></th>
        <td><input type="radio" name="<?php echo esc_attr($nameBadgeTextDir) ?>" value="TtoB" <?php echo(${'opt_BadgeTextDir_'.$section}=="TtoB"?"checked ":"");?> /> <?php esc_html_e('Top to bottom','next-wc-product-labels-badges'); ?><br>
            <input type="radio" name="<?php echo esc_attr($nameBadgeTextDir) ?>" value="BtoT" <?php echo(${'opt_BadgeTextDir_'.$section}=="BtoT"?"checked ":"");?> /> <?php esc_html_e('Bottom to top','next-wc-product-labels-badges'); ?>
        </td></tr>
        