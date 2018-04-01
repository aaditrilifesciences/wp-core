<?php
/**
 * Created by PhpStorm.
 * User: ManhTienpt
 * Date: 2/27/2016
 * Time: 11:01 AM
 */


if(is_single()) {
    $thumbsize = "nautica-post-fullwidth";
    $post_class = "single";
} else {
    $classes = array();
    $view_mode = nautica_fnc_theme_options("blog-archive-view-mode")?nautica_fnc_theme_options("blog-archive-view-mode"):"grid";
    $image_view_mode = '';
    if($view_mode == 'list' || $view_mode == 'list-left' || $view_mode == 'list-right') {
        $column = 1;
        $classes[] = 'list-item';
        if($view_mode == 'list-left') $image_view_mode = 'image_left';
        elseif($view_mode == 'list-right') $image_view_mode = 'image_right';
        else $image_view_mode = 'image_left';
    }
    else {
        $classes[] = $view_mode.'-item';
        $column = nautica_fnc_theme_options("blog-archive-column") ?nautica_fnc_theme_options("blog-archive-column"):1;
    }
    $classes[] = $image_view_mode;
    $columns = 12/$column;
    $classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.' col-xs-12';

    $thumbsize = nautica_fnc_theme_options("blog-archive-post-thumbnail")?nautica_fnc_theme_options("blog-archive-post-thumbnail"):"post-thumbnail";

    $post_class = implode(" ", $classes);
}
?>
<div <?php post_class($post_class); ?>>
    <?php
    if(get_post_format()) {
        nautica_fnc_get_template('content-'.get_post_format().".php", array("post_thumbnail" => $thumbsize));
    } else {
        nautica_fnc_get_template('content.php', array("post_thumbnail" => $thumbsize));
    }
    ?>
</div>