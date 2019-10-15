<?php

$dom = new DOMDocument;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://bluenove.com/notre-equipe/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
$html = curl_exec($ch);
curl_close($ch);
@$dom->loadHTML($html);
$finder = new DomXPath($dom);
$persons = $finder->query("//div[@class='team-person']/h4/text()");
$persons_ary = array();
foreach ($persons as $person) {
	$persons_ary[] = $person->wholeText;
}
$r = array_rand($persons_ary);

header("Content-type: application/json");
print json_encode(array("response_type" => "in_channel",
"text" => '☕' .
	$persons_ary[$r]));
