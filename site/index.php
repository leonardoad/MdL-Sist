<?php
/**
 * Arquivo principal da aplicação
 * Define todos os caminhos onde os arquivos est�o armazenados,
 * todos os includes necess�rios e todos os componentes que a
 * aplicao utilizará.
 * Respons�vel por inicializar a aplicação, ele invoca os
 * arquivos de controlador que s�o responsáveis pelo funcionamento
 * da aplica��o.
 *  @filesource
 * @author			Ismael Sleifer
 * @copyright		Ismael Sleifer Web Designer
 * @package			zendframework
 * @subpackage		zendframework.system
 * @version			1.0
 */
error_reporting(E_ALL ^ E_NOTICE | E_STRICT);

// BASE eh o caminho apartir da raiz do site(Ex.: na locaweb e o "public_htm", mas o caminho fica sem o "public_html")
define('BASE', 'mdlsiste');  

// HTTP_HOST eh endereco web do site ex: "http://facebook.com"
define('HTTP_HOST', 'http://' . $_SERVER['HTTP_HOST']);

$operatingSystem = stripos($_SERVER['SERVER_SOFTWARE'], 'win32') !== FALSE ? 'WINDOWS' : 'LINUX';
$bar = $operatingSystem == 'WINDOWS' ? '\\' : '/';
$pathSeparator = $operatingSystem == 'WINDOWS' ? ';' : ':';
$documentRoot = $operatingSystem == 'WINDOWS' ? str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT'];

define('RAIZ_DIRETORY', $documentRoot . $bar . BASE . $bar);
$applicationName = basename(getcwd()) . $bar;
if ($operatingSystem == 'WINDOWS') {
    $path = $pathSeparator . RAIZ_DIRETORY . 'Libs';
    $path .= $pathSeparator . RAIZ_DIRETORY . $applicationName . 'Application' . $bar . 'Models';
    $path .= $pathSeparator . RAIZ_DIRETORY . $applicationName . 'Application' . $bar . 'ModelsView';
} else {
    $path = $pathSeparator . RAIZ_DIRETORY . 'Libs';
    $path .= $pathSeparator . RAIZ_DIRETORY . $applicationName . 'Application' . $bar . 'Models';
    $path .= $pathSeparator . RAIZ_DIRETORY . $applicationName . 'Application' . $bar . 'ModelsView';
}
set_include_path(get_include_path() . $path);

include 'Constantes.php';
include RAIZ_DIRETORY . $applicationName . 'Application/Constantes.php';

include 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

Zend_Registry::set('js', array());
Zend_Registry::set('css', array());

Browser_Control::setScript('js', 'Jquery', 'jquery.js');
Browser_Control::setScript('js', 'BorwserControl', '../Browser/Control.js');
Browser_Control::setScript('js', 'Principal', 'Principal.js');
Browser_Control::setScript('js', 'Tabs', 'Ui/Ui.js');
Browser_Control::setScript('css', 'Tabs', 'Ui/Ui.css');
Browser_Control::setScript('js', 'Button', 'Button/Button.js');
Browser_Control::setScript('js', 'Flexigrid', 'Flexigrid/Flexigrid.js');
Browser_Control::setScript('css', 'Flexigrid', 'Flexigrid/Flexigrid.css');
Browser_Control::setScript('css', 'Button', 'Button/Button.css');
Browser_Control::setScript('css', 'Principal', '../Css/Principal.css');

/* coloca numa lista a URL */
$array = explode('/', $_SERVER['REQUEST_URI']);

$base = explode('/', BASE);

//print'<pre>';
//die(print_r($base));

if (count($base) > 1) {
    $pos = count($base)  ;
} else {
    $pos = 0;
}

if (count($_POST) > 0) {
    $post = $_POST;
}
//print'<pre>';
//die(print_r(count($array) . " > (5 + $pos)"));

/* tudo que tiver depois do endereço padrao é parametro. */
if (count($array) > (5 + $pos)) {
    for ($i = (5 + $pos); $i < count($array); $i++) {
        $post[$array[$i]] = rawurldecode($array[++$i]);
    }
}

Zend_Registry::set('post', new Zend_Filter_Input(NULL, NULL, $post));
Zend_Registry::set('get', new Zend_Filter_Input(NULL, NULL, $_GET));

/** Configurções das visões */
$view = new View_Smarty();
$view->setEncoding('UTF-8');
$view->setEscape('htmlentities');
$view->addHelperPath('../Libs/View/Helpers');
$view->assign('baseUrl', BASE_URL);

