<?php

namespace App\Http\Livewire\OldDemos;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Rule;
use Livewire\Form;

class TestPage extends Component
{
    public TestFormNew $testForm;

    #[Rule('required|min:5')]
    public string $testStringInput;

    public function mount()
    {
        $this->testForm->setTitle('test123');
        $this->testForm->setTestArrayUp();
    }

    public function storeForm()
    {
        $validated = $this->validateSome(['testStringInput','testForm.title','testForm.testArray1.test1','testForm.testArray1.test2','testForm.testArray2.*', 'testForm.testArray2.field2']);
      //  $this->testForm->store();
    }

    public function render()
    {
        return view('livewire.test-page');
    }
}

class TestFormNew extends Form
{
    #[Rule('required|min:5')]
    public $title = '';
 
    #[Rule('nullable|min:5')]
    public ?string $content = null;

    #[Rule([
        'testForm.testArray1.test1' => [
            'required',
            'min:25',
        ],
        'testForm.testArray1.test2' => [
            'required',
            'min:3'
        ],
    ])]
    public $testArray1 = [];
    
    #[Rule([
        'testForm.testArray2.*' => ['required'],
        'testForm.testArray2.field1' => [
            'required',
            'min:15',
        ],
        'testForm.testArray2.field2' => [
            'required',
            'min:3'
        ],
    ])]
    public $testArray2 = [];

    public function setTestArrayUp()
    {
        $this->testArray1['test1'] = 's';
        $this->testArray1['test2'] = null;

        $this->testArray2['field1'] = null;
        $this->testArray2['field2'] = null;

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
