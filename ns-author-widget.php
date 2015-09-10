<?php
/*
Plugin Name: NS Author Widget
Plugin URI: http://netscripter.info/ns-author-widget/
Description: NS Author Widget is a sidebar or footer widget that displays on single posts with Post Author\'s name, avatar, description, link to all posts and social profiles.
Version: 1.2
Author: Miodrag Rasic
Author URI: http://netscripter.info/
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0-standalone.html
*/

// Additing Action hook widgets_init
add_action( 'widgets_init', 'ns_aw'); 

function nsaw_CSS() {
wp_enqueue_style( 'nsaw',plugins_url('css\nsaw.css',__FILE__) );

wp_enqueue_style('nsaw-font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css', array('nsaw'), '4.1.0' );
}

add_action( 'wp_enqueue_scripts', 'nsaw_CSS' );

function ns_aw() {
register_widget( 'ns_aw_info' );
}

class ns_aw_info extends WP_Widget {
function ns_aw_info () {
		parent::__construct('ns_aw_info', 'NS Author Widget','Select the category to display');	}

public function form( $instance ) { 
 if ( isset( $instance[ 'ns_aw_custom_title' ])) {
			$ns_aw_custom_title = $instance[ 'ns_aw_custom_title' ];	
		}
else {
		$ns_aw_custom_title = 'Post Author';
}?>
		<p>Title: <input class="widefat" name="<?php echo $this->get_field_name( 'ns_aw_custom_title' ); ?>" type="text" value="<?php echo esc_attr( $ns_aw_custom_title );?>" /></p>
		
<?php }

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['ns_aw_custom_title'] = ( ! empty( $new_instance['ns_aw_custom_title'] ) ) ? strip_tags( $new_instance['ns_aw_custom_title'] ) : '';
return $instance;
}

function widget($args, $instance) {
if(is_single()){
global $wpdb;
extract($args);
echo $before_widget;
$ns_aw_custom_title = apply_filters( 'widget_title', $instance['ns_aw_custom_title'] );
if ( !empty( $name ) ) { echo $before_title . $ns_aw_custom_title .
$after_title; }
$nsaw_author = get_the_author_meta( 'ID' );
$nsaw_author_email = get_the_author_meta('user_email',$nsaw_author);
$nsaw_author_login_id = get_the_author_meta('user_login',$nsaw_author);
$nsaw_author_nickname = get_the_author_meta('nickname',$nsaw_author); 
$nsaw_author_display = get_the_author_meta('display_name',$nsaw_author);

$nsaw_fb=get_the_author_meta( 'nsaw_fb', $nsaw_author );
$nsaw_twitter=get_the_author_meta( 'nsaw_twitter', $nsaw_author );
$nsaw_gp=get_the_author_meta( 'nsaw_gp', $nsaw_author );
$nsaw_yt=get_the_author_meta( 'nsaw_yt', $nsaw_author );
$nsaw_li=get_the_author_meta( 'nsaw_li', $nsaw_author );
?>

<div class="nsaw-wrap">
<div class="nsaw-inner-wrap-name">
<b><?php echo strtoupper($nsaw_author_display); ?></b>
</div>
<div class="nsaw-inner-wrap">
<div class="nsaw-image">
<?php
echo get_avatar( $nsaw_author_email, '90','',$nsaw_author_login_id); 
?>
</div>
<div class="nsaw-post">
<div class="author-desc">
<p>
<?php the_author_meta('description'); ?>
</p>
</div>
<p class="author-posts"><?php echo number_format_i18n( get_the_author_posts() ); ?> Posts
<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
	<?php printf( __( 'View all posts by %s', 'nsaw' ), get_the_author() ); ?>
</a></p>
</div>

<div class="nsaw-social">
<?php if(!empty($nsaw_fb)) {?>
<a class="list_group_item" target="_blank" href="<?php echo get_the_author_meta( 'nsaw_fb', $nsaw_author ); ?>"><i class="fa fa-fb fa-fw"></i></a>
<?php } ?>

<?php if(!empty($nsaw_twitter)) {?>
<a class="list_group_item" target="_blank" href="<?php echo get_the_author_meta( 'nsaw_twitter', $nsaw_author ); ?>"><i class="fa fa-tw fa-fw"></i></a>
<?php } ?>

<?php if(!empty($nsaw_gp)) {?>
<a class="list_group_item" target="_blank" href="<?php echo get_the_author_meta( 'nsaw_gp', $nsaw_author ); ?>"><i class="fa fa-gp fa-fw"></i></a>
<?php } ?>

<?php if(!empty($nsaw_yt)) {?>
<a class="list_group_item" target="_blank" href="<?php echo get_the_author_meta( 'nsaw_yt', $nsaw_author ); ?>"><i class="fa fa-yt fa-fw"></i></a>
<?php } ?>

<?php if(!empty($nsaw_li)) {?>
<a class="list_group_item" target="_blank" href="<?php echo get_the_author_meta( 'nsaw_li', $nsaw_author ); ?>"><i class="fa fa-lin fa-fw"></i></a>
<?php } ?>

<?php if ( get_the_author_meta( 'url' ) ) { ?>
	<a class="list_group_item" target="_blank" href="<?php the_author_meta( 'url' ) ?>" title="Author's Website"><i class="fa fa-l fa-fw"></i></a>
<?php } ?>
</div>

</div>
</div>
<div class="clear"></div>

<?php
echo $after_widget;
}
}
}

