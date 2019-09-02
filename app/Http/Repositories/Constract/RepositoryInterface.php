<?php
namespace App\Http\Repositories\Contract;

interface RepositoryInterface
{
	public function setModel();

	public function getModel();
	
	public function index();

	public function save($obj);

	public function findById($id);

	public function destroy($obj);
}

?>