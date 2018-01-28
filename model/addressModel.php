<?php
/**
 * Created by PhpStorm.
 * User: dartvadius
 * Date: 25.01.18
 * Time: 22:00
 */

class addressModel extends baseModel {
    public static $tableName = 'address_book';

    public function get_all_by_ids(array $ids) {
        $ids = implode(',', $ids);
        $sql = "SELECT ab.*, co.name AS country_name, ci.name AS city_name FROM " . self::$tableName . " AS ab 
        LEFT JOIN " . countryModel::$tableName . " AS co ON ab.country_id = co.id 
        LEFT JOIN " . cityModel::$tableName . " AS ci ON ab.city_id = ci.id
        WHERE ab.id IN ($ids)";
        $res = $this->pdo->prepare($sql);
        $res->execute();
        $result = $res->fetchAll();
        return $result;
    }

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

    public function delete_by_id(int $id) {
        $sql = "DELETE FROM " . self::$tableName . " WHERE id=:id";
        $arg = [
            'id' => $id,
        ];
        $res = $this->pdo->prepare($sql);
        $result = $res->execute($arg);
        return $result;
    }

    public function insert(array $data, $file = null) {
        $sql = "INSERT INTO " . self::$tableName . " SET first_name=:first_name, last_name=:last_name, email=:email, 
        country_id=:country, city_id=:city, photo_url=:photo_url, notes=:notes";
        $arg = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'country' => (int)$data['country'],
            'city' => (int)$data['city'],
            'photo_url' => $file ?? null,
            'notes' => $data['notes'] ?? null,
        ];
        $res = $this->pdo->prepare($sql);
        $result = $res->execute($arg);
        return $result;
    }

    public function update(array $data, $file = null) {
        $sql = "UPDATE " . self::$tableName . " SET first_name=:first_name, last_name=:last_name, email=:email, 
        country_id=:country, city_id=:city, photo_url=:photo_url, notes=:notes 
        WHERE id=:id";
        $arg = [
            'id' => (int)$data['row_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'country' => (int)$data['country'],
            'city' => (int)$data['city'],
            'photo_url' => $file ?? null,
            'notes' => $data['notes'] ?? null,
        ];
        $res = $this->pdo->prepare($sql);
        $result = $res->execute($arg);
        return $result;
    }

    public function find($keyword, $country_id, $city_id) {
        $word = "%$keyword%";
        $sql = "SELECT * FROM " . self::$tableName . " WHERE CONCAT(first_name, ' ', last_name) LIKE :word";
        $arg = [
            'word' => $word,
        ];

        $res = $this->pdo->prepare($sql);

        $res->execute($arg);
        $result = $res->fetchAll();
        $filtered = [];
        if (!empty($city_id) && !empty($result)) {
            foreach ($result as $row) {
                if ($row['city_id'] == $city_id) {
                    $filtered[] = $row;
                }
            }
            return $filtered;
        }
        if (!empty($country_id) && !empty($result)) {
            foreach ($result as $row) {
                if ($row['country_id'] == $country_id) {
                    $filtered[] = $row;
                }
            }
            return $filtered;
        }
        return $result;
    }

}