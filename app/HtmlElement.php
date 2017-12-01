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
        if ($this->hasAttributes()) {
            return '<'.$this->name.$this->attributes().'>';
        } else {
            return '<'.$this->name.'>';
        }
    }

    public function hasAttributes(): bool
    {
        return ! empty($this->attributes);
    }

    public function attributes(): string
    {
        $htmlAttributes = '';

        foreach ($this->attributes as $attribute => $value) {
            $htmlAttributes .= $this->renderAttribute($attribute, $value);
        }

        return $htmlAttributes;
    }

    protected function renderAttribute($attribute, $value)
    {
        if (is_numeric($attribute)) {
            return ' '.$value;
        }

        return ' '.$attribute.'="'.htmlentities($value, ENT_QUOTES, 'UTF-8').'"'; // name="value"
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