
<?php
function contarMaiusculas($senha)
{
    $total = 0;
    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_upper($senha[$i])) {
            $total++;
        }
    }
    return $total;
}
function contarMinusculas($senha)
{
    $total = 0;
    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_lower($senha[$i])) {
            $total++;
        }
    }
    return $total;
}
function contarNumeros($senha)
{
    $total = 0;
    for ($i = 0; $i < strlen($senha); $i++) {
        if (is_numeric($senha[$i])) {
            $total++;
        }
    }
    return $total;
}
function contarEspeciais($senha)
{
    $total = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (!ctype_alnum($senha[$i])) {
            $total++;
        }
    }
    return $total;
}
function classificarSenha($tamanho, $maiusculas, $minusculas, $numeros, $especiais)
{
    $pontos = 0;
    if ($tamanho >= 8) {
        $pontos++;
    }
    if ($maiusculas > 0) {
        $pontos++;
    }
    if ($minusculas > 0) {
        $pontos++;
    }
    if ($numeros > 0) {
        $pontos++;
    }
    if ($especiais > 0) {
        $pontos++;
    }
    if ($pontos <= 2) {
        return "Fraca";
    }
    if ($pontos == 3) {
        return "Média";
    }
    if ($pontos == 4) {
        return "Forte";
    }
    return "Muito Forte";
}
function analisarSenha($senha)
{
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarEspeciais($senha);
    $tamanho = strlen($senha);
    $nivel = classificarSenha($tamanho, $maiusculas, $minusculas, $numeros, $especiais);

    $resultado = [
        "maiusculas" => $maiusculas,
        "minusculas" => $minusculas,
        "numeros" => $numeros,
        "especiais" => $especiais,
        "tamanho" => $tamanho,
        "nivel" => $nivel
    ];
    return $resultado;
}
$senha = "Abc123@4";
$resultado = analisarSenha($senha);

echo "Senha: " . $senha . "<br>";
echo "Maiúsculas: " . $resultado["maiusculas"] . "<br>";
echo "Minúsculas: " . $resultado["minusculas"] . "<br>";
echo "Números: " . $resultado["numeros"] . "<br>";
echo "Caracteres especiais: " . $resultado["especiais"] . "<br>";
echo "Tamanho: " . $resultado["tamanho"] . "<br>";
echo "Segurança: " . $resultado["nivel"];

?>