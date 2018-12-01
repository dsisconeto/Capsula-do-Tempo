<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 17:58
 */


sysLoadClass("CompanyEmail");
use Respect\Validation\Validator as respect;


class FormCompanyEmail extends DjReturnMsg
{

    public function sentEmailToCompany()
    {
        $this->setMsg("Email da Empresa não encontrado no banco de dados", false, 10);
        $this->setMsg("Ops, você enviou email faz menos de 1 minuto, agurde um pouco e tente novamente", false, 2);
        $this->setMsg("Nome do remetente não é valido", false, 11);
        $this->setMsg("Email do remetente  inválido", false, 12);
        $this->setMsg("Assunto do Email invalido", false, 13);
        $this->setMsg("Mensagem do Email", false, 14);

        $this->setMsg("<i class=\"fa fa-envelope\" aria-hidden=\"true\"></i> Email enviado com sucesso", true, 15);
        $this->setMsg("Falha ao enviar Email... ", false, 16);

        if (!DjRequest::issetCookie("setEmailCompany")) {


            $email = new CompanyEmail();

            $load = $email->sqlLoad(DjRequest::post("company_email_id"));

            setcookie("setEmailCompany", 1, time() + 60);


            $company = new Company();
            $myName = DjRequest::post("my_name", "str", "");
            $emailMsg = DjRequest::post("email_msg", "str", "");
            $myEmail = DjRequest::post("my_email", "str", "");
            $emailSubject = DjRequest::post("subject", "str", "");


            if ($load):
                $company->sqlLoad($load["company_id_fk"]);
            else:

                $this->setReturn(10);
            endif;

            if (!$email->validateCounterString(DjRequest::post("my_name"), 2)):
                $this->setReturn(11);
            endif;


            if (!$email->validateEmail(DjRequest::post("my_email"))):
                $this->setReturn(12);
            endif;

            if (!$email->validateCounterString(DjRequest::post("subject"), 2)):
                $this->setReturn(13);
            endif;


            if (!$email->validateCounterString(DjRequest::post("email_msg"), 5)):
                $this->setReturn(14);
            endif;


            if (!$this->getReturn()):

                $msg = "<p>Email Enviado da página da empresa, no portal Informativo Carajás, enviado por $myName </p>";

                $msg .= "<p>" . $emailMsg . "</p>";

                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                /// Additional headers
                $headers .= "From:$myEmail" . "\r\n";

                if (mail($email->getCompanyEmail(), $emailSubject, $msg, $headers)):
                    $this->setReturn(15);
                    // email de confirmação

                    $msg = "<p>Olá $myName, confirmamos o envio do email da página da empresa {$company->getCompanyFantasyName()} no Informativo Carajás</p>";

                    $emailSubject = "Confirmação do envio do Email...";

                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                    /// Additional headers
                    $headers .= "From:{$email->getCompanyEmail()}" . "\r\n";

                    mail($myEmail, $emailSubject, $msg, $headers);


                else:

                    $this->setReturn(16);

                endif;

            endif;
        } else {

            $this->setReturn(2);
        }

        return $this->getReturn();
    }

}