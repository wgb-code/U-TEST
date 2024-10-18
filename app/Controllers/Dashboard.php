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

    public function index($id = null)
    {
        $page  = $this->request->getVar('page') ?: 1;
        $limit = 10;

        if ($id) {
            $getCustomer = $this->customersModel->getCustomerById($id);

            if ($getCustomer) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'data' => $getCustomer
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Cliente não encontrado.'
                ]);
            }

        } else {

            $getCustomers = $this->customersModel->getAllCustomers($page, $limit);
            $totalCustomers = $this->customersModel->countAllCustomers();

            $data = [];

            if ($getCustomers) {
                foreach ($getCustomers as $cs) {
                    $data[] = [
                        'id'        => $cs->id,
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
                'totalPages'  => $totalPages ?? 1
            ]);
        }
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
                'message' => 'Não foi possível cadastrar o cliente.',
            ]);
        }
    }

    public function editCustomer()
    {
        $id            = $this->request->getPost('idCustomer');
        $name          = $this->request->getPost('nameCustomer');
        $email         = $this->request->getPost('emailCustomer');
        $status        = $this->request->getPost('statusCustomer');
        $admissionDate = $this->request->getPost('createCustomer');

        if ((empty($name)) || (empty($email)) || (empty($status)) || (empty($admissionDate))) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Por favor, preencha todos os campos.'
            ]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Por favor, forneça um e-mail válido.'
            ]);
        }

        $checkDate = $this->dashboardHelper->checkDateIsValid($admissionDate);

        if (!$checkDate) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Por favor, insira uma data entre 01-01-204 e 16-10-2024'
            ]);
        }

        $customerInfos = [
            'name'           => $name,
            'email'          => $email,
            'status'         => $status,
            'admission_date' => $admissionDate
        ];

        $updateCustomer = $this->customersModel->editCustomer($id ,$customerInfos);

        if ($updateCustomer > 0) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Cliente atualizado com sucesso.',
                'data'    => [
                    'id'             => $id,
                    'name'           => $name,
                    'email'          => $email,
                    'status'         => $status,
                    'admission_date' => $admissionDate
                ]
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Não foi possível atualizar o cliente, tente novamente.',
            ]);
        }
    }

    public function deleteCustomer()
    {
        $id = $this->request->getPost('idCustomer');

        if (empty($id)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Não foi possível desativar o cliente.'
            ]);
        } else {
            $deleteCustomer = $this->customersModel->deleteCustomer($id);

            if ($deleteCustomer > 0) {
                return $this->response->setJSON([
                    'status'  => 'success',
                    'message' => 'Cliente atualizado com sucesso.'
                ]);

            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Não foi possível desativar o cliente.',
                ]);
            }

        }
    }
}
