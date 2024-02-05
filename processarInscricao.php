<?php
include 'db.php'; // Inclua o arquivo que contém a conexão com o banco de dados
include 'inscricao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_puxador = $_POST['animal_puxador'];
    $nome_completo = $_POST['nome_completo'];
    $cpf_competidor = $_POST['cpf_competidor'];
    $apelido_competidor = $_POST['apelido_competidor'];
    $proprietario_nome = $_POST['proprietario_nome'];
    $proprietario_cpf = $_POST['proprietario_cpf'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $telefone = $_POST['telefone'];
    $eventoId = $_POST["evento_id"];
    $numeroSenha = $_POST["numero_senha"];

    // Valide os dados conforme necessário

    // Função para encontrar o primeiro número vago seguinte à escolha do usuário
    function encontrarNumeroVago($numeroEscolhido) {
        global $conn;

        $sql = "SELECT MIN(numero_senha) AS numero_vago FROM senhas WHERE numero_senha >= $numeroEscolhido";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["numero_vago"];
        } else {
            return $numeroEscolhido; // Se nenhum número vago for encontrado, use o número escolhido pelo usuário.
        }
    }

    $numeroSenha = encontrarNumeroVago($numeroSenha);

    $participanteId = inserirParticipante($animal_puxador, $nome_completo, $cpf_competidor, $apelido_competidor, $proprietario_nome, $proprietario_cpf, $email, $endereco, $cep, $cidade, $uf, $telefone);
    if ($participanteId) {
        $resultado = realizarInscricao($participanteId, $eventoId, $numeroSenha);
        if ($resultado === true) {
            echo "Inscrição realizada com sucesso! Número da Senha: $numeroSenha";
        } else {
            echo $resultado;
        }
    } else {
        echo "Erro ao cadastrar participante.";
    }
}

?>
