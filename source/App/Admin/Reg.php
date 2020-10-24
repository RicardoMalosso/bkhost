<?php

namespace Source\App\Admin;

use Source\Models\User;
use Source\Models\register as DomainModel;
use Source\Support\Pager;
use Source\Support\Thumb;


/**
 * Class register
 * @package Source\App\Admin
 */
class Reg extends Admin
{
    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array|null $data
     */
    public function home(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/registers/home/{$s}/1")]);
            return;
        }

        $search = null;
        $users = (new User())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $users = (new User())->find("MATCH(first_name, last_name, email) AGAINST(:s)", "s={$search}");
            if (!$users->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/registers/home");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/register/home/{$all}/"));
        $pager->pager($users->count(), 12, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Usuários",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/registers/home", [
            "app" => "registers/home",
            "head" => $head,
            "search" => $search,
            "users" => $users->order("first_name, last_name")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }


    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function domain(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $domainCreate = new register();
            $domainCreate->user_id = $data["user_id"];
            $domainCreate->register_name = $data["register_name"];
            $domainCreate->creation = $data["creation"];
            $domainCreate->expiration = $data["expiration"];
            $domainCreate->contact_admin = $data["contact_admin"];
            $domainCreate->contact_technical = $data["contact_technical"];
            $domainCreate->contact_financial = $data["contact_financial"];
            $domainCreate->dns_1 = $data["dns_1"];
            $domainCreate->dns_2 = $data["dns_2"];
            $domainCreate->dns_3 = $data["dns_3"];
            $domainCreate->status = $data["status"];

//            //upload photo
//            if (!empty($_FILES["photo"])) {
//                $files = $_FILES["photo"];
//                $upload = new Upload();
//                $image = $upload->image($files, $domainCreate->fullName(), 600);
//
//                if (!$image) {
//                    $json["message"] = $upload->message()->render();
//                    echo json_encode($json);
//                    return;
//                }
//
//                $domainCreate->photo = $image;
//            }

            if (!$domainCreate->save()) {
                $json["message"] = $domainCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Domínio cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/admin/registers/register/{$domainCreate->id}");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $domainUpdate = (new DomainModel())->findById($data["domain_id"]);

            if (!$domainUpdate) {
                $this->message->error("Você tentou gerenciar um Domínio que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/registers/home")]);
                return;
            }

            $domainUpdate->user_id = $data["user_id"];
            $domainUpdate->number = $data["number"];
            $domainUpdate->register_name = $data["register_name"];
            $domainUpdate->creation = $data["creation"];
            $domainUpdate->expiration = $data["expiration"];
            $domainUpdate->contact_admin = $data["contact_admin"];
            $domainUpdate->contact_technical = $data["contact_technical"];
            $domainUpdate->contact_financial = $data["contact_financial"];
            $domainUpdate->dns_1 = $data["dns_1"];
            $domainUpdate->dns_2 = $data["dns_2"];
            $domainUpdate->dns_3 = $data["dns_3"];
            $domainUpdate->status = $data["status"];

//            //upload photo
//            if (!empty($_FILES["photo"])) {
//                if ($domainUpdate->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$domainUpdate->photo}")) {
//                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$domainUpdate->photo}");
//                    (new Thumb())->flush($domainUpdate->photo);
//                }
//
//                $files = $_FILES["photo"];
//                $upload = new Upload();
//                $image = $upload->image($files, $domainUpdate->fullName(), 600);
//
//                if (!$image) {
//                    $json["message"] = $upload->message()->render();
//                    echo json_encode($json);
//                    return;
//                }
//
//                $domainUpdate->photo = $image;
//            }

            if (!$domainUpdate->save()) {
                $json["message"] = $domainUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Dados do domínio atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $domainDelete = (new DomainModel())->findById($data["domain_id"]);

            if (!$domainDelete) {
                $this->message->error("Você tentou deletar um dominio que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/registers/home")]);
                return;
            }

            if ($domainDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$domainDelete->photo}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$domainDelete->photo}");
                (new Thumb())->flush($domainDelete->photo);
            }

            $domainDelete->destroy();

            $this->message->success("O domínio foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/registers/home")]);

            return;
        }

        $domainEdit = null;
        if (!empty($data["domain_id"])) {
            $domainId = filter_var($data["domain_id"], FILTER_VALIDATE_INT);
            $domainEdit = (new DomainModel())->findById($domainId);

            $userId = $domainEdit->user_id;

            $userEdit = (new User())->findById($userId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($domainEdit ? "Perfil de {$userEdit->fullName()}" : "Novo Usuário"),
            CONF_SITE_DESC,
            url("/admin"),
            url("/sb-admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/registers/register", [
            "app" => "registers/domain",
            "head" => $head,
            "domain" => $domainEdit
//            "user" => $userEdit
//            "data" => $data
        ]);
    }

    public function listarDominiosDeUmUsuario($data) :void
    {
        $idDeUmUsuario = $data['user_id'];
        //verifica se o id recebido é válido e se o usuário existe
        $idValidado = filter_var($idDeUmUsuario, FILTER_VALIDATE_INT);

        $usuarioExiste =  (new User())->findById($idValidado);


    $termos = "user_id = " . (String) $idDeUmUsuario;
            $userId = $usuarioExiste->user_id;
        $dominiosDoUser = null;
        //essa linha prepara a pesquisa por ID de todos os domínios de um usuário específico
        //então ela executa a pesquisa utilizando fetch, esse resultado é passado pra frente

            $dominiosDoUser =(new DomainModel())->find($termos)->fetch(true);

//            if ($usuarioexiste == null || $dominiosDoUser.sizeof() == 0){
//                            $this->message->info("Ocorreu um erro.")->flash();
//                            redirect("/admin/registers/home");
//            }
            //var_dump($dominiosDoUser);

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Domínios ",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

            echo $this->view->render("widgets/registers/registers", [
                "domain" => $dominiosDoUser,
                "user" => $usuarioExiste,
                "app" => "reg/listarDominiosDeUmUsuario",
                "head" => $head
            ]);
    }

    function criarDominio($data){
        if (!empty($data["action"]) && $data["action"] == "create"){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $domainCreate = new DomainModel();
            $domainCreate->register_name = $data["register_name"];
            $domainCreate->creation = $data["creation"];
            $domainCreate->expiration = $data["expiration"];
            $domainCreate->contact_admin = $data["contact_admin"];
            $domainCreate->contact_technical = $data["contact_technical"];
            $domainCreate->contact_financial = $data["contact_financial "];
            $domainCreate->dns_1 = $data["dns_1"];
            $domainCreate->dns_2 = $data["dns_2"];
            $domainCreate->dns_3 = $data["dns_3"];
            $domainCreate->status = $data["status"];
            $domainCreate->created_at = $data["created_at"];
            $domainCreate->updated_at = $data["updated_at"];



            if (!$domainCreate->save()){
                $json["message"] = $domainCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Usuário cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/admin/registers/listar/{$domainCreate->user_id}");

            echo json_encode($json);
            return;
        }
    }

    function apagarDominio($data)
    {
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userDelete = (new DomainModel())->findById($data["selected_domain"]);

            if (!$userDelete) {
                $this->message->error("Você tentou deletar um Domínio que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/registers/home")]);
                return;
            }

            if ($userDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}");
                (new Thumb())->flush($userDelete->photo);
            }

            $userDelete->destroy();

            $this->message->success("O Domínio foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/registers/home")]);

            return;
        }
    }

    function alterarDominio($data){
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $domainUpdate = (new DomainModel())->findById($data["selected_domain"]);

            if (!$domainUpdate) {
                $this->message->error("Você tentou gerenciar um domínio que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/registers/home")]);
                return;
            }

            $domainUpdate->register_name = $data["register_name"];
            $domainUpdate->creation = $data["creation"];
            $domainUpdate->expiration = $data["expiration"];
            $domainUpdate->contact_admin = $data["contact_admin"];
            $domainUpdate->contact_technical = $data["contact_technical"];
            $domainUpdate->contact_financial = $data["contact_financial "];
            $domainUpdate->dns_1 = $data["dns_1"];
            $domainUpdate->dns_2 = $data["dns_2"];
            $domainUpdate->dns_3 = $data["dns_3"];
            $domainUpdate->status = $data["status"];
            $domainUpdate->updated_at = $data["updated_at"];
            $domainUpdate->updated_at = $data["updated_at"];

            if (!$domainUpdate->save()) {
                $json["message"] = $domainUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Domínio atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }
    }
}