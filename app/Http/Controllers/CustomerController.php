<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\Http\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use http\Env\Response;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
    	$customers = $this->customerService->index();
        $cities = $this->customerService->getCities();
        return view('customers.list', compact('customers', 'cities'));
    }

    public function create()
    {
        $cities = $this->customerService->getCities();
        return view('customers.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $this->customerService->store($request);
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = $this->customerService->edit($id);
        $cities = $this->customerService->getCities();
        return view('customers.edit', compact('customer', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $this->customerService->update($request, $id);
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
    	$this->customerService->destroy($id);
    	return redirect()->route('customers.index');
    }

    public function filterByCity(Request $request)
    {
        $cityFilter = $this->customerService->cityFilter();
        $customers = $this->customersService->getCustomerWhere($cityFilter);
        $totalCustomerFilter = $this->customerService->totalCustomerFilter($cityFilter);
        $cities = $this->customerService->getAllCity();

        return view('customers.list', compact('customers', 'cities', 'totalCustomerFilter', 'cityFilter'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if (!$keyword) {
            return redirect()->route('customers.index');
        }
        $customers = Customer::where('name', 'LIKE', '%' . $keyword . '%')->paginate(5);
        $cities = City::all();
        return view('customers.list', compact('customers', 'cities'));
    }
}