<?php /* Smarty version 2.6.26, created on 2013-03-13 14:43:19
         compiled from /var/www/desenv/testes/TopChaves/Site//site//Application/views/Web/centro_home.tpl */ ?>
 
<table border="0">
             
            <tbody>
                <tr >
                    <td  style="width:400px">
                        <p class="titulo">Quem Somos</p>
                        <img src="./Public/Images/capa_frente.jpg" />
                        <p class="texto">
                            A <b>Top Chaves</b> é uma empresa em que atua a mais 10 anos no ramo de prestação em serviços de chaveiro, automação e sistemas de segurança, destaca-se pela apresentação constante de novas tecnologias em todos os segmentos que envolvem segurança, além de contar com as melhores marca do mercado, possuímos atendimento personalizado com estacionamento próprio.
                            <BR><BR>
Tendo em vista tantos fatores de  risco em que vivemos a Top Chaves, está comprometida com profissionais especializados com total  credibilidade  para atender as necessidades de cada cliente.
                        </p>
                    </td>
                    <td style="vertical-align: top ;padding-left: 40px;">
                        <p class="titulo">Produtos</p>
                        <?php echo $this->_tpl_vars['produtos_destaque']; ?>

                        <a href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
web/tabelaprodutos"><div class="caixaTexto" style="float: right;vertical-align: bottom">Ver todos</div></a>
                    </td>
                </tr>
                
            </tbody>
        </table>