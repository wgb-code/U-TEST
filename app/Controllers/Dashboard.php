<?php

namespace App\Controllers;

use App\Helpers\DashboardHelper;
use App\Models\CustomersModel;

class Dashboard extends BaseController
{
    protected $customersModel;

    public function __construct()
    {
        $this->customersModel = new CustomersModel();
        $this->dashboardHelper = new DashboardHelper();
    }

    public function index(): string
    {
        $page  = $this->request->getVar('page') ?: 1;
        $limit = 10;

        $getCustomers   = $this->customersModel->getAllCustomers($page, $limit);
        $totalCustomers = $this->customersModel->countAllCustomers();

        $data = [];

        if ($getCustomers) {

            foreach ($getCustomers as $cs) {
                $data[] = [
                    'name'      => $cs->name,
                    'email'     => $cs->email,
                    'status'    => $this->dashboardHelper->convertTypeToString($cs->status),
                    'admission' => $this->dashboardHelper->formatDatePTBR($cs->admission_date),
                    'created'   => $this->dashboardHelper->formatDatePTBR($cs->created_at),
                    'updated'   => $this->dashboardHelper->formatDatePTBR($cs->updated_at),
                ];
            }
        }

        $totalPages = ceil($totalCustomers / $limit);

        return view('Customers/List', [
            'customers'   => $data,
            'currentPage' => $page,
            'totalPages'  => $totalPages
        ]);
    }

    public function createCustomer()
    {
        $name          = $this->request->getPost('nameCustomer');
        $email         = $this->request->getPost('emailCustomer');
        $admissionDate = $this->request->getPost('createCustomer');


        if ((empty($name)) || (empty($email)) || (empty($admissionDate))) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Por favor, preencha todos os campos.',
            ]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Por favor, forneça um e-mail válido.',
            ]);
        }

        $checkDate = $this->dashboardHelper->checkDateIsValid($admissionDate);

        if (!$checkDate) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Por favor, insira uma data entre 01-01-204 e 16-10-2024',
            ]);
        }

        $customerInfos = [
            'name'           => $name,
            'email'          => $email,
            'admission_date' => $admissionDate,
            'status'         => 'C'
        ];

        $newCustomerId = $this->customersModel->postNewCustomer($customerInfos);

        if ($newCustomerId) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Cliente cadastrado com sucesso.',
                'data'    => [
                    'id'   => $newCustomerId,
                    'name' => $name,
                    'email' => $email
                ]
            ]);

        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Erro ao cadastrar o cliente. Por favor, tente novamente.',
            ]);
        }
    }
}
