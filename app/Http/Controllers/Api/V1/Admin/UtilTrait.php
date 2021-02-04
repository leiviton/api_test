<?php


namespace TestPax\Http\Controllers\Api\V1\Admin;


use Faker\Provider\ka_GE\DateTime;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Comtele\Services\TextMessageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait UtilTrait
{
    /**
     * @param $image
     * @param string $folder
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteFile($image, $folder = 'users')
    {
        if ($image != 'default.png' && $image != 'logo-default.jpg') {
            Storage::disk('public')->delete($folder.'/'.$image);
            return response(['message' => 'delete file','type' => 'success']);
        } else {
            return response(['message' => 'delete error', 'type' => 'error']);
        }
    }

    /**
     * @param Request $request
     * @param string $folder
     * @return bool|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function upload(Request $request, $folder = 'users')
    {
        $nameFile = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = uniqid(date('HisYmd'));
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->image->storeAs($folder, $nameFile, 'public');

            if (!$upload) {
                dd('caio no false');
            } else {
                return response(['file' => $nameFile]);
            }
        } else if ($request->get('image') == null || $request->get('image') == '') {
            return response(['file' => 'default.png']);
        } else {
            return false;
        }
    }

    /**
     * @param $cnpj
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCnpj($cnpj)
    {
        $client = new Client();
        $url = "http://receitaws.com.br/v1/cnpj/$cnpj";
        return $client->get($url);
    }

    /**
     * @param $cep
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCep($cep)
    {
        $client = new Client();
        $url = "https://viacep.com.br/ws/$cep/json/";
        return $client->get($url);
    }

    /**
     * @param $valor
     * @return mixed|string
     */
    public function limpaCPF_CNPJ($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }


    /**
     * @param null $ano
     * @return array
     */
    public function diasFeriados($ano = null)
    {
        if ($ano === null)
        {
            $ano = intval(date('Y'));
        }

        $pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
        $dia_pascoa = date('j', $pascoa);
        $mes_pascoa = date('n', $pascoa);
        $ano_pascoa = date('Y', $pascoa);

        $feriados = array(
            // Datas Fixas dos feriados Nacionail Basileiras
            date('d/m/Y',mktime(0, 0, 0, 1,  1,   $ano)), // Confraternização Universal - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 4,  21,  $ano)), // Tiradentes - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 5,  1,   $ano)), // Dia do Trabalhador - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 9,  7,   $ano)), // Dia da Independência - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 10,  12, $ano)), // N. S. Aparecida - Lei nº 6802, de 30/06/80
            date('d/m/Y',mktime(0, 0, 0, 11,  2,  $ano)), // Todos os santos - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 11, 15,  $ano)), // Proclamação da republica - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 12, 25,  $ano)), // Natal - Lei nº 662, de 06/04/49

            // These days have a date depending on easter
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa)),//2ºferia Carnaval
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa)),//3ºferia Carnaval
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa)),//6ºfeira Santa
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa)),//Pascoa
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa)),//Corpus Cirist
        );

        sort($feriados);

        return $feriados;
    }

    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function invertDate($date)
    {
        if (count(explode("/", $date)) > 1) {
            $result = implode("-", array_reverse(explode("/", $date)));
            return $result;
        } else if (count(explode("-", $date)) > 1) {
            $result = implode("/", array_reverse(explode("-", $date)));
            return $result;
        } else {
            return null;
        }
    }
}
