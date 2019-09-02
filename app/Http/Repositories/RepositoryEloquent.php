<?php 
namespace App\Http\Repositories;
/**
 * 
 */
abstract class RepositoryEloquent
{
	protected $model;

	public function __construct()
	{
		$this->setModel();
	}

	public function setModel()
	{
		$this->model = app()->make($this->getModel());
	}

	abstract public function getModel();
	
	public function index()
	{
		return $this->model->paginate(5);
	}

	public function save($obj)
	{
		$obj->save();
	}

	public function findById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function destroy($obj)
	{
		$obj->delete();
	}
}
?>