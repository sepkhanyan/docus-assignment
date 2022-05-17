@if($count)
    <table class="table-fixed w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 w-20">
                ID
            </th>
            <th class="px-4 py-2">
                Name
            </th>
            @if($type == 'user')
                <th class="px-4 py-2">
                    Email
                </th>
                <th class="px-4 py-2">
                    Created Date
                </th>
                <th class="px-4 py-2">
                    Roles
                </th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr class="bg-white-100 text-center">
                <td class="border px-4 py-2">
                    {{$item->id}}
                </td>
                <td class="border px-4 py-2">
                    <div class="text-sm text-gray-900">
                        {{$item->name}}
                    </div>
                </td>
                @if($type == 'user')
                    <td class="border px-4 py-2">
                        <div class="text-sm text-gray-500">
                            {{$item->email}}
                        </div>
                    </td>
                    <td class="border px-4 py-2">
                        {{$item->created_at}}
                    </td>
                    <td class="border px-4 py-2">
                        @if(!empty($item->getRoleNames()))
                            @foreach($item->getRoleNames() as $name)
                                <p class="badge badge-success">{{ $name }}</p>
                            @endforeach
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>There is no any {{$type}}</p>
@endif
