<?php
/**
 * Created by PhpStorm.
 * User: dartvadius
 * Date: 25.01.18
 * Time: 22:51
 */

class adminController extends baseController {

    private $address_book_service;

    public function __construct() {
        $this->address_book_service = new address_bookService();
        parent::__construct();
    }

    public function indexAction() {
        if (!$this->address_book_service->access_validate()) {
            header("Location: /index");
            exit();
        }
        $param = [
            ['/admin/index', []]
        ];
        $this->view->render($param);
    }

    public function loginAction() {
        $message = ['error_message' => ''];
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            if ($this->address_book_service->auth_validate($_POST['login'], $_POST['password'])) {
                $_SESSION['auth'] = 1;
                $param = [
                    ['/admin/index', []]
                ];
                header("Location: /admin/index");
                exit();
            }
            $message = ['error_message' => 'Entered username and/or password are incorrect. <br> Please try one more time.'];
        }
        $param = [
            ['admin/login', $message]
        ];
        $this->view->render($param);
    }

    public function logoutAction() {
        unset($_SESSION['auth']);
        header("Location: /index");
        exit();
    }

    public function address_bookAction() {
        if (!$this->address_book_service->access_validate()) {
            header("Location: /index");
            exit();
        }
        if (isset($_GET['show'])) {
            $_SESSION['limit'] = (int)$_GET['show'];
        }
        $page = 1;
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
        }
        $limit = $_SESSION['limit'] ?? 2;
        $filter = null;

        $address_book_model = new addressModel();
        $form_values = $this->address_book_service->get_countries();
        $address_book_ids = $this->address_book_service->pagination($address_book_model, $page, $limit, $filter);
        if (empty($address_book_ids)) {
            $param = [
                ['/admin/address_book', ['country_list' => $form_values['country_list'],'address_book_all' => [], 'nav' => $address_book_ids['nav']]]
            ];
        } else {
            $ids = array_column($address_book_ids, 'id');
            $address_book_all = $address_book_model->get_all_by_ids($ids);
            $param = [
                ['/admin/address_book', ['country_list' => $form_values['country_list'],'address_book_all' => $address_book_all, 'nav' => $address_book_ids['nav']]]
            ];
        }

        $this->view->render($param);
    }

    public function deleteAction() {
        if (!$this->address_book_service->access_validate()) {
            header("Location: /index");
            exit();
        }
        if (!empty($_GET['id'])) {
            $address_book_model = new addressModel();
            $address_book_model->delete_by_id((int)$_GET['id']);
        }
        header("Location: /admin/address_book");
        exit();
    }

    public function editAction() {
        if (!$this->address_book_service->access_validate()) {
            header("Location: /index");
            exit();
        }
        if (empty($_GET['id'])) {
            header("Location: /admin/address_book");
            exit();
        }

        $form_values = $this->address_book_service->edit((int)$_GET['id']);
        $form_values['title'] = 'Edit Record';
        $param = [
            ['/admin/address_book_form', $form_values]
        ];
        $this->view->render($param);
    }

    public function addAction() {
        if (!$this->address_book_service->access_validate()) {
            header("Location: /index");
            exit();
        }
        $form_values = $this->address_book_service->get_countries();
        $form_values['title'] = 'Add New Record';
        $param = [
            ['/admin/address_book_form', $form_values]
        ];
        $this->view->render($param);
    }

    public function get_citiesAction() {
        $cities_list['list'] = $this->address_book_service->get_cities((int)$_POST['city_id']);
        echo json_encode($cities_list);
    }

    public function saveAction() {
        $address_book_model = new addressModel();
        $thumb_filename = $this->address_book_service->file_upload();

        if (empty($_POST['row_id'])) {
            $address_book_model->insert($_POST, $thumb_filename);
        } else {
            if (empty($thumb_filename)) {
                $row = $address_book_model->get_by_id((int)$_POST['row_id']);
                $thumb_filename = $row['photo_url'];
            }
            $address_book_model->update($_POST, $thumb_filename);
        }
        header("Location: /admin/address_book");
        exit();
    }

    public function searchAction() {
        $address_book_model = new addressModel();
        $result = $address_book_model->find($_POST['search_word'], $_POST['country'], $_POST['city']);
        $form_values = $this->address_book_service->get_countries();
        if(empty($result)) {
            $param = [
                ['/admin/address_book', ['country_list' => $form_values['country_list'],'address_book_all' => []]]
            ];
        } else {
            $ids = array_column($result, 'id');
            $address_book_all = $address_book_model->get_all_by_ids($ids);
            $param = [
                ['/admin/address_book', ['country_list' => $form_values['country_list'],'address_book_all' => $address_book_all]]
            ];
        }
        $this->view->render($param);
    }
}