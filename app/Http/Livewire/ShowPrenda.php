<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prenda;


class ShowPrenda extends Component
{
    public $prenda;
    public $open = false;
    
    public function setClose()
    {
        $this->open = false;
    }

    public function setOpen()
    {
        $this->open = true;
    }

    

    public function render()
    {
        
        
        return view('livewire.show-prenda');
    }
}
