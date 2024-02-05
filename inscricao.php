<?php
include 'db.php';

function inserirParticipante($animal_puxador, $nome_completo, $cpf_competidor, $apelido_competidor, $proprietario_nome, $proprietario_cpf, $email, $endereco, $cep, $cidade, $uf, $telefone) {
    global $conn;

    $sql = "INSERT INTO competidores (animal_puxador, nome_completo, cpf_competidor, apelido_competidor, proprietario_nome, proprietario_cpf, email, endereco, cep, cidade, uf, telefone) 
    VALUES ('$animal_puxador', '$nome_completo', '$cpf_competidor', '$apelido_competidor', '$proprietario_nome', '$proprietario_cpf', '$email', '$endereco', '$cep', '$cidade', '$uf', '$telefone')";

    if ($conn->query($sql) === TRUE) {
        return $conn->insert_id; // Retorna o ID do participante inserido
    } else {
        return false;
    }
}



function realizarInscricao($participanteId, $eventoId, $numeroSenha) {
    global $conn;

    $sql = "INSERT INTO inscricoes (participante_id, evento_id, numero_senha) VALUES ('$participanteId', '$eventoId', '$numeroSenha')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Erro ao realizar inscrição: " . $conn->error;
    }
}

?>
