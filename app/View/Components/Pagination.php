<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $perPage;
    public $totalItems;
    public $numberOfPages;
    public $pageNumber;
    public $position;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($perPage, $totalItems, $pageNumber, $position)
    {
        $this->perPage = $perPage;
        $this->totalItems = $totalItems;
        $this->pageNumber = $pageNumber;
        $this->position = $position;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->numberOfPages = ceil($this->totalItems / $this->perPage );
        return view('components.pagination');
    }
}
