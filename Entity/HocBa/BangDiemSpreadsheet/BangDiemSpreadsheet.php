<?php

namespace App\Entity\HocBa\BangDiemSpreadsheet;

use App\Entity\HoSo\ChiDoan;

class BangDiemSpreadsheet {
	/** @var ChiDoan */
	protected $chiDoan;
	
	public function getCacCotDiem($hocKy) {
		if($hocKy === 1) {
			$cotDiem                             = [
				'cc9',
				'cc10',
				'cc11',
				'cc12',
				'tbCCTerm1',
				'quizTerm1',
				'midTerm1',
				'finalTerm1',
				'tbGLTerm1',
				'tbTerm1',
				'sundayTicketTerm1'
			];
			$cotDiemHeaders['cc9']               = 'CC-9';
			$cotDiemHeaders['cc10']              = 'CC-10';
			$cotDiemHeaders['cc11']              = 'CC-11';
			$cotDiemHeaders['cc12']              = 'CC-12';
			$cotDiemHeaders['tbCCTerm1']         = 'TB. CC';
			$cotDiemHeaders['quizTerm1']         = 'TB. Miệng';
			$cotDiemHeaders['midTerm1']          = 'Điểm 1 Tiết';
			$cotDiemHeaders['finalTerm1']        = 'Thi HK1';
			$cotDiemHeaders['tbGLTerm1']         = 'TB. Giáo Lý';
			$cotDiemHeaders['tbTerm1']           = 'TB. HK1';
			$cotDiemHeaders['sundayTicketTerm1'] = 'Phiếu lễ CN';
			
			$cotDiemAttrs['cc9']               = 'cc9';
			$cotDiemAttrs['cc10']              = 'cc10';
			$cotDiemAttrs['cc11']              = 'cc11';
			$cotDiemAttrs['cc12']              = 'cc12';
			$cotDiemAttrs['tbCCTerm1']         = 'tbCCTerm1';
			$cotDiemAttrs['quizTerm1']         = 'quizTerm1';
			$cotDiemAttrs['midTerm1']          = 'midTerm1';
			$cotDiemAttrs['finalTerm1']        = 'finalTerm1';
			$cotDiemAttrs['tbGLTerm1']         = 'tbGLTerm1';
			$cotDiemAttrs['tbTerm1']           = 'tbTerm1';
			$cotDiemAttrs['sundayTicketTerm1'] = 'sundayTicketTerm1';
			
			$cotDiemLabels['cc9']               = 'điểm Chuyên-cần tháng 9';
			$cotDiemLabels['cc10']              = 'điểm Chuyên-cần tháng 10';
			$cotDiemLabels['cc11']              = 'điểm Chuyên-cần tháng 11';
			$cotDiemLabels['cc12']              = 'điểm Chuyên-cần tháng 12';
			$cotDiemLabels['tbCCTerm1']         = 'điểm Trung-bình Chuyên-cần';
			$cotDiemLabels['quizTerm1']         = 'điểm Trung-bình Miệng';
			$cotDiemLabels['midTerm1']          = 'điểm 1 Tiết/Giữa-kỳ';
			$cotDiemLabels['finalTerm1']        = 'điểm Thi Cuối-kỳ';
			$cotDiemLabels['tbGLTerm1']         = 'TB. Giáo Lý HK1';
			$cotDiemLabels['tbTerm1']           = 'điểm Trung-bình Học-kỳ 1';
			$cotDiemLabels['sundayTicketTerm1'] = 'phiếu lễ Chúa-nhật';
		} else {
			$cotDiem = [
				'cc1',
				'cc2',
				'cc3',
				'cc4',
				'cc5',
				'tbCCTerm2',
				'quizTerm2',
				'midTerm2',
				'finalTerm2',
				'tbGLTerm2',
				'tbGLTerm1',
				'tbGLYear',
				'tbTerm2',
				'tbTerm1',
				'tbYear',
				'sundayTicketTerm2',
				'sundayTickets',
				'category',
				'awarded'
			];
		}
		
		foreach($cotDiem as $key => $cd) {
			unset($cotDiem[ $key ]);
			$cotDiem[ $cd ]         = [];
			$cotDiem[ $cd ]['attr'] = $cd;
			if(strpos($cd, 'cc') > - 1) {
				$cotDiem[ $cd ]['header'] = str_replace('cc', 'CC-', $cd);
				$cotDiem[ $cd ]['label']  = str_replace('cc', 'điểm Chuyên-cần tháng ', $cd);
			} elseif(strpos($cd, 'tbCCTerm') > - 1) {
				$cotDiem[ $cd ]['header'] = 'TB. CC';
				$cotDiem[ $cd ]['label']  = 'điểm Trung-bình Chuyên-cần';
			} elseif(strpos($cd, 'quizTerm') > - 1) {
				$cotDiem[ $cd ]['header'] = 'TB. Miệng';
				$cotDiem[ $cd ]['label']  = 'điểm Trung-bình miệng';
			} elseif(strpos($cd, 'midTerm') > - 1) {
				$cotDiem[ $cd ]['header'] = 'Giữa-kỳ';
				$cotDiem[ $cd ]['label']  = 'điểm thi Giữa-kỳ';
			} elseif(strpos($cd, 'finalTerm') > - 1) {
				$cotDiem[ $cd ]['header'] = 'Cuối-kỳ';
				$cotDiem[ $cd ]['label']  = 'điểm thi Cuối-kỳ';
			} elseif(strpos($cd, 'tbGLTerm') > - 1) {
				$cotDiem[ $cd ]['header'] = str_replace('tbGLTerm', 'TB. Giáo-lý HK', $cd);
				$cotDiem[ $cd ]['label']  = str_replace('tbGLTerm', 'điểm Trung-bình Giáo-lý HK ', $cd);
			} elseif($cd === 'tbGLYear') {
				$cotDiem[ $cd ]['header'] = 'TBGL. Năm';
				$cotDiem[ $cd ]['label']  = 'điểm Trung-bình Giáo-lý Cả năm';
			} elseif(strpos($cd, 'tbTerm') > - 1) {
				$cotDiem[ $cd ]['header'] = str_replace('tbTerm', 'TB. HK', $cd);
				$cotDiem[ $cd ]['label']  = str_replace('tbTerm', 'điểm Trung-bình HK ', $cd);
			} elseif($cd === 'tbYear') {
				$cotDiem[ $cd ]['header'] = 'TB. Cả-năm';
				$cotDiem[ $cd ]['label']  = 'điểm Trung-bình Cả năm';
			} elseif(strpos($cd, 'sundayTicketTerm') > - 1) {
				$cotDiem[ $cd ]['header'] = 'Phiếu CN';
				$cotDiem[ $cd ]['label']  = 'Phiếu CN';
			} elseif(strpos($cd, 'sundayTickets') > - 1) {
				$cotDiem[ $cd ]['header'] = 'Phiếu Cả-năm';
				$cotDiem[ $cd ]['label']  = 'Phiếu Cả-năm';
			} elseif($cd === 'category') {
				$cotDiem[ $cd ]['header'] = 'Xếp-loại';
				$cotDiem[ $cd ]['label']  = 'Xếp-loại';
			} elseif($cd === 'awarded') {
				$cotDiem[ $cd ]['header'] = 'Khen-thưởng';
				$cotDiem[ $cd ]['label']  = 'Khen-thưởng';
			}
		}
		
		
		if( ! empty($chiDoan = $this->chiDoan)) {
			if(is_array($cacCotDiemBiLoaiBo = $chiDoan->getCotDiemBiLoaiBo())) {
				foreach($cacCotDiemBiLoaiBo as $cotDiemBiLoaiBo) {
					unset($cotDiem[ $cotDiemBiLoaiBo ]);
				}
			}
		}
		
		return $cotDiem;
	}
	
	/**
	 * @return ChiDoan
	 */
	public
	function getChiDoan() {
		return $this->chiDoan;
	}
	
	/**
	 * @param ChiDoan $chiDoan
	 */
	public
	function setChiDoan(
		$chiDoan
	) {
		$this->chiDoan = $chiDoan;
	}
	
}