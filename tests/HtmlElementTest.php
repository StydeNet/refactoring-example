<?php


namespace Tests;


use App\HtmlElement;

class HtmlElementTest extends TestCase
{
    function test_it_checks_if_a_element_is_void_or_not()
    {
        $this->assertFalse((new HtmlElement('p'))->isVoid());

        $this->assertTrue((new HtmlElement('img'))->isVoid());

        $this->assertTrue((new HtmlElement('input'))->isVoid());
    }

    function test_it_generates_attributes()
    {
        $element = new HtmlElement('span',['class' => 'a_spam', 'id' => 'the_spam' ]);

        $this->assertSame(
            ' class="a_spam" id="the_spam"',
            $element->attributes()

        );
    }

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

    function test_check_attributes_is_empty()
    {
        $element = new HtmlElement('p',[]);
        $this->assertFalse(
            $element->hasAttributes()
        );

    }

    function test_it_generates_a_tag_input_without_boolean_attributes()
    {
        $element = new HtmlElement('input');

        $this->assertSame(
            '<input>',
            $element->render()
        );
    }

    function test_it_generates_html_without_tag()
    {
        $element = new HtmlElement('',[],'este es el contenido');

        $this->assertSame(
            '<>este es el contenido</>',
            $element->render()
        );
    }

    function test_it_check_open_tag()
    {
        $this->assertSame(
            '<p>',
            (new HtmlElement('p'))->open()
        );
    }

    function test_it_check_close_tag()
    {
        $this->assertSame(
            '</p>',
            (new HtmlElement('p'))->close()
        );
    }
}