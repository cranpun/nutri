<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Mytextarea extends Component
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
    public function __construct($field, $label, $defval)
    {
        $this->field = $field;
        $this->cssid = \U::safeArrayname($field, "_");
        $this->errorfield = \U::safeArrayname($field, ".");
        $this->label = $label;
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
            <textarea name="{{ $field }}" id="{{ $cssid }}" rows="3" class="val textarea @error($errorfield) is-danger @enderror">{{ $defval }}</textarea>
            @error($errorfield)
                <legend class="help is-danger">{{ join(" ", $errors->get($errorfield)) }}</legend>
            @enderror
        </p>
    </fieldset>
blade;
    }
}
