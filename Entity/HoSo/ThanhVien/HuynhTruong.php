<?php

namespace App\Entity\HoSo\ThanhVien;

use App\Entity\HoSo\NamHoc;
use App\Entity\HoSo\PhanBo;
use App\Entity\HoSo\ThanhVien;

class HuynhTruong {
	
	/** @var PhanBo */
	private $phanBo;
	
	/** @var ThanhVien */
	private $thanhVien;
	
	public function getCacPhanBoThieuNhiPhuTrach(NamHoc $namHoc = null) {
		if(empty($namHoc)) {
			if( ! empty($this->phanBo)) {
				return $this->phanBo->getCacPhanBoThieuNhiPhuTrach();
			}
		}
	}
	
	public function isBangDiemReadOnly() {
		$readOnly = false;
		$phanBo   = $this->phanBo;
		$hocKy    = $this->phanBo->getChiDoan()->getHocKyHienTai();
		
		if(($phanBo->isHoanTatBangDiemHK1() && $hocKy === 1) || ($phanBo->isHoanTatBangDiemHK2() && $hocKy === 2)) {
			$readOnly = true;
		}
		
		return $readOnly;
	}
	
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
	
	/**
	 * @return PhanBo
	 */
	public function getPhanBo() {
		return $this->phanBo;
	}
	
	/**
	 * @param PhanBo $phanBo
	 */
	public function setPhanBo($phanBo) {
		$this->phanBo = $phanBo;
	}
	
}