<?php


namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

class MinestroPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;
    private $historicType;
    private $historicScore;
    private $round = 0;

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
        $this->historicType[] = $nbTypes;
        $this->historicScore[] = array('a' => $stats['a']['score'], 'b' => $stats['b']['score']);

        $nbEvenGames = $this->getNbEvenGames();
        $diffTypes = $this->getDiffTypes(3);
        $lastPlayed = $this->getLastPlayed();

        if ($nbEvenGames >= 3) {
            $diffTypes[$lastPlayed] -= 1000;
        }

        $minType = array_keys($diffTypes, min($diffTypes));
        $this->round++;
        return $this->getChoiceFromString($minType[0]);
    }

    private function getLastPlayed() {
        $diff = $this->getDiffTypes(1);
        return array_keys($diff, max($diff))[0];
    }

    private function getDiffTypes($delta) {
        if ($delta > $this->round) {
            return $this->historicType[$this->round];
        }

        $diff = array(
            'rock' => $this->historicType[$this->round]['rock'] - $this->historicType[$this->round - $delta]['rock'],
            'paper' => $this->historicType[$this->round]['paper'] - $this->historicType[$this->round - $delta]['paper'],
            'scissors' => $this->historicType[$this->round]['scissors'] - $this->historicType[$this->round - $delta]['scissors']
        );

        return $diff;
    }

    private function getNbEvenGames() {
        $count = 0;
        for ($i = $this->round; $i >=1; $i--){
            if ($this->historicScore[$i] == $this->historicScore[$i-1]) {
                $count++;
            } else {
                break;
            }
        }

        return $count;
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