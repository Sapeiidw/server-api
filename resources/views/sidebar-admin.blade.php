<aside class="sidebar md:max-w-1/5 w-1/5 sticky-top-0 relative shadow-md rounded-t-2xl overflow-x-hidden border border-gray-200 mt-2 ml-2 bg-sidebar bg-white h-min-screen sm:block">
    <nav class="text-white text-base font-semibold overflow-x-hidden pt-3 ">
        {{-- <div class="flex py-3 justify-between text-gray-700">
            <div class=" text-black">Management</div>
            <i class="fas fa-bars" id="btn"></i>
        </div> --}}
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('user.index') }}" :active="request()->routeIs('user.*')">
                <i class="fas fa-user m-2"></i>
                <div class="md:visible invisible">
                    {{ __('User') }}
                </div>
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between" >
            <x-sidelink href="{{ route('role.index') }}" :active="request()->routeIs('role.*')">
                <i class="fas fa-user-tag m-2 mr-1"></i>
                <div class="md:visible invisible">
                    {{ __('Role') }}
                </div>
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('permission.index') }}" :active="request()->routeIs('permission.*')">
                <i class="fas fa-id-badge m-2"></i>
                <div class="md:visible invisible">
                    {{ __('Permission') }}
                </div>
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('client.index') }}" :active="request()->routeIs('client.*')">
                <i class="fas fa-cogs m-2"></i>
                <div class="md:visible invisible">
                    {{ __('Client') }}
                </div>
            </x-sidelink>
        </div>
        <div class="flex py-3 justify-between">
            <x-sidelink href="{{ route('log.index') }}" :active="request()->routeIs('log.*')">
                <i class="fas fa-clipboard-list m-2"></i>
                <div class="md:visible invisible">
                    {{ __('Log Activity') }}
                </div>
            </x-sidelink>
        </div>
    </nav>
</aside>
{{-- class="flexmd:visible invisible" --}}
{{-- <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    // let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
    });

    searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
    if(sidebar.classList.contains("open")){
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
    }else {
    closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
    }
    }
</script> --}}
