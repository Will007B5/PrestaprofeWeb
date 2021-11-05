<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Retorna todos los usuarios
     * @return collection $user
     */
    public function getAll()
    {
        return $this->user::all();
    }

    /**
     * Retorna un usuario
     * @param $user
     * @return $user
     */
    public function getOne($user)
    {
        return $user;
    }

    /**
     * Agrega y retorna un usuario
     * @param Array $user
     * @return User
     */
    public function create($user)
    {
        $returnedUser = $this->user::create($user);
        $returnedUser->assignRole($user['role']);
        $returnedUser->save();
        return $returnedUser;
    }

    /**
     * Actualiza y retorna un usuario
     * @param Array $data
     * @param User $user
     * @return bool
     */
    public function update($data, $user)
    {
        $returnedUser = $user->update($data);
        if(count($data) > 0){
            $returnedUser = $user->syncRoles($data['role']);
            $returnedUser->save();
        }
        return $returnedUser;
    }

    /**
     * Elimina y retorna un usuario
     * @param User $user
     * @return User $user
     */
    public function delete($user)
    {
        return $user->delete();
    }
}
