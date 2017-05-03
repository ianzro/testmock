<pre>
<?php

require __DIR__ . '/vendor/autoload.php';

/*
    This is to initialize aspectMock and assuming you already have autoload for composer
 */
$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    'includePaths' => [__DIR__.'/classes']
]);

$kernel->loadPhpFiles(__DIR__.'/classes');


function createGamerFromRepository($rawGamerObject) {
    $newGamer = new Gamer();
    
    $newGamer->setGamerAttributesFromRepository($rawGamerObject);

    return $newGamer;
}

// No mocks yet or anything
echo "Creating a gamer from repository normally\n";
$gamerRepo = new GamerRepository();
$testGamer = createGamerFromRepository($gamerRepo->getRandomGamer());

print_r($testGamer);
echo "<hr>";

/*
    What if I want to create a test double from a repository
    I'll create a mock of the method that gets the raw json data
 */
echo "Creating a gamer from a mocked GamerRepository object\n";

$newGamerRepo = \AspectMock\Test::double(new GamerRepository, ['getGamerJSONStringFromSource' => 
    function () { return '{
        "users": [
            {
                "name" : "You are hacked",
                "testData" : "dummy"
            }]
        }';
    }
]);

$newGamer = createGamerFromRepository($newGamerRepo->getRandomGamer());
print_r($newGamer);
echo "<hr>";

/*
    What if I want to create a test double from a repository
    I'll create a mock of the method that gets the raw json data
 */
echo "Creating a gamer from a mocked GamerRepository object with a different way of mocking\n";

$newGamerRepo = \AspectMock\Test::double(new GamerRepository, ['getGamerJSONStringFromSource' => 
    '{
        "users": [
            {
                "name" : "You are hacked twice",
                "testData" : "dummy dummy"
            }]
    }'
]);

$newGamer = createGamerFromRepository($newGamerRepo->getRandomGamer());
print_r($newGamer);


echo "<hr>";

/*
    To clean all of the stuffs that were mocked and stubbed just use this method
    \AspectMock\Test::clean();
 */
\AspectMock\Test::clean();

echo "Creating a gamer with a clean game repository (no mocks again)";
$lastGamerRepo = new GamerRepository();
$lastGamer = createGamerFromRepository($lastGamerRepo->getRandomGamer());

print_r($lastGamer);


?>
</pre>