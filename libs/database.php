<?php

class Database extends PDO {

    function __construct($dbDsn, $dbUsername, $dbPassword) {
        parent::__construct($dbDsn, $dbUsername, $dbPassword);
    }

    function selectDB($tableName, $arrayCond) {
        //print_r($arrayCond);echo('<br>');
        $sql = "SELECT * FROM $tableName WHERE ";

        foreach ($arrayCond as $key => $value) {
            $sql .= " $key = :$key AND";
        };
        $sql = rtrim($sql, 'AND');
        $stmt = $this->prepare($sql);

        foreach ($arrayCond as $key => $value) {
            $stmt->bindParam(":$key", $arrayCond[$key]);
        }
        $stmt->execute();
        $arrResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //echo(count($arrResult));
        return $arrResult;
    }

    function selectDBgetCol($tableName, $arrayCond, $strColsList) {
        $arrResult = [];
        $allColumns = explode(',', $strColsList);

        $sql = "SELECT $strColsList FROM $tableName WHERE ";
        foreach ($arrayCond as $key => $value) {
            $sql .= " $key = :$key AND";
        }
        $sql = rtrim($sql, 'AND');
        $stmt = $this->prepare($sql);
        foreach ($arrayCond as $key => $value) {
            $stmt->bindParam(":$key", $arrayCond[$key]);
        }
        $stmt->execute();
        while ($currentRow = $stmt->fetch()) {
            foreach ($allColumns as $key => $value) {
                $arrResult[$value][] = $currentRow[$value]; // $arrResult['username'] = $currentRow['username]
            }
        }
        //print_r($arrResult['username']);
        return $arrResult;
    }

    function selectAllDB($tableName, $strColsList) {
        $allColumns = explode(',', $strColsList);

        $sql = "SELECT $strColsList FROM $tableName";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        while ($currentRow = $stmt->fetch()) {
            foreach ($allColumns as $key => $value) {
                $arrResult[$value][] = $currentRow[$value]; // $arrResult['username'] = $currentRow['username]
            }
        }
        //print_r($arrResult['username']);
        return $arrResult;
    }

    function insertDB($tableName, $data) {
        $colomns = $placeHolders = '';
        foreach ($data as $key => $value) {
            $colomns .= "$key,";
            $placeHolders .= ":$key,";
        }
        $colomns = rtrim($colomns, ',');
        $placeHolders = rtrim($placeHolders, ',');
        $sql = "INSERT INTO $tableName ($colomns) VALUES ($placeHolders)";
        //echo $sql;
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }
        $stmt->execute();
        return $stmt->rowCount();
    }

    function updateDB($data, $tableName, $arrayCond) { // updateDB($dataarray,'tablename', 'usedID', 12) 
        reset($arrayCond);
        $testedCol = key($arrayCond);

        $sql = "UPDATE $tableName SET ";
        foreach ($data as $key => $value) {
            $sql .= "$key = :$key, ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE $testedCol = :matchValue";
        $stmt = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }
        $stmt->bindParam(':matchValue', $arrayCond[$testedCol]);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function deleteFromDB($tableName, $arrayCond) {
        $sql = "DELETE FROM $tableName WHERE ";
        foreach ($arrayCond as $key => $value) {
            $sql .= " $key = :$key AND";
        }
        $sql = rtrim($sql, 'AND');

        $stmt = $this->prepare($sql);
        foreach ($arrayCond as $key => $value) {
            $stmt->bindParam(":$key", $arrayCond[$key]);
        }
        $stmt->execute();
        return $stmt->rowCount();
    }

    function selectCountDB($tableName, $columnName, $arrayCond = NULL) {
        if (empty($arrayCond)) {
            $sql = "SELECT COUNT($columnName) FROM $tableName";
        } else {
            $sql = "SELECT COUNT($columnName) FROM $tableName WHERE ";
            foreach ($arrayCond as $key => $value) {
                $sql .= " $key = :$key AND";
            }
            $sql = rtrim($sql, 'AND');
        }

        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function emptyDB($argTableName){
        return $this->exec("TRUNCATE $argTableName");
    }

}
