<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * The libraries link and attribute.
     *
     * @var array
     */
    private $links = [
        'nunito-font' => [
            'css' => 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap',
        ],
        'sweetalert' => [
            'js' => 'https://cdn.jsdelivr.net/npm/sweetalert2@10',
            'js-attribute' => '',
        ],
        /* Add here for another libraries link
        'library-name' => [
            'css' => '',
            'js' => '',
            'js-attribute' => '',
        ],
        */
    ];

    /**
     * The app libraries.
     *
     * @var array
     */
    public $libs;

    /**
     * Create the component instance.
     *
     * @param  array  $libs[]
     * @return void
     */
    public function __construct($libs = null)
    {
        if (null !== $libs) $this->libs = array_unique($libs);
    }

    /**
     * Get libraries for style.
     *
     * @return void
     */
    public function styles()
    {
        if (null !== $this->libs)
            foreach ($this->libs as $lib) {
                if (isset($this->links[$lib]['css']))
                    echo '<link rel="stylesheet" href="' . $this->links[$lib]['css'] . '">';
            }
    }

    /**
     * Get libraries for script.
     *
     * @return void
     */
    public function scripts()
    {
        if (null !== $this->libs)
            foreach ($this->libs as $lib) {
                if (isset($this->links[$lib]['js']))
                    echo '<script src="' . $this->links[$lib]['js'] . '" ' . ($this->links[$lib]['js-attribute'] ?? '') . '></script>';
            }
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
