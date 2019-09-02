<?php 
namespace App\Http\Repositories;

use App\User;


/**
 * 
 */
class UserRepository extends RepositoryEloquent
{
	public function getModel()
	{
		return User::class;
	}
}


?>