add_action( 'show_user_profile', 'nsaw_show_profile' );
add_action( 'edit_user_profile', 'nsaw_show_profile' );

function nsaw_show_profile( $user ) { ?>

	<h3>Social Profiles:</h3>
	<table class="form-table">
	<tr>
	<th><label for="nsaw_fb_label">Facebook:</label></th>
	<td>
	<span class="description">Enter your FB Account URL:</span><br>
	<input name="nsaw_fb" class="regular-text" type="url" placeholder="http://facebook.com/NetscripterInfo" value="<?php echo esc_attr( get_the_author_meta( 'nsaw_fb', $user->ID ) ); ?>" /><br>
    <p style="color:#999; font-size: 12px;">leave it blank if you don't want to show this profile.</p>
	</td>
	</tr>

	<tr>
	<th><label for="nsaw_twitter_label">Twitter:</label></th>
	<td>
	<span class="description">Enter your Twitter Account:</span><br>
	<input name="nsaw_twitter" class="regular-text" type="url" placeholder="http://twitter.com/NetscripterInfo" value="<?php echo esc_attr( get_the_author_meta( 'nsaw_twitter', $user->ID ) ); ?>" /><br>
	<p style="color:#999; font-size: 12px;">leave it blank if you don't want to show this profile.</p>
	</td>
	</tr>

	<tr>
	<th><label for="nsaw_GP_label">Google Plus:</label></th>
	<td>
	<span class="description">Enter your Google Plus Account URL:</span><br>
	<input name="nsaw_gp" class="regular-text" type="url" placeholder="https://plus.google.com/+NetscripterMe-WP" value="<?php echo esc_attr( get_the_author_meta( 'nsaw_gp', $user->ID ) ); ?>" /><br>
	<p style="color:#999; font-size: 12px;">leave it blank if you don't want to show this profile.</p>
	</td>
	</tr>

	<tr>
	<th><label for="nsaw_yt_label">YouTube:</label></th>
	<td>
	<span class="description">Enter your YouTube Channel URL:</span><br>
	<input name="nsaw_yt" class="regular-text" type="url" placeholder="https://www.youtube.com/user/netscripter" value="<?php echo esc_attr( get_the_author_meta( 'nsaw_yt', $user->ID ) ); ?>" /><br>
	<p style="color:#999; font-size: 12px;">leave it blank if you don't want to show this profile.</p>
	</td>
	</tr>

	<tr>
	<th><label for="nsaw_LI_label">Linked In:</label></th>
	<td>
	<span class="description">Enter your Linked In Account:</span><br>
	<input name="nsaw_li" class="regular-text" type="url" placeholder="http://in.linkedin.com/in/misharnet/" value="<?php echo esc_attr( get_the_author_meta( 'nsaw_li', $user->ID ) ); ?>" /><br>
	<p style="color:#999; font-size: 12px;">leave it blank if you don't want to show this profile.</p>
	</td>
	</tr>
    </table>

<?php
}
add_action( 'personal_options_update', 'nsaw_edit_save_profile' );
add_action( 'edit_user_profile_update', 'nsaw_edit_save_profile' );

function nsaw_edit_save_profile( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	update_user_meta($user_id, 'nsaw_fb', $_POST['nsaw_fb'] );
	update_user_meta($user_id, 'nsaw_twitter', $_POST['nsaw_twitter'] );
	update_user_meta($user_id, 'nsaw_gp', $_POST['nsaw_gp'] );
	update_user_meta($user_id, 'nsaw_yt', $_POST['nsaw_yt'] );
	update_user_meta($user_id, 'nsaw_li', $_POST['nsaw_li'] );	
}

?>
