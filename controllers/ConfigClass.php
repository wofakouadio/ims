<?php
/**
 * This class is designed to attenuate the repetition of same code script through this project
 * So to avoid that, we have created methods that accept various parameters to perform as intended
 * As you see the method name depicts what actually it does
*/
class ConfigClass
{
    /**
     * this method allow auto generation of custom id by filling in the various parameters
     * @param $db_connection
     * @param $db_table
     * @param $db_columnName
     * @param $format
     * @param $zero_length
     * @return string
     */
    public function GenerateAutomaticIDWithFiveParams($db_connection, $db_table, $db_columnName, $format, $zero_length){
        $sqlOne = "SELECT * FROM `$db_table`";
        $stmtOne = $db_connection->prepare($sqlOne);
        $stmtOne->execute();
        if($stmtOne->rowCount() == 0){
            $countFrom = 1;
        }else{
            $sqlTwo = "SELECT `$db_columnName` FROM `$db_table` ORDER BY `$db_columnName` DESC LIMIT 1";
            $stmtTwo = $db_connection->prepare($sqlTwo);
            $stmtTwo->execute();
            $LastInsertedId = $stmtTwo->fetchColumn();
            $explode = substr($LastInsertedId, -$zero_length);
            $countFrom = "$explode" + 1;
        }
        return sprintf("%0".$zero_length."d", $countFrom);
    }

    /**
     * this method allow auto generation of custom id by filling in the various parameters
     * @param $db_connection
     * @param $db_table
     * @param $db_columnName
     * @param $format
     * @param $zero_length
     * @param $variable
     * @return string
     */
    public function GenerateAutomaticIDWithSixParams($db_connection, $db_table, $db_columnName, $format, $zero_length, $variable){
        $sqlOne = "SELECT * FROM `$db_table` WHERE `$db_columnName` = :variable";
        $stmtOne = $db_connection->prepare($sqlOne);
        $stmtOne->bindValue(":variable", $variable, PDO::PARAM_STR);
        $stmtOne->execute();
        if($stmtOne->rowCount() == 0){
            $countFrom = 1;
        }else{
            $sqlTwo = "SELECT `$db_columnName` FROM `$db_table` WHERE `$db_columnName` = :variable ORDER BY `$db_columnName` DESC LIMIT 1";
            $stmtTwo = $db_connection->prepare($sqlTwo);
            $stmtOne->bindValue(":variable", $variable, PDO::PARAM_STR);
            $stmtTwo->execute();
            $LastInsertedId = $stmtTwo->fetchColumn();
            $explode = substr($LastInsertedId, -$zero_length);
            $countFrom = "$explode" + 1;
        }
        return sprintf("%0".$zero_length."d", $countFrom);
    }
}