<?php 

# Como esse arquivo exemplo não tem formatação, 
# setamos a saida de texto como padrao UTF-8 
# para evitar erros de codificacao de caracteres.
header('Content-Type: text/html; charset=utf-8');

# 1. Incluindo a biblioteca CSV
require_once __DIR__ . '/../src/CsvReader.php'; 

# 2. Instanciando o Objeto de Manipulação de dados
$csv = new CsvReader('movimentos_financeiros.csv', ',', '"');

# 3. Obtendo os resultados
foreach ($csv->read() as $row) {
    echo "ID Movimento: " . $row['idmovimento'] . PHP_EOL;
    echo "ID Usuario :" . $row['idusuario'] . PHP_EOL;
    echo "Data: " . $row['data'] . PHP_EOL;
    echo "Valor: " . $row['valor'] . PHP_EOL;
    echo "Liquidado: " . $row['liquidado'] . PHP_EOL;
    echo "Descrição: " . $row['descricao'] . PHP_EOL;
    echo "ID Categoria: " . $row['idcategoria'] . PHP_EOL;
    echo "Status: " . $row['status'] . PHP_EOL . PHP_EOL;
}


/**
 * Abaixo desse DIE, você encontra algumas 
 * dicas de uso da biblioteca.
 */
die();


/**
 * Metodos aceitos para instanciar a classe
 * ----------------------------------------
 */
# metodo 01
$csv = new CsvReader();
$csv->setFilePath('meu_arquivo.csv');
$csv->setDelimitador(';');
$dados = $csv->read();

# metodo 02
$csv = new CsvReader('meu_arquivo.csv', ';');
$dados = $csv->read();

#metodo 03
$csv = new CsvReader();
foreach ($csv->read('meu_arquivo.csv') as $linha ) {
    echo $linha['id_cliente'];
}


/**
 * Caminho e Nome do Arquivo
 * saida: string; algo como 'teste_importe__.csv';
 */
echo $csv->filepath() . "<br>"; 

/**
 * Número total de registros 
 * dentro do arquivo
 * saida: valor int;
 */
echo $csv->numRows() . "<br>";

/**
 * Obtendo o tamanho do arquivo
 * formatado em B,KB,MB,GB.
 * saida: Array('size','unit');
 */
$size = $csv->size();
echo $size['size'] . $size['unit'] . "<br>";

/**
 * Obtendo a data em que o arquivo foi 
 * Modificado.
 * Nota: Precisa configurar em seu sistema 
 * o timezone com date_default_timezone_set();
 * saida: string; algo como 10/04/2017 19:42:02
 */
echo $csv->dataModificacao() . "<br>";

/**
 * Existe a data em que o arquivo foi acessado 
 * por ultimo.
 * saida: string; algo como 10/04/2017 19:42:02
 */
echo $csv->dataAcesso() . "<br>";


/**
 * Você também pode transformar o resultado final 
 * em um objeto, se assim desejar e achar mais 
 * confortavel o uso de oop.
 * A conversão funciona pelo proprio PHP via typecast.
 */
foreach ($csv->ler() as $linha) {
    $linha = (object) $linha;
    var_dump( $linha );
}
