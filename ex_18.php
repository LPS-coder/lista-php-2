<?php
function contarConsultas($agenda)
{
    return count($agenda);
}
function contarPacientes($agenda)
{
    $pacientes = [];
    foreach ($agenda as $consulta) {
        $pacientes[$consulta["paciente"]] = true;
    }
    return count($pacientes);
}
function contarEspecialidades($agenda)
{
    $especialidades = [];
    foreach ($agenda as $consulta) {
        $especialidade = $consulta["especialidade"];
        if (isset($especialidades[$especialidade])) {
            $especialidades[$especialidade]++;
        } else {
            $especialidades[$especialidade] = 1;
        }
    }
    return $especialidades;
}
function ordenarHorarios($agenda)
{
    usort($agenda, function ($a, $b) {
        return strcmp($a["horario"], $b["horario"]);
    });
    return $agenda;
}
function primeiroAtendimento($agenda)
{
    $agendaOrdenada = ordenarHorarios($agenda);
    return $agendaOrdenada[0];
}
function ultimoAtendimento($agenda)
{
    $agendaOrdenada = ordenarHorarios($agenda);
    return $agendaOrdenada[count($agendaOrdenada) - 1];
}
function pesquisarPaciente($agenda, $nome)
{
    $resultados = [];
    foreach ($agenda as $consulta) {
        if (strtolower($consulta["paciente"]) == strtolower($nome)) {
            $resultados[] = $consulta;
        }
    }
    return $resultados;
}
function verificarHorariosDuplicados($agenda)
{
    $horarios = [];
    $duplicados = [];
    foreach ($agenda as $consulta) {
        $horario = $consulta["horario"];
        if (isset($horarios[$horario])) {
            $duplicados[$horario] = true;
        } else {
            $horarios[$horario] = true;
        }
    }
    return array_keys($duplicados);
}
function organizarAgenda($agenda, $nomePaciente)
{
    $agendaOrdenada = ordenarHorarios($agenda);
    $resultado = [
        "total_consultas" => contarConsultas($agenda),
        "pacientes_diferentes" => contarPacientes($agenda),
        "consultas_por_especialidade" => contarEspecialidades($agenda),
        "primeiro_atendimento" => primeiroAtendimento($agenda),
        "ultimo_atendimento" => ultimoAtendimento($agenda),
        "agenda_ordenada" => $agendaOrdenada,
        "pesquisa_paciente" => pesquisarPaciente($agenda, $nomePaciente),
        "horarios_duplicados" => verificarHorariosDuplicados($agenda)
    ];
    return $resultado;
}
$agenda = [
    [
        "paciente" => "João Silva",
        "especialidade" => "Cardiologia",
        "data" => "03/10/2026",
        "horario" => "08:00"
    ],
    [
        "paciente" => "Maria Santos",
        "especialidade" => "Dermatologia",
        "data" => "03/10/2026",
        "horario" => "09:30"
    ],
    [
        "paciente" => "João Silva",
        "especialidade" => "Cardiologia",
        "data" => "03/10/2026",
        "horario" => "10:00"
    ],
    [
        "paciente" => "Pedro Oliveira",
        "especialidade" => "Ortopedia",
        "data" => "03/10/2026",
        "horario" => "09:30"
    ],
    [
        "paciente" => "Ana Costa",
        "especialidade" => "Dermatologia",
        "data" => "03/10/2026",
        "horario" => "11:00"
    ]
];
$resultado = organizarAgenda($agenda, "João Silva");

echo "Total de consultas: " . $resultado["total_consultas"] . "<br>";
echo "Pacientes diferentes: " . $resultado["pacientes_diferentes"] . "<br>";
echo "<br>Consultas por especialidade:<br>";

foreach ($resultado["consultas_por_especialidade"] as $especialidade => $quantidade) {
    echo $especialidade . ": " . $quantidade . "<br>";
}

echo "<br>Primeiro atendimento:<br>";
echo $resultado["primeiro_atendimento"]["paciente"] . " - ";
echo $resultado["primeiro_atendimento"]["horario"] . "<br>";

echo "<br>Último atendimento:<br>";
echo $resultado["ultimo_atendimento"]["paciente"] . " - ";
echo $resultado["ultimo_atendimento"]["horario"] . "<br>";

echo "<br>Agenda ordenada:<br>";

foreach ($resultado["agenda_ordenada"] as $consulta) {
    echo $consulta["horario"] . " - ";
    echo $consulta["paciente"] . " - ";
    echo $consulta["especialidade"] . "<br>";
}

echo "<br>Pesquisa por paciente:<br>";

foreach ($resultado["pesquisa_paciente"] as $consulta) {
    echo $consulta["paciente"] . " - ";
    echo $consulta["especialidade"] . " - ";
    echo $consulta["horario"] . "<br>";
}

echo "<br>Horários duplicados:<br>";

if (count($resultado["horarios_duplicados"]) > 0) {
    foreach ($resultado["horarios_duplicados"] as $horario) {
        echo $horario . "<br>";
    }
} else {
    echo "Não existem horários duplicados.";
}
?>