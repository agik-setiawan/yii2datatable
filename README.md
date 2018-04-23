**EXAMPLE**
use app\models\Users; 
use YiiDatatables\DataTablesModel;

public function getUsers(){
 $dt=new DataTablesModel; 
 $mdl=Users::find(); $mdl->where('1=1'); 
 return $dt->getTable(['model'=>$mdl]); 
 }
