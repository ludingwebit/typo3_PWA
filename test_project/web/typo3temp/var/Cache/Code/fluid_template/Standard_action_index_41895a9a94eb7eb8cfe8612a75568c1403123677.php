<?php

class Standard_action_index_41895a9a94eb7eb8cfe8612a75568c1403123677 extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

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

$output0 .= '<form action="" id="clipboard_form">
	<a name="clip_head"></a>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
$array3 = array (
);return $renderingContext->getVariableProvider()->getByPath('clipboardHeader', $array3);
};
$arguments1 = array();
$arguments1['value'] = NULL;

$output0 .= isset($arguments1['value']) ? $arguments1['value'] : $renderChildrenClosure2();

$output0 .= '
				</div>
				<table class="table">
					<tr>
						<td colspan="2" class="nowrap" width="95%">
							';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure5 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments4 = array();
$arguments4['section'] = NULL;
$arguments4['partial'] = NULL;
$arguments4['delegate'] = NULL;
$arguments4['renderable'] = NULL;
$arguments4['arguments'] = array (
);
$arguments4['optional'] = false;
$arguments4['default'] = NULL;
$arguments4['contentAs'] = NULL;
$arguments4['partial'] = 'Clipboard/CopymodeSelector';
$arguments4['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments4, $renderChildrenClosure5, $renderingContext);

$output0 .= '
							';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure8 = function() use ($renderingContext, $self) {
$output12 = '';

$output12 .= '
								';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure14 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments13 = array();
$arguments13['section'] = NULL;
$arguments13['partial'] = NULL;
$arguments13['delegate'] = NULL;
$arguments13['renderable'] = NULL;
$arguments13['arguments'] = array (
);
$arguments13['optional'] = false;
$arguments13['default'] = NULL;
$arguments13['contentAs'] = NULL;
$arguments13['partial'] = 'Clipboard/MenuSelector';
$arguments13['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output12 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments13, $renderChildrenClosure14, $renderingContext);

$output12 .= '
							';
return $output12;
};
$arguments7 = array();
$arguments7['then'] = NULL;
$arguments7['else'] = NULL;
$arguments7['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array9 = array();
$array10 = array (
);$array9['0'] = $renderingContext->getVariableProvider()->getByPath('elementCount', $array10);

$expression11 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments7['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression11(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array9)
					),
					$renderingContext
				);
$arguments7['__thenClosure'] = $renderChildrenClosure8;

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments7, $renderChildrenClosure8, $renderingContext);

$output0 .= '
						</td>
						<td class="col-control nowrap">
							';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure17 = function() use ($renderingContext, $self) {
$output21 = '';

$output21 .= '
								<a href="';
$array22 = array (
);
$output21 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('removeAllUrl', $array22)]);

$output21 .= '#clip_head"
									 title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure24 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments23 = array();
$arguments23['key'] = NULL;
$arguments23['id'] = NULL;
$arguments23['default'] = NULL;
$arguments23['htmlEscape'] = NULL;
$arguments23['arguments'] = NULL;
$arguments23['extensionName'] = NULL;
$arguments23['key'] = 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:buttons.clear';

$output21 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments23, $renderChildrenClosure24, $renderingContext)]);

$output21 .= '" class="btn btn-danger">
									';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure26 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure28 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments27 = array();
$arguments27['identifier'] = NULL;
$arguments27['size'] = 'small';
$arguments27['overlay'] = NULL;
$arguments27['state'] = 'default';
$arguments27['alternativeMarkupIdentifier'] = NULL;
$arguments27['identifier'] = 'actions-close';
$arguments27['alternativeMarkupIdentifier'] = 'inline';
return TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments27, $renderChildrenClosure28, $renderingContext);
};
$arguments25 = array();
$arguments25['value'] = NULL;

$output21 .= isset($arguments25['value']) ? $arguments25['value'] : $renderChildrenClosure26();

$output21 .= '
								</a>
							';
return $output21;
};
$arguments16 = array();
$arguments16['then'] = NULL;
$arguments16['else'] = NULL;
$arguments16['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array18 = array();
$array19 = array (
);$array18['0'] = $renderingContext->getVariableProvider()->getByPath('elementCount', $array19);

$expression20 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments16['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression20(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array18)
					),
					$renderingContext
				);
$arguments16['__thenClosure'] = $renderChildrenClosure17;

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments16, $renderChildrenClosure17, $renderingContext);

$output0 .= '
						</td>
					</tr>
					';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure30 = function() use ($renderingContext, $self) {
$output32 = '';

$output32 .= '
						';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure34 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments33 = array();
$arguments33['section'] = NULL;
$arguments33['partial'] = NULL;
$arguments33['delegate'] = NULL;
$arguments33['renderable'] = NULL;
$arguments33['arguments'] = array (
);
$arguments33['optional'] = false;
$arguments33['default'] = NULL;
$arguments33['contentAs'] = NULL;
$arguments33['partial'] = 'Clipboard/Tab';
// Rendering Array
$array35 = array();
$array36 = array (
);$array35['tab'] = $renderingContext->getVariableProvider()->getByPath('tab', $array36);
$array37 = array (
);$array35['current'] = $renderingContext->getVariableProvider()->getByPath('current', $array37);
$array38 = array (
);$array35['currentMode'] = $renderingContext->getVariableProvider()->getByPath('currentMode', $array38);
$arguments33['arguments'] = $array35;

$output32 .= TYPO3Fluid\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments33, $renderChildrenClosure34, $renderingContext);

$output32 .= '
					';
return $output32;
};
$arguments29 = array();
$arguments29['each'] = NULL;
$arguments29['as'] = NULL;
$arguments29['key'] = NULL;
$arguments29['reverse'] = false;
$arguments29['iteration'] = NULL;
$array31 = array (
);$arguments29['each'] = $renderingContext->getVariableProvider()->getByPath('tabArray', $array31);
$arguments29['as'] = 'tab';
$arguments29['key'] = 'key';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments29, $renderChildrenClosure30, $renderingContext);

$output0 .= '
				</table>
			</div>
		</div>
	</div>
</form>
';

return $output0;
}


}
#