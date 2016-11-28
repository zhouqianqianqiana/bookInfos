<?php 
	header("Content-type:text/html;charset=utf-8");
	// 增加图书信息
	$type = $_POST["type"];
	if($type == "addBook"){
		$flag = true;
		$bname = $_POST["bname"];
		$bauthor = $_POST["bauthor"];
		$bprice = floatval($_POST["bprice"]);
		$key = intval($_POST["key"]);
		$array = array("key"=>$key,"bname"=>$bname,"bauthor"=>$bauthor,"bprice"=>$bprice);
		$json = file_get_contents("../api/bookInfo.json");
		$arr_json = json_decode($json,true);
		array_push($arr_json,$array);
		$json = json_encode($arr_json);
		$str= preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $json);
		file_put_contents("../api/bookInfo.json",$str);
		echo "ok";
	}
	//删除
	if($type == "deleteInfo"){
		$index = $_POST["key"];
		$json = file_get_contents("../api/bookInfo.json");
		$arr_json = json_decode($json,true);
		for($i = 0;$i<count($arr_json);$i++){
			if($arr_json[$i]["key"] == $index){
				array_splice($arr_json,$i,1);
			}
		}
		$json_encode = json_encode($arr_json);
		$str= preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $json_encode);
		file_put_contents("../api/bookInfo.json",$str);
		echo "success";
	}
	// 修改
	if($type == "updateBook"){
		$bname = $_POST["bname"];
		$bauthor = $_POST["bauthor"];
		$bprice = floatval($_POST["bprice"]);
		$key = intval($_POST["key"]);
		$json = file_get_contents("../api/bookInfo.json");
		$arr_json = json_decode($json,true);
		for($i = 0;$i<count($arr_json);$i++){
			if($arr_json[$i]["key"] == $key){
				$arr_json[$i]["bname"] = $bname;
				$arr_json[$i]["bauthor"] = $bauthor;
				$arr_json[$i]["bprice"] = $bprice;
			}
		}
		$json_encode = json_encode($arr_json);
		$str= preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $json_encode);
		file_put_contents("../api/bookInfo.json",$str);
		echo "success";
	}
 ?>