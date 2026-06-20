<?php
function regenerateIndustriesXML($conn) {
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><industries></industries>');

    $sql = "SELECT id_industry, industry_name FROM rm_industry ORDER BY id_industry ASC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $industry = $xml->addChild('industry');
            $industry->addChild('id', $row['id_industry']);
            $industry->addChild('name', htmlspecialchars($row['industry_name']));
        }
    }

    $xmlFilePath = 'C:/xampp/htdocs/Resumix/Frontend/Admin/xml/industries.xml';

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;

    $dom->loadXML($xml->asXML());

    $dom->save($xmlFilePath);
}
?>
