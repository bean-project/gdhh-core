<?php

namespace App\Entity\HoSo\ThanhVien;

use App\Entity\HocBa\BangDiemSpreadsheet\BangDiemNhomWriter;
use App\Entity\HocBa\BangDiemSpreadsheet\BangDiemSpreadsheet;
use App\Entity\HoSo\NamHoc;
use App\Entity\HoSo\PhanBo;
use App\Entity\HoSo\ThanhVien;
use Liuggio\ExcelBundle\Factory;

class HuynhTruong {
	
	/** @var PhanBo */
	protected $phanBo;
	
	/** @var ThanhVien */
	protected $thanhVien;
	
	/** @var BangDiemSpreadsheet */
	protected $bangDiemSpreadsheet;
	
	public function getBangDiemSpreadsheet() {
		if(empty($this->bangDiemSpreadsheet)) {
			$this->bangDiemSpreadsheet = new BangDiemSpreadsheet();
			$this->bangDiemSpreadsheet->setChiDoan($this->phanBo->getChiDoan());
		}
		
		return $this->bangDiemSpreadsheet;
	}
	
	public function downloadBangDiemExcel($hocKy) {
		
		$bdWriter = new BangDiemNhomWriter($this);
		
		$bdWriter->writeBangDiemHocKy($hocKy);
		$f              = $bdWriter->getSpreadsheetFactory();
		$phpExcelObject = $bdWriter->getExcelObj();
		// create the writer
		$writer = $f->createWriter($phpExcelObject, 'Excel2007');
		
		$phpExcelObject->getActiveSheet()->calculateColumnWidths();
		
		// create the response
		return $response = $f->createStreamedResponse($writer);
	}
	
	
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