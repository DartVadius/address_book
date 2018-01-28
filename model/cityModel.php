<?php
/**
 * Created by PhpStorm.
 * User: dartvadius
 * Date: 27.01.18
 * Time: 12:38
 */

class cityModel extends baseModel {
    public static $tableName = 'city';

    public function get_by_country_id(int $id) {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE country_id = :country_id";
        $arg = [
            'country_id' => $id,
        ];
        $res = $this->pdo->prepare($sql);
        $res->execute($arg);
        $result = $res->fetchAll();
        return $result;
    }

    public function get_all() {
        $sql = "SELECT * FROM " . self::$tableName;
        $res = $this->pdo->prepare($sql);
        $res->execute();
        $result = $res->fetchAll();
        return $result;
    }
}