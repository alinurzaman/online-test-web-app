<?php
	session_start();
	if($_SESSION['sudahlogin']==true && substr($_SESSION['user'], 0, 5) == "ADMIN"){
		include("db-connect.php");
		koneksi_db();
		$id_uc = $_GET['idu'];
		$get_uc = mysql_query("SELECT * FROM uc WHERE id_uc='$id_uc'");
		$data_uc = mysql_fetch_array($get_uc);
		$nama_uc = $data_uc['nama_uc'];
		$get_materi = mysql_query("SELECT id_materi, ujian_materi FROM materi WHERE id_uc='$id_uc'");
		$arr = array();
		$nama = array();
		while($data_materi=mysql_fetch_array($get_materi)){
				$arr[]=$data_materi['id_materi'];
				$nama[]=$data_materi['ujian_materi'];
		}

		// Load plugin PHPExcel nya
		require_once 'PHPExcel/PHPExcel.php';

		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal file excel
		$excel->getProperties()->setCreator('LBB BEST')
					 ->setLastModifiedBy('LBB BEST')
					 ->setTitle("Hasil UC")
					 ->setSubject("Hasil UC")
					 ->setDescription("Laporan Hasil UC Siswa")
					 ->setKeywords("Hasil UC");

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

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "HASIL "); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:R1'); // Set Merge Cell pada kolom A1 sampai F1
		/*$excel->getActiveSheet()->mergeCells('A3:A4');
		$excel->getActiveSheet()->mergeCells('B3:D3');
		$excel->getActiveSheet()->mergeCells('E3:G3');
		$excel->getActiveSheet()->mergeCells('H3:J3');
		$excel->getActiveSheet()->mergeCells('K3:M3');
		$excel->getActiveSheet()->mergeCells('N3:P3');
		$excel->getActiveSheet()->mergeCells('Q3:Q4');
		$excel->getActiveSheet()->mergeCells('R3:R4');*/
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "ID SISWA"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', $nama[0]);  // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('B4', "B");
		$excel->setActiveSheetIndex(0)->setCellValue('C4', "S");
		$excel->setActiveSheetIndex(0)->setCellValue('D4', "NILAI");
		$excel->setActiveSheetIndex(0)->setCellValue('E3', $nama[1]);  // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('E4', "B");
		$excel->setActiveSheetIndex(0)->setCellValue('F4', "S");
		$excel->setActiveSheetIndex(0)->setCellValue('G4', "NILAI");
		$excel->setActiveSheetIndex(0)->setCellValue('H3', $nama[2]);  // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('H4', "B");
		$excel->setActiveSheetIndex(0)->setCellValue('I4', "S");
		$excel->setActiveSheetIndex(0)->setCellValue('J4', "NILAI");
		$excel->setActiveSheetIndex(0)->setCellValue('K3', $nama[3]);  // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('K4', "B");
		$excel->setActiveSheetIndex(0)->setCellValue('L4', "S");
		$excel->setActiveSheetIndex(0)->setCellValue('M4', "NILAI");
		$excel->setActiveSheetIndex(0)->setCellValue('N3', $nama[4]);  // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('N4', "B");
		$excel->setActiveSheetIndex(0)->setCellValue('O4', "S");
		$excel->setActiveSheetIndex(0)->setCellValue('P4', "NILAI");
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "TOTAL NILAI"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KET."); // Set kolom D3 dengan tulisan "JENIS KELAMIN"

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('O4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('P4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa
		$col = "SELECT t1.id_siswa AS id, t1.benar_hasil AS b1, t1.salah_hasil AS s1, t1.nilai_hasil AS n1, t2.benar_hasil AS b2, t2.salah_hasil AS s2, t2.nilai_hasil AS n2, t3.benar_hasil AS b3, t3.salah_hasil AS s3, t3.nilai_hasil AS n3, t4.benar_hasil AS b4, t4.salah_hasil AS s4, t4.nilai_hasil AS n4, t5.benar_hasil AS b5, t5.salah_hasil AS s5, t5.nilai_hasil AS n5, t6.ket_hasiluc AS ket";
		$sel1 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[0]. "') t1";
		$sel2 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[1]. "') t2 ON t1.id_siswa = t2.id_siswa";
		$sel3 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[2]. "') t3 ON t2.id_siswa = t3.id_siswa";
		$sel4 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[3]. "') t4 ON t3.id_siswa = t4.id_siswa";
		$sel5 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[4]. "') t5 ON t4.id_siswa = t5.id_siswa";
		$sel6 = "(SELECT * FROM hasiluc WHERE id_uc='$id_uc') t6 ON t5.id_siswa = t6.id_siswa";
		$query = $col . " FROM " . $sel1 . " LEFT JOIN " . $sel2 . " LEFT JOIN " . $sel3 . " LEFT JOIN " . $sel4 . " LEFT JOIN " . $sel5 . " LEFT JOIN " . $sel6 ;
		$get_hasil = mysql_query($query);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 5
		while($data = mysql_fetch_array($get_hasil)){ // Ambil semua data dari hasil eksekusi $sql
			  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data['id']);
			  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['b1']);
			  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['s1']);
			  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['n1']);
			  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['b2']);
			  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['s2']);
			  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['n2']);
			  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['b3']);
			  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['s3']);
			  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['n3']);
			  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['b4']);
			  $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data['s4']);
			  $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data['n4']);
			  $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data['b5']);
			  $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data['s5']);
			  $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data['n5']);
			  $total = $data_hasil['n1'] + $data_hasil['n2'] + $data_hasil['n3'] + $data_hasil['n4'] + $data_hasil['n5'];
			  $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $total);
			  $excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data['ket']);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);

		  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

		  $numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(5); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(5); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(5); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(5); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(5); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(5); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(5); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(5); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(5); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(5); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(5); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(5); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(5); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(5); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(5); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(5); // Set width kolom B

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("HASIL UC");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="HASIL UC.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
	else header("Location: index.php");
?>