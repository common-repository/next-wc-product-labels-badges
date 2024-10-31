        <tr valign="top">
        <th scope="row"><?php esc_html_e('Font','next-wc-product-labels-badges'); ?></th>
        <td><select name="<?php echo esc_attr($nameBadgeFontTextbox) ?>">
            <?php
            echo "<option " . ("serif"==${'opt_BadgeFontTextbox_'.$section}?"selected ":"") . "value=\"serif\">" . esc_html__('Serif','next-wc-product-labels-badges') . "</option>";
            echo "<option " . ("sans-serif"==${'opt_BadgeFontTextbox_'.$section}?"selected ":"") . "value=\"sans-serif\">" . esc_html__('Sans serif','next-wc-product-labels-badges') . "</option>";
            echo "<option " . ("cursive"==${'opt_BadgeFontTextbox_'.$section}?"selected ":"") . "value=\"cursive\">" . esc_html__('Cursive','next-wc-product-labels-badges') . "</option>";
            echo "<option " . ("fantasy"==${'opt_BadgeFontTextbox_'.$section}?"selected ":"") . "value=\"fantasy\">" . esc_html__('Fantasy','next-wc-product-labels-badges') . "</option>";
            echo "<option " . ("monospace"==${'opt_BadgeFontTextbox_'.$section}?"selected ":"") . "value=\"monospace\">" . esc_html__('Monospace','next-wc-product-labels-badges') . "</option>";
            ?>
            </select></td>
        </tr>