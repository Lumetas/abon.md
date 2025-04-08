<?php
namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Dashboard extends Component
{
    public $header;
    
    public function __construct($header = null)
    {
        $this->header = $header;
    }

    public function render()
    {
        return view('components.layouts.dashboard');
    }
}