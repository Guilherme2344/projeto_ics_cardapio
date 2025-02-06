<?php
require '../includes/config.php';

$sql_categorias = "SELECT id, categoria FROM cardapio";
$result_categorias = $conn->query($sql_categorias);
$categorias = [];

if ($result_categorias->num_rows > 0) {
    while ($row = $result_categorias->fetch_assoc()) {
        $categorias[] = $row;
    }
}

$sql_itens = "SELECT item.id, item.tipo, item.descricao, item.preco, cardapio.categoria 
            FROM item 
            INNER JOIN cardapio ON item.cardapio_id = cardapio.id
            WHERE cardapio.categoria = 'Café'";
$result_itens = $conn->query($sql_itens);
$itens_cafe = [];

if ($result_itens->num_rows > 0) {
    while ($row = $result_itens->fetch_assoc()) {
    $itens_cafe[] = $row;
    }
}

$sql_itens = "SELECT item.id, item.tipo, item.descricao, item.preco, cardapio.categoria 
            FROM item 
            INNER JOIN cardapio ON item.cardapio_id = cardapio.id
            WHERE cardapio.categoria = 'Almoço'";
$result_itens_almoco = $conn->query($sql_itens);
$itens_almoco = [];

if ($result_itens_almoco->num_rows > 0) {
    while ($row = $result_itens_almoco->fetch_assoc()) {
    $itens_almoco[] = $row;
    }
}

$sql_itens = "SELECT item.id, item.tipo, item.descricao, item.preco, cardapio.categoria 
            FROM item 
            INNER JOIN cardapio ON item.cardapio_id = cardapio.id
            WHERE cardapio.categoria = 'Jantar'";
$result_itens_jantar = $conn->query($sql_itens);
$itens_jantar = [];

