<?php
/**
 * Created by PhpStorm.
 * User: dartvadius
 * Date: 27.01.18
 * Time: 12:37
 */

class countryModel extends baseModel {
    public static $tableName = 'country';

    public function get_by_id(int $id) {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id=:id LIMIT 1";
        $arg = [
            'id' => $id,
        ];
        $res = $this->pdo->prepare($sql);
        $res->execute($arg);
        $result = $res->fetch();
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