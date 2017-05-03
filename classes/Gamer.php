<?php

class Gamer{

    private $name;
    private $testData;

    public function getMyName() {
        return $this->name;
    }

    public function getMyTestData() {
        return $this->testData;
    }

    public function setGamerAttributesFromRepository($rawUserObject) {
        $this->name = $rawUserObject->name;
        $this->testData = $rawUserObject->testData;
    }
}

?>