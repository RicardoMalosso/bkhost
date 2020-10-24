<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Register
 * @package Source\Models
 */
class Register extends Model
{
    /**
     * Register constructor.
     */
    public function  __construct()
    {
        parent::__construct("registers", ["id"], ["user_id", "register_name", "creation", "expiration"]);
    }

    /**
     * @param string $register_name
     * @param string $columns
     * @return Register|null
     */
    public function findByRegister(string $register_name, string $columns = "*"): ?Register
    {
        $find = $this->find("register_name = :register_name", "register_name={$register_name}", $columns);
        return $find->fetch();
    }


    /**
     * @param string $id
     * @param string $columns
     * @return Register|null
     */
    public function findByRegisterId(string $id, string $columns = "*"): ?Register
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        
        return $find->fetch();
    }

    /**
     * @return null|User
     */
    public function user(): ?User
    {
        if ($this->user) {
            return (new User())->findById($this->user);
        }
        return null;
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }


    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Nome do domínio, data de criação e data de expiração são obrigatórios");
            return false;
        }


        /** Update */
        if (!empty($this->id)) {
            $id = $this->id;
            $this->update($this->safe(), "id = :id", "id={$id}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }
        /** Register Create */
        if (empty($this->id)) {
            if ($this->findByRegister($this->register_name, "id")) {
                $this->message->warning("O dominio informado já está cadastrado");
                return false;
            }

            $id = $this->create($this->safe());
            if ($this->fail()) {
                
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($id))->data();
        return true;
    }

}
