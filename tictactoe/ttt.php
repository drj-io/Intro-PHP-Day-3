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



// print out the value of $_POST['board']
function debug($val){
    $output = print_r($val, true);
    echo "<pre>". $output ."</pre>";
}




// Display the chosen value, or a button to choose a value to the front end.
function getCell($row, $col){

    global $board;

    $val = $board[$row][$col];

    if(is_null($val)){
        // if there's no value, put in the submit button for this cell
        return "<input type='submit' value='$row,$col' name='select' />";
    } else {

        // otherwise, print the value for this cell.
        return "<h1>$val</h1><input name='board[$row][$col]' value='$val' />";
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


?>

<html>
<head>
    <title>Tic Tac Toe</title>
</head>
<body>
    <pre><?php print_r($_POST); ?></pre>


    <form method="POST">
        <input value="<?= $next_player_idx; ?>"  name="player" />
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
