<?php /* Smarty version 2.6.26, created on 2013-03-13 14:43:19
         compiled from /var/www/desenv/testes/TopChaves/Site//site//Application/views/Web/index.tpl */ ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $this->_tpl_vars['tituloPagina']; ?>
 - Top Chaves</title>




        <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
Public/Images/favicon.ico" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <!--        <script type="text/javascript" src="/Projetos/Libs/Scripts/jquery.js"></script>
        -->       <script type="text/javascript" src="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
Public/Js/PrettyPhoto.js"></script>
        <!--        <script type="text/javascript" src="/Projetos/Libs/Scripts/../Browser/Control.js"></script>-->
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
Public/Css/PrettyPhoto.css" type="text/css" charset="utf-8" />
        <script type="text/javascript" charset="utf-8">
            <?php echo '
            jQuery(document).ready(function(){
                jQuery("a[rel^=\'prettyPhoto\']").prettyPhoto();
            });
            '; ?>
 
        </script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
Public/Js/fadeslideshow.js">
        
        

            /***********************************************
             * Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
             * This notice MUST stay intact for legal use
             * Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
             ***********************************************/

        </script>
        <script type="text/javascript">
            <?php echo ' 
            var mygallery = new fadeSlideShow({
                wrapperid: "banner1", //ID of blank DIV on page to house Slideshow
                dimensions: [330, 100], //width/height of gallery in pixels. Should reflect dimensions of largest image
                imagearray: [
                    '; ?>
 <?php echo $this->_tpl_vars['imagensBanner1']; ?>
<?php echo '
                ],
                displaymode: {type:\'auto\', pause:2500, cycles:0, wraparound:false},
                persist: false, //remember last viewed slide and recall within same session?
                fadeduration: 500, //transition duration (milliseconds)
                descreveal: "ondemand",
                togglerid: ""
            }) ;
            
            var mygallery2 = new fadeSlideShow({
                wrapperid: "banner2", //ID of blank DIV on page to house Slideshow
                dimensions: [850, 100], //width/height of gallery in pixels. Should reflect dimensions of largest image
                imagearray: [
                    '; ?>
    <?php echo $this->_tpl_vars['imagensBanner2']; ?>
<?php echo '
                ],
                displaymode: {type:\'auto\', pause:2500, cycles:0, wraparound:false},
                persist: false, //remember last viewed slide and recall within same session?
                fadeduration: 500, //transition duration (milliseconds)
                descreveal: "ondemand",
                togglerid: ""
            }) ;
           
            '; ?>


        </script>
        <script type="text/javascript">
            //var cBaseUrl = '/Projetos/Opertur/';
            eval("base = '<?php echo $this->_tpl_vars['baseUrl']; ?>
'");
            var cBaseUrl = '<?php echo $this->_tpl_vars['baseUrl']; ?>
';
//            
//            <?php echo '
//            jQuery(\'#btnBusca\').click(function(){
//                document.location  = ("Projetos/TopChaves/web/tabelaprodutos/busca/" + jQuery(\'#busca\').val());
//            });
//            '; ?>

//            
            <?php echo '
            function direciona(url){
                document.location  = ("'; ?>
<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
<?php echo 'web/tabelaprodutos/busca/" + jQuery(\'#fieldBusca\').val() );
            }
            '; ?>

        </script>

        <?php echo $this->_tpl_vars['scripts']; ?>



        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
Public/Css/Web.css">
    </head>

    <body>
        <div id="header">
            <div id="lema">ESPECIALIZADA NA LINHA <br> AUTOMOTIVA E RESIDENCIAL</div>
            <div id="banner1"></div>
            <div id="telefone"></div>
            <div id="logo"></div>
            <div id="tituloPagina" class="titulo"><?php echo $this->_tpl_vars['tituloPagina']; ?>
</div>
            <div id="busca"> <input type="text" class="busca" name="busca" id="fieldBusca" /><a id="btnBusca" onclick="direciona()"  >&nbsp;</a> </div>
        </div>
        <div   id="menu">
            <div id="menu2">
                <div>
                    <a title="" href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
" class="link ">
                        <span >Home </span>
                    </a>
                </div>
                <div>
                    <a title="" href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
web/tabelaprodutos" class="link ">
                        <span >Produtos</span>
                    </a>
                </div>
                <div style="width: 320px">
                    &nbsp;
                </div>
                <div>
                    <a title="" href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
Web/Servicos" class="link ">
                        <span >Servi&ccedil;os</span>
                    </a>
                </div>
                <div>
                    <a title="" href="<?php echo $this->_tpl_vars['HTTP_REFERER']; ?>
Web/contato" class="link ">
                        <span >Contato</span>
                    </a>
                </div>
            </div>
        </div>


        <div id="conteiner" >
            <div id="conteudo"><?php echo $this->_tpl_vars['conteudo']; ?>
</div>

            <div id="banner2">850px x 100px;</div><br>
        </div>
        <div id="footer">Endere&ccedil;o: Av. Cel. Lucas de Oliveira , n&ordm; 2093 Bairro Petr&oacute;polis, POA, RS | Cep: 90460-001 | Fones: 9987.6469 - 3333.3900 - 3012.0300</div>
    </body>

</html>