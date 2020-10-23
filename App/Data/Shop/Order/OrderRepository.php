<?php


namespace App\Data\Shop\Order;

use App\Db\Db;
use App\DI\Container;
use App\Exception\ClassNotExistException;
use App\Model\AbstractModel;
use App\Model\AbstractRepository;
use App\Model\Exeption\ClassNotAllowedException;
use App\Model\ModelAnalyzer;
use App\Utils\DocParser;

/**
 * Class OrderRepositiry
 * @package App\Data\Shop\Order
 *
 * @Model(App\Data\Shop\Order\OrderModel)
 */
class OrderRepository extends AbstractRepository
{

}