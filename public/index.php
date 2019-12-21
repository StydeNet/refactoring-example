<?php

require '../vendor/autoload.php';

$element = new \App\HtmlElement('p',[],'este es el contenido');

echo htmlentities($element->render(),ENT_QUOTES,'utf-8');

echo "<br><br>";

$element = new \App\HtmlElement('p',['id' => 'my_paragraph' ],'este es el contenido');

echo htmlentities($element->render(),ENT_QUOTES,'utf-8');

echo "<br><br>";

$element = new \App\HtmlElement('p',['id' => 'my_paragraph','class' => 'paragraph' ],'este es el contenido');

echo htmlentities($element->render(),ENT_QUOTES,'utf-8');

echo "<br><br>";

$element = new \App\HtmlElement('img',['src' => 'img/img.png']);

echo htmlentities($element->render(),ENT_QUOTES,'utf-8');

echo "<br><br>";

$element = new \App\HtmlElement('img',['src' => 'img/img.png','title' => 'Curso de "Refactorizacion" en styde']);

echo htmlentities($element->render(),ENT_QUOTES,'utf-8');

echo "<br><br>";

$element = new \App\HtmlElement('input',['required']);

echo htmlentities($element->render(),ENT_QUOTES,'utf-8');

echo "<br><br>";

$element = new \App\HtmlElement('input');

echo htmlentities($element->render(),ENT_QUOTES,'utf-8');