<?php

class tests
{

	public $requires_auth = TRUE;

	function index()
	{
		global $request;
		global $_user;
		$tests = get_all("SELECT * FROM test NATURAL JOIN user WHERE test.deleted=0");

		require 'views/master_view.php';
	}

	function remove(){
		global $request;
		$id=$request->params[0];
		$result=q("UPDATE test SET deleted=1 WHERE test_id='$id'");
		require 'views/master_view.php';
	}
}