if ($result_itens_jantar->num_rows > 0) {
    while ($row = $result_itens_jantar->fetch_assoc()) {
    $itens_jantar[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PY Bistro</title>
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="pybistro.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#inicio">
                    <img src="imagens/logo.png" alt="PY Bistro" width="105" height="70">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#quemsomos">Quem Somos</a>
                        </li>
                    </ul>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary me-md-2" href="#cardapio" type="button" onclick="vercardapio()">Conheça nosso cardápio</button>
                </div>
            </div>
        </nav>
    </header>
    <main id="inicio">
        <figure>
            <img src="imagens/destaque.png" alt="PY Bistro">
        </figure>

        <section class="quemsomos" id="quemsomos">
            <p><span class="codigo">for</span> 13 <span class="codigo">in</span> historia:</p>
            <div class="tags">
                <p><</p>
                <p>h2</p>
                <p>></p>
            </div>
            <h2>Quem somos</h2>
            <div class="tags segunda">
                <p><</p>
                <p>/h2</p>
                <p>></p>
            </div>
            <p class="texto">No <span class="pybistro">PY Bistro</span>, acreditamos que a gastronomia, assim como a programação, exige precisão, criatividade e uma boa lógica para entregar a melhor experiência. Criado por programadores e há 13 anos no mercado, combinamos a arte culinária com a exatidão de um código bem escrito, oferecendo pratos elaborados com técnica e paixão.<br><br>
                Aqui, cada receita é desenvolvida como uma linha de código eficiente: otimizada para o sabor, testada para a perfeição e servida com a melhor interface — um atendimento de qualidade. Afinal, cozinhar também é uma ciência, e cada detalhe do nosso menu é pensado com equilíbrio e inovação para garantir uma experiência gastronômica marcante.<br><br>
                Seja para um breakpoint no meio do dia, uma reunião produtiva ou apenas para recarregar as energias, o <span class="pybistro">PY Bistro</span> é o ponto de encontro ideal para quem aprecia boa comida e boas ideias.</p>
        </section>

        <section class="cardapio" id="cardapio">
            <div class="titulo">
                <div style="width: max-content;">
                    <div class="tags card">
                        <p><</p>
                        <p>h2</p>
                        <p>></p>
                    </div>
                    <h2 class="carditulo">Cardápio</h2>
                    <div class="tags card2">
                        <p><</p>
                        <p>/h2</p>
                        <p>></p>
                    </div>
                </div>
            </div>

            <section class="cardapiomesmo">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="cardp">
                                <img src="imagens/minicarpa.png" class="card-img-top" alt="Café da Manhã">
                                <div class="card-body">
                                    <h3 class="card-title">Café da Manhã</h3>
                                    <p class="card-text">Cafés robustos, pães bem estruturados e combinações nutritivas para um boot perfeito no seu dia.</p>
                                    <button class="btn btn-primary cardpb" data-bs-toggle="modal" data-bs-target="#modalCafe">Ver Mais</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cardp">
                                <img src="imagens/minicarpa.png" class="card-img-top" alt="Almoço">
                                <div class="card-body">
                                    <h3 class="card-title">Almoço</h3>
                                    <p class="card-text">Refeições bem compiladas, com ingredientes que rodam sem erro e temperos que dão upgrade no sabor.</p>
                                    <button class="btn btn-primary cardpb" data-bs-toggle="modal" data-bs-target="#modalAlmoco">Ver Mais</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cardp">
                                <img src="imagens/minicarpa.png" class="card-img-top" alt="Jantar">
                                <div class="card-body">
                                    <h3 class="card-title">Jantar</h3>
                                    <p class="card-text">Pratos sofisticados e sobremesas dignas de um return perfeito, para fechar o dia sem debugs.</p>
                                    <button class="btn btn-primary cardpb" data-bs-toggle="modal" data-bs-target="#modalJantar">Ver Mais</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </section>
    </main>

    <div class="modal fade" id="modalCafe" tabindex="-1" aria-labelledby="modalCafeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalCafeLabel">Café da Manhã</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <?php foreach ($itens_cafe as $itens_cafe): ?>
                        <li>
                            <h2><?php echo $itens_cafe['tipo']; ?></h2>
                            <p><?php echo $itens_cafe['descricao']; ?></p>
                            <p><?php echo number_format($itens_cafe['preco'], 2, ',', '.'); ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAlmoco" tabindex="-1" aria-labelledby="modalAlmocoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalAlmocoLabel">Almoço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <?php foreach ($itens_almoco as $itens_almoco): ?>
                        <li>
                            <h2><?php echo $itens_almoco['tipo']; ?></h2>
                            <p><?php echo $itens_almoco['descricao']; ?></p>
                            <p><?php echo number_format($itens_almoco['preco'], 2, ',', '.'); ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  
    <div class="modal fade" id="modalJantar" tabindex="-1" aria-labelledby="modalJantarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalJantarLabel">Jantar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <?php foreach ($itens_jantar as $itens_jantar): ?>
                        <li>
                            <h2><?php echo $itens_jantar['tipo']; ?></h2>
                            <p><?php echo $itens_jantar['descricao']; ?></p>
                            <p><?php echo number_format($itens_jantar['preco'], 2, ',', '.'); ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  

    <footer>
        <div class="cima">
            <a class="navbar-brand" href="#inicio">
                <img src="imagens/logo.png" alt="PY Bistro" width="105" height="70">
            </a>
            <a class="elementor-icon elementor-social-icon elementor-social-icon- elementor-repeater-item-65a5886" href="https://www.instagram.com" target="_blank">
                <span class="elementor-screen-only"></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19.0997 5.81519C19.114 6.32948 19.1247 6.78662 19.1318 7.18662C19.139 7.58662 19.1425 8.42947 19.1425 9.71519C19.1425 11.0009 19.139 11.8438 19.1318 
                    12.2438C19.1247 12.6438 19.114 13.0938 19.0997 13.5938C19.0711 14.1081 19.0175 14.5438 18.939 14.9009C18.8604 15.2581 18.764 15.5866 18.6497 15.8866C18.5354 16.2009 18.3925 16.4938 18.2211 16.7652C18.0497 17.0366 17.8283 17.3009 17.5568 17.5581C17.2997 17.8295 17.0354 18.0509 16.764 18.2223C16.4925 
                    18.3938 16.1997 18.5366 15.8854 18.6509C15.5854 18.7652 15.2568 18.8616 14.8997 18.9402C14.5425 19.0188 14.114 19.0723 13.614 19.1009C13.0997 19.1152 12.6426 19.1259 12.2425 19.1331C11.8425 19.1402 10.9997 19.1438 9.71397 19.1438C8.42825 19.1438 7.5854 19.1402 7.1854 19.1331C6.7854 19.1259 6.3354 19.1152 
                    5.8354 19.1009C5.32111 19.0723 4.8854 19.0188 4.52826 18.9402C4.17111 18.8616 3.84255 18.7652 3.54254 18.6509C3.22826 18.5366 2.9354 18.3938 2.66397 18.2223C2.39254 18.0509 2.12826 17.8295 1.87111 17.5581C1.59968 17.3009 1.37826 17.0366 1.20683 16.7652C1.0354 16.4938 0.892544 16.2009 0.778258 15.8866C0.663971 15.5866 0.567546 15.2581 
                    0.488974 14.9009C0.410402 14.5438 0.356827 14.1152 0.328255 13.6152C0.31397 13.1009 0.303256 12.6438 0.296113 12.2438C0.28897 11.8438 0.2854 11.0009 0.2854 9.71519C0.2854 8.42947 0.28897 7.58662 0.296113 7.18662C0.303256 6.78662 0.31397 6.33663 0.328255 5.83662C0.356827 5.32233 0.410402 4.88662 0.488974 4.52948C0.567546 4.17233 
                    0.663971 3.84377 0.778258 3.54376C0.892544 3.22948 1.0354 2.93662 1.20683 2.66519C1.37826 2.39376 1.59968 2.12948 1.87111 1.87234C2.12826 1.60091 2.39254 1.37948 2.66397 1.20805C2.9354 1.03662 3.22826 0.893765 3.54254 0.779478C3.84255 0.665192 4.17111 0.568764 4.52826 0.490193C4.8854 0.411621 5.31397 0.35805 5.81397 0.329478C6.32826 0.315192 
                    6.7854 0.304478 7.1854 0.297335C7.5854 0.290192 8.42825 0.286621 9.71397 0.286621C10.9997 0.286621 11.8425 0.290192 12.2425 0.297335C12.6426 0.304478 13.0925 0.315192 13.5925 0.329478C14.1068 0.35805 14.5425 0.411621 14.8997 0.490193C15.2568 0.568764 15.5854 0.665192 15.8854 0.779478C16.1997 0.893765 
                    16.4925 1.03662 16.764 1.20805C17.0354 1.37948 17.2997 1.60091 17.5568 1.87234C17.8283 2.12948 18.0497 2.39376 18.2211 2.66519C18.3925 2.93662 18.5354 3.22948 18.6497 3.54376C18.764 3.84377 18.8604 4.17233 18.939 4.52948C19.0175 4.88662 19.0711 5.31519 19.0997 5.81519ZM17.3854 13.5295C17.414 13.0295 17.4318 12.5831 
                    17.439 12.1902C17.4461 11.7973 17.4497 10.9723 17.4497 9.71519C17.4497 8.45805 17.4461 7.63305 17.439 7.24019C17.4318 6.84734 17.414 6.40091 17.3854 5.90091C17.3711 5.44376 17.3318 5.07948 17.2675 4.80805C17.2033 4.53662 17.1354 4.31519 17.064 4.14376C16.9783 3.92948 16.8818 3.73662 16.7747 3.56519C16.6675 3.39376 16.5283 3.22948 16.3568 
                    3.07234C16.1997 2.90091 16.0354 2.76162 15.864 2.65448C15.6925 2.54734 15.4997 2.45091 15.2854 2.36519C15.114 2.29376 14.8925 2.22591 14.6211 2.16162C14.3497 2.09734 13.9854 2.05805 13.5283 2.04376C13.0283 2.01519 12.5818 1.99734 12.189 1.99019C11.7961 1.98305 10.9711 1.97948 9.71397 1.97948C8.45682 1.97948 7.63183 1.98305 7.23897 
                    1.99019C6.84611 1.99734 6.39969 2.01519 5.89969 2.04376C5.44254 2.05805 5.07826 2.09734 4.80683 2.16162C4.5354 2.22591 4.31397 2.29376 4.14254 2.36519C3.92825 2.45091 3.7354 2.54734 3.56397 2.65448C3.39254 2.76162 3.22826 2.90091 3.07112 3.07234C2.89969 3.22948 2.7604 3.39376 2.65326 3.56519C2.54611 3.73662 2.44969 3.92948 2.36397 4.14376C2.29254 4.31519 2.22469 4.53662 2.1604 4.80805C2.09612 
                    5.07948 2.05683 5.44376 2.04255 5.90091C2.01397 6.40091 1.99612 6.84734 1.98897 7.24019C1.98183 7.63305 1.97826 8.45805 1.97826 9.71519C1.97826 10.9723 1.98183 11.7973 1.98897 12.1902C1.99612 12.5831 2.01397 13.0295 2.04255 13.5295C2.05683 13.9866 2.09612 14.3509 2.1604 14.6223C2.22469 14.8938 2.29254 15.1152 2.36397 15.2866C2.44969 15.5009 
                    2.54611 15.6938 2.65326 15.8652C2.7604 16.0366 2.89969 16.2009 3.07112 16.3581C3.22826 16.5295 3.39254 16.6688 3.56397 16.7759C3.7354 16.8831 3.92825 16.9795 4.14254 17.0652C4.31397 17.1366 4.5354 17.2045 4.80683 17.2688C5.07826 17.3331 5.44254 17.3723 5.89969 17.3866C6.39969 17.4152 6.84611 17.4331 7.23897 17.4402C7.63183 17.4473 8.45682 17.4509 9.71397 17.4509C10.9711 
                    17.4509 11.7961 17.4473 12.189 17.4402C12.5818 17.4331 13.0283 17.4152 13.5283 17.3866C13.9854 17.3723 14.3497 17.3331 14.6211 17.2688C14.8925 17.2045 15.114 17.1366 15.2854 17.0652C15.4997 16.9795 15.6925 16.8831 15.864 16.7759C16.0354 16.6688 16.1997 16.5295 16.3568 16.3581C16.5283 16.2009 16.6675 16.0366 16.7747 15.8652C16.8818 15.6938 16.9783 15.5009 17.064 15.2866C17.1354 
                    15.1152 17.2033 14.8938 17.2675 14.6223C17.3318 14.3509 17.3711 13.9866 17.3854 13.5295ZM9.71397 4.87234C10.3854 4.87234 11.014 5.00091 11.5997 5.25805C12.1854 5.50091 12.6997 5.84376 13.1425 6.28662C13.5854 6.72948 13.9283 7.24376 14.1711 7.82948C14.4283 8.4152 14.5568 9.04376 14.5568 9.71519C14.5568 10.3866 14.4283 11.0152 14.1711 11.6009C13.9283 12.1866 13.5854 12.7009 13.1425 13.1438C12.6997 
                    13.5866 12.1854 13.9295 11.5997 14.1723C11.014 14.4295 10.3854 14.5581 9.71397 14.5581C9.04254 14.5581 8.41397 14.4295 7.82826 14.1723C7.24254 13.9295 6.72826 13.5866 6.2854 13.1438C5.84254 12.7009 5.49969 12.1866 5.25683 11.6009C4.99968 11.0152 4.87112 10.3866 4.87112 9.71519C4.87112 9.04376 4.99968 8.4152 5.25683 7.82948C5.49969 7.24376 5.84254 6.72948 6.2854 6.28662C6.72826 
                    5.84376 7.24254 5.50091 7.82826 5.25805C8.41397 5.00091 9.04254 4.87234 9.71397 4.87234ZM9.71397 12.8652C10.5854 12.8652 11.3283 12.5581 11.9425 11.9438C12.5568 11.3295 12.864 10.5866 12.864 9.71519C12.864 8.84376 12.5568 8.10091 11.9425 7.48662C11.3283 6.87233 10.5854 6.56519 9.71397 6.56519C8.84254 6.56519 8.09969 6.87233 7.4854 7.48662C6.87111 8.10091 6.56397 8.84376 6.56397 9.71519C6.56397 10.5866 6.87111 11.3295 7.4854 11.9438C8.09969 12.5581 
                    8.84254 12.8652 9.71397 12.8652ZM15.8425 4.42234C15.914 4.72234 15.8675 5.00448 15.7033 5.26876C15.539 5.53305 15.3068 5.70091 15.0068 5.77234C14.7068 5.84377 14.4247 5.79734 14.1604 5.63305C13.8961 5.46876 13.7283 5.23662 13.6568 4.93662C13.5854 4.63662 13.6318 4.35448 13.7961 4.09019C13.9604 3.82591 14.1925 3.65805 14.4925 3.58662C14.7925 3.50091 15.0747 3.54376 15.339 3.71519C15.6033 3.88662 15.7711 4.12233 15.8425 4.42234Z" fill="#DFA767"></path></svg>
            </a>
        </div>
            <hr class="divisor">
            <div class="quasenavfoot">
                <ul class="navbar-navf ms-auto">
                    <li class="navf-item">
                        <a class="navf-link" href="#quemsomos">Quem Somos</a>
                    </li>
                    <li class="navf-item">
                        <a class="navf-link" href="#cardapio">Conheça nosso cardápio</a>
                    </li>
                </ul>
                <p style="color: #DFA767; font-size: 15px;">© 2025, <i>PY Bistro - G.I.S.</i></p>
            </div>
        </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script>
        function vercardapio() {
            document.getElementById("cardapio").scrollIntoView({ behavior: "smooth" });
        }
    </script>
</body>
</html>
