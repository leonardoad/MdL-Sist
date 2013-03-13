<?php /* Smarty version 2.6.26, created on 2012-06-26 10:56:13
         compiled from C:%5Cxampp%5Chtdocs%5CProjetos%5C%5COpertur%5C%5CApplication%5Cviews%5CWeb/centro_home.tpl */ ?>
 
<table border="0">
             
            <tbody>
                <tr >
                    <td  style="width:400px">
                        <p class="titulo">Quem Somos</p>
                        <img src="./Public/Images/capa_frente.jpg" />
                        <p class="texto"><b>A TOP CHAVES</b> &Eacute; UMA EMPRESA EM QUE ATUA A MAIS 10 ANOS NO RAMO DE PRESTA&Ccedil;&Atilde;O EM SERVI&Ccedil;OS DE CHAVEIRO, AUTOMA&Ccedil;&Atilde;O E SISTEMAS DE SEGURAN&Ccedil;A, DESTACA-SE PELA APRESENTA&Ccedil;&Atilde;O CONSTANTE DE NOVAS TECNOLOGIAS EM TODOS OS SEGMENTOS QUE ENVOLVEM SEGURAN&Ccedil;A, AL&Eacute;M DE CONTAR COM AS MELHORES MARCA DO MERCADO, POSSUÍMOS ATENDIMENTO PERSONALIZADO COM ESTACIONAMENTO PRÓPRIO.  TENDO EM VISTA TANTOS FATORES DE  RISCO EM QUE VIVEMOS A TOP CHAVES, ESTÁ COMPROMETIDA COM PROFISSIONAIS ESPECIALIZADOS COM TOTAL  CREDIBILIDADE  PARA ATENDER AS NECESSIDADES DE CADA CLIENTE.</p>
                    </td>
                    <td style="vertical-align: top">
                        <p class="titulo">Produtos</p>
                        <?php echo $this->_tpl_vars['produtos_destaque']; ?>

                        <a href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
web/tabelaprodutos"><div class="caixaTexto" style="float: right;vertical-align: bottom">Ver todos</div></a>
                    </td>
                </tr>
                
            </tbody>
        </table>