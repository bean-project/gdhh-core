<?php

namespace App\Doctrine\ORM\Listener\HoSo;

use AppBundle\Entity\BinhLe\ThieuNhi\NamHoc;
use AppBundle\Entity\BinhLe\ThieuNhi\PhanBo;
use AppBundle\Entity\BinhLe\ThieuNhi\ThanhVien;
use AppBundle\Entity\Content\ContentPiece\ContentPiece;
use AppBundle\Entity\Content\ContentPiece\ContentPieceVocabEntry;
use AppBundle\Entity\Content\NodeShortcode\H5pShortcodeHandler;
use AppBundle\Entity\Content\NodeShortcode\ShortcodeFactory;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\Tests\ODM\PHPCR\Mapping\Model\LifecycleCallbackMappingObject;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ThanhVienListener {
	/**
	 * @var ContainerInterface
	 */
	private $container;
	
	function __construct(ContainerInterface $container) {
		$this->container = $container;
	}
	
	private function updateProperties(ThanhVien $object, LifecycleEventArgs $event) {
		$request = $this->container->get('request_stack')->getCurrentRequest();
		$router  = $this->container->get('router');
		$trans   = $this->container->get('translator');
		
		if( ! empty($tenThanh = $object->getTenThanh())) {
			$christianName = $tenThanh->getTiengViet();
			$object->setSex($tenThanh->getSex());
		} else {
			$christianName = $object->getChristianname();
			if( ! empty($christianName)) {
				$cNames        = array_flip(ThanhVien::$christianNames);
				$christianName = $cNames[ $christianName ];
				$object->setSex(ThanhVien::$christianNameSex[ $christianName ]);
			}
		}
		if( ! empty($christianName)) {
			$object->setChristianname($christianName);
		}
		
		$lastname   = $object->getLastname() ?: '';
		$middlename = $object->getMiddlename() ?: '';
		$firstname  = $object->getFirstname() ?: '';
		$object->setName($christianName . ' ' . $lastname . ' ' . $middlename . ' ' . $firstname);
		
		if( ! empty($chiDoan = $object->getChiDoan())) {
			$object->setPhanDoan(ThanhVien::$danhSachChiDoan[ $chiDoan ]);
		}
		
		$namHocHienTai = $this->container->get('app.binhle_thieunhi_namhoc')->getNamHocHienTai();
		if(empty($object->getNamHoc())) {
			$object->setNamHoc($namHocHienTai->getId());
		}
		
		/** @var NamHoc $namHoc */
		$namHoc = $this->container->get('doctrine')->getRepository(NamHoc::class)->find($object->getNamHoc());
		
		if( ! empty($namHoc) && $namHoc->isEnabled()) {
			if( ! empty($phanBo = $object->initiatePhanBo($namHoc))) {
//				$em = $event->getEntityManager();
//
//				$em->persist($phanBo);
//
//				$uow = $em->getUnitOfWork();
//
//				$uow->recomputeSingleEntityChangeSet($em->getClassMetadata(PhanBo::class), $phanBo);
//				$uow->computeChangeSet($em->getClassMetadata(PhanBo::class), $phanBo);
			};
		}
		
	}
	
	public function prePersistHandler(ThanhVien $object, LifecycleEventArgs $event) {
		$this->updateProperties($object, $event);
	}
	
	
	public function preUpdateHandler(ThanhVien $object, LifecycleEventArgs $event) {
		$this->updateProperties($object, $event);
	}
	
	public function postUpdateHandler(ThanhVien $object, LifecycleEventArgs $event) {
		
	}
	
	public function preRemoveHandler(ThanhVien $object, LifecycleEventArgs $event) {
		
	}
	
	public function postRemoveHandler(ThanhVien $object, LifecycleEventArgs $event) {
	
	}
	
	public function postPersistHandler(ThanhVien $employer, LifecycleEventArgs $event) {
	
	}
}