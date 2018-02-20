<?php
namespace App\Entity\HoSo\ThanhVien;

use App\Entity\HoSo\ThanhVien;

class HuynhTruong {
	/** @var ThanhVien */
	private $thanhVien;
	
	public function addThieuNhi(ThanhVien $object) {
		$object->setThieuNhi(true);
		$object->setHuynhTruong(false);

//		$namHocHienTai = $this->getConfigurationPool()->getContainer()->get(NamHocService::class)->getNamHocHienTai();
		
		$namHoc = $this->thanhVien->getPhanBoNamNay()->getNamHoc();
		$object->initiatePhanBo($namHoc);
		$thanhVien = $this->thanhVien;
		if($thanhVien->isChiDoanTruong()) {
			$object->setChiDoan($thanhVien->getChiDoan());
		}
		
	}
	
	/**
	 * @return ThanhVien
	 */
	public function getThanhVien() {
		return $this->thanhVien;
	}
	
	/**
	 * @param ThanhVien $thanhVien
	 */
	public function setThanhVien($thanhVien) {
		$this->thanhVien = $thanhVien;
	}
	
}