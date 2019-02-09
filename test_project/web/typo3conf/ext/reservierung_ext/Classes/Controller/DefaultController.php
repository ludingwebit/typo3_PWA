<?php
namespace Webit\ReservierungExt\Controller;

/***
 *
 * This file is part of the "Reservierung" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018
 *
 ***/

/**
 * DefaultController
 */
class DefaultController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $defaults = $this->defaultRepository->findAll();
        $this->view->assign('defaults', $defaults);
    }
}
