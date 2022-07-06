<?php 
include("inc_files/db.php");
include("inc_files/xmlfile.php");

$current_date = $xml_reader->attributes();
settype($current_date, "string");

try {
    $table_cre = "CREATE TABLE `".$current_date."` (
        ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Cur_Code VARCHAR(3) NOT NULL,
        Cur_Nom INT(11) NOT NULL,
        Cur_Name VARCHAR(100) NOT NULL,
        Cur_Value FLOAT NOT NULL
        )";
    $conn->exec($table_cre);

    $cur_table = $xml_reader->ValType[1];

    for($x = 0; $x < count($cur_table); $x++) {
        $code = $cur_table->Valute[$x]->attributes();
        $nominal = $cur_table->Valute[$x]->Nominal;
        $name = $cur_table->Valute[$x]->Name;
        $value = $cur_table->Valute[$x]->Value;
    
        $sql = "INSERT INTO `".$current_date."` (Cur_Code, Cur_Nom, Cur_Name, Cur_Value) VALUES ('$code', '$nominal', '$name', '$value')";
        $conn->exec($sql);
    }

    echo "Baza ugurla yaradildi";
}
catch(PDOException $e) {
    echo "Tekrarlanma: " . $e->getMessage();
}
?>