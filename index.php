<?php
include 'conexao.php';

// Buscar os animais do banco de dados
$sql = "SELECT * FROM animais";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Home</title>
    <meta name="description" content="O projeto MyNewPet simplifica o processo de adoção de um Pet, reunindo animais amorosos a tutores responsáveis!">
    <link rel="icon" href="img/paw.png">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="container flex">
            <div id="logo">
                <img src="assets/Cat and dog-cuate 1.png" alt="pet">
            </div>
            <nav>
                <input type="checkbox" id="check">
                <label for="check">&#x268c;</label>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#sobre">Sobre</a></li>
                    <li><a href="#adocao">Adoção e Compra</a></li>
                    <li><a href="#contato">Contato</a></li>
                    <li><a href="usuario.php">Usuario</a></li>
                    <li><a href="registerAnimal.html">Animal</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Destaque - projeto -->
    <main id="inicio">
        <div class="container flex2">
            <div id="destaqProj">
                <img src="assets/dog-destaq01.jpg" alt="Cachorro" id="img-main">
            </div>
            <div id="textProj">
                <h1>Projeto - PetsHome</h1>
                <h2>Onde amor e cuidado se encontram!</h2>
                <p>No Pets Home, prezamos pela transparência e segurança em todo o processo de adoção. Convidamos você a explorar nosso site, conhecer nossos animais disponíveis e se juntar a nós na missão de transformar vidas. No Pets Home, acreditamos que juntos podemos fazer a diferença.</p>
            </div>
        </div>
    </main>

    <!-- Sobre -->
    <section id="sobre">
        <div class="container flex3">
            <div id="textoSobre">
                <h2>Sobre nós</h2>
                <p>Em 2024, nasceu o Pets Home, um site dedicado à adoção e castração de pets. Nosso objetivo é proporcionar lares amorosos e seguros para animais de todas as raças e tamanhos, promovendo a saúde através da castração responsável!<br><br>
                Nosso site é fácil de usar e prioriza a qualidade. Cada animal listado passa por uma avaliação completa de saúde e comportamento, garantindo que os adotantes encontrem o companheiro ideal.<br><br>
                Além da adoção, incentivamos a castração como medida de controle populacional e prevenção de doenças. Trabalhamos com clínicas veterinárias e ONGs para oferecer serviços de castração a preços acessíveis.</p>
            </div>
        </div>
    </section>

    <!-- Adoção -->
    
<section id="adocao">
    <div class="container">
        <div id="carrossel-container">
            <div id="carrossel">
                <?php
                include 'conexao.php'; 

                $sql = "SELECT nome, descricao, foto FROM animais";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="cards">';
                        echo '<div class="image" style="background-image: url(\'uploads/' . $row["foto"] . '\');"></div>';
                        echo '<h3>' . $row["nome"] . '</h3>';
                        echo '<p>' . $row["descricao"] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "Nenhum animal cadastrado.";
                }
                
                $conn->close();
                ?>
            </div>
            <button id="prevBtn">⟨</button>
            <button id="nextBtn">⟩</button>
        </div>
    </div>
</section>


    <!-- Rodape -->
    <address>
        <div class="container flex5">
            <div id="contato">
                <a href="https://api.whatsapp.com/send?phone=5592991997749" target="_blank">
                    <img src="assets/wpp.png" alt="whatsapp" title="Abrir WhatsApp" id="wpp">
                    <p>(92) 99199-7749</p>
                </a>
                <img src="assets/fone.png" alt="telefone" id="fone">
                <p>(92) 99199-7749</p>
            </div>
            <div id="end">
                <img src="assets/local.png" alt="local" id="IconLocal">
                <p>Rua exemplo, n 123</p>
                <p>Bairro exemplo</p>
                <p>Manaus - AM</p>
                <a href="#">
                    <img src="assets/gmail.png" alt="gmail" title="Enviar E-mail" id="email">
                    <p>exemplo@gmail.com</p>
                </a>
            </div>
        </div>
    </address>
    <footer>
        <div class="container flex4"></div>
    </footer>

    <a href="#inicio" id="topo"><img src="assets/topo.png" alt="Topo do site"></a>

    <script src="carrosel.js"></script>
</body>
</html>

<?php
$conn->close();
?>