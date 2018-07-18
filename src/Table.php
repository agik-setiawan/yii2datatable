<?php
namespace agik\yii2datatable;
use Yii;
use yii\db\Query;
/**
* 
*/
class Table
{

/**
* Datatables
*/
/**
* Datatables
*/
public function getTable($model){
	$mdl=$model['model'];
	$request=$_REQUEST;
	$columns=$request['columns'];
	$columnsNameSelect="";
	$columnsNameSelectArray=[];
	$columnsNameSelectArray2=[];
	foreach ($columns as $key => $value) {
		$data=$value['data'];
		$data=preg_replace('/[0-9]+/','', $data);
		$columnsNameSelect=$columnsNameSelect.$data.",";
		if($data){
			array_push($columnsNameSelectArray, $data);
			array_push($columnsNameSelectArray2, [$key=>$data]);
		}
	}
	//return $columnsNameSelect;
	$columnsNameSelect=rtrim($columnsNameSelect,",");
	if($columnsNameSelect[0]==','){
		$columnsNameSelect=ltrim($columnsNameSelect,", ");
	}

	$totalData=$mdl->count();
	$totalFiltered=$totalData;
	if( !empty($request['search']['value']) ) {
		$sql="";
		foreach ($columnsNameSelectArray as $key => $value) {
			$and='';
			if($key==0){
				$and='';
			}else{
				$and='OR';
			}
			$sql.=" $and $value LIKE '".$request['search']['value']."%' "; 
		}
		$mdl->andWhere($sql);
	}
	$totalFiltered=$mdl->count();
	// $totalFiltered=count($mdl->all());

	$numCol=$request['order'][0]['column'];
	if($numCol>1){
		$numCol=$numCol-1;
	}
	$order=$columnsNameSelectArray[$numCol];
	$type_order=$request['order'][0]['dir'];

	if($type_order=='asc'){
		$type_order=SORT_ASC;
	}elseif($type_order=='desc'){
		$type_order=SORT_DESC;
	}
	$mdl->orderBy([$order=>$type_order]);
	$mdl->limit($request['length']);
	$mdl->offset($request['start']);
	$datas["draw"]=intval( $request['draw'] );
	$datas["recordsTotal"]=intval( $totalData );
	$datas["recordsFiltered"]=intval( $totalFiltered );
	$datas["data"]=$mdl->asArray()->all();
	return $datas;
}

}
?>