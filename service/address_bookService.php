<?php
/**
 * Created by PhpStorm.
 * User: dartvadius
 * Date: 24.01.18
 * Time: 21:44
 */

class address_bookService extends baseService {

    /**
     * picture upload
     *
     * @return null|string
     */
    public function file_upload() {
        $thumb_filename = null;
        if (!empty($_FILES['photo']['name'])) {
            $upload_dir = 'images/user_pic/';
            $upload_file = $upload_dir . basename($_FILES['photo']['name']);
            move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file);
            $original_info = getimagesize($upload_file);
            $original_w = $original_info[0];
            $original_h = $original_info[1];
            $original_img = imagecreatefromjpeg($upload_file);
            $thumb_w = 400;
            $thumb_h = 300;
            $thumb_img = imagecreatetruecolor($thumb_w, $thumb_h);
            imagecopyresampled($thumb_img, $original_img,
                0, 0,
                0, 0,
                $thumb_w, $thumb_h,
                $original_w, $original_h);
            $thumb_filename = 'images/user_pic/resize_' . basename($_FILES['photo']['name']);
            imagejpeg($thumb_img, $thumb_filename);
            imagedestroy($thumb_img);
            imagedestroy($original_img);
        }
        return $thumb_filename;
    }

    /**
     * get all countries
     *
     * @return array
     */
    public function get_countries() {
        $country_model = new countryModel();
        $country_list = $country_model->get_all();
        $result = [
            'country_list' => $country_list,
        ];
        return $result;
    }

    /**
     * get cities list by country id
     *
     * @param int $id
     *
     * @return array
     */
    public function get_cities(int $id) {
        $city_model = new cityModel();
        $cities_list = $city_model->get_by_country_id((int)$id);
        return $cities_list;
    }

    /**
     * get data for edit form by address book entry id
     *
     * @param int $id
     *
     * @return array
     */
    public function edit(int $id) {
        $address_book_model = new addressModel();
        $country_model = new countryModel();
        $city_model = new cityModel();

        $book_row = $address_book_model->get_by_id((int)$id);
        $country_list = $country_model->get_all();
        $cities_list = $city_model->get_by_country_id((int)$book_row['country_id']);
        $result = [
            'book_row' => $book_row,
            'country_list' => $country_list,
            'cities_list' => $cities_list,
        ];
        return $result;
    }

    /**
     * password and login checkout
     *
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function auth_validate($login, $password) {
        $sql = "SELECT * FROM " . userModel::$tableName . " WHERE login = :login AND password = :password";
        $arr = [
            'login' => $login,
            'password' => $password,
        ];
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
        if ($pos = $res->fetch()) {
            return true;
        }
        return false;
    }

    /**
     * validate access to admin area
     *
     * @return bool
     */
    public function access_validate() {
        if (empty($_SESSION['auth']) || $_SESSION['auth'] !== 1) {
            return false;
        }
        return true;
    }

    /**
     * pagination
     *
     * @param object      $model
     * @param int         $page
     * @param int         $limit
     * @param string|null $where
     *
     * @return array|bool
     */
    public function pagination($model, $page, $limit, $where = null) {
        $sql = "SELECT count(*) FROM " . $model::$tableName;

        if ($where) {
            $sql .= " {$where}";
        }

        $res = $this->pdo->query($sql);
        $count = $res->fetchColumn();
        $limit = empty($limit) ? $count : $limit;
        if (!$pages = ceil($count / $limit)) {
            return false;
        }
        if ($page <= 0) {
            $page = 1;
        }
        if ($page > $pages) {
            $page = $pages;
        }
        $offset = $page * $limit - $limit;

        $sql = "SELECT id FROM  {$model::$tableName}  LIMIT {$offset}, {$limit}";
        if ($where) {
            $sql .= " {$where}";
        }

        $res = $this->pdo->query($sql);
        $output = $res->fetchAll();
        if ($output) {
            $output['nav']['current'] = $page;
            if ($page - 1 >= 1) {
                $output['nav']['current-1'] = $page - 1;
            }
            if ($page - 2 >= 1) {
                $output['nav']['current-2'] = $page - 2;
            }

            if ($page + 1 <= ceil($count / $limit)) {
                $output['nav']['current+1'] = $page + 1;
            }
            if ($page + 2 <= ceil($count / $limit)) {
                $output['nav']['current+2'] = $page + 2;
            }
            return $output;
        } else {
            return false;
        }
    }
}