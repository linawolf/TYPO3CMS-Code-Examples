<?php
namespace T3docs\Examples\Controller;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Resource\Collection\AbstractFileCollection;
use TYPO3\CMS\Core\Resource\FileCollectionRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Frontend plugin for demonstrating collections
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
 */
class CollectionController extends ActionController
{

    /**
     * @var FileCollectionRepository
     */
    protected $collectionRepository;

    public function __construct(FileCollectionRepository $collectionRepository) {
        $this->collectionRepository = $collectionRepository;
    }

    /**
     * Renders the list of all existing collections and their content
     *
     * @return void
     */
    public function indexAction()
    {
        // Get all existing collections
        /** @var AbstractFileCollection[] $collections */
        $collections = $this->collectionRepository->findAll();

        // Load the records in each collection
        foreach ($collections as $aCollection) {
            $aCollection->loadContents();
        }

        // Assign the "loaded" collections to the view
        $this->view->assign('collections', $collections);
    }
}
