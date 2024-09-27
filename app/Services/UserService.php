<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{


    public static function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $usuario = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('123')
            ]);

            DB::commit();
            return $usuario;
        } catch (\Throwable $th) {
            DB::rollBack();
            LogErroService::registrar([
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            throw new Exception("Erro ao Salvar");

        }
    }

    public static function update(User $usuario, Request $request)
    {
        try {
            $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return $usuario;
        } catch (\Throwable $th) {
            LogErroService::registrar([
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            throw new Exception("Erro ao Atualizar");

        }
    }

    public static function resetarSenha(User $usuario)
    {
        try {
            $usuario->update([
                'password' => Hash::make('123')
            ]);
        } catch (\Throwable $th) {
            LogErroService::registrar([
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            throw new Exception("Erro ao resetar senha");

        }
    }

    public static function queryUser(User $usuario, string $relacionamento) : array
    {
        foreach ($usuario->$relacionamento as $relacao) {
            $administrando[] = $relacao->id;
        }
        return $administrando;
    }

    public static function checkUser(array $request) : array
    {
        $usuario = User::where('email', $request['email'])
            ->when($request['isNovo'] == "true", function($sql) use ($request) {
                return $sql->where('id', '!=', $request['idUsuario']);
            })
            ->get()
            ->isNotEmpty();
            if ($usuario) {
                return [
                    'status' => false,
                    'msg' => 'E-mail em uso por outra UMP'
                ];
            }
            return [
                'status' => true,
                'msg' => 'E-mail disponível'
            ];
    }


}
