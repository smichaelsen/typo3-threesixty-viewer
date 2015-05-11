<?php
namespace AppZap\ThreesixtyViewer\Controller;

use TYPO3\CMS\Core\Resource\Collection\FolderBasedFileCollection;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ThreesixtyViewerController extends ActionController {

	/**
	 * @var \TYPO3\CMS\Core\Resource\FileCollectionRepository
	 * @inject
	 */
	protected $fileCollectionRepository;

	public function viewAction() {
		$collection = $this->fileCollectionRepository->findByUid($this->settings['imageset']);
		$collection->loadContents();
		$folder = '';
		$fileExtension = '';
		if ($collection instanceof FolderBasedFileCollection) {
			foreach ($collection->getItems() as $file) {
				/** @var \TYPO3\CMS\Core\Resource\File $file */
				$url = $file->getPublicUrl();
				$folder = str_replace($file->getName(), '', $url);
				$fileExtension = substr($url, strrpos($url, '.'));
				break;
			}
		}
		$this->view->assign('data', $this->configurationManager->getContentObject()->data);
		$this->view->assign('prefix', '');
		$this->view->assign('fileExtension', $fileExtension);
		$this->view->assign('itemcount', count($collection->getItems()));
		$this->view->assign('folder', $folder);
	}

}
