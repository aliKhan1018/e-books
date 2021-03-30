<?php
class Utility{


    static function script($code){
        return "<script>" . $code . "</script>";
    }

    static function alert($msg){
        return "<script>alert('" . $msg . "');</script>";
    }

    static function console_log($msg){
        return "<script>console.log('" . $msg . "');</script>";
    }

    static function console_warn($msg){
        return "<script>console.warn('" . $msg . "');</script>";
    }

    static function console_error($msg){
        return "<script>console.error('" . $msg . "');</script>";
    }

    static function hide_pswd($pswd){
        $_ = "";
        for ($i=0; $i < strlen($pswd) ; $i++) { 
            $_ = $_ . "*";
        }
        return $_;
    }

    static function hide_card_digits($card_no){
        $_ = substr($card_no, 0, 6) . "****" . substr($card_no, 9, -1);
        return $_;
    }

    static function echo_nl($msg){
        echo $msg . "<br>";
    }

    static function get_date_formatted(){
        
        return date("Y-m-d");
    }

    static function redirect_to($url){
        header("location: $url");
        die;
    }
}
