<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BaseHelper;
use Carbon\Carbon;

use BaseApi, View;
class EmployeeController extends Controller
{
    protected $view = 'employee.';
    public $limit = 10;
    public $offset = 0;

    public function index(Request $req){
        $api = new BaseApi();

        $params = array();

        if ($req->input('name')) {
            $params['name'] = $req->input('name');
        }

        if ($req->input('page')) {
            $params['offset'] = $req->input('page') - 1;
            $params['page'] = $req->input('page');
        } else {
            $params['offset'] = $this->offset;
            $params['page'] = $this->offset + 1;
        }

        $params['limit'] = $this->limit;

        if ($req->input('offset')) {
            $params['offset'] = $req->input('offset');
        }

        $response = $api->post('employee/list', [
            'form_params' => $params
        ]);

        $employees      = json_decode($response->getBody())->data;
        $pagination     = BaseHelper::pagination(($employees->offset + 1), $employees->total_page);
        $pages          = $pagination;
        $params         = $params;
        $page_number    = $employees->total_page;
        $page_item      = $employees->total_number;

        View::share('title', 'Employee Database');

        return view($this->view . 'index', compact('employees', 'pages', 'page_number', 'page_item', 'params'));
    }

    public function create() {
        View::share('title', 'Create Employee'); 
        $api = new BaseApi();

        $resCompany = $api->get('company', [
            'query' => []
        ]);

        $resDepartement = $api->get('departement', [
            'query' => []
        ]);

        $resStatuses = $api->get('employee/status', [
            'query' => []
        ]);

        $companys       = json_decode($resCompany->getBody())->data;
        $departements   = json_decode($resDepartement->getBody())->data;
        $statuses       = json_decode($resStatuses->getBody())->data;

        return view($this->view . 'create', compact('companys', 'departements', 'statuses'));

    }

    public function store(Request $req) {
        $api = new BaseApi();

        $param = array(
            "company_id" => $req->input('company_id'),
            "departement_id" => $req->input('departement_id'),
            "name" => $req->input('name'),
            "nik" => $req->input('nik'),
            "join_date" => $req->input('join_date'),
            "date_of_birth" => $req->input('date_of_birth'),
            "status" => $req->input('status')
        );

        $response = $api->post('employee', [
            'form_params' => $param
        ]);

        $rst = json_decode($response->getBody());

        if ($rst->status == true) {
            return redirect()->route('employee.index')->with('success', $rst->message);
        }else{
            $message = '';
            foreach ($rst->message as $value) {
                $message = $value;
            }
            return back()->with('error', $message[0]);
        }
    }

    public function show($id) {
        $api = new BaseApi();

        $response = $api->get('employee/' . $id, [
            'query' => []
        ]);

        $employee = json_decode($response->getBody())->data;
        $service_year = Carbon::now()->diff($employee->join_date);

        $rst = array(
            'id'            => $employee->id,
            'name'          => $employee->name,
            'nik'           => $employee->nik,
            'join_date'     => $employee->join_date,
            'status'        => $employee->status,
            'company'       => $employee->company->name,
            'departement'   => $employee->departement->name,
            'service_year'  => $service_year->y . 'yrs  ' . $service_year->m . 'mths',
            'age'           => Carbon::parse($employee->date_of_birth)->age
        );

        return json_encode($rst);
    }

    public function edit($id) {
        View::share('title', 'Edit Employee'); 
        $api = new BaseApi();

        $resCompany = $api->get('company', [
            'query' => []
        ]);

        $resDepartement = $api->get('departement', [
            'query' => []
        ]);

        $resStatuses = $api->get('employee/status', [
            'query' => []
        ]);

        $resEmployee = $api->get('employee/' . $id, [
            'query' => []
        ]);

        $companys       = json_decode($resCompany->getBody())->data;
        $departements   = json_decode($resDepartement->getBody())->data;
        $statuses       = json_decode($resStatuses->getBody())->data;
        $employee       = json_decode($resEmployee->getBody())->data;

        return view($this->view . 'edit', compact('id', 'companys', 'departements', 'statuses', 'employee'));
    }

    public function update(Request $req, $id) {
        $api = new BaseApi();

        $param = array(
            "company_id"        => $req->input('company_id'),
            "departement_id"    => $req->input('departement_id'),
            "name"              => $req->input('name'),
            "nik"               => $req->input('nik'),
            "join_date"         => $req->input('join_date'),
            "date_of_birth"     => $req->input('date_of_birth'),
            "status"            => $req->input('status')
        );

        $response = $api->put('employee/' . $id, [
            'form_params' => $param
        ]);

        $rst = json_decode($response->getBody());

        if ($rst->status == true) {
            return redirect()->route('employee.index')->with('success', $rst->message);
        }else{
            $message = '';
            foreach ($rst->message as $value) {
                $message = $value;
            }
            return back()->with('error', $message[0]);
        }
    }
}
