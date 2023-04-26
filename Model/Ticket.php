<?php

class Ticket
{
    private ?int $IDTicket = null;
    private ?string $NumTickets = null;
    private ?string $FirstName = null;
    private ?string $LastName = null;
    private ?int $Coupon = null;
    private ?string $Event = null;
    private ?DateTime $PickupDate = null;
    private ?DateTime $PickupTime = null;
    private ?string $confirmation = null;

    //Construct
    public function __construct($NumTickets, $FirstName, $LastName, $Coupon, $Event, $PickupDate, $PickupTime) {
        $this->NumTickets = $NumTickets;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Coupon = $Coupon;
        $this->Event = $Event;
        $this->PickupDate = $PickupDate;
        $this->PickupTime = $PickupTime;
    }

    // Getters
    public function getIDTicket() {
        return $this->IDTicket;
    }

    public function getNumTickets() {
        return $this->NumTickets;
    }

    public function getFirstName() {
        return $this->FirstName;
    }

    public function getLastName() {
        return $this->LastName;
    }

    public function getCoupon() {
        return $this->Coupon;
    }

    public function getEvent() {
        return $this->Event;
    }

    public function getPickupDate() {
        return $this->PickupDate;
    }

    public function getPickupTime() {
        return $this->PickupTime;
    }
    
    // Setters
    public function setIDTicket($IDTicket) {
        $this->IDTicket = $IDTicket;
    }

    public function setNumTickets($NumTickets) {
        $this->NumTickets = $NumTickets;
    }

    public function setFirstName($FirstName) {
        $this->FirstName = $FirstName;
    }

    public function setLastName($LastName) {
        $this->LastName = $LastName;
    }

    public function setCoupon($Coupon) {
        $this->Coupon = $Coupon;
    }

    public function setEvent($Event) {
        $this->Event = $Event;
    }

    public function setPickupDate($PickupDate) {
        $this->PickupDate = $PickupDate;
    }

    public function setPickupTime($PickupTime) {
        $this->PickupTime = $PickupTime;
    }
}

?>