<?php 

class Coupon {
    private $IDCoupon;
    private $NomInf;
    private $Number;
    private $Percentage;

    public function __construct($IDCoupon, $NomInf, $Number, $Percentage) {
        $this->IDCoupon = $IDCoupon;
        $this->NomInf = $NomInf;
        $this->Number = $Number;
        $this->Percentage = $Percentage;
    }

    public function getIDCoupon() {
        return $this->IDCoupon;
    }

    public function getNomInf() {
        return $this->NomInf;
    }

    public function getNumber() {
        return $this->Number;
    }

    public function getPercentage() {
        return $this->Percentage;
    }

    public function setIDCoupon($IDCoupon) {
        $this->IDCoupon = $IDCoupon;
    }

    public function setNomInf($NomInf) {
        $this->NomInf = $NomInf;
    }

    public function setNumber($Number) {
        $this->Number = $Number;
    }

    public function setPercentage($Percentage) {
        $this->Percentage = $Percentage;
    }
}

?>