private function GetPage($row = 10,$page=0){
		$page = !empty($page)?$page:I('page',0);
    	$limit = ((($page?$page:1) - 1)*$row).",{$row}";
    	return $limit;
	}