<?php 
function head($title, $descripton, $keywords): string{
    $headTemplate = "<head>
    <meta charset='UTF-8' />
    <meta http-equiv='X-UA-Compatible', content='IE=edge'/>
    <meta name='description', content=$descripton/>
    <meta name='keywords', content=$keywords/>
    <meta name='viewport', content='width=device-width, initial-scale=1.0'/>
    <link rel='stylesheet', href='css/style.min.css'/>
    <link rel='manifest', href='./manifest.json'/>
    <title>$title</title>";
    return $headTemplate;
}