<?php

/**
 * indexController
 *
 * @author DartVadius
 */
class indexController extends baseController {

    private $address_book_service;

    public function __construct() {
        $this->address_book_service = new address_bookService();
        parent::__construct();
    }

    public function indexAction() {
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
                ['/index/address_book', ['country_list' => $form_values['country_list'],'address_book_all' => [], 'nav' => $address_book_ids['nav']]]
            ];
        } else {
            $ids = array_column($address_book_ids, 'id');
            $address_book_all = $address_book_model->get_all_by_ids($ids);
//        print_r($address_book_all);
//        die;
            $param = [
                ['/index/address_book', ['country_list' => $form_values['country_list'],'address_book_all' => $address_book_all, 'nav' => $address_book_ids['nav']]]
            ];
        }

        $this->view->render($param);
    }

    public function searchAction() {
        $address_book_model = new addressModel();
        $result = $address_book_model->find($_POST['search_word'], $_POST['country'], $_POST['city']);
        $form_values = $this->address_book_service->get_countries();
        if(empty($result)) {
            $param = [
                ['/index/address_book', ['country_list' => $form_values['country_list'],'address_book_all' => []]]
            ];
        } else {
            $ids = array_column($result, 'id');
            $address_book_all = $address_book_model->get_all_by_ids($ids);
            $param = [
                ['/index/address_book', ['country_list' => $form_values['country_list'],'address_book_all' => $address_book_all]]
            ];
        }

        $this->view->render($param);
    }

    public function viewAction() {
        $address_book_model = new addressModel();
        $row = $address_book_model->get_all_by_ids([(int)$_GET['id']]);
        if (empty($row)) {
            header("Location: /index");
            exit();
        }
        $param = [
            ['/index/view', ['row' => $row[0]]]
        ];
        $this->view->render($param);
    }

}
