<?php
namespace Console;

use Console\BeesInterface;
use DateTime;

class Game implements BeesInterface {

    protected $messages = [];

    protected $score = 0;

    protected $state;

    protected $WORKER_HIT=10;
    
    protected $DRONE_HIT=12;

    protected $QUEEN_HIT=8;

    protected $timer;

    public function __construct() 
    {
        $this->start();
    }
    public function startTimer() 
    {
        $this->timer = new DateTime;
    }
    //This function get the cureent time in seconds of each hit
    public function getCurrentTime() 
    {
        $now = new DateTime;

        return ($now->format('U') - $this->timer->format('U'));
    }
    //This function start the timer
    public function start()
    {
        $this->startTimer();
    }
    //This function used to increment the hit score
    public function score() 
    {
        $this->score++;
    }
    //This function get the score of hit
    public function getScore() 
    {
        return $this->score;
    }
    //This function get the game state
    public function getGameState() 
    {
        return $this->state;
    }
    //This function set the game state
    public function setGameState($state) 
    {
        $this->state = $state;
    }
    //This function is used for looping the hit till game over
    public function playing() 
    {
        return $this->state !== SELF::STATE_GAMEOVER;
    }
    //This function get the total bees count
    public function  getBeesCount() 
    {
        $beefile=SELF::BEE_FILE;
        $jsondata = file_get_contents($beefile);
        return json_decode($jsondata, true);       
    }
    //This function is used for writing the bees information in json file
    public function writeInFile($arr_write) 
    {        
        $beefile=SELF::BEE_FILE;
        $jsondata = json_encode($arr_write, JSON_PRETTY_PRINT);
        if(file_put_contents($beefile, $jsondata)) {
            $this->message('');
            return true;
        }
        else {
            $this->message("error");
            return false;
        }     
    }
    //This function get the meesage stores in meesage array
    public function getMessages() 
    {
        return $this->messages;
    }
    //This function store message in array
    public function message($message)
    {
        $this->messages[] = $message;
    }
}
