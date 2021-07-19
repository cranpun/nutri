<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Myinput extends Component
{
    public $field;
    public $cssid;
    public $errorfield;
    public $label;
    public $type;
    public $placeholder;
    public $defval;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($field, $label, $type, $defval, $placeholder)
    {
        $this->field = $field;
        $this->cssid = \U::safeArrayname($field, "_");
        $this->errorfield = \U::safeArrayname($field, ".");
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->defval = $defval;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
    <fieldset id="field-{{ $field }}" class="field">
        <label class="label">{{ $label }}</label>
        <p class="control">
            <input name="{{ $field }}" id="{{ $cssid }}" class="val input @error($errorfield) is-danger @enderror" type="{{ $type }}" value="{{ $defval }}" placeholder="{{ $placeholder }}">
            @error($errorfield)
                <legend class="help is-danger">{{ join(" ", $errors->get($errorfield)) }}</legend>
            @enderror
        </p>
    </fieldset>
blade;
    }
}
