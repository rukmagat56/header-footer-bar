<?php
// creating custom meta field for each post page and custom post type
if(!function_exists('bar_custom_field')){
function bar_custom_field()
{
	$screens = ['post', 'page', 'wporg_cpt'];
	foreach ($screens as $screen) {
		add_meta_box(
			'wporg_box_id',                 // Unique ID
			'Custom Meta Box Title',      // Box title
			'bar_field',  // Content callback, must be of type callable
			$screen                            // Post type
		);
	}
}
}
add_action('add_meta_boxes', 'bar_custom_field');

// creating input field for custom meta filed
if(!function_exists('bar_field')){
function bar_field($post)
{
?>
	<label for="bar_field">Enter message for bar</label>
	<input type="text" name="bar_field" class="bar_custom_field">
<?php
}
}

//saving data to datbase of custom meta field
if(!function_exists('bar_save_postdata')){
function bar_save_postdata($post_id)
{
	if (array_key_exists('bar_field', $_POST)) {
		update_post_meta(
			$post_id,
			'_wporg_meta_key',
			sanitize_text_field($_POST['bar_field'])
		);
	}
}
}
add_action('save_post', 'bar_save_postdata');

