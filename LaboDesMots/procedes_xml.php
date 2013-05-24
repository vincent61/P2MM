<?php
//header("Content-type: application/xml");
$writer = new XMLWriter();  
           $writer->openURI('php://output');   
           $writer->startDocument('1.0','UTF-8');   
           $writer->setIndent(4);   
           $writer->startElement('procedes');  
		   foreach($procedes as $police){
		        $writer->startElement("procede");  
				$writer->writeElement('name', $police['police']);  
				$writer->writeElement('casse', casse($police['casse']));  
				$writer->endElement();
}
             
           $writer->endElement();   
           $writer->endDocument();   
           $writer->flush(); 
?>