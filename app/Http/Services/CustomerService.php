<?php 
namespace App\Http\Services;

use App\Customer;
use App\Http\Repositories\CustomerRepository;
use App\Http\Services\ServiceInterface\CustomerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * 
 */
class CustomerService
{
	public $customerRepository;

	public function __construct(CustomerRepository $customerRepository)
	{
		$this->customerRepository = $customerRepository;
	}

	public function index()
	{
		return $this->customerRepository->index();
	}

	public function store(Request $request)
	{
		$customer = new Customer();
    	$customer->name = $request->name;
    	$customer->email = $request->email;
    	$customer->dob = $request->dob;
    	$customer->city_id  = $request->city_id;
    	$this->customerRepository->save($customer);
    	Session::flash('success', 'Tạo mới khách hàng thành công');
	}

	public function edit($id)
	{
		return $this->customerRepository->findById($id);
	}

	public function update(Request $request, $id)
	{
		$customer = $this->customerRepository->findById($id);
    	$customer->name = $request->name;
    	$customer->email = $request->email;
    	$customer->dob = $request->dob;
    	$customer->city_id  = $request->city_id;
    	$this->customerRepository->save($customer);
    	session::flash('success', 'Cập nhật khách hàng thành công');
	}

	public function destroy($id)
	{
		$customer = $this->customerRepository->findById($id);
		$this->customerRepository->destroy($customer);
		Session::flash('success', 'xóa khách hàng thành công');
	}

	public function getCities()
	{
		return $this->customerRepository->getCities();
	}

	public function cityFilter(Request $request, $idCity)
	{
		$idCity = $request->city_id;
		return $this->customerRepository->cityFilter($idCity);
	}

	public function getCustomersWhere($cityFilter)
	{
		return $this->customerRepository->getCustomerWhere($cityFilter);
	}

	public function totalCustomerFilter($cityFilter)
	{
		$customers = $this->getCustomerWhere($cityFilter);
		return count($customers);
	}

	public function getAllCity()
	{
		return $this->customerRepository->getAllCity();
	}
}

?>