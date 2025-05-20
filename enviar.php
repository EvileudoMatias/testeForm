<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome     = strip_tags(trim($_POST["nome"]));
    $email    = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $assunto  = strip_tags(trim($_POST["assunto"]));
    $mensagem = strip_tags(trim($_POST["mensagem"]));

    // Verifica se os campos estão preenchidos corretamente
    if (empty($nome) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Configuração do e-mail
    $destinatario = "evileudo@gmail.com.com";  // Altere para seu e-mail
    $assunto_email = "Formulário de Contato: $assunto";
    $corpo_email = "Nome: $nome\n";
    $corpo_email .= "Email: $email\n\n";
    $corpo_email .= "Mensagem:\n$mensagem\n";

    $headers = "From: $nome <$email>";

    // Envia o e-mail
    if (mail($destinatario, $assunto_email, $corpo_email, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem. Tente novamente mais tarde.";
    }
} else {
    echo "Método inválido.";
}
?>