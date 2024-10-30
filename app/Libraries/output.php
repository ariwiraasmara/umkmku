//!! Copyright @ Syahri Ramadhan Wiraasmara
<?php
class output {

    public static function currency(int $number = 0, int $decimal = 0,) {
        return number_format($number,$decimal,",",".");
    }

}
?>