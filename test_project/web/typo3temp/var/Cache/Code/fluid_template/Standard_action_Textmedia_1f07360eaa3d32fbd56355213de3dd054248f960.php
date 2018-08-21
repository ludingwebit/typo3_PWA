<?php

class Standard_action_Textmedia_1f07360eaa3d32fbd56355213de3dd054248f960 extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getLayoutName(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this; 
return (string) 'Default';
}
public function hasLayout() {
return TRUE;
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
 * section Header
 */
public function section_31341c6f0c7af677ffb8fadcb92038e8ac2b6193(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '

	';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
$output6 = '';

$output6 .= '
		';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure8 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments7 = array();
$arguments7['section'] = NULL;
$arguments7['partial'] = NULL;
$arguments7['delegate'] = NULL;
$arguments7['renderable'] = NULL;
$arguments7['arguments'] = array (
);
$arguments7['optional'] = false;
$arguments7['default'] = NULL;
$arguments7['contentAs'] = NULL;
$arguments7['partial'] = 'Header/All';
$arguments7['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output6 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments7, $renderChildrenClosure8, $renderingContext);

$output6 .= '
	';
return $output6;
};
$arguments1 = array();
$arguments1['then'] = NULL;
$arguments1['else'] = NULL;
$arguments1['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array3 = array();
$array4 = array (
);$array3['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array4);
$array3['1'] = ' != 1';

$expression5 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) != 1);};
$arguments1['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression5(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array3)
					),
					$renderingContext
				);
$arguments1['__thenClosure'] = $renderChildrenClosure2;

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments1, $renderChildrenClosure2, $renderingContext);

$output0 .= '

';

return $output0;
}
/**
 * section Main
 */
public function section_62bce9422ff2d14f69ab80a154510232fc8a9afd(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output10 = '';

$output10 .= '

	<div class="ce-textpic ce-';
$array11 = array (
);
$output10 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('gallery.position.horizontal', $array11)]);

$output10 .= ' ce-';
$array12 = array (
);
$output10 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('gallery.position.vertical', $array12)]);
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure14 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments13 = array();
$arguments13['then'] = NULL;
$arguments13['else'] = NULL;
$arguments13['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array15 = array();
$array16 = array (
);$array15['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array16);

$expression17 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments13['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression17(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array15)
					),
					$renderingContext
				);
$arguments13['then'] = ' ce-nowrap';

$output10 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments13, $renderChildrenClosure14, $renderingContext);

$output10 .= '">
		';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure19 = function() use ($renderingContext, $self) {
$output23 = '';

$output23 .= '
			';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure25 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments24 = array();
$arguments24['section'] = NULL;
$arguments24['partial'] = NULL;
$arguments24['delegate'] = NULL;
$arguments24['renderable'] = NULL;
$arguments24['arguments'] = array (
);
$arguments24['optional'] = false;
$arguments24['default'] = NULL;
$arguments24['contentAs'] = NULL;
$arguments24['partial'] = 'Media/Gallery';
$arguments24['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output23 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments24, $renderChildrenClosure25, $renderingContext);

$output23 .= '
		';
return $output23;
};
$arguments18 = array();
$arguments18['then'] = NULL;
$arguments18['else'] = NULL;
$arguments18['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array20 = array();
$array21 = array (
);$array20['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.vertical', $array21);
$array20['1'] = ' != \'below\'';

$expression22 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) != 'below');};
$arguments18['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression22(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array20)
					),
					$renderingContext
				);
$arguments18['__thenClosure'] = $renderChildrenClosure19;

$output10 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments18, $renderChildrenClosure19, $renderingContext);

$output10 .= '

		';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure28 = function() use ($renderingContext, $self) {
$output61 = '';

$output61 .= '
			';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure63 = function() use ($renderingContext, $self) {
$output64 = '';

