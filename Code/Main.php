<?php

include "Form_getter.php";
include "Sheet_API.php";
include "Sheet_helper.php";
include "Display.php";
include "Booker.php";
include "Schedule_Updater.php";


ob_start();

function SkiExcel($atts, $content=null) { 

       Utils($atts[0]);
       $url=$_SERVER['REQUEST_URI'];
       if (url_is_invalid($url)){return Error_message_url($atts[0]);}
       $form_data=get_from_url($url);
       if (date_is_invalid($form_data["First Date"])) {return Error_message_dates($atts[0]);}
       $form_data=form_date_checker($form_data);// sets initial date to today if a past date is selected


       //Affichage des resultats
       Enqueue_CSS();
       $cal_choice=Calendar_choice($url);
       if ($atts[0]=="Calendar"){  
              //
              //update_schedule(3126);   
              //        
              $cal_values_display=Display_calendar($form_data,$cal_choice);
              if (button_pushed()[0]) {
                     if (product_creator($form_data,$cal_values_display,$cal_choice)){wp_redirect("http://localhost/vierge/checkout/");
                            exit;}
                     else {wp_redirect("http://localhost/vierge/form/");
                            exit;}
                     
              }
       }
       else if ($atts[0]=="Form_Info"){Display_form($form_data);}
       else if ($atts[0]=="CalA"){Render_Button($url,"a",$cal_choice);}
       else if ($atts[0]=="CalB"){Render_Button($url,"b",$cal_choice);}
       else if ($atts[0]=="CalC"){Render_Button($url,"c",$cal_choice);}
       else if ($atts[0]=="Current"){Render_Button($url,"Current",$cal_choice);}
       else if ($atts[0]=="Text"){Display_text($atts[1]);}
       else return "Erreur de declaration du shortcode";
}

function Utils($att){
       if ($att=="ClearCart"){Clear_Cart();}
       else if ($att=="ExpiredSession"){Expired_redirection();}
}


function Error_message_url($att){
       if ($att=="Calendar") return "<h4 style='text-align: center'>Please submit a new Form to display availabilities.</h4>";
       else return "";
}

function Error_message_dates($att){
       if ($att=="Calendar") return "<h4 style='text-align: center'> You selected wrong dates! Bookings are open from the 1st of June 2022 to the end of May 2023</h4>";
       else return "";
}


add_shortcode('SkiExcel', 'SkiExcel');  

add_action( 'woocommerce_checkout_order_processed', 'update_schedule',  1, 1  );

add_filter('wc_session_expiring', 'so_26545001_filter_session_expiring' );

function so_26545001_filter_session_expiring($seconds) {
    return 60 * 1 * 1; // 23 hours
}

add_filter('wc_session_expiration', 'so_26545001_filter_session_expired' );

function so_26545001_filter_session_expired($seconds) {
    return 60 * 1 * 1; // 24 hours
}
?>



