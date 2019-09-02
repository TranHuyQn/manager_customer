<?php
namespace App\Http\Services\ServiceInterface;

interface ServiceInterface
{
	public function index();

	public function store(Request $request);

	public function edit($id);

	public function update(Request $request, $id);

	public function destroy($id);
}


?>