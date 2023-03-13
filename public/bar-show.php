<!-- // reteriving data of custom meta filed -->
<?php
if(!function_exists('wporg_custom_box_html')){
function wporg_custom_box_html()
{
	wp_reset_postdata(); //this is use for reseting post query; 
	$meta_field_value = get_post_meta(get_the_ID(), '_wporg_meta_key', true); //getting meta_field_value stored by metaField of each posts and pages.
	$get_bar_data = get_option('update_bar_data');   //getting meta_field_values of bar form from option table

	// checking if there is session meta_field_value exists and if exists the removing it.
	if ($get_bar_data['bar_show'] == "1") {
?>
		<script>
			sessionStorage.removeItem("alreadyshown");
		</script>
	<?php
	}
	if ($meta_field_value > 0)  //checking if there is any data on post meta table
	{
		//reteriving specifice data form database
	?>
		<script>
			var storage = sessionStorage.getItem("alreadyshown"); //reteriving sessionStorage meta_field_value
			if (storage != "already shown") {
				document.write(`
		<div class='fixed <?php echo ($get_bar_data['bar_option'] == 1) ? "fixed-top" : "fixed-bottom" ?> '>

			
			<div class="container-fluid d-flex  justify-content-center align-items-center p-2 gap-3" style="background-color:<?= $get_bar_data['background_color'] ?>;">

				<p class="bar_heading h4" style="color:<?= $get_bar_data['font_color'] ?>;"><?= $meta_field_value ?></p> 
		
				<?php if ($get_bar_data['button_name'] > 0) {
				?>
					<a class="bar_button btn btn-primary" href="<?= $get_bar_data['button_url'] ?>" target="_blank"> <?= $get_bar_data['button_name'] ?><a />
					<?php
				}
					?>

					<?php
					if ($get_bar_data['bar_show'] == "1") {
						if (!empty($get_bar_data['bar_close_button'])) {
							if ($get_bar_data['bar_close_button'] == true) {
					?>
							<button type="button" class="btn-close" aria-label="Close" onclick="show_always();"></button>
							<?php
							}
						}
					} else {
						if (!empty($get_bar_data['bar_close_button'])) {
							if ($get_bar_data['bar_close_button'] == true) {
							?>
									<button type="button" class="btn-close" aria-label="Close" onclick="show_once();" ></button>
									
		<?php
							}
						}
					}
		?>
			</div>
		</div>
		`);
			}
		</script>
		<?php
	} else {
		if ($get_bar_data['bar_message'] > 0) //checking for the bar message.
		{
		?>
		<script>
				var storage = sessionStorage.getItem("alreadyshown");
				if (storage != "already shown") {
					document.write(`
			<div class='fixed <?php echo ($get_bar_data['bar_option'] == 1) ? "fixed-top" : "fixed-bottom" ?> '>
				<!-- getting background color -->
				<div class="container-fluid d-flex  justify-content-center align-items-center p-2 gap-3" style="background-color:<?= $get_bar_data['background_color'] ?>;">
					<!-- gettting bar message -->
					<p class="bar_heading h4" style="color:<?= $get_bar_data['font_color'] ?>;"><?= $get_bar_data['bar_message'] ?></p>

					<!-- getting link button -->
					<?php if ($get_bar_data['button_name'] > 0) {
					?>
						<a class="bar_button btn btn-primary" href="<?= $get_bar_data['button_url'] ?>" target="_blank"> <?= $get_bar_data['button_name'] ?><a />
						<?php
					}
						?>
						<!-- close buttton -->
						<?php
						if ($get_bar_data['bar_show'] == "1") {
							if (!empty($get_bar_data['bar_close_button'])) {
								if ($get_bar_data['bar_close_button'] == true) {
						?>
									<button type="button" class="btn-close" aria-label="Close" onclick="show_always();"></button>
								<?php
								}
							}
						} else {
							if (!empty($get_bar_data['bar_close_button'])) {
								if ($get_bar_data['bar_close_button'] == true) {
								?>
									<button type="button" class="btn-close" aria-label="Close" onclick="show_once();"></button>
						<?php
								}
							}
						}
						?>
				</div>
			</div>
			`);
				}
			</script>
<?php
		}
	}
}
}
?>
<?php
add_action('wp_footer', 'wporg_custom_box_html');

?>