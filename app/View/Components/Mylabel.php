<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Mylabel extends Component
{
    public $field;
    public $label;
    public $type;
    public $defval;

    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct($field, $label, $defval)
    {
        $this->field = $field;
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
            <span id="{{ $field }}" class="val">{{ $defval }}</span>
        </p>
    </fieldset>
blade;
    }
}
