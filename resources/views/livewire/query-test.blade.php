<div class="w-screen h-screen p-8 bg-gray-100 flex items-center" >
    <a href='querytest2' wire:navigate>Go To QueryTest2</a>
    <div class="flex flex-row justify-center space-x-4 mx-auto">
        <div class="flex flex-col p-4 text-center bg-white border-b border-gray-100 rounded-lg shadow-md sm:border-0 sm:border-r self-center">
            <div class="mt-1 text-lg font-medium leading-6 text-gray-500">Param 1</div>
            <div class="my-1 font-extrabold text-primary">
                <input wire:model.live="param1" type="text" class="w-full p-2 text-sm font-medium text-center text-gray-700 border border-gray-300 rounded shadow-sm bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
            </div>
        </div>
        <div class="flex flex-col p-4 text-center bg-white border-b border-gray-100 rounded-lg shadow-md sm:border-0 sm:border-r self-center">
            <div class="mt-1 text-lg font-medium leading-6 text-gray-500">Param 3</div>
            <div class="my-1 font-extrabold text-primary">
                <input wire:model.live="test.1.test" type="text" class="w-full p-2 text-sm font-medium text-center text-gray-700 border border-gray-300 rounded shadow-sm bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
            </div>
        </div>
        <div class="flex flex-col p-4 text-center bg-white border-b border-gray-100 rounded-lg shadow-md sm:border-0 sm:border-r self-center">
            <div class="mt-1 text-lg font-medium leading-6 text-gray-500">Param 3</div>
            <div class="my-1 font-extrabold text-primary">
                <input wire:model.live="test.2.test" type="text" class="w-full p-2 text-sm font-medium text-center text-gray-700 border border-gray-300 rounded shadow-sm bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
            </div>
        </div>

        <div class="flex p-8">
            <div wire:click="resetAllVariables" class="bg-red-500 rounded-lg shadow p-2 cursor-pointer text-white font-semibold">
                RESET BY FUNCTION
            </div>
        </div>
        
    </div>
</div>
