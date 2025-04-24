<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultando API de Notícias do IBGE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>API Notícias</h1>
        <p>Nesta API estão disponíveis as notícias e releases sobre 
           as pesquisas, estudos e produtos elaborados pelo IBGE, assim como a 
           produção jornalística da Agência IBGE Notícias</p>
        <form method="GET" action="resultado.php">
            <fieldset>
                <legend>Selecione o que deseja</legend>
                <input type="radio" name="opcao" id="noticias" value="Notícias" required>
                <label for="noticias">Notícias</label><br>
                <input type="radio" name="opcao" id="release" value="Release">
                <label for="release">Release</label><br>            
                <input type="radio" name="opcao" id="todos" value="Todos">
                <label for="todos">Todos</label><br>                           
            </fieldset>
            <br>
            <button type="submit">Pesquisar</button>
        </form>


    </main>
</body>
</html>
