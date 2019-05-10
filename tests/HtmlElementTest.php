<?php


namespace Tests;


use App\HtmlElement;

class HtmlElementTest extends TestCase
{
    function test_it_generates_a_paragraph_with_content()
    {
        $element = new HtmlElement('p',[],'este es el contenido');

        $this->assertSame(
            '<p>este es el contenido</p>',
            $element->render()
        );
    }

    function test_it_generates_a_paragraph_with_content_and_once_attribute()
    {
        $element = new HtmlElement('p',['id' => 'my_paragraph' ],'este es el contenido');

        $this->assertSame(
            '<p id="my_paragraph">este es el contenido</p>',
            $element->render()
        );
    }

    function test_it_generates_a_paragraph_with_content_and_twice_attribute()
    {
        $element = new HtmlElement('p',
            ['id' => 'my_paragraph','class' => 'paragraph' ],'este es el contenido');

        $this->assertSame(
            '<p id="my_paragraph" class="paragraph">este es el contenido</p>',
            $element->render()
        );
    }

    function test_it_generates_a_tag_image()
    {
        $element = new HtmlElement('img',['src' => 'img/img.png']);

        $this->assertSame(
            '<img src="img/img.png">',
            $element->render()
        );
    }

    function test_it_generates_a_tag_image_it_escapes_the_html_attributes()
    {
        $element = new HtmlElement('img',
            ['src' => 'img/img.png','title' => 'Curso de "Refactorizacion" en styde']);

        $this->assertSame(
            '<img src="img/img.png" title="Curso de &quot;Refactorizacion&quot; en styde">',
            $element->render()
        );
    }

    function test_it_generates_a_tag_input_with_boolean_attributes()
    {
        $element = new HtmlElement('input',['required']);

        $this->assertSame(
            '<input required>',
            $element->render()
        );
    }

    function test_it_generates_a_tag_input_without_boolean_attributes()
    {
        $element = new HtmlElement('input');

        $this->assertSame(
            '<input>',
            $element->render()

}