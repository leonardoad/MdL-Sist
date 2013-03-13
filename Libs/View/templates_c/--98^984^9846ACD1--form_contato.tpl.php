<?php /* Smarty version 2.6.26, created on 2012-07-08 22:06:53
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5CTopChaves%5C%5CApplication%5Cviews%5CWeb/form_contato.tpl */ ?>
 
 
<p class="texto">Nome: <br>

                    <?php echo $this->_tpl_vars['nome']; ?>


                </p>

                <p class="texto">Email:  <br>

                    <?php echo $this->_tpl_vars['email']; ?>


                </p>

                <p class="texto">Assunto:  <br>

                    <?php echo $this->_tpl_vars['assunto']; ?>

                </p>

                <p class="texto">Mensagem:<br>

                    <?php echo $this->_tpl_vars['mensagem']; ?>

                </p>
                <p>
                <div class="caixaTexto" style="width: 308px">
                    <a id="btnEnviar" class="btnText" validaobrig="1" sendformfields="1" label="Enviar" event="click" href="#none" name="btnEnviar"> Enviar</a>
                </div>
                </p>

           