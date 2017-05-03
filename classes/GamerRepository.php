<?php

class GamerRepository{

    private $gamerPool;

    public function getRandomGamer() {
        $this->gamerPool = $this->getGamerPool();
        $gamerPoolSize = count($this->gamerPool);
        $randomGamerIndex = rand(0, $gamerPoolSize);

        if($randomGamerIndex === $gamerPoolSize) {
            $randomGamerIndex = $gamerPoolSize - 1;
        }

        return $this->gamerPool[$randomGamerIndex];
    }

    private function getGamerPool() {
        $jsonString = $this->getGamerJSONStringFromSource();

        $jsonObject = json_decode($jsonString,false);
        
        return $jsonObject->users;
    }

    private function getGamerJSONStringFromSource() {
        return file_get_contents("gamers.json");
    }


}

?>