<?php
class IndexController extends Controller {
	function index() {
		$list = $this->Mode->queryList();
		$this->set('list',$list);
	}
}
