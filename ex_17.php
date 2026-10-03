<?php
function contarCaracteres($texto)
{
    return strlen($texto);
}
function separarPalavras($texto)
{
    $texto = preg_replace('/\s+/', ' ', trim($texto));
    return explode(' ', $texto);
}
function contarPalavras($palavras)
{
    return count($palavras);
}
function contarFrases($texto)
{
    $texto = trim($texto);
    if ($texto == '') {
        return 0;
    }
    $frases = preg_split('/[.!?]+/', $texto);
    $frases = array_filter($frases);
    return count($frases);
}
function encontrarMaiorMenor($palavras)
{
    $maior = $palavras[0];
    $menor = $palavras[0];
    foreach ($palavras as $palavra) {
        if (strlen($palavra) > strlen($maior)) {
            $maior = $palavra;
        }
        if (strlen($palavra) < strlen($menor)) {
            $menor = $palavra;
        }
    }
    return [
        "maior" => $maior,
        "menor" => $menor
    ];
}
function contarRepeticoes($palavras)
{
    $quantidades = array_count_values($palavras);
    $repetidas = 0;
    foreach ($quantidades as $quantidade) {
        if ($quantidade > 1) {
            $repetidas++;
        }
    }
    return $repetidas;
}
function palavrasMaisFrequentes($palavras)
{
    $quantidades = array_count_values($palavras);
    arsort($quantidades);
    return array_slice($quantidades, 0, 5, true);
}
function removerEspacosDuplicados($texto)
{
    return preg_replace('/\s+/', ' ', trim($texto));
}
function formatarTexto($texto)
{
    $texto = removerEspacosDuplicados($texto);
    return ucwords(strtolower($texto));
}
function processarTexto($texto)
{
    $textoSemEspacosDuplicados = removerEspacosDuplicados($texto);
    $palavras = separarPalavras($textoSemEspacosDuplicados);
    $maiorMenor = encontrarMaiorMenor($palavras);
    $resultado = [
        "caracteres" => contarCaracteres($texto),
        "palavras" => contarPalavras($palavras),
        "frases" => contarFrases($texto),
        "palavra_maior" => $maiorMenor["maior"],
        "palavra_menor" => $maiorMenor["menor"],
        "palavras_repetidas" => contarRepeticoes($palavras),
        "mais_frequentes" => palavrasMaisFrequentes($palavras),
        "texto_sem_espacos_duplicados" => $textoSemEspacosDuplicados,
        "texto_formatado" => formatarTexto($texto)
    ];
    return $resultado;
}
$texto = "O PHP é uma linguagem simples. O PHP é muito utilizado para criar sites.";
$resultado = processarTexto($texto);

echo "Quantidade de caracteres: " . $resultado["caracteres"] . "<br>";
echo "Quantidade de palavras: " . $resultado["palavras"] . "<br>";
echo "Quantidade de frases: " . $resultado["frases"] . "<br>";
echo "Palavra mais longa: " . $resultado["palavra_maior"] . "<br>";
echo "Palavra mais curta: " . $resultado["palavra_menor"] . "<br>";
echo "Quantidade de palavras repetidas: " . $resultado["palavras_repetidas"] . "<br>";
echo "Cinco palavras mais frequentes:<br>";

foreach ($resultado["mais_frequentes"] as $palavra => $quantidade) {
    echo $palavra . " (" . $quantidade . " vezes)<br>";
}

echo "Texto sem espaços duplicados: " . $resultado["texto_sem_espacos_duplicados"] . "<br>";
echo "Texto formatado: " . $resultado["texto_formatado"];
?>