#Datatables with ActiveRecord Yii2


<br />

<br data-effect="nomal"/>

##On Controller or Model
```php:
use app\models\LevelAccess; 
use agik\yii2datatable\Table;
```

```php:
$dt=new Table(LevelAccess::find());
//if using join
$dt->model->joinWith('menu');
//if using join
$dt->model->joinWith('levelUser');
 return $dt->getRow();
```

##On your JS File
```js:
var tb=$('#table').dataTable({
				"ajax": {
          "url": "http://",
          'type':'get'
        },
        "serverSide":true/false,
        columns:[
{"data":"table_name.column_name"}
        ]
    });
```
