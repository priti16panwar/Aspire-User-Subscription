<?php 
/*
*
*	***** Aspire Subscribers *****
*
*	Core Functions
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if

/*
*
* Custom Front End Ajax Scripts / Loads In WP Footer
*
*/
function as_frontend_ajax_form_scripts(){
?>
<script type="text/javascript">
jQuery(document).ready(function($){
    "use strict";
    // add basic front-end ajax page scripts here
    $('#as_custom_plugin_form').submit(function(event){
        event.preventDefault();
        // Vars
        var Email = $('#Email').val();
        var Status = document.getElementById('Status').checked ? 'Yes' : 'No';
        var Percentage = $('#Percentage').val();
        
        // Ajaxify the Form
        var data = {
            'action': 'as_custom_plugin_frontend_ajax',
            'Email':  Email,
            'Status':  Status,
            'Percentage':  Percentage,
        };
        
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
        jQuery('#as_custom_plugin_form .image_loader').css('display', 'block');
        $.post(ajaxurl, data, function(response) {
                jQuery('#as_custom_plugin_form .image_loader').css('display', 'none');
                if(response.status == 1)
                {
                    //$('#as_custom_plugin_form_wrap').html(response);
                    jQuery("#as_custom_plugin_form")[0].reset();
                    jQuery(".response_area").css("display","block");
                    jQuery('.response_area').html('<span class="success_message" style="color: #34ad34;">'+response.message+'</span>');
                    jQuery(".response_area").delay(4000).fadeOut("slow");

                }
                else
                {
                    //$('#as_custom_plugin_form_wrap').html(response);
                    jQuery(".response_area").css("display","block");
                    jQuery('.response_area').html('<span class="error_message" style="color: #d12d2d;">'+response.message+'</span>');
                    jQuery(".response_area").delay(5000).fadeOut("slow");
                }
        });

    });
}(jQuery));    
</script>
<?php }
add_action('wp_footer','as_frontend_ajax_form_scripts');

/*
*
*
* admin panel
*
*/
 

function theme_options_panel(){
  add_menu_page('Email Subscription', 'Email Subscription Form', 'manage_options', 'e-theme-options', 'wps_theme_func');
}
add_action('admin_menu', 'theme_options_panel');