$output64 .= '
				<div class="ce-bodytext">
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure66 = function() use ($renderingContext, $self) {
$output70 = '';

$output70 .= '
						';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure72 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments71 = array();
$arguments71['section'] = NULL;
$arguments71['partial'] = NULL;
$arguments71['delegate'] = NULL;
$arguments71['renderable'] = NULL;
$arguments71['arguments'] = array (
);
$arguments71['optional'] = false;
$arguments71['default'] = NULL;
$arguments71['contentAs'] = NULL;
$arguments71['partial'] = 'Header/All';
$arguments71['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output70 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments71, $renderChildrenClosure72, $renderingContext);

$output70 .= '
					';
return $output70;
};
$arguments65 = array();
$arguments65['then'] = NULL;
$arguments65['else'] = NULL;
$arguments65['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array67 = array();
$array68 = array (
);$array67['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array68);

$expression69 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments65['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression69(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array67)
					),
					$renderingContext
				);
$arguments65['__thenClosure'] = $renderChildrenClosure66;

$output64 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments65, $renderChildrenClosure66, $renderingContext);

$output64 .= '
					';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper
$renderChildrenClosure75 = function() use ($renderingContext, $self) {
$array76 = array (
);return $renderingContext->getVariableProvider()->getByPath('data.bodytext', $array76);
};
$arguments74 = array();
$arguments74['parseFuncTSPath'] = 'lib.parseFunc_RTE';

$output64 .= TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper::renderStatic($arguments74, $renderChildrenClosure75, $renderingContext);

$output64 .= '
				</div>
			';
return $output64;
};
$arguments62 = array();

$output61 .= '';

$output61 .= '
			';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure78 = function() use ($renderingContext, $self) {
$output79 = '';

$output79 .= '
				';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure81 = function() use ($renderingContext, $self) {
$output85 = '';

$output85 .= '
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure87 = function() use ($renderingContext, $self) {
$output91 = '';

$output91 .= '
						<div class="ce-bodytext">
							';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure93 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments92 = array();
$arguments92['section'] = NULL;
$arguments92['partial'] = NULL;
$arguments92['delegate'] = NULL;
$arguments92['renderable'] = NULL;
$arguments92['arguments'] = array (
);
$arguments92['optional'] = false;
$arguments92['default'] = NULL;
$arguments92['contentAs'] = NULL;
$arguments92['partial'] = 'Header/All';
$arguments92['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output91 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments92, $renderChildrenClosure93, $renderingContext);

$output91 .= '
						</div>
					';
return $output91;
};
$arguments86 = array();
$arguments86['then'] = NULL;
$arguments86['else'] = NULL;
$arguments86['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array88 = array();
$array89 = array (
);$array88['0'] = $renderingContext->getVariableProvider()->getByPath('data.header', $array89);

$expression90 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments86['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression90(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array88)
					),
					$renderingContext
				);
$arguments86['__thenClosure'] = $renderChildrenClosure87;

$output85 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments86, $renderChildrenClosure87, $renderingContext);

$output85 .= '
				';
return $output85;
};
$arguments80 = array();
$arguments80['then'] = NULL;
$arguments80['else'] = NULL;
$arguments80['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array82 = array();
$array83 = array (
);$array82['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array83);

$expression84 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments80['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression84(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array82)
					),
					$renderingContext
				);
$arguments80['__thenClosure'] = $renderChildrenClosure81;

$output79 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments80, $renderChildrenClosure81, $renderingContext);

$output79 .= '
			';
return $output79;
};
$arguments77 = array();
$arguments77['if'] = NULL;

$output61 .= '';

$output61 .= '
		';
return $output61;
};
$arguments27 = array();
$arguments27['then'] = NULL;
$arguments27['else'] = NULL;
$arguments27['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array58 = array();
$array59 = array (
);$array58['0'] = $renderingContext->getVariableProvider()->getByPath('data.bodytext', $array59);

$expression60 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments27['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression60(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array58)
					),
					$renderingContext
				);
