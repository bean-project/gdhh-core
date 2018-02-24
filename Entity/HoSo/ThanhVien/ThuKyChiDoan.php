<?php

namespace App\Entity\HoSo\ThanhVien;

use App\Entity\HoSo\DoiNhomGiaoLy;
use App\Entity\HoSo\NamHoc;
use App\Entity\HoSo\PhanBo;
use App\Entity\HoSo\ThanhVien;
use Doctrine\Common\Collections\ArrayCollection;

class ThuKyChiDoan {
	/** @var PhanBo */
	private $phanBo;
	
	/** @var ThanhVien */
	private $thanhVien;
	
	private $cacPhanBoThieuNhiPhuTrachTheoNamHoc = [];
	
	public function isThieuNhiCungChiDoan(PhanBo $phanBo) {
		if(empty($this->phanBo)) {
			return false;
		}
		
		return $this->phanBo->getChiDoan()->getId() === $phanBo->getChiDoan()->getId();
	}
	
	/**
	 * @param NamHoc|null $namHoc
	 *
	 * @return ArrayCollection|null
	 */
	public function getCacPhanBoThieuNhiPhuTrach(NamHoc $namHoc = null) {
		if(empty($namHoc)) {
			if(array_key_exists(0, $this->cacPhanBoThieuNhiPhuTrachTheoNamHoc)) {
				return $this->cacPhanBoThieuNhiPhuTrachTheoNamHoc[0];
			}
		}
		if(empty($this->phanBo)) {
			return null;
		}
		
		$phanBoThieuNhi = new ArrayCollection();
		$cacDngl        = $this->phanBo->getChiDoan()->getCacDoiNhomGiaoLy();
		/** @var DoiNhomGiaoLy $dngl */
		foreach($cacDngl as $dngl) {
			$phanBoThieuNhi = new ArrayCollection(array_merge($phanBoThieuNhi->toArray(), $dngl->getPhanBoThieuNhi()->toArray()));
		}
		
		$this->cacPhanBoThieuNhiPhuTrachTheoNamHoc[0] = $phanBoThieuNhi = PhanBo::sortCacPhanBo($phanBoThieuNhi);
		
		return $phanBoThieuNhi;
	}
	
	
	/**
	 * @param $hocKy
	 *
	 * @return bool
	 */
	public function coTheNopBangDiem($hocKy) {
		$hocKy = intval($hocKy);
		$chiDoan = $this->phanBo->getChiDoan();
		
		if($hocKy === 1 && $chiDoan->isHoanTatBangDiemHK1()) {
			return false;
		}
		
		if($hocKy === 2 && $chiDoan->isHoanTatBangDiemHK2()) {
			return false;
		}
		
		return true;
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