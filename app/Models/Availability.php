<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    public bool $AmAvailable;
    public bool $PmAvailable;
    public bool $FullAvailable;
    public bool $NotAvailable;
    public string $FinalAvailable;

    public function __construct(bool $AmAvailable, bool $PmAvailable, 
    bool $FullAvailable, bool $NotAvailable, string $FinalAvailable){
        $this->AmAvailable = $AmAvailable;
        $this->PmAvailable = $PmAvailable;
        $this->FullAvailable = $FullAvailable;
        $this->NotAvailable = $NotAvailable;
        $this->FinalAvailable = $FinalAvailable;
    }
    function set_AmAvailable(bool $AmAvailable){
        $this->AmAvailable = $AmAvailable;
        $this->PmAvailable = self::get_PmAvailable();
        if($AmAvailable = True && $this->PmAvailable = True){
            $NotAvailable = False;
            $FinalAvailable = "Fully Available";
            self::set_NotAvailable($NotAvailable);
            self::set_FinalAvailable($FinalAvailable);
        }else if($AmAvailable = True && $this->PmAvailable = False){
            $NotAvailable = False;
            $FinalAvailable = "Morning Available";
            self::set_NotAvailable($NotAvailable);
            self::set_FinalAvailable($FinalAvailable);
        }
    }
    function get_AmAvailable(){
        return $this->AmAvailable;
    }
    function set_PmAvailable(bool $PmAvailable){
        $this->PmAvailable = $PmAvailable;
        if($PmAvailable = True){
            $NotAvailable = False;
            self::set_NotAvailable($NotAvailable);
        }else if($PmAvailable = True && $this->get_AmAvailable = False){
            $FinalAvailable = "Afternoon Available";
            self::set_FinalAvailable($FinalAvailable);
        }
    }
    function get_PmAvailable(){
        return $this->PmAvailable;
    }
    function set_FullAvailable(bool $FullAvailable){
        $this->FullAvailable = $FullAvailable;
        if($FullAvailable = True){
            $AmAvailable = True;
            $PmAvailable = True;
            $NotAvailable = False;
            $FinalAvailable = "Fully Available";
            self::set_AmAvailable($AmAvailable);
            self::set_PmAvailable($PmAvailable);
            self::set_NotAvailable($NotAvailable);
            self::set_FinalAvailable($FinalAvailable);
        }
    }
    function get_FullAvailable(){
        return $this->FullAvailable;
    }
    function set_NotAvailable(bool $NotAvailable){
        $this->NotAvailable = $NotAvailable;
        if($NotAvailable = True){
            $AmAvailable = False;
            $PmAvailable = False;
            $FullAvailable = False;
            $FinalAvailable = "Not Available";
            self::set_AmAvailable($AmAvailable);
            self::set_PmAvailable($PmAvailable);
            self::set_FullAvailable($FullAvailable);
            self::set_FinalAvailable($FinalAvailable);
        }
    }
    function get_NotAvailable(){
        return $this->NotAvailable;
    }
    function set_FinalAvailable(string $FinalAvailable){
            $this->FinalAvailable = $FinalAvailable;
    }
    function get_FinalAvailable(){
        return $this->FinalAvailable;
    }
    public function day(){
        return $this->belongsTo(Day::class);
    }
}