function wps_theme_func(){   
    ?>
    <div class="shortcode" style="display: flex;margin: 20px 10px;">
        <div class="awp-short-code">
            <p>Copy Your Email Subscription Form Code and Paste Your Page</p>
        </div>
        <div class="awp-short-code">
            <!-- text input field -->
            <input id="inputText" type="text" value="['awp_custom_email_subscribers']">

            <!-- button -->
            <button id="copyText">Copy Code</button>
        </div>
    </div>
    <style type="text/css">
        .awp-short-code p {
            font-size: 14px;
            margin-right: 20px;
            border-bottom: 4px solid #68d168;
        }
        #inputText {
          padding: 6px 7px;
          font-size: 15px;
          width:400px;
        }
        /* styling button */
        #copyText {
          padding: 6px 11px;
          font-size: 15px;
          font-weight: bold;
          background-color: #121212;
          color: #efefef;
        }
    </style>
    <script>
        /* return content of input field to variable text */
        var text = document.getElementById("inputText");
        /* return button to variable btn */
        var btn = document.getElementById("copyText");
        /* call function on button click */
        btn.onclick = function() {
          text.select();    
          document.execCommand("copy");
        }
    </script>
    <?php 
        global $wpdb; 
        $posttemplates  = $wpdb->get_results("select * from `".$wpdb->prefix."email_subscribers` ");
      ?>
  
    <style>
    .TplJobTable  {line-height:130%; display:block; margin:10px 5px 0;}
    .TplJobTable table {border:1px solid #ddd;margin-top:10px;}
    .TplJobTable th { padding:10px;}
    .TplJobTable thead tr {  background:#fff;border-bottom:1px solid #ddd;}
    .TplJobTable td{padding:6px 10px;}
    .TplJobTable tbody tr:nth-child(even){background:#fff;}
    .TplJobTable tbody tr:nth-child(even) {background-color: #ffffff;}
    .TplJobTable tbody tr:nth-child(odd) {background-color: #ccccccad;}
    div.digg {
      padding: 3px;
      margin: 3px;
      text-align:center;
    }
    
    </style>
    <div class="TplJobTable">
      <table>
      <form action="" method="post" enctype="multipart/form-data" name="deletetemplates" id="deletetemplates">
        <thead>
        <tr> 
          <th width="3%" style="text-align: left;">S.No.</th>
          <th width="7%" style="text-align: left;">User ID</th>
          <th width="15%" style="text-align: left;">Url</th>
          <th width="30%" style="text-align: left;">User Email</th>
          <th width="5%" style="text-align: left;">Status</th>
          <th width="5%" style="text-align: left;">Percentage</th>
          <th width="15%" style="text-align: left;">Created Date</th>
          <th width="15%" style="text-align: left;">Updated Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $k = 0; $i = 1;
      
        foreach($posttemplates as $posttemplate) { ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $posttemplate->user_id; ?></td>
          <td><?php echo $posttemplate->url; ?></td>
          <td><?php echo $posttemplate->email_address; ?></td>
          <?php
          if($posttemplate->status == '1'){
            $Status = 'Yes';
          }else {
            $Status = 'No';
          }
          ?>
          <td><?php echo $Status; ?></td>
          <td><?php echo $posttemplate->percentage_amount; ?></td>
          <td><?php echo $posttemplate->created_at; ?></td>
          <td><?php echo $posttemplate->updated_at; ?></td>
        </tr>
        <?php $k++; $i++; } ?>
        </tbody>
      </form>
      </table>
    </div>
    <?php
    //echo pagination($totalposts, $p, $lpm1, $prev, $next);
}




add_action( 'wp_ajax_as_custom_plugin_frontend_ajax', 'as_custom_plugin_frontend_ajax' );
add_action( 'wp_ajax_nopriv_as_custom_plugin_frontend_ajax', 'as_custom_plugin_frontend_ajax' );
function as_custom_plugin_frontend_ajax(){  
    ob_start();
    if(isset($_POST['Email'])){
        $Email = $_POST['Email'];
        $Status_1 = $_POST['Status'];
        $Percentage = $_POST['Percentage'];
        $url = get_site_url();
        $user_id = get_current_user_id();
        if($user_id != '0'){
            if($Status_1 == 'Yes'){
                $Status = '1';
            }else {
                $Status = '0';
            }
            global $wpdb;
            $Userdata  = $wpdb->get_row("select * from `".$wpdb->prefix."email_subscribers` WHERE  user_id=".$user_id."");
            $subscriber_id = $Userdata->id;
            $created_at = $Userdata->created_at;
            $email_address = $Userdata->email_address;
            $resonse=array();
            if($subscriber_id == false){
                $current_date = date("Y-m-d H:i:s");
                $tablename=$wpdb->prefix.'email_subscribers';
                $row = $wpdb->insert( $tablename, array( 
                    'user_id' => $user_id,
                    'url' => $url, 
                    'email_address' => $Email,
                    'status' => $Status,
                    'percentage_amount' => $Percentage, 
                    'created_at'=> $current_date,
                    'updated_at' => $current_date,
                ));
                if($row == 1){
                    $user_info = get_userdata($subscriber->user_id);
                    $userName= $user_info->user_login?$user_info->user_login:"";
                    SubscriberEmails::SubscribeUSerEmail($Email,$userName,"Thank you for Subscribing");
                    $resonse['message']="Thank You..! Your Subscription Form Submit Successfully.";
                    $resonse['status']=1;
                } else {
                    $resonse['message']="Something went wrong! Please try again!";
                    $resonse['status']=0;
                }
                
            }else{
                $updated_at = date("Y-m-d H:i:s");
                $tablename=$wpdb->prefix.'email_subscribers';
                $query = $wpdb->update(
                $tablename,
                    array( 
                        'user_id' => $user_id,
                        'url' => $url, 
                        'email_address' => $Email,
                        'status' => $Status,
                        'percentage_amount' => $Percentage,
                        'created_at' => $created_at, 
                        'updated_at' => $updated_at,
                    ),
                    array( 'id'=>$subscriber_id )
                );
                if($query == 1){
                    $user_info = get_userdata($subscriber->user_id);
                    $userName= $user_info->user_login?$user_info->user_login:"";
                    SubscriberEmails::SubscribeUSerEmail($Email,$userName,"Thank you for Subscribing");
                    $resonse['message']="Thank You..! Your Subscription Form Updated Successfully.";
                    $resonse['status']=1;
                   
                } else {
                    $resonse['message']="Something went wrong! Please try again!";
                    $resonse['status']=0;
                }
            }
        }else{
            $resonse['message']="Your are not Login Please Login...!";
            $resonse['status']=0;
            
        }
    } else {
        $resonse['message']="Your field was empty! Try Typing in the field!";
        $resonse['status']=0;
            
    } 
    wp_send_json($resonse);
    exit;
}











