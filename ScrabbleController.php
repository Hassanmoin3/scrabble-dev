<?php
    use Src\Boot;
    use Src\Engine\Dictionary\Dictionary;
    use Src\Engine\Scrabble;
    require_once 'Src/Boot.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && 
    array_key_exists('rack', $_POST) &&
    !empty($_POST['rack'])) {
      $boot = new Boot();
      $dictionary = new Dictionary($boot);
      $scrabble = new Scrabble($dictionary);

      // Get the rack input from the form
      $rack = $_POST["rack"];

      // Run the Scrabble match and display the results
      $results = $scrabble->matchInDictionary($rack);

      //return results
      echo json_encode(["tiles"=>$rack,"data"=>$results]);
      }
    ?>