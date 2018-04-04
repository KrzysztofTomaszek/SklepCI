<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php echo $header;?>
<?php echo $menu;?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/gallery.css">
        <div class="gallery">
            <div class="container">
                <div class="gallery-grids">
                    <?php echo $content;?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
            <?php echo $pagin;?>
<?php echo $footer;?>