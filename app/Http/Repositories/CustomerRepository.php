<?php 
namespace App\Http\Repositories;
use App\City;
use App\Customer;
use App\Http\Repositories\Contract\CustomerInterface;

/**
 * 
 */
class CustomerRepository extends RepositoryEloquent
{
	public function getModel()
	{
		return Customer::class;
	}

	public function getCities()
	{
		return City::all();
	}

	public function cityFilter($idCity)
	{
		return City::findOrFail($idCity);
	}

	public function getCustomersWhere($cityFilter)
	{
		return Customer::where('city_id', $cityFilter->id)->get();
	}

	public function getAllCity()
	{
		return City::all();
	}
}
?>