$arguments27['__thenClosure'] = function() use ($renderingContext, $self) {
$output29 = '';

$output29 .= '
				<div class="ce-bodytext">
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure31 = function() use ($renderingContext, $self) {
$output35 = '';

$output35 .= '
						';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure37 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments36 = array();
$arguments36['section'] = NULL;
$arguments36['partial'] = NULL;
$arguments36['delegate'] = NULL;
$arguments36['renderable'] = NULL;
$arguments36['arguments'] = array (
);
$arguments36['optional'] = false;
$arguments36['default'] = NULL;
$arguments36['contentAs'] = NULL;
$arguments36['partial'] = 'Header/All';
$arguments36['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output35 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments36, $renderChildrenClosure37, $renderingContext);

$output35 .= '
					';
return $output35;
};
$arguments30 = array();
$arguments30['then'] = NULL;
$arguments30['else'] = NULL;
$arguments30['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array32 = array();
$array33 = array (
);$array32['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array33);

$expression34 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments30['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression34(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array32)
					),
					$renderingContext
				);
$arguments30['__thenClosure'] = $renderChildrenClosure31;

$output29 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments30, $renderChildrenClosure31, $renderingContext);

$output29 .= '
					';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper
$renderChildrenClosure40 = function() use ($renderingContext, $self) {
$array41 = array (
);return $renderingContext->getVariableProvider()->getByPath('data.bodytext', $array41);
};
$arguments39 = array();
$arguments39['parseFuncTSPath'] = 'lib.parseFunc_RTE';

$output29 .= TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper::renderStatic($arguments39, $renderChildrenClosure40, $renderingContext);

$output29 .= '
				</div>
			';
return $output29;
};
$arguments27['__elseClosures'][] = function() use ($renderingContext, $self) {
$output42 = '';

$output42 .= '
				';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure44 = function() use ($renderingContext, $self) {
$output48 = '';

$output48 .= '
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure50 = function() use ($renderingContext, $self) {
$output54 = '';

$output54 .= '
						<div class="ce-bodytext">
							';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure56 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments55 = array();
$arguments55['section'] = NULL;
$arguments55['partial'] = NULL;
$arguments55['delegate'] = NULL;
$arguments55['renderable'] = NULL;
$arguments55['arguments'] = array (
);
$arguments55['optional'] = false;
$arguments55['default'] = NULL;
$arguments55['contentAs'] = NULL;
$arguments55['partial'] = 'Header/All';
$arguments55['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output54 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments55, $renderChildrenClosure56, $renderingContext);

$output54 .= '
						</div>
					';
return $output54;
};
$arguments49 = array();
$arguments49['then'] = NULL;
$arguments49['else'] = NULL;
$arguments49['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array51 = array();
$array52 = array (
);$array51['0'] = $renderingContext->getVariableProvider()->getByPath('data.header', $array52);

$expression53 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments49['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression53(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array51)
					),
					$renderingContext
				);
$arguments49['__thenClosure'] = $renderChildrenClosure50;

$output48 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments49, $renderChildrenClosure50, $renderingContext);

$output48 .= '
				';
return $output48;
};
$arguments43 = array();
$arguments43['then'] = NULL;
$arguments43['else'] = NULL;
$arguments43['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array45 = array();
$array46 = array (
);$array45['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array46);

$expression47 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments43['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression47(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array45)
					),
					$renderingContext
				);
$arguments43['__thenClosure'] = $renderChildrenClosure44;

$output42 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments43, $renderChildrenClosure44, $renderingContext);

$output42 .= '
			';
return $output42;
};

$output10 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments27, $renderChildrenClosure28, $renderingContext);

$output10 .= '

		';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure96 = function() use ($renderingContext, $self) {
$output100 = '';

$output100 .= '
			';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure102 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments101 = array();
$arguments101['section'] = NULL;
$arguments101['partial'] = NULL;
$arguments101['delegate'] = NULL;
$arguments101['renderable'] = NULL;
$arguments101['arguments'] = array (
);
$arguments101['optional'] = false;
$arguments101['default'] = NULL;
$arguments101['contentAs'] = NULL;
$arguments101['partial'] = 'Media/Gallery';
$arguments101['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output100 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments101, $renderChildrenClosure102, $renderingContext);

$output100 .= '
		';
return $output100;
};
$arguments95 = array();
$arguments95['then'] = NULL;
$arguments95['else'] = NULL;
$arguments95['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array97 = array();
$array98 = array (
);$array97['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.vertical', $array98);
$array97['1'] = ' == \'below\'';

$expression99 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == 'below');};
$arguments95['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression99(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array97)
					),
					$renderingContext
				);
$arguments95['__thenClosure'] = $renderChildrenClosure96;

$output10 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments95, $renderChildrenClosure96, $renderingContext);

$output10 .= '
	</div>

';

return $output10;
}
/**
 * Main Render function
 */
public function render(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output104 = '';

$output104 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\LayoutViewHelper
$renderChildrenClosure106 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments105 = array();
$arguments105['name'] = NULL;
$arguments105['name'] = 'Default';

$output104 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [NULL]);

