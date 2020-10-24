<?php

namespace Source\App\Admin;

use Source\Models\Register as DomainModel;
use Source\Models\User;
use Source\Models\Register;
use Source\Support\Pager;
use Source\Support\Thumb;

/**
 * Class Register
 * @package Source\App\Admin
 */
class Registers extends Admin
{
    /**
     * Register constructor.
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
        $pager = new Pager(url("/admin/registers/home/{$all}/"));
        $pager->pager($users->count(), 12, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Registros",
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
    public function newRegister(?array $data): void
    {

        if (!empty($data["user_id"])) {
            $userId = filter_var($data["user_id"], FILTER_VALIDATE_INT);
            $user = (new User())->findById($userId);
        }
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Criando novo Registro",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/registers/register", [
            "app" => "registers/newRegister",
            "head" => $head,
            "user" => $user,
            "register" => false
        ]);
    }

    public function register(?array $data): void
    {
        //create get
        /*         if (!empty($data["register_id"]) && $data["register_id"] == "new") {
            $this->newRegister($data);
            return;
        } */
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {



            $registerCreate = new Register();
            $registerCreate->notes = $data["notes"];
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $registerCreate->user_id = $data["user_id"];
            $registerCreate->register_name = $data["register_name"];

            $registerCreate->creation = date('Y-m-d', strtotime($data["creation"]));
            $registerCreate->expiration = date('Y-m-d', strtotime($data["expiration"]));
            $registerCreate->contact_admin = $data["contact_admin"];
            $registerCreate->contact_technical = $data["contact_technical"];
            $registerCreate->contact_financial = $data["contact_financial"];
            $registerCreate->dns_1 = $data["dns_1"];
            $registerCreate->dns_2 = $data["dns_2"];
            $registerCreate->dns_3 = $data["dns_3"];
            $registerCreate->status = $data["status"];
            

            if (!$registerCreate->save()) {
                $json["message"] = $registerCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Registro de domínio cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/admin/registers/register/{$registerCreate->user_id}/{$registerCreate->id}");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {




            $registerUpdate = (new Register())->findByRegisterId($data["register_id"]);


            if (!$registerUpdate) {

                $this->message->error("Você tentou gerenciar um Registro que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/registers/home")]);
                return;
            }
            $registerUpdate->notes = $data["notes"];    
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $registerUpdate->register_name = $data["register_name"];
            $registerUpdate->creation = date_fmt_back($data["creation"]);
            $registerUpdate->expiration = date_fmt_back($data["expiration"]);
            $registerUpdate->contact_admin = $data["contact_admin"];
            $registerUpdate->contact_technical = $data["contact_technical"];
            $registerUpdate->contact_financial = $data["contact_financial"];
            $registerUpdate->dns_1 = $data["dns_1"];
            $registerUpdate->dns_2 = $data["dns_2"];
            $registerUpdate->dns_3 = $data["dns_3"];
            $registerUpdate->status = $data["status"];


            if (!$registerUpdate->save()) {
                $json["message"] = $registerUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Registro atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);

            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $registerDelete = (new Register())->findById($data["register_id"]);

            if (!$registerDelete) {
                $this->message->error("Você tentnou deletar um registro que não existe")->flash();
                echo json_encode(["redirect" => url("/admin/registers/home")]);
                return;
            }

            if ($registerDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$registerDelete->photo}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$registerDelete->photo}");
                (new Thumb())->flush($registerDelete->photo);
            }

            $registerDelete->destroy();

            $this->message->success("O registro foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/registers/home")]);

            return;
        }

        $registerEdit = null;
        if (!empty($data["register_id"])) {
            $registerId = filter_var($data["register_id"], FILTER_VALIDATE_INT);
            $registerEdit = (new Register())->findByRegisterId($registerId);
        }
        if (!empty($data["user_id"])) {
            $userId = filter_var($data["user_id"], FILTER_VALIDATE_INT);
            $user = (new User())->findById($userId);
        }
        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($registerEdit ? "Domínio {$registerEdit->register_name}" : "Alteração de Dados"),
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/registers/register", [
            "app" => "registers/register",
            "head" => $head,
            "register" => $registerEdit,
            "user" => $user
        ]);
    }

    public function registerList($data): void
    {
        $idDeUmUsuario = $data['user_id'];
        //verifica se o id recebido é válido e se o usuário existe
        $idValidado = filter_var($idDeUmUsuario, FILTER_VALIDATE_INT);

        $usuarioExiste =  (new User())->findById($idValidado);

        $termos = "user_id = " . (string) $idDeUmUsuario;
        $userId = $usuarioExiste->user_id;
        $dominiosDoUser = null;
        //essa linha prepara a pesquisa por ID de todos os domínios de um usuário específico
        //então ela executa a pesquisa utilizando fetch, esse resultado é passado pra frente

        $dominiosDoUser = (new DomainModel())->find($termos)->fetch(true);

        //            if ($usuarioexiste == null || $dominiosDoUser.sizeof() == 0){
        //                            $this->message->info("Ocorreu um erro.")->flash();
        //                            redirect("/admin/registers/home");
        //            }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Registros ",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/registers/register-list", [
            "head" => $head,
            "app" => "registers/registerList",
            "domain" => $dominiosDoUser,
            "user" => $usuarioExiste
        ]);
    }
}
