<?php


namespace TestPax\Services;


use Illuminate\Support\Facades\DB;
use TestPax\Repositories\ProductRepository;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update(array $data,$id): array {
        DB::beginTransaction();
        try {
            $result = $this->repository->update($data, $id);
            DB::commit();
            return ['status' => 'success', 'product' => $result];
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    public function create(array $data): array {
        DB::beginTransaction();
        try {
            $result = $this->repository->create($data);
            DB::commit();
            return ['status' => 'success', 'product' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    public function getProducts() {
        return $this->repository->skipPresenter(false)->all();
    }

    public function delete($id): array
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->delete($id);
            DB::commit();
            return ['status' => 'success', 'product' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }
}
