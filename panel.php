<!--UPDATE OPTIONS-->
<?php
if ($_POST['updatecopy']=="y"){
    
    //update click
    if ($_POST['click'] == "y"){
        $value = "y";
    } else {
        $value = "n";
    }    
    $update = copyrightpro_updateoptions('copy_click', $value);
    
    //update selection text
    if ($_POST['selec'] == "y"){
        $value = "y";
    } else {
        $value = "n";
    }    
    $update = copyrightpro_updateoptions('copy_selection', $value);
    
    //update iframte protection
    if ($_POST['iframe'] == "y"){
        $value = "y";
    } else {
        $value = "n";
    }    
    $update = copyrightpro_updateoptions('copy_iframe', $value);
    
    //update iframte protection
    if ($_POST['drop'] == "y"){
        $value = "y";
    } else {
        $value = "n";
    }    
    $update = copyrightpro_updateoptions('copy_drop', $value);
}

//update copyrightpro footer text lik
if ($_POST['updatelink'] == "y"){
    
    if ($_POST['copy_link'] == "y"){
        $value = "y";
    } else {
        $value = "n";
    }    
    $update = copyrightpro_updateoptions('copy_link', $value);
    
}
?>


<link href="<?php echo esc_url( plugins_url( 'style.css', __FILE__ ) );?>" rel="stylesheet" type="text/css" media="all"/>

<div class="wrap">
    <div class="logo">
        <img src="<?php echo esc_url( plugins_url( 'images/logo.png', __FILE__ ) );?>"/>
    </div>
    <div class="centrado">
        <div style="text-align: center;">
            <p><b><?php _e('Please select the protections to activate in your Wordpress.','copyrightpro') ?></b></p>
        </div>
        <div class="barraroja">
            <div class="progreso" style="width: <?php echo copyrightpro_proteccion(); ?>%;"></div>
            <div class="porcentaje"><?php echo copyrightpro_proteccion(); ?>%</div>
        </div>
        <form method="post" action="<?php echo admin_url('admin.php?page=copyrightpro'); ?>">
            <input type="checkbox" name="click" id="checkbox" value="y" <?php if (copyrightpro_consulta('copy_click') == 'y'){echo "checked";} ?> />  <?php _e('Disable right click on your Wordpress.','copyrightpro') ?><br />
            <input type="checkbox" name="selec" id="checkbox2" value="y" <?php if (copyrightpro_consulta('copy_selection') == 'y'){echo "checked";} ?> />  <?php _e('Disable selection of text.','copyrightpro') ?><br />
            <input type="checkbox" name="iframe" id="checkbox3" value="y" <?php if (copyrightpro_consulta('copy_iframe') == 'y'){echo "checked";} ?> />  <?php _e('Protects from iframes.','copyrightpro') ?><br />
            <input type="checkbox" name="drop" id="checkbox4" value="y" <?php if (copyrightpro_consulta('copy_drop') == 'y'){echo "checked";} ?> />  <?php _e('Protects from drag and drop images.','copyrightpro') ?>
            <input type="hidden" name="updatecopy" id="checkbox5" value="y" />
            <?php settings_fields( 'myoption-group' ); ?>
            <?php do_settings_sections( 'myoption-group' ); ?>
            <?php submit_button('Update options'); ?>
        </form>
    </div>
    
    <div class="centrado">
        <p><strong><?php _e('About CopyRightPro','copyrightpro') ?></strong></p>
        <p align="justify"><strong>Wp-CopyrightPro</strong> <?php _e('is a plug-in developed by','copyrightpro') ?> <a href="http://wp-copyrightpro.com/" target="_blank" title="Wp-CopyRightPro.Com" style="text-decoration: none;">Wp-CopyRightPro.Com</a>.    <?php _e('in order to minimize the copying of your website content. This is not a   complete solution, but it will avoid 90% of attempts to copy its   contents.','copyrightpro') ?></p>
        <p align="justify"><strong><?php _e('Wp-CopyRightPro is bad for the SEO?','copyrightpro') ?></strong><br />
        <?php _e('This plug-in is developed in PHP and javascript, for this reason   the plug-in does not affect search engines, it only affects the user\'s   browser that tries to copy your content.','copyrightpro') ?></p>
        <p align="justify"><strong><?php _e('Wp-CopyrightPro detects the hotlink?','copyrightpro') ?></strong><br />
        <?php _e('When activating 100% of the protections, in less than a week,   Wp-CopyRightPro can reveal sites that are using your images, just by   logging into Google.com images section type this (site:yoursite.com) and   google will show the sites that are using your images.','copyrightpro') ?></p>
        <p align="center"><strong><?php _e('For questions, suggestions, please enter our Official Site','copyrightpro') ?> <a href="http://wp-copyrightpro.com/" target="_blank" title="Wp-CopyRightPro.Com" style="text-decoration: none;"><?php _e('here','copyrightpro') ?></a>.</strong></p>       
    </div>
    
    <div class="centrado">
        <p><b><?php _e('Tell The World!','copyrightpro') ?></b></p>
        <p><?php _e('Proudly tell the world, ¡your content is protected!','copyrightpro') ?></p>
        <form method="post" action="<?php echo admin_url('admin.php?page=copyrightpro'); ?>">
            <input type="checkbox" name="copy_link" value="y" <?php if (copyrightpro_consulta('copy_link') == 'y'){echo "checked";} ?> /> <?php _e('Places a message in your blog\'s footer','copyrightpro') ?><br>
            <input type="hidden" name="updatelink" value="y" />
            <?php submit_button('Update options'); ?>
        </form>
        
    </div>

</div>