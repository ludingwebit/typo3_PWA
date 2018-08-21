<?php

class Standard_action_index_0e6fe57ac459ad2366717da8ad1aeb6136f8cfdc extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getLayoutName(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this; 
return (string) '';
}
public function hasLayout() {
return FALSE;
}
public function addCompiledNamespaces(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$renderingContext->getViewHelperResolver()->addNamespaces(array (
  'core' => 
  array (
    0 => 'TYPO3\\CMS\\Core\\ViewHelpers',
  ),
  'f' => 
  array (
    0 => 'TYPO3Fluid\\Fluid\\ViewHelpers',
    1 => 'TYPO3\\CMS\\Fluid\\ViewHelpers',
  ),
  'formvh' => 
  array (
    0 => 'TYPO3\\CMS\\Form\\ViewHelpers',
  ),
));
}

/**
 * Main Render function
 */
public function render(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '<header>
    <div class="trailer">
        <nav class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="80">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
$array3 = array (
);return $renderingContext->getVariableProvider()->getByPath('logo', $array3);
};
$arguments1 = array();
$arguments1['value'] = NULL;

$output0 .= isset($arguments1['value']) ? $arguments1['value'] : $renderChildrenClosure2();

$output0 .= '
                    <a class="navbar-brand" href="#">
                        <div class="brand-line">';
$array4 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('brandLineFirst', $array4)]);

$output0 .= '</div>
                        <div class="brand-line">';
$array5 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('brandLineSecond', $array5)]);

$output0 .= '</div>
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure7 = function() use ($renderingContext, $self) {
$array8 = array (
);return $renderingContext->getVariableProvider()->getByPath('menuPrimary', $array8);
};
$arguments6 = array();
$arguments6['value'] = NULL;

$output0 .= isset($arguments6['value']) ? $arguments6['value'] : $renderChildrenClosure7();

$output0 .= '
                </div>
            </div>
        </nav>

        <div class="jumbotron">
            <div class="container">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure10 = function() use ($renderingContext, $self) {
$array11 = array (
);return $renderingContext->getVariableProvider()->getByPath('contentTrailer', $array11);
};
$arguments9 = array();
$arguments9['value'] = NULL;

$output0 .= isset($arguments9['value']) ? $arguments9['value'] : $renderChildrenClosure10();

$output0 .= '</div>
        </div>
    </div>

    <div class="infobar">
        <div class="container">
            <div class="pull-right search">
                <form class="form-inline" action="';
$array12 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('searchUrl', $array12)]);

$output0 .= '" method="post">
                    <div class="input-group">
                        <input type="text" name="tx_indexedsearch[sword]" class="form-control"
                               placeholder="';
$array13 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('labelSearchPlaceholder', $array13)]);

$output0 .= '"/>
                        <span class="input-group-btn">
              <button type="submit" class="btn btn-success">
                <i class="glyphicon glyphicon-search"></i>
                ';
$array14 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('labelSearch', $array14)]);

$output0 .= '
              </button>
            </span>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="print">
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure16 = function() use ($renderingContext, $self) {
$array17 = array (
);return $renderingContext->getVariableProvider()->getByPath('print', $array17);
};
$arguments15 = array();
$arguments15['value'] = NULL;

$output0 .= isset($arguments15['value']) ? $arguments15['value'] : $renderChildrenClosure16();

$output0 .= '
            </div>
            <div class="language">
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure19 = function() use ($renderingContext, $self) {
$array20 = array (
);return $renderingContext->getVariableProvider()->getByPath('language', $array20);
};
$arguments18 = array();
$arguments18['value'] = NULL;

$output0 .= isset($arguments18['value']) ? $arguments18['value'] : $renderChildrenClosure19();

$output0 .= '
            </div>
            Sie sind hier: ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure22 = function() use ($renderingContext, $self) {
$array23 = array (
);return $renderingContext->getVariableProvider()->getByPath('menuBreadcrumb', $array23);
};
$arguments21 = array();
$arguments21['value'] = NULL;

$output0 .= isset($arguments21['value']) ? $arguments21['value'] : $renderChildrenClosure22();

$output0 .= '
        </div>
    </div>
</header>

<main class="container">
    <div class="row">
        <button id="hello-button">Hello-Button</button>
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure25 = function() use ($renderingContext, $self) {
$output40 = '';

$output40 .= '
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure42 = function() use ($renderingContext, $self) {
$output43 = '';

$output43 .= '
                <div class="col-md-8 content-main">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure45 = function() use ($renderingContext, $self) {
$array46 = array (
);return $renderingContext->getVariableProvider()->getByPath('contentMain', $array46);
};
$arguments44 = array();
$arguments44['value'] = NULL;

$output43 .= isset($arguments44['value']) ? $arguments44['value'] : $renderChildrenClosure45();

$output43 .= '</div>
                <div class="col-md-4 content-margin">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure48 = function() use ($renderingContext, $self) {
$array49 = array (
);return $renderingContext->getVariableProvider()->getByPath('contentMargin', $array49);
};
$arguments47 = array();
$arguments47['value'] = NULL;

$output43 .= isset($arguments47['value']) ? $arguments47['value'] : $renderChildrenClosure48();

$output43 .= '</div>
            ';
return $output43;
};
$arguments41 = array();

$output40 .= '';

$output40 .= '
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure51 = function() use ($renderingContext, $self) {
$output52 = '';

$output52 .= '
                <div class="col-md-12 content-main">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure54 = function() use ($renderingContext, $self) {
$array55 = array (
);return $renderingContext->getVariableProvider()->getByPath('contentMain', $array55);
};
$arguments53 = array();
$arguments53['value'] = NULL;

$output52 .= isset($arguments53['value']) ? $arguments53['value'] : $renderChildrenClosure54();

$output52 .= '</div>
            ';
return $output52;
};
$arguments50 = array();
$arguments50['if'] = NULL;

$output40 .= '';

$output40 .= '
        ';
return $output40;
};
$arguments24 = array();
$arguments24['then'] = NULL;
$arguments24['else'] = NULL;
$arguments24['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array37 = array();
$array38 = array (
);$array37['0'] = $renderingContext->getVariableProvider()->getByPath('contentMargin', $array38);

$expression39 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments24['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression39(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array37)
					),
					$renderingContext
				);
