<?php

// creating bar menu
add_action('admin_menu', 'bar_menu');
if(!function_exists('bar_menu')){
function bar_menu()
{
    add_menu_page('Bar Menu', 'Bar Menu', 10, __FILE__, 'bar_menu_list');
}
}

// adding color picker
add_action('admin_enqueue_scripts', 'mw_enqueue_color_picker');

if(!function_exists('mw_enqueue_color_picker')){
function mw_enqueue_color_picker($hook_suffix)
{
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style('bars_style', plugins_url('/css/style.css', __FILE__));
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('my-script-handle', plugins_url('my-script.js', __FILE__), array('wp-color-picker'), false, true);
    wp_enqueue_script('color-picker',plugins_url('/js/script.js',__FILE__));
}
}

// creating bar menu form 
if(!function_exists('bar_menu_list')){
function bar_menu_list()
{
?>
    <form method="post">
        <div class="card">
            <div class="card-header">
                Bar Menu
            </div>
            <div class="card-body">

                <!-------------Header and footer bar option ------>
                <div class="top-bottom">
                <label for="top-bottom">Select where you want to show bar
                </label>
                <select class="form-select" aria-label="Default select example" name="bar_option">
                    <option selected value="1">Header</option>
                    <option value="2">Footer</option>
                </select>
                </div>
                <!--------------- bar message---------------------------->
                <div class="bar_message top-bottom">
                    <label for="bar_message">Bar Message</label>
                    <input type="text" class="bar_message_heading" name="bar_message" placeholder="Enter bar message here">
                </div>
                <!-- ------------------ bar font color-------------->
                <div class="bar_font_color top-bottom ">
                    <label for="bar_color">Choose font color of bar</label>
                    <input type="text" value="#bada55" class="font_color_field" data-default-color="#effeff" name="font_color" />

                </div>
              <!-- ------------------ bar background color-------------->
                <div class="bar__back_color top-bottom ">
                    <label for="bar_back-color">Choose background color of bar</label>
                    <input type="text" value="#50ccce" class="back_color_field" data-default-color="#effeff" name="background_color" />
                </div>

                <!------------------------- Bar button ---------->
                <div class="bar_button">
                <div class="bar_button_name top-bottom">
                    <label for="bar_button_name">Enter button name</label>
                   
                    <input type="text"  name="button_name" placeholder="Enter button name">
                </div>
                    
                <div class="bar_button_url top-bottom">
                    <label for="bar_button_url" class="bar_button_url">Enter button url</label>
                  
                    <input type="url" class="bar_button_url" name="button_url" placeholder="Enter button url">
                    </div>
                </div>
                
                <!-- bar showing time -->
                <div class="bar_show top-bottom">
                    <label for="bar_show">Select everytime or once</label>
                    <select class="bar_show_time" name="bar_show">
                        <option selected value="1">Show always</option>
                        <option value="2">Show Once</option>
                    </select>
                </div>    

                <!-- close button -->
                <div class="bar_close">
                <input type="checkbox" name="bar_close_button" checked>
                    <label for="bar_close">
                        UnCheck if you want to hide close button
                    </label>
                </div>
                
                <!-- saving button -->
                <input type="submit" value="submit" name="submit">
            </div>
        </div>
    </form>
<?php
}
}
/// saving form data into database
if (isset($_POST['submit'])) { 
   $bOption = sanitize_text_field($_POST['bar_option']); //getting form data
   $bMessage = sanitize_text_field($_POST['bar_message']);
   $fColor = $_POST['font_color'];
   $bColor = $_POST['background_color'];
   $bName = sanitize_text_field($_POST['button_name']);
   $bUrl = sanitize_url($_POST['button_url']);
   $bShow = sanitize_text_field($_POST['bar_show']);
   if(!empty($_POST['bar_close_button'])) { 
   $bClose=$_POST['bar_close_button'];
   }

   //storing form data as an array to store in wp_options table.
   $bar_data = array(
       'bar_option' => $bOption,
       'bar_message' => $bMessage,
       'font_color' => $fColor,
       'background_color' => $bColor,
       'button_name' => $bName,
       'button_url' => $bUrl,
       'bar_show' => $bShow,
   );
   if(!empty($_POST['bar_close_button'])) {
       $bar_data['bar_close_button'] = $bClose;
    }
   update_option('update_bar_data', $bar_data);
}
?>