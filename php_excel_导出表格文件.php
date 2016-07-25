<?php
    /**
     * [getExcel description]
     * @return [type] [description]
     */
    public function getExcel(){
        //数据
        $data=get_tablecache('productionplan');
        //加载文件
        import("Tools.Classes.PHPExcel",APP_PATH,".php");
        import("Tools.Classes.PHPExcel.Writer.Excel2007",APP_PATH,".php");

        //实例化并设置
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()
            ->setCreator("Dy")  //创建人
            ->setLastModifiedBy("Dy")  //最后修改人
            ->setTitle("2016年制种计划_标题")  //标题
            ->setSubject("2016年制种计划_题目")  //题目
            ->setDescription("这是2016年地块制种计划描述")  //描述
            ->setKeywords("制种计划")  //关键字
            ->setCategory("excel");  //种类
        // set width    
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);  
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);  
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        // 设置行高度    
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);  
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        // 字体和样式  
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);  
        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true);  
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);  
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);  
      
        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);  
      
        // 设置水平居中    
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
        $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
        $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
        $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
        $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
        //设置垂直居中 
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //  合并  
        $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');   
        // 表头  
        $objPHPExcel->setActiveSheetIndex(0)   //设置当前的sheet 
                ->setCellValue('A1', '制种生产计划')  
                ->setCellValue('A2', 'ID')  
                ->setCellValue('B2', '地块编号')  
                ->setCellValue('C2', '地块名称')  
                ->setCellValue('D2', '队负责人')  
                ->setCellValue('E2', '备注'); 
        $num=count($data);
        // 内容  
        for ($i = 0 ; $i < $num; $i++) {  
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $data[$i]['productionplan_id']);  
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . ($i + 3),$data[$i]['field_num'],\PHPExcel_Cell_DataType::TYPE_STRING);//设置格式为文本
            $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), $data[$i]['field_name']);  
            $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $data[$i]['team_linkman']);  
            $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $data[$i]['productionplan_remark']);  
            $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':E' . ($i + 3))->getAlignment()->setVertical(
                \PHPExcel_Style_Alignment::VERTICAL_CENTER);  
            $objPHPExcel->getActiveSheet()->getStyle('A' . ($i) . ':E' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(
                \PHPExcel_Style_Border::BORDER_THIN);  
            $objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);  
        } 
        //设置sheet的标题
        $objPHPExcel->getActiveSheet()->setTitle('productionplan'); 
        //设置当前的sheet    
        $objPHPExcel->setActiveSheetIndex(0);  

        $savename='制种生产计划v1.0';
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $datetime = date('Y-m-d', time());        
        if (preg_match("/MSIE/", $ua)) {
            $savename = urlencode($savename); //处理IE导出名称乱码
        } 

        // excel头参数  
        header('Content-Type: application/vnd.ms-excel');  
        header('Content-Disposition: attachment;filename="'.$savename.'.xls"');  //日期为文件名后缀  
        header('Cache-Control: max-age=0'); 

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式  
        $objWriter->save('php://output');
    }