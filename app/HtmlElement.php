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

    public function __construct(string $name, array $attributes =[], $content = null)
    {
        $this->name = $name;
        $this->content = $content;
        $this->attributes = $attributes;
    }

    public function  render()
    {
        $result = $this->open();

        if ($this->isVoid()){
            return $result;
        }

        $result .= $this->content();

        $result .= $this->close();

        return $result;
    }

    public function open()
    {
        if (! empty($this->attributes)){
            $htmlAttributes = '';
            foreach ($this->attributes as $attribute => $value){
                if (is_numeric($attribute)){
                    $htmlAttributes .= ' '.$value;
                }else{
                    $htmlAttributes .= ' '.$attribute.'="'.htmlentities($value,ENT_QUOTES,'UTF-8').'"';//
                }
            }
            //abrir la etiqueta con atributos
            $result = '<'.$this->name.$htmlAttributes.'>';
        }else{
            //abrir la etiqueta sin atributos
            $result = '<'.$this->name.'>';
        }

        return $result;
    }

    public function isVoid()
    {
        return in_array($this->name, ['img','br','hr','input','meta']);
    }

    /**
     * @return string
     */
    public function content()
    {
        return htmlentities($this->content, ENT_QUOTES, 'UTF-8');
    }

    /**
     * @return string
     */
    public function close()
    {
        return '</' . $this->name . '>';
    }

}