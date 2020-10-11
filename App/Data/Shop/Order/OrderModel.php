<?php


namespace App\Data\Shop\Order;


use App\Data\User\UserModel;
use App\Model\AbstractModel;
use DateTime;

/**
 * Class OrderModel
 * @package App\Data\Shop\Order
 * @Model\Table("orders")
 */
class OrderModel extends AbstractModel
{
    /**
     * @var int
     * @Model\Id
     */
    protected $id = 0;

    /**
     * @var DateTime
     * @Model\TableField
     */
    protected $createdAt;

    /**
     * @var float
     * @Model\TableField
     */
    protected $totalSum = 0;

    /**
     * @var UserModel
     * @Model\TableField("user_id")
     */
    protected $user;


    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created;
    }

    /**
     * @return float
     */
    public function getTotalSum(): float
    {
        return $this->totalSum;
    }

    /**
     * @return UserModel
     */
    public function getUser(): UserModel
    {
        return $this->user;
    }

    /**
     * @return OrderItemModel[]
     */
    public function getProductData(): array
    {
        return $this->productData;
    }

    public function addItem(OrderItemModel $item)
    {

        $this->productData[] = $item;
        $this->totalSum += $item->getTotalSum();
    }

    /**
     * @param UserModel $user
     */
    public function setUser(UserModel $user)
    {
        $this->user = $user;
    }









}