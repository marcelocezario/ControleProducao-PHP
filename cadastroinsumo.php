<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cadastro Insumo</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
</head>

<body>
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Controle de Produção</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="cadastroinsumo.html">Cadastro Insumo</a>
                    </li>
            </div>
        </nav>
    </header>

    <main role="main" class="container">
        <form method="POST">
            <div class="form-group">
                <label for="insumo">Nome do insumo</label>
                <input type="text" class="form-control" name="insumo" id="nome" placeholder="Digite o nome do Insumo">
            </div>

            <div class="form-group">
                <label for="unidadeDeMedida">Unidade de medida</label>
                <select class="form-control" id="unidadeDeMedida" name="unidadeDeMedida">
                    <option value="" disabled selected>Selecione uma unidade de medida</option>
                    <option value="1">Gramas - g</option>
                    <option value="2">Litros - L</option>
                    <option value="3">Mililitro - Ml</option>
                    <option value="4">Quilos - Kg</option>
                    <option value="5">Unidade - Un</option>
                </select>
              </div>

            

            <input type="submit" value="Salvar" class="btn btn-primary" /> 
        </form>

        <table class="table">
            <tr>
            <th>ID</th>
            <th>Nome Insumo</th>
            <th>Unidade de Medida</th>
</tr>
                

    </main>
    <footer class="footer">
        <div class="container">
            <p>&copy; Marcelo Henrique Cezario e Gabryel J. Boeira 2018. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- JavaScript-->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>