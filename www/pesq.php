
            <?php
            if (isset($_POST['searchButton'])) {
                $searchQuery = $_POST['searchQuery'];

                // Configuração do banco de dados
                $host = "localhost";
                $banco = "farmacia";
                $user = "root";
                $senha_user = "";

                // Conectar ao banco de dados
                $con = mysqli_connect($host, $user, $senha_user, $banco);

                if (!$con) {
                    die("Conexão falhou: " . mysqli_connect_error());
                }

                // Usar prepared statements para segurança
                $stmt = $con->prepare("SELECT produto, descricao, quantidade, preco, idproduto FROM produto WHERE produto LIKE ? OR descricao LIKE ?");
                $searchTerm = "%{$searchQuery}%";
                $stmt->bind_param("ss", $searchTerm, $searchTerm);

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<h3>' . htmlspecialchars($row['produto']) . ' (ID: ' . htmlspecialchars($row['idproduto']) . ')</h3>';
                        echo '<p>' . htmlspecialchars($row['descricao']) . ' | Quantidade: ' . htmlspecialchars($row['quantidade']) . ' | Preço: R$ ' . htmlspecialchars($row['preco']) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Nenhum resultado encontrado</p>';
                }

                // Fechar statement e conexão
                $stmt->close();
                $con->close();
            }
            ?>
    