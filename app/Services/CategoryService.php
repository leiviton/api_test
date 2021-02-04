<?php


namespace TestPax\Services;


use Illuminate\Support\Facades\DB;
use TestPax\Repositories\CategoryRepository;

class CategoryService
{

    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository) {
        $this->repository = $repository;
    }

    public function update(array $data,$id): array {
        DB::beginTransaction();
        try {
            $result = $this->repository->update($data, $id);
            DB::commit();
            return ['status' => 'success', 'category' => $result];
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
            return ['status' => 'success', 'category' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    public function getCategories() {
        return $this->repository->all();
    }

    public function delete($id): array {
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