$output104 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\SectionViewHelper
$renderChildrenClosure108 = function() use ($renderingContext, $self) {
$output109 = '';

$output109 .= '

	';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure111 = function() use ($renderingContext, $self) {
$output115 = '';

$output115 .= '
		';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure117 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments116 = array();
$arguments116['section'] = NULL;
$arguments116['partial'] = NULL;
$arguments116['delegate'] = NULL;
$arguments116['renderable'] = NULL;
$arguments116['arguments'] = array (
);
$arguments116['optional'] = false;
$arguments116['default'] = NULL;
$arguments116['contentAs'] = NULL;
$arguments116['partial'] = 'Header/All';
$arguments116['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output115 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments116, $renderChildrenClosure117, $renderingContext);

$output115 .= '
	';
return $output115;
};
$arguments110 = array();
$arguments110['then'] = NULL;
$arguments110['else'] = NULL;
$arguments110['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array112 = array();
$array113 = array (
);$array112['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array113);
$array112['1'] = ' != 1';

$expression114 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) != 1);};
$arguments110['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression114(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array112)
					),
					$renderingContext
				);
$arguments110['__thenClosure'] = $renderChildrenClosure111;

$output109 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments110, $renderChildrenClosure111, $renderingContext);

$output109 .= '

';
return $output109;
};
$arguments107 = array();
$arguments107['name'] = NULL;
$arguments107['name'] = 'Header';

$output104 .= NULL;

$output104 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\SectionViewHelper
$renderChildrenClosure120 = function() use ($renderingContext, $self) {
$output121 = '';

$output121 .= '

	<div class="ce-textpic ce-';
$array122 = array (
);
$output121 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('gallery.position.horizontal', $array122)]);

$output121 .= ' ce-';
$array123 = array (
);
$output121 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('gallery.position.vertical', $array123)]);
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure125 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments124 = array();
$arguments124['then'] = NULL;
$arguments124['else'] = NULL;
$arguments124['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array126 = array();
$array127 = array (
);$array126['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array127);

$expression128 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments124['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression128(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array126)
					),
					$renderingContext
				);
$arguments124['then'] = ' ce-nowrap';

$output121 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments124, $renderChildrenClosure125, $renderingContext);

$output121 .= '">
		';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure130 = function() use ($renderingContext, $self) {
$output134 = '';

$output134 .= '
			';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure136 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments135 = array();
$arguments135['section'] = NULL;
$arguments135['partial'] = NULL;
$arguments135['delegate'] = NULL;
$arguments135['renderable'] = NULL;
$arguments135['arguments'] = array (
);
$arguments135['optional'] = false;
$arguments135['default'] = NULL;
$arguments135['contentAs'] = NULL;
$arguments135['partial'] = 'Media/Gallery';
$arguments135['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output134 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments135, $renderChildrenClosure136, $renderingContext);

$output134 .= '
		';
return $output134;
};
$arguments129 = array();
$arguments129['then'] = NULL;
$arguments129['else'] = NULL;
$arguments129['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array131 = array();
$array132 = array (
);$array131['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.vertical', $array132);
$array131['1'] = ' != \'below\'';

$expression133 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) != 'below');};
$arguments129['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression133(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array131)
					),
					$renderingContext
				);
$arguments129['__thenClosure'] = $renderChildrenClosure130;

$output121 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments129, $renderChildrenClosure130, $renderingContext);

$output121 .= '

		';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure139 = function() use ($renderingContext, $self) {
$output172 = '';

$output172 .= '
			';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure174 = function() use ($renderingContext, $self) {
$output175 = '';

