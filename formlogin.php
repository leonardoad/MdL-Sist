<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Formul&aacute;rio de Autentica&ccedil;&atilde;o</title>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
    </head>
    <body>
        <div class="conteiner">
            <!-- Imagem de animação do processamento -->
            <div class="cabecalho">
                <div id="logo"></div>
            </div>
            <div>
            <div class="msg" ><?php echo @$_GET['msg'] ?></div>
            <fieldset style="width: 350px;margin: auto">
                <legend>Preencha com seu Usu&aacute;rio e Senha</legend>
                <form action="login.php" method="post">

                    <label for="email">Usu&aacute;rio: </label>
                    <input type="text" id="login" name="login" /><br />

                    <label for="senha">Senha: </label>
                    <input type="password" id="senha" name="senha" /><br />

                    <input type="submit" name="acao" value="OK" />

                </form>
            </fieldset>
            </div>
            
        </div>
        <div class="footer"><p>Todos os direitos reservados - Leonardo Danieli - leonardo.danieli@gmail.com</p></div>
   
    </body>
</html>
