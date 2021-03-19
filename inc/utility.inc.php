<?php
class Utility{


    static function script($code){
        return "<script>" . $code . "</script>";
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

    static function echo_nl($msg){
        echo $msg . "<br>";
    }


}

?>