$output175 .= '
				<div class="ce-bodytext">
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure177 = function() use ($renderingContext, $self) {
$output181 = '';

$output181 .= '
						';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure183 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments182 = array();
$arguments182['section'] = NULL;
$arguments182['partial'] = NULL;
$arguments182['delegate'] = NULL;
$arguments182['renderable'] = NULL;
$arguments182['arguments'] = array (
);
$arguments182['optional'] = false;
$arguments182['default'] = NULL;
$arguments182['contentAs'] = NULL;
$arguments182['partial'] = 'Header/All';
$arguments182['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output181 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments182, $renderChildrenClosure183, $renderingContext);

$output181 .= '
					';
return $output181;
};
$arguments176 = array();
$arguments176['then'] = NULL;
$arguments176['else'] = NULL;
$arguments176['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array178 = array();
$array179 = array (
);$array178['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array179);

$expression180 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments176['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression180(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array178)
					),
					$renderingContext
				);
$arguments176['__thenClosure'] = $renderChildrenClosure177;

$output175 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments176, $renderChildrenClosure177, $renderingContext);

$output175 .= '
					';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper
$renderChildrenClosure186 = function() use ($renderingContext, $self) {
$array187 = array (
);return $renderingContext->getVariableProvider()->getByPath('data.bodytext', $array187);
};
$arguments185 = array();
$arguments185['parseFuncTSPath'] = 'lib.parseFunc_RTE';

$output175 .= TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper::renderStatic($arguments185, $renderChildrenClosure186, $renderingContext);

$output175 .= '
				</div>
			';
return $output175;
};
$arguments173 = array();

$output172 .= '';

$output172 .= '
			';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure189 = function() use ($renderingContext, $self) {
$output190 = '';

$output190 .= '
				';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure192 = function() use ($renderingContext, $self) {
$output196 = '';

$output196 .= '
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure198 = function() use ($renderingContext, $self) {
$output202 = '';

$output202 .= '
						<div class="ce-bodytext">
							';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure204 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments203 = array();
$arguments203['section'] = NULL;
$arguments203['partial'] = NULL;
$arguments203['delegate'] = NULL;
$arguments203['renderable'] = NULL;
$arguments203['arguments'] = array (
);
$arguments203['optional'] = false;
$arguments203['default'] = NULL;
$arguments203['contentAs'] = NULL;
$arguments203['partial'] = 'Header/All';
$arguments203['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output202 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments203, $renderChildrenClosure204, $renderingContext);

$output202 .= '
						</div>
					';
return $output202;
};
$arguments197 = array();
$arguments197['then'] = NULL;
$arguments197['else'] = NULL;
$arguments197['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array199 = array();
$array200 = array (
);$array199['0'] = $renderingContext->getVariableProvider()->getByPath('data.header', $array200);

$expression201 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments197['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression201(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array199)
					),
					$renderingContext
				);
$arguments197['__thenClosure'] = $renderChildrenClosure198;

$output196 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments197, $renderChildrenClosure198, $renderingContext);

$output196 .= '
				';
return $output196;
};
$arguments191 = array();
$arguments191['then'] = NULL;
$arguments191['else'] = NULL;
$arguments191['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array193 = array();
$array194 = array (
);$array193['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array194);

$expression195 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments191['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression195(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array193)
					),
					$renderingContext
				);
$arguments191['__thenClosure'] = $renderChildrenClosure192;

$output190 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments191, $renderChildrenClosure192, $renderingContext);

$output190 .= '
			';
return $output190;
};
$arguments188 = array();
$arguments188['if'] = NULL;

$output172 .= '';

$output172 .= '
		';
return $output172;
};
$arguments138 = array();
$arguments138['then'] = NULL;
$arguments138['else'] = NULL;
$arguments138['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array169 = array();
$array170 = array (
);$array169['0'] = $renderingContext->getVariableProvider()->getByPath('data.bodytext', $array170);

$expression171 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments138['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression171(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array169)
					),
					$renderingContext
				);
