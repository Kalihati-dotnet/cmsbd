<ul class="tree">
    @if(isset($treeParent) && count($treeParent)>0 && isset($treeName))
        @foreach($treeParent as $childrenTree)
        <li>
            <div class="tree-item"><i></i><span >{{ ucfirst($childrenTree->name) }}</span>
                <div class="category-action-group">
                    <a href="{{ route('manage.'. $treeName .'.edit',  ['id' => $childrenTree->id])}}"><i class="fa fa-edit"></i><span>Edit</span></a>
                    <a href="{{ route('manage.'. $treeName .'.destroy',  ['id' => $childrenTree->id] )}}" class="btn btn-sm btn-danger delete-modal" data-id="{{ $childrenTree->id }}"
                            data-toggle="modal" 
                            data-target="#delete_modal"
                            onclick="event.preventDefault();">
                            <i class="fa fa-trash"></i><span>Delete</span>
                        </a>
                    <a href="{{ route('manage.'. $treeName .'.show',  ['id' => $childrenTree->id]) }}"><i class="fa fa-eye"></i><span>View</span></a>
                </div>
            </div>
            @if(count($childrenTree->children)>0)
                @include('manage._includes.widgets.renderChildrenTreeList',[
                    'treeParent' => $childrenTree->children,
                    'treeName' => $treeName,
                ])
            @endif
        </li>
        @endforeach
    @endif
</ul>