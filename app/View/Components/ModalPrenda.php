<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalPrenda extends Component
{
    public $prenda;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($prenda)
    {
        $this->prenda = $prenda;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-prenda');
    }
}
