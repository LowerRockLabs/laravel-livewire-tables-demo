<div x-data='{ 
        optionsVisible: false,
        search: "",
        selected: {
            label: "",
            value: ""
        },
        selectedOptions: [],
        selectedValues: [],
        options: [
            {
                label: "Abattoir Worker",
                value: "abattoir worker"
            },
            {
                label: "Abbot",
                value: "abbot"
            },
            {
                label: "Traffic Supervisor",
                value: "traffic supervisor"
            },
            {
                label: "Traffic Warden",
                value: "traffic warden"
            },
            {
                label: "Train Despatcher",
                value: "train despatcher"
            },
            {
                label: "Train Driver",
                value: "train driver"
            },
            {
                label: "Train Motorman",
                value: "train motorman"
            },
            {
                label: "Trainee Manager",
                value: "trainee manager"
            },
            {
                label: "Trainer",
                value: "trainer"
            },
            {
                label: "Trainer - Animal",
                value: "trainer - animal"
            },
            {
                label: "Trainer - Greyhound",
                value: "trainer - greyhound"
            },
            {
                label: "Trainer - Race Horse",
                value: "trainer - race horse"
            },
            {
                label: "Training Advisor",
                value: "training advisor"
            },
            {
                label: "Training Assistant",
                value: "training assistant"
            },
            {
                label: "Training Consultant",
                value: "training consultant"
            },
            {
                label: "Training Co-ordinator",
                value: "training co-ordinator"
            },
            {
                label: "Training Instructor",
                value: "training instructor"
            },
            {
                label: "Training Manager",
                value: "training manager"
            },
            {
                label: "Training Officer",
                value: "training officer"
            },
            {
                label: "Transcriber",
                value: "transcriber"
            },
            {
                label: "Translator",
                value: "translator"
            },
            {
                label: "Transmission Controller",
                value: "transmission controller"
            },
            {
                label: "Transport Clerk",
                value: "transport clerk"
            },
            {
                label: "Transport Consultant",
                value: "transport consultant"
            },
            {
                label: "Transport Controller",
                value: "transport controller"
            },
            {
                label: "Transport Engineer",
                value: "transport engineer"
            },
            {
                label: "Transport Manager",
                value: "transport manager"
            },
            {
                label: "Transport Officer",
                value: "transport officer"
            },
            {
                label: "Transport Planner",
                value: "transport planner"
            },
            {
                label: "Transport Policeman",
                value: "transport policeman"
            },
            {
                label: "Travel Agent",
                value: "travel agent"
            },
            {
                label: "Travel Clerk",
                value: "travel clerk"
            },
            {
                label: "Travel Consultant",
                value: "travel consultant"
            },
            {
                label: "Travel Courier",
                value: "travel courier"
            },
            {
                label: "Travel Guide",
                value: "travel guide"
            },
            {
                label: "Travel Guide Writer",
                value: "travel guide writer"
            },
            {
                label: "Travel Representative",
                value: "travel representative"
            },
            {
                label: "Travelling Salesman / Woman",
                value: "travelling salesman / woman"
            },
            {
                label: "Travelling Showman",
                value: "travelling showman"
            },
            {
                label: "Trawler Hand",
                value: "trawler hand"
            },
            {
                label: "Treasurer",
                value: "treasurer"
            },
            {
                label: "Tree Feller",
                value: "tree feller"
            },
            {
                label: "Tree Surgeon",
                value: "tree surgeon"
            },
            {
                label: "Trichologist",
                value: "trichologist"
            },
            {
                label: "Trinity House Pilot",
                value: "trinity house pilot"
            },
            {
                label: "Trout Farmer",
                value: "trout farmer"
            },
            {
                label: "Truck Driver",
                value: "truck driver"
            },
            {
                label: "T-Shirt Printer",
                value: "t-shirt printer"
            },
            {
                label: "Tug Skipper",
                value: "tug skipper"
            },
            {
                label: "Tunneller",
                value: "tunneller"
            },
            {
                label: "Turf Accountant",
                value: "turf accountant"
            },
            {
                label: "Turkey Farmer",
                value: "turkey farmer"
            },
            {
                label: "Turner",
                value: "turner"
            },
            {
                label: "Tutor",
                value: "tutor"
            },
            {
                label: "TV And Video Installer",
                value: "tv and video installer"
            },
            {
                label: "TV And Video Repairer",
                value: "tv and video repairer"
            },
            {
                label: "TV Announcer",
                value: "tv announcer"
            },
            {
                label: "TV Broadcasting Technician",
                value: "tv broadcasting technician"
            },
            {
                label: "TV Editor",
                value: "tv editor"
            },
            {
                label: "Typesetter",
                value: "typesetter"
            },
            {
                label: "Typewriter Engineer",
                value: "typewriter engineer"
            },
            {
                label: "Typist",
                value: "typist"
            },
            {
                label: "Typographer",
                value: "typographer"
            },
            {
                label: "Tyre Builder",
                value: "tyre builder"
            },
            {
                label: "Tyre Fitter",
                value: "tyre fitter"
            },
            {
                label: "Tyre Inspector",
                value: "tyre inspector"
            },
            {
                label: "Tyre Technician",
                value: "tyre technician"
            },
            {
                label: "Tyre / Exhaust Fitter",
                value: "tyre / exhaust fitter"
            },
            {
                label: "Umpire",
                value: "umpire"
            },
            {
                label: "Undergraduate Student - Living At Home",
                value: "undergraduate student - living at home"
            },
            {
                label: "Undergraduate Student - Living Away from Home",
                value: "undergraduate student - living away from home"
            },
            {
                label: "Undertaker",
                value: "undertaker"
            },
            {
                label: "Underwriter",
                value: "underwriter"
            },
            {
                label: "Unemployed",
                value: "unemployed"
            },
            {
                label: "University Dean",
                value: "university dean"
            },
            {
                label: "University Reader",
                value: "university reader"
            },
            {
                label: "Unknown",
                value: "unknown"
            },
            {
                label: "Upholsterer",
                value: "upholsterer"
            },
            {
                label: "Usher",
                value: "usher"
            },
            {
                label: "Valet",
                value: "valet"
            },
            {
                label: "Valuer",
                value: "valuer"
            },
            {
                label: "Valve Technician",
                value: "valve technician"
            },
            {
                label: "Van Driver",
                value: "van driver"
            },
            {
                label: "Van Salesman",
                value: "van salesman"
            },
            {
                label: "VDU Operator",
                value: "vdu operator"
            },
            {
                label: "Vehicle Assessor",
                value: "vehicle assessor"
            },
            {
                label: "Vehicle Body Worker",
                value: "vehicle body worker"
            },
            {
                label: "Vehicle Bodybuilder",
                value: "vehicle bodybuilder"
            },
            {
                label: "Vehicle Delivery Agent",
                value: "vehicle delivery agent"
            },
            {
                label: "Vehicle Engineer",
                value: "vehicle engineer"
            },
            {
                label: "Vehicle Technician",
                value: "vehicle technician"
            },
            {
                label: "Vending Machine Filler",
                value: "vending machine filler"
            },
            {
                label: "Vending Machine Technician",
                value: "vending machine technician"
            },
            {
                label: "Ventriloquist",
                value: "ventriloquist"
            },
            {
                label: "Verger",
                value: "verger"
            },
            {
                label: "Veterinary Assistant",
                value: "veterinary assistant"
            },
            {
                label: "Veterinary Nurse",
                value: "veterinary nurse"
            },
            {
                label: "Veterinary Surgeon",
                value: "veterinary surgeon"
            },
            {
                label: "Vicar",
                value: "vicar"
            },
            {
                label: "Video Supplier",
                value: "video supplier"
            },
            {
                label: "Videotape Engineer",
                value: "videotape engineer"
            },
            {
                label: "Violin Maker",
                value: "violin maker"
            },
            {
                label: "Vision Control Manager",
                value: "vision control manager"
            },
            {
                label: "Vision Mixer",
                value: "vision mixer"
            },
            {
                label: "Voluntary Worker",
                value: "voluntary worker"
            },
            {
                label: "Volcanologist",
                value: "volcanologist"
            },
            {
                label: "Wages Clerk",
                value: "wages clerk"
            },
            {
                label: "Waiter",
                value: "waiter"
            },
            {
                label: "Waiter / Waitress - Licensed",
                value: "waiter / waitress - licensed"
            },
            {
                label: "Waiter / Waitress - Unlicensed",
                value: "waiter / waitress - unlicensed"
            },
            {
                label: "Waitress",
                value: "waitress"
            },
            {
                label: "Warden",
                value: "warden"
            },
            {
                label: "Wardrobe Mistress",
                value: "wardrobe mistress"
            },
            {
                label: "Warehouse Manager",
                value: "warehouse manager"
            },
            {
                label: "Warehouseman",
                value: "warehouseman"
            },
            {
                label: "Warehouseman / Woman",
                value: "warehouseman / woman"
            },
            {
                label: "Warehousewoman",
                value: "warehousewoman"
            },
            {
                label: "Waste Dealer",
                value: "waste dealer"
            },
            {
                label: "Waste Disposal Worker",
                value: "waste disposal worker"
            },
            {
                label: "Waste Paper Merchant",
                value: "waste paper merchant"
            },
            {
                label: "Watchmaker",
                value: "watchmaker"
            },
            {
                label: "Water Diviner",
                value: "water diviner"
            },
            {
                label: "Water Industry Worker",
                value: "water industry worker"
            },
            {
                label: "Weaver",
                value: "weaver"
            },
            {
                label: "Web Designer",
                value: "web designer"
            },
            {
                label: "Web Developer",
                value: "web developer"
            },
            {
                label: "Web Programmer",
                value: "web programmer"
            },
            {
                label: "Weighbridge Clerk",
                value: "weighbridge clerk"
            },
            {
                label: "Weighbridge Operator",
                value: "weighbridge operator"
            },
            {
                label: "Welder",
                value: "welder"
            },
            {
                label: "Welfare Assistant",
                value: "welfare assistant"
            },
            {
                label: "Welfare Officer",
                value: "welfare officer"
            },
            {
                label: "Welfare Rights Officer",
                value: "welfare rights officer"
            },
            {
                label: "Wheel Clamper",
                value: "wheel clamper"
            },
            {
                label: "Wheelwright",
                value: "wheelwright"
            },
            {
                label: "Whisky Blender",
                value: "whisky blender"
            },
            {
                label: "Wholesale Newspaper Delivery Driver",
                value: "wholesale newspaper delivery driver"
            },
            {
                label: "Will Writer",
                value: "will writer"
            },
            {
                label: "Window Cleaner",
                value: "window cleaner"
            },
            {
                label: "Window Dresser",
                value: "window dresser"
            },
            {
                label: "Windscreen Fitter",
                value: "windscreen fitter"
            },
            {
                label: "Wine Merchant",
                value: "wine merchant"
            },
            {
                label: "Wood Carver",
                value: "wood carver"
            },
            {
                label: "Wood Cutter",
                value: "wood cutter"
            },
            {
                label: "Wood Machinist",
                value: "wood machinist"
            },
            {
                label: "Wood Worker",
                value: "wood worker"
            },
            {
                label: "Word Processing Operator",
                value: "word processing operator"
            },
            {
                label: "Work Study Analyst",
                value: "work study analyst"
            },
            {
                label: "Works Manager",
                value: "works manager"
            },
            {
                label: "Writer",
                value: "writer"
            },
            {
                label: "Yacht Master",
                value: "yacht master"
            },
            {
                label: "Yard Man",
                value: "yard man"
            },
            {
                label: "Yard Manager",
                value: "yard manager"
            },
            {
                label: "Yoga Teacher",
                value: "yoga teacher"
            },
            {
                label: "Youth Hostel Warden",
                value: "youth hostel warden"
            },
            {
                label: "Youth Worker",
                value: "youth worker"
            },
            {
                label: "Zoo Keeper",
                value: "zoo keeper"
            },
            {
                label: "Zoo Manager",
                value: "zoo manager"
            },
            {
                label: "Zoologist",
                value: "zoologist"
            },
            {
                label: "Zoology Consultant",
                value: "zoology consultant"
            },
        ],
        addSelected(option) {
            if (!this.selectedOptions.find(selected => selected.label === option.label)) {
                this.selectedOptions.push(option);
                this.selectedOptions.sort((a, b) => (a["label"] > b["label"]) ? 1 : -1);
            }
            this.selectedValues.push(option.value);
        },
        removeSelected(option, removalValue) {
            _.pullAt(this.selectedOptions, [option]);
            alert(this.selectedValues.find(selected => selected === removalValue));
        },
        filteredOptions() {
            if (this.search.length > 0) {
                return this.options.filter((option) => {
                    return option.value.includes(this.search.toLowerCase());
                });
            }
            return null;
        },
        updateWireable() {
            $wire.set("value", this.selectedValues);
        },
 }' role="menuitem" x-on:mousedown.away= "updateWireable()">
<div class="rounded-md shadow-sm" >
    <input type="text" x-model="search" placeholder="Click to search..." 
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
    @click="optionsVisible = !optionsVisible">
    <div x-show="optionsVisible">
        <template x-for="option in filteredOptions()">
            <a @click.prevent="addSelected(option); optionsVisible = false" x-text="option.label" style="display: block;"></a>
        </template>
    </div>
    <div>
        <template x-for="(selectedOption, index) in selectedOptions" :key="selectedOption.label">
            <div>
                <span x-text="selectedOption.label"></span>&nbsp;&nbsp;
                <a @click.prevent="removeSelected(index, selectedOption.value);">X</a><br />
            </div>
        </template>
    </div>
</div>
</div>
