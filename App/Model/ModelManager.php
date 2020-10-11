<?php


namespace App\Model;


use App\Model\AbstractModel as Model;
use App\DI\Container;
use App\Model\Exeption\ManyModelIdFieldExeption;
use App\Utils\DocParser;
use App\Utils\ReflectionUtil;
use App\Utils\StringUtil;
use DateTime;
use App\Db\Db;
use App\Model\ModelAnalyzer;

class ModelManager
{

    /**
     * @var ReflectionUtil
     */
    private $reflectionUtil;

    /**
     * @var ModelAnalyzer
     */
    private $modelAnalyzer;

    public function __construct(ModelAnalyzer $modelAnalyzer, ReflectionUtil $reflectionUtil)
    {
        $this->reflectionUtil = $reflectionUtil;
        $this->modelAnalyzer = $modelAnalyzer;
    }

    public function save(Model $model)
    {
        $tableName = $this->modelAnalyzer->getTableName($model);
        $tableFields = $this->modelAnalyzer->getTableFields($model);
  //      dump($tableName); dump($tableFields);
        $tableData = [];

        foreach ($tableFields as $objectKey => $tableKey) {
            $objectValue = $model[$objectKey];
//dump($objectValue);
            $value = null;
            if (is_object($objectValue)) {
                if (method_exists($objectValue, 'getId')) {
                    $value = $objectValue->getId();
                    //dump($value);
                } else if ($objectValue instanceof DateTime) {
                    $value = $objectValue->format('Y-m-d H:i');
                    //dump($value);
                }
            } else if (is_array($objectValue)) {
                //dump($objectValue);
                $value = json_encode($objectValue);
                //dump($value);
            }
            else {
                    $value = $objectValue;
    //                dump($value);
            }

            if (!is_null($value)) {
                $tableData[$tableKey] = $value;
            }
        }

        $id = $model->getId();
        $modelIdInfo = $this->modelAnalyzer->getIdField($model);

        if (is_null($modelIdInfo)) {
            return false;
        }

        if ($id) {
            $id = Db::insert($tableName, $tableData);
            $this->reflectionUtil->setPrivateValue($model, $modelIdInfo['objectProperty'], $id);
        }
        else {
            Db::update($tableName, $tableData, $modelIdInfo['tableProperty'] . " = '$id");
        }

        return true;
    }



}