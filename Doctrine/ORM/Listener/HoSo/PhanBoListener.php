<?php
namespace App\Doctrine\ORM\Listener\HoSo;

use AppBundle\Entity\BinhLe\ThieuNhi\PhanBo;
use AppBundle\Entity\BinhLe\ThieuNhi\ThanhVien;
use AppBundle\Entity\Content\ContentPiece\ContentPiece;
use AppBundle\Entity\Content\ContentPiece\ContentPieceVocabEntry;
use AppBundle\Entity\Content\NodeShortcode\H5pShortcodeHandler;
use AppBundle\Entity\Content\NodeShortcode\ShortcodeFactory;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PhanBoListener{
	/**
	 * @var ContainerInterface
	 */
	private $container;
	
	function __construct(ContainerInterface $container) {
		$this->container = $container;
	}
	
	private function updateProperties(PhanBo $object) {
		
	}
	
	public function prePersistHandler(PhanBo $object, LifecycleEventArgs $event) {
		$this->updateProperties($object);
	}
	
	
	public function preUpdateHandler(PhanBo $object, LifecycleEventArgs $event) {
		$this->updateProperties($object);
	}
	
	public function postUpdateHandler(PhanBo $object, LifecycleEventArgs $event) {
		
	}
	
	public function preRemoveHandler(PhanBo $object, LifecycleEventArgs $event) {
		
	}
	
	public function postRemoveHandler(PhanBo $object, LifecycleEventArgs $event) {
	
	}
	
	public function postPersistHandler(PhanBo $employer, LifecycleEventArgs $event) {
	
	
	}
}