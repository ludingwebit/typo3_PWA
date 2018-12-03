<?php
namespace Ludingwebit\RestReserveSubExt\Controller;

/***
 *
 * This file is part of the "Reservierung Sub Ext" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Paul Luding <luding@webit.de>, webit!
 *
 ***/

/**
 * BeispielController
 */
class BeispielController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
//        $beispiels = $this->beispielRepository->findAll();
        $this->view->assign('beispiels', $beispiels);
    }
}