$arguments24['__thenClosure'] = function() use ($renderingContext, $self) {
$output26 = '';

$output26 .= '
                <div class="col-md-8 content-main">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure28 = function() use ($renderingContext, $self) {
$array29 = array (
);return $renderingContext->getVariableProvider()->getByPath('contentMain', $array29);
};
$arguments27 = array();
$arguments27['value'] = NULL;

$output26 .= isset($arguments27['value']) ? $arguments27['value'] : $renderChildrenClosure28();

$output26 .= '</div>
                <div class="col-md-4 content-margin">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure31 = function() use ($renderingContext, $self) {
$array32 = array (
);return $renderingContext->getVariableProvider()->getByPath('contentMargin', $array32);
};
$arguments30 = array();
$arguments30['value'] = NULL;

$output26 .= isset($arguments30['value']) ? $arguments30['value'] : $renderChildrenClosure31();

$output26 .= '</div>
            ';
return $output26;
};
$arguments24['__elseClosures'][] = function() use ($renderingContext, $self) {
$output33 = '';

$output33 .= '
                <div class="col-md-12 content-main">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure35 = function() use ($renderingContext, $self) {
$array36 = array (
);return $renderingContext->getVariableProvider()->getByPath('contentMain', $array36);
};
$arguments34 = array();
$arguments34['value'] = NULL;

$output33 .= isset($arguments34['value']) ? $arguments34['value'] : $renderChildrenClosure35();

$output33 .= '</div>
            ';
return $output33;
};

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments24, $renderChildrenClosure25, $renderingContext);

$output0 .= '
        <div class="row">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure57 = function() use ($renderingContext, $self) {
$output60 = '';

$output60 .= '
                <div class="col-md-4">
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure62 = function() use ($renderingContext, $self) {
$array63 = array (
);return $renderingContext->getVariableProvider()->getByPath('contentUserlist', $array63);
};
$arguments61 = array();
$arguments61['value'] = NULL;

$output60 .= isset($arguments61['value']) ? $arguments61['value'] : $renderChildrenClosure62();

$output60 .= '
                </div>
            ';
return $output60;
};
$arguments56 = array();
$arguments56['then'] = NULL;
$arguments56['else'] = NULL;
$arguments56['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array58 = array();
$array58['0'] = 'contentUserlist';

$expression59 = function($context) {return "contentUserlist";};
$arguments56['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression59(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array58)
					),
					$renderingContext
				);
$arguments56['__thenClosure'] = $renderChildrenClosure57;

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments56, $renderChildrenClosure57, $renderingContext);

$output0 .= '
        </div>
    </div>
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h4>';
$array64 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('labelNews', $array64)]);

$output0 .= '</h4>
                <aside class="row">
                    <div class="col-md-4 date-wrapper">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure66 = function() use ($renderingContext, $self) {
$array67 = array (
);return $renderingContext->getVariableProvider()->getByPath('labelToday', $array67);
};
$arguments65 = array();
$arguments65['value'] = NULL;

$output0 .= isset($arguments65['value']) ? $arguments65['value'] : $renderChildrenClosure66();

$output0 .= '
                        <div class="date">';
$array68 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('today', $array68)]);

$output0 .= '</div>
                    </div>
                    <div class="col-md-8 news-wrapper">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure70 = function() use ($renderingContext, $self) {
$array71 = array (
);return $renderingContext->getVariableProvider()->getByPath('footerNews', $array71);
};
$arguments69 = array();
$arguments69['value'] = NULL;

$output0 .= isset($arguments69['value']) ? $arguments69['value'] : $renderChildrenClosure70();

$output0 .= '
                    </div>
                </aside>
            </div>
            <div class="col-md-4">
                <h4>';
$array72 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('labelMore', $array72)]);

$output0 .= '</h4>
                <nav>';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure74 = function() use ($renderingContext, $self) {
$array75 = array (
);return $renderingContext->getVariableProvider()->getByPath('menuSecondary', $array75);
};
$arguments73 = array();
$arguments73['value'] = NULL;

$output0 .= isset($arguments73['value']) ? $arguments73['value'] : $renderChildrenClosure74();

$output0 .= '</nav>
            </div>
        </div>
    </div>
</footer>
';

return $output0;
}


}
#