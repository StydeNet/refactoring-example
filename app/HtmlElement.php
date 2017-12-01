<?php

namespace App;

class HtmlElement
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var null
     */
    private $content;
    /**
     * @var array
     */
    private $attributes;

    public function __construct(string $name, array $attributes = [], $content = null)
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->content = $content;
    }
    
    public function render()
    {
        $result = $this->open();

        if ($this->isVoid()) {
            return $result;
        }

        $result .= $this->content();

        $result .= $this->close();

        return $result;
    }

    public function open(): string
    {
        if (! empty($this->attributes)) {
            $htmlAttributes = '';

            foreach ($this->attributes as $attribute => $value) {
                if (is_numeric($attribute)) {
                    $htmlAttributes .= ' '.$value;
                } else {
                    $htmlAttributes .= ' '.$attribute.'="'.htmlentities($value, ENT_QUOTES, 'UTF-8').'"'; // name="value"
                }
            }

            // Abrir la etiqueta con atributos
            $result = '<'.$this->name.$htmlAttributes.'>';
        } else {
            // Abrir la etiqueta sin atributos
            $result = '<'.$this->name.'>';
        }

        return $result;
    }

    public function isVoid(): bool
    {
        return in_array($this->name, ['br', 'hr', 'img', 'input', 'meta']);
    }

    public function content(): string
    {
        return htmlentities($this->content, ENT_QUOTES, 'UTF-8');
    }

    public function close(): string
    {
        return '</'.$this->name.'>';
    }
}