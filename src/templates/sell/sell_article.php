<?php function drawSell() { ?>
    <main>
        <h1>Vender um artigo</h1>
        <form action="submit.php" method="post">
            <section class="information">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required></textarea>

                <label for="marca">Marca:</label>
                <select id="marca" name="marca" required>
                    <option value="" disabled selected hidden>Selecione a marca</option>
                    <option value="bershka">Calças</option>
                    <option value="zara">Calções</option>
                    <option value="pull&bear">Camisa</option>
                </select>
                
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria" required>
                    <option value="" disabled selected hidden>Selecione a categoria</option>
                    <option value="pants">Calças</option>
                    <option value="shorts">Calções</option>
                    <option value="shirt">Camisa</option>
                </select>

                <label for="cor">Cor:</label>
                <select id="cor" name="cor" required>
                    <option value="" disabled selected hidden>Selecione a cor</option>
                    <option value="yellow">Amarelo</option>
                    <option value="blue">Azul</option>
                </select>
                
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="" disabled selected hidden>Selecione o estado</option>
                    <option value="new">Novo</option>
                    <option value="good">Bom</option>
                    <option value="bad">Mau</option>

                </select>
                
                <label for="preco">Preço:</label>
                <input type="text" id="preco" name="preco" placeholder="€0.00">
            </section>
            
            <div class="pictures">
                <h2>Adicionar fotografias (máx 3)</h2>
                <form action="/upload" method="post" enctype="multipart/form-data">
                <input type="file" name="image" accept="image/*" multiple>
    </form>
            </div>

            <button type="submit" class="primary-btn">Vender</button>
        </form>
    </main>
<?php } ?>
