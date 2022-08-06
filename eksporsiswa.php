<?php
ob_start();
	session_start();
	if($_SESSION['sudahlogin']==true && substr($_SESSION['user'], 0, 5) == "ADMIN"){
		include("db-connect.php");
		koneksi_db();
		$id_cabang = $_GET['idc'];

		// Load plugin PHPExcel nya
		require_once 'PHPExcel/PHPExcel.php';

		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal file excel
		$excel->getProperties()->setCreator('LBB BEST')
					 ->setLastModifiedBy('LBB BEST')
					 ->setTitle("Data Siswa")
					 ->setSubject("Siswa")
					 ->setDescription("Laporan Semua Data Siswa")
					 ->setKeywords("Data Siswa");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA LBB BEST"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:D1'); // Set Merge Cell pada kolom A1 sampai F1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "ID SISWA"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA SISWA"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "DEFAULT PASSWORD"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa
		$sql = mysql_query("SELECT id_siswa, nama_siswa FROM siswa WHERE id_cabang='$id_cabang' AND id_siswa NOT LIKE '%ADMIN%'");

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		while($data = mysql_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['id_siswa']);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nama_siswa']);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "BEST1");


		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);

		  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Daftar Siswa");
		$excel->setActiveSheetIndex(0);

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		ob_end_clean();
		// Proses file excel
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write->save('php://output');
	}
	else header("Location: index.php");
ob_end_flush();
?>