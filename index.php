<?php 
include("inc_files/db.php");
include("inc_files/xmlfile.php");
include("inc_files/tablecreator.php");

function CurChoice() {
    $sel_db = $GLOBALS['conn']->prepare("SELECT * FROM `".$GLOBALS['current_date']."`");
    $sel_db->execute();
    $result = $sel_db->fetchAll();			
    foreach( $result as $row ) {
        echo '<option value="'.$row["Cur_Code"].'">'.$row["Cur_Code"].'</option>';
    }
}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="author" content="OR-KHAN">
<meta name="description" content="task1">
<meta name="keywords" content="task1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="css/task1.css" rel="stylesheet" type="text/css">
<title>Converter</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="js/task1.js"></script>
</head>
<body>
<div id="anablok">
    <form method="POST" target="_self">
        <label for="from_cur">Choose FROM currency:</label>
        <select name="from_cur" id="from_cur">
            <option value="" selected disabled>----</option>
            <?php CurChoice(); ?>
        </select>
        <br>
        <label for="to_cur">Choose TO currency:</label>
        <select name="to_cur" id="to_cur">
            <option value="" selected disabled>----</option>
            <?php CurChoice(); ?>
        </select>
        <br>
        <input autocomplete="off" name="cur_amount" type="number" step="0.01" placeholder="AMOUNT">
        <input type="submit" value="Submit">
    </form>
    <br><br>
    <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sel_from_cur = $_POST['from_cur'];
        $sel_to_cur = $_POST['to_cur'];
        $sel_amount_cur = $_POST['cur_amount'];
        
        $sel_from_val = $GLOBALS['conn']->prepare("SELECT * FROM `".$GLOBALS['current_date']."` WHERE Cur_Code='$sel_from_cur'");
        $sel_to_val = $GLOBALS['conn']->prepare("SELECT * FROM `".$GLOBALS['current_date']."` WHERE Cur_Code='$sel_to_cur'");

        $sel_from_val->execute();
        $sel_to_val->execute();

        $fetch_fr = $sel_from_val->fetchAll();
        $fetch_to = $sel_to_val->fetchAll();

        $res_fr = null;
        $res_to = null;

        foreach( $fetch_fr as $row )
            $res_fr = $row["Cur_Value"];

        foreach( $fetch_to as $row )
            $res_to = $row["Cur_Value"];
        
        $converted = ($res_fr/$res_to) * $sel_amount_cur;
        echo "Your converted ".$sel_amount_cur." ".$sel_from_cur." value is ".$converted." ".$sel_to_cur;
    }
    ?>
</div>
</body>
</html>