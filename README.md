###Example
###On Controller or Model
use app\models\Users; 
use agik\yii2datatable\Table;

public function getUsers(){
$dt=new Table; 
$mdl=Users::find();
$mdl->where('1=1');
return $dt->getTable(['model'=>$mdl]); 
     }
