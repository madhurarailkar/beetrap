<?php
namespace Console;

interface BeesInterface {
    //When game over keep this state
    const STATE_GAMEOVER = 'gameOver';
    //When game started keep this state
    const STATE_PLAYING = 'playing';
    //When user type HIT
    const ATTACK_ACTION = 'hit';
    //When cmd prompt to enter
    const ATTACK_INTRO = 'Type HIT to attack a bee!';
    //Josn file where data store
    const BEE_FILE='bee.json';

    //Health of Queen 
    const QUEEN_LIFE='QueenLife';
    //Health of Worker 
    const WORKER_LIFE='WorkerLife';
    //Health of Drone 
    const DRONE_LIFE='DroneLife';
    //Bee name set to queen
    const QUEEN_BEE='Queen';
    //Bee name set to worker
    const WORKER_BEE='Worker';
    //Bee name set to Drone
    const DRONE_BEE='Drone';

    //Queen health and count
    const QUEEN_HEALTH=100;
    const QUEEN_COUNT=1;

    //Worker health and count
    const WORKER_HEALTH=75;
    const WORKER_COUNT=5;

    //Drone health and count
    const DRONE_HEALTH=50;
    const DRONE_COUNT=8;

    //Start the game
    public function start();
    //playing till queen dead
    public function playing();
    //keep counting the hit score
    public function score();
}