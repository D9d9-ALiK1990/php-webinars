<?php


namespace App\Data\Shop\Order;

use App\Db\Db;
use App\DI\Container;
use App\Exception\ClassNotExistException;
use App\Model\ModelAnalyzer;
use App\Utils\DocParser;

/**
 * Class OrderRepositiry
 * @package App\Data\Shop\Order
 *
 * @Model(App\Data\Shop\Order\Order\Model)
 */
class OrderRepository
{

    const FIND_BY_AND = 'and';
    const FIND_BY_OR = 'or';

    /**
     * @var ModelAnalyzer
     * @onInit(App\Model\ModelAnalyze)
     */
    protected $modelAnalizer;

    /**
     * @var DocParser
     * @onInit(App\Utils\DocParser)
     */
    protected $docParser;

    /**
     * @var Container
     * @onInit(App\DI\Container)
     */
    protected $di;


    public function find(int $id)
    {
        $modelClass = $this->docParser->getClassAnnotate($this, '@Model');

        if (!class_exists($modelClass)) {
            $message = 'Class ' . $modelClass . 'does not exist';
            throw new ClassNotExistException($message);
        }

        
        $model = $this->di->get($modelClass);

        dump($modelClass); exit;

        $query = "SELECT * FROM table WHERE id_column = $id";
        $order = Db::fetchRow($query);

        return $order;
    }

    public function findBy(array $condition)
    {

//        $condition = [
//            'field' => 'value'
//        ];
    }

    public function findAll()
    {

    }

    public function findAllBy(array $condition, int $offset = 0, int $limit = 100, string $findBy =  self::FIND_BY_AND)
    {

//        $condition = [
//            'field' => 'value'
//        ];
    }
}