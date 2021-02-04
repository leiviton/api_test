<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace TestPax\Http\Controllers\Api\V1\Admin;

use TestPax\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TestPax\Services\ProductService;

class ProductsController extends Controller
{

    /**
     * @var ProductService
     */
    private $service;

    /**
     * UserController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     *
     * @transformercollection \TestPax\Transformers\UserTransformer
     * @transformerModel \TestPax\Models\User
     */
    public function index()
    {
        return $this->service->getProducts();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     *
     * @bodyParam name string required. Example: Leiviton
     * @bodyParam email string required e email valido. Example: example@example.com
     * @bodyParam role nivel do usuário. Example: admin
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator($request->all(), [
            'name' => 'required|min:4'
        ], [
            'name.required' => 'Nome da produto é obrigatório',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $data = $request->all();

        $result = $this->service->create($data);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success', 'title' => 'Sucesso','product' => $result['product']], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }



    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator($request->all(), [
            'name' => 'required|min:4',
        ], [
            'name.required' => 'Nome da categoria é obrigatório',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result = $this->service->update($request->all(),$id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Produto atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $result = $this->service->delete($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Produto excluido com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->service->getId($id);
    }
}
