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
                $cs->admission_date = $this->dashboardHelper->formatDatePTBR($cs->admission_date);
                $cs->created_at = $this->dashboardHelper->formatDatePTBR($cs->created_at);
                $cs->updated_at = $this->dashboardHelper->formatDatePTBR($cs->updated_at);

                $data[] = $cs;
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
        return null;
    }
}
