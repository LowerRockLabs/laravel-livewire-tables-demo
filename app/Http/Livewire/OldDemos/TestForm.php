<?php
 
 namespace App\Http\Livewire\OldDemos;
 
use Livewire\Attributes\Rule;
use Livewire\Form;
 
class TestForm extends Form
{
    #[Rule('required|min:5')]
    public $title = '';
 
    #[Rule('nullable|min:5')]
    public ?string $content = null;

    #[Rule([
        'testForm.testArray.test1' => [
            'required',
            'min:25',
        ],
        'testForm.testArray.test2' => [
            'required',
            'min:3'
        ],
    ])]
    public $testArray = [];
    

    public function setTestArrayUp()
    {
        $this->testArray['test1'] = 's';
        $this->testArray['test2'] = null;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
 
    public function store()
    {
        dd($this->only(['title','content']));
    }
}
