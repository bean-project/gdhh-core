<?php

namespace App\Service\HoSo;
use AppBundle\Entity\BinhLe\ThieuNhi\BangDiem;
use AppBundle\Entity\BinhLe\ThieuNhi\NamHoc;
use AppBundle\Entity\BinhLe\ThieuNhi\PhanBo;
use AppBundle\Entity\BinhLe\ThieuNhi\TruongPhuTrachDoi;
use AppBundle\Service\BaseService;
use AppBundle\Service\SpreadsheetWriter;

class NamHocService extends BaseService {
	
	public function getNamHocHienTai() {
		$repo   = $this->getDoctrine()->getRepository(NamHoc::class);
		$namHoc = $repo->findOneBy(
			array( 'enabled' => true, 'started' => true )
		);
		
		return $namHoc;
	}
}