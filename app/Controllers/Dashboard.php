<?php

namespace App\Controllers;

use App\Models\CustomersModel;

class Dashboard extends BaseController
{
    protected $customersModel;

    public function __construct()
    {
        $this->customersModel = new CustomersModel();
    }

    public function index(): string
    {
        $customers = $this->customersModel->getAllCustomers();

        if ($customers === false) {
            $data['error'] = 'Erro ao obter a lista de clientes.';
        } else {
            $data['customers'] = $customers;
        }

        return view('Customers/List', $data);
    }

    public function createCustomer()
    {
        return null;
    }
}
