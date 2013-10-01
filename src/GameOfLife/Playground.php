<?php

namespace GameOfLife;

class Playground
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct($width=10, $height=10)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function isValidPosition($x, $y) {
        if ($x<0 || $x>=$this->getWidth() || $y<0 || $y>=$this->getHeight()) {
            return false;
        }
        return true;
    }

}