<?php


namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

class MinestroPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $nbTypes = array(
            'paper' => 0,
            'rock' => 0,
            'scissors' => 0
        );

        $stats = $this->result->getStats();
        $nbTypes['paper'] = $stats[$this->opponentSide]['paper'];
        $nbTypes['rock'] = $stats[$this->opponentSide]['rock'];
        $nbTypes['scissors'] = $stats[$this->opponentSide]['scissors'];

        $minType = array_keys($nbTypes, min($nbTypes));
        return $this->getChoiceFromString($minType[0]);
    }

    private function getChoiceFromString($string) {
        switch ($string) {
            case 'paper':
                return parent::paperChoice();
            case 'rock':
                return parent::rockChoice();
            default:
                return parent::scissorsChoice();
        }
    }
}