<?php


namespace App\Repository\Eloquent;


use App\Order;
use App\Repository\Eloquent\Base\BaseRepository;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Support\Collection;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * ProductRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

}
