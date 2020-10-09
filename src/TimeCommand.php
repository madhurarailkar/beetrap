<?php 
namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Console\Commands;

class TimeCommand extends Command
{
    public function configure()
    {
        $this->setName('hit');
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $commands=new Commands();
        //Till the game is not over this loops continue
        while ($commands->playing()) {
            // Turn is when the user is told to type hit, and when they type hit
            $question = new Question("[Time: {$commands->getCurrentTime()} seconds] Type hit to attack a bee! ");
            if ($helper->ask($input, $output, $question) == Commands::ATTACK_ACTION) {
                //we hit
                $result=$commands->game();
                unset($question);
            } 
            else {
            $commands->message("WRONG! Try again (You need to type hit)");
            }
            $messages = $commands->getMessages();

            // Loop through the messages and output to the user
            foreach ($messages as $message) {
                $output->writeLn($message);
            }
        }
	    return is_int($result) ? $result : 0;
    }
}

