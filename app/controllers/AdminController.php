<?php
abstract class user {
    protected $name;
    protected $email;

    public abstract function getDetails();
}
class Admin extends user {

    private $adminStuff = "admin stuff";
    public function getDetails() {

        return [$this->adminStuff, $this->name, $this->email];
    }

}
class Agente extends user {



    private $agentStuff = "agent stuff";
    public function getDetails() {
        return [$this->agentStuff, $this->name, $this->email];
    }
}