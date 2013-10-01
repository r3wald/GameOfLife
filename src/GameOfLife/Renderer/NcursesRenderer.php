<?php

namespace GameOfLife\Renderer;

use GameOfLife\Playground;
use GameOfLife\State;

class NcursesRenderer
{
    /**
     * @var Playground
     */
    private $playground;

    /**
     * @var resource
     */
    private $window;

    /**
     * @var resource
     */
    private $screen;

    /**
     * @param Playground $playground
     */
    public function __construct(Playground $playground)
    {
        $this->playground = $playground;
        ncurses_init();
        ncurses_savetty();
        $this->screen = ncurses_newwin(0, 0, 0, 0);
        ncurses_border(0, 0, 0, 0, 0, 0, 0, 0);
        $this->window = ncurses_newwin($playground->getHeight() + 2, $playground->getWidth() * 2 + 1, 2, 2);
        ncurses_wborder($this->window, 0, 0, 0, 0, 0, 0, 0, 0);
        ncurses_refresh(0);
    }

    public function render($count, State $state, $static, $oscillating)
    {
        for ($y = 0; $y < $this->playground->getHeight(); $y++) {
            for ($x = 0; $x < $this->playground->getWidth(); $x++) {
                ncurses_mvwaddstr($this->window, $y + 1, 2 * $x + 1, $state->isAlive($this->playground, $x, $y) ? '*' : ' ');
            }
        }
        ncurses_wrefresh($this->window);
        if ($static) {
            ncurses_mvwaddstr($this->window, 1, 1, 'static');
            ncurses_wrefresh($this->window);
        } elseif ($oscillating) {
            ncurses_mvwaddstr($this->window, 1, 1, 'oscillating');
            ncurses_wrefresh($this->window);
        }
    }

    public function __destruct()
    {
        ncurses_resetty();
        ncurses_end();
    }
}