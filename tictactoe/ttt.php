<?php

// Presets the value of who's who (x or 0), (0 , 1)
$players = ["X", "O"];

// Figure out who just took their turn
$current_player_idx = getPlayerIdx();

// Set player to who just played
$player = $players[$current_player_idx];

// Figure out who goes next.
$next_player_idx = getNextPlayerIdx($current_player_idx);


// Initialize the board!
$board = [
    [null, null, null],
    [null, null, null],
    [null, null, null]
];

// Did they hit a button?
if(isset($_POST['select'])){

    // turn "0,0" into array
    $parts = explode(',', $_POST['select']);

    // Set the value on the board
    $board[  $parts[0]  ]    [  $parts[1]  ]    = $player; // sets piece


    //are there preset values on the HTML board?
    if(isset($_POST['board'])) {

        // iterate through the first dimension
        forEach ($_POST['board'] as $rowidx => $row) {

            // iterate through the second dimesion
            forEach ($row as $colidx => $col) {

                // set the value on our virtual board ($board)
                $board[$rowidx][$colidx] = $col;
            }
        }

    }
}
$winner = whoWins($board);

if ($winner){
  print "<h1>".$winner . " wins!</h1>";
}

// print out the value of $_POST['board']
function debug($val){
    $output = print_r($val, true);
    echo "<pre>". $output ."</pre>";
}




// Display the chosen value, or a button to choose a value to the front end.
function getCell($row, $col){

    global $board;
    global $winner;

    $val = $board[$row][$col];

    if((is_null($val)) && (!$winner)){
        // if there's no value, put in the submit button for this cell
        return "<input type='submit' value='$row,$col' name='select' />";
    } else {

        // otherwise, print the value for this cell.
        return "<h1>$val</h1><input type='hidden' name='board[$row][$col]' value='$val' />";
    }
}

function getPlayerIdx(){

    $val = 1;

    if(isset($_POST['player'])){
        $val = intval($_POST['player']);
    }

    return $val;
}

function getNextPlayerIdx($idx){
    global $players;

    $val = $idx;
    $val++;
    if($val >= count($players)) $val = 0;
    return $val;
}


// Detect a winner and return the player that won.
function whoWins($board){

  // Check Rows
  foreach($board as $row){
    if(($row[0] == $row[1]) &&  ($row[1] == $row[2]) && ($row[0])){
      return $row[0];
    }
  }

  // Check columns
  for($i=0;$i<3;$i++){
    if(($board[0][$i] == $board[1][$i]) && ($board[1][$i] == $board[2][$i]) && ($board[0][$i])){
      return $board[0][$i];
    }
  }

  // Check Diagonal (top left to bottom right)
  if( ($board[0][0] == $board[1][1]) && ($board[1][1] == $board[2][2]) && ($board[0][0]) ){
    return $board[0][0];
  }
  // Check Diagonal (top right to bottom left)
  if( ($board[2][0] == $board[1][1]) && ($board[1][1] == $board[0][2]) && ($board[2][0]) ){
    return $board[2][0];
  }

  // If we've gotten this far, we can assume that there is no winner so return null.
  return null;
}



?>

<html>
<head>
    <title>Tic Tac Toe</title>
</head>
<body>



    <form method="POST">
        <input type="hidden" value="<?= $next_player_idx; ?>"  name="player" />
        <table border="1", cellspacing="0" cellpadding="25">
            <tr>
                <td><?= getCell(0,0); ?></td>
                <td><?= getCell(0,1); ?></td>
                <td><?= getCell(0,2); ?></td>
            </tr>
            <tr>
                <td><?= getCell(1,0); ?></td>
                <td><?= getCell(1,1); ?></td>
                <td><?= getCell(1,2); ?></td>
            </tr>
            <tr>
                <td><?= getCell(2,0); ?></td>
                <td><?= getCell(2,1); ?></td>
                <td><?= getCell(2,2); ?></td>
            </tr>
        </table>
    </form>
    <?= debug($board); ?>

    <style> input { border: black 1px dashed; }
</body>
</html>
