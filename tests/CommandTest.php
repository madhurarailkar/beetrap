<?php
use PHPUnit\Framework\TestCase;
use Console\Commands;

class CommandTest extends TestCase {

    public function testInstantiateObject()
    {
        $command = new Commands();
        $this->assertIsObject($command);
    }

    public function testStart()
    {
        $command = new Commands();
        $command->start();
        $this->assertSame($command->getGameState(), Commands::STATE_PLAYING);
    }

    public function testFinalCount()
    {
        $command = new Commands();
        $this->assertSame($command->finalCount(Commands::WORKER_BEE), NULL);
    }

    public function testScore()
    {
        $command = new Commands();
        $command->score();
        $command->score();
        $command->score();
        $command->score();
        $command->score();
        $this->assertIsInt($command->getScore(), 5);
    }

    public function testGetScore() 
    {
        $command = new Commands();

        $this->assertIsInt($command->getScore());
    }

    public function testRestart() 
    {
        $command = new Commands();

        $this->assertArrayHasKey(Commands::QUEEN_LIFE, $command->getBeesCount());

    }

    public function testMessages() 
    {
        $command = new Commands();

        $this->assertIsArray($command->getMessages());

    }

    public function testWriteInFile() 
    {
        $command = new Commands();
        $arr_write=array(
            Commands::QUEEN_LIFE=>Commands::QUEEN_HEALTH*Commands::QUEEN_COUNT,
            Commands::WORKER_LIFE=>Commands::WORKER_HEALTH*Commands::WORKER_COUNT,
            Commands::DRONE_LIFE=>Commands::DRONE_HEALTH*Commands::DRONE_COUNT,
            );
        $this->assertIsBool($command->writeInFile($arr_write));
    }

    public function testPlaying() 
    {
        $command = new Commands();
        $this->assertIsBool($command->playing());
    }
    
    public function testGame() 
    {
        $command = new Commands();
        $this->assertSame($command->game(), NULL);
    }
}   