<?php


namespace App\Repository\Eloquent;


use App\Product;
use App\Repository\Eloquent\Base\BaseRepository;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    /**
     * ProductRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Product $model)
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
    /**
     * @return Collection
     */
    public function getLimit(): Collection
    {
        return $this->model->limit(5)->get();
    }
}
