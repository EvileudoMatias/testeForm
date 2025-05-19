<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensagem = strip_tags(trim($_POST["mensagem"]));

    // Verificação simples de campos vazios
    if (empty($nome) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Por favor, preencha todos os campos corretamente.";
    } else {
        // Defina o e-mail para onde será enviado
        $destinatario = "evileudo@gmail.com";
        $assunto = "Nova mensagem do formulário de contato";

        // Corpo do e-mail
        $corpo = "Nome: $nome\n";
        $corpo .= "Email: $email\n";
        $corpo .= "Mensagem:\n$mensagem\n";

        $headers = "From: $nome <$email>";

        // Envia o e-mail
        if (mail($destinatario, $assunto, $corpo, $headers)) {
            $sucesso = "Mensagem enviada com sucesso!";
        } else {
            $erro = "Erro ao enviar a mensagem. Tente novamente.";
        }
    }
}
?>