$arguments138['__thenClosure'] = function() use ($renderingContext, $self) {
$output140 = '';

$output140 .= '
				<div class="ce-bodytext">
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure142 = function() use ($renderingContext, $self) {
$output146 = '';

$output146 .= '
						';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure148 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments147 = array();
$arguments147['section'] = NULL;
$arguments147['partial'] = NULL;
$arguments147['delegate'] = NULL;
$arguments147['renderable'] = NULL;
$arguments147['arguments'] = array (
);
$arguments147['optional'] = false;
$arguments147['default'] = NULL;
$arguments147['contentAs'] = NULL;
$arguments147['partial'] = 'Header/All';
$arguments147['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output146 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments147, $renderChildrenClosure148, $renderingContext);

$output146 .= '
					';
return $output146;
};
$arguments141 = array();
$arguments141['then'] = NULL;
$arguments141['else'] = NULL;
$arguments141['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array143 = array();
$array144 = array (
);$array143['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array144);

$expression145 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments141['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression145(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array143)
					),
					$renderingContext
				);
$arguments141['__thenClosure'] = $renderChildrenClosure142;

$output140 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments141, $renderChildrenClosure142, $renderingContext);

$output140 .= '
					';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper
$renderChildrenClosure151 = function() use ($renderingContext, $self) {
$array152 = array (
);return $renderingContext->getVariableProvider()->getByPath('data.bodytext', $array152);
};
$arguments150 = array();
$arguments150['parseFuncTSPath'] = 'lib.parseFunc_RTE';

$output140 .= TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper::renderStatic($arguments150, $renderChildrenClosure151, $renderingContext);

$output140 .= '
				</div>
			';
return $output140;
};
$arguments138['__elseClosures'][] = function() use ($renderingContext, $self) {
$output153 = '';

$output153 .= '
				';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure155 = function() use ($renderingContext, $self) {
$output159 = '';

$output159 .= '
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure161 = function() use ($renderingContext, $self) {
$output165 = '';

$output165 .= '
						<div class="ce-bodytext">
							';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure167 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments166 = array();
$arguments166['section'] = NULL;
$arguments166['partial'] = NULL;
$arguments166['delegate'] = NULL;
$arguments166['renderable'] = NULL;
$arguments166['arguments'] = array (
);
$arguments166['optional'] = false;
$arguments166['default'] = NULL;
$arguments166['contentAs'] = NULL;
$arguments166['partial'] = 'Header/All';
$arguments166['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output165 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments166, $renderChildrenClosure167, $renderingContext);

$output165 .= '
						</div>
					';
return $output165;
};
$arguments160 = array();
$arguments160['then'] = NULL;
$arguments160['else'] = NULL;
$arguments160['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array162 = array();
$array163 = array (
);$array162['0'] = $renderingContext->getVariableProvider()->getByPath('data.header', $array163);

$expression164 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments160['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression164(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array162)
					),
					$renderingContext
				);
$arguments160['__thenClosure'] = $renderChildrenClosure161;

$output159 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments160, $renderChildrenClosure161, $renderingContext);

$output159 .= '
				';
return $output159;
};
$arguments154 = array();
$arguments154['then'] = NULL;
$arguments154['else'] = NULL;
$arguments154['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array156 = array();
$array157 = array (
);$array156['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.noWrap', $array157);

$expression158 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments154['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression158(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array156)
					),
					$renderingContext
				);
$arguments154['__thenClosure'] = $renderChildrenClosure155;

$output153 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments154, $renderChildrenClosure155, $renderingContext);

$output153 .= '
			';
return $output153;
};

$output121 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments138, $renderChildrenClosure139, $renderingContext);

$output121 .= '

		';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure207 = function() use ($renderingContext, $self) {
$output211 = '';

$output211 .= '
			';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure213 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments212 = array();
$arguments212['section'] = NULL;
$arguments212['partial'] = NULL;
$arguments212['delegate'] = NULL;
$arguments212['renderable'] = NULL;
$arguments212['arguments'] = array (
);
$arguments212['optional'] = false;
$arguments212['default'] = NULL;
$arguments212['contentAs'] = NULL;
$arguments212['partial'] = 'Media/Gallery';
$arguments212['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output211 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments212, $renderChildrenClosure213, $renderingContext);

$output211 .= '
		';
return $output211;
};
$arguments206 = array();
$arguments206['then'] = NULL;
$arguments206['else'] = NULL;
$arguments206['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array208 = array();
$array209 = array (
);$array208['0'] = $renderingContext->getVariableProvider()->getByPath('gallery.position.vertical', $array209);
$array208['1'] = ' == \'below\'';

$expression210 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == 'below');};
$arguments206['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression210(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array208)
					),
					$renderingContext
				);
$arguments206['__thenClosure'] = $renderChildrenClosure207;

$output121 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments206, $renderChildrenClosure207, $renderingContext);

$output121 .= '
	</div>

';
return $output121;
};
$arguments119 = array();
$arguments119['name'] = NULL;
$arguments119['name'] = 'Main';

$output104 .= NULL;

$output104 .= '

';

return $output104;
}


}
#