// HTTP_REFERER eh o endereco web do site ou sistema mais a URL base que é a pasta dentro do servidor em q se encontra os site ou sistema.
define('HTTP_REFERER', HTTP_HOST . BASE_URL);
$view->assign('HTTP_REFERER', HTTP_REFERER);


$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
$viewRenderer->setNeverRender(); // desabilita todas as renderizações das paginas
$viewRenderer->setView($view);
Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);

$view->setTemplateDir($applicationName);
Zend_Registry::set('view', $view);

Zend_Session::start();

Zend_Registry::set('session', new Zend_Session_Namespace());

$baseUrl = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], '/index.php'));

$frontController = Zend_Controller_Front::getInstance();

$frontController->setbaseUrl($baseUrl);

$frontController->throwExceptions(TRUE);

$config = new Zend_Config_Ini('./Application/Config.ini', 'database');

Zend_Registry::set('config', $config);

$db = Zend_Db::factory($config->db->adapter, $config->db->config->toArray());
Zend_Db_Table_Abstract::setDefaultAdapter($db);

###############  SOMENTE USAR EM AMBIENTE DE DESENVOLVIMENTO  #####################
//$profiler = new Zend_Db_Profiler_Firebug('SQL');
$profiler = new Zend_Db_Profiler;
$profiler->setEnabled(true);
$db->setProfiler($profiler);
###################################################################################

Zend_Registry::set('db', $db);


############################ SEGURANÇA DO SISTEMA #########################
//print'<pre>';die(print_r($pos ));
//$controller = $array[3];
//$act = $array[4];
$controller = $array[$pos+2];
$act = $array[$pos+3];

$session = Zend_Registry::get('session');

if ($controller == null) {
    $controller = 'webindex';
}

if ($act == null) {
    $act = 'index';
}

Zend_Registry::set('controller', $controller);
Zend_Registry::set('act', $act);

$web = substr($controller, 0, 3);

if (strcasecmp($web, 'web') != 0) {
    $flag = true;
    $frontController->setControllerDirectory('./Application/Controllers');
} else {
    $flag = false;
    $frontController->setControllerDirectory('./Application/ControllersWeb');
}

//die("$controller == 'Arquivo' && $act == 'upload'");
// usando pois quando e feito o upload com o componente em flash da erro 302
if ($controller == 'Arquivo' && $act == 'upload') {
    $flag = false;
}

function setBrowserUrl($ctrl, $array,$pos = 0) {
//    print'<pre>';
//    die(print_r(count($array)));
    $html = "<script type='text/javascript'>";
    if (count($array) < 5+ $pos) {
        $html .="window.parent.location = './" . $ctrl . "';";
    } else {
        for ($i = 4; $i < count($array); $i++) {
            $pontos .= '../';
        }
        $html .="window.parent.location = '" . $pontos . $ctrl . "';";
    }
    $html .="</script>";
//    print'<pre>';
//    die(print_r($html));
    return $html;
}

//print'<pre>';die(print_r( $controller ));
if ($flag) {
    if (strcasecmp($controller, 'login') != 0) {
        if (!isset($session->usuario)) {
            $post = Zend_Registry::get('post');
            if (!isset($post->ajax)) {
                echo setBrowserUrl('login', $array,$pos);
                exit;
            } else {
                $br = new Browser_Control();
                $br->setBrowserUrl('./login', $array);
                $br->send();
                exit;
            }
        } else if (strcasecmp($controller, 'index') != 0) {
            if (!isset($post->ajax)) {
                if (!Usuario::verificaAcesso($controller)) {
                    Log::createLog('', 'Acesso ao controlador "' . $controller . '" negado', cLOG_ACESSO_NEGADO);
                    echo setBrowserUrl('index', $array);
                    exit;
                }
            } else {
                if (!Usuario::verificaAcesso($controller)) {
                    Log::createLog('', 'Acesso ao controlador "' . $controller . '" negado', cLOG_ACESSO_NEGADO);
                    $br = new Browser_Control();
                    $br->setBrowserUrl('./index', $array);
                    $br->send();
                    exit;
                }
            }
        }
    }
}
#####################################################################################################################

setlocale(LC_MONETARY, 'ptb');

date_default_timezone_set('America/Sao_Paulo');

//$frontController->setParam('useCaseSensitiveActions', TRUE);

$frontController->dispatch();