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
use TestPax\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    use UtilTrait;
    /**
     * @var UserService
     */
    private $service;

    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
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
    public function index(Request $request)
    {
        $filter = $request->get('where') != '' ? $request->all() : '';
        return $this->service->getUsers($filter);
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
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'role' => 'required'
        ], [
            'name.required' => 'Nome do usuário é obrigatório',
            'name.length' => 'Nome deve conter no minimo 4 caracteres',
            'email.email' => 'Email precisa ser um endereço válido',
            'email.unique' => 'Email já está em uso no sistema',
            'role.required' => 'Tipo de usuário é obrigatório'
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
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success', 'title' => 'Sucesso','user' => $result['user']], 201);
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
    public function updatePassword($id, Request $request)
    {
        $validator = Validator($request->all(),
            [
                'password' => 'required|min:6',
                'password_repeat' => 'required|same:password'
            ],
            [
                'password.required' => 'Senha é obritaoria',
                'password.length' => 'Tamanho da senha invádio',
                'password_repeat.same' => 'Campo confirmar senha diferente de senha',
                'password_repeat.required' => 'Campo confirmar senha é obritaorio'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result = $this->service->updatePassword($id, $request->get('password'));

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'ALteração de Senha realizada com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @return mixed
     */
    public function authenticated()
    {
        $user = Auth::guard()->user();
        return $this->service->authenticated($user->id);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id, Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|min:4',
            'role' => 'required'
        ], [
            'name.required' => 'Nome do usuário é obrigatório',
            'name.length' => 'Nome deve conter no minimo 4 caracteres',
            'role.required' => 'Nível de usuário é obrigatório'
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
            return response()->json(['message' => 'Usuario atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($id) {
        $result = $this->service->delete($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Usuario excluido com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
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
