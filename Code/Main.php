<?php

include "Database_getter.php";
include "Sheet_API.php";
include "Sheet_helper.php";
include "Display.php";
include "Booker.php";

ob_start();

function SkiExcel($atts, $content=null) { 

       $form_data=get_from_db();
       if (date_is_invalid($form_data["First Date"])) {return "<h4 style='text-align: center'> You selected wrong dates! Bookings are open from the 1st of June 2022 to the end of May 2023</h4>";}
       $form_data=form_data_checker($form_data);
       //writeSheet("B5","XX");
       Display_form($form_data);
       $cal_values_display=Display_calendar($form_data,"A");


       if ($atts[0]=="Test"){       
       }

       else return "Erreur de definition du shortcode";


       //Affichage des resultats
       if ($atts[1]=="Test"){
              if (button_pushed()[0]) {
                     product_creator($form_data,$cal_values_display);
                     wp_redirect("http://localhost/vierge/cart/");
                     exit;
              }


       }
                
       else return "Erreur de declaration du shortcode";
}


add_shortcode('SkiExcel', 'SkiExcel');  

?>



