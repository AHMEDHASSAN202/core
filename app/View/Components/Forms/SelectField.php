<?php

namespace Modules\Core\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

use function view;

class SelectField extends Component
{

    /**
     * Create the component instance.
     *
     * @param string $name
     * @param Collection|array $options
     * @param array $oldValues
     * @param string|null $label
     * @param string|null $width
     * @param string|null $selectedValue
     * @param string|null $selectedLabel
     * @param string|null $id
     * @param bool|null $isMultiple
     * @param Model|null $model
     * @param string|null $relation
     * @param string|null $classes
     * @param string|null $placeholder
     */
    public function __construct(
        public string $name,
        public Collection|array $options,
        public array $oldValues = [],
        public ?string $label = '',
        public ?string $width = null,
        public ?string $selectedValue = 'id',
        public ?string $selectedLabel = 'name',
        public ?string $id = null,
        public ?bool $isMultiple = false,
        public ?Model $model = null,
        public ?string $relation = null,
        public ?string $classes = null,
        public ?string $placeholder = null,
        public mixed $eventHandler = null,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('core::components.forms.select-field');
    }
}
