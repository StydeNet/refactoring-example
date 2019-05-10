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
        $this->attributes = new HtmlAttributes($attributes);
    }

    public function  render()
    {
        if ($this->isVoid()){
            return $this->open();
        }

        return $this->open().$this->content().$this->close();
    }

    public function open()
    {
        if ($this->hasAttributes()){
            return '<'.$this->name.$this->attributes->render().'>';
        }else{
            return '<'.$this->name.'>';
        }
    }

    public function attributes()
    {
        return $this->attributes->render();
    }

    /**
     * @return bool
     */
    public function hasAttributes()
    {
        return !empty($this->getAttributes());
    }

    /*public function attributes()
    {

        return array_reduce(array_keys($this->getAttributes()),function ($result,$attribute){
            return $result . $this->attributes->render($attribute);
        },'');

        /*$htmlAttributes = '';

        foreach ($this->attributes as $attribute => $value){

            $htmlAttributes .= $this->renderAttribute($attribute,$value);

        }

        return $htmlAttributes;
    }*/

    /*protected function renderAttribute($attribute)
    {
        if (is_numeric($attribute)){
            return ' '.$this->getAttributes()[$attribute];
        }

        return ' '.$attribute.'="'.htmlentities($this->getAttributes()[$attribute],ENT_QUOTES,'UTF-8').'"';//
    }*/

    protected function getAttributes()
    {
        return $this->attributes->attributes;
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