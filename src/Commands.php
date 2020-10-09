<?php 
namespace Console;

use Console\BeesInterface;
use Console\Game;

class Commands extends Game implements BeesInterface {

    public function __construct()
    {
        $this->start();
        $this->setGameState(self::STATE_PLAYING);
    }
    //this funciton is used for calulating the bees life at each HIT
    public function finalCount($type)
    {
        $arr_data=$this->getBeesCount();
        
        $queenlife= $arr_data[SELF::QUEEN_LIFE];
        $WorkerLife= $arr_data[SELF::WORKER_LIFE];
        $DroneLife= $arr_data[SELF::DRONE_LIFE];
            
        if($type==SELF::QUEEN_BEE) {
            $queenlife= $arr_data[SELF::QUEEN_LIFE]-8;
            if($queenlife<=0) {
                $this->message("Queen bee was attacked with $this->QUEEN_HIT hit ponts and now is dead \n");
                $this->message("Queen bee is dead, so the hive has been drestoryed.\n");
                $this->message("All bees are dead, game over. \n");
                $this->message("You HIT total ". $this->getScore()." Times \n");
                $this->setGameState(SELF::STATE_GAMEOVER);
            }
            else {
                $this->message("Direct Hit. You took $this->QUEEN_HIT hit points from Queen bee\nFor Queen Bee : Total $queenlife health left \n");
            }
        }
        if($type==SELF::WORKER_BEE) {
            $WorkerLife= $arr_data[SELF::WORKER_LIFE]-10;
            if($WorkerLife<=0) {
                $this->message("Worker bee was attacked with $this->WORKER_HIT and now is dead \n");
            }
            else {
                $this->message("Direct Hit. You took $this->WORKER_HIT hit points from Worker bee\nFor Worker Bee: Total $WorkerLife health left \n");
            }
        }
        if($type==SELF::DRONE_BEE) {
            $DroneLife= $arr_data[SELF::DRONE_LIFE]-12;
            if($DroneLife<=0) {
                $this->message("Drone bee was attacked with $this->DRONE_HIT and now id dead \n");
            }
            else {
                $this->message("Direct Hit. You took $this->DRONE_HIT hit points from Drone bee\nFor Drone Bee: Total $DroneLife health left \n");
            }

        }
        $arr_write=array(
                SELF::QUEEN_LIFE=>$queenlife,
                SELF::WORKER_LIFE=>$WorkerLife,
                SELF::DRONE_LIFE=>$DroneLife,
            );
            $this->writeInFile($arr_write);

    }
    //When user start the game all over that time adding the fresh count in the json file
    public function restart()
    {
        $arr_write=array(
            SELF::QUEEN_LIFE=>SELF::QUEEN_HEALTH*SELF::QUEEN_COUNT,
            SELF::WORKER_LIFE=>SELF::WORKER_HEALTH*SELF::WORKER_COUNT,
            SELF::DRONE_LIFE=>SELF::DRONE_HEALTH*SELF::DRONE_COUNT,
            );
            $result=$this->writeInFile($arr_write);  
            if($result) {
                $this->message('Your Game has started...!!!');
            }
    }
    //this function is get called from the command line and shuffle the bees
    public function game() 
    {
        $getBeeCount=$this->getBeesCount();
        $this->score();
        $this->messages=[];
        $functions = array(SELF::QUEEN_BEE,SELF::WORKER_BEE,SELF::DRONE_BEE);
        if($getBeeCount[ SELF::WORKER_LIFE]<=0) {
            $functions = array(SELF::QUEEN_BEE,SELF::DRONE_BEE);
        }
        if($getBeeCount[SELF::DRONE_LIFE]<=0) {
            $functions = array(SELF::QUEEN_BEE,SELF::WORKER_BEE);
        }
        if($getBeeCount[SELF::QUEEN_LIFE]<=0) {
            $functions = array(SELF::QUEEN_BEE,SELF::WORKER_BEE,SELF::DRONE_BEE);
            $this->restart();
        }

    }
}

