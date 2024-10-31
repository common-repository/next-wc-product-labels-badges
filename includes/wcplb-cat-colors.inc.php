        <tr valign="top">
        <th scope="row"><?php esc_html_e('Use categories','next-wc-product-labels-badges'); ?></th>
        <td><input type="checkbox" id="optUseCatColor" name="optUseCatColor" onload="RB_UseCatColor_Change(this.value);" onchange="RB_UseCatColor_Change(this.value);" value=1 <?php echo($opt_UseCatColor==1?"checked ":"");?> class="wppd-ui-toggle" /> <?php esc_html_e('Use category background colors instead of label background color','next-wc-product-labels-badges'); ?>
        <br><font color="#808080"><em><?php esc_html_e('Only for TEXT labels','next-wc-product-labels-badges'); ?></em></font>
        </td></tr>
