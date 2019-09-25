<?php


namespace Hackathon\PlayerIA;


class MinestroPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    protected function getChoice()
    {
        return parent::scissorsChoice();
    }
}