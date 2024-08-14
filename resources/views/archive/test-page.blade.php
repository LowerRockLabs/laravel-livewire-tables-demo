<div>
    <div>
        testStringInput
        <input type="text" wire:model="testStringInput" />
        @error('testStringInput')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div>
        title
        <input type="text" wire:model="testForm.title" />
        @error('testForm.title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div>
        Content
        <input type="text" wire:model="testForm.content" />
        @error('testForm.content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        testForm.testArray1.test1
        <input type="text" wire:model="testForm.testArray1.test1" />
        @error('testForm.testArray1.test1')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div>
        testForm.testArray1.test2
        <input type="text" wire:model="testForm.testArray1.test2" />
        @error('testForm.testArray1.test2')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        testForm.testArray2.field1
        <input type="text" wire:model="testForm.testArray2.field1" />
        @error('testForm.testArray2.field1')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div>
        testForm.testArray2.field2
        <input type="text" wire:model="testForm.testArray2.field2" />
        @error('testForm.testArray2.field2')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <button wire:click="storeForm">STORE</button>
</div>
