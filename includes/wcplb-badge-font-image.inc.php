        <tr valign="top">
        <th scope="row"><?php esc_html_e('Font','next-wc-product-labels-badges'); ?></th>
        <td><select name="<?php echo esc_attr($nameBadgeFontImage) ?>">
            <?php
            $dir = plugin_dir_path( __DIR__ );
            $tmpPathFontDir = $dir . "fonts/";
            $objDir = dir($tmpPathFontDir);
            while(false !== ($entry = $objDir->read()))
                 { if($entry!='.' && $entry!='..' && substr($entry,-4) == ".ttf")
                     { $entryFont = substr($entry,0,-4);
                       echo "<option " . ($entry==esc_attr(${'opt_BadgeFontImage_'.$section})?"selected ":"") . "value=\"" . esc_attr($entry) . "\">" . esc_attr($entryFont) . "</option>";
                     }
                 }
            $objDir->close();
            ?>
            </select></td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Font size','next-wc-product-labels-badges'); ?></th>
        <td><select name="<?php echo esc_attr($nameBadgeFontSize) ?>">
            <?php
            for ($s=10;$s<=50;$s+=5)
                { echo "<option " . ($s==esc_attr(${'opt_BadgeFontSize_'.$section})?"selected ":"") . "value=\"" . esc_attr($s) . "\">" . esc_attr($s) . "</option>";
                }
            ?>
            </select></td>
        </tr>