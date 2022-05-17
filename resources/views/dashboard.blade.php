<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <p class="text-2xl">Users</p>
                <div class="mb-4">
                    <input class="shadow appearance-none border rounded w-100 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nameFilter" type="text" placeholder="Search by Name">
                </div>
                <div id="usersTable"></div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <p class="text-2xl">Roles</p>
                <div id="rolesTable"></div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <p class="text-2xl">Permissions</p>
                <div id="permissionsTable"></div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    $(document).ready(function(){
        getUsers();
        getRoles();
        getPermissions();

        $('#nameFilter').keyup(function (event){
            let keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                let name = $(this).val();
                getUsers(name);
            }
        });

        function getUsers(name = ''){
            let usersUrl = '/users'
            if(name && name !== ''){
                usersUrl += '?name=' + name;
            }
            $.get(usersUrl, function (data) {
                $('#usersTable').html(data);
            })
        }

        function getRoles(){
            let rolesUrl = '/roles'
            $.get(rolesUrl, function (data) {
                $('#rolesTable').html(data);
            })
        }

        function getPermissions(){
            let permissionsUrl = '/permissions'
            $.get(permissionsUrl, function (data) {
                $('#permissionsTable').html(data);
            })
        }
    });
</script>
