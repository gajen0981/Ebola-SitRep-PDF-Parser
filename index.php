<?
	// Include Composer autoloader if not already done.
	include 'vendor/autoload.php';
	 
	// Parse pdf file and build necessary objects.
	$parser 	= new \Smalot\PdfParser\Parser();
	
	//----------------------------------------------------------------------------------------
	// Define the source of PDF's, there are so many ways to automate this, scraping, API's, CURLing and etc...
	/* 	$pdf    	= $parser->parseFile('samples/who.pdf'); */
	$pdf    	= $parser->parseFile('samples/Situation_Report-Ebola-20Oct14.pdf');
	$bodyText 	= $pdf->getText();
	$details  	= $pdf->getDetails();
	
	//---------------------------------------------------------------------------------------- 
	// Loop over each property to extract values (string or array) for PDF's meta data
	echo "<fieldset class='collapsible form-wrapper' id='edit-page-detail'><legend><span class='fieldset-legend'>Metadata</span></legend><div class='fieldset-wrapper'><div class='page'><table class='table table-striped table-condensed'>";
	foreach ($details as $property => $value) {
	    if (is_array($value)) {
	        $value = implode(', ', $value);
	    }
	    echo "<tr><td><strong>" . $property . "</strong></td><td>" . $value . "</td></tr>";
	}
	echo "</table></div></div></fieldset>";
	
	//----------------------------------------------------------------------------------------
	// Retrieve all pages from the pdf file.
	$pages  		= $pdf->getPages();
	$numberOfPages 	= count($pages);
	$currPageCount 	= 0;
	 
	// Loop over each page to extract text.
	foreach ($pages as $page) {
		++$currPageCount;
	    echo "<fieldset class='collapsible form-wrapper' id='edit-page-1'><legend><span class='fieldset-legend'>Page " . $currPageCount . "/" . $numberOfPages . "</span></legend><div class='fieldset-wrapper'><div class='page'>" . $page->getText() . "</div></fieldset>";
	}

	//----------------------------------------------------------------------------------------
	// All text in the PDF
	echo "<fieldset class='collapsible form-wrapper' id='edit-page-1'><legend><span class='fieldset-legend'>All Texts</span></legend><div class='fieldset-wrapper'><div class='page'>" . $bodyText . "</div></fieldset>";
?>
