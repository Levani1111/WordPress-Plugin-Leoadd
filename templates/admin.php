<div class="wrap">
    <h1>Legend Plugin</h1>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php
        settings_fields('leoadd_option_group_id');
        do_settings_sections('leoadd_plugin');
        submit_button();
        ?>
    </form>
</div>