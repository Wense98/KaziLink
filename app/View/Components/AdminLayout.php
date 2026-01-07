<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    /**
     * The current view name, used for highlighting the sidebar.
     */
    public $currentView;

    /**
     * Create a new component instance.
     */
    public function __construct($currentView = 'overview')
    {
        $this->currentView = $currentView;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.admin');
    }
}
