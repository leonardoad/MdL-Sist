<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <title>{$tituloPagina} - Top Chaves</title>




        <link rel="shortcut icon" href="{$HTTP_REFERER}Public/Images/favicon.ico" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <!--        <script type="text/javascript" src="/Projetos/Libs/Scripts/jquery.js"></script>
        -->       <script type="text/javascript" src="{$HTTP_REFERER}Public/Js/PrettyPhoto.js"></script>
        <!--        <script type="text/javascript" src="/Projetos/Libs/Scripts/../Browser/Control.js"></script>-->
        <link rel="stylesheet" href="{$HTTP_REFERER}Public/Css/PrettyPhoto.css" type="text/css" charset="utf-8" />
        <script type="text/javascript" charset="utf-8">
            {literal}
            jQuery(document).ready(function(){
                jQuery("a[rel^='prettyPhoto']").prettyPhoto();
            });
            {/literal} 
        </script>
        <script type="text/javascript" src="{$HTTP_REFERER}Public/Js/fadeslideshow.js">
        
        

            /***********************************************
             * Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
             * This notice MUST stay intact for legal use
             * Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
             ***********************************************/

        </script>
        <script type="text/javascript">
            {literal} 
            var mygallery = new fadeSlideShow({
                wrapperid: "banner1", //ID of blank DIV on page to house Slideshow
                dimensions: [330, 100], //width/height of gallery in pixels. Should reflect dimensions of largest image
                imagearray: [
                    {/literal} {$imagensBanner1}{literal}
                ],
                displaymode: {type:'auto', pause:2500, cycles:0, wraparound:false},
                persist: false, //remember last viewed slide and recall within same session?
                fadeduration: 500, //transition duration (milliseconds)
                descreveal: "ondemand",
                togglerid: ""
            }) ;
            
            var mygallery2 = new fadeSlideShow({
                wrapperid: "banner2", //ID of blank DIV on page to house Slideshow
                dimensions: [850, 100], //width/height of gallery in pixels. Should reflect dimensions of largest image
                imagearray: [
                    {/literal}    {$imagensBanner2}{literal}
                ],
                displaymode: {type:'auto', pause:2500, cycles:0, wraparound:false},
                persist: false, //remember last viewed slide and recall within same session?
                fadeduration: 500, //transition duration (milliseconds)
                descreveal: "ondemand",
                togglerid: ""
            }) ;
           
            {/literal}

        </script>
        <script type="text/javascript">
            //var cBaseUrl = '/Projetos/Opertur/';
            eval("base = '{$baseUrl}'");
            var cBaseUrl = '{$baseUrl}';
//            
//            {literal}
//            jQuery('#btnBusca').click(function(){
//                document.location  = ("Projetos/TopChaves/web/tabelaprodutos/busca/" + jQuery('#busca').val());
//            });
//            {/literal}
//            
            {literal}
            function direciona(url){
                document.location  = ("{/literal}{$HTTP_REFERER}{literal}web/tabelaprodutos/busca/" + jQuery('#fieldBusca').val() );
            }
            {/literal}
        </script>

        {$scripts}


        <link rel="stylesheet" href="{$HTTP_REFERER}Public/Css/Web.css">
    </head>

    <body>
        <div id="header">
            <div id="lema">ESPECIALIZADA NA LINHA <br> AUTOMOTIVA E RESIDENCIAL</div>
            <div id="banner1"></div>
            <div id="telefone"></div>
            <div id="logo"></div>
            <div id="tituloPagina" class="titulo">{$tituloPagina}</div>
            <div id="busca"> <input type="text" class="busca" name="busca" id="fieldBusca" /><a id="btnBusca" onclick="direciona()"  >&nbsp;</a> </div>
        </div>
        <div   id="menu">
            <div id="menu2">
                <div>
                    <a title="" href="{$HTTP_REFERER}" class="link ">
                        <span >Home </span>
                    </a>
                </div>
                <div>
                    <a title="" href="{$HTTP_REFERER}web/tabelaprodutos" class="link ">
                        <span >Produtos</span>
                    </a>
                </div>
                <div style="width: 320px">
                    &nbsp;
                </div>
                <div>
                    <a title="" href="{$HTTP_REFERER}Web/Servicos" class="link ">
                        <span >Servi&ccedil;os</span>
                    </a>
                </div>
                <div>
                    <a title="" href="{$HTTP_REFERER}Web/contato" class="link ">
                        <span >Contato</span>
                    </a>
                </div>
            </div>
        </div>


        <div id="conteiner" >
            <div id="conteudo">{$conteudo}</div>

            <div id="banner2">850px x 100px;</div><br>
        </div>
        <div id="footer">Endere&ccedil;o: Av. Cel. Lucas de Oliveira , n&ordm; 2093 Bairro Petr&oacute;polis, POA, RS | Cep: 90460-001 | Fones: 9987.6469 - 3333.3900 - 3012.0300</div>
    </body>

</html>