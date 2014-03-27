<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>

<?php

require 'vendor/autoload.php';

$service = new \Discogs\Service();

$resultset = $service->search(array(
    'q'     => 'Meagashira',
    'label' => 'Enzyme'
));

// Total results
echo count($resultset);
echo "result...<br>";
// Total pages
$pagination = $resultset->getPagination();
//echo count($pagination)."\n";

// Fetch all results (use on your own risk, only one request per second allowed)
do {
    $pagination = $resultset->getPagination();
    echo "page: ".$pagination->getPage().'<br />';
    foreach ($resultset as $result) {
        echo $result->getTitle().'<br />';
    }
} while($resultset = $service->next($resultset));
?>
</body>
</html>