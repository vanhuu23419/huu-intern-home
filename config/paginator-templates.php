<?php 

return [
    'number' => '<li class="paginate_button page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
    'current' => '<li class="paginate_button page-item"><a href="{{url}}" class="page-link bg-primary">{{text}}</a></li>',
    'first' => '<li class="paginate_button page-item first"><a href="{{url}}" class="page-link">First</a></li>',
    'last' => '<li class="paginate_button page-item last"><a href="{{url}}" class="page-link">Last</a></li>',
    'prevActive' => '<li class="paginate_button page-item"><a href="{{url}}" class="page-link"> < </a></li>',
    'prevDisabled' => '<li class="paginate_button page-item"><button disabled="true" class="page-link"> < </button></li>',
    'nextActive' => '<li class="paginate_button page-item"><a href="{{url}}" class="page-link"> > </a></li>',
    'nextDisabled' => '<li class="paginate_button page-item"><button disabled="true" class="page-link"> > </button></li>',
];

?>

