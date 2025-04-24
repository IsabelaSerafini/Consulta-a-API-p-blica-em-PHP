<?php 
$noticias = [];
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['opcao'])) {
    $tipo = strtolower($_GET['opcao']);

    if ($tipo === "notícias") {
        $url = "https://servicodados.ibge.gov.br/api/v3/noticias/?tipo=noticia";
    } elseif ($tipo === "release") {
        $url = "https://servicodados.ibge.gov.br/api/v3/noticias/?tipo=release";
    } elseif ($tipo === "todos") {
        $url = "https://servicodados.ibge.gov.br/api/v3/noticias";
    }

    if (!empty($url)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, "C:/xampp/php/cacert.pem");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $data = json_decode($response, true);
            if (isset($data['items'])) {
                $noticias = $data['items'];
            } else {
                $erro = "Nenhum dado encontrado na resposta da API.";
            }
        } else {
            $erro = "Erro ao consumir a API.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultados da API</title>
    <link rel="stylesheet" href="resultado.css">
</head>
<body>
    <main>
        <h1>Resultados da Pesquisa</h1>
        <a href="index.php">← Voltar</a>

        <?php if (!empty($erro) || !empty($noticias)): ?>
        <div id="listarAPI">
            <?php if (!empty($erro)): ?>
                <p><?= htmlspecialchars($erro) ?></p>
            <?php else: ?>
                <?php foreach ($noticias as $item): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                        <p><strong>Data:</strong> <?= htmlspecialchars($item['data_publicacao']) ?></p>
                        <p><?= htmlspecialchars($item['introducao']) ?></p>
                        <a href="<?= htmlspecialchars($item['link']) ?>" target="_blank">Leia mais</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </main>
</